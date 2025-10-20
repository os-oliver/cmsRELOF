<?php
// Simple endpoint to set the session key used by dynamicPage.php
session_start();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$key = $_POST['key'] ?? null;
if (!$key) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing key']);
    exit;
}

// sanitize to allow only word-like keys (letters, numbers, dash and underscore)
$san = preg_replace('/[^a-zA-Z0-9_-]/', '', $key);
if ($san === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid key']);
    exit;
}

$_SESSION['dynamicPage'] = $san;

echo json_encode(['success' => true, 'key' => $san]);
