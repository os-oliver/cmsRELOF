<?php
namespace App\Models;

use App\Controllers\LanguageMapperController;
use App\Database;
use App\Utils\Pivoter;
use PDO;

class Page
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->GetPDO();
    }

    // Mapiranje locale → lang kod (default sr-Cyrl)
    private function resolveLang(string $locale): string
    {
        return match ($locale) {
            'sr-Cyrl' => 'sr-Cyrl',
            'sr', 'sr-Latn' => 'sr',
            'en' => 'en',
            default => 'sr-Cyrl',
        };
    }

    private function transliterateVariants(string $text, string $locale): array
    {
        $mapper = new LanguageMapperController();
        $locale = (string) $locale;

        if ($locale === 'sr-Cyrl') {
            return [
                'sr-Cyrl' => $text,
                'sr' => $mapper->cyrillic_to_latin($text),
            ];
        }

        if ($locale === 'sr' || $locale === 'sr-Latn') {
            return [
                'sr' => $text,
                'sr-Cyrl' => $mapper->latin_to_cyrillic($text),
            ];
        }

        $lang = $this->resolveLang($locale);
        return [$lang => $text];
    }

    /**
     * List (paginated) gallery items — uses subquery pagination + pivot for multilingual fields.
     */
    public function list(
        int $limit = 10,
        int $offset = 0,
        string $sort = 'date_desc',
        ?string $search = null,
        string $lang = 'sr-Cyrl'
    ): array {
        $params = [
            ':lang' => $lang,
            ':offset' => $offset,
            ':limit' => $limit,
        ];

        $where = [];
        if ($search !== null && $search !== '') {
            $where[] = "t.content LIKE :search";
            $params[':search'] = "%{$search}%";
        }

        $whereClause = $where ? ' AND ' . implode(' AND ', $where) : '';

        // Order mapping
        $order = match ($sort) {
            'date_asc' => 'g.uploaded_at ASC',
            'title' => 't.content ASC',
            default => 'g.uploaded_at DESC',
        };

        $sql = "
        SELECT g.id, g.image_file_path, g.uploaded_at,
               t.field_name, t.content
        FROM (
            SELECT id FROM gallery ORDER BY uploaded_at DESC LIMIT :offset, :limit
        ) AS page_gallery
        JOIN gallery g ON g.id = page_gallery.id
        JOIN text t ON t.source_id = g.id
            AND t.source_table = 'gallery'
            AND t.lang = :lang COLLATE utf8mb4_unicode_ci
        {$whereClause}
        ORDER BY {$order};
    ";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT COUNT(*) FROM gallery;")->fetchColumn();

        $data = (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
        return [$data, $total];
    }

    public function pageExists(string $pageName): bool
    {
        $stmt = $this->pdo->prepare("
        SELECT CASE WHEN EXISTS (
           select 1 from text where source_table='userdefinedpages' and content=:pageName
        ) THEN 1 ELSE 0 END AS PageExists;
    ");
        $stmt->execute(['pageName' => $pageName]);
        return (bool) $stmt->fetchColumn();
    }

    public function create(array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            // check exists
            if ($this->pageExists($data['href'])) {
                $this->pdo->rollBack();
                return false;
            }

            // insert new page
            $stmt = $this->pdo->prepare("
            INSERT INTO userdefinedpages (href) VALUES (:href)
        ");
            $stmt->execute(['href' => $data['href']]);
            $pageID = $this->pdo->lastInsertId();

            // transliterate title variants for multiple languages
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $titleVariants = $this->transliterateVariants((string) ($data['pagename'] ?? ''), $locale);

            // prepare once
            $stmtText = $this->pdo->prepare("
            INSERT INTO text (source_id, source_table, field_name, lang, content)
            VALUES (:source_id, 'userdefinedpages', 'page', :lang, :content)
        ");

            // loop languages → insert translations for the same field "page"
            foreach ($titleVariants as $lang => $content) {
                $content = trim((string) $content);
                if ($content === '') {
                    continue;
                }
                $stmtText->execute([
                    ':source_id' => $pageID,
                    ':lang' => $lang,
                    ':content' => $content,
                ]);
            }

            $this->pdo->commit();
            return true;

        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Page insert failed: ' . $e->getMessage());
            return false;
        }
    }


    public function update(int $id, array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            // If new image provided, replace file and update path
            if (!empty($data['image_file_path'])) {
                $stmtOld = $this->pdo->prepare("SELECT image_file_path FROM gallery WHERE id = :id");
                $stmtOld->execute([':id' => $id]);
                $old = $stmtOld->fetchColumn();
                if ($old) {
                    $fullOld = __DIR__ . '/../../public' . $old;
                    if (file_exists($fullOld))
                        unlink($fullOld);
                }

                $stmtImg = $this->pdo->prepare("UPDATE gallery SET image_file_path = :path WHERE id = :id");
                $stmtImg->execute([':path' => '/uploads/gallery/' . $data['image_file_path'], ':id' => $id]);
            }

            // Update other meta if needed (here none besides image)

            // Replace text entries for title/description
            $stmtDel = $this->pdo->prepare("\n                DELETE FROM text WHERE source_id = :id AND source_table = 'gallery'\n            ");
            $stmtDel->execute([':id' => $id]);

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $titleVariants = $this->transliterateVariants((string) ($data['title'] ?? ''), $locale);
            $descVariants = $this->transliterateVariants((string) ($data['description'] ?? ''), $locale);

            $stmtText = $this->pdo->prepare("\n                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'gallery', :field_name, :lang, :content)\n            ");

            foreach (['title' => $titleVariants, 'description' => $descVariants] as $field => $variants) {
                foreach ($variants as $lg => $c) {
                    $c = trim((string) $c);
                    if ($c === '')
                        continue;
                    $stmtText->execute([
                        ':source_id' => $id,
                        ':field_name' => $field,
                        ':lang' => $lg,
                        ':content' => $c,
                    ]);
                }
            }

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('Gallery update failed: ' . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmtText = $this->pdo->prepare("DELETE FROM text WHERE source_id = :id AND source_table = 'gallery'");
            $stmtText->execute([':id' => $id]);

            $stmtFile = $this->pdo->prepare("SELECT image_file_path FROM gallery WHERE id = :id");
            $stmtFile->execute([':id' => $id]);
            $path = $stmtFile->fetchColumn();
            if ($path) {
                $full = __DIR__ . '/../../public' . $path;
                if (file_exists($full))
                    unlink($full);
            }

            $stmt = $this->pdo->prepare("DELETE FROM gallery WHERE id = :id");
            $stmt->execute([':id' => $id]);

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('Gallery delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * List user defined static pages from DB with their translated 'page' title
     * Returns array of associative arrays matching front-end shape.
     */
    public function listUserDefinedPages(string $lang = null): array
    {
        $lang = $lang ?? ($_SESSION['locale'] ?? 'sr-Cyrl');
        // map locale to lang code used in text.lang
        $langCode = $this->resolveLang($lang);

        // Fetch pages and their translated title (if any)
        $sql = "
            SELECT u.id,u.new_column, u.href, u.movable, u.static, u.description, t.content AS title, t.lang, u.id AS page_id
            FROM userdefinedpages u
            LEFT JOIN text t ON t.source_table = 'userdefinedpages' AND t.source_id = u.id AND t.field_name = 'page' AND t.lang = :lang
            where u.static = 1
            ORDER BY u.id ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lang' => $langCode]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pages = [];
        foreach ($rows as $r) {
            $name = $r['title'] ?? '';
            // derive file/path from href: remove leading slash and convert to filename
            $href = $r['href'] ?? '/';
            $clean = trim($href, "/");
            $file = $clean === '' ? 'index.php' : ($clean . '.php');
            $path = ($clean === '' ? '' : 'pages/') . $file;

            $pages[] = [
                'id' => (string) ($r['id'] ?? ''),
                'static' => (int) ($r['static'] ?? 1),
                'movable' => isset($r['movable']) ? (bool) $r['movable'] : true,
                'name' => $name ?: $clean ?: 'Početna stranica',
                'href' => $href,
                'path' => $path,
                'file' => $file,
                'new_column' => $r['new_column'] ?? null,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        return $pages;
    }


}
