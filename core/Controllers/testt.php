<?php
namespace App\Controllers;

session_start();

if (empty($_SESSION['user_id'])) {
    echo "authentication: -1 BLEHHH";
    exit;
}

use App\Models\Contact;
use App\Utils\FileUploader;

class testt
{
    private \PDO $pdo;

    public function list(): void
    {
        if (isset($_GET['limit'], $_GET['offset'])) {
            $limit = is_numeric($_GET['limit']) ? (int) $_GET['limit'] : 0;
            $offset = is_numeric($_GET['offset']) ? (int) $_GET['offset'] : 0;

            header('Content-Type: application/json');
            echo json_encode((new Contact())->list($limit, $offset));
        }
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

        (new Contact())->delete($id);
        http_response_code(200);
        echo json_encode(['deleted' => true]);
    }
    public function create(): void
    {
        // Read raw JSON body
        $input = json_decode(file_get_contents('php://input'), true);

        // Basic validation
        if (
            empty($input['ime']) ||
            empty($input['prezime']) ||
            empty($input['email']) ||
            empty($input['naslov']) ||
            empty($input['poruka'])
        ) {
            http_response_code(400);
            echo json_encode(['error' => 'Sva obavezna polja moraju biti popunjena.']);
            return;
        }

        // Sanitize or validate if needed (e.g., email format)

        $contactModel = new Contact();
        $success = $contactModel->create([
            'ime' => $input['ime'],
            'prezime' => $input['prezime'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? null,
            'naslov' => $input['naslov'],
            'poruka' => $input['poruka'],
        ]);

        if ($success) {
            http_response_code(201);
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Greška pri čuvanju poruke.']);
        }
    }



}
