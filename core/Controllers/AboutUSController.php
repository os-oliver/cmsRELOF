<?php
namespace App\Controllers;

session_start();

use App\Controllers\AuthController;
use App\Models\Employee;
use App\Models\AboutUs;

class AboutUSController
{
    public function __construct()
    {
        // Require editor (or adjust to your auth logic)
        AuthController::requireEditor();
        header('Content-Type: application/json');
    }

    //
    // ─── ABOUT US ────────────────────────────────────────────────────────────────
    //

    /**
     * GET  /aboutus/{id}
     * GET  /aboutus?limit=&offset=
     */
    public function aboutUs($id = null): void
    {
        $model = new AboutUs();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($id !== null) {
                // fetch single
                $data = $model->get((int) $id);
            } elseif (isset($_GET['limit'], $_GET['offset'])) {
                // fetch paginated
                $limit = (int) ($_GET['limit'] ?? 0);
                $offset = (int) ($_GET['offset'] ?? 0);
                $data = $model->list();
            } else {
                // fetch all
                $data = $model->listAll();
            }
            echo json_encode($data);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $id !== null) {
            $payload = json_decode(file_get_contents('php://input'), true);

            // Build update data from available fields
            $updateData = [];
            if (isset($payload['mission'])) {
                $updateData['mission'] = $payload['mission'];
            }
            if (isset($payload['goal'])) {
                $updateData['goal'] = $payload['goal'];
            }

            if (empty($updateData)) {
                http_response_code(400);
                echo json_encode(['error' => 'At least one of mission or goal is required']);
                return;
            }

            $model->update((int) $id, $updateData);
            echo json_encode(['updated' => true]);
            return;
        }

        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
    }


    //
    // ─── EMPLOYEES ───────────────────────────────────────────────────────────────
    //

    /**
     * GET  /employees/{id}
     * GET  /employees?limit=&offset=
     */
    public function employees($id = null): void
    {
        $model = new Employee();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($id !== null) {
                $data = $model->get((int) $id);
            } elseif (isset($_GET['limit'], $_GET['offset'])) {
                $limit = (int) ($_GET['limit'] ?? 0);
                $offset = (int) ($_GET['offset'] ?? 0);
                $data = $model->list($limit, $offset);
            } else {
                $data = $model->listAll();
            }
            echo json_encode($data);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("usam sam");
            // create new employee
            $data = json_decode(file_get_contents('php://input'), true);


            if (!$data['name'] || !$data['surname']) {
                http_response_code(400);
                echo json_encode(['error' => 'Name and surname required']);
                return;
            }

            $id = $model->insert([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'position' => $data['position'],
                'biography' => $data['biography'],
            ]);
            http_response_code(201);
            echo json_encode(['id' => $id]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $id !== null) {
            $payload = json_decode(file_get_contents('php://input'), true);

            $updateData = [];
            foreach (['name', 'surname', 'position', 'biography'] as $field) {
                if (isset($payload[$field])) {
                    $updateData[$field] = trim($payload[$field]);
                }
            }
            if (empty($updateData)) {
                http_response_code(400);
                echo json_encode(['error' => 'No valid fields to update']);
                return;
            }

            $model->update((int) $id, $updateData);
            echo json_encode(['updated' => true]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $id !== null) {
            $model->delete((int) $id);
            echo json_encode(['deleted' => true]);
            return;
        }

        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
    }
}
