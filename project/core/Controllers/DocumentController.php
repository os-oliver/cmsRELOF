<?php
namespace App\Controllers;

session_start();

if (empty($_SESSION['user_id'])) {
    echo "authentication: -1 BLEHHH";
    exit;
}

use App\Models\Document;
use App\Utils\FileUploader;

class DocumentController
{
    private \PDO $pdo;

    public function list(): void
    {
        if (isset($_GET['limit'], $_GET['offset'])) {
            $limit = is_numeric($_GET['limit']) ? (int) $_GET['limit'] : 0;
            $offset = is_numeric($_GET['offset']) ? (int) $_GET['offset'] : 0;

            header('Content-Type: application/json');
            echo json_encode((new Document())->list($limit, $offset));
        }
    }

    public function newDocument(): void
    {
        $data = $_POST;
        $file = $_FILES['documetFile'] ?? null;
        $uploadDir = dirname(__DIR__) . '/../public/uploads/documents/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        error_log(message: "fajl:" . $file);

        try {
            if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploader = new FileUploader($uploadDir);
                $filename = $uploader->upload($file);
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $filesizeB = (int) $file['size'];
                $data['name'] = pathinfo($file['name'], PATHINFO_FILENAME);
                $data['extension'] = $ext;
                $data['fileSize'] = round($filesizeB / (1024 * 1024), 2);
                $data['filepath'] = $filename;
            } else {
                $data['name'] = null;
                $data['extension'] = null;
                $data['fileSize'] = null;
                $data['filepath'] = null;
            }
        } catch (\RuntimeException $e) {
            error_log("greska:" . $e->getMessage());
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            return;
        }

        $id = (new Document())->insert($data);
        http_response_code(201);
        echo json_encode(['id' => $id]);
    }

    public function update(int $id): void
    {
        error_log("caooo");

        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed, use PUT']);
            return;
        }
        error_log(message: "caooo:" . $id);

        $data = json_decode(file_get_contents('php://input'), true);
        foreach ($data as $key => $value) {
            error_log(message: $key . ':' . $value);
        }
        error_log(message: 'mess' . $data['description']);
        if (empty($id) || !is_numeric($id)) {
            error_log(message: "NE:" . $id);

            http_response_code(400);
            echo json_encode(['error' => 'Invalid document ID']);
            return;
        }

        try {
            // If supporting file uploads via PUT, additional handling would be needed here
            // For now, only updating metadata fields
            error_log(message: "HEEJ:" . $id);

            (new Document())->update($id, $data);
        } catch (\RuntimeException $e) {
            error_log("hej:" . $e->getMessage());
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
            echo json_encode(['error' => 'Invalid document ID']);
            return;
        }

        $id = (int) $id;

        (new Document())->delete($id);
        http_response_code(200);
        echo json_encode(['deleted' => true]);
    }

}
