<?php
namespace App\Models;

use App\Database;
use PDO;
use PDOException;
use App\Controllers\LanguageMapperController;

class Text
{
    private PDO $pdo;
    private LanguageMapperController $langMapper;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
        $this->langMapper = new LanguageMapperController();
    }

    /**
     * Ubacuje JSON podatke u tabele 'text_entries' i 'text_translations'.
     * @param array $jsonData - asocijativni niz tipa ["t_abc123..." => ["original" => "Menu", "dom_path" => "/h1[1]", "tag" => "h1"], ...]
     */
    public function insertFromJson(array $jsonData): void
    {
        try {
            $this->pdo->beginTransaction();

            $stmtEntry = $this->pdo->prepare(
                "INSERT INTO text_entries (id, original_text, dom_path, tag) 
                 VALUES (:id, :original_text, :dom_path, :tag)
                 ON DUPLICATE KEY UPDATE original_text = VALUES(original_text), dom_path = VALUES(dom_path), tag = VALUES(tag)"
            );

            $stmtTrans = $this->pdo->prepare(
                "INSERT INTO text_translations (entry_id, lang, translated_text)
                 VALUES (:entry_id, :lang, :translated_text)
                 ON DUPLICATE KEY UPDATE translated_text = VALUES(translated_text)"
            );

            foreach ($jsonData as $id => $data) {
                $original = $data['original'] ?? '';
                $domPath = $data['dom_path'] ?? '';
                $tag = $data['tag'] ?? '';

                // Validate data before insertion
                if (empty($id) || empty($original) || empty($domPath) || empty($tag)) {
                    error_log("Invalid data for text entry: " . json_encode($data));
                    continue;
                }

                // Insert into text_entries
                $stmtEntry->execute([
                    ':id' => $id,
                    ':original_text' => $original,
                    ':dom_path' => $domPath,
                    ':tag' => $tag
                ]);

                // Insert translation for Serbian Latin
                $stmtTrans->execute([
                    ':entry_id' => $id,
                    ':lang' => 'sr',
                    ':translated_text' => $original
                ]);

                // Insert translation for Serbian Cyrillic
                $contentCyrl = $this->langMapper->latin_to_cyrillic($original);
                $stmtTrans->execute([
                    ':entry_id' => $id,
                    ':lang' => 'sr-Cyrl',
                    ':translated_text' => $contentCyrl
                ]);
            }

            $this->pdo->commit();
            echo "Podaci su uspešno ubačeni.\n";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Greška prilikom ubacivanja: " . $e->getMessage());
        }
    }

    /**
     * Dohvati sve prevode po jeziku.
     */
    public function getDynamicText(string $lang = 'sr'): array
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT te.id, tt.translated_text, te.original_text, te.dom_path, te.tag
                FROM text_entries te
                LEFT JOIN text_translations tt 
                  ON te.id = tt.entry_id AND tt.lang = :lang
                ORDER BY te.id ASC
            ");
            $stmt->execute([':lang' => $lang]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dynamicText = [];
            foreach ($rows as $row) {
                $dynamicText[$row['id']] = [
                    'text' => $row['translated_text'] ?? $row['original_text'],
                    'path' => $row['dom_path'],
                    'tag' => $row['tag']
                ];
            }

            return $dynamicText;
        } catch (PDOException $e) {
            echo "Greška prilikom čitanja: " . $e->getMessage();
            return [];
        }
    }

    public function batchUpdateDynamicTexts(array $texts): void
    {
        // debug log file for tracing batch updates
        $logFile = __DIR__ . '/../../public/exportedPages/log.txt';

        try {
            $this->pdo->beginTransaction();
            file_put_contents($logFile, "\n[batchUpdateDynamicTexts] starting batch of " . count($texts) . " items\n", FILE_APPEND | LOCK_EX);

            $stmtCheck = $this->pdo->prepare("
            SELECT id FROM text_entries 
            WHERE page_slug = :page_slug 
              AND dom_path = :dom_path 
              AND tag = :tag
        ");

            $stmtCheckId = $this->pdo->prepare("
            SELECT id FROM text_entries WHERE id = :id
        ");

            $stmtInsert = $this->pdo->prepare("
            INSERT INTO text_entries (id, page_slug, original_text, text_hash, dom_path, path_hash, tag, created_at, updated_at) 
            VALUES (:id, :page_slug, :original_text, :text_hash, :dom_path, :path_hash, :tag, NOW(), NOW())
        ");

            $stmtUpdateTextOnly = $this->pdo->prepare("
            UPDATE text_entries 
            SET original_text = :original_text,
                text_hash = :text_hash,
                updated_at = NOW()
            WHERE id = :id
        ");

            // Move translations from old_id to new_id
            $stmtMoveTranslations = $this->pdo->prepare("
            UPDATE text_translations
            SET entry_id = :new_id, updated_at = NOW()
            WHERE entry_id = :old_id
        ");

            $stmtDeleteById = $this->pdo->prepare("
            DELETE FROM text_entries WHERE id = :id
        ");

            $stmtTrans = $this->pdo->prepare("
            INSERT INTO text_translations (entry_id, lang, translated_text, created_at, updated_at)
            VALUES (:entry_id, :lang, :translated_text, NOW(), NOW())
            ON DUPLICATE KEY UPDATE 
                translated_text = VALUES(translated_text),
                updated_at = NOW()
        ");

            foreach ($texts as $text) {
                // log incoming text id and snippet
                $logMsg = sprintf(
                    "[batch] incoming id=%s page_slug=%s tag=%s dom_path=%s content=%s\n",
                    $text['id'] ?? 'NULL',
                    $text['page_slug'] ?? 'NULL',
                    $text['tag'] ?? 'NULL',
                    substr($text['path'] ?? '', 0, 80),
                    substr($text['content'] ?? '', 0, 80)
                );
                file_put_contents($logFile, $logMsg, FILE_APPEND | LOCK_EX);
                $incomingId = $text['id'];
                $pageSlug = $text['page_slug'];
                $domPath = $text['path'];
                $tag = $text['tag'];
                $content = $text['content'];
                $textHash = $text['text_hash'] ?? md5($content);
                $pathHash = $text['path_hash'] ?? substr(md5($domPath), 0, 12);

                // find existing by slug+dom_path+tag
                $stmtCheck->execute([
                    ':page_slug' => $pageSlug,
                    ':dom_path' => $domPath,
                    ':tag' => $tag
                ]);
                $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);

                if ($existing) {
                    $oldId = $existing['id'];

                    file_put_contents($logFile, "[batch] found existing id=" . $oldId . " for dom_path=" . substr($domPath, 0, 80) . "\n", FILE_APPEND | LOCK_EX);

                    if ($oldId === $incomingId) {
                        // isti id: samo update teksta
                        $stmtUpdateTextOnly->execute([
                            ':id' => $oldId,
                            ':original_text' => $content,
                            ':text_hash' => $textHash
                        ]);
                        $entryId = $oldId;
                        file_put_contents($logFile, "[batch] updated existing same-id=" . $entryId . "\n", FILE_APPEND | LOCK_EX);
                    } else {
                        // različiti id-ovi: proveri da li incomingId već postoji
                        $stmtCheckId->execute([':id' => $incomingId]);
                        $idExists = $stmtCheckId->fetch(PDO::FETCH_ASSOC);

                        if ($idExists) {
                            // collision: incomingId već postoji -> merge u target
                            $stmtUpdateTextOnly->execute([
                                ':id' => $incomingId,
                                ':original_text' => $content,
                                ':text_hash' => $textHash
                            ]);

                            // premesti prevode sa oldId na incomingId
                            $stmtMoveTranslations->execute([
                                ':new_id' => $incomingId,
                                ':old_id' => $oldId
                            ]);

                            // izbriši stari zapis
                            $stmtDeleteById->execute([':id' => $oldId]);

                            $entryId = $incomingId;
                            file_put_contents($logFile, "[batch] merged oldId=" . $oldId . " into existing incomingId=" . $incomingId . "\n", FILE_APPEND | LOCK_EX);
                        } else {
                            // incomingId ne postoji: insert new row (sa incomingId) pa premesti prevode, pa briši stari
                            $stmtInsert->execute([
                                ':id' => $incomingId,
                                ':page_slug' => $pageSlug,
                                ':original_text' => $content,
                                ':text_hash' => $textHash,
                                ':dom_path' => $domPath,
                                ':path_hash' => $pathHash,
                                ':tag' => $tag
                            ]);

                            // sada bezbedno premesti prevode na novi id
                            $stmtMoveTranslations->execute([
                                ':new_id' => $incomingId,
                                ':old_id' => $oldId
                            ]);

                            // obriši stari zapis
                            $stmtDeleteById->execute([':id' => $oldId]);

                            $entryId = $incomingId;
                            file_put_contents($logFile, "[batch] inserted incomingId=" . $incomingId . " and moved translations from oldId=" . $oldId . "\n", FILE_APPEND | LOCK_EX);
                        }
                    }
                } else {
                    // ne postoji zapis: ubaci novi
                    $stmtInsert->execute([
                        ':id' => $incomingId,
                        ':page_slug' => $pageSlug,
                        ':original_text' => $content,
                        ':text_hash' => $textHash,
                        ':dom_path' => $domPath,
                        ':path_hash' => $pathHash,
                        ':tag' => $tag
                    ]);
                    $entryId = $incomingId;
                    file_put_contents($logFile, "[batch] inserted new entryId=" . $entryId . "\n", FILE_APPEND | LOCK_EX);
                }

                // Upsert translations (sr)
                $stmtTrans->execute([
                    ':entry_id' => $entryId,
                    ':lang' => 'sr',
                    ':translated_text' => $content
                ]);

                // Upsert translations (sr-Cyrl)
                $contentCyrl = $this->langMapper->latin_to_cyrillic($content);
                $stmtTrans->execute([
                    ':entry_id' => $entryId,
                    ':lang' => 'sr-Cyrl',
                    ':translated_text' => $contentCyrl
                ]);
                file_put_contents($logFile, "[batch] upsert translations for entryId=" . $entryId . "\n", FILE_APPEND | LOCK_EX);
            }

            $this->pdo->commit();
            file_put_contents($logFile, "[batchUpdateDynamicTexts] committed successfully\n", FILE_APPEND | LOCK_EX);
        } catch (PDOException $e) {
            // log exception and input for debugging
            file_put_contents($logFile, "[batchUpdateDynamicTexts] EXCEPTION: " . $e->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            $this->pdo->rollBack();
            throw $e;
        }
    }



    public function replaceText(string $textId, string $newContent): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Update original text and hashes
            $newTextHash = substr(md5($newContent), 0, 6);
            $stmtUpdate = $this->pdo->prepare("
                UPDATE text_entries 
                SET original_text = :original_text,
                    text_hash = :text_hash,
                    updated_at = NOW()
                WHERE id = :id
            ");

            $result = $stmtUpdate->execute([
                ':id' => $textId,
                ':original_text' => $newContent,
                ':text_hash' => $newTextHash
            ]);

            if ($result && $stmtUpdate->rowCount() > 0) {
                // Update translations
                $stmtTransUpdate = $this->pdo->prepare("
                    UPDATE text_translations 
                    SET translated_text = :translated_text,
                        updated_at = NOW()
                    WHERE entry_id = :entry_id AND lang = :lang
                ");

                // Update Serbian Latin
                $stmtTransUpdate->execute([
                    ':entry_id' => $textId,
                    ':lang' => 'sr',
                    ':translated_text' => $newContent
                ]);

                // Update Serbian Cyrillic
                $contentCyrl = $this->langMapper->latin_to_cyrillic($newContent);
                $stmtTransUpdate->execute([
                    ':entry_id' => $textId,
                    ':lang' => 'sr-Cyrl',
                    ':translated_text' => $contentCyrl
                ]);

                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error replacing text: " . $e->getMessage());
            return false;
        }
    }

    public function deleteText(string $textId): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Delete translations first (foreign key constraint)
            $stmtDeleteTrans = $this->pdo->prepare("DELETE FROM text_translations WHERE entry_id = ?");
            $stmtDeleteTrans->execute([$textId]);

            // Delete text entry
            $stmtDeleteEntry = $this->pdo->prepare("DELETE FROM text_entries WHERE id = ?");
            $result = $stmtDeleteEntry->execute([$textId]);

            if ($result && $stmtDeleteEntry->rowCount() > 0) {
                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error deleting text: " . $e->getMessage());
            return false;
        }
    }

    public function getAllTexts(string $pageSlug = null): array
    {
        $query = "
            SELECT te.id, te.page_slug, te.original_text, te.text_hash, 
                   te.dom_path, te.path_hash, te.tag, te.created_at, te.updated_at,
                   tt.lang, tt.translated_text
            FROM text_entries te
            LEFT JOIN text_translations tt ON te.id = tt.entry_id
        ";

        $params = [];
        if ($pageSlug) {
            $query .= " WHERE te.page_slug = ?";
            $params[] = $pageSlug;
        }

        $query .= " ORDER BY te.id, tt.lang";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cleanupOrphanedTexts(array $currentTextIds): int
    {
        if (empty($currentTextIds)) {
            return 0;
        }

        try {
            $this->pdo->beginTransaction();

            $placeholders = str_repeat('?,', count($currentTextIds) - 1) . '?';

            // Delete orphaned translations
            $stmtDeleteTrans = $this->pdo->prepare("
                DELETE FROM text_translations 
                WHERE entry_id NOT IN ($placeholders)
            ");
            $stmtDeleteTrans->execute($currentTextIds);

            // Delete orphaned entries
            $stmtDeleteEntries = $this->pdo->prepare("
                DELETE FROM text_entries 
                WHERE id NOT IN ($placeholders)
            ");
            $stmtDeleteEntries->execute($currentTextIds);
            $deletedCount = $stmtDeleteEntries->rowCount();

            $this->pdo->commit();
            return $deletedCount;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error cleaning up orphaned texts: " . $e->getMessage());
            return 0;
        }
    }

}
