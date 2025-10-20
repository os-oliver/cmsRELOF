<?php
namespace App\Controllers;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Models\Content;
use Throwable;

class ContentController
{
    private Content $model;

    public function __construct(?\PDO $pdo = null)
    {
        // Model će sam napraviti konekciju ako nije prosleđena
        $this->model = new Content($pdo);
    }

    /**
     * HTTP endpoint za kreiranje / update iz requesta
     */
    public function createFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        try {
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $result = $this->model->saveContent($_POST, $_FILES, $locale);
            http_response_code(200);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            error_log('CreateFromRequest failed: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Internal server error', 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * HTTP endpoint za listu (GET)
     */
    public function listFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $type = $_GET['type'] ?? null;
        $q = trim((string) ($_GET['q'] ?? ''));
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $per = max(1, min(100, (int) ($_GET['per'] ?? 10)));
        $category = isset($_GET['category']) ? (int) $_GET['category'] : null;
        $lang = $_GET['lang'] ?? 'sr';

        if (!$type) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing type']);
            return;
        }

        try {
            $data = $this->model->fetchListData($type, $q, $page, $per, $category, $lang);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            error_log('ListFromRequest failed: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * HTTP endpoint za jedan item (?id=)
     */
    public function getItemFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing id']);
            return;
        }

        try {
            $data = $this->model->fetchItem($id);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            error_log('GetItemFromRequest failed: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * HTTP endpoint za brisanje (POST: id)
     */
    public function deleteFromRequest(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid id']);
            return;
        }

        try {
            $res = $this->model->deleteById($id);
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            error_log('DeleteFromRequest failed: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error'], JSON_UNESCAPED_UNICODE);
        }
    }
}
