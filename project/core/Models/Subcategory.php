<?php
namespace App\Models;

use App\Database;
use PDO;

class Subcategory
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * List subcategories with pagination, search and sorting
     *
     * @param int    $limit       Number of records per page
     * @param int    $offset      Offset for pagination
     * @param string $search      Search term to filter by name
     * @param string $sort        Sort option, e.g. 'name_asc'
     * @param int|null $categoryId Filter by category_id if provided
     *
     * @return array [
     *     0 => array $subcategories (each is assoc array),
     *     1 => int $totalCount
     * ]
     *
     * @throws \InvalidArgumentException for invalid sort
     */
    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $sort = 'name_asc',
        ?int $categoryId = null
    ): array {
        // Determine sort column and direction
        $allowedSorts = [
            'name_asc'  => ['name', 'ASC'],
            'name_desc' => ['name', 'DESC'],
            'id_asc'    => ['id', 'ASC'],
            'id_desc'   => ['id', 'DESC'],
        ];
        if (!isset($allowedSorts[$sort])) {
            throw new \InvalidArgumentException("Invalid sort option.");
        }
        [$sortColumn, $sortDir] = $allowedSorts[$sort];

        // Base query
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, name, category_id
                FROM subcategories
                WHERE name LIKE :search";

        if ($categoryId !== null) {
            $sql .= " AND category_id = :category_id";
        }

        $sql .= " ORDER BY $sortColumn $sortDir
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%" . $search . "%", PDO::PARAM_STR);
        if ($categoryId !== null) {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get total count
        $countStmt = $this->pdo->query("SELECT FOUND_ROWS() AS total");
        $totalCount = (int) $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [$subcategories, $totalCount];
    }
}
