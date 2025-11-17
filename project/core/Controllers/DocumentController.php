<?php
namespace App\Controllers;
use App\Controllers\AuthController;
use App\Models\Document;
use App\Utils\FileUploader;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
            mkdir($uploadDir, 0775, true);
        }

        // Validacija obaveznih polja
        $title = trim($data['title'] ?? '');
        $description = trim($data['description'] ?? '');




        // Detaljno logovanje za debug
        error_log("=== UPLOAD DEBUG START ===");
        error_log("POST data: " . print_r($data, true));
        error_log("FILE data: " . print_r($file, true));

        if ($file) {
            $errorCodes = [
                UPLOAD_ERR_OK => 'UPLOAD_ERR_OK',
                UPLOAD_ERR_INI_SIZE => 'UPLOAD_ERR_INI_SIZE',
                UPLOAD_ERR_FORM_SIZE => 'UPLOAD_ERR_FORM_SIZE',
                UPLOAD_ERR_PARTIAL => 'UPLOAD_ERR_PARTIAL',
                UPLOAD_ERR_NO_FILE => 'UPLOAD_ERR_NO_FILE',
                UPLOAD_ERR_NO_TMP_DIR => 'UPLOAD_ERR_NO_TMP_DIR',
                UPLOAD_ERR_CANT_WRITE => 'UPLOAD_ERR_CANT_WRITE',
                UPLOAD_ERR_EXTENSION => 'UPLOAD_ERR_EXTENSION',
            ];

            $errorCode = $file['error'] ?? null;
            $errorMessage = $errorCodes[$errorCode] ?? 'UNKNOWN_ERROR';
            error_log("Upload error code: {$errorCode} ({$errorMessage})");

            // Validacija veličine fajla (200MB limit)
            $maxSizeMB = 200;
            $maxSizeBytes = $maxSizeMB * 1024 * 1024;
            if ($file['size'] > $maxSizeBytes) {
                http_response_code(413);
                echo json_encode(['error' => "Fajl je prevelik! Maksimalna dozvljena veličina: {$maxSizeMB}MB"]);
                return;
            }
        } else {
            error_log("Nema fajla u \$_FILES['documetFile']");
        }
        error_log("=== UPLOAD DEBUG END ===");

        try {
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
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
            error_log("greska: " . $e->getMessage());
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

        error_log("caooo:" . $id);

        $data = json_decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            error_log("Data is null or not valid JSON");
            http_response_code(400);
            echo json_encode(['error' => 'Invalid or missing JSON data']);
            return;
        }

        foreach ($data as $key => $value) {
            error_log($key . ':' . $value);
        }

        if (empty($id) || !is_numeric($id)) {
            error_log("Invalid ID:" . $id);
            http_response_code(400);
            echo json_encode(['error' => 'Invalid document ID']);
            return;
        }

        try {
            error_log("Updating document: " . $id);
            (new Document())->update($id, $data);
        } catch (\RuntimeException $e) {
            error_log("Error updating document: " . $e->getMessage());
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
