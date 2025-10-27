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
        $selectParams = [
            ':limit' => $limit,
            ':offset' => $offset
        ];

        $whereClause = '';
        $localeClause = '';
        $joinText = '';

        // Ako je prosleđen locale, filtriramo tekstove
        if ($locale !== null) {
            $localeClause = 'AND t.lang = :locale';
            $selectParams[':locale'] = $locale;
        }

        if (!empty($search)) {
            $searchWildcard = '%' . $search . '%';
            $selectParams[':search'] = $searchWildcard;

            // Pronađi ID-jeve zaposlenih čija polja u text tabeli odgovaraju search-u
            $whereClause = "WHERE e.id IN (
            SELECT source_id 
            FROM text t 
            WHERE t.source_table = 'employee' 
              AND t.content LIKE :search
              $localeClause
        )";
        }

        // Glavni SELECT sa pivotovanjem
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
           " . ($locale !== null ? "AND t.lang = :locale" : "") . "
        $whereClause
        ORDER BY e.id
        LIMIT :limit OFFSET :offset
    ";

        $stmt = $this->pdo->prepare($sql);

        // Bind parametri
        foreach ($selectParams as $key => $value) {
            $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $value, $paramType);
        }

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Pivotovanje za jezike
        $pivoter = new Pivoter('field_name', 'content', 'id');
        $employees = $pivoter->pivot($rows);

        // Ukupan broj rezultata
        $countSql = "SELECT COUNT(*) as total FROM employee e $whereClause";
        $countStmt = $this->pdo->prepare($countSql);
        foreach ($selectParams as $key => $value) {
            if ($key !== ':limit' && $key !== ':offset') {
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $countStmt->bindValue($key, $value, $paramType);
            }
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
