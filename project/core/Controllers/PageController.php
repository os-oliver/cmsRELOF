<?php
// src/Controllers/PageController.php

namespace App\Controllers;

use App\Controllers\PersonalContentController;
use Exception;

class PageController
{
    private const TEMPLATE_SLUG_MAP = [
        // 'biblioteka' => 'Biblioteka',
        // 'centar-za-kulturu' => 'CentarZaKulturu',
        'informacije-od-javnog-znacaja' => 'InformacijeOdJavnogZnacaja',
        // 'istorijski-arhiv' => 'IstorijskiArhiv',
        // 'muzej-galerija' => 'MuzejGalerija',
        // 'obrazovna-ustanova' => 'ObrazovnaUstanova',
        // 'omladinski-centar' => 'OmladinskiCentar',
        // 'pozoriste' => 'Pozoriste',
        // 'predskolska-ustanova' => 'PredskolskaUstanova',
        // 'socijalna-ustanova' => 'SocijalnaUstanova',
        // 'sport' => 'Sport',
        // 'turizam' => 'Turizam',
    ];

    private function loadTemplate(string $templateName): void
    {
        $templatePath = dirname(PUBLIC_ROOT) . "/templates/{$templateName}/original/index.php";

        if (!is_file($templatePath)) {
            error_log("Template not found: {$templatePath}");
            http_response_code(404);
            include PUBLIC_ROOT . '/pages/404.php';
            return;
        }

        require $templatePath;
    }


