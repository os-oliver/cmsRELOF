<?php
namespace App\Controllers;

session_start();

if (empty($_SESSION['user_id'])) {
    echo "authentication: -1 BLEHHH";
    exit;
}

use App\Models\News;
use App\Utils\Validator;

class NewsController
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // GET /news?limit=10&offset=0
    public function list(): void
    {
        if (isset($_GET['limit'], $_GET['offset'])) {
            $limit = is_numeric($_GET['limit']) ? (int) $_GET['limit'] : 0;
            $offset = is_numeric($_GET['offset']) ? (int) $_GET['offset'] : 0;

            header('Content-Type: application/json');
            echo json_encode((new News($this->pdo))->list($limit, $offset));
        }
    }

    // POST /news
    public function create(): void
    {
        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'category_id' => (int) ($_POST['category_id'] ?? 0),
            'author' => trim($_POST['author'] ?? ''),
            'published_date' => trim($_POST['published_date'] ?? ''), // YYYY-MM-DD
        ];

        // Simple validation (you can expand this)
        $errors = [];
        if (!Validator::notEmpty($data['title'])) {
            $errors[] = 'Title is required';
        }
        if (!Validator::isPositiveInt($data['category_id'])) {
            $errors[] = 'Valid category_id is required';
        }
        if (!Validator::notEmpty($data['author'])) {
            $errors[] = 'Author is required';
        }
        if (!Validator::isDate($data['published_date'])) {
            $errors[] = 'Published date must be YYYY-MM-DD';
        }

        if ($errors) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }

        try {
            $id = (new News($this->pdo))->insert($data);
            http_response_code(201);
            echo json_encode(['id' => $id]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // PUT /news/{id}
    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed, use PUT']);
            return;
        }

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? [];

        // We only accept these keys:
        $allowed = ['title', 'category_id', 'author', 'published_date'];
        $update = array_intersect_key($data, array_flip($allowed));

        if (empty($update)) {
            http_response_code(400);
            echo json_encode(['error' => 'No valid fields to update']);
            return;
        }

        try {
            (new News($this->pdo))->update($id, $update);
            http_response_code(200);
            echo json_encode(['updated' => true]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // DELETE /news/{id}
    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed, use DELETE']);
            return;
        }

        try {
            (new News($this->pdo))->delete($id);
            http_response_code(200);
            echo json_encode(['deleted' => true]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
