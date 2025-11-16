<?php
// File: App/Models/Employee.php
namespace App\Models;

use App\Database;
use App\Utils\Pivoter;
use App\Utils\TextHelper;
use PDO;
use RuntimeException;

class Employee
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");


    }

    /**
     * Fetch a paginated list of employees.
     */
    public function list(int $limit, int $offset, string $search = '', ?string $locale = null): array
    {
        $params = [];
        $whereClause = '';
        if ($locale == 'en') {
            $locale = 'sr-Cyrl';
        }
        if (!empty($search)) {
            $params[':search'] = '%' . $search . '%';
            $whereClause = "WHERE e.id IN (
            SELECT source_id
            FROM text t
            WHERE t.source_table = 'employee'
            AND t.content LIKE :search
            " . ($locale !== null ? "AND t.lang = :locale_sub" : "") . "
        )";
            if ($locale !== null) {
                $params[':locale_sub'] = $locale;
            }
        }

        // prvo biramo ID-jeve zaposlenih sa limit i offset
        $idSql = "SELECT e.id FROM employee e $whereClause ORDER BY e.id desc LIMIT :limit OFFSET :offset";
        $idStmt = $this->pdo->prepare($idSql);
        $idStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $idStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        foreach ($params as $key => $value) {
            $idStmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $idStmt->execute();
        $ids = $idStmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($ids)) {
            return [[], 0];
        }

        // zatim dohvatamo sve polja i jezike samo za te ID-jeve
        $textParams = [];
        $textParams[':ids'] = implode(',', $ids);
        $localeClause = $locale !== null ? "AND t.lang = :locale" : "";

        $sql = "
        SELECT 
            e.id,
            e.position,
            t.lang,
            t.field_name,
            t.content
        FROM employee e
        LEFT JOIN text t
            ON t.source_id = e.id
           AND t.source_table = 'employee'
           $localeClause
        WHERE e.id IN (" . implode(',', $ids) . ")
        ORDER BY e.id
    ";

        $stmt = $this->pdo->prepare($sql);
        if ($locale !== null) {
            $stmt->bindValue(':locale', $locale, PDO::PARAM_STR);
        }
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pivoter = new Pivoter('field_name', 'content', 'id');
        $employees = $pivoter->pivot($rows);

        // ukupan broj zaposlenih koji zadovoljavaju filter
        $countSql = "SELECT COUNT(DISTINCT e.id) as total FROM employee e $whereClause";
        $countStmt = $this->pdo->prepare($countSql);
        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $countStmt->execute();
        $totalCount = (int) $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [$employees, $totalCount];
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
    public function insert(array $data, string $locale = 'en'): int
    {
        // Create a new employee row (empty or with minimal fields)
        $stmt = $this->pdo->prepare("INSERT INTO employee (position) VALUES ('')");
        $stmt->execute();

        $id = (int) $this->pdo->lastInsertId();

        // Process all text fields
        foreach ($data as $field => $value) {
            $this->processTextField($id, $field, $value, $locale, false);
        }

        return $id;
    }
    private function processTextField(int $contentID, string $fieldName, string $value, string $locale, bool $isUpdate, string $type = ''): void
    {
        $variants = TextHelper::transliterateVariants($value, $locale);

        if ($isUpdate) {
            TextHelper::updateTextEntries($this->pdo, $contentID, $fieldName, $variants, 'employee');
        } else {
            TextHelper::insertTextEntries($this->pdo, $contentID, $fieldName, $variants, 'employee');
        }
    }

    /**
     * Update an existing employee.
     */
    /**
     * Update an existing employee.
     */
    public function update(int $id, array $data, string $locale = 'en'): bool
    {
        if (empty($data)) {
            throw new RuntimeException('Nothing to update');
        }

        // Process all text fields
        foreach ($data as $field => $value) {
            $this->processTextField($id, $field, $value, $locale, true);
        }

        return true;
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
