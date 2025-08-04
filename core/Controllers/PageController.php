<?php
// src/Controllers/PageController.php

namespace App\Controllers;

class PageController
{
    public function home()
    {
        $exportedIndex = PUBLIC_ROOT . '/exportedPages/index.php';
        error_log($exportedIndex);
        if (file_exists($exportedIndex)) {
            require $exportedIndex;
            return;
        } else {
            include PUBLIC_ROOT . '/pages/index.php';
        }
    }
    public function search()
    {
        include PUBLIC_ROOT . '/pages/search.php';

    }

    public function buildWizard()
    {
        require PUBLIC_ROOT . '/admin/buildWizard/index.php';
        return;
    }
    public function kontaktTemplate()
    {
        ob_start();
        include PUBLIC_ROOT . '/../templates/basicPages/kontakt.php';
        $html = ob_get_clean();
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        return;
    }
    public function gallery()
    {
        require PUBLIC_ROOT . '/editor/pages/gallery.php';
        return;
    }
    public function chats()
    {
        require PUBLIC_ROOT . '/editor/pages/chats.php';
        return;
    }
    public function aboutUS()
    {
        require PUBLIC_ROOT . '/editor/pages/aboutus.php';
        return;
    }
    public function adminStyle()
    {
        require PUBLIC_ROOT . '/superAdmin/pages/style.php';
        return;
    }
    public function userStyle()
    {
        require PUBLIC_ROOT . '/superAdmin/pages/users.php';
        return;
    }
    public function categoryStyle()
    {
        require PUBLIC_ROOT . '/superAdmin/pages/categories.php';
        return;
    }
    public function savePagesjson()
    {
        $jsonFile = $_SERVER['DOCUMENT_ROOT'] . '/assets/data/pages.json';
        $exportBase = dirname(__DIR__) . '/../public/exportedPages/';

        // 1) Load old data
        $oldData = [];
        if (file_exists($jsonFile)) {
            $oldRaw = file_get_contents($jsonFile);
            $oldData = json_decode($oldRaw, true) ?: [];
        }
        $oldPaths = array_column($oldData, 'path');

        // 2) Read new data from POST
        $raw = file_get_contents('php://input');
        $incoming = json_decode($raw, true);
        if (!isset($incoming['data']) || !is_array($incoming['data'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON input']);
            return;
        }
        $newData = $incoming['data'];
        $newPaths = array_column($newData, 'path');

        // 3) Compute removals & additions
        $toDelete = array_diff($oldPaths, $newPaths);
        $toCreate = array_diff($newPaths, $oldPaths);

        // 4) Recursive delete helper
        $rmDir = function (string $dir) use (&$rmDir) {
            if (!file_exists($dir))
                return;
            if (is_file($dir) || is_link($dir)) {
                unlink($dir);
                return;
            }
            foreach (scandir($dir) as $item) {
                if ($item === '.' || $item === '..')
                    continue;
                $rmDir($dir . DIRECTORY_SEPARATOR . $item);
            }
            rmdir($dir);
        };

        // 5) Delete old pages
        foreach ($toDelete as $path) {
            $full = $exportBase . $path;
            error_log("Deleting old page: $full");
            $rmDir($full);
        }

        foreach ($toCreate as $path) {
            $full = $exportBase . $path;

            $dir = dirname($full);
            if (!is_dir($dir)) {
                error_log("Creating parent directory: $dir");
                mkdir($dir, 0755, true);
            }

            // Create the PHP file if it doesn't exist
            if (!file_exists($full)) {
                error_log("Creating new PHP file: $full");
                file_put_contents($full, "<?php\n// New page: $path\n");
            }
        }

        // 7) Finally overwrite JSON
        file_put_contents($jsonFile, json_encode($newData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode(['success' => true, 'message' => 'Pages saved']);
    }


    public function documents()
    {
        require PUBLIC_ROOT . '/editor/pages/documents.php';
        return;
    }
    public function promotion()
    {
        require PUBLIC_ROOT . '/editor/pages/promotion.php';
        return;
    }
    public function renderJsonPage()
    {
        // get the current URI:
        $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $pages = json_decode(
            file_get_contents(PUBLIC_ROOT . '/assets/data/pages.json'),
            true
        );

        foreach ($pages as $page) {
            if ($page['href'] === $uri) {
                include PUBLIC_ROOT . '/exportedPages/' . $page['path'];
                return;
            }
        }

        // fallback if not found
        http_response_code(404);
        include PUBLIC_ROOT . '/pages/404.php';
    }
    public function complaints()
    {
        require PUBLIC_ROOT . '/editor/pages/complaints.php';
        return;
    }
    public function dashboard()
    {
        require PUBLIC_ROOT . '/editor/pages/dashboard.php';
        return;
    }

    public function events()
    {
        require PUBLIC_ROOT . '/editor/pages/events.php';
        return;
    }
    public function template()
    {

        $tip = isset($_GET['tipUstanove'])
            ? preg_replace('/[^\w]/', '', $_GET['tipUstanove'])
            : '';
        $template = dirname(PUBLIC_ROOT) . "/templates/{$tip}/original/index.php";
        error_log("greska:" . $template);
        if (is_file($template)) {
            require $template;
        }
        return;
    }

    public function style()
    {
        require PUBLIC_ROOT . '/admin/style.php';
        return;
    }
    public function savePage()
    {
        require PUBLIC_ROOT . '/admin/savePage.php';
        return;
    }
    public function login()
    {
        require PUBLIC_ROOT . '/auth/login.php';
        return;
    }



}