<?php
namespace App\Models;

use App\Controllers\LanguageMapperController;
use App\Database;
use App\Utils\Pivoter;
use PDO;

class Event
{
    private PDO $pdo;
    private Pivoter $pivoter;

    public function __construct()
    {
        $this->pdo = (new Database())->GetPDO();
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

        $this->pivoter = new Pivoter('field_name', 'content', 'id');

    }

    // Mapiranje locale → lang kod (default sr-Cyrl)
    private function resolveLang(string $locale): string
    {
        return match ($locale) {
            'sr-Cyrl' => 'sr-Cyrl',
            'sr' => 'sr',
            'sr-Latn' => 'sr',
            'en' => 'en',
            default => 'sr-Cyrl',
        };
    }

    // Generiše varijante (ćirilica/latinica) samo za srpski; za ostale jezike vraća original pod resolveLang(locale)
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

        // Za ostale jezike — ubaci original pod normalizovan kodom
        $lang = $this->resolveLang($locale);
        return [$lang => $text];
    }

    public function getCategories(): array
    {
        $sql = "
            SELECT k.*, t.field_name, t.content, t.id AS text_id
            FROM kategorije_dogadjaja k
            LEFT JOIN text t 
                ON t.source_id = k.id 
                AND t.source_table = 'kategorije_dogadjaja'
        ";

        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return (new Pivoter('field_name', 'content', 'id'))->pivot($rows);
    }

    /**
     * Lista događaja — koristi text tabelu za title/description i paginaciju preko subquery-a.
     * Vraća [pivotirani_podaci, total_count]
     */
    public function all(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $category = '',
        string $status = '',
        string $sort = 'date_desc',
        string $lang = 'sr-Cyrl'
    ): array {
        // parametri koji će se bind-ovati (jezik se koristi u podupitima za text)
        $params = [
            ':lang' => $lang,
            ':lang1' => $lang,
        ];

        // --- WHERE delovi ---
        $whereParts = [];
        if ($search !== '') {
            // Use subquery searching text table for events (matches Document::list behavior)
            $whereParts[] = "id IN (
            SELECT DISTINCT t.source_id
            FROM text t
            WHERE t.source_table = 'events'
              AND t.content LIKE :search
        )";
            $params[':search'] = "%{$search}%";
        }
        if ($category !== '') {
            $whereParts[] = "e.category_id = :category";
            $params[':category'] = (int) $category;
        }
        if ($status !== '') {
            $whereParts[] = "e.status = :status";
            $params[':status'] = $status;
        }
        // Složimo WHERE klauzulu (ako ima uslova)
        $whereSql = $whereParts ? 'WHERE ' . implode(' AND ', $whereParts) : '';

        // --- VALIDACIJA offset/limit i Overflow detekcija ---
        try {
            if (!is_numeric($offset) || !is_numeric($limit)) {
                throw new \InvalidArgumentException('Offset i limit moraju biti numerički.');
            }

            $offsetFloat = (float) $offset;
            $limitFloat = (float) $limit;

            if ($offsetFloat > PHP_INT_MAX || $limitFloat > PHP_INT_MAX) {
                throw new \OverflowException('Offset ili limit prelazi opseg integera.');
            }

            $offsetInt = (int) $offsetFloat;
            $limitInt = (int) $limitFloat;

            // sigurnosne granice
            $maxLimit = 10000;
            if ($limitInt < 0)
                $limitInt = 0;
            if ($offsetInt < 0)
                $offsetInt = 0;
            if ($limitInt > $maxLimit)
                $limitInt = $maxLimit;

        } catch (\OverflowException $oe) {
            // fallback vrednosti pri overflow-u
            // error_log($oe->getMessage());
            $offsetInt = 0;
            $limitInt = 100;
        } catch (\Exception $e) {
            // drugi problemi sa validacijom -> safe defaults
            // error_log($e->getMessage());
            $offsetInt = 0;
            $limitInt = 100;
        }

        // --- GLAVNI UPIT: prvo limitiramo događaje po id-u, pa join-ujemo ostalo ---
        $sql = "
