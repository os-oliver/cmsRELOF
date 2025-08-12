<?php

function galleryBody($name, $data)
{
    $filePath = __DIR__ . '/../predefinedPages/gallery';

    $head = <<<'PHP'
    <?php
    use App\Models\Gallery;

    $limit = 6;
    $page = max(1, (int) ($_GET['page'] ?? 1));
    $offset = ($page - 1) * $limit;
    $documentModal = new Gallery();
    [$images, $totalCount] = $documentModal->list(
        limit: $limit,
        offset: $offset
    );
    $totalPages = (int) ceil($totalCount / $limit);
    ?>
    PHP;

    $head .= <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$name</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="/assets/css/gallery.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
HTML;

    $css = file_get_contents($filePath . '/style.css');
    if ($css === false) {
        $css = '';
        if (!empty($data['css'])) {
            $css .= "\n" . htmlspecialchars($data['css'], ENT_QUOTES);
        }
    }

    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";
    $content = $head;

    $content .= "<?php\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    $pageBody = file_get_contents($filePath . '/index.php');
    if ($pageBody === false) {
        die("filepath is not right or gallery file does not exist");
    }
    $content .= $pageBody;

    $content .= "<?php\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    $js = '';
    if (!empty($data['js'])) {
        $js = $data['js'];
        $content .= '<script src="/assets/js/gallery.js"></script>';
    }

    $content .= "</body>\n</html>\n";

    return [
        'html' => $content,
        'css' => $css,
        'js' => $js
    ];
}
