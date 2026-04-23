<?php
// Simple endpoint to return modal HTML for a given slug
declare(strict_types=1);
chdir(__DIR__ . '/../../..'); // ensure project root
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Utils\ModalGenerator;

header('Content-Type: text/html; charset=utf-8');

$slug = $_GET['slug'] ?? null;
if (!$slug) {
    http_response_code(400);
    echo 'Missing slug';
    exit;
}

$structureFile = __DIR__ . '/../../public/assets/data/structure.json';
if (!file_exists($structureFile)) {
    http_response_code(500);
    echo 'Structure file not found';
    exit;
}

$json = file_get_contents($structureFile);
$data = json_decode($json, true);
if (!is_array($data)) {
    http_response_code(500);
    echo 'Invalid structure file';
    exit;
}

// structure.json is an array of objects where keys are slugs
$config = null;
foreach ($data as $entry) {
    if (isset($entry[$slug])) {
        $config = $entry[$slug];
        break;
    }
}

if ($config === null) {
    http_response_code(404);
    echo 'Config not found for slug: ' . htmlspecialchars($slug);
    exit;
}

// Build modal using ModalGenerator
try {
    $modal = new ModalGenerator($config, 'dynamicModal_' . preg_replace('/[^a-z0-9_]/i', replacement: '_', ));
    echo $config;
    echo $modal->render();
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Error rendering modal: ' . htmlspecialchars($e->getMessage());
}

?>