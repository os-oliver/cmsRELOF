<?php
namespace App\Models;
use App\Database;

class Event
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Dohvata sve kategorije sa imenom i bojom
     */
    public function getCategories(): array
    {
        $sql = "
            SELECT k.id,
                   t.content AS naziv,
                   k.color_code
              FROM kategorije_dogadjaja k
         LEFT JOIN text t 
                ON t.source_id = k.id
               AND t.source_table = 'kategorije_dogadjaja'
               AND t.field_name = 'naziv'
               AND t.lang = 'en'
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Dohvata sve evente sa long-format tekstovima i nazivom kategorije
     */
    /**
     * Dohvata sve evente sa long-format tekstovima i nazivom kategorije
     */
    public function all(
        string $lang = 'sr-Cyrl',
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $sort = 'date_desc'
    ): array {
        $where = [];
        $params = [];

        if ($search !== '') {
            $where[] = "(e.location LIKE :search OR te.content LIKE :search)";
            $params[':search'] = "%{$search}%";
        }

        $order = match ($sort) {
            'date_asc' => "ORDER BY e.date ASC, e.time ASC",
            'title' => "ORDER BY COALESCE(MAX(CASE WHEN te.field_name = 'naziv' THEN te.content END), e.location) ASC",
            default => "ORDER BY e.date DESC, e.time DESC",
        };

        $whereSql = $where ? ' WHERE ' . implode(' AND ', $where) : '';

        // COUNT ukupno događaja
        $countSql = "SELECT COUNT(DISTINCT e.id)
                 FROM events e
                 LEFT JOIN text te
                   ON te.source_table = 'events'
                  AND te.source_id = e.id
                  AND te.lang = :lang_count
                 {$whereSql}";
        $countStmt = $this->pdo->prepare($countSql);
        foreach ($params as $k => $v) {
            $countStmt->bindValue($k, $v, \PDO::PARAM_STR);
        }
        $countStmt->bindValue(':lang_count', $lang, \PDO::PARAM_STR);
        $countStmt->execute();
        $total = (int) $countStmt->fetchColumn();

        // Glavni upit – pivot teksta i kategorija
        $sql = "
        SELECT
            e.id AS event_id,
            e.date,
            e.time,
            e.created_at,
            e.image,
            e.location,
            k.id AS category_id,
            k.color_code,
            MAX(CASE WHEN te.field_name = 'title' THEN te.content END) AS title,
            MAX(CASE WHEN te.field_name = 'description' THEN te.content END) AS description,
            MAX(CASE WHEN tc.field_name = 'naziv' THEN tc.content END) AS category_name
        FROM events e
        LEFT JOIN text te
          ON te.source_table = 'events'
         AND te.source_id = e.id
         AND te.lang = :lang_event
        LEFT JOIN kategorije_dogadjaja k
          ON e.category_id = k.id
        LEFT JOIN text tc
          ON tc.source_table = 'kategorije_dogadjaja'
         AND tc.source_id = k.id
         AND tc.field_name = 'naziv'
         AND tc.lang = :lang_cat
        {$whereSql}
        GROUP BY e.id
        {$order}
        LIMIT :limit OFFSET :offset
    ";

        $stmt = $this->pdo->prepare($sql);

        // bind search parametara
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, \PDO::PARAM_STR);
        }

        // bind jezika
        $stmt->bindValue(':lang_event', $lang, \PDO::PARAM_STR);
        $stmt->bindValue(':lang_cat', $lang, \PDO::PARAM_STR);

        // bind limita i offseta
        $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);

        $stmt->execute();
        $events = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];

        return [$events, $total];
    }







    /**
     * Dohvata jedan event po ID-u
     */
    public function find(int $id, string $lang = 'lat'): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT e.id AS event_id,
                   e.category_id,
                   e.date,
                   e.time,
                   e.created_at,
                   e.image,
                   e.location,
                   tc.content AS category_name,
                   k.color_code,
                   t.field_name,
                   t.content AS field_value
              FROM events e
         JOIN kategorije_dogadjaja k 
               ON e.category_id = k.id
         LEFT JOIN text t 
               ON t.source_id = e.id
              AND t.source_table = 'events'
              AND t.lang = :lang
         LEFT JOIN text tc 
               ON tc.source_id = k.id
              AND tc.source_table = 'kategorije_dogadjaja'
              AND tc.field_name = 'naziv'
              AND tc.lang = :lang
             WHERE e.id = :id
        ");
        $stmt->execute([':id' => $id, ':lang' => $lang]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    /**
     * Kreiranje novog eventa
     */
    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO events (image,category_id, title, description,location, date, time, created_at)
            VALUES (:image, :category, :title, :description, :location, :date, :time, NOW())
        ");
        $stmt->execute([
            ':image' => '/uploads/images/' . ($data['filepath'] ?? ''),
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':location' => $data['location'],
            ':date' => $data['date'],
            ':time' => $data['time'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Update eventa
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE events
               SET category_id = :category,
                   title       = :title,
                   description = :description,
                   date        = :date,
                   time        = :time,
                   location    = :location
             WHERE id = :id
        ");
        return $stmt->execute([
            ':id' => $id,
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':location' => $data['location'],
        ]);
    }

    /**
     * Brisanje eventa
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
