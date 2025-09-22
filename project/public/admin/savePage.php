<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Admin\PageBuilders\BasicPageBuilder;
use App\Controllers\AuthController;
use App\Admin\PageExporter;

// Require admin authentication
AuthController::requireAdmin();

// Always return JSON
header("Content-Type: application/json");

/**
 * Read and decode JSON request body
 *
 * @return array
 * @throws Exception
 */
function getJsonInput(): array
{
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        throw new Exception("Invalid or missing JSON payload");
    }

    return $data;
}

/**
 * Send JSON response and exit
 */
function sendJson($payload, int $httpCode = 200): void
{
    http_response_code($httpCode);
    echo json_encode($payload, JSON_PRETTY_PRINT);
    exit;
}

/**
 * Handle static pages update/create/remove
 */
function handleStaticPages(array $data): void
{
    $pagesJsonPath = __DIR__ . "/../assets/data/pages.json";
    $pagesBasePath = __DIR__ . "/../exportedPages/";

    // Read existing pages
    $existingContent = file_exists($pagesJsonPath) ? file_get_contents($pagesJsonPath) : '[]';
    $existingPages = json_decode($existingContent, true) ?: [];

    // Check if this is a new page addition or column state update
    $action = $data['action'] ?? 'update'; // 'add' for new page, 'update' for column changes

    // Keep only non-static pages
    $dynamicPages = array_filter($existingPages, function ($page) {
        return empty($page['static']);
    });

    // If pages array is empty and type is static, we're clearing all static pages
    if (empty($data['pages'])) {
        if (file_put_contents($pagesJsonPath, json_encode(array_values($dynamicPages), JSON_PRETTY_PRINT))) {
            sendJson([
                "success" => true,
                "message" => "All static pages removed successfully",
                "pages" => array_values($dynamicPages)
            ]);
        }

        throw new Exception("Failed to update pages.json");
    }

    $processedPages = [];

    foreach ($data['pages'] as $page) {
        error_log(json_encode($page));
        $columnName = $page['column'] ?? null; // Default to 'static' if no column specified
        $fileName = $page['name'];
        $cleanFileName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $fileName));

        // Ensure exported pages/pages directory exists
        $pagesDir = rtrim($pagesBasePath, '/') . '/pages';
        if (!is_dir($pagesDir)) {
            if (!mkdir($pagesDir, 0777, true) && !is_dir($pagesDir)) {
                throw new Exception("Failed to create directory: " . $pagesDir);
            }
        }

        // Prepare file path and content
        $filePath = $pagesDir . '/' . $cleanFileName . '.php';
        $builder = new BasicPageBuilder($page['name'], [
            'css' => ' .dropdown:hover .dropdown-menu {
                display: block;
            }

            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: white;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
                z-index: 1;
                border-radius: 8px;
                overflow: hidden;
            }
',
            'js' => ''
        ]);

        $basicPageContent = $builder->buildPage();

        // Save the file
        if (file_put_contents($filePath, $basicPageContent) === false) {
            throw new Exception("Failed to create page file: " . $filePath);
        }

        // Update page data
        $page['path'] = "pages/" . $cleanFileName . ".php";
        if (!$columnName) {
            $page['href'] = "/" . $cleanFileName;

        } else {
            $page['href'] = "/" . $columnName . "/" . $cleanFileName;

        }
        $page['file'] = $cleanFileName . ".php";

        $processedPages[] = $page;
    }

    // Combine all pages
    $allPages = array_merge(array_values($dynamicPages), $processedPages);

    // Save to pages.json
    if (file_put_contents($pagesJsonPath, json_encode($allPages, JSON_PRETTY_PRINT))) {
        $message = $action === 'add' ?
            "Nova stranica uspešno dodata" :
            "Promene uspešno sačuvane";

        sendJson([
            "success" => true,
            "message" => $message,
            "pages" => $allPages,
            "action" => $action
        ]);
    }

    throw new Exception("Failed to save static pages");
}

/**
 * Handle standard page export
 */
function handleExport(array $data): void
{
    $exporter = new PageExporter($data);
    $saveComponents = $data['singlePage'] ?? false;

    if ($saveComponents) {
        $exporter->exportSinglePage();
        sendJson([
            "success" => true,
            "message" => "Single page exported successfully"
        ]);
    }

    $exporter->export();
    sendJson([
        "success" => true,
        "message" => "All pages exported successfully"
    ]);
}

// Main execution
try {
    $data = getJsonInput();

    if (isset($data['type']) && $data['type'] === 'static') {
        handleStaticPages($data);
    }

    handleExport($data);

} catch (Exception $e) {
    error_log("Error during export: " . $e->getMessage());
    sendJson([
        "success" => false,
        "error" => $e->getMessage()
    ], 400);
}
