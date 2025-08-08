<?php
namespace App\Controllers;

session_start();

if (empty($_SESSION['user_id'])) {
    echo "authentication: -1 BLEHHH";
    exit;
}

use App\Models\Gallery;
use App\Utils\FileUploader;

class GalleryController
{
    public function list(): void
    {
        if (isset($_GET['limit'], $_GET['offset'])) {
            $limit = is_numeric($_GET['limit']) ? (int) $_GET['limit'] : 0;
            $offset = is_numeric($_GET['offset']) ? (int) $_GET['offset'] : 0;

            header('Content-Type: application/json');
            echo json_encode((new Gallery())->list($limit, $offset));
        }
    }

    public function newImage(): void
    {
        $data = [];
        $data['title'] = $_POST['galleryTitle'] ?? null;
        $data['description'] = $_POST['galleryDescription'] ?? null;
        $file = $_FILES['galleryImage'] ?? null;
        $uploadDir = dirname(__DIR__) . '/../public/uploads/gallery/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        try {
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploader = new FileUploader($uploadDir);
                $filename = $uploader->upload($file);
                $data['image_file_path'] = $filename;
            } else {
                $data['image_file_path'] = null;
            }
        } catch (\RuntimeException $e) {
            error_log("Upload error: " . $e->getMessage());
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            return;
        }

        $id = (new Gallery())->insert($data);
        http_response_code(201);
        echo json_encode(['id' => $id]);
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed, use PUT']);
            return;
        }

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (empty($id) || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid image ID']);
            return;
        }

        try {
            (new Gallery())->update($id, $data);
        } catch (\RuntimeException $e) {
            error_log("Update error: " . $e->getMessage());
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            return;
        }

        http_response_code(200);
        echo json_encode(['updated' => true]);
    }

    public function delete($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed, use DELETE']);
            return;
        }

        if (empty($id) || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid image ID']);
            return;
        }

        $id = (int) $id;
        (new Gallery())->delete($id);

        http_response_code(200);
        echo json_encode(['deleted' => true]);
    }
}
