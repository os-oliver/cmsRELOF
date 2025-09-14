<?php
use App\Controllers\AuthController;
AuthController::requireAdmin();

// save.php
header('Content-Type: text/plain');

// 1) Decode JSON input
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!isset($data['components'], $data['tree'])) {
    http_response_code(400);
    exit("Error: Missing components or tree\n");
}
$ID_auto = 0;
// 2) Ensure directories exist
$baseDir = dirname(__DIR__) . '/exportedPages';
$compDir = "$baseDir/landingPageComponents";
$pagesDir = "$baseDir/pages";

// Create directories if they don't exist
if (!is_dir($baseDir))
    mkdir($baseDir, 0755, true);
if (!is_dir($compDir))
    mkdir($compDir, 0755, true);
if (!is_dir($pagesDir))
    mkdir($pagesDir, 0755, true);

// 3) Save components to landingPageComponents directory
$headerPath = null;
$footerPath = null;
$sectionPaths = [];

foreach ($data['components'] as $component) {
    foreach ($component as $filePath => $content) {
        // Create nested directories if needed
        $fullPath = "$compDir/$filePath";

        $dirPath = dirname($fullPath);
        if (!is_dir($dirPath))
            mkdir($dirPath, 0755, true);
        if (strpos($filePath, 'promocija.php') !== false) {
            $content = $content . '\n' . $data['js'];

        }
        file_put_contents($fullPath, $content);

        // Record paths for special components
        if (strpos($filePath, 'header.php') !== false) {
            $headerPath = $filePath;
        } elseif (strpos($filePath, 'footer.php') !== false) {
            $footerPath = $filePath;
        } elseif (strpos($filePath, '.php') !== false) {
            $sectionPaths[] = $filePath;
        }
    }
}

// 4) Create index.php with dynamic includes
$indexContent = '';
$indexContent = '<?php
use App\Models\Event;
[$events, $totalEvents] = (new Event)->all();
use App\Models\Gallery;
[$images, $totalEvents] = (new Gallery)->list();
?>';
$indexContent .= '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exported Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>';

// Add custom CSS if provided
if (!empty($data['css'])) {
    $indexContent .= "\n" . htmlspecialchars($data['css'], ENT_QUOTES) . "\n";
}

$indexContent .= '</style>
</head>
<div class="min-h-screen flex flex-col">';

// Include header if exists
if ($headerPath) {
    $indexContent .= "\n<?php require_once __DIR__ . '/landingPageComponents/$headerPath'; ?>";
}
$indexContent .= '</style>
</head>
<div class="min-h-screen flex flex-col">';


// Main content area
$indexContent .= "\n<main class=\"flex-grow\">";

// Include all sections
foreach ($sectionPaths as $path) {
    $indexContent .= "\n<?php require_once __DIR__ . '/landingPageComponents/$path'; ?>";
}

$indexContent .= "\n</main>";

// Include footer if exists
if ($footerPath) {
    $indexContent .= "\n<?php require_once __DIR__ . '/landingPageComponents/$footerPath'; ?>";
}
if ($data['js']) {
    $indexContent .= "\n" . ($data['js']) . "\n";
}
$indexContent .= "\n</body>\n</html>";

file_put_contents("$baseDir/index.php", $indexContent);

