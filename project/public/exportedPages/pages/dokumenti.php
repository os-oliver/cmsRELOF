<?php
use App\Models\Document;
use App\Controllers\AuthController;


// defaults
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination as before
$limit = 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$documentModal = new Document();

// now pass filters into your Document model
[$documents, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset,
    search: $search,
    category: $category,
    status: $status,
    sort: $sort,
);

$totalPages = (int) ceil($totalCount / $limit);
$DocumentCategories = $documentModal->getCategories();

function getFileConfig(string $ext): array
{
    switch (strtolower($ext)) {
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
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dokumenti</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<script src="https://cdn.tailwindcss.com"></script>
  <style>
      .category-toggle input:checked+label {
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
        } * { box-sizing: border-box; } body {margin: 0;}.mobile-dropdown.active .mobile-dropdown-content{max-height:500px;}.mobile-dropdown.active .mobile-dropdown-chevron{transform:rotate(180deg);}#ixxdvb{animation-delay:1s;}#ins8jk{animation-delay:2s;}#iuspa7{animation-delay:3s;}#itee15{background-image:radial-gradient(#344e41 1px, transparent 1px);background-size:20px 20px;}#ibu8z9{clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);}#iitqk5{clip-path:polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);}#iktigq{border:0;}@layer utilities{.artistic-underline{background-image:url(&quot;data:image/svg+xml;utf8,&lt;svg xmlns=\&quot;http://www.w3.org/2000/svg\&quot; viewBox=\&quot;0 0 120 20\&quot;&gt;&lt;path fill=\&quot;none\&quot; stroke=\&quot;%23d4a373\&quot; stroke-width=\&quot;3\&quot; stroke-linecap=\&quot;round\&quot; d=\&quot;M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12\&quot;/&gt;&lt;/svg&gt;&quot;);background-position-x:center;background-position-y:bottom;background-repeat:no-repeat;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 12px;padding-bottom:12px;}.nav-link::after{content:&quot;&quot;;display:block;width:0px;height:3px;background-image:linear-gradient(to right, rgb(212, 163, 115), rgb(188, 108, 37));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:width;}.nav-link:hover::after{width:100%;}.artistic-card{clip-path:polygon(0px 0px, 100% 0px, 100% 85%, 95% 100%, 0px 100%);transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.artistic-card:hover{transform:translateY(-10px);box-shadow:rgba(0, 0, 0, 0.2) 0px 20px 30px -10px;}.artistic-frame{position:relative;}.artistic-frame::before{content:&quot;&quot;;position:absolute;top:-15px;left:-15px;right:-15px;bottom:-15px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(212, 163, 115);border-right-color:rgb(212, 163, 115);border-bottom-color:rgb(212, 163, 115);border-left-color:rgb(212, 163, 115);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(2deg);}.artistic-frame::after{content:&quot;&quot;;position:absolute;top:-10px;left:-10px;right:-10px;bottom:-10px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(163, 177, 138);border-right-color:rgb(163, 177, 138);border-bottom-color:rgb(163, 177, 138);border-left-color:rgb(163, 177, 138);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(-1deg);}.category-badge{position:absolute;top:15px;right:15px;padding-top:5px;padding-right:12px;padding-bottom:5px;padding-left:12px;border-top-left-radius:20px;border-top-right-radius:20px;border-bottom-right-radius:20px;border-bottom-left-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;backdrop-filter:blur(4px);z-index:20;}.hero-gradient{background-image:linear-gradient(135deg, rgb(245, 235, 224) 0%, rgb(212, 163, 115) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;}.hamburger span{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.hamburger.active span:nth-child(1){transform:rotate(45deg) translate(6px, 6px);}.hamburger.active span:nth-child(2){opacity:0;}.hamburger.active span:nth-child(3){transform:rotate(-45deg) translate(5px, -5px);}.section-divider{height:100px;background-image:url(&quot;data:image/svg+xml;utf8,&lt;svg xmlns=\&quot;http://www.w3.org/2000/svg\&quot; viewBox=\&quot;0 0 1200 120\&quot; preserveAspectRatio=\&quot;none\&quot;&gt;&lt;path d=\&quot;M1200 120L0 16.48 0 0 1200 0 1200 120z\&quot; fill=\&quot;%23f5ebe0\&quot;&gt;&lt;/path&gt;&lt;/svg&gt;&quot;);background-position-x:initial;background-position-y:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 100px;}.floating{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:floating;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}0%{transform:scale(1);opacity:0;}50%{transform:scale(1.05);opacity:1;}100%{transform:scale(1);opacity:1;}.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(52, 78, 65);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(249, 245, 240);border-left-width:3px;border-left-style:solid;border-left-color:rgb(212, 163, 115);}.event-card:hover::before{transform:translateY(0px);}.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));row-gap:15px;column-gap:15px;}.gallery-item img{transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.gallery-item:hover img{transform:scale(1.1);}.gallery-item:hover::after{opacity:1;}.gallery-item .overlay-content{position:absolute;bottom:-30px;left:0px;right:0px;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;z-index:10;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:bottom;color:white;}.gallery-item:hover .overlay-content{bottom:0px;}}
  </style>

</head>
<body class="min-h-screen flex flex-col">

<?php
// dokumenti page header include
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

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
</main><?php
// dokumenti page footer include
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
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/></svg>')",
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
    </script><script>
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
        window.location.href = `/download-document?id=${documentId}`;
    }, 1500);
}

// Function to view document
function viewDocument(documentId) {
    // Open document in new tab
    window.open(`/view-document?id=${documentId}`, '_blank');
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
</script></body>
</html>
