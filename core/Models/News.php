<?php
namespace App\Models;

use App\Database;
use PDO;
use PDOException;

class News
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->GetPDO();
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        $sql = "SELECT * FROM category ORDER BY name";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * List news with pagination, search, category filter, and sorting
     *
     * @param int $limit
     * @param int $offset
     * @param string $search
     * @param int|null $categoryId
     * @param string $sort   date_desc, date_asc, title
     * @return array [news array, total count]
     */
    public function list(
        int $limit = 10,
        int $offset = 0,
        string $search = '',
        ?int $categoryId = null,
        string $sort = 'date_desc'
    ): array {
        $sql = "SELECT SQL_CALC_FOUND_ROWS n.id, n.title, n.author, n.published_date, c.id AS category_id, c.name AS category, c.color_code"
            . " FROM news n"
            . " JOIN category c ON n.category_id = c.id"
            . " WHERE 1=1";
        $params = [':limit' => $limit, ':offset' => $offset];

        if ($search !== '') {
            $sql .= " AND (n.title LIKE :search OR n.author LIKE :search)";
            $params[':search'] = "%{$search}%";
        }

        if ($categoryId !== null) {
            $sql .= " AND n.category_id = :cat";
            $params[':cat'] = $categoryId;
        }

        $sql .= match ($sort) {
            'date_asc' => " ORDER BY n.published_date ASC",
            'title' => " ORDER BY n.title ASC",
            default => " ORDER BY n.published_date DESC",
        };

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $type = in_array($key, [':limit', ':offset', ':cat']) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $val, $type);
        }
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = (int) $this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [$data, $total];
    }

    /**
     * Search news by query in title and author
     *
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function search(string $query, int $limit = 10, int $offset = 0): array
    {
        $like = '%' . $query . '%';
        $sql = "SELECT * FROM news WHERE title LIKE :q OR author LIKE :q"
            . " ORDER BY published_date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':q', $like, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a new news record
     *
     * @param array $data
     * @return int last insert ID
     */
    public function insert(array $data): int
    {
        $sql = "INSERT INTO news (title, category_id, author, published_date)"
            . " VALUES (:title, :cat, :author, :date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':cat' => $data['category_id'],
            ':author' => $data['author'],
            ':date' => $data['published_date'],
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Update news metadata
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE news SET title = :title, category_id = :cat, author = :author, published_date = :date"
            . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':cat' => $data['category_id'],
            ':author' => $data['author'],
            ':date' => $data['published_date'],
            ':id' => $id,
        ]);
    }

    /**
     * Delete a news record
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Count total matching search records
     *
     * @param string $query
     * @return int
     */
    public function countSearch(string $query): int
    {
        $like = '%' . $query . '%';
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM news WHERE title LIKE :q OR author LIKE :q"
        );
        $stmt->execute([':q' => $like]);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Find single news by ID
     *
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT n.*, c.name AS category, c.color_code"
            . " FROM news n JOIN category c ON n.category_id = c.id"
            . " WHERE n.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ?: null;
    }
}
