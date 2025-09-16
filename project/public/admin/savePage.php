<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Controllers\AuthController;
use App\Admin\PageExporter;

// Require admin authentication
AuthController::requireAdmin();

// Set content type for response
header("Content-Type: text/plain");

try {
    // Get and validate input data
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);



    // Create exporter and process the data
    $exporter = new PageExporter($data);
    $saveComponents = $data['saveComponents'] ?? false;
    if ($saveComponents) {
        $exporter->exportSinglePage();
    } else {
        $exporter->export();
    }

    echo "Export completed successfully";
} catch (Exception $e) {
    http_response_code(400);
    echo "Error: " . $e->getMessage();
}
