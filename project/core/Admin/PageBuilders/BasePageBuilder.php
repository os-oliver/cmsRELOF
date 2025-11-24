<?php

namespace App\Admin\PageBuilders;

use \DOMDocument;
use \DOMNode;
use \DOMXPath;

abstract class BasePageBuilder
{
    protected $name;
    protected $data;

    protected string $html = '  <main class="min-h-screen pt-24 flex-grow">
        </main>';
    protected string $css = '';
    protected string $script = '';

    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }


    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    public function setCss(string $css): void
    {
        $this->css = $css;
    }

    public function setScript(string $script): void
    {
        $this->script = $script;
    }

    protected function getHeader($pageCss = '', $additionalPhp = ''): string
    {
        $head = $this->getBasicHeader($additionalPhp);

        // Collect CSS parts
        $cssParts = [];

        if (!empty($this->css)) {
            $cssParts[] = $this->css;
        }

        if (!empty($pageCss)) {
            $cssParts[] = $pageCss;
        }

        if (!empty($this->data['css'])) {
            // Escape user-defined CSS to avoid injection
            $cssParts[] = htmlspecialchars($this->data['css'], ENT_QUOTES);
        }

        // Add CSS if there’s anything at all
        if (!empty($cssParts)) {
            $head .= "<style>\n" . implode("\n", $cssParts) . "\n</style>";
        }

        $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";



        return $head;
    }


    protected function getBasicHeader($additionalPhp): string
    {
        $html = <<<HTML
<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
        use App\Models\AboutUs;

\$dataAboutUS = new AboutUs();
\$locale = LocaleManager::get();
\$dataTitle = \$dataAboutUS->list(\$locale);
\$groupedPages = PageLoader::getGroupedStaticPages();


use App\Models\Text;
// Load dynamic texts
\$textModel = new Text();
\$dynamicText = \$textModel->getDynamicText(\$locale);

$additionalPhp


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=\$dataTitle['title']?> </title>
    <link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/exportedPages/commonStyle.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <script>
    </script>
HTML;
        return $html;
    }

    protected function getFooter(): string
    {
        $content = "\n<?php\n";
        $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
        $content .= "?>\n\n";

        $content .= '<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>' . "\n";


        $content .= "</body>\n</html>\n";
        return $content;
    }

    protected function getCommonIncludes(): string
    {
        $content = "<?php\n";
        $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";
        $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
        $content .= "?>\n\n";
        return $content;
    }

    protected function processDynamicText(string $content): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = false;
        libxml_use_internal_errors(true);

        // Save PHP code blocks for later restoration
        $phpBlocks = [];
        $content = preg_replace_callback('/<\?.*?\?>/s', function ($matches) use (&$phpBlocks) {
            $placeholder = '##PHP_BLOCK_' . count($phpBlocks) . '##';
            $phpBlocks[$placeholder] = $matches[0];
            return $placeholder;
        }, $content);

        // Handle UTF-8 content and convert special characters
        $content = htmlspecialchars_decode(htmlentities($content, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        $wrapped = '<?xml encoding="UTF-8"?><html><body>' . $content . '</body></html>';
        $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOWARNING);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $textNodes = $xpath->query('//text()');

        $pageSlug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $this->name));

        foreach ($textNodes as $node) {
            $text = trim($node->nodeValue);
            if (!$this->shouldMakeDynamic($text, $node)) {
                continue;
            }

            $elementPath = $this->getElementPath($node->parentNode);
            $textId = $this->generateTextId($text, $elementPath, $pageSlug);

            // Create PHP echo statement with fallback
            $phpCode = "<?php echo htmlspecialchars(\$dynamicText['$textId']['text'] ?? '$text', ENT_QUOTES, 'UTF-8'); ?>";
            $newNode = $dom->createTextNode($phpCode);
            $node->parentNode->replaceChild($newNode, $node);
        }

        // Get the modified content
        $content = '';
        $bodyNode = $dom->getElementsByTagName('body')->item(0);
        if ($bodyNode) {
            foreach ($bodyNode->childNodes as $child) {
                $content .= $dom->saveHTML($child);
            }

            // Restore PHP blocks
            foreach ($phpBlocks as $placeholder => $phpCode) {
                $content = str_replace($placeholder, $phpCode, $content);
            }

            // Clean up HTML entities
            $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $content = htmlspecialchars_decode($content, ENT_QUOTES | ENT_HTML5);
        }

        return $content;
    }

    private function shouldMakeDynamic(string $text, DOMNode $node): bool
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

        // Skip if inside a script or style tag
        $parent = $node->parentNode;
        while ($parent) {
            if (in_array(strtolower($parent->nodeName), ['script', 'style'])) {
                return false;
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

    private function generateTextId(string $text, string $path, string $pageSlug): string
    {
        $pathHash = substr(md5($path), 0, 6);
        $textHash = substr(md5($text), 0, 6);
        return "t_{$pageSlug}_{$pathHash}_{$textHash}";
    }

    abstract public function buildPage(): string;

    public function buildPageWithDynamicText(): string
    {
        $content = $this->buildPage();
        return $this->processDynamicText($content);
    }
}