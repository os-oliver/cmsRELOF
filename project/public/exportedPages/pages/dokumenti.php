<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
$locale = LocaleManager::get();
$groupedPages = PageLoader::getGroupedStaticPages();


use App\Models\Text;
// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);

use App\Models\Document;
use App\Controllers\AuthController;


// defaults (safe)
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination
$limit = 3; // nicer grid by default
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$documentModel = new Document();

// fetch documents with filters (Document::list should accept named params or fallback)
[$documents, $totalCount] = $documentModel->list(
    search: $search,
    category: $category,
    status: $status,
    sort: $sort,
    limit: $limit,
    offset: $offset,
    lang:$locale
);

$totalPages = (int) ceil(max(1, $totalCount) / $limit);
$DocumentCategories = $documentModel->getCategories($locale);

function getFileConfig(string $ext): array {
    $ext = strtolower($ext);
    $configs = [
        'pdf'  => ['icon' => 'fa-solid fa-file-pdf', 'bg_color' => 'bg-red-50',    'text_color' => 'text-red-600',    'color' => 'red-500'],
        'doc'  => ['icon' => 'fa-solid fa-file-word','bg_color' => 'bg-blue-50',   'text_color' => 'text-blue-600',   'color' => 'blue-500'],
        'docx' => ['icon' => 'fa-solid fa-file-word','bg_color' => 'bg-blue-50',   'text_color' => 'text-blue-600',   'color' => 'blue-500'],
        'xls'  => ['icon' => 'fa-solid fa-file-excel','bg_color' => 'bg-green-50',  'text_color' => 'text-green-600',  'color' => 'green-500'],
        'xlsx' => ['icon' => 'fa-solid fa-file-excel','bg_color' => 'bg-green-50',  'text_color' => 'text-green-600',  'color' => 'green-500'],
        'ppt'  => ['icon' => 'fa-solid fa-file-powerpoint','bg_color' => 'bg-orange-50','text_color' => 'text-orange-600','color' => 'orange-500'],
        'pptx' => ['icon' => 'fa-solid fa-file-powerpoint','bg_color' => 'bg-orange-50','text_color' => 'text-orange-600','color' => 'orange-500'],
        'txt'  => ['icon' => 'fa-solid fa-file-lines','bg_color' => 'bg-gray-50',   'text_color' => 'text-gray-700',   'color' => 'gray-500'],
        'zip'  => ['icon' => 'fa-solid fa-file-zipper','bg_color' => 'bg-yellow-50',  'text_color' => 'text-yellow-700',  'color' => 'yellow-500'],
        'rar'  => ['icon' => 'fa-solid fa-file-zipper','bg_color' => 'bg-yellow-50',  'text_color' => 'text-yellow-700',  'color' => 'yellow-500'],
        'default' => ['icon' => 'fa-solid fa-file',  'bg_color' => 'bg-gray-50',   'text_color' => 'text-gray-700',   'color' => 'gray-500']
    ];

    return $configs[$ext] ?? $configs['default'];
}



?>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($dynamicText['t_dokumenti_61a206_74324e']['text'] ?? 'dokumenti', ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'clay': '#c97c5d',
                        'ochre': '#d4a373',
                        'sage': '#a3b18a',
                        'slate': '#344e41',
                        'paper': '#f5ebe0',
                        'terracotta': '#bc6c25',
                        'coral': '#e76f51',
                        'deep-teal': '#2a9d8f',
                        'crimson': '#8d1b3d',
                        'royal-blue': '#1a4480',
                        'velvet': '#4a154b',
                        ochre: '#CC7722',
                        terracotta: '#E2725B',
                        paper: '#F5F5DC',
                        slate: '#2F4F4F',
                        'royal-blue': '#4169E1',
                        'deep-teal': '#008B8B',
                        velvet: '#872657',
                        crimson: '#DC143C',
                        coral: '#FF7F50',
                        sage: '#9CAF88'
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'crimson': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                    },
                    backgroundImage: {
                        'art-pattern': "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmNWViZTAiPjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiLz48L2c+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0idXJsKCNhKSIvPjxwYXRoIGQ9Ik0wIDBoMjB2MjBIMHoiIGZpbGw9IiNkNGExYjEiIG9wYWNpdHk9Ii4xIi8+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6IiBmaWxsPSIjYTNiMThhIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0wIDIwaDIwdjIwSDB6IiBmaWxsPSIjYjk3YzVkIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0yMCAyMGgyMHYyMEgyMHoiIGZpbGw9IiMzNDRlNDEiIG9wYWNpdHk9Ii4xIi8+PC9nPjwvc3ZnPg==')",
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/>')",
                    }
                }
            }
        }
    </script><style>
