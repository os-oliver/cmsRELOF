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
    public function getCategories()
    {
        $sql = "select id,naziv,color_code from kategorije_dogadjaja;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function search(string $term): array
    {
        $search = '%' . $term . '%';

        // 1) Get all column names
        $colsStmt = $this->pdo->query("SHOW COLUMNS FROM events");
        $columns = $colsStmt->fetchAll(\PDO::FETCH_COLUMN);

        // 2) Build dynamic WHERE clauses
        $conds = array_map(
            fn($col) => "CAST(`{$col}` AS CHAR) LIKE :search",
            $columns
        );
        $where = implode(' OR ', $conds);

        // 3) Prepare & execute
        $sql = "
        SELECT e.*, k.naziv AS category_name, k.color_code
          FROM events e
     LEFT JOIN kategorije_dogadjaja k ON e.category_id = k.id
         WHERE ($where)
      ORDER BY e.date DESC, e.time DESC
    ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', $search, \PDO::PARAM_STR);
        $stmt->execute();

        // 4) Fetch and return all matches
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function all(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $category = '',
        string $status = '',
        string $sort = 'date_desc'
    ): array {
        $sql = "SELECT SQL_CALC_FOUND_ROWS events.id ,events.location, events.category_id, events.title, events.description, events.date, events.time, events.created_at, events.image, kategorije_dogadjaja.naziv , kategorije_dogadjaja.color_code FROM events join kategorije_dogadjaja on events.category_id=kategorije_dogadjaja.id WHERE 1=1";
        $params = [':limit' => $limit, ':offset' => $offset];

        if ($search !== '') {
            $sql .= " AND (title LIKE :s1 OR description LIKE :s2)";
            $params[':s1'] = "%{$search}%";
            $params[':s2'] = "%{$search}%";
        }
        if ($category !== '') {
            $sql .= " AND category_id = :category";
            $params[':category'] = $category;
        }
        if ($status !== '') {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $sql .= match ($sort) {
            'date_asc' => " ORDER BY date ASC, time ASC",
            'title' => " ORDER BY title COLLATE utf8_general_ci ASC",
            default => " ORDER BY date DESC, time DESC",
        };

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, in_array($key, [':limit', ':offset']) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
    }


    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO events (image,category_id, title, description,location, date, time, created_at)
            VALUES (:image, :category, :title, :description,:location, :date, :time, NOW())
        ");
        $stmt->execute([
            ':image' => '/uploads/images/' . $data['filepath'],
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':location' => $data['location'],
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
        UPDATE events
           SET category_id = :category,
               title       = :title,
               description = :description,
               date        = :date,
               time        = :time,
               location = :location
         WHERE id = :id
    ");

        $success = $stmt->execute([
            ':id' => $id,
            ':category' => $data['category'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':location' => $data['location'],
        ]);
        error_log("id:" . $id);
        // Debugging output—remove or comment out in production:


        return $success;
    }


    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
