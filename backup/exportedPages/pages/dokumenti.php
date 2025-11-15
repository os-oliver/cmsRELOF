<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
        use App\Models\AboutUs;

$dataAboutUS = new AboutUs();
$locale = LocaleManager::get();
$dataTitle = $dataAboutUS->list($locale);
$groupedPages = PageLoader::getGroupedStaticPages();


use App\Models\Text;
// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);

use App\Models\Document;
use App\Controllers\AuthController;


// defaults (safe)
$search = $_GET['search'] ?? '';
$categories = isset($_GET['categories']) ? (array) $_GET['categories'] : [];
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination
$limit = 15; // nicer grid by default
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$documentModel = new Document();

// fetch documents with filters using array of categories
[$documents, $totalCount] = $documentModel->list(
    search: $search,
    categories: $categories,
    status: $status,
    sort: $sort,
    limit: $limit,
    offset: $offset,
    lang: $locale
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
    <title><?=$dataTitle['title']?> </title>
    <link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/exportedPages/commonStyle.css" rel="stylesheet">
    
    <script>
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
    min-height: 220px;
    max-height: 280px;
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
    min-height: 220px;
    max-height: 280px;
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
.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(31, 41, 55);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(241, 245, 249);}*{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;box-sizing:border-box;}body{font-family:Inter, sans-serif;overflow-x:hidden;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}h1, h2, h3, h4{font-family:"Playfair Display", serif;}.glass{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.6);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(255, 255, 255, 0.3);border-right-color:rgba(255, 255, 255, 0.3);border-bottom-color:rgba(255, 255, 255, 0.3);border-left-color:rgba(255, 255, 255, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.glass-dark{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.9);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.2);border-right-color:rgba(30, 64, 175, 0.2);border-bottom-color:rgba(30, 64, 175, 0.2);border-left-color:rgba(30, 64, 175, 0.2);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 32px;}.slider-container{position:relative;overflow-x:hidden;overflow-y:hidden;height:100vh;}.slider-wrapper{display:flex;transition-behavior:normal;transition-duration:0.8s;transition-timing-function:cubic-bezier(0.645, 0.045, 0.355, 1);transition-delay:0s;transition-property:transform;height:100%;}.slider-item{min-width:100%;height:100%;position:relative;}.slider-item img{width:100%;height:100%;object-fit:cover;object-position:center center;}.slider-overlay{position:absolute;top:0px;right:0px;bottom:0px;left:0px;}.float{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:float;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes float{0%, 100%{transform:translateY(0px);}}@keyframes float{50%{transform:translateY(-20px);}}.card-hover{transition-behavior:normal;transition-duration:0.4s;transition-timing-function:cubic-bezier(0.175, 0.885, 0.32, 1.275);transition-delay:0s;transition-property:all;position:relative;overflow-x:hidden;overflow-y:hidden;}.card-hover::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(30, 64, 175, 0.2), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.card-hover:hover::before{left:100%;}.card-hover:hover{transform:translateY(-10px) scale(1.02);box-shadow:rgba(30, 64, 175, 0.2) 0px 25px 50px;}.parallax{background-attachment:fixed;background-position-x:center;background-position-y:center;background-repeat:no-repeat;background-size:cover;}::-webkit-scrollbar{width:10px;}::-webkit-scrollbar-track{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}::-webkit-scrollbar-thumb{background-image:linear-gradient(45deg, rgb(30, 64, 175), rgb(30, 58, 138));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;}.pulse{animation-duration:2s;animation-timing-function:ease;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:pulse;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes pulse{0%, 100%{opacity:1;}}@keyframes pulse{50%{opacity:0.5;}}.glow{text-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px, rgba(30, 64, 175, 0.2) 0px 0px 40px, rgba(30, 64, 175, 0.1) 0px 0px 60px;}.stat-number{font-size:3rem;font-weight:900;background-image:linear-gradient(135deg, rgb(30, 64, 175) 0%, rgb(245, 158, 11) 50%, rgb(30, 64, 175) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-color:initial;-webkit-text-fill-color:transparent;background-clip:text;}.timeline-glow::before{content:"";position:absolute;left:0px;top:0px;bottom:0px;width:4px;background-image:linear-gradient(rgb(30, 64, 175), rgb(30, 58, 138), rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;box-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px;}.img-overlay{position:relative;overflow-x:hidden;overflow-y:hidden;}.img-overlay::after{content:"";position:absolute;top:0px;left:0px;right:0px;bottom:0px;background-image:linear-gradient(135deg, rgba(30, 64, 175, 0.3), rgba(248, 250, 252, 0.7));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;opacity:0;transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:opacity;}.img-overlay:hover::after{opacity:1;}.btn-shine{position:relative;overflow-x:hidden;overflow-y:hidden;}.btn-shine::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.btn-shine:hover::before{left:100%;}.particles{position:absolute;width:100%;height:100%;overflow-x:hidden;overflow-y:hidden;pointer-events:none;}.particle{position:absolute;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.3);border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;animation-duration:12s;animation-timing-function:ease-in;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:rise;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes rise{0%{bottom:-100px;opacity:0;transform:translateX(0px) rotate(0deg);}}@keyframes rise{50%{opacity:1;}}@keyframes rise{100%{bottom:120%;opacity:0;transform:translateX(100px) rotate(360deg);}}.card-3d{transform-style:preserve-3d;transition-behavior:normal;transition-duration:0.6s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.card-3d:hover{transform:rotateY(5deg) rotateX(5deg);}.hero-content{animation-duration:1s;animation-timing-function:ease-out;animation-delay:0.3s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:both;animation-play-state:running;animation-name:fadeInUp;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes fadeInUp{0%{opacity:0;transform:translateY(40px);}}@keyframes fadeInUp{100%{opacity:1;transform:translateY(0px);}}.decorative-line{position:relative;display:inline-block;}.decorative-line::before{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, transparent, rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;right:calc(100% + 20px);}.decorative-line::after{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, rgb(30, 64, 175), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;left:calc(100% + 20px);}.slider-control{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.8);backdrop-filter:blur(10px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.3);border-right-color:rgba(30, 64, 175, 0.3);border-bottom-color:rgba(30, 64, 175, 0.3);border-left-color:rgba(30, 64, 175, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.slider-control:hover{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.9);border-top-color:rgba(30, 64, 175, 0.8);border-right-color:rgba(30, 64, 175, 0.8);border-bottom-color:rgba(30, 64, 175, 0.8);border-left-color:rgba(30, 64, 175, 0.8);transform:scale(1.1);}.slider-indicator{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(31, 41, 55, 0.5);border-right-color:rgba(31, 41, 55, 0.5);border-bottom-color:rgba(31, 41, 55, 0.5);border-left-color:rgba(31, 41, 55, 0.5);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.slider-indicator.active{border-top-color:rgb(30, 64, 175);border-right-color:rgb(30, 64, 175);border-bottom-color:rgb(30, 64, 175);border-left-color:rgb(30, 64, 175);transform:scale(1.3);background-image:initial !important;background-position-x:initial !important;background-position-y:initial !important;background-size:initial !important;background-repeat:initial !important;background-attachment:initial !important;background-origin:initial !important;background-clip:initial !important;background-color:rgb(30, 64, 175) !important;}@keyframes fade-in{0%{opacity:0;transform:translateY(20px);}}@keyframes fade-in{100%{opacity:1;transform:translateY(0px);}}.animate-fade-in{animation-duration:0.6s;animation-timing-function:ease-out;animation-delay:0s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:running;animation-name:fade-in;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@media (max-width: 1023px){.slider-container{height:70vh;}}@media (max-width: 1023px){.hero-content h1{font-size:2.5rem !important;}}@media (max-width: 1023px){.hero-content p{font-size:1.1rem !important;}}@media (max-width: 768px){.slider-container{height:60vh;}}@media (max-width: 768px){.hero-content h1{font-size:2rem !important;line-height:1.2 !important;}}@media (max-width: 768px){.hero-content p{font-size:1rem !important;}}@media (max-width: 768px){.timeline-glow::before{left:12px;}}@media (max-width: 768px){.relative.pl-24{padding-left:80px;}}@media (max-width: 768px){.absolute.left-0.w-16.h-16{left:8px;width:48px;height:48px;}}@media (max-width: 768px){.slider-control{width:40px;height:40px;}}@media (max-width: 768px){.slider-control i{font-size:1.2rem;}}@media (max-width: 480px){.slider-container{height:50vh;}}@media (max-width: 480px){.hero-content h1{font-size:1.8rem !important;}}@media (max-width: 480px){.hero-content .flex-wrap button{width:100%;margin-bottom:10px;}}#ivpnb5{width:12px;height:12px;left:10%;animation-delay:0s;}#iviwfx{width:8px;height:8px;left:25%;animation-delay:2s;}#irrwk7{width:15px;height:15px;left:40%;animation-delay:4s;}#i47dzj{width:10px;height:10px;left:60%;animation-delay:1s;}#i7wrwj{width:12px;height:12px;left:75%;animation-delay:3s;}#ix5xu8{width:9px;height:9px;left:90%;animation-delay:5s;}
</style>


<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main>
    <div class="text-center px-2 pt-32">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_dokumenti_9c5cd7_901c93']['text'] ?? 'Dokumenti za preuzimanje', ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10"><?= htmlspecialchars($dynamicText['t_dokumenti_6d5ce2_cf3b77']['text'] ?? 'Preuzmi sva potrebna dokumenta, obrasce i publikacije Kulturnog Nexusa. Slažemo ih po kategorijama radi lakšeg pronalaženja.', ENT_QUOTES, 'UTF-8'); ?></p>

        <div class="mx-auto max-w-6xl">
            <form id="filter-form" method="GET" action="" class="bg-white rounded-2xl shadow p-6 mb-8 border border-gray-100">
                <div class="space-y-6">
                    <div class="flex gap-4 items-center">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Pretraži dokumenta..." class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl">
                        </div>
                        <select name="sort" class="px-4 py-3 border rounded-xl w-48">
                            <option value="date_desc"><?= htmlspecialchars($dynamicText['t_dokumenti_8623f0_765203']['text'] ?? 'Najnoviji prvo', ENT_QUOTES, 'UTF-8'); ?></option>
                            <option value="date_asc"><?= htmlspecialchars($dynamicText['t_dokumenti_7b576e_81eb59']['text'] ?? 'Najstariji prvo', ENT_QUOTES, 'UTF-8'); ?></option>
                            <option value="title"><?= htmlspecialchars($dynamicText['t_dokumenti_9f1f60_2794c1']['text'] ?? 'Po nazivu', ENT_QUOTES, 'UTF-8'); ?></option>
                        </select>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl whitespace-nowrap"><?= htmlspecialchars($dynamicText['t_dokumenti_f348ce_75c180']['text'] ?? 'Primeni', ENT_QUOTES, 'UTF-8'); ?></button>
                    </div>

                    <div class="w-full">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3"><?= htmlspecialchars($dynamicText['t_dokumenti_ba963e_6dd14c']['text'] ?? 'Kategorije', ENT_QUOTES, 'UTF-8'); ?></h3>
                        <div class="flex flex-wrap gap-2" id="categories-container">
                            <?php
                            $selectedCategories = isset($_GET['categories']) ? (array) $_GET['categories'] : [];
                            foreach ($DocumentCategories as $doc):
                                $isChecked = in_array($doc['id'], $selectedCategories);
                            ?>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>" class="sr-only peer" id="category_<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <label for="category_<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>" class="px-4 py-2 rounded-full border cursor-pointer <?= $isChecked ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-white hover:bg-gray-50' ?> 
                                           transition-all duration-200 text-sm font-medium select-none">
                                        <?= htmlspecialchars($doc['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </label>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        </div>
                    </div>

                    </form></div>
                </div>
            

            <!-- Notification -->
            <div id="download-notification" class="hidden fixed top-6 right-6 bg-green-600 text-white px-5 py-3 rounded-2xl shadow-lg z-50">
                <div class="flex items-center gap-3"><i class="fa-solid fa-check"></i><span id="download-notification-text"><?= htmlspecialchars($dynamicText['t_dokumenti_bf9610_8487f2']['text'] ?? 'Dokument se preuzima...', ENT_QUOTES, 'UTF-8'); ?></span></div>
            </div>

            <?php if (count($documents) > 0): ?>
                <div id="documents-grid" class="max-w-7xl mx-auto grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                                    <i class="fa-solid fa-download mr-2"></i><?= htmlspecialchars($dynamicText['t_dokumenti_1fda22_6ea27e']['text'] ?? 'Preuzmi', ENT_QUOTES, 'UTF-8'); ?></a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 mb-16 flex justify-center items-center gap-4">
                    <?php if ($page > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100"><?= htmlspecialchars($dynamicText['t_dokumenti_45c077_fac577']['text'] ?? '« Prethodna', ENT_QUOTES, 'UTF-8'); ?></a>
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
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100"><?= htmlspecialchars($dynamicText['t_dokumenti_c3987e_b05dc7']['text'] ?? 'Sledeća »', ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <div class="bg-white rounded-2xl shadow p-10 text-center">
                    <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-file-lines text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_dokumenti_d30f11_848317']['text'] ?? 'Nema pronađenih dokumenata', ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6"><?= htmlspecialchars($dynamicText['t_dokumenti_052cb3_c353b3']['text'] ?? 'Promenite filtere da biste videli druge dokumente ili proverite kasnije.', ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="?" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl"><?= htmlspecialchars($dynamicText['t_dokumenti_778678_1cc7f0']['text'] ?? 'Resetuj filtere', ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            <?php endif; ?>
        
    
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>


<script>
        document.querySelectorAll('input[name="categories[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
function showDownloadNotification(e, name) {
    const note = document.getElementById('download-notification');
    const text = document.getElementById('download-notification-text');
    if (!note || !text) return;
    text.textContent = name + ' se preuzima...';
    note.classList.remove('hidden');
    setTimeout(() => note.classList.add('hidden'), 2200);
}

document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const categoriesContainer = document.getElementById('categories-container');
    
    // Handle URL parameters for categories
    const urlParams = new URLSearchParams(window.location.search);
    const selectedCategories = urlParams.getAll('categories[]');
    
    // Check categories from URL
    if (selectedCategories.length > 0) {
        selectedCategories.forEach(catId => {
            const checkbox = document.querySelector(`input[name="categories[]"][value="${catId}"]`);
            if (checkbox) {
                checkbox.checked = true;
                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                if (label) {
                    label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                    label.classList.remove('bg-white', 'hover:bg-gray-50');
                }
            }
        });
    }
    
    if (categoriesContainer) {
        categoriesContainer.addEventListener('change', function(e) {
            if (e.target.type === 'checkbox') {
                const label = document.querySelector(`label[for="${e.target.id}"]`);
                if (label) {
                    if (e.target.checked) {
                        label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                        label.classList.remove('bg-white', 'hover:bg-gray-50');
                    } else {
                        label.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                        label.classList.add('bg-white', 'hover:bg-gray-50');
                    }
                }
            }
        });
    }

    if (filterForm) {
        filterForm.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (label && checkbox.checked) {
                label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                label.classList.remove('bg-white', 'hover:bg-gray-50');
            }
        });
    }
});
</script>