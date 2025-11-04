<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\UserDefinedPagesController;

header('Content-Type: application/json');

try {
    $ctrl = new UserDefinedPagesController();
    $pages = $ctrl->getPages();
    echo json_encode($pages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
