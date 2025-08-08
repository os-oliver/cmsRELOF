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
        // 1) Gather and validate input
        $name = $_POST['cmp'] ?? '';
        $html = $_POST['html'] ?? '';
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            http_response_code(400);
            exit('Invalid component name');
        }

        // 2) Build the path and check file exists
        $path = PUBLIC_ROOT . '/exportedPages/pages/' . $name . '.php';
        if (!file_exists($path)) {
            http_response_code(404);
            exit('Component not found');
        }

        // 3) Load the template file
        $template = file_get_contents($path);
        if ($template === false) {
            http_response_code(500);
            exit('Failed to read component file');
        }

        // 4) Replace the contents inside <main>…</main>
        $pattern = '/(<main\b[^>]*>)(.*?)(<\/main>)/si';
        if (preg_match($pattern, $template)) {
            $newTemplate = preg_replace(
                $pattern,
                '$1' . $html . '$3',
                $template
            );
        } else {
            // If there's no <main> tag, you could choose to append it, or error
            http_response_code(500);
            exit('No <main> tag found in component');
        }

        // 5) Write the updated content back
        $bytes = file_put_contents($path, $newTemplate);
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
        exit;
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