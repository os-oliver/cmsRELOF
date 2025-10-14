<?php

namespace App\Admin;

use App\Admin\PageBuilders\DynamicPageBuilder;
use App\Admin\PageBuilders\MissionPageBuilder;
use App\Admin\PageBuilders\NaucniKlubPageBuilder;
use App\Admin\PageBuilders\PredstavePageBuilder;
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

    /**
     * Recursively delete all files and directories inside the given directory
     * but do not remove the top-level directory itself. Safe to call even if
     * the directory does not exist.
     */
    private function clearDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = new \FilesystemIterator($dir);
        foreach ($items as $item) {
            try {
                if ($item->isDir() && !$item->isLink()) {
                    // Recursively remove directory
                    $this->rrmdir($item->getPathname());
                } else {
                    @unlink($item->getPathname());
                }
            } catch (\Throwable $e) {
                // Log and continue
                error_log('Failed to remove: ' . $item->getPathname() . ' - ' . $e->getMessage());
            }
        }
    }

    /**
     * Recursively remove a directory and its contents.
     */
    private function rrmdir(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $path = $fileinfo->getPathname();
            try {
                if ($fileinfo->isDir()) {
                    @rmdir($path);
                } else {
                    @unlink($path);
                }
            } catch (\Throwable $e) {
                error_log('rrmdir failed for ' . $path . ': ' . $e->getMessage());
            }
        }

        // Finally remove the now-empty directory
        @rmdir($dir);
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
        if (stripos($text, "slov") !== false) {

        }        // Skip if empty or too short
        if (empty($text) || strlen($text) < 3) {

            return false;
        }

        // Skip if it contains PHP code
        if (strpos($text, '<?') !== false || strpos($text, '?>') !== false) {
            return false;
        }

        // Skip if parent node contains php tags
        $parentContent = $node->parentNode->nodeValue;

        // Ako uopšte postoji PHP kod
        if (strpos($parentContent, '<?php') !== false || strpos($parentContent, '?>') !== false || strpos($parentContent, '<?=') !== false) {

            // Dozvoli samo ako sadrži dynamicText
            if (strpos($parentContent, 'dynamicText') !== false) {
                // Safe exception → nastavi dalje

            } else {
                // Log i blokiraj sve ostalo
                return false;
            }
        }


        // Skip if it's just numbers or special characters
        // Require at least 3 Unicode letters in sequence (supports Latin with diacritics, Cyrillic, etc.)
        if (!preg_match('/[\p{L}]{3,}/u', $text)) {
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
        if (stripos($text, "##PHP_BLOCK_") !== false) {

            return false;
        }
        if (stripos($text, "##COMMENT_") !== false) {

            return false;
        }
        // Only convert text that appears to be natural language content
        return preg_match('/^[\p{L}\p{N}\s\p{P}]+$/u', $text);
    }


    private function getElementPath(DOMNode $node): string
    {
        $path = [];
        $current = $node;

        while ($current && $current->nodeType === XML_ELEMENT_NODE) {
            // Initialize counters for each level
            static $levelCounters = [];
            $level = count($path);

            if (!isset($levelCounters[$level])) {
                $levelCounters[$level] = [];
            }

            if (!isset($levelCounters[$level][$current->nodeName])) {
                $levelCounters[$level][$current->nodeName] = 0;
            } else {
                $levelCounters[$level][$current->nodeName]++;
            }

            // Get absolute position among siblings
            $siblingPosition = 0;
            $sibling = $current;
            while ($sibling = $sibling->previousSibling) {
                if ($sibling->nodeType === XML_ELEMENT_NODE) {
                    $siblingPosition++;
                }
            }

            // Combine nodeName with both counters
            $pathSegment = sprintf(
                '%s_%d_%d',
                $current->nodeName,
                $levelCounters[$level][$current->nodeName],
                $siblingPosition
            );

            array_unshift($path, $pathSegment);
            $current = $current->parentNode;
        }

        // Reset static counter for next call
        if (count($path) === 0) {
            $levelCounters = [];
        }

        return implode('/', $path);
    }
    /**
     * Generate a path for any DOM node. For text nodes we include an index
     * to distinguish multiple text nodes inside the same parent element
     * (for example when <br> splits text into multiple text nodes).
     */
    private function getNodePath(DOMNode $node): string
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            $parent = $node->parentNode;
            $elementPath = $this->getElementPath($parent);

            // Count previous text-node siblings to get an index
            $index = 0;
            $sibling = $node->previousSibling;
            while ($sibling) {
                if ($sibling->nodeType === XML_TEXT_NODE) {
                    $index++;
                }
                $sibling = $sibling->previousSibling;
            }

            return $elementPath . '/text_' . $index;
        }

        // Fallback: for elements, reuse getElementPath
        return $this->getElementPath($node);
    }
    private function generatePathHash(string $elementPath): string
    {
        // You can use sha256 or md5; sha256 is stronger

        return hash('sha256', $elementPath);
    }

    /**
     * Generate a hash for the text content
     * @param string $text
     * @return string
     */
    private function generateTextHash(string $text): string
    {
        // Normalize text: trim, collapse spaces, remove newlines
        $normalized = preg_replace('/\s+/', ' ', trim($text));
        return hash('sha256', $normalized);
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

        // Collector for PHP snippets generated during processing (placeholders -> php code)
        $generatedPhp = [];
        $generatedPhpCount = 0;

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
        $convmap = [0x80, 0x10FFFF, 0, 0xFFFF];
        $content = mb_encode_numericentity($content, $convmap, 'UTF-8');

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

            // Use node-specific path that includes text-node index so
            // multiple text nodes inside the same <p> get unique paths.
            $elementPath = $this->getNodePath($node);
            $textId = $this->generateTextId($text, $elementPath, $pageSlug);
            $pathHash = $this->generatePathHash($elementPath);
            $textHash = $this->generateTextHash($text);
            // Add to dynamic texts collection
            $dynamicTexts[] = ['id' => $textId, 'page_slug' => $pageSlug, 'content' => $text, 'text_hash' => $textHash, 'path' => $elementPath, 'path_hash' => $pathHash, 'tag' => $node->parentNode->nodeName, 'locale' => 'sr-Cyrl'];


            // Safely escape single quotes for inclusion inside single-quoted PHP fallback
            $escapedText = str_replace("'", "\\'", $text);

            // Create PHP echo statement with fallback
            $phpCode = "<?= htmlspecialchars(\$dynamicText['$textId']['text'] ?? '$escapedText', ENT_QUOTES, 'UTF-8'); ?>";

            // Use a placeholder in the DOM so DOMDocument doesn't mangle PHP tags.
            $placeholder = '##DYNPHP_' . $generatedPhpCount . '##';
            $generatedPhp[$placeholder] = $phpCode;
            $generatedPhpCount++;

            $newNode = $dom->createTextNode($placeholder);
            $logFile = __DIR__ . "/../../public/exportedPages/log.txt";
            $logMessage = "Replacing text node: '$text' with PHP code: $phpCode" . PHP_EOL;

            // Append poruku u log fajl
            file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
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

            // Restore any PHP code that we generated while processing text nodes
            foreach ($generatedPhp as $placeholder => $phpCode) {
                $processedContent = str_replace($placeholder, $phpCode, $processedContent);
            }

            // Restore original PHP blocks that were present in the input
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
        $header = <<<'PHP'
    <?php
    session_start();
    use App\Models\Gallery;
    use App\Models\PageLoader;

    if (isset($_GET['locale'])) {
        $_SESSION['locale'] = $_GET[\'locale\'];
    }
    $locale = $_SESSION[\'locale\'] ?? \'sr-Cyrl\';
    use App\Models\Event;
    use App\Models\Text;

    // Load dynamic texts
    $textModel = new Text();
    $dynamicText = $textModel->getDynamicText($locale);

    $events = (new Content())->fetchListData('dogadjaji', $search, $currentPage, $itemsPerPage, $categoryId) 
        : ['success' => false, 'items' => []];
    $groupedPages = PageLoader::getGroupedStaticPages();

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
    <style>
    PHP;

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
            $content .= $this->data['js'];
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
                return new EventsPageBuilder($name);
            case 'misija':
                return new MissionPageBuilder($name, $this->data);
            case 'predstave':
                return new DynamicPageBuilder('predstave');
            case 'vesti':
                return new DynamicPageBuilder('Vesti');
            case 'naucni-klub':
                return new NaucniKlubPageBuilder('NaucniKlub');
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
        } elseif (strpos($name, 'predstave') !== false) {
            return 'predstave';
        } elseif (strpos($name, 'vesti') !== false) {
            return 'vesti';

        } elseif (strpos($name, 'misija') !== false) {
            return 'misija';
        } elseif (strpos($name, 'naucni-klub') !== false) {
            return 'naucni-klub';
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
                'static' => $node['static'] ?? false,
                'movable' => $node['movable'],
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
        if (!isset($this->data['html'])) {
            throw new \InvalidArgumentException("HTML content is required");
        }

        $html = $this->data['html'];

        // Load DOM to isolate <main>
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $mainNode = $xpath->query('//main')->item(0);

        if (!$mainNode) {
            throw new \RuntimeException("No <main> element found in HTML");
        }
        $page = $this->determinePageType($this->data['cmp']);
        $builder = $this->getPageBuilder($page, $page);
        // Extract <main> inner HTML
        $innerHTML = '';
        foreach ($mainNode->childNodes as $child) {
            $innerHTML .= $dom->saveHTML($child);
        }

        // Process content into dynamic text placeholders
        // pageSlug can be something like "single-page" or from $this->data['cmp']
        $pageSlug = $this->data['cmp'] ?? 'single-page';
        error_log("Processing single page with slug: $pageSlug");
        $processedContent = $this->processContent($innerHTML, $pageSlug);
        $wrappedContent = <<<HTML
        <main class="min-h-screen pt-24 flex-grow">
        $processedContent
        </main>
        HTML;
        // Ensure export directory exists
        $directory = __DIR__ . '/../../public/exportedPages/pages/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $baseCss = <<<CSS
            .dropdown:hover .dropdown-menu {
                display: block;
            }

            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: white;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
                z-index: 1;
                border-radius: 8px;
                overflow: hidden;
            }
            CSS;

        $datacss = $this->data['css'] ?? '';
        $builder->setCss($baseCss . "\n" . $datacss);

        $filePath = $directory . $pageSlug . '.php';
        $builder->setHtml($wrappedContent);
        error_log("Final HTML content: " . $builder->buildPage());
        // Save processed content
        $success = file_put_contents($filePath, $builder->buildPage());

        if ($success === false) {
            throw new \RuntimeException("Failed to write file: $filePath");
        }

        error_log("Export successful: " . $filePath);
    }



    public function export(): void
    {
        if (!isset($this->data['components'], $this->data['tree'])) {
            http_response_code(400);
            exit("Error: Missing components or tree\n");
        }

        // Clear previously exported pages and components to ensure a clean export
        $this->clearDirectory($this->compDir);
        $this->clearDirectory($this->pagesDir);

        // Ensure directories exist after clearing
        $this->ensureDirectories();

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

    }
}

