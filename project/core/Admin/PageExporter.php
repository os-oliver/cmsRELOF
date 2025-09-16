<?php

namespace App\Admin;

use App\Admin\PageBuilders\MissionPageBuilder;
use App\Controllers\AuthController;
use App\Models\Text;
use App\Models\Event;
use App\Models\Gallery;
use App\Admin\PageBuilders\BasePageBuilder;
use App\Admin\PageBuilders\GalleryPageBuilder;
use App\Admin\PageBuilders\ContactPageBuilder;
use App\Admin\PageBuilders\DocumentsPageBuilder;
use App\Admin\PageBuilders\BasicPageBuilder;
use App\Admin\PageBuilders\EventsPageBuilder;
use DOMDocument;
use DOMNode;
use DOMXPath;
use Exception;

AuthController::requireAdmin();

class PageExporter
{
    private $baseDir;
    private $compDir;
    private $pagesDir;
    private $data;
    private $headerPath = null;
    private $footerPath = null;
    private $sectionPaths = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->baseDir = dirname(__DIR__) . '/../public/exportedPages';
        $this->compDir = "{$this->baseDir}/landingPageComponents";
        $this->pagesDir = "{$this->baseDir}/pages";
        $this->ensureDirectories();
    }

    private function ensureDirectories(): void
    {
        foreach ([$this->baseDir, $this->compDir, $this->pagesDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }


    private function generateTextId(string $text, string $path, string $pageSlug): string
    {
        $pathHash = substr(md5($path), 0, 6);
        $textHash = substr(md5($text), 0, 6);
        return "t_{$pageSlug}_{$pathHash}_{$textHash}";
    }

    private function shouldMakeDynamic(string $text, \DOMNode $node): bool
    {
        // Trim the text for checking
        $text = trim($text);

        // Skip if empty or too short
        if (empty($text) || strlen($text) < 3) {
            return false;
        }

        // Skip if it contains PHP code
        if (strpos($text, '<?') !== false || strpos($text, '?>') !== false) {
            return false;
        }

        // Skip if parent node contains php tags
        $parentContent = $node->parentNode->nodeValue;
        if (strpos($parentContent, '<?php') !== false || strpos($parentContent, '?>') !== false) {
            return false;
        }

        // Skip if it's just numbers or special characters
        if (!preg_match('/[a-zA-Z\p{Cyrillic}]{3,}/u', $text)) {
            return false;
        }

        // Skip if it looks like a variable or code
        if (preg_match('/^\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $text)) {
            return false;
        }

        // Skip if inside a script, style, or element with class "nonPage"
        $parent = $node->parentNode;
        while ($parent) {
            if ($parent instanceof \DOMElement) {
                // script or style
                if (in_array(strtolower($parent->nodeName), ['script', 'style'])) {
                    return false;
                }
                // class="nonPage"
                if ($parent->hasAttribute('class')) {
                    $classAttr = $parent->getAttribute('class');
                    if (preg_match('/\bnonPage\b/', $classAttr)) {
                        return false;
                    }
                }
            }
            $parent = $parent->parentNode;
        }

        // Only convert text that appears to be natural language content
        return preg_match('/^[\p{L}\s\p{P}]+$/u', $text);
    }


    private function getElementPath(DOMNode $node): string
    {
        $path = [];
        $current = $node;
        while ($current && $current->nodeType === XML_ELEMENT_NODE) {
            $index = 0;
            $sibling = $current->previousSibling;
            while ($sibling) {
                if ($sibling->nodeName === $current->nodeName) {
                    $index++;
                }
                $sibling = $sibling->previousSibling;
            }
            array_unshift($path, $current->nodeName . '_' . $index);
            $current = $current->parentNode;
        }
        return implode('/', $path);
    }

    private function processContent(string $content, string $pageSlug): string
    {
        // Save PHP code blocks first for proper nesting
        $phpBlocks = [];
        $content = preg_replace_callback('/<\?.*?\?>/s', function ($matches) use (&$phpBlocks) {
            $placeholder = '##PHP_BLOCK_' . count($phpBlocks) . '##';
            $phpBlocks[$placeholder] = $matches[0];
            return $placeholder;
        }, $content);

        // Then save HTML comments, excluding PHP block placeholders
        $comments = [];
        $content = preg_replace_callback('/<!--(?!##PHP_BLOCK_).*?-->/s', function ($matches) use (&$comments) {
            $placeholder = '##COMMENT_' . count($comments) . '##';
            $comments[$placeholder] = $matches[0];
            return $placeholder;
        }, $content);

        // Initialize DOM with proper configuration
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = false;
        libxml_use_internal_errors(true);

        // Properly handle UTF-8 content and entities
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $content = preg_replace('/&(?!#?[a-zA-Z0-9]+;)/', '&amp;', $content);

        // Add proper HTML structure
        $wrapped = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $content . '</body></html>';
        $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOWARNING);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $textNodes = $xpath->query('//text()');
        $textModel = new Text();
        $dynamicTexts = [];

        foreach ($textNodes as $node) {
            $text = trim($node->nodeValue);
            if (!$this->shouldMakeDynamic($text, $node)) {
                continue;
            }

            $elementPath = $this->getElementPath($node->parentNode);
            $textId = $this->generateTextId($text, $elementPath, $pageSlug);

            // Add to dynamic texts collection
            $dynamicTexts[] = [
                'id' => $textId,
                'content' => $text,
                'path' => $elementPath,
                'tag' => $node->parentNode->nodeName,
                'locale' => 'sr-Cyrl' // Default locale
            ];

            // Create PHP echo statement with fallback
            $phpCode = "<?php echo htmlspecialchars(\$dynamicText['$textId']['text'] ?? '$text', ENT_QUOTES, 'UTF-8'); ?>";
            $newNode = $dom->createTextNode($phpCode);
            $node->parentNode->replaceChild($newNode, $node);
        }

        // Save dynamic texts to database
        try {
            if (!empty($dynamicTexts)) {
                $textModel->batchUpdateDynamicTexts($dynamicTexts);
            }
        } catch (Exception $e) {
            error_log("Error saving dynamic texts: " . $e->getMessage());
        }

        // Get the modified content with proper structure preservation
        $processedContent = '';
        $bodyNode = $dom->getElementsByTagName('body')->item(0);
        if ($bodyNode) {
            // Save the entire body content to preserve structure
            foreach ($bodyNode->childNodes as $child) {
                $processedContent .= $dom->saveHTML($child);
            }

            // Restore placeholders in the correct order
            foreach ($comments as $placeholder => $comment) {
                $processedContent = str_replace($placeholder, $comment, $processedContent);
            }

            foreach ($phpBlocks as $placeholder => $phpCode) {
                $processedContent = str_replace($placeholder, $phpCode, $processedContent);
            }

            // Clean up encoding while preserving special characters
            $processedContent = html_entity_decode($processedContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            // Handle any remaining HTML entities carefully
            $processedContent = preg_replace('/&amp;(?:#\d+|[a-zA-Z0-9]+);/', '&\1;', $processedContent);
            $processedContent = htmlspecialchars_decode($processedContent, ENT_QUOTES | ENT_HTML5);
        }

        return $processedContent;
    }

    private function processDynamicTexts(): void
    {
        $pageSlug = strtolower($this->data['typeOfInstitution']);
        $pageSlug = preg_replace('/[^a-z0-9]+/', '-', $pageSlug);

        foreach ($this->data['components'] as &$component) {
            foreach ($component as $filePath => &$content) {
                if (!str_ends_with($filePath, '.php')) {
                    continue;
                }
                $content = $this->processContent($content, $pageSlug);
            }
        }
    }

    private function saveComponents(): void
    {
        foreach ($this->data['components'] as $component) {
            foreach ($component as $filePath => $content) {
                $fullPath = "{$this->compDir}/$filePath";
                $dirPath = dirname($fullPath);

                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0755, true);
                }

                // Decode HTML entities and fix PHP tags
                $content = str_replace(['&lt;', '&gt;', '\$'], ['<', '>', '$'], $content);

                if (strpos($filePath, 'promocija.php') !== false) {
                    $content .= "\n" . $this->data['js'];
                }

                file_put_contents($fullPath, $content);

                if (strpos($filePath, 'header.php') !== false) {
                    $this->headerPath = $filePath;
                } elseif (strpos($filePath, 'footer.php') !== false) {
                    $this->footerPath = $filePath;
                } elseif (strpos($filePath, '.php') !== false) {
                    $this->sectionPaths[] = $filePath;
                }
            }
        }
    }

    private function createIndexPage(): void
    {
        $indexContent = $this->generateIndexHeader();
        $indexContent .= $this->generateIndexBody();
        file_put_contents("{$this->baseDir}/index.php", $indexContent);
    }

    private function generateIndexHeader(): string
    {
        $header = '<?php
session_start();
if (isset($_GET[\'locale\'])) {
    $_SESSION[\'locale\'] = $_GET[\'locale\'];
}
$locale = $_SESSION[\'locale\'] ?? \'sr-Cyrl\';
use App\Models\Event;
use App\Models\Text;

// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);

[$events, $totalCount] = (new Event())->all(
    limit: 3,
    offset: 0,
    lang: $locale
);
use App\Models\Gallery;
[$images, $totalEvents] = (new Gallery)->list();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exported Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>';

        if (!empty($this->data['css'])) {
            $header .= "\n" . htmlspecialchars($this->data['css'], ENT_QUOTES) . "\n";
        }

        $header .= '</style>
</head>
<div class="min-h-screen flex flex-col">';

        return $header;
    }

    private function generateIndexBody(): string
    {
        $content = '';

        if ($this->headerPath) {
            $content .= "\n<?php require_once __DIR__ . '/landingPageComponents/{$this->headerPath}'; ?>\n";
        }

        $content .= "\n<main class=\"flex-grow\">";

        foreach ($this->sectionPaths as $path) {
            $content .= "\n<?php require_once __DIR__ . '/landingPageComponents/$path'; ?>";
        }

        $content .= "\n</main>";

        if ($this->footerPath) {
            $content .= "\n<?php require_once __DIR__ . '/landingPageComponents/{$this->footerPath}'; ?>";
        }

        if (!empty($this->data['js'])) {
            $content .= "\n<script>\n" . $this->data['js'] . "\n</script>";
        }

        $content .= "\n</div>\n</body>\n</html>";

        return $content;
    }

    private function getPageBuilder(string $pageType, string $name): BasePageBuilder
    {
        switch (strtolower($pageType)) {

            case 'galerija':
                return new GalleryPageBuilder($name, $this->data);
            case 'kontakt':
                return new ContactPageBuilder($name, $this->data);
            case 'dokumenti':
                return new DocumentsPageBuilder($name, $this->data);
            case 'dogadjaji':
                return new EventsPageBuilder($name, $this->data);
            case 'misija':
                return new MissionPageBuilder($name, $this->data);
            default:
                return new BasicPageBuilder($name, $this->data);
        }
    }

    private function determinePageType(string $name): string
    {
        $name = strtolower($name);
        if (strpos($name, 'galerija') !== false) {
            return 'galerija';
        } elseif (strpos($name, 'kontakt') !== false) {
            return 'kontakt';
        } elseif (strpos($name, 'dokumenti') !== false) {
            return 'dokumenti';
        } elseif (strpos($name, 'dogadjaji') !== false) {
            return 'dogadjaji';

        } elseif (strpos($name, 'misija') !== false) {
            return 'misija';
        }

        return 'basic';
    }

    public function processTree(array $node, array &$createdFiles = [], array &$pagesData = [], string $parentPath = ''): void
    {
        $name = $node['root'];
        $slug = preg_replace('/[^\\w-]/', '', str_replace(' ', '_', strtolower($name)));
        $filename = $slug . '.php';
        $href = str_replace(' ', '-', strtolower($name));
        $filePath = rtrim($this->pagesDir, '/') . "/$filename";
        $fullPath = $parentPath !== '' ? $parentPath . '/' . $href : $href;

        if (empty($node['elements']) || !is_array($node['elements'])) {
            $pageType = $this->determinePageType($name);
            $pageBuilder = $this->getPageBuilder($pageType, $name);
            $content = $pageBuilder->buildPage();

            // Process dynamic text using the generalized method
            $processedContent = $this->processContent($content, $slug);

            file_put_contents($filePath, $processedContent);
            $createdFiles[] = $filename;

            $pagesData[] = [
                'id' => uniqid(), // Generate a unique ID for each page
                'name' => $name,
                'href' => '/' . $fullPath,
                'path' => 'pages/' . $href . '.php',
                'file' => $filename,
                'status' => 1, // Set status to 1 (active)
                'created_at' => date('Y-m-d H:i:s') // Set current date and time
            ];
        }

        if (!empty($node['elements']) && is_array($node['elements'])) {
            foreach ($node['elements'] as $childNode) {
                $this->processTree($childNode, $createdFiles, $pagesData, $fullPath);
            }
        }
    }
    public function exportSinglePage(): void
    {
        #TODO STATIC PAGE EXPORT
    }

    public function export(): void
    {
        if (!isset($this->data['components'], $this->data['tree'])) {
            http_response_code(400);
            exit("Error: Missing components or tree\n");
        }
        $this->processDynamicTexts();
        $this->saveComponents();
        $this->createIndexPage();

        $createdFiles = [];
        $pagesData = [];

        foreach ($this->data['tree'] as $node) {
            $this->processTree($node, $createdFiles, $pagesData);
        }

        $dataDir = dirname(__DIR__) . '/../public/assets/data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }

        $pagesJsonPath = "$dataDir/pages.json";
        file_put_contents($pagesJsonPath, json_encode($pagesData, JSON_PRETTY_PRINT));

        echo "Export successful! All files saved to {$this->baseDir}\n";
        echo "Navigation data saved to $pagesJsonPath\n";
    }
}

// Set content type for response
header('Content-Type: text/plain');

// Execute the export
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$exporter = new PageExporter($data);
$exporter->export();