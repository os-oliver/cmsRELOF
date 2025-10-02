<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Controllers\AuthController;
use App\Controllers\UserDefinedPagesController;

// Require admin authentication
AuthController::requireAdmin();

header('Content-Type: application/json');

try {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (!is_array($data) || (empty($data['id']) && empty($data['href']))) {
        throw new Exception('Missing page identifier to delete');
    }

    $pageId = $data['id'] ?? null;
    $pageHref = $data['href'] ?? null;
    $pagesJsonPath = __DIR__ . "/../assets/data/pages.json";
    $exportedPagesDir = __DIR__ . "/../exportedPages/pages/";

    $existingContent = file_exists($pagesJsonPath) ? file_get_contents($pagesJsonPath) : '[]';
    $pages = json_decode($existingContent, true) ?: [];

    $found = false;
    $newPages = [];
    foreach ($pages as $page) {
        $pageIdentifier = isset($page['id']) ? (string) $page['id'] : (isset($page['href']) ? (string) $page['href'] : '');
        // match by href if provided, else by id
        if (($pageHref && isset($page['href']) && $page['href'] === $pageHref) || ($pageId !== null && $pageIdentifier === (string) $pageId)) {
            $found = true;
            // attempt to remove exported file if exists
            if (!empty($page['file'])) {
                $filePath = $exportedPagesDir . basename($page['file']);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            // attempt to delete from DB (href or id), but don't fail the whole request if DB delete fails
            // Try DB deletion by href or id (best-effort)
            try {
                $controller = new UserDefinedPagesController();
                if ($pageHref) {
                    $controller->deleteByIdentifier($pageHref);
                } elseif (!empty($page['href'])) {
                    $controller->deleteByIdentifier($page['href']);
                } elseif ($pageId) {
                    $controller->deleteByIdentifier($pageId);
                }
            } catch (\Throwable $e) {
                error_log('Failed to delete userdefinedpage from DB: ' . $e->getMessage());
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
