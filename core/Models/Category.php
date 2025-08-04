<?php
namespace App\Models;

use App\Database;
use PDO;

class Category
{
    private PDO $pdo;

    // Allowed tables and their corresponding name fields
    private array $tables = [
        'kategorije_dogadjaja' => 'naziv',
        'category_document' => 'name',
    ];

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * List categories with pagination, search and sorting
     *
     * @param string $table  Table name (must be one of allowed tables)
     * @param int    $limit  Number of records per page
     * @param int    $offset Offset for pagination
     * @param string $search Search term to filter by name
     * @param string $sort   Sort option, e.g. 'name_asc', 'color_code_desc'
     *
     * @return array [
     *     0 => array $categories (each is assoc array),
     *     1 => int $totalCount
     * ]
     *
     * @throws \InvalidArgumentException for invalid table or sort
     */
    public function list(
        string $table,
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $sort = 'name_asc'
    ): array {
        // Validate table
        if (!array_key_exists($table, $this->tables)) {
            throw new \InvalidArgumentException("Invalid table name.");
        }
        $fieldName = $this->tables[$table];

        // Determine sort column and direction
        $allowedSorts = [
            'name_asc' => [$fieldName, 'ASC'],
            'name_desc' => [$fieldName, 'DESC'],
            'color_code_asc' => ['color_code', 'ASC'],
            'color_code_desc' => ['color_code', 'DESC'],
        ];
        if (!isset($allowedSorts[$sort])) {
            throw new \InvalidArgumentException("Invalid sort option.");
        }
        [$sortColumn, $sortDir] = $allowedSorts[$sort];

        // Base query for data
        $sql = sprintf(
            "SELECT SQL_CALC_FOUND_ROWS id, %s AS name, color_code
             FROM `%s`
             WHERE %s LIKE :search
             ORDER BY %s %s
             LIMIT :limit OFFSET :offset",
            $fieldName,
            $table,
            $fieldName,
            $sortColumn,
            $sortDir
        );

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%" . $search . "%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get total count
        $countStmt = $this->pdo->query("SELECT FOUND_ROWS() AS total");
        $totalCount = (int) $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [$categories, $totalCount];
    }
}
