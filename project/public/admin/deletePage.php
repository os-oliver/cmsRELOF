<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Controllers\AuthController;

// Require admin authentication
AuthController::requireAdmin();

header('Content-Type: application/json');

try {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (!is_array($data) || empty($data['id'])) {
        throw new Exception('Missing page id to delete');
    }

    $pageId = $data['id'];
    $pagesJsonPath = __DIR__ . "/../assets/data/pages.json";
    $exportedPagesDir = __DIR__ . "/../exportedPages/pages/";

    $existingContent = file_exists($pagesJsonPath) ? file_get_contents($pagesJsonPath) : '[]';
    $pages = json_decode($existingContent, true) ?: [];

    $found = false;
    $newPages = [];
    foreach ($pages as $page) {
        if (isset($page['id']) && $page['id'] === $pageId) {
            $found = true;
            // attempt to remove exported file if exists
            if (!empty($page['file'])) {
                $filePath = $exportedPagesDir . basename($page['file']);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
            continue; // skip adding to newPages
        }
        $newPages[] = $page;
    }

    if (!$found) {
        throw new Exception('Page not found');
    }

    if (file_put_contents($pagesJsonPath, json_encode($newPages, JSON_PRETTY_PRINT)) === false) {
        throw new Exception('Failed to write pages.json');
    }

    echo json_encode(['success' => true, 'message' => 'Page deleted', 'pages' => $newPages]);
    exit;
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit;
}
