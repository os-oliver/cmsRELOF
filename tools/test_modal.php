<?php
require __DIR__ . '/../project/vendor/autoload.php';
// simulate request
$_GET['slug'] = 'Vesti';
$_SERVER['REQUEST_METHOD'] = 'GET';

$controller = new \App\Controllers\ModalController();
ob_start();
$controller->get();
$out = ob_get_clean();
file_put_contents(__DIR__ . '/modal_output.html', $out);
echo "Wrote output to tools/modal_output.html\n";
