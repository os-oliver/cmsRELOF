<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Admin\PageBuilders\BasicPageBuilder;
use App\Controllers\AuthController;
use App\Admin\PageExporter;
use App\Models\GenericCategory;
use App\Models\Page;
use App\Controllers\UserDefinedPagesController;

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

    // build a helper map from page id -> column name using provided pageAssignments & columns
    $columnsMap = [];
    if (!empty($data['columns']) && is_array($data['columns'])) {
        foreach ($data['columns'] as $col) {
            if (isset($col['id'])) {
                $columnsMap[$col['id']] = $col['name'] ?? null;
            }
        }
    }

    $pageToColumn = [];
    if (!empty($data['pageAssignments']) && is_array($data['pageAssignments'])) {
        foreach ($data['pageAssignments'] as $colId => $pageIds) {
            $colName = $columnsMap[$colId] ?? null;
            if (!is_array($pageIds))
                continue;
            foreach ($pageIds as $pid) {
                $pageToColumn[$pid] = $colName;
            }
        }
    }

    foreach ($data['pages'] as $page) {
        error_log(json_encode($page));
        // Determine target column from assignments (page id is used by frontend)
        $columnName = $pageToColumn[$page['id']] ?? null; // null means top-level (no column)
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
        $builder->setHtml('<main class="min-h-screen pt-24 flex-grow">
        </main>');
        $basicPageContent = $builder->buildPage();

        // Save the file
        if (file_put_contents($filePath, $basicPageContent) === false) {
            throw new Exception("Failed to create page file: " . $filePath);
        }

        // Update page data
        $page['path'] = "pages/" . $cleanFileName . ".php";
        // Build href: include column segment if assigned
        if ($columnName && trim((string) $columnName) !== '') {
            $page['href'] = "/" . trim($columnName, '/') . "/" . $cleanFileName;
        } else {
            $page['href'] = "/" . $cleanFileName;
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

        // Sync to database: insert/update userdefinedpages + text
        try {
            $syncer = new UserDefinedPagesController();
            $result = $syncer->syncPagesFromJson($allPages);
        } catch (\Throwable $e) {
            error_log('Sync pages to DB failed: ' . $e->getMessage());
            // proceed — don't fail export just because DB sync failed
            $result = ['error' => $e->getMessage()];
        }

        sendJson([
            "success" => true,
            "message" => $message,
            "pages" => $allPages,
            "action" => $action,
            "db_sync" => $result
        ]);
    }

    throw new Exception("Failed to save static pages");
}



function handleExport(array $data): void
{
    $exporter = new PageExporter($data);
    $saveComponents = $data['singlePage'] ?? false;

    if ($saveComponents) {
        error_log("Exporting single page...");
        $exporter->exportSinglePage();
        sendJson(["success" => true, "message" => "Single page exported successfully"]);
    } else {
        error_log("Starting full pages export...");
        $exporter->export();
        sendJson(["success" => true, "message" => "All pages exported successfully"]);
    }
}

try {
    $data = getJsonInput();

    if (($data['type'] ?? '') === 'static') {
        handleStaticPages($data);
        exit;
    }

    $saveComponents = $data['singlePage'] ?? false;

    if (!$saveComponents) {
        error_log("Handling dynamic page export...");
        $jsonPath = __DIR__ . "/../../templates/" . $data['typeOfInstitution'] . "/json/data_definition.json";
        if (!file_exists($jsonPath))
            throw new Exception("JSON file not found: $jsonPath");

        $jsonContent = file_get_contents($jsonPath);
        if ($jsonContent === false)
            throw new Exception("Failed to read JSON definition file.");

        file_put_contents(__DIR__ . "/../../public/assets/data/structure.json", $jsonContent);

        $dataArray = json_decode($jsonContent, true);
        if (!is_array($dataArray))
            throw new Exception("Invalid JSON format.");

        $allCategoriesToInsert = [];
        foreach ($dataArray as $type) {
            foreach ($type as $typeKey => $typeData) {
                foreach (($typeData['categories'] ?? []) as $category) {
                    $allCategoriesToInsert[] = ['name' => $category, 'type' => $typeKey];
                    error_log("- Category: $category");
                }
            }
        }

        GenericCategory::replaceAllCategories($allCategoriesToInsert)
            ? error_log("Categories inserted successfully.")
            : error_log("Error inserting categories.");
    } else {
        error_log("Single page export mode — skipping structure and categories.");
    }

    handleExport($data);

} catch (Exception $e) {
    error_log("Error during export: " . $e->getMessage());
    sendJson(["success" => false, "error" => $e->getMessage()], 400);
}
