<?php
require_once __DIR__ . '/../../auth/check_superadmin.php';

class ColorSchemeHandler
{
    private $schemeFile;

    public function __construct()
    {
        $this->schemeFile = __DIR__ . '/../../../config/color-scheme.json';
    }

    public function saveScheme($scheme)
    {
        // Validate the color scheme
        if (!$this->validateScheme($scheme)) {
            http_response_code(400);
            return json_encode(['error' => 'Invalid color scheme format']);
        }

        // Save to file
        if (file_put_contents($this->schemeFile, json_encode($scheme, JSON_PRETTY_PRINT))) {
            return json_encode(['success' => true]);
        } else {
            http_response_code(500);
            return json_encode(['error' => 'Failed to save color scheme']);
        }
    }

    public function loadScheme()
    {
        if (file_exists($this->schemeFile)) {
            $scheme = file_get_contents($this->schemeFile);
            return $scheme;
        } else {
            // Return default scheme if no saved scheme exists
            return json_encode($this->getDefaultScheme());
        }
    }

    private function validateScheme($scheme)
    {
        $requiredColors = [
            'clay',
            'ochre',
            'sage',
            'slate',
            'paper',
            'terracotta',
            'coral',
            'deep-teal',
            'crimson',
            'royal-blue',
            'velvet'
        ];

        foreach ($requiredColors as $color) {
            if (!isset($scheme[$color])) {
                return false;
            }
            // Validate hex color format
            if (!preg_match('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $scheme[$color])) {
                return false;
            }
        }

        return true;
    }

    private function getDefaultScheme()
    {
        return [
            'clay' => '#c97c5d',
            'ochre' => '#CC8B3C',
            'sage' => '#81A594',
            'slate' => '#2C3E50',
            'paper' => '#FAF9F6',
            'terracotta' => '#C1666B',
            'coral' => '#E07A5F',
            'deep-teal' => '#2A6F64',
            'crimson' => '#8B2635',
            'royal-blue' => '#4A90E2',
            'velvet' => '#6B4E71',
            'ochre-alt' => '#d4a373',
            'sage-alt' => '#a3b18a',
            'slate-alt' => '#344e41',
            'paper-alt' => '#f5ebe0',
            'terracotta-alt' => '#bc6c25',
            'coral-alt' => '#e76f51',
            'deep-teal-alt' => '#2a9d8f',
            'crimson-alt' => '#8d1b3d',
            'royal-blue-alt' => '#1a4480',
            'velvet-alt' => '#4a154b'
        ];
    }
}

// Handle requests
$handler = new ColorSchemeHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    header('Content-Type: application/json');
    echo $handler->saveScheme($input);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    echo $handler->loadScheme();
} else {
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Method not allowed']);
}