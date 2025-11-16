<?php
namespace App\Controllers;

use App\Utils\LocaleManager;

session_start();

use App\Controllers\AuthController;
use App\Models\Employee;
use App\Models\AboutUs;

class AboutUSController
{
    public function __construct()
    {
        // Require editor (or adjust to your auth logic)
        header('Content-Type: application/json');
    }

    //
    // ─── ABOUT US ────────────────────────────────────────────────────────────────
    //
    public function settings(): void
    {
        $model = new AboutUs();

        // Accept JSON PUT or POST with _method=PUT
        if (
            $_SERVER['REQUEST_METHOD'] === 'PUT' ||
            ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['_method']) && strtoupper($_REQUEST['_method']) === 'PUT')
        ) {
            $payload = !empty($_POST) || !empty($_FILES) ? $_POST : json_decode(file_get_contents('php://input'), true) ?? [];

            $siteTitleRaw = trim($payload['site_title'] ?? '');

            $iconPath = null;
            $allowed = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico'];
            $destDir = __DIR__ . '/../../public/assets/icons';
            $finalIconName = 'icon.png'; // always overwrite this

            if (!is_dir($destDir)) {
                mkdir($destDir, 0755, true);
            }

            // Handle uploaded icon
            if (!empty($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['icon']['tmp_name'];
                $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed)) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Invalid icon type']);
                    return;
                }

                // Always save as icon.png, overwriting existing file
                if (!move_uploaded_file($tmp, $destDir . '/' . $finalIconName)) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to move uploaded icon']);
                    return;
                }

                $iconPath = '/assets/icons/' . $finalIconName;
            }

            // Check if user provided a filename as site_title (optional)
            if (!$iconPath && $siteTitleRaw !== '') {
                $maybeExt = strtolower(pathinfo($siteTitleRaw, PATHINFO_EXTENSION));
                if (in_array($maybeExt, $allowed)) {
                    $iconPath = '/assets/icons/' . basename($siteTitleRaw);
                    $siteTitle = '';
                } else {
                    $siteTitle = $siteTitleRaw;
                }
            } else {
                $siteTitle = $siteTitleRaw;
            }

            if ($siteTitle === '' && $iconPath === null) {
                http_response_code(400);
                echo json_encode(['error' => 'Site title is required or an icon must be provided']);
                return;
            }

            $saveData = [];
            if ($siteTitle !== '')
                $saveData['page_title'] = $siteTitle;
            if ($iconPath !== null)
                $saveData['icon'] = $iconPath;

            $id = $model->insert($saveData);

            echo json_encode(['saved' => true, 'id' => $id]);
            return;
        }

        // GET request
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $model->list('sr-Cyrl');
            echo json_encode($data);
            return;
        }

        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
    }


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
            if (isset($payload['site_title'])) {
                $updateData['site_title'] = $payload['site_title'];
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

        // Create new employee (accept JSON or multipart/form-data with file)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_REQUEST['_method'])) {
            // Accept either form fields (POST) or JSON body
            if (!empty($_POST) || !empty($_FILES)) {
                $data = $_POST;
            } else {
                $data = json_decode(file_get_contents('php://input'), true) ?? [];
            }

            if (empty($data['name']) || empty($data['surname'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Name and surname required']);
                return;
            }

            $locale = LocaleManager::get();

            // Handle uploaded icon file if present
            $iconPath = null;
            $allowed = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
            if (!empty($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['icon']['tmp_name'];
                $orig = $_FILES['icon']['name'];
                $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed)) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Invalid icon type']);
                    return;
                }
                $destDir = __DIR__ . '/../../public/assets/icons';
                if (!is_dir($destDir)) {
                    mkdir($destDir, 0755, true);
                }
                $newName = uniqid('icon_') . '.' . $ext;
                if (!move_uploaded_file($tmp, $destDir . '/' . $newName)) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to move uploaded icon']);
                    return;
                }
                $iconPath = '/assets/icons/' . $newName;
            } elseif (!empty($data['icon'])) {
                // Accept an icon path passed in the payload
                $iconPath = $data['icon'];
            } elseif (!empty($data['title'])) {
                // If client passed image title (file name), map it to icon when it looks like an image
                $maybeExt = strtolower(pathinfo($data['title'], PATHINFO_EXTENSION));
                if (in_array($maybeExt, $allowed)) {
                    $iconPath = '/assets/icons/' . basename($data['title']);
                }
            }

            $insertData = [
                'name' => $data['name'],
                'surname' => $data['surname'],
                'position' => $data['position'] ?? null,
                'biography' => $data['biography'] ?? null,
            ];
            if ($iconPath) {
                $insertData['icon'] = $iconPath;
            }

            $id = $model->insert($insertData, $locale);
            http_response_code(201);
            echo json_encode(['id' => $id]);
            return;
        }

        // Update employee: accept PUT or POST with _method=PUT (so uploads via form-data work)
        if (
            (
                $_SERVER['REQUEST_METHOD'] === 'PUT' ||
                ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['_method']) && strtoupper($_REQUEST['_method']) === 'PUT')
            ) && $id !== null
        ) {

            // Accept either form fields (POST multipart/form-data) or JSON body
            if (!empty($_POST) || !empty($_FILES)) {
                $payload = $_POST;
            } else {
                $payload = json_decode(file_get_contents('php://input'), true) ?? [];
            }

            $updateData = [];
            foreach (['name', 'surname', 'position', 'biography'] as $field) {
                if (isset($payload[$field])) {
                    $updateData[$field] = trim($payload[$field]);
                }
            }

            // Handle uploaded icon file
            $allowed = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
            if (!empty($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['icon']['tmp_name'];
                $orig = $_FILES['icon']['name'];
                $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed)) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Invalid icon type']);
                    return;
                }
                $destDir = __DIR__ . '/../../public/assets/icons';
                if (!is_dir($destDir)) {
                    mkdir($destDir, 0755, true);
                }
                $newName = uniqid('icon_') . '.' . $ext;
                if (!move_uploaded_file($tmp, $destDir . '/' . $newName)) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to move uploaded icon']);
                    return;
                }
                $updateData['icon'] = '/assets/icons/' . $newName;
            } elseif (!empty($payload['icon'])) {
                $updateData['icon'] = $payload['icon'];
            } elseif (!empty($payload['title'])) {
                $maybeExt = strtolower(pathinfo($payload['title'], PATHINFO_EXTENSION));
                if (in_array($maybeExt, $allowed)) {
                    $updateData['icon'] = '/assets/icons/' . basename($payload['title']);
                }
            }

            if (empty($updateData)) {
                http_response_code(400);
                echo json_encode(['error' => 'No valid fields to update']);
                return;
            }

            $locale = LocaleManager::get();

            $model->update((int) $id, $updateData, $locale);
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
