<?php
// U ruteru


// UserUpdateController.php
namespace App\Controllers;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Exception;
use App\Models\Text;

class UserUpdateController
{
    public function saveComponent()
    {
        try {
            if (!isset($_POST['componentFileName']) || !isset($_POST['htmlContent'])) {
                throw new Exception('Nedostaju obavezni parametri');
            }

            $componentFileName = basename($_POST['componentFileName']);
            $htmlContent = $_POST['htmlContent'];

            if (!preg_match('/\.php$/i', $componentFileName)) {
                throw new Exception('Dozvoljeni su samo .php fajlovi.');
            }

            $componentsDir = realpath(__DIR__ . '/../../public/exportedPages/landingPageComponents/landingPage');

            if (!$componentsDir || !is_dir($componentsDir)) {
                throw new Exception('Direktorijum komponenti ne postoji');
            }

            $filePath = $componentsDir . DIRECTORY_SEPARATOR . $componentFileName;
            $realFilePath = realpath(dirname($filePath));
            if ($realFilePath !== $componentsDir) {
                throw new Exception('Nevalidan put do fajla');
            }

            if (!file_exists($filePath)) {
                throw new Exception('Fajl ne postoji: ' . $componentFileName);
            }

            // --- Ovde pozivamo processDynamicTexts pre nego što sačuvamo fajl ---
            $htmlContent = $this->processDynamicTexts($htmlContent, pathinfo($componentFileName, PATHINFO_FILENAME));

            // Backup
            $backupDir = $componentsDir . DIRECTORY_SEPARATOR . 'backups';
            if (!is_dir($backupDir))
                mkdir($backupDir, 0755, true);

            $backupFileName = pathinfo($componentFileName, PATHINFO_FILENAME) . '_backup_' . date('Y-m-d_H-i-s') . '.php';
            $backupPath = $backupDir . DIRECTORY_SEPARATOR . $backupFileName;
            copy($filePath, $backupPath);

            // Save new content
            $bytesWritten = file_put_contents($filePath, $htmlContent);
            if ($bytesWritten === false) {
                copy($backupPath, $filePath);
                throw new Exception('Greška pri pisanju fajla');
            }

            // Cleanup old backups (keep last 10)
            $backupFiles = glob($backupDir . DIRECTORY_SEPARATOR . pathinfo($componentFileName, PATHINFO_FILENAME) . '_backup_*.php');
            if (count($backupFiles) > 10) {
                usort($backupFiles, fn($a, $b) => filemtime($a) - filemtime($b));
                foreach (array_slice($backupFiles, 0, count($backupFiles) - 10) as $oldBackup)
                    unlink($oldBackup);
            }

            // Log change
            $logFile = $componentsDir . DIRECTORY_SEPARATOR . 'changes.log';
            $logEntry = sprintf(
                "[%s] %s je izmenio/la %s (%d bytes)\n",
                date('Y-m-d H:i:s'),
                $_SESSION['email'] ?? 'Unknown',
                $componentFileName,
                $bytesWritten
            );
            file_put_contents($logFile, $logEntry, FILE_APPEND);

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

    private function processDynamicTexts(string $content, string $pageSlug): string
    {
        // Ovde možeš ubaciti ceo tvoj processContent kod iz primera
        return $this->processContent($content, $pageSlug);
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

}
