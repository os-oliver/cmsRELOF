<?php
namespace App\Models;

use App\Controllers\LanguageMapperController;
use App\Database;
use App\Utils\Pivoter;
use PDO;
use RuntimeException;

class AboutUs
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
     * Vrati prvi (ili jedini) about-us zapis - pivotira polja iz text tabele.
     */
    public function list($lang): ?array
    {
        // Uzmi id prvog zapisa (ako postoji)
        $id = (int) $this->pdo->query("SELECT id FROM aboutus ORDER BY id LIMIT 1")->fetchColumn();
        if (!$id)
            return null;

        return $this->get($id, $lang);
    }



    /**
     * Vrati sve aboutus zapise pivot-ovane (text polja).
     */
    public function listAll(string $lang = 'sr-Cyrl'): array
    {
        $sql = "
            SELECT a.id, a.created_at, t.field_name, t.content
            FROM aboutus a
            LEFT JOIN text t ON t.source_id = a.id
              AND t.source_table = 'aboutus'
              AND t.lang = :lang COLLATE utf8mb4_unicode_ci
            ORDER BY a.id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lang' => $lang]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
    }

    /**
     * Dobi jedan zapis (pivot-ovan). Vraća null ako ne postoji.
     */
    public function get(int $id, $lang): ?array
    {
        $sql = "
            SELECT a.*, t.field_name, t.content
            FROM aboutus a
            LEFT JOIN text t ON t.source_id = a.id
                AND t.source_table = 'aboutus'
                and t.lang = :lang COLLATE utf8mb4_unicode_ci
            WHERE a.id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id, ':lang' => $lang]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$rows)
            return null;

        // Pivotiraj text polja
        $pivoted = (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
        $firstPivot = reset($pivoted) ?: [];

        // Extract non-text columns from the first row
        $meta = [];
        foreach ($rows as $r) {
            foreach ($r as $k => $v) {
                if ($k !== 'field_name' && $k !== 'content') {
                    $meta[$k] = $v;
                }
            }
            break;
        }

        return array_merge($meta, $firstPivot);
    }

    /**
     * Kreira novi aboutus zapis — sprema samo minimalne kolone u aboutus tablu
     * dok se text polja (mission/goal) ubacuju u text tabelu sa varijantama.
     */
    public function insert(array $data): int
    {
        $missionRaw = trim((string) ($data['mission'] ?? ''));
        $goalRaw = trim((string) ($data['goal'] ?? ''));

        if ($missionRaw === '' && $goalRaw === '') {
            throw new RuntimeException('Mission ili goal mora biti postavljen.');
        }

        try {
            $this->pdo->beginTransaction();

            // Ubaci osnovni aboutus zapis (može se prilagoditi da sadrži više kolona ako treba)
            $stmt = $this->pdo->prepare("INSERT INTO aboutus (created_at) VALUES (NOW())");
            $stmt->execute();
            $aboutId = (int) $this->pdo->lastInsertId();

            // Ubaci varijante u text tabelu
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $missionVariants = $this->transliterateVariants($missionRaw, $locale);
            $goalVariants = $this->transliterateVariants($goalRaw, $locale);

            $stmtText = $this->pdo->prepare("
                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'aboutus', :field_name, :lang, :content)
            ");

            $insertField = function (string $field, array $variants) use ($stmtText, $aboutId) {
                foreach ($variants as $lg => $content) {
                    $content = trim((string) $content);
                    if ($content === '')
                        continue;
                    $stmtText->execute([
                        ':source_id' => $aboutId,
                        ':field_name' => $field,
                        ':lang' => $lg,
                        ':content' => $content,
                    ]);
                }
            };

            $insertField('mission', $missionVariants);
            $insertField('goal', $goalVariants);

            $this->pdo->commit();
            return $aboutId;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('AboutUs insert failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update: zamenimo text zapise za dati aboutus id (mission/goal).
     */
    public function update(int $id, array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Obriši postojeće text zapise za ovaj source
            $stmtDel = $this->pdo->prepare("DELETE FROM text WHERE source_id = :id AND source_table = 'aboutus'");
            $stmtDel->execute([':id' => $id]);

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $missionVariants = $this->transliterateVariants((string) ($data['mission'] ?? ''), $locale);
            $goalVariants = $this->transliterateVariants((string) ($data['goal'] ?? ''), $locale);

            $stmtText = $this->pdo->prepare("
                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'aboutus', :field_name, :lang, :content)
            ");

            foreach (['mission' => $missionVariants, 'goal' => $goalVariants] as $field => $variants) {
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
            error_log('AboutUs update failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Briše aboutus zapis i pripadajuće text redove.
     */
    public function delete(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmtText = $this->pdo->prepare("DELETE FROM text WHERE source_id = :id AND source_table = 'aboutus'");
            $stmtText->execute([':id' => $id]);

            $stmt = $this->pdo->prepare("DELETE FROM aboutus WHERE id = :id");
            $stmt->execute([':id' => $id]);

            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('AboutUs delete failed: ' . $e->getMessage());
            return false;
        }
    }
}
