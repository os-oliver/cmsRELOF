<?php
namespace App\Models;

use App\Database;

class Gallery
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Lista galerijskih stavki sa opcionalnom pretragom
     */
    public function all(
        string $lang = 'sr',
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        string $sort = 'date_desc'
    ): array {
        $having = '';
        $params = [];

        if ($search !== '') {
            $having = "HAVING title LIKE :search";
            $params[':search'] = '%' . $search . '%';
        }

        $order = match ($sort) {
            'date_asc' => "ORDER BY g.uploaded_at ASC",
            'title' => "ORDER BY COALESCE(MAX(CASE WHEN t.field_name = 'title' THEN t.content END), g.title) ASC",
            default => "ORDER BY g.uploaded_at DESC",
        };

        // COUNT ukupno galerijskih stavki
        $countSql = "SELECT COUNT(*) FROM gallery g";
        $countStmt = $this->pdo->prepare($countSql);
        $countStmt->execute();
        $total = (int) $countStmt->fetchColumn();

        // Glavni upit: pivotujemo title/description iz text tabele
        $sql = "
            SELECT
                g.*,
                MAX(CASE WHEN t.field_name = 'title' THEN t.content END) AS title,
                MAX(CASE WHEN t.field_name = 'description' THEN t.content END) AS description
            FROM gallery g
            LEFT JOIN text t
              ON t.source_table = 'gallery'
              AND t.source_id = g.id
              AND t.lang = :lang_gallery
            GROUP BY g.id
            {$having}
            {$order}
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, \PDO::PARAM_STR);
        }

        $stmt->bindValue(':lang_gallery', $lang, \PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();
        $galleries = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];

        return [$galleries, $total];
    }

    public function insert(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO gallery (title, description, image_file_path)
            VALUES (:title, :description, :image_file_path)
        ");
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':image_file_path' => '/uploads/gallery/' . $data['image_file_path'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE gallery SET 
                title = :title,
                description = :description
            WHERE id = :id
        ");
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM gallery WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function get(int $id, string $lang = 'sr'): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT
                g.*,
                MAX(CASE WHEN t.field_name = 'title' THEN t.content END) AS title,
                MAX(CASE WHEN t.field_name = 'description' THEN t.content END) AS description
            FROM gallery g
            LEFT JOIN text t
              ON t.source_table = 'gallery'
              AND t.source_id = g.id
              AND t.lang = :lang_gallery
            WHERE g.id = :id
            GROUP BY g.id
        ");
        $stmt->execute([
            ':id' => $id,
            ':lang_gallery' => $lang,
        ]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
