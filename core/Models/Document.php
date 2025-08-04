<?php
namespace App\Models;
use App\Database;

class Document
{
    private $pdo;
    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    public function getCategories()
    {
        $sql = "select * from category_document;";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $category = '',
        string $status = '',
        string $sort = 'date_desc'
    ): array {
        $sql = "SELECT SQL_CALC_FOUND_ROWS document.id,filepath,extension,datetime, fileSize,title,description,category_id,name,color_code FROM document join category_document on document.category_id=category_document.id WHERE 1=1";
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
            'date_asc' => " ORDER BY datetime ASC",
            'title' => " ORDER BY title ASC",
            default => " ORDER BY datetime DESC",
        };

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, in_array($k, [':limit', ':offset']) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }
        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
    }




    public function insert(array $data): bool
    {
        error_log('INSERTING DATA: ' . json_encode($data));

        $stmt = $this->pdo->prepare("
            INSERT INTO document ( filepath, extension, title, description,fileSize,category_id,datetime)
            VALUES ( :filepath, :extension, :title, :description,:fileSize,:category,NOW())
        ");
        return $stmt->execute([
            ':filepath' => $data['filepath'],
            ':extension' => $data['extension'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':fileSize' => $data['fileSize'],
            ':category' => $data['category'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE document SET 
                title = :name,
                description = :description,
                category_id = :idc
               
            WHERE id = :id
        ");
        return $stmt->execute([
            ':name' => $data['title'],
            ':description' => $data['description'],
            ':idc' => $data['category'],

            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM document WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    public function search(string $term): array
    {
        // Prepare search term
        $search = '%' . $term . '%';

        // Retrieve all column names
        $colsStmt = $this->pdo->query("SHOW COLUMNS FROM document");
        $columns = $colsStmt->fetchAll(\PDO::FETCH_COLUMN);

        // Build WHERE clauses with unique placeholders
        $conditions = [];
        $params = [];
        foreach ($columns as $i => $col) {
            $placeholder = ":search{$i}";
            $conditions[] = "CAST(`{$col}` AS CHAR) LIKE {$placeholder}";
            $params[$placeholder] = $search;
        }
        $where = implode(' OR ', $conditions);

        $sql = "SELECT * FROM document WHERE {$where} ORDER BY id";
        $stmt = $this->pdo->prepare($sql);

        // Bind each placeholder
        foreach ($params as $ph => $val) {
            $stmt->bindValue($ph, $val, \PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function countSearch(string $query): int
    {
        $like = '%' . $query . '%';
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM document 
            WHERE name LIKE :query OR title LIKE :query OR description LIKE :query
        ");
        $stmt->execute([':query' => $like]);
        return (int) $stmt->fetchColumn();
    }
}
