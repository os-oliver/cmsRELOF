<?php
namespace App\Controllers;

use App\Controllers\AuthController;

session_start();
header('Content-Type: application/json; charset=utf-8');

class ColorsController
{
    private string $commonScriptPath;

    // Definišemo samo boje koje želimo da menjamo
    private const COLOR_KEYS = [
        'primary',
        'primary_hover',
        'secondary',
        'secondary_hover',
        'accent',
        'accent_hover',
        'primary_text',
        'secondary_text',
        'background',
        'secondary_background',
        'surface'
    ];

    public function index()
    {
        AuthController::requireEditor();
        $this->commonScriptPath = realpath(__DIR__ . '/../../public/exportedPages/commonScript.js');

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'GET') {
            $this->sendCurrentColors();
        } elseif ($method === 'POST') {
            $this->handleUpdate();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
        }
        exit;
    }

    private function sendCurrentColors(): void
    {
        if (!$this->commonScriptPath || !file_exists($this->commonScriptPath)) {
            http_response_code(404);
            echo json_encode(['error' => 'commonScript.js not found']);
            return;
        }

        $js = file_get_contents($this->commonScriptPath);
        $colors = $this->parseColors($js);

        echo json_encode(['success' => true, 'colors' => $colors]);
    }

    private function handleUpdate(): void
    {
        if (!$this->commonScriptPath || !is_writable($this->commonScriptPath)) {
            http_response_code(500);
            echo json_encode(['error' => 'commonScript.js missing or not writable']);
            return;
        }

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $incoming = $data['colors'] ?? $data ?? [];

        if (empty($incoming) || !is_array($incoming)) {
            http_response_code(400);
            echo json_encode(['error' => 'No colors provided']);
            return;
        }

        // Validacija - prihvatamo samo definisane boje
        $normalized = [];
        foreach ($incoming as $k => $v) {
            if (!in_array($k, self::COLOR_KEYS)) {
                continue; // Preskaćemo nepoznate ključeve
            }

            $val = trim((string) $v);
            if ($val === '')
                continue;

            // Validacija hex boje
            if (preg_match('/^#?[a-fA-F0-9]{3,8}$/', $val)) {
                if (substr($val, 0, 1) !== '#') {
                    $val = '#' . $val;
                }
                $normalized[$k] = $val;
            }
        }

        if (empty($normalized)) {
            http_response_code(400);
            echo json_encode(['error' => 'No valid color values detected']);
            return;
        }

        // Čitamo trenutni fajl
        $js = file_get_contents($this->commonScriptPath);

        // Backup
        $backup = $this->commonScriptPath . '.bak.' . date('Ymd_His');
        @copy($this->commonScriptPath, $backup);

        // Menjamo samo boje, red po red
        $jsNew = $this->replaceColors($js, $normalized);

        if ($jsNew === null) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update colors']);
            return;
        }

        $wrote = file_put_contents($this->commonScriptPath, $jsNew);
        if ($wrote === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to write file']);
            return;
        }

        echo json_encode([
            'success' => true,
            'updated' => $normalized,
            'backup' => basename($backup)
        ]);
    }

    /**
     * Parsira samo boje iz colors objekta
     */
    private function parseColors(string $js): array
    {
        $colors = [];

        // Nalazimo colors blok
        if (!preg_match('/colors:\s*\{([^}]+)\}/s', $js, $match)) {
            return $colors;
        }

        $colorsBlock = $match[1];

        // Parsiramo red po red samo definisane boje
        foreach (self::COLOR_KEYS as $key) {
            $pattern = '/' . preg_quote($key, '/') . '\s*:\s*[\'"]([#a-fA-F0-9]+)[\'"]/';
            if (preg_match($pattern, $colorsBlock, $m)) {
                $colors[$key] = $m[1];
            }
        }

        return $colors;
    }

    /**
     * Menja samo boje u postojećem JS fajlu, čuva sve ostalo
     */
    private function replaceColors(string $js, array $newColors): ?string
    {
        // Nalazimo colors blok
        if (!preg_match('/(colors:\s*\{)([^}]+)(\})/s', $js, $match, PREG_OFFSET_CAPTURE)) {
            return null;
        }

        $before = substr($js, 0, $match[0][1]);
        $after = substr($js, $match[0][1] + strlen($match[0][0]));
        $colorsBlock = $match[2][0];

        // Menjamo samo vrednosti boja, red po red
        foreach ($newColors as $key => $value) {
            $pattern = '/(' . preg_quote($key, '/') . '\s*:\s*[\'"])([#a-fA-F0-9]+)([\'"])/';
            $colorsBlock = preg_replace($pattern, '$1' . $value . '$3', $colorsBlock);
        }

        return $before . 'colors: {' . $colorsBlock . '}' . $after;
    }
}