// 5) Process navigation tree and create blank pages
$createdFiles = [];
$pagesData = [];
function galleryBody($name, $data)
{
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

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>.gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
            height: 250px;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .lightbox.active {
            opacity: 1;
            pointer-events: all;
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }

        .lightbox img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        }

        .lightbox-info {
            color: white;
            padding: 1rem 0;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .lightbox-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .lightbox-description {
            opacity: 0.8;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            z-index: 1001;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .prev-btn {
            left: 20px;
        }

        .next-btn {
            right: 20px;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            z-index: 1001;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .page-item {
            display: flex;
        }

        .page-link {
            padding: 0.5rem 1rem;
            background: #f3f4f6;
            border-radius: 0.25rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover,
        .page-link.active {
            background: #3b82f6;
            color: white;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #6b46c1 0%, #3b82f6 100%);
        }
                {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<HTML
<main>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <!-- Gallery Section -->
    <section class="container mx-auto px-4 mt-24 py-12">
        <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Kolekcija Slika</h2>
<p class="text-gray-600 max-w-2xl mx-auto">Istražite našu pažljivo odabranu kolekciju slika. Kliknite na bilo koju sliku da je pogledate u punoj veličini i da se krećete kroz galeriju.</p>

        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <?php foreach (\$images as \$index => \$image): ?>
                <div class="gallery-item" 
                    data-id='<?= \$image["id"] ?>' 
                    data-index='<?= \$index ?>'
                    data-title='<?= htmlspecialchars(\$image["title"]) ?>'
                    data-description='<?= htmlspecialchars(\$image["description"]) ?>'>
                    <img src='<?= \$image["image_file_path"] ?>' 
                        alt='<?= htmlspecialchars(\$image["title"]) ?>'
                        loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination mt-12">
            <?php if (\$page > 1): ?>
                <div class="page-item">
                    <a href="?page=<?= \$page - 1 ?>" class="page-link">
                        <i class="fas fa-chevron-left mr-1"></i> Prev
                    </a>
                </div>
            <?php endif; ?>

            <?php for (\$i = 1; \$i <= \$totalPages; \$i++): ?>
                <div class="page-item">
                    <a href="?page=<?= \$i ?>" class="page-link <?= \$i == \$page ? 'active' : '' ?>">
                        <?= \$i ?>
                    </a>
                </div>
            <?php endfor; ?>

            <?php if (\$page < \$totalPages): ?>
                <div class="page-item">
                    <a href="?page=<?= \$page + 1 ?>" class="page-link">
                        Next <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <button class="close-btn" id="closeLightbox">
        <i class="fas fa-times"></i>
    </button>

    <button class="nav-btn prev-btn" id="prevBtn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <div class="lightbox-info">
            <div class="lightbox-title" id="lightboxTitle"></div>
            <div class="lightbox-description" id="lightboxDescription"></div>
            <div class="mt-2 text-sm opacity-70" id="lightboxPosition"></div>
        </div>
    </div>

    <button class="nav-btn next-btn" id="nextBtn">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>
HTML;


    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "\n\n";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}
function basicBody($name, $data)
{
    $head = <<<HTML
    
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$name</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n    {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<HTML
<main class=>
<div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
      <h1 class="text-5xl font-bold mb-4">$name</h1>
      <p class="text-xl">Podesiti $name stranicu!</p>
    </div>
  </section>
</main>

HTML;

    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "\n\n";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}
function goalBody($name, $data)
{

    $head = <<<'PHP'
    <?php
    use App\Models\AboutUs;
    $dataAboutUS = new AboutUs();
    $aboutUsData = $dataAboutUS->list();
    
    ?>;
   
    PHP;
    $head .= <<<HTML
       
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$name</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n    {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<HTML
<main >
<div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">

    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
    <h1 class="text-5xl font-bold mb-4">Cilj naše institucije</h1>
    <h2 class="text-3xl mx-5 italic mb-4 text-justify"><?= \$aboutUsData['goal'] ?></h1>
    </div>
  </section>
</main>

HTML;

    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "\n\n";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}
function bodyMission($name, $data)
{

    $head = <<<'PHP'
    <?php
    use App\Models\AboutUs;
    $dataAboutUS = new AboutUs();
    $aboutUsData = $dataAboutUS->list();
    
    ?>;
   
    PHP;
    $head .= <<<HTML
       
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$name</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n    {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<HTML
<main >
<div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">

    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
    <h1 class="text-5xl font-bold mb-4">Misija naše institucije</h1>
    <h2 class="text-3xl mx-5 italic mb-4 text-justify"><?= \$aboutUsData['mission'] ?></h1>
    </div>
  </section>
</main>

HTML;

    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "\n\n";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}
function eventsBody($name, $data)
{
    $head = <<<'PHP'
        <?php
        use App\Models\Event;

        $limit = 6;
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * $limit;

        [$events, $totalCount] = (new Event())->all(
            limit: $limit,
            offset: $offset
        );
        $totalPages = (int) ceil($totalCount / $limit);
        $categories = (new Event())->getCategories();

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

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n    .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .page-item {
            margin: 0 0.25rem;
        }

        .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #d4a373;
            color: #344e41;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: #d4a373;
            color: white;
        }

        .page-link.active {
            background-color: #d4a373;
            color: white;
            border-color: #d4a373;
        }

        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
        } {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<'HTML'
    <main class="flex-1">
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
        <section class="relative min-h-screen flex items-center w-full overflow-hidden pt-16 hero-gradient">
            <section id="events" class="w-full py-20">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-[#344e41] mb-6 relative inline-block">
                            Događaji
                            <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#d4a373] to-[#bc6c25]"></span>
                        </h2>
                        <p class="text-lg text-[#344e41]/80 max-w-2xl mx-auto mt-4">
                            Istražite našu bogatu ponudu kulturnih događaja
                        </p>
                    </div>
    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($events as $event): ?>
                            <div class="event-card bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 h-full flex flex-col">
                                <div class="h-48 relative">
                                    <img alt="Event image"
                                        src="<?= htmlspecialchars($event['image'] ?? 'default.jpg') ?>"
                                        class="w-full h-full object-cover">
                                    <div class="category-badge bg-[#d4a373]/80 text-white">
                                        <?= htmlspecialchars($event['naziv'] ?? 'Događaj') ?>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex items-center mb-3">
                                        <div class="w-10 h-10 rounded-full bg-[#d4a373] flex items-center justify-center text-white mr-3">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <span class="text-[#d4a373] font-bold">Koncert</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-[#344e41] mb-2">
                                        <?= htmlspecialchars($event['title']) ?>
                                    </h3>
                                    <p class="text-[#344e41]/80 mb-4 flex-1">
                                        <?= htmlspecialchars($event['description']) ?>
                                    </p>
                                    <div class="flex justify-between items-center mt-auto">
                                        <div>
                                            <div class="flex items-center text-sm text-[#344e41]/70 mb-2">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span>15.07.2023. | 20:00</span>
                                            </div>
                                            <div class="flex items-center text-sm text-[#344e41]/70">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span>Stari Grad, Trg Sv. Marka</span>
                                            </div>
                                        </div>
                                        <a href="#" class="text-[#d4a373] hover:text-[#bc6c25] transition-colors">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
    
                    <?php if ($totalPages > 1): ?>
                        <div class="pagination-container">
                            <ul class="pagination">
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $page <= 1 ? 'disabled' : '' ?>" href="?page=<?= $page - 1 ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <?php
                                $start = max(1, $page - 2);
                                $end = min($totalPages, $page + 2);
                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                    }
                                }
                                for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item">
                                        <a class="page-link <?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>">
                                            <?= $i ?>
                                        </a>
                                    </li>
                                <?php endfor;
                                if ($end < $totalPages) {
                                    if ($end < $totalPages - 1) {
                                        echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
                                }
                                ?>
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $page >= $totalPages ? 'disabled' : '' ?>" href="?page=<?= $page + 1 ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>
    HTML;


    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "\n\n";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}

function contactBody($name, $data)
{


    $head = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$name</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n    .form-toggle input:checked + label {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        
        .complaint-toggle input:checked + label {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .submit-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }

        .complaint-submit {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .complaint-submit:hover {
            box-shadow: 0 15px 35px rgba(239, 68, 68, 0.4);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-bg {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .icon-bg-blue {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .icon-bg-green {
            background: linear-gradient(135deg, #10b981, #059669);
        } {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<'HTML'
    
    <div class="py-12 mt-20 px-4 flex-1">
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1
                    class="text-5xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-orange-600 to-blue-600 bg-clip-text text-transparent">
                    Kontaktirajte nas
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Vaše mišljenje nam je važno. Kontaktirajte nas za sve informacije ili pošaljite žalbu kako bismo
                    mogli da poboljšamo naše usluge.
                </p>
            </div>

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover h-fit">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8">Kontakt informacije</h2>

                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="icon-bg p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Adresa</h3>
                                    <p class="text-gray-600 leading-relaxed">Centar za umetnost i baštinu<br />Trg
                                        slobode 1<br />21000 Novi Sad, Srbija</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-blue p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Telefon</h3>
                                    <p class="text-gray-600 text-lg">+381 21 123 456</p>
                                    <p class="text-gray-500 text-sm">Ponedeljak - Petak: 09:00 - 17:00</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-green p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Email</h3>
                                    <p class="text-gray-600 text-lg">info@kulturnynexus.rs</p>
                                    <p class="text-gray-500 text-sm">Odgovaramo u roku od 24h</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-10 p-6 bg-gradient-to-br from-orange-50 to-blue-50 rounded-2xl border border-orange-100">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Radno vreme</h3>
                            <div class="text-gray-700 space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">Ponedeljak - Petak:</span>
                                    <span>09:00 - 17:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Subota:</span>
                                    <span>10:00 - 14:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Nedelja:</span>
                                    <span class="text-red-500">Zatvoreno</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover">
                   

                        <!-- Success Message (hidden by default) -->
                        <div id="success-message"
                            class="hidden mb-8 p-6 bg-green-50 border-2 border-green-200 rounded-2xl success-message">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-green-800 font-bold text-lg" id="success-title">Vaša poruka je
                                        uspešno poslata!</p>
                                    <p class="text-green-700">Odgovoriće vam u najkraćem mogućem roku.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <form id="contact-form" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Ime i prezime *
                                    </label>
                                    <input type="text" name="ime" required
                                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg"
                                        placeholder="Unesite vaše ime i prezime">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Email adresa *
                                    </label>
                                    <input type="email" name="email" required
                                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg"
                                        placeholder="vasa.email@primer.com">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Broj telefona
                                    </label>
                                    <input type="tel" name="telefon"
                                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg"
                                        placeholder="+381 xx xxx xxxx">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        <span id="subject-label">Naslov poruke *</span>
                                    </label>
                                    <input type="text" name="naslov" required
                                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg"
                                        placeholder="Kratko opišite razlog kontakta" id="subject-input">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3">
                                    <span id="message-label">Vaša poruka *</span>
                                </label>
                                <textarea name="poruka" required rows="6"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg resize-none"
                                    placeholder="Detaljno opišite vaš upit ili problem..."
                                    id="message-input"></textarea>
                            </div>

                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full text-white font-bold py-5 px-8 rounded-2xl submit-btn text-lg"
                                    id="submit-button">
                                    <span class="flex items-center justify-center space-x-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        <span id="submit-text">Pošaljite poruku</span>
                                    </span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
         const form = document.getElementById('contact-form');
        const submitButton = document.getElementById('submit-button');
        const submitText = document.getElementById('submit-text');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            submitButton.disabled = true;
            submitText.textContent = 'Slanje...';

            const formData = new FormData(form);
            
            const data = {
                ime: formData.get('ime'),
                prezime: '', // extract prezime if you split ime/prezime or add new input
                email: formData.get('email'),
                phone: formData.get('telefon') || null,
                naslov: formData.get('naslov'),
                poruka: formData.get('poruka'),
            };

            // Split ime i prezime ako su u istom polju
            const [ime, ...prezimeParts] = data.ime.trim().split(' ');
            data.ime = ime;
            data.prezime = prezimeParts.join(' ') || '—';

            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) throw new Error('Greška pri slanju.');

                const result = await response.json();

                alert('Poruka je uspešno poslata!');

                form.reset();
            } catch (error) {
                console.error(error);
                alert('Došlo je do greške. Pokušajte ponovo.');
            } finally {
                submitButton.disabled = false;
                submitText.textContent = 'Pošaljite poruku';
            }
        });
    </script>
    HTML;


    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . "";
    }

    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}

function documentsBody($name, $data)
{
    $head = <<<PHP
    <?php
    use App\Models\Document;
    use App\Controllers\AuthController;
    
    AuthController::requireEditor();
    
    // defaults
    \$search = \$_GET['search'] ?? '';
    \$category = \$_GET['category'] ?? '';
    \$status = \$_GET['status'] ?? '';
    \$sort = \$_GET['sort'] ?? 'date_desc';
    
    // pagination as before
    \$limit = 3;
    \$page = max(1, (int) (\$_GET['page'] ?? 1));
    \$offset = (\$page - 1) * \$limit;
    
    \$documentModal = new Document();
    
    // now pass filters into your Document model
    [\$documents, \$totalCount] = \$documentModal->list(
        limit: \$limit,
        offset: \$offset,
        search: \$search,
        category: \$category,
        status: \$status,
        sort: \$sort,
    );
    
    \$totalPages = (int) ceil(\$totalCount / \$limit);
    \$DocumentCategories = \$documentModal->getCategories();
    
    function getFileConfig(string \$ext): array
    {
        switch (strtolower(\$ext)) {
            case 'pdf':
                return [
                    'icon' => 'fas fa-file-pdf',
                    'color' => 'red',
                    'bg_color' => 'bg-red-100',
                    'text_color' => 'text-red-600',
                ];
            case 'doc':
            case 'docx':
                return [
                    'icon' => 'fas fa-file-word',
                    'color' => 'blue',
                    'bg_color' => 'bg-blue-100',
                    'text_color' => 'text-blue-600',
                ];
            case 'xls':
            case 'xlsx':
                return [
                    'icon' => 'fas fa-file-excel',
                    'color' => 'green',
                    'bg_color' => 'bg-green-100',
                    'text_color' => 'text-green-600',
                ];
            default:
                return [
                    'icon' => 'fas fa-file-alt',
                    'color' => 'gray',
                    'bg_color' => 'bg-gray-100',
                    'text_color' => 'text-gray-600',
                ];
        }
    }
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

        <script src="https://cdn.tailwindcss.com"></script>

        HTML;
    if (!empty($data['css'])) {
        $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
        $head .= "  <style>\n      .category-toggle input:checked+label {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .download-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .view-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }

        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .file-icon {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .file-icon-blue {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .file-icon-purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .file-icon-red {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .download-notification {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        } {$cssEscaped}\n  </style>\n\n";
    }
    $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n\n";

    $content = $head;
    $content .= "<?php\n";
    $content .= "// $name page header include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";

    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    // main hero section (you can customize this per‐node or via data)
    $content .= <<<'HTML'
    <main>
        <div class="text-center mt-24">
        <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
            <h1
                class="text-5xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-orange-600 to-blue-600 bg-clip-text text-transparent">
                Dokumenti za preuzimanje
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Preuzmi te sva potrebna dokumenta, obrasce i publikacije Kulturnog Nexusa. Sve je organizovano po
                kategorijama za lakše pronalaženje.
            </p>
            <div class="mx-2 md:mx-20 xl:md-35">
                <div class=" p-8 mb-12 ">
                    <!-- Search and Filters -->
                    <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                        <div class="flex flex-col lg:flex-row gap-4 items-center">
                            <!-- Search Bar -->
                            <div class="relative flex-1 w-full lg:w-auto">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                    placeholder="Pretraži dokumenta..."
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl …">
                            </div>

                            <!-- Category Filter -->
                            <select name="category" class="px-4 py-3 border rounded-xl …">
                                <option value="">Sve kategorije</option>
                                <option value="Javna rasprava" <?= isset($_GET['category']) && $_GET['category'] === 'Javna rasprava' ? 'selected' : '' ?>>Javna rasprava
                                </option>
                                <option value="Budžet" <?= isset($_GET['category']) && $_GET['category'] === 'Budžet' ? 'selected' : '' ?>>
                                    Budžet</option>
                                <?php foreach ($DocumentCategories as $doc): ?>
                                    <option value="<?= $doc['id'] ?>">
                                        <?= $doc['name'] ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>



                            <!-- Sort -->
                            <select name="sort" class="px-4 py-3 border rounded-xl …">
                                <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>
                                    Najnoviji prvo
                                </option>
                                <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>
                                    Najstariji prvo</option>
                                <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Po
                                    nazivu</option>
                            </select>

                            <!-- Submit -->
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl …">
                                Primeni
                            </button>

                            <!-- Add Document Button -->

                        </div>

                    </form>
                </div>

                <!-- Download Notification -->
                <div id="download-notification"
                    class="hidden fixed top-8 right-8 bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl download-notification z-50">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="font-semibold">Dokument se preuzima...</span>
                    </div>
                </div>

                <?php if (count($documents) > 0): ?>
                    <div id="documents-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($documents as $document):
                            $cfg = getFileConfig($document['extension']);

                            $date = new DateTime($document['datetime']);
                            $formattedDate = $date->format('d.m.Y');
                            ?>
                            <div class="document-card bg-white rounded-3xl shadow-xl p-8 card-hover fade-in"
                                data-category="<?= htmlspecialchars($document['name']) ?>"
                                data-name="<?= htmlspecialchars($document['title']) ?>">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 <?= $cfg['bg_color'] ?> rounded-xl flex items-center justify-center">
                                            <i class="<?= $cfg['icon'] ?> text-2xl <?= $cfg['text_color'] ?>"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="text-sm font-medium <?= $cfg['text_color'] ?> bg-<?= $cfg['color'] ?>-50 px-2 py-1 rounded-lg"><?= htmlspecialchars($doc['name']) ?></span>
                                        </div>
                                    </div>
                                    <button
                                        class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition-colors duration-200 opacity-100 group-hover:opacity-0 transition-opacity duration-200">
                                        <i class="fas fa-ellipsis-h h-5 w-5"></i>
                                    </button>
                                </div>

                                <h3 class="text-xl font-bold text-gray-800 mb-3"><?= htmlspecialchars($document['title']) ?>
                                </h3>
                                <p class="text-gray-600 mb-4 leading-relaxed"><?= htmlspecialchars($document['description']) ?>
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Ažurirano: <?= $formattedDate ?></span>
                                    </span>
                                    <span class="font-semibold"><?= ($document['fileSize']) ?>MB</span>
                                </div>

                                <div class="flex space-x-3">
                                <a href="/uploads/documents/<?= $document['filepath'] ?>"
                                    class="flex-1 download-btn text-white font-bold py-3 px-4 rounded-xl">

                                    <span class="flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <span>Preuzmi</span>
                                    </span>
                                </a>

                            </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 mb-12 flex justify-center items-center space-x-4">
                        <?php if ($page > 1): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
                                class="px-6 py-3 bg-white rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300">
                                <i class="fas fa-chevron-left mr-2"></i> Prethodna
                            </a>
                        <?php endif; ?>

                        <div class="flex space-x-2">
                            <?php
                            $startPage = max(1, $page - 2);
                            $endPage = min($totalPages, $page + 2);

                            for ($i = $startPage; $i <= $endPage; $i++):
                                ?>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                    class="w-10 h-10 flex items-center justify-center rounded-full <?= $i == $page ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white' : 'bg-white hover:bg-gray-100' ?> shadow transition-all duration-300">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </div>

                        <?php if ($page < $totalPages): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
                                class="px-6 py-3 bg-white rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300">
                                Sledeća <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-3xl shadow-xl p-12 text-center">
                        <div class="mx-auto w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-file-alt text-blue-500 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Nema pronađenih dokumenata</h3>
                        <p class="text-gray-600 max-w-md mx-auto mb-6">
                            Promenite filtere da biste videli druge dokumente ili proverite kasnije.
                        </p>
                        <a href="?"
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl hover:shadow-xl transition-all duration-300">
                            Resetuj filtere
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    HTML;


    // footer
    $content .= "<?php\n";
    $content .= "// $name page footer include\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    // inject JS if provided
    if (!empty($data['js'])) {
        $content .= $data['js'] . <<<JS
    <script>
    // Function to download document
    function downloadDocument(documentId, documentName, buttonElement) {
        // Show notification
        const notification = document.getElementById('download-notification');
        notification.classList.remove('hidden');
    
        // Add loading animation to button
        buttonElement.innerHTML = `
            <span class="flex items-center justify-center space-x-2">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Preuzimanje...</span>
            </span>
        `;
        buttonElement.disabled = true;
    
        // Simulate download (in real app, this would be an AJAX call to the server)
        setTimeout(() => {
            // Reset button
            buttonElement.innerHTML = `
                <span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Preuzmi</span>
                </span>
            `;
            buttonElement.disabled = false;
    
            // Hide notification after delay
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
    
            // Trigger actual download (this would be replaced with your actual endpoint)
            window.location.href = `/download-document?id=\${documentId}`;
        }, 1500);
    }
    
    // Function to view document
    function viewDocument(documentId) {
        // Open document in new tab
        window.open(`/view-document?id=\${documentId}`, '_blank');
    }
    
    // Form submission handler
    document.getElementById('filter-form').addEventListener('submit', function (e) {
        // Reset page to 1 when filters change
        const pageInput = document.createElement('input');
        pageInput.type = 'hidden';
        pageInput.name = 'page';
        pageInput.value = '1';
        this.appendChild(pageInput);
    });
    
    // Category filter change handler
    document.querySelectorAll('input[name="category"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.getElementById('filter-form').submit();
        });
    });
    </script>
    JS;
    }


    // close body/html
    $content .= "</body>\n</html>\n";
    return $content;
}

function employeesBody($name, $data)
{
    $head = <<<PHP
    <?php
    use App\Models\Employee;
    use App\Controllers\AuthController;
    
    AuthController::requireEditor();
    
    // Get parameters from _GET
    \$search = \$_GET['search'] ?? '';
    \$sort = \$_GET['sort'] ?? 'name_asc';
    // Pagination settings
    \$limit = \$_GET['limit'] ?? 3;
    \$page = max(1, (int) (\$_GET['page'] ?? 1));
    \$offset = (\$page - 1) * \$limit;
    
    \$employeeModel = new Employee();
    
    // Fetch employees with pagination and filters
    [\$employees, \$totalCount] = \$employeeModel->list(
        limit: \$limit,
        offset: \$offset,
        search: \$search,
    );
    
    \$totalPages = (int) ceil(\$totalCount / \$limit);
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
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .card-hover {
                transition: all 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            .initials-avatar {
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                font-weight: bold;
                color: white;
            }
            .fade-in {
                animation: fadeIn 0.5s ease-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            {$data['css']}
        </style>
    </head>
    <body class="min-h-screen flex flex-col bg-gray-50">
    HTML;

    $content = $head;
    $content .= "<?php\n";
    $content .= "// Include header components\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';\n";
    $content .= "?>\n\n";

    $content .= <<<'HTML'
    <main class="flex-grow mt-24">
        <div class="container mx-auto px-4 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    Naš Tim
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Upoznajte članove našeg tima koji svakodnevno rade na unapređenju naše organizacije
                </p>
            </div>

            <!-- Search and Filters -->
            <form method="GET" class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                            placeholder="Pretraži zaposlene..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>

                  

               

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        Primena
                    </button>
                </div>
            </form>

            <!-- Employees Grid -->
            <?php if (count($employees) > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($employees as $employee): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover fade-in">
                            <div class="p-6">
                                <!-- Employee Avatar -->
                                <div class="flex items-center mb-6">
                                    <div class="initials-avatar bg-blue-600 rounded-full w-16 h-16">
                                        <?= mb_substr($employee['name'], 0, 1, 'UTF-8') . mb_substr($employee['surname'], 0, 1, 'UTF-8') ?>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-gray-800">
                                            <?= htmlspecialchars($employee['name'] . ' ' . $employee['surname'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                        </h3>
                                        <p class="text-blue-600 font-medium">
                                            <?= htmlspecialchars($employee['position'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                        </p>
                                    </div>
                                </div>


                                <!-- Biography -->
                                <div class="border-t border-gray-100 pt-4">
                                    <p class="text-gray-600 line-clamp-3">
                                        <?= htmlspecialchars($employee['biography']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center items-center space-x-4">
                    <?php if ($page > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" 
                           class="px-5 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                            <i class="fas fa-chevron-left mr-2"></i> Prethodna
                        </a>
                    <?php endif; ?>

                    <div class="flex space-x-2">
                        <?php
                        $startPage = max(1, $page - 2);
                        $endPage = min($totalPages, $page + 2);
                        
                        for ($i = $startPage; $i <= $endPage; $i++):
                        ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
                               class="w-10 h-10 flex items-center justify-center rounded-lg <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100' ?> shadow">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($page < $totalPages): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" 
                           class="px-5 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                            Sledeća <i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-users text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Nema pronađenih zaposlenih</h3>
                    <p class="text-gray-600 mb-6">
                        Promenite parametre pretrage ili proverite kasnije.
                    </p>
                    <a href="?" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        Resetuj pretragu
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    HTML;

    $content .= "<?php\n";
    $content .= "// Include footer\n";
    $content .= "require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';\n";
    $content .= "?>\n\n";

    $content .= <<<'HTML'
    
    </body>
    
    HTML;
    if (!empty($data['js'])) {
        $content .= $data['js'] . "    </html>";
    }
    return $content;
}
function processTree(array $data, array $node, string $pagesDir, array &$createdFiles, array &$pagesData, string $parentPath = '')
{
    // derive page name, filenames/paths
    $name = $node['root'];
    $slug = preg_replace('/[^\w-]/', '', str_replace(' ', '_', strtolower($name)));
    $filename = $slug . '.php';
    $href = str_replace(' ', '-', strtolower($name));
    $filePath = rtrim($pagesDir, '/') . "/$filename";

    // build URL paths
    $relativePath = "pages/$filename";
    $fullPath = $parentPath !== ''
        ? rtrim($parentPath, '/') . "/$href"
        : '/' . $href;

    $isLeaf = empty($node['elements']) || !is_array($node['elements']);
    if ($isLeaf) {
        // record metadata
        $pageData = [
            'id' => ++$GLOBALS['ID_auto'],
            'name' => $name,
            'path' => $relativePath,
            'href' => $fullPath,
            'status' => 'active',
            'date' => date("m.d.Y.")
        ];
        $pagesData[] = $pageData;
    
        // only create the file once
        if (!in_array($filename, $createdFiles, true)) {
            // build the HEAD, injecting CSS if present
    
            // assemble full page content
            switch ($name) {
    
                case 'dogadjaji':
                    $content = eventsBody($name, $data);
    
                    break;
                case 'kontakt':
                    $content = contactBody($name, $data);
    
                    break;
                case 'dokumenti':
                    $content = documentsBody($name, $data);
    
                    break;
                case 'galerija':
                    $content = galleryBody($name, $data);
    
                    break;
                case 'Misija':
                    $content = bodyMission($name, $data);
                    break;
                case 'Cilj':
                    $content = goalBody($name, $data);
                    break;
                case 'Zaposleni':
                    $content = employeesBody($name, $data);
    
                    break;
                default:
                    error_log('' . $name . '');
                    $content = basicBody($name, $data);
    
                    break;
            }
    
            // write out the file
            if (!is_dir($pagesDir)) {
                mkdir($pagesDir, 0755, true);
            }
            file_put_contents($filePath, $content);
            $createdFiles[] = $filename;
        }
    }

    // recurse into child nodes, passing down the URL path
    if (!empty($node['elements']) && is_array($node['elements'])) {
        foreach ($node['elements'] as $child) {
            processTree($data, $child, $pagesDir, $createdFiles, $pagesData, $fullPath);
        }
    }
}


foreach ($data['tree'] as $node) {

    processTree($data, $node, $pagesDir, $createdFiles, $pagesData);
}

// 6) Save pages data to JSON file
$dataDir = dirname(__DIR__) . '/assets/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$pagesJsonPath = "$dataDir/pages.json";
file_put_contents($pagesJsonPath, json_encode($pagesData, JSON_PRETTY_PRINT));

echo "Export successful! All files saved to $baseDir\n";
echo "Navigation data saved to $pagesJsonPath\n";
?>