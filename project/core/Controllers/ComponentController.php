<?php
namespace App\Controllers;

class ComponentController
{

    public function saveLandigPageComponent()
    {

        $path = $_POST['cmp'] ?? '';
        $html = $_POST['html'] ?? '';
        $bytes = file_put_contents(PUBLIC_ROOT . $path, $html);
        if ($bytes === false) {
            http_response_code(500);
            exit('Failed to write component file');
        }

        // 6) Success
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'ok',
            'bytes_written' => $bytes,
        ]);
    }
    public function saveComponent(): void
    {
        $componentName = $_POST['name'] ?? '';
        $componentContent = $_POST['content'] ?? '';

        if (empty($componentName) || empty($componentContent)) {
            http_response_code(400);
            exit('go fuck yourself');
        }

        $sanitizedName = preg_replace('/[^a-zA-Z0-9_]/', '', $componentName);
        $filePath = PUBLIC_ROOT . "/exportedPages/components/{$sanitizedName}.php";

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0775, true);
        }

        $bytesWritten = file_put_contents($filePath, $componentContent);

        if ($bytesWritten === false) {
            http_response_code(500);
            exit('Failed to save component');
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Component saved successfully',
            'bytes_written' => $bytesWritten,
        ]);
    }

    public function loadComponent(): void
    {
        $name = $_GET['cmp'] ?? '';
        $path = PUBLIC_ROOT . '/exportedPages/pages/' . $name . '.php';
        error_log($path);
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            http_response_code(400);
            exit('Invalid component name');
        }

        if (!isset($path)) {
            http_response_code(404);
            exit('Component not found');
        }
        error_log("path:" . $path);
        ob_start();
        include $path;
        $html = ob_get_clean();

        header('Content-Type: text/html; charset=utf-8');
        echo $html;
    }
}