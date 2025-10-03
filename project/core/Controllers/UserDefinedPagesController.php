<?php
namespace App\Controllers;

use App\Database;
use App\Controllers\LanguageMapperController;
use PDO;

class UserDefinedPagesController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->GetPDO();
    }

    /**
     * Sync pages array (from pages.json) into userdefinedpages + text tables.
     * This will insert new pages and update text entries (page title) for available languages.
     * Expects $pages to be an array of page objects with at least: href, file, name, movable, static
     * Returns array with summary (inserted/updated/skipped)
     */
    public function syncPagesFromJson(array $pages): array
    {
        $summary = ['inserted' => 0, 'updated' => 0, 'skipped' => 0];

        foreach ($pages as $page) {
            // Normalize
            $href = isset($page['href']) ? trim($page['href']) : null;
            $file = isset($page['file']) ? trim($page['file']) : null;
            $name = isset($page['name']) ? trim($page['name']) : '';
            $movable = isset($page['movable']) ? (int) (bool) $page['movable'] : 1;
            $static = isset($page['static']) ? (int) (bool) $page['static'] : 1;

            if (!$href || !$file) {
                $summary['skipped']++;
                continue;
            }

            // Check if entry exists by href or file
            $stmt = $this->pdo->prepare("SELECT id FROM userdefinedpages WHERE href = :href OR description = :file LIMIT 1");
            $stmt->execute([':href' => $href, ':file' => $file]);
            $existingId = $stmt->fetchColumn();

            if ($existingId) {
                // update movable/static/description (store file name in description for backward compatibility)
                $descriptionValue = $file;
                $columnValue = $page['column'] ?? null;
                $up = $this->pdo->prepare("UPDATE userdefinedpages SET movable = :movable, static = :static, description = :description, new_column = :new_column WHERE id = :id");
                $up->execute([':movable' => $movable, ':static' => $static, ':description' => $descriptionValue, ':new_column' => $columnValue, ':id' => $existingId]);
                $this->upsertTextEntries((int) $existingId, $name);
                $summary['updated']++;
            } else {
                // insert
                $descriptionValue = $file;
                $columnValue = $page['column'] ?? null;
                $ins = $this->pdo->prepare("INSERT INTO userdefinedpages (href, description, movable, static, new_column) VALUES (:href, :description, :movable, :static, :new_column)");
                $ins->execute([':href' => $href, ':description' => $descriptionValue, ':movable' => $movable, ':static' => $static, ':new_column' => $columnValue]);
                $newId = (int) $this->pdo->lastInsertId();
                $this->upsertTextEntries($newId, $name);
                $summary['inserted']++;
            }
        }

        return $summary;
    }

    /**
     * Return list of pages from database as array suitable for the frontend.
     * Will include: id, href, description (file), movable, static, file (from description), name (best-effort)
     */
    public function getPages(): array
    {
        // Try to prefer session locale when selecting title
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

        // Get pages
        $stmt = $this->pdo->query("SELECT id, href, description, movable, static, created_at, new_column FROM userdefinedpages ORDER BY id ASC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $r) {
            $id = (int) $r['id'];
            $descriptionField = $r['description'] ?? '';
            $file = '';
            $columnName = $r['new_column'] ?? null;
            // description may be a JSON payload we created: {file:..., column:...}
            if ($descriptionField) {
                $decoded = @json_decode($descriptionField, true);
                if (is_array($decoded) && isset($decoded['file'])) {
                    $file = $decoded['file'];
                    // only use decoded column if new_column is empty
                    if ($columnName === null)
                        $columnName = $decoded['column'] ?? null;
                } else {
                    // fallback to legacy behavior where description held the filename
                    $file = $descriptionField;
                }
            }

            // Try to fetch title from text table for preferred locale, fallback to any available
            $title = null;
            $t = $this->pdo->prepare("SELECT content, lang FROM text WHERE source_id = :id AND source_table = 'userdefinedpages' AND field_name = 'page'");
            $t->execute([':id' => $id]);
            $texts = $t->fetchAll(PDO::FETCH_ASSOC);
            if ($texts) {
                // try exact locale
                foreach ($texts as $tt) {
                    if ($tt['lang'] === $locale) {
                        $title = $tt['content'];
                        break;
                    }
                }
                // fallback to first
                if ($title === null)
                    $title = $texts[0]['content'];
            }

            $result[] = [
                'id' => (string) $id,
                'href' => $r['href'],
                'description' => $descriptionField,
                'movable' => (bool) $r['movable'],
                'static' => (bool) $r['static'],
                'file' => $file,
                'name' => $title ?? '',
                'column' => $columnName,
                'created_at' => $r['created_at'] ?? null,
            ];
        }

        return $result;
    }

    /**
     * Delete page by page id or href. Accepts either numeric id or href string.
     */
    public function deleteByIdentifier(string|int $identifier): bool
    {
        try {
            if (is_numeric($identifier)) {
                $id = (int) $identifier;
            } else {
                $stmt = $this->pdo->prepare("SELECT id FROM userdefinedpages WHERE href = :href LIMIT 1");
                $stmt->execute([':href' => $identifier]);
                $id = (int) $stmt->fetchColumn();
                if (!$id)
                    return false;
            }

            $this->pdo->beginTransaction();

            // delete text rows
            $delText = $this->pdo->prepare("DELETE FROM text WHERE source_id = :id AND source_table = 'userdefinedpages'");
            $delText->execute([':id' => $id]);

            // delete translations if any (text_translations usage may vary)
            $delTrans = $this->pdo->prepare("DELETE FROM text_translations WHERE entry_id LIKE :entryId");
            $delTrans->execute([':entryId' => 'userdefinedpages.' . $id . '%']);

            // delete page
            $delPage = $this->pdo->prepare("DELETE FROM userdefinedpages WHERE id = :id");
            $delPage->execute([':id' => $id]);

            $this->pdo->commit();
            return true;
        } catch (\Throwable $e) {
            try {
                $this->pdo->rollBack();
            } catch (\Throwable $_) {
            }
            error_log('Delete userdefinedpage failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Insert or update text entries for the 'page' field in 'text' table for multiple languages.
     * Uses session locale to generate transliterations similar to Page model.
     */
    private function upsertTextEntries(int $sourceId, string $pageName): void
    {
        // Simple behavior: delete existing text rows for this source and re-insert for language variants
        $del = $this->pdo->prepare("DELETE FROM text WHERE source_id = :id AND source_table = 'userdefinedpages'");
        $del->execute([':id' => $sourceId]);

        // Determine language variants — mimic Page::transliterateVariants behavior lightly
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
        $variants = [];
        if ($locale === 'sr-Cyrl') {
            $variants['sr-Cyrl'] = $pageName;
            // try cyrillic->latin if mapper exists
            if (class_exists(LanguageMapperController::class)) {
                $mapper = new LanguageMapperController();
                $variants['sr'] = $mapper->cyrillic_to_latin($pageName);
            }
        } elseif ($locale === 'sr' || $locale === 'sr-Latn') {
            $variants['sr'] = $pageName;
            if (class_exists(LanguageMapperController::class)) {
                $mapper = new LanguageMapperController();
                $variants['sr-Cyrl'] = $mapper->latin_to_cyrillic($pageName);
            }
        } else {
            $variants['en'] = $pageName;
        }

        $stmt = $this->pdo->prepare("INSERT INTO text (source_id, source_table, field_name, lang, content) VALUES (:source_id, 'userdefinedpages', 'page', :lang, :content)");
        foreach ($variants as $lang => $content) {
            $c = trim((string) $content);
            if ($c === '')
                continue;
            $stmt->execute([':source_id' => $sourceId, ':lang' => $lang, ':content' => $c]);
        }
    }
}
