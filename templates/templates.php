<?php
$basePath = realpath(__DIR__ . '/../../templates');

function listTemplates($path) {
    $dirs = array_filter(glob($path . '/*'), 'is_dir');
    $result = [];

    foreach ($dirs as $dir) {
        $name = basename($dir);
        $originalPath = $dir . '/original/index.php';
        $hasOriginal = file_exists($originalPath);

        $result[] = [
            'name' => $name,
            'original' => $hasOriginal ? '/templates/' . $name . '/original/index.php' : null,
            'edited' => is_dir($dir . '/edited') ? '/templates/' . $name . '/edited' : null,
        ];
    }

    return $result;
}

header('Content-Type: application/json');
echo json_encode(listTemplates($basePath));