/* Enhanced styles for documents page */
.category-toggle input:checked+label {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

/* Make each card a column and enforce uniform height so the download button sits at the bottom */
.document-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 300px; /* adjust if you want taller/shorter cards */
    will-change: transform;
}

.card-body { margin-bottom: 1rem; }
.card-footer { margin-top: 1rem; }

.card-hover {
    transition: all 0.28s cubic-bezier(.2,.9,.2,1);
}

.card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 48px rgba(2,6,23,0.12);
}

.download-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    transition: all 0.25s ease;
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.22);
}

.view-btn { display: none; } /* removed view button from UI */

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
    animation: fadeIn 0.45s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

.download-notification { animation: slideInRight 0.45s ease-out; }
@keyframes slideInRight {
    from { opacity: 0; transform: translateX(80px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Small helpers */
.doc-meta { color: #6b7280; }
.doc-category { font-size: .85rem; padding: .25rem .5rem; border-radius: .5rem; }
/* Enhanced styles for documents page */
.category-toggle input:checked+label {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

/* Make each card a column and enforce uniform height so the download button sits at the bottom */
.document-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 300px; /* adjust if you want taller/shorter cards */
    will-change: transform;
}

.card-body { margin-bottom: 1rem; }
.card-footer { margin-top: 1rem; }

.card-hover {
    transition: all 0.28s cubic-bezier(.2,.9,.2,1);
}

.card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 48px rgba(2,6,23,0.12);
}

.download-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    transition: all 0.25s ease;
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.22);
}

.view-btn { display: none; } /* removed view button from UI */

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
    animation: fadeIn 0.45s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

.download-notification { animation: slideInRight 0.45s ease-out; }
@keyframes slideInRight {
    from { opacity: 0; transform: translateX(80px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Small helpers */
.doc-meta { color: #6b7280; }
.doc-category { font-size: .85rem; padding: .25rem .5rem; border-radius: .5rem; }
* { box-sizing: border-box; } body {margin: 0;}.mobile-dropdown.active .mobile-dropdown-content{max-height:500px;}.mobile-dropdown.active .mobile-dropdown-chevron{transform:rotate(180deg);}#ip2z6q{animation-delay:1s;}#izxu0f{animation-delay:2s;}#i8vucd{animation-delay:3s;}#i8f5vf{background-image:radial-gradient(#344e41 1px, transparent 1px);background-size:20px 20px;}#ictebo{clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);}#iu77vu{clip-path:polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);}#ixixvw{border:0;}@layer utilities{.artistic-underline{background-image:url("data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 120 20\"><path fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"3\" stroke-linecap=\"round\" d=\"M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12\"/></svg>");background-position-x:center;background-position-y:bottom;background-repeat:no-repeat;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 12px;padding-bottom:12px;}.nav-link::after{content:"";display:block;width:0px;height:3px;background-image:linear-gradient(to right, rgb(212, 163, 115), rgb(188, 108, 37));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:width;}.nav-link:hover::after{width:100%;}.artistic-card{clip-path:polygon(0px 0px, 100% 0px, 100% 85%, 95% 100%, 0px 100%);transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.artistic-card:hover{transform:translateY(-10px);box-shadow:rgba(0, 0, 0, 0.2) 0px 20px 30px -10px;}.artistic-frame{position:relative;}.artistic-frame::before{content:"";position:absolute;top:-15px;left:-15px;right:-15px;bottom:-15px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(212, 163, 115);border-right-color:rgb(212, 163, 115);border-bottom-color:rgb(212, 163, 115);border-left-color:rgb(212, 163, 115);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(2deg);}.artistic-frame::after{content:"";position:absolute;top:-10px;left:-10px;right:-10px;bottom:-10px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(163, 177, 138);border-right-color:rgb(163, 177, 138);border-bottom-color:rgb(163, 177, 138);border-left-color:rgb(163, 177, 138);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(-1deg);}.category-badge{position:absolute;top:15px;right:15px;padding-top:5px;padding-right:12px;padding-bottom:5px;padding-left:12px;border-top-left-radius:20px;border-top-right-radius:20px;border-bottom-right-radius:20px;border-bottom-left-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;backdrop-filter:blur(4px);z-index:20;}.hero-gradient{background-image:linear-gradient(135deg, rgb(245, 235, 224) 0%, rgb(212, 163, 115) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;}.hamburger span{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.hamburger.active span:nth-child(1){transform:rotate(45deg) translate(6px, 6px);}.hamburger.active span:nth-child(2){opacity:0;}.hamburger.active span:nth-child(3){transform:rotate(-45deg) translate(5px, -5px);}.section-divider{height:100px;background-image:url("data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1200 120\" preserveAspectRatio=\"none\"><path d=\"M1200 120L0 16.48 0 0 1200 0 1200 120z\" fill=\"%23f5ebe0\"></path></svg>");background-position-x:initial;background-position-y:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 100px;}.floating{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:floating;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}0%{transform:scale(1);opacity:0;}50%{transform:scale(1.05);opacity:1;}100%{transform:scale(1);opacity:1;}.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(52, 78, 65);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(249, 245, 240);border-left-width:3px;border-left-style:solid;border-left-color:rgb(212, 163, 115);}.event-card:hover::before{transform:translateY(0px);}.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));row-gap:15px;column-gap:15px;}.gallery-item img{transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.gallery-item:hover img{transform:scale(1.1);}.gallery-item:hover::after{opacity:1;}.gallery-item .overlay-content{position:absolute;bottom:-30px;left:0px;right:0px;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;z-index:10;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:bottom;color:white;}.gallery-item:hover .overlay-content{bottom:0px;}}
</style>


<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main>
    <div class="text-center px-2 pt-32">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_dokumenti_19ade7_901c93']['text'] ?? 'Dokumenti za preuzimanje', ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10"><?= htmlspecialchars($dynamicText['t_dokumenti_65b525_cf3b77']['text'] ?? 'Preuzmi sva potrebna dokumenta, obrasce i publikacije Kulturnog Nexusa. Slažemo ih po kategorijama radi lakšeg pronalaženja.', ENT_QUOTES, 'UTF-8'); ?></p>

        <div class="mx-auto max-w-6xl">
            <form id="filter-form" method="GET" action="" class="bg-white rounded-2xl shadow p-6 mb-8 border border-gray-100">
                <div class="flex flex-col lg:flex-row gap-4 items-center">
                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Pretraži dokumenta..." class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl">
                    </div>

                    <select name="category" class="px-4 py-3 border rounded-xl">
                        <option value=""><?= htmlspecialchars($dynamicText['t_dokumenti_686d55_b8bbcb']['text'] ?? 'Sve kategorije', ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php foreach ($DocumentCategories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($cat['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="sort" class="px-4 py-3 border rounded-xl">
                        <option value="date_desc"><?= htmlspecialchars($dynamicText['t_dokumenti_22a016_765203']['text'] ?? 'Najnoviji prvo', ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="date_asc"><?= htmlspecialchars($dynamicText['t_dokumenti_a996e8_81eb59']['text'] ?? 'Najstariji prvo', ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="title"><?= htmlspecialchars($dynamicText['t_dokumenti_5d3a20_2794c1']['text'] ?? 'Po nazivu', ENT_QUOTES, 'UTF-8'); ?></option>
                    </select>

                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl"><?= htmlspecialchars($dynamicText['t_dokumenti_f1703c_75c180']['text'] ?? 'Primeni', ENT_QUOTES, 'UTF-8'); ?></button>
                </div>
            </form>

            <!-- Notification -->
            <div id="download-notification" class="hidden fixed top-6 right-6 bg-green-600 text-white px-5 py-3 rounded-2xl shadow-lg z-50">
                <div class="flex items-center gap-3"><i class="fa-solid fa-check"></i><span id="download-notification-text"><?= htmlspecialchars($dynamicText['t_dokumenti_7f04ea_8487f2']['text'] ?? 'Dokument se preuzima...', ENT_QUOTES, 'UTF-8'); ?></span></div>
            </div>

            <?php if (count($documents) > 0): ?>
                <div id="documents-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($documents as $document):
                        $cfg = getFileConfig($document['extension'] ?? '');

                        // safe values
                        $categoryName = htmlspecialchars($document['name'] ?? '', ENT_QUOTES, 'UTF-8');
                        $title = htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8');
                        $description = htmlspecialchars($document['description'] ?? '', ENT_QUOTES, 'UTF-8');
                        $filepath = htmlspecialchars($document['filepath'] ?? '', ENT_QUOTES, 'UTF-8');
                        $fileId = (int)($document['id'] ?? 0);

                        try {
                            $date = new DateTime($document['datetime'] ?? 'now');
                        } catch (\Exception $e) {
                            $date = new DateTime();
                        }
                        $formattedDate = $date->format('d.m.Y');
                        $fileSize = isset($document['fileSize']) ? number_format((float)$document['fileSize'], 2) : '0.00';
                    ?>
                        <article class="document-card bg-white rounded-2xl shadow card-hover p-6 fade-in" data-category="<?= $categoryName ?>" data-name="<?= $title ?>">
                            <div class="card-body">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 <?= $cfg['bg_color'] ?? 'bg-gray-50' ?> rounded-lg flex items-center justify-center">
                                            <i class="<?= $cfg['icon'] ?? 'fa-solid fa-file' ?> <?= $cfg['text_color'] ?? 'text-gray-700' ?> text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium <?= $cfg['text_color'] ?? 'text-gray-700' ?> doc-category bg-<?= $cfg['color'] ?? 'gray' ?>-50"><?= $categoryName ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100" aria-label="options">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= $title ?: basename($filepath) ?></h3>
                                <p class="text-sm text-gray-600 mb-4 leading-relaxed"><?= $description ?: ' ' ?></p>

                                <div class="flex items-center justify-between text-sm doc-meta mb-5">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span>Ažurirano: <?= $formattedDate ?></span>
                                    </div>
                                    <div class="font-semibold"><?= $fileSize ?> MB</div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/uploads/documents/<?= $filepath ?>" class="w-full inline-flex items-center justify-center py-2 rounded-lg download-btn text-white font-semibold" download data-id="<?= $fileId ?>" onclick="showDownloadNotification(event, '<?= addslashes($title ?: basename($filepath)) ?>')">
                                    <i class="fa-solid fa-download mr-2"></i><?= htmlspecialchars($dynamicText['t_dokumenti_d4857e_6ea27e']['text'] ?? 'Preuzmi', ENT_QUOTES, 'UTF-8'); ?></a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 mb-16 flex justify-center items-center gap-4">
                    <?php if ($page > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100"><?= htmlspecialchars($dynamicText['t_dokumenti_fb5480_fac577']['text'] ?? '« Prethodna', ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endif; ?>

                    <div class="flex items-center gap-2">
                        <?php
                        $startPage = max(1, $page - 2);
                        $endPage = min($totalPages, $page + 2);
                        for ($i = $startPage; $i <= $endPage; $i++):
                        ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="w-9 h-9 flex items-center justify-center rounded-full <?= $i == $page ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white' : 'bg-white hover:bg-gray-100' ?> shadow"><?= $i ?></a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($page < $totalPages): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100"><?= htmlspecialchars($dynamicText['t_dokumenti_921c22_b05dc7']['text'] ?? 'Sledeća »', ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <div class="bg-white rounded-2xl shadow p-10 text-center">
                    <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-file-lines text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_dokumenti_956920_848317']['text'] ?? 'Nema pronađenih dokumenata', ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6"><?= htmlspecialchars($dynamicText['t_dokumenti_abd108_c353b3']['text'] ?? 'Promenite filtere da biste videli druge dokumente ili proverite kasnije.', ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="?" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl"><?= htmlspecialchars($dynamicText['t_dokumenti_2ab874_1cc7f0']['text'] ?? 'Resetuj filtere', ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script>


        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'clay': '#c97c5d',
                        'ochre': '#d4a373',
                        'sage': '#a3b18a',
                        'slate': '#344e41',
                        'paper': '#f5ebe0',
                        'terracotta': '#bc6c25',
                        'coral': '#e76f51',
                        'deep-teal': '#2a9d8f',
                        'crimson': '#8d1b3d',
                        'royal-blue': '#1a4480',
                        'velvet': '#4a154b',
                        ochre: '#CC7722',
                        terracotta: '#E2725B',
                        paper: '#F5F5DC',
                        slate: '#2F4F4F',
                        'royal-blue': '#4169E1',
                        'deep-teal': '#008B8B',
                        velvet: '#872657',
                        crimson: '#DC143C',
                        coral: '#FF7F50',
                        sage: '#9CAF88'
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'crimson': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                    },
                    backgroundImage: {
                        'art-pattern': "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmNWViZTAiPjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiLz48L2c+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0idXJsKCNhKSIvPjxwYXRoIGQ9Ik0wIDBoMjB2MjBIMHoiIGZpbGw9IiNkNGExYjEiIG9wYWNpdHk9Ii4xIi8+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6IiBmaWxsPSIjYTNiMThhIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0wIDIwaDIwdjIwSDB6IiBmaWxsPSIjYjk3YzVkIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0yMCAyMGgyMHYyMEgyMHoiIGZpbGw9IiMzNDRlNDEiIG9wYWNpdHk9Ii4xIi8+PC9nPjwvc3ZnPg==')",
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/>')",
                    }
                }
            }
        }
        const btn = document.getElementById('increaseFontBtn');

        let currentSize = 16;       // initial font size in px
        let step = 2;               // px to increase or decrease per click
        let maxSteps = 3;           // max increments before toggling direction
        let count = 0;              // how many increments or decrements done
        let increasing = true;      // track if currently increasing font size

        btn.addEventListener('click', () => {
            if (increasing) {
                currentSize += step;
                count++;
                if (count === maxSteps) {
                    increasing = false;
                    btn.textContent = 'A-'; // change button to decrease
                }
            } else {
                currentSize -= step;
                count--;
                if (count === 0) {
                    increasing = true;
                    btn.textContent = 'A+'; // change button back to increase
                }
            }
            // Apply font size to body (all page)
            document.body.style.fontSize = currentSize + 'px';
        });

        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                const dropdown = toggle.closest('.mobile-dropdown');
                dropdown.classList.toggle('active');
            });
        });
        document.getElementById('searchButton').addEventListener('click', function () {
            const container = document.getElementById('searchInputContainer');
            const input = document.getElementById('searchInput');

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                setTimeout(() => {
                    container.classList.remove('opacity-0');
                    input.focus();
                }, 10);
            }
        });

        document.getElementById('closeSearch').addEventListener('click', function () {
            const container = document.getElementById('searchInputContainer');
            container.classList.add('opacity-0');
            setTimeout(() => {
                container.classList.add('hidden');
            }, 300);
        });

        document.addEventListener('click', function (e) {
            const searchContainer = document.getElementById('searchInputContainer');
            const searchButton = document.getElementById('searchButton');

            if (!searchContainer.contains(e.target) && !searchButton.contains(e.target)) {
                searchContainer.classList.add('opacity-0');
                setTimeout(() => {
                    searchContainer.classList.add('hidden');
                }, 300);
            }
        });
        // Close search input
        closeSearch.addEventListener('click', () => {
            searchInputContainer.classList.add('opacity-0');
            searchInputContainer.classList.add('translate-x-2');
            searchInput.classList.add('w-0');
            searchInput.classList.add('opacity-0');
            searchButton.classList.remove("invisible");

            setTimeout(() => {
                searchInputContainer.classList.add('hidden');
                searchInput.value = '';
            }, 300);
        });
        // Header scroll effect
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
            } else {
                header.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
            }
        });

        // Animation for cards on hover
        document.querySelectorAll('.artistic-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Mobile menu toggle
        // Mobile Menu JavaScript
        // Get elements
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileAboutToggle = document.getElementById('mobileAboutToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');

        // Function to open mobile menu
        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            // Use setTimeout to ensure the display change takes effect before animation
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
            }, 10);
            // Prevent body scroll when menu is open
            document.body.style.overflow = 'hidden';
            // Add active class to hamburger
            hamburger.classList.add('active');
        }

        // Function to close mobile menu
        function closeMobileMenuFunc() {
            mobileMenuPanel.classList.add('translate-x-full');
            // Wait for animation to complete before hiding
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
            // Restore body scroll
            document.body.style.overflow = '';
            // Remove active class from hamburger
            hamburger.classList.remove('active');
        }

        // Function to toggle mobile about submenu
        function toggleMobileAbout() {
            const isHidden = mobileAboutMenu.classList.contains('hidden');

            if (isHidden) {
                // Show submenu
                mobileAboutMenu.classList.remove('hidden');
                mobileAboutIcon.style.transform = 'rotate(180deg)';
            } else {
                // Hide submenu
                mobileAboutMenu.classList.add('hidden');
                mobileAboutIcon.style.transform = 'rotate(0deg)';
            }
        }

        // Event listeners
        if (hamburger) {
            hamburger.addEventListener('click', function (e) {
                e.stopPropagation();
                if (mobileMenu.classList.contains('hidden')) {
                    openMobileMenu();
                } else {
                    closeMobileMenuFunc();
                }
            });
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        }

        if (mobileAboutToggle) {
            mobileAboutToggle.addEventListener('click', function (e) {
                e.preventDefault();
                toggleMobileAbout();
            });
        }

        // Close menu when clicking on menu links (except dropdown toggle)
        const menuLinks = document.querySelectorAll('#mobileMenu nav a:not(#mobileAboutToggle)');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Close menu after a short delay to allow for navigation
                setTimeout(closeMobileMenuFunc, 150);
            });
        });

        // Close menu on window resize if screen becomes large
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Handle escape key to close menu
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Prevent menu panel clicks from closing the menu
        if (mobileMenuPanel) {
            mobileMenuPanel.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        // Initialize animations when elements come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.event-card, .gallery-item, .section-divider').forEach(el => {
            observer.observe(el);
        });
    
</script>


<script>
function showDownloadNotification(e, name) {
    // allow regular link behavior but show notification briefly
    const note = document.getElementById('download-notification');
    const text = document.getElementById('download-notification-text');
    if (!note || !text) return;
    text.textContent = name + ' se preuzima...';
    note.classList.remove('hidden');
    setTimeout(() => note.classList.add('hidden'), 2200);
}

// ensure filter form submits to page 1 when changed (server handles page param)
const filterForm = document.getElementById('filter-form');
if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        // keep default submit behavior
    });
}
</script>