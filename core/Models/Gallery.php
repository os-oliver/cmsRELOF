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

    public function list(int $limit = 10, int $offset = 0, string $sort = 'date_desc', ?string $search = null): array
    {
        $orderBy = match ($sort) {
            'date_asc' => 'uploaded_at ASC',
            'title' => 'title ASC',
            default => 'uploaded_at DESC',
        };

        $whereClause = '';
        if ($search !== null && $search !== '') {
            $whereClause = "WHERE title LIKE :search";
        }

        $stmt = $this->pdo->prepare("
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM gallery 
            $whereClause
            ORDER BY $orderBy 
            LIMIT :limit OFFSET :offset
        ");

        if ($whereClause) {
            $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
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
            ':title' => $data['galleryTitle'],
            ':description' => $data['galleryDescription'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM gallery WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function get(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM gallery WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function search(string $query, int $limit = 10, int $offset = 0): array
    {
        $like = '%' . $query . '%';
        $stmt = $this->pdo->prepare("
            SELECT * FROM gallery 
            WHERE title LIKE :query OR description LIKE :query
            ORDER BY uploaded_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':query', $like, \PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countSearch(string $query): int
    {
        $like = '%' . $query . '%';
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM gallery 
            WHERE title LIKE :query OR description LIKE :query
        ");
        $stmt->execute([':query' => $like]);
        return (int) $stmt->fetchColumn();
    }
}
