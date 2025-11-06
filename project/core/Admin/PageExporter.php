<?php

namespace App\Admin;

use App\Admin\PageBuilders\AnketePageBuilder;
use App\Admin\PageBuilders\AnsambalPageBuilder;
use App\Admin\PageBuilders\DynamicPageBuilder;
use App\Admin\PageBuilders\EmployeesPageBuilder;
use App\Admin\PageBuilders\GoalPageBulder;
use App\Admin\PageBuilders\IzlozbePageBuilder;
use App\Admin\PageBuilders\LibraryProgramPageBuilder;
use App\Admin\PageBuilders\MissionPageBuilder;
use App\Admin\PageBuilders\NaucniKlubPageBuilder;
use App\Admin\PageBuilders\ObjekatPageBuilder;
use App\Admin\PageBuilders\PredstavePageBuilder;
use App\Admin\PageBuilders\ProjektiPageBuilder;
use App\Admin\PageBuilders\SportoviPageBuilder;
use App\Admin\PageBuilders\SavetovalistePageBuilder;
use App\Admin\PageBuilders\TestBuilder;
use App\Admin\PageBuilders\UvodPageBuilder;
use App\Admin\PageBuilders\VestiPageBuilder;
use App\Admin\PageBuilders\ProgramiObukePageBuilder;
use App\Admin\PageBuilders\UslugePageBuilder;
use App\Admin\PageBuilders\PravaPageBuilder;
use App\Admin\PageBuilders\SluzbePageBuilder;
use App\Admin\PageBuilders\ObrasciPageBuilder;
use App\Admin\PageBuilders\NasiKorisniciPageBuilder;
use App\Admin\PageBuilders\ZnacajaStranica;
use App\Controllers\AuthController;
use App\Models\Content;
use App\Models\Text;
use App\Models\Event;
use App\Models\Gallery;
use App\Admin\PageBuilders\BasePageBuilder;
use App\Admin\PageBuilders\GalleryPageBuilder;
use App\Admin\PageBuilders\ContactPageBuilder;
use App\Admin\PageBuilders\DocumentsPageBuilder;
use App\Admin\PageBuilders\BasicPageBuilder;
use App\Admin\PageBuilders\CenovnikPageBuilder;
use App\Admin\PageBuilders\EventsPageBuilder;
use App\Admin\PageBuilders\IstorijatPageBuilder;
use App\Admin\PageBuilders\VrticiPageBuilder;
use App\Admin\PageBuilders\JelovnikPageBuilder;
use App\Admin\PageBuilders\ObavestenjaZaRoditeljePageBuilder;
use App\Admin\PageBuilders\PosebneUslugePageBuilder;
use App\Admin\PageBuilders\RasporedAktivnostiPageBuilder;
use App\Admin\PageBuilders\TimoviPageBuilder;
use App\Admin\PageBuilders\UpisPageBuilder;
use App\Admin\PageBuilders\RepertoarPageBuilder;
use App\Admin\PageBuilders\FAQPageBuilder;
use App\Admin\PageBuilders\SeminarPageBuilder;

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
                mkdir($dir, 0775, true);
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

                if ($parent->hasAttribute('data-translate')) {
                    $translateAttr = $parent->getAttribute('data-translate');
                    if ('off' == $translateAttr) {
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
                    mkdir($dirPath, 0775, true);
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
        if (!empty($this->data['css'])) {
            $css = html_entity_decode($this->data['css'], ENT_QUOTES | ENT_HTML5);
            $css = "\n" . trim($css) . "\n";
        } else {
            $css = '';
        }

        file_put_contents("{$this->baseDir}/commonStyle.css", $css);

        if (!empty($this->data['js'])) {
            $jsCode = preg_replace('/<\/?script\b[^>]*>/i', '', $this->data['js']);
            $jsCode = preg_replace('/,(\s*[\]}])/m', '$1', $jsCode);
            $jsCode = trim($jsCode);

            $jsFilePath = "{$this->baseDir}/commonScript.js";
            if (!empty($jsCode)) {
                file_put_contents($jsFilePath, $jsCode);
            }
        }

    }

    private function generateIndexHeader(): string
    {
        $phpString = '';

        $jsonDir = __DIR__ . '/../../public/assets/data/structure.json';
        $jsonData = json_decode(file_get_contents($jsonDir), true);

        $structure = $jsonData[0] ?? [];
        $structureLower = [];
        foreach ($structure as $k => $v) {
            $structureLower[strtolower($k)] = $v;
        }
        print_r(array_keys($this->data));

        foreach ($this->data['ids'] as $entry) {
            // Split by '-' if exists
            $parts = explode('-', $entry, 2);
            $id = $parts[0]; // first part is variable name
            $key = isset($parts[1]) ? $parts[1] : $parts[0]; // if second part exists, use it; else use first part

            // Map 'events' to 'dogadjaji' always
            if (strtolower($key) === 'events') {
                $key = 'dogadjaji';
            }

            // Only generate PHP if key exists in structureLower
            if ($key === null || isset($structureLower[strtolower($key)])) {
                $keyForFetch = $key ?? ''; // first parameter
                $sixthParam = isset($parts[1]) ? "'{$parts[0]}'" : "null"; // use parts[1] if exists, else null
                $id = str_replace(" ", '_', $id);
                $phpString .= "\$$id" . "_raw = (new Content())->fetchListData('$keyForFetch', '', 0, 9, $sixthParam, \$locale)['items'];\n";
                $phpString .= "\$$id = HashMapTransformer::transform(\$$id" . "_raw, \$locale);\n\n";
            }

            error_log("Entry: '$entry', ID: '$id', Key: '$key', Passed: " . (isset($structureLower[$key]) ? "YES" : "NO"));
        }







        $header = <<<'PHP'
        <?php
        session_start();
        use App\Models\Gallery;
        use App\Models\PageLoader;
        use App\Utils\HashMapTransformer;
        if (isset($_GET['locale'])) {
            $_SESSION['locale'] = $_GET['locale'];
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
        use App\Models\Event;
        use App\Models\Text;
        use App\Models\Content;
        use App\Models\AboutUs;
        $dataAboutUS = new AboutUs();
        $aboutUsData = $dataAboutUS->list($locale);

        // Load dynamic texts
        $textModel = new Text();
        $dynamicText = $textModel->getDynamicText($locale);
        {{dynamicLandigPageElements}}

        [$images, $totalEvents] = (new Gallery)->list();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

        <title><?=$aboutUsData['title']?></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
        <link href="/exportedPages/commonStyle.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <div class="min-h-screen flex flex-col">
        PHP;

        $header = str_replace('{{dynamicLandigPageElements}}', $phpString, $header);

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

        $content .= '<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>' . "\n";


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
            case 'događaji':
            case 'dogadjaji':
                return new EventsPageBuilder($name);
            case 'misija':
                return new MissionPageBuilder($name, $this->data);
            case 'cilj':
                return new GoalPageBulder($name, $this->data);
            case 'predstave':
                return new DynamicPageBuilder('predstave');
            case 'vesti':
                return new VestiPageBuilder('Vesti');
            case 'naucni-klub':
                return new NaucniKlubPageBuilder('NaucniKlub');
            case 'vrtici':
                return new VrticiPageBuilder('Vrtici');
            case 'timovi':
                return new TimoviPageBuilder('Timovi');
            case 'projekti':
                return new ProjektiPageBuilder('Projekti');
            case 'obavestenja':
                return new ObavestenjaZaRoditeljePageBuilder('Obavestenja');
            case 'seminari':
                return new SeminarPageBuilder('Seminari');
            case 'primer':
                return new ContactPageBuilder($name, $this->data);
            case 'zaposleni':
                return new EmployeesPageBuilder($name, $this->data);
            case 'programi-obuke':
                return new ProgramiObukePageBuilder('ProgramiObuke');
            case 'usluge':
                return new UslugePageBuilder('Usluge');
            case 'prava':
                return new PravaPageBuilder('Prava');
            case 'sluzbe':
                return new SluzbePageBuilder('Sluzbe');
            case 'obrasci':
                return new ObrasciPageBuilder('Obrasci');
            case 'nasi-korisnici':
                return new NasiKorisniciPageBuilder('NasiKorisnici', $this->data);
            case 'ansambl':
                return new AnsambalPageBuilder('Ansambl');
            case 'projekti':
                return new ProjektiPageBuilder('Projekti');

            case strpos($name, 'uvod') !== false:
                return new UvodPageBuilder('Uvod', $this->data);

            case strpos($name, 'projekti') !== false:
                return new ProjektiPageBuilder('Projekti');
            case 'organizaciona-struktura':
                return new EmployeesPageBuilder('Organizaciona Struktura', $this->data);
            case 'ankete':
                return new AnketePageBuilder('Ankete');
            case 'repertoar':
                return new LibraryProgramPageBuilder('repertoar');
            case 'izlozbe':
                return new IzlozbePageBuilder('izlozbe');
            case 'informacije':
                return new ZnacajaStranica('ZnacajaStranica', $this->data);
            case 'objekat':
                return new ObjekatPageBuilder('Objekat', $this->data);
            case 'fondovi':
                return new DynamicPageBuilder('fondovi');
            case 'sportovi':
                return new SportoviPageBuilder('sportovi');
            case 'repertoar':
                return new RepertoarPageBuilder('Repertoar');
            case 'ansambl':
                return new DynamicPageBuilder('Ansambl');
            case 'pitanja':
                return new FAQPageBuilder('Pitanja');
            case 'test123':
                return new TestBuilder('Test', $this->data);
            case 'jelovnik':
                return new JelovnikPageBuilder('Jelovnik', $this->data);
            case 'cenovnik':
                return new CenovnikPageBuilder('Cenovnik', $this->data);
            case 'raspored-aktivnosti':
                return new RasporedAktivnostiPageBuilder('RasporedAktivnosti', $this->data);
            case 'istorijat':
                return new IstorijatPageBuilder('Istorijat', $this->data);
            case 'upis':
                return new UpisPageBuilder('Upis', $this->data);
            case 'savetovaliste':
                return new SavetovalistePageBuilder('Savetovaliste', $this->data);
            case 'posebne':
                return new PosebneUslugePageBuilder('PosebneUsluge', $this->data);
            default:
                return new BasicPageBuilder($name, $this->data);
        }
    }

    private function determinePageType(string $name): string
    {
        error_log("nameL:" . $name);
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
        } elseif (strpos($name, 'vrtici') !== false) {
            return 'vrtici';
        } elseif (strpos($name, 'timovi') !== false) {
            return 'timovi';
        } elseif (strpos($name, 'projekti') !== false) {
            return 'projekti';
        } elseif (strpos($name, 'obavestenja') !== false) {
            return 'obavestenja';
        } elseif (strpos($name, 'seminari') !== false) {
            return 'seminari';
        } elseif (strpos($name, 'primer') !== false) {
            return 'primer';
        } elseif (strpos($name, 'cilj') !== false) {
            return 'cilj';
        } elseif (strpos($name, 'dogadaji') !== false) {
            return 'dogadjaji';
        } elseif (strpos($name, 'programi-obuke') !== false || strpos($name, 'programi obuke') !== false) {
            return 'programi-obuke';
        } elseif (strpos($name, 'posebne') !== false) {
            return 'posebne';
        } elseif (strpos($name, 'usluge') !== false) {
            return 'usluge';
        } elseif (strpos($name, 'prava') !== false) {
            return 'prava';
        } elseif (strpos($name, 'sluzbe') !== false || strpos($name, 'službe') !== false || strpos($name, 'slube') !== false) {
            return 'sluzbe';
        } elseif (strpos($name, 'obrasci') !== false) {
            return 'obrasci';
        } elseif (strpos($name, 'nasi-korisnici') !== false || strpos($name, 'naši korisnici') !== false || strpos($name, 'nai-korisnici') !== false) {
            return 'nasi-korisnici';
        } elseif (strpos($name, 'ansambl') !== false) {
            return 'ansambl';
        } elseif (strpos($name, 'projekti') !== false) {
            return 'projekti';
        } elseif (strpos($name, 'organizaciona-struktura') !== false) {
            return 'organizaciona-struktura';
        } elseif (strpos($name, 'rukovodstvo') !== false) {
            return 'rukovodstvo';
        } elseif (strpos($name, 'misija-i-vizija') !== false) {
            return 'misija-i-vizija';
        } elseif (strpos($name, 'uvod') !== false) {
            return 'uvod';
        } elseif (strpos($name, 'istorijat') !== false) {
            return 'istorijat';
        } elseif (strpos($name, 'objekat') !== false) {
            return 'objekat';
        } elseif (strpos($name, 'donacije-i-podrska') !== false) {
            return 'donacije-i-podrska';
        } elseif (strpos($name, 'partneri') !== false) {
            return 'partneri';
        } elseif (strpos($name, 'ankete') !== false) {
            return 'ankete';
        } elseif (strpos($name, 'repertoar') !== false) {
            return 'repertoar';
        } elseif (strpos($name, 'izlozbe') !== false) {
            return 'izlozbe';
        } elseif (strpos($name, 'informacije') !== false) {
            return 'informacije';
        } elseif (strpos($name, 'objekat') !== false) {
            return 'objekat';
        } elseif (strpos($name, 'fondovi') !== false) {
            return 'fondovi';

        } elseif (strpos($name, 'sportovi') !== false) {
            return 'sportovi';


        } elseif (strpos($name, 'repertoar') !== false) {
            return 'repertoar';
        } elseif (strpos($name, 'ansambl') !== false) {
            return 'ansambl';
        } elseif (strpos($name, 'pitanja') !== false) {
            return 'pitanja';
        } elseif (strpos($name, 'test123') !== false) {
            return 'test123';
        } elseif (strpos($name, 'jelovnik') !== false) {
            return 'jelovnik';
        } elseif (strpos($name, 'cenovnik') !== false) {
            return 'cenovnik';
        } elseif (strpos($name, 'raspored-aktivnosti') !== false) {
            return 'raspored-aktivnosti';
        } elseif (strpos($name, 'istorijat') !== false) {
            return 'istorijat';
        } elseif (strpos($name, 'upis') !== false) {
            return 'upis';
        } elseif (strpos($name, 'savetovaliste') !== false) {
            return 'savetovaliste';


        } elseif (strpos($name, 'zaposleni') !== false) {
            return 'zaposleni';
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
            $pageType = $this->determinePageType($slug);  // Use slug instead of name
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
        error_log("Starting single page export");
        if (!isset($this->data['html'])) {
            throw new \InvalidArgumentException("HTML content is required");
        }

        $html = $this->data['html'];

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $mainNode = $xpath->query('//main')->item(0);

        if (!$mainNode) {
            throw new \RuntimeException("No <main> element found in HTML");
        }

        $outsideSections = $xpath->query('//section[not(ancestor::main)]');
        $toMove = [];
        foreach ($outsideSections as $section) {
            $toMove[] = $section;
        }
        foreach ($toMove as $section) {
            $mainNode->appendChild($section);
        }

        $innerHTML = '';
        foreach ($mainNode->childNodes as $child) {
            $innerHTML .= $dom->saveHTML($child);
        }

        $page = $this->determinePageType($this->data['cmp']);
        $builder = $this->getPageBuilder($page, $page);

        $pageSlug = $this->data['cmp'] ?? 'single-page';
        error_log("Processing single page with slug: $pageSlug");
        $processedContent = $this->processContent($innerHTML, $pageSlug);

        $wrappedContent = <<<HTML
<main class="min-h-screen pt-12 bg-background flex-grow">
$processedContent
</main>
HTML;

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
        error_log("Data CSS: " . $datacss);
        $builder->setCss($baseCss . "\n" . $datacss);

        $filePath = $directory . $pageSlug . '.php';
        $builder->setHtml($wrappedContent);
        $finalPage = $builder->buildPage();
        error_log("Final HTML content: " . $finalPage);

        $success = file_put_contents($filePath, $finalPage);

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
            mkdir($dataDir, 0775, true);
        }

        $pagesJsonPath = "$dataDir/pages.json";
        file_put_contents($pagesJsonPath, json_encode($pagesData, JSON_PRETTY_PRINT));

    }
}

