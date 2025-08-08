<?php
namespace App\Models;

use App\Database;
use PDO;
use PDOException;

class SearchModal
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    public function searchTable(string $table, string $term): array
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \InvalidArgumentException('Invalid table name');
        }

        $search = '%' . $term . '%';

        // Retrieve all column names
        $colsStmt = $this->pdo->query("SHOW COLUMNS FROM `{$table}`");
        $columns = $colsStmt->fetchAll(PDO::FETCH_COLUMN);

        // Build WHERE clauses with unique placeholders
        $conditions = [];
        $params = [];
        foreach ($columns as $i => $col) {
            $ph = ":search{$i}";
            $conditions[] = "CAST(`{$col}` AS CHAR) LIKE {$ph}";
            $params[$ph] = $search;
        }
        $where = implode(' OR ', $conditions);

        $sql = "SELECT * FROM `{$table}` WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $ph => $val) {
            $stmt->bindValue($ph, $val, PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
