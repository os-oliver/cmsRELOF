<?php
namespace App\Models;

use App\Controllers\LanguageMapperController;
use App\Database;
use App\Utils\Pivoter;
use PDO;

class Gallery
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

    // Generiše varijante (ćirilica/latinica) samo za srpski; za ostale jezike vraća original
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


    public function find(int $id): ?array
    {
        $sql = "
            SELECT g.*, t.field_name, t.content
            FROM gallery g
            LEFT JOIN text t ON t.source_id = g.id
                AND t.source_table = 'gallery'
            WHERE g.id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows)
            return null;

        $pivoted = (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
        // pivot returns an array keyed by id; we want the first item's fields merged with gallery columns
        $first = reset($pivoted);

        // Merge gallery columns (they are present in the first row)
        $galleryCols = [];
        foreach ($rows as $r) {
            foreach ($r as $k => $v) {
                if (!in_array($k, ['field_name', 'content'])) {
                    $galleryCols[$k] = $v;
                }
            }
            break;
        }

        return array_merge($galleryCols, $first ?: []);
    }

    public function create(array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("\n                INSERT INTO gallery (image_file_path, uploaded_at)
                VALUES (:image_file_path, NOW())\n            ");
            $stmt->execute([
                ':image_file_path' => '/uploads/gallery/' . ($data['image_file_path'] ?? ''),
            ]);

            $galleryId = $this->pdo->lastInsertId();

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $titleVariants = $this->transliterateVariants((string) ($data['title'] ?? ''), $locale);
            $descVariants = $this->transliterateVariants((string) ($data['description'] ?? ''), $locale);

            $stmtText = $this->pdo->prepare("\n                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'gallery', :field_name, :lang, :content)\n            ");

            $insertField = function (string $fieldName, array $variants) use ($stmtText, $galleryId) {
                foreach ($variants as $lang => $content) {
                    $content = trim((string) $content);
                    if ($content === '')
                        continue;
                    $stmtText->execute([
                        ':source_id' => $galleryId,
                        ':field_name' => $fieldName,
                        ':lang' => $lang,
                        ':content' => $content,
                    ]);
                }
            };

            $insertField('title', $titleVariants);
            $insertField('description', $descVariants);

            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Gallery insert failed: ' . $e->getMessage());
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
     * Search over text content for gallery (multilingual)
     */
    public function search(string $term, string $lang = 'sr-Cyrl'): array
    {
        $sql = "
            SELECT g.id, g.image_file_path, g.uploaded_at, t.field_name, t.content
            FROM gallery g
            JOIN text t ON t.source_id = g.id
              AND t.source_table = 'gallery'
              AND t.lang = :lang COLLATE utf8mb4_unicode_ci
            WHERE t.content LIKE :search
            ORDER BY g.uploaded_at DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lang' => $lang, ':search' => "%{$term}%"]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
    }
}
