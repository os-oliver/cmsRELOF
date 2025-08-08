<?php
// File: App/Models/Employee.php
namespace App\Models;

use App\Database;
use PDO;
use RuntimeException;

class Employee
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Fetch a paginated list of employees.
     */
    public function list(int $limit, int $offset, string $search = ''): array
    {
        $searchWildcard = '%' . $search . '%';

        $limit = (int) $limit;
        $offset = (int) $offset;

        $whereClause = '';
        $params = [];

        if (!empty($search)) {
            // Use two different placeholders
            $whereClause = 'WHERE name LIKE :search1 OR surname LIKE :search2';
            $params[':search1'] = $searchWildcard;
            $params[':search2'] = $searchWildcard;
        }

        $sql = "SELECT * FROM employee $whereClause ORDER BY id LIMIT $limit OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countSql = "SELECT COUNT(*) as total FROM employee $whereClause";
        $countStmt = $this->pdo->prepare($countSql);

        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $countStmt->execute();
        $totalCount = (int) $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            $employees,
            $totalCount
        ];
    }



    /**
     * Fetch all employees.
     */
    public function listAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM employee ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single employee by ID.
     */
    public function get(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM employee WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    /**
     * Insert a new employee.
     */
    public function insert(array $data): int
    {
        foreach (['name', 'surname'] as $field) {
            if (empty($data[$field])) {
                throw new RuntimeException("$field is required");
            }
        }
        $stmt = $this->pdo->prepare("
            INSERT INTO employee (name, surname, position, biography)
            VALUES (:name, :surname, :position, :biography)
        ");
        $stmt->execute([
            ':name' => $data['name'],
            ':surname' => $data['surname'],
            ':position' => $data['position'] ?? null,
            ':biography' => $data['biography'] ?? null,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Update an existing employee.
     */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = [':id' => $id];

        foreach (['name', 'surname', 'position', 'biography'] as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) {
            throw new RuntimeException('Nothing to update');
        }

        $sql = 'UPDATE employee SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public function search(string $term): array
    {
        $search = '%' . $term . '%';

        // 1) Retrieve all column names
        $colsStmt = $this->pdo->query("SHOW COLUMNS FROM employee");
        $columns = $colsStmt->fetchAll(PDO::FETCH_COLUMN);

        // 2) Build a LIKE condition for each column
        $conds = array_map(
            fn($col) => "CAST(`{$col}` AS CHAR) LIKE :search",
            $columns
        );
        $where = implode(' OR ', $conds);

        // 3) Prepare, bind and execute
        $sql = "SELECT * FROM employee WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        // 4) Return all matches
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Delete an employee.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM employee WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
