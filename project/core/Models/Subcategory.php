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
     * Fetch the number of distinct subcategories by name.
     *
     * @return int
     */
    public function countDistinctSubcategories(): int
    {
        $sql = "SELECT COUNT(DISTINCT(content)) AS distinct_count
            FROM subcategory_document
            JOIN text 
            ON source_id = subcategory_document.id 
            AND source_table = 'subcategory_document'
            order by category_id asc";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['distinct_count'];
    }
}
