<?php
namespace App\Controllers;

use App\Utils\ModalGenerator;

class ModalController
{
    public function get()
    {
        // expects ?slug=...
        $slug = $_GET['slug'] ?? null;
        if (!$slug) {
            http_response_code(400);
            echo 'Missing slug';
            return;
        }

        $structureFile = __DIR__ . '/../../public/structure.json';
        if (!file_exists($structureFile)) {
            http_response_code(500);
            echo 'Structure file not found';
            return;
        }

        $json = file_get_contents($structureFile);
        $data = json_decode($json, true);
        if (!is_array($data)) {
            http_response_code(500);
            echo 'Invalid structure file';
            return;
        }

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
            return;
        }

        try {
            $modal = new ModalGenerator($config, 'dynamicModal_' . preg_replace('/[^a-z0-9_]/i', '_', $slug));
            header('Content-Type: text/html; charset=utf-8');
            echo $modal->render();
        } catch (\Throwable $e) {
            http_response_code(500);
            echo 'Error rendering modal: ' . htmlspecialchars($e->getMessage());
        }
    }
}