    public function createPage()
    {
        require PUBLIC_ROOT . '/admin/createPage.php';
        return;
    }
    public function test()
    {
        require PUBLIC_ROOT . '/test.php';
        return;
    }
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
    public function StaticPageEditor()
    {
        require PUBLIC_ROOT . '/editor/pages/StaticPageEditor.php';
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
    public function editorDynamic($params)
    {
        require PUBLIC_ROOT . '/editor/pages/dynamicPage.php';
        return;
    }
    public function colors()
    {
        require PUBLIC_ROOT . '/pages/color-scheme.php';
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

        foreach ($newData as $page) {
            $isStatic = isset($page['static']) && $page['static'] === true;
            $path = $page['path'];

            if ($isStatic) {
                // Handle static pages
                $staticBase = dirname(__DIR__) . '/../public/pages/';
                $full = $staticBase . $page['file'];

                $dir = dirname($full);
                if (!is_dir($dir)) {
                    error_log("Creating static page directory: $dir");
                    mkdir($dir, 0775, true);
                }

                if (!file_exists($full)) {
                    error_log("Creating new static PHP file: $full");
                    $template = "<?php\n";
                    $template .= "// Static page: {$page['name']}\n";
                    $template .= "// Created: " . date('Y-m-d H:i:s') . "\n\n";
                    $template .= "?>\n\n";
                    $template .= "<!DOCTYPE html>\n";
                    $template .= "<html lang=\"sr\">\n";
                    $template .= "<head>\n";
                    $template .= "    <meta charset=\"UTF-8\">\n";
                    $template .= "    <title>{$page['name']}</title>\n";
                    $template .= "</head>\n";
                    $template .= "<body>\n";
                    $template .= "    <h1>{$page['name']}</h1>\n";
                    $template .= "    <!-- Add your static content here -->\n";
                    $template .= "</body>\n";
                    $template .= "</html>";

                    file_put_contents($full, $template);
                }
            } else {
                // Handle dynamic/exported pages
                $full = $exportBase . $path;

                $dir = dirname($full);
                if (!is_dir($dir)) {
                    error_log("Creating exported page directory: $dir");
                    mkdir($dir, 0775, true);
                }

                if (!file_exists($full)) {
                    error_log("Creating new exported PHP file: $full");
                    file_put_contents($full, "<?php\n// Dynamic page: $path\n");
                }
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
                // Check if this is a static page
                if (isset($page['static']) && $page['static'] === true) {
                    $staticPath = PUBLIC_ROOT . '/pages/' . $page['file'];
                    if (file_exists($staticPath)) {
                        include $staticPath;
                        return;
                    }
                }

                // If not static or static file doesn't exist, try exported pages
                $exportPath = PUBLIC_ROOT . '/exportedPages/' . $page['path'];
                if (file_exists($exportPath)) {
                    include $exportPath;
                    return;
                }
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
        if ($tip === '') {
            http_response_code(404);
            include PUBLIC_ROOT . '/pages/404.php';
            return;
        }

        $this->loadTemplate($tip);
        return;
    }

    public function templateBySlug(string $templateSlug)
    {
        $templateSlug = strtolower($templateSlug);

        if (!isset(self::TEMPLATE_SLUG_MAP[$templateSlug])) {
            http_response_code(404);
            include PUBLIC_ROOT . '/pages/404.php';
            return;
        }

        $this->loadTemplate(self::TEMPLATE_SLUG_MAP[$templateSlug]);
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
    public function renderElement()
    {
        // Get parameters from GET query
        $id = $_GET['id'] ?? null;
        $type = $_GET['tip'] ?? null;

        if ($id === null || $type === null) {
            http_response_code(404);
            include PUBLIC_ROOT . '/pages/404.php';
            return;
        }

        // Initialize the PersonalContentController
        $contentController = new PersonalContentController();

        // Render the content with header and footer
        echo $contentController->renderContent($id, $type);
        echo require_once __DIR__ . '/../../public/exportedPages/landingPageComponents/landingPage/header.php';

    }
    public function componentSave()
    {
        try {
            // Provera da li su poslati potrebni parametri
            if (!isset($_POST['componentFileName']) || !isset($_POST['htmlContent'])) {
                throw new Exception('Nedostaju obavezni parametri');
            }

            $componentFileName = $_POST['componentFileName'];
            $htmlContent = $_POST['htmlContent'];

            // Sanitizacija imena fajla (bezbednost)
            $componentFileName = basename($componentFileName);

            // Provera ekstenzije
            if (!preg_match('/\.php$/i', $componentFileName)) {
                throw new Exception('Nevažeće ime fajla. Dozvoljeni su samo .php fajlovi.');
            }

            // Putanja do direktorijuma sa komponentama
            $componentsDir = realpath(__DIR__ . '/../../public/exportedPages/landingPageComponents/landingPage');

            if (!$componentsDir || !is_dir($componentsDir)) {
                throw new Exception('Direktorijum komponenti ne postoji');
            }

            // Puna putanja do fajla
            $filePath = $componentsDir . DIRECTORY_SEPARATOR . $componentFileName;

            // Dodatna bezbednosna provjera - da li je fajl zaista u očekivanom direktorijumu
            $realFilePath = realpath(dirname($filePath));
            if ($realFilePath !== $componentsDir) {
                throw new Exception('Nevalidan put do fajla');
            }

            // Provjera da li fajl postoji (za dodatnu sigurnost)
            if (!file_exists($filePath)) {
                throw new Exception('Fajl ne postoji: ' . $componentFileName);
            }

            // Kreiranje backup-a prije prepisivanja (opcionalno ali preporučeno)
            $backupDir = $componentsDir . DIRECTORY_SEPARATOR . 'backups';
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0755, true);
            }

            $backupFileName = pathinfo($componentFileName, PATHINFO_FILENAME) .
                '_backup_' . date('Y-m-d_H-i-s') . '.php';
            $backupPath = $backupDir . DIRECTORY_SEPARATOR . $backupFileName;

            // Pravljenje backup-a
            if (file_exists($filePath)) {
                copy($filePath, $backupPath);
            }

            // Pisanje novog sadržaja u fajl
            $bytesWritten = file_put_contents($filePath, $htmlContent);

            if ($bytesWritten === false) {
                // Ako pisanje ne uspe, vratimo backup
                if (file_exists($backupPath)) {
                    copy($backupPath, $filePath);
                }
                throw new Exception('Greška pri pisanju fajla');
            }

            // Čišćenje starih backup-ova (čuvamo samo poslednjih 10)
            $backupFiles = glob($backupDir . DIRECTORY_SEPARATOR . pathinfo($componentFileName, PATHINFO_FILENAME) . '_backup_*.php');
            if (count($backupFiles) > 10) {
                // Sortiramo po vremenu (najstariji prvo)
                usort($backupFiles, function ($a, $b) {
                    return filemtime($a) - filemtime($b);
                });

                // Brišemo najstarije
                $toDelete = array_slice($backupFiles, 0, count($backupFiles) - 10);
                foreach ($toDelete as $oldBackup) {
                    unlink($oldBackup);
                }
            }

            // Logovanje promene (opcionalno)
            $logFile = $componentsDir . DIRECTORY_SEPARATOR . 'changes.log';
            $logEntry = sprintf(
                "[%s] %s je izmenio/la %s (%d bytes)\n",
                date('Y-m-d H:i:s'),
                $_SESSION['email'] ?? 'Unknown',
                $componentFileName,
                $bytesWritten
            );
            file_put_contents($logFile, $logEntry, FILE_APPEND);

            // Uspešan odgovor
            echo json_encode([
                'success' => true,
                'message' => 'Komponenta je uspešno sačuvana',
                'fileName' => $componentFileName,
                'bytes' => $bytesWritten,
                'backupCreated' => file_exists($backupPath)
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function deletePage()
    {
        require PUBLIC_ROOT . '/admin/deletePage.php';
        return;
    }
    public function login()
    {
        require PUBLIC_ROOT . '/auth/login.php';
        return;
    }



}
