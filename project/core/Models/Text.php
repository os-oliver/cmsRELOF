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

                // Ubaci u text_entries
                $stmtEntry->execute([
                    ':id' => $id,
                    ':original_text' => $original,
                    ':dom_path' => $domPath,
                    ':tag' => $tag
                ]);

                // Ubaci prevod sr (latinica)
                $stmtTrans->execute([
                    ':entry_id' => $id,
                    ':lang' => 'sr',
                    ':translated_text' => $original
                ]);

                // Ubaci prevod sr-Cyrl (ćirilica) koristeći langMapper
                $contentCyrl = $this->langMapper->latin_to_cyrillic($original);
                $stmtTrans->execute([
                    ':entry_id' => $id,
                    ':lang' => 'sr-Cyrl',
                    ':translated_text' => $contentCyrl
                ]);
            }

            echo "Podaci su uspešno ubačeni.\n";

        } catch (PDOException $e) {
            echo "Greška prilikom ubacivanja: " . $e->getMessage();
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

    /**
     * Batch update dynamic texts
     */
    public function batchUpdateDynamicTexts(array $texts): void
    {
        try {
            $this->pdo->beginTransaction();

            $stmtCheck = $this->pdo->prepare("SELECT id FROM text_entries WHERE id = ?");
            $stmtInsert = $this->pdo->prepare("
                INSERT INTO text_entries (id, original_text, dom_path, tag) 
                VALUES (:id, :original_text, :dom_path, :tag)
            ");
            $stmtUpdate = $this->pdo->prepare("
                UPDATE text_entries 
                SET original_text = :original_text,
                    dom_path = :dom_path,
                    tag = :tag
                WHERE id = :id
            ");

            $stmtTrans = $this->pdo->prepare("
                INSERT INTO text_translations (entry_id, lang, translated_text)
                VALUES (:entry_id, :lang, :translated_text)
                ON DUPLICATE KEY UPDATE translated_text = VALUES(translated_text)
            ");

            foreach ($texts as $text) {
                $stmtCheck->execute([$text['id']]);
                $exists = $stmtCheck->fetch();

                $params = [
                    ':id' => $text['id'],
                    ':original_text' => $text['content'],
                    ':dom_path' => $text['path'] ?? '',
                    ':tag' => $text['tag'] ?? ''
                ];

                if ($exists) {
                    $stmtUpdate->execute($params);
                } else {
                    $stmtInsert->execute($params);
                }

                // Ubaci prevod sr (latinica)
                $stmtTrans->execute([
                    ':entry_id' => $text['id'],
                    ':lang' => 'sr',
                    ':translated_text' => $text['content']
                ]);

                // Ubaci prevod sr-Cyrl (ćirilica)
                $contentCyrl = $this->langMapper->latin_to_cyrillic($text['content']);
                $stmtTrans->execute([
                    ':entry_id' => $text['id'],
                    ':lang' => 'sr-Cyrl',
                    ':translated_text' => $contentCyrl
                ]);
            }

            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    /**
     * Get texts by path pattern
     */
    public function getTextsByPath(string $pathPattern, string $lang = 'sr'): array
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT te.id, tt.translated_text, te.original_text, te.dom_path, te.tag
                FROM text_entries te
                LEFT JOIN text_translations tt 
                    ON te.id = tt.entry_id AND tt.lang = :lang
                WHERE te.dom_path LIKE :path_pattern
                ORDER BY te.id ASC
            ");

            $stmt->execute([
                ':lang' => $lang,
                ':path_pattern' => '%' . $pathPattern . '%'
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Greška prilikom čitanja: " . $e->getMessage();
            return [];
        }
    }
}
