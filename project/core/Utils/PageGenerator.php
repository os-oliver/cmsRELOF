<?php

namespace App\Utils;

class PageGenerator {
    private string $baseDir;
    private string $compDir;
    private string $pagesDir;
    private array $data;
    private ?string $headerPath = null;
    private ?string $footerPath = null;
    private array $sectionPaths = [];

    /**
     * Initialize the PageGenerator with the input data
     * @param array $data The input data containing components, tree, and other settings
     */
    public function __construct(array $data) 
    {
        $this->data = $data;
        $this->initializeDirectories();
    }

    /**
     * Initialize the required directories
     */
    private function initializeDirectories(): void 
    {
        $this->baseDir = dirname(__DIR__, 2) . '/public/exportedPages';
        $this->compDir = "{$this->baseDir}/landingPageComponents";
        $this->pagesDir = "{$this->baseDir}/pages";

        // Create directories if they don't exist
        foreach ([$this->baseDir, $this->compDir, $this->pagesDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    /**
     * Save components to their respective directories
     * @return void
     */
    public function saveComponents(): void 
    {
        foreach ($this->data['components'] as $component) {
            foreach ($component as $filePath => $content) {
                $fullPath = "{$this->compDir}/$filePath";
                $dirPath = dirname($fullPath);
                
                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0755, true);
                }

                if (strpos($filePath, 'promocija.php') !== false) {
                    $content = $content . '\n' . $this->data['js'];
                }
                
                $content = str_replace(['&lt;', '&gt;', '\$'], ['<', '>', '$'], $content);
                file_put_contents($fullPath, $content);

                $this->categorizeComponent($filePath);
            }
        }
    }

    /**
     * Categorize components based on their file paths
     * @param string $filePath The file path to categorize
     * @return void
     */
    private function categorizeComponent(string $filePath): void 
    {
        if (strpos($filePath, 'header.php') !== false) {
            $this->headerPath = $filePath;
        } elseif (strpos($filePath, 'footer.php') !== false) {
            $this->footerPath = $filePath;
        } elseif (strpos($filePath, '.php') !== false) {
            $this->sectionPaths[] = $filePath;
        }
    }

    /**
     * Generate the index.php file content
     * @return void
     */
    public function generateIndexFile(): void 
    {
        $indexContent = $this->generatePhpHeader();
        $indexContent .= $this->generateHtmlHeader();
        $indexContent .= $this->generateMainContent();
        $indexContent .= $this->generateHtmlFooter();

        file_put_contents("{$this->baseDir}/index.php", $indexContent);
    }

    /**
     * Generate the PHP header section
     * @return string
     */
    private function generatePhpHeader(): string 
    {
        return <<<'PHP'
<?php
session_start();
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';

use App\Models\Event;
use App\Models\Text;

// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);

[$events, $totalEvents] = (new Event)->all(lang:$locale);
use App\Models\Gallery;
[$images, $totalEvents] = (new Gallery)->list();
?>
PHP;
    }

    /**
     * Generate the HTML header section
     * @return string
     */
    private function generateHtmlHeader(): string 
    {
        $header = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exported Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
HTML;

        if (!empty($this->data['css'])) {
            $header .= htmlspecialchars($this->data['css'], ENT_QUOTES) . "\n";
        }

        $header .= "</style>\n</head>\n<div class=\"min-h-screen flex flex-col\">";

        if ($this->headerPath) {
            $header .= "\n<?php require_once __DIR__ . '/landingPageComponents/{$this->headerPath}'; ?>";
        }

        return $header;
    }

    /**
     * Generate the main content section
     * @return string
     */
    private function generateMainContent(): string 
    {
        $content = "\n<main class=\"flex-grow\">";
        
        foreach ($this->sectionPaths as $path) {
            $content .= "\n<?php require_once __DIR__ . '/landingPageComponents/$path'; ?>";
        }
        
        $content .= "\n</main>";
        return $content;
    }

    /**
     * Generate the HTML footer section
     * @return string
     */
    private function generateHtmlFooter(): string 
    {
        $footer = '';
        
        if ($this->footerPath) {
            $footer .= "\n<?php require_once __DIR__ . '/landingPageComponents/{$this->footerPath}'; ?>";
        }

        if (!empty($this->data['js'])) {
            $footer .= "\n" . $this->data['js'] . "\n";
        }

        $footer .= "\n</body>\n</html>";
        return $footer;
    }
}