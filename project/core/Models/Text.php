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
     * Ubacuje JSON podatke u tabelu 'staticText' sa originalnim i ćiriličnim tekstom.
     * @param array $jsonData - asocijativni niz tipa ["0" => "Menu", "1" => "KULTURNI NEXUS", ...]
     */
    public function insertFromJson(array $jsonData): void
    {
        try {
            // Truncate tabele
            $this->pdo->exec("TRUNCATE TABLE staticText");

            // Pripremi insert upit (dodali smo kolonu 'lang')
            $stmt = $this->pdo->prepare(
                "INSERT INTO staticText (id, content, lan) VALUES (:id, :content, :lang)"
            );

            foreach ($jsonData as $id => $content) {
                // Ubacivanje originalnog teksta (sr)
                $stmt->execute([
                    ':id' => (int) $id,
                    ':content' => $content,
                    ':lang' => 'sr'
                ]);

                // Ubacivanje ćiriličnog teksta (sr-Cyrl)
                $contentCyrl = $this->langMapper->latin_to_cyrillic($content);
                $stmt->execute([
                    ':id' => (int) $id,
                    ':content' => $contentCyrl,
                    ':lang' => 'sr-Cyrl'
                ]);
            }

            echo "Podaci su uspešno ubačeni.\n";

        } catch (PDOException $e) {
            echo "Greška prilikom ubacivanja: " . $e->getMessage();
        }
    }

    public function getDynamicText(string $lang = 'sr'): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, content FROM staticText WHERE lan = :lang ORDER BY id ASC");
            $stmt->execute([':lang' => $lang]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dynamicText = [];
            foreach ($rows as $row) {
                $dynamicText[$row['id']] = $row['content'];
            }

            return $dynamicText;
        } catch (PDOException $e) {
            echo "Greška prilikom čitanja: " . $e->getMessage();
            return [];
        }
    }
}
