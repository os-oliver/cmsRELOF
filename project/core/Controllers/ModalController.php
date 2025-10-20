<?php
namespace App\Controllers;

use App\Models\Content;
use App\Utils\ModalGenerator;
use App\Database;
use PDO;

class ModalController
{
    public function get()
    {
        // ensure session is started when handling the request
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        // expects ?slug=...
        $slug = $_GET['slug'] ?? null;
        if (!$slug) {
            http_response_code(400);
            echo 'Missing slug';
            return;
        }

        $structureFile = __DIR__ . '/../../public/assets/data/structure.json';
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
        // Case-insensitive lookup: structure keys may be capitalized (e.g. "Vesti")
        foreach ($data as $entry) {
            foreach ($entry as $key => $val) {
                if (strcasecmp((string) $key, (string) $slug) === 0) {
                    $config = $val;
                    break 2;
                }
            }
        }

        if ($config === null) {
            http_response_code(404);
            echo 'Config not found for slug: ' . htmlspecialchars($slug);
            return;
        }

        try {
            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

            // If id provided, fetch item data and prefill fields values
            if ($id > 0) {
                $cc = new Content();
                $itemResp = $cc->fetchItem($id);

                if (!empty($itemResp['success']) && !empty($itemResp['item'])) {
                    $item = $itemResp['item'];

                    // Map text-like values back into config fields
                    foreach ($config['fields'] as &$f) {
                        $name = $f['name'] ?? null;
                        $val = '';

                        if ($name && isset($item['fields'][$name])) {
                            if (isset($item['fields'][$name][$locale]) && $item['fields'][$name][$locale] !== '') {
                                $val = $item['fields'][$name][$locale];
                            } else {
                                $first = array_values($item['fields'][$name]);
                                $val = $first[0] ?? '';
                            }
                        }

                        $f['value'] = $val;

                        // 🟢 Automatically set value for category-type fields
                        if (($f['type'] ?? '') === 'categories' && isset($item['category_id'])) {
                            $f['value'] = (string) $item['category_id'];
                        }
                    }

                    // Also pass id so the modal form can include it
                    $config['item_id'] = $id;

                    // Fetch attached images using Image model helper
                    try {
                        $images = \App\Models\Image::fetchFilePathsForElement($id);
                        if (!empty($images)) {
                            foreach ($config['fields'] as &$f) {
                                $ft = $f['type'] ?? 'text';
                                if ($ft === 'file') {
                                    // store JSON array of paths for multifile
                                    $f['value'] = json_encode(array_values($images), JSON_UNESCAPED_UNICODE);
                                }
                            }
                        }
                    } catch (\Throwable $__e) {
                        error_log('Modal image load error: ' . $__e->getMessage());
                    }
                }
            }

            $modal = new ModalGenerator($config, $slug, $locale);
            header('Content-Type: text/html; charset=utf-8');
            echo $modal->render();
        } catch (\Throwable $e) {
            http_response_code(500);
            echo 'Error rendering modal: ' . htmlspecialchars($e->getMessage());
        }
    }
}
