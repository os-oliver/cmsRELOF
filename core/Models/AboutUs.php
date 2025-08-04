<?php
namespace App\Models;

use App\Database;
use PDO;
use RuntimeException;

class AboutUs
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Fetch a paginated list of about-us records.
     */
    public function list(): ?array
    {
        // Only fetch the first record
        $stmt = $this->pdo->prepare("
            SELECT goal,mission
              FROM aboutus
             ORDER BY id
             LIMIT 1
        ");
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row !== false ? $row : null;
    }

    public function search(string $term): array
    {
        // Prepare search term
        $search = '%' . $term . '%';

        // Retrieve all column names
        $colsStmt = $this->pdo->query("SHOW COLUMNS FROM aboutus");
        $columns = $colsStmt->fetchAll(PDO::FETCH_COLUMN);

        // Build WHERE clauses with unique placeholders
        $conditions = [];
        $params = [];
        foreach ($columns as $i => $col) {
            $placeholder = ":search{$i}";
            $conditions[] = "CAST(`{$col}` AS CHAR) LIKE {$placeholder}";
            $params[$placeholder] = $search;
        }
        $where = implode(' OR ', $conditions);

        $sql = "SELECT * FROM aboutus WHERE {$where} ORDER BY id";
        $stmt = $this->pdo->prepare($sql);

        // Bind each placeholder
        foreach ($params as $ph => $val) {
            $stmt->bindValue($ph, $val, PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all about-us records.
     */
    public function listAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM aboutus ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single record by ID.
     */
    public function get(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM aboutus WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    /**
     * Insert a new record.
     */
    public function insert(array $data): int
    {
        if (empty($data['mission']) || empty($data['goal'])) {
            throw new RuntimeException('Mission and goal are required');
        }
        $stmt = $this->pdo->prepare("
            INSERT INTO aboutus (mission, goal)
            VALUES (:mission, :goal)
        ");
        $stmt->execute([
            ':mission' => $data['mission'],
            ':goal' => $data['goal'],
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Update an existing record.
     */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['mission'])) {
            $fields[] = 'mission = :mission';
            $params[':mission'] = $data['mission'];
        }
        if (isset($data['goal'])) {
            $fields[] = 'goal = :goal';
            $params[':goal'] = $data['goal'];
        }

        if (empty($fields)) {
            throw new RuntimeException('Nothing to update');
        }

        $sql = 'UPDATE aboutus SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Delete a record.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM aboutus WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