SELECT
    e.id,
    e.category_id,
    e.image,
    e.location,
    e.date,
    e.time,
    te.field_name,
    te.content,
    ct.content AS naziv,
    k.color_code
FROM
    (SELECT id FROM events
        {$whereSql}
        LIMIT {$offsetInt}, {$limitInt}
    ) pe
JOIN events e ON e.id = pe.id
LEFT JOIN (
        SELECT t.source_id, t.field_name,
            COALESCE(
                MAX(CASE WHEN t.lang = :lang THEN t.content END),
                MAX(CASE WHEN t.lang = 'sr-Cyrl' THEN t.content END)
            ) AS content
        FROM text t
        WHERE t.source_table = 'events' AND t.lang IN (:lang, 'sr-Cyrl')
        GROUP BY t.source_id, t.field_name
) te ON te.source_id = e.id
JOIN kategorije_dogadjaja k ON k.id = e.category_id
LEFT JOIN (
        SELECT t.source_id,
            COALESCE(
                MAX(CASE WHEN t.lang = :lang1 THEN t.content END),
                MAX(CASE WHEN t.lang = 'sr-Cyrl' THEN t.content END)
            ) AS content
        FROM text t
        WHERE t.source_table = 'kategorije_dogadjaja' AND t.lang IN (:lang1, 'sr-Cyrl')
        GROUP BY t.source_id
) ct ON ct.source_id = k.id
ORDER BY e.date DESC, e.time DESC, te.field_name;
";
        error_log("SQLSSSSS:" . $sql);
        try {
            $stmt = $this->pdo->prepare($sql);

            // bind-ujemo jezike i eventualne where parametre
            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
            if (isset($params[':search'])) {
                $stmt->bindValue(':search', $params[':search'], PDO::PARAM_STR);
            }
            if (isset($params[':category'])) {
                $stmt->bindValue(':category', $params[':category'], PDO::PARAM_INT);
            }
            if (isset($params[':status'])) {
                $stmt->bindValue(':status', $params[':status'], PDO::PARAM_STR);
            }

            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            error_log('Event query failed: ' . $e->getMessage());
            $rows = [];
        }

        // ukupno (broj događaja posle filtera, bez limit-a)
        try {
            $countSql = "SELECT COUNT(*) FROM events e {$whereSql}";
            $countStmt = $this->pdo->prepare($countSql);
            foreach ($params as $k => $v) {
                if (strpos($countSql, $k) === false)
                    continue;
                $countStmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
            $countStmt->execute();
            $total = (int) $countStmt->fetchColumn();
        } catch (\PDOException $e) {
            error_log('Event count failed: ' . $e->getMessage());
            $total = 0;
        }

        // pivotujemo rezultate
        return [$this->pivoter->pivot($rows), $total];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Kreiraj događaj — title/description se ubacuju u text tabelu sa varijantama zavisno od locale.
     * Vraća ID novog događaja (int) ili 0 na grešku.
     */
    public function create(array $data): int
    {
        try {
            $this->pdo->beginTransaction();

            $imagePath = isset($data['filepath']) && $data['filepath'] !== ''
                ? '/uploads/images/' . basename($data['filepath'])
                : null;

            $stmt = $this->pdo->prepare("
                INSERT INTO events (image, category_id, location, date, time, created_at)
                VALUES (:image, :category, :location, :date, :time, NOW())
            ");
            $stmt->execute([
                ':image' => $imagePath,
                ':category' => $data['category'] ?? null,
                ':location' => $data['location'] ?? '',
                ':date' => $data['date'] ?? null,
                ':time' => $data['time'] ?? null,
            ]);

            $eventId = (int) $this->pdo->lastInsertId();

            // determine locale and transliteration variants
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $titleRaw = (string) ($data['title'] ?? '');
            $descRaw = (string) ($data['description'] ?? '');
            $titleVariants = $this->transliterateVariants($titleRaw, $locale);
            $descVariants = $this->transliterateVariants($descRaw, $locale);

            $stmtText = $this->pdo->prepare("
                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'events', :field_name, :lang, :content)
            ");

            $insertField = function (string $fieldName, array $variants) use ($stmtText, $eventId) {
                foreach ($variants as $lang => $content) {
                    $content = trim((string) $content);
                    if ($content === '')
                        continue;
                    $stmtText->execute([
                        ':source_id' => $eventId,
                        ':field_name' => $fieldName,
                        ':lang' => $lang,
                        ':content' => $content,
                    ]);
                }
            };

            $insertField('title', $titleVariants);
            $insertField('description', $descVariants);

            $this->pdo->commit();
            error_log("Event created with ID: $eventId");
            return $eventId;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Event create failed: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Update — events table + text table (ON DUPLICATE KEY UPDATE)
     */
    public function update(int $id, array $data): bool
    {
        try {
            $this->pdo->beginTransaction();

            // optionally update image only if provided
            if (isset($data['filepath']) && $data['filepath'] !== '') {
                $imagePath = '/uploads/images/' . basename($data['filepath']);
            } else {
                $imagePath = null;
            }

            $stmtSql = "
                UPDATE events
                SET category_id = :category,
                    location = :location,
                    date = :date,
                    time = :time
            ";

            if ($imagePath !== null) {
                $stmtSql .= ", image = :image";
            }

            $stmtSql .= " WHERE id = :id";

            $params = [
                ':id' => $id,
                ':category' => $data['category'] ?? null,
                ':location' => $data['location'] ?? '',
                ':date' => $data['date'] ?? null,
                ':time' => $data['time'] ?? null,
            ];
            if ($imagePath !== null)
                $params[':image'] = $imagePath;

            $stmt = $this->pdo->prepare($stmtSql);
            $success = $stmt->execute($params);

            // prepare text upserts
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $titleRaw = (string) ($data['title'] ?? '');
            $descRaw = (string) ($data['description'] ?? '');
            $titleVariants = $this->transliterateVariants($titleRaw, $locale);
            $descVariants = $this->transliterateVariants($descRaw, $locale);

            $stmtText = $this->pdo->prepare("
                INSERT INTO text (source_id, source_table, field_name, lang, content)
                VALUES (:source_id, 'events', :field_name, :lang, :content)
                ON DUPLICATE KEY UPDATE content = :content_update
            ");

            $updateField = function (string $fieldName, array $variants) use ($stmtText, $id) {
                foreach ($variants as $lang => $content) {
                    $content = trim((string) $content);
                    if ($content === '')
                        continue;
                    $stmtText->execute([
                        ':source_id' => $id,
                        ':field_name' => $fieldName,
                        ':lang' => $lang,
                        ':content' => $content,
                        ':content_update' => $content,
                    ]);
                }
            };

            $updateField('title', $titleVariants);
            $updateField('description', $descVariants);

            $this->pdo->commit();
            return (bool) $success;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log('Event update failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete — obrisi text zapise, fajl (ako postoji) i zapis iz events tabele
     */
    public function delete(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            // obriši text zapise vezane za event
            $stmtText = $this->pdo->prepare("
                DELETE FROM text
                WHERE source_id = :id
                AND source_table = 'events'
            ");
            $stmtText->execute([':id' => $id]);

            // obrisi image sa diska, ako postoji
            $stmtFile = $this->pdo->prepare("SELECT image FROM events WHERE id = :id");
            $stmtFile->execute([':id' => $id]);
            $imagePath = $stmtFile->fetchColumn();

            if ($imagePath) {
                $fullPath = __DIR__ . '/../../public' . $imagePath;
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            // obrisi event
            $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = :id");
            $result = $stmt->execute([':id' => $id]);

            $this->pdo->commit();
            return (bool) $result;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log('Event delete failed: ' . $e->getMessage());
            return false;
        }
    }
}
