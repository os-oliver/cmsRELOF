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

use App\Models\Gallery;

$limit = 6;
$page = max(1, (int) ($_GET["page"] ?? 1));
$offset = ($page - 1) * $limit;
$documentModal = new Gallery();
[$images, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset
);
$totalPages = (int) ceil($totalCount / $limit);


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
    .gallery-grid {
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
        position: relative;
    }

    .gallery-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 0.5rem;
    }

    .gallery-item:hover::after {
        opacity: 1;
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
        display: block;
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
    .gallery-grid {
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
        position: relative;
    }

    .gallery-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 0.5rem;
    }

    .gallery-item:hover::after {
        opacity: 1;
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
        display: block;
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
.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(31, 41, 55);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(241, 245, 249);}*{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;box-sizing:border-box;}body{font-family:Inter, sans-serif;overflow-x:hidden;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}h1, h2, h3, h4{font-family:"Playfair Display", serif;}.glass{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.6);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(255, 255, 255, 0.3);border-right-color:rgba(255, 255, 255, 0.3);border-bottom-color:rgba(255, 255, 255, 0.3);border-left-color:rgba(255, 255, 255, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.glass-dark{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.9);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.2);border-right-color:rgba(30, 64, 175, 0.2);border-bottom-color:rgba(30, 64, 175, 0.2);border-left-color:rgba(30, 64, 175, 0.2);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 32px;}.slider-container{position:relative;overflow-x:hidden;overflow-y:hidden;height:100vh;}.slider-wrapper{display:flex;transition-behavior:normal;transition-duration:0.8s;transition-timing-function:cubic-bezier(0.645, 0.045, 0.355, 1);transition-delay:0s;transition-property:transform;height:100%;}.slider-item{min-width:100%;height:100%;position:relative;}.slider-item img{width:100%;height:100%;object-fit:cover;object-position:center center;}.slider-overlay{position:absolute;top:0px;right:0px;bottom:0px;left:0px;}.float{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:float;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes float{0%, 100%{transform:translateY(0px);}}@keyframes float{50%{transform:translateY(-20px);}}.card-hover{transition-behavior:normal;transition-duration:0.4s;transition-timing-function:cubic-bezier(0.175, 0.885, 0.32, 1.275);transition-delay:0s;transition-property:all;position:relative;overflow-x:hidden;overflow-y:hidden;}.card-hover::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(30, 64, 175, 0.2), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.card-hover:hover::before{left:100%;}.card-hover:hover{transform:translateY(-10px) scale(1.02);box-shadow:rgba(30, 64, 175, 0.2) 0px 25px 50px;}.parallax{background-attachment:fixed;background-position-x:center;background-position-y:center;background-repeat:no-repeat;background-size:cover;}::-webkit-scrollbar{width:10px;}::-webkit-scrollbar-track{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}::-webkit-scrollbar-thumb{background-image:linear-gradient(45deg, rgb(30, 64, 175), rgb(30, 58, 138));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;}.pulse{animation-duration:2s;animation-timing-function:ease;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:pulse;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes pulse{0%, 100%{opacity:1;}}@keyframes pulse{50%{opacity:0.5;}}.glow{text-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px, rgba(30, 64, 175, 0.2) 0px 0px 40px, rgba(30, 64, 175, 0.1) 0px 0px 60px;}.stat-number{font-size:3rem;font-weight:900;background-image:linear-gradient(135deg, rgb(30, 64, 175) 0%, rgb(245, 158, 11) 50%, rgb(30, 64, 175) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-color:initial;-webkit-text-fill-color:transparent;background-clip:text;}.timeline-glow::before{content:"";position:absolute;left:0px;top:0px;bottom:0px;width:4px;background-image:linear-gradient(rgb(30, 64, 175), rgb(30, 58, 138), rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;box-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px;}.img-overlay{position:relative;overflow-x:hidden;overflow-y:hidden;}.img-overlay::after{content:"";position:absolute;top:0px;left:0px;right:0px;bottom:0px;background-image:linear-gradient(135deg, rgba(30, 64, 175, 0.3), rgba(248, 250, 252, 0.7));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;opacity:0;transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:opacity;}.img-overlay:hover::after{opacity:1;}.btn-shine{position:relative;overflow-x:hidden;overflow-y:hidden;}.btn-shine::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.btn-shine:hover::before{left:100%;}.particles{position:absolute;width:100%;height:100%;overflow-x:hidden;overflow-y:hidden;pointer-events:none;}.particle{position:absolute;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.3);border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;animation-duration:12s;animation-timing-function:ease-in;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:rise;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes rise{0%{bottom:-100px;opacity:0;transform:translateX(0px) rotate(0deg);}}@keyframes rise{50%{opacity:1;}}@keyframes rise{100%{bottom:120%;opacity:0;transform:translateX(100px) rotate(360deg);}}.card-3d{transform-style:preserve-3d;transition-behavior:normal;transition-duration:0.6s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.card-3d:hover{transform:rotateY(5deg) rotateX(5deg);}.hero-content{animation-duration:1s;animation-timing-function:ease-out;animation-delay:0.3s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:both;animation-play-state:running;animation-name:fadeInUp;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes fadeInUp{0%{opacity:0;transform:translateY(40px);}}@keyframes fadeInUp{100%{opacity:1;transform:translateY(0px);}}.decorative-line{position:relative;display:inline-block;}.decorative-line::before{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, transparent, rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;right:calc(100% + 20px);}.decorative-line::after{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, rgb(30, 64, 175), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;left:calc(100% + 20px);}.slider-control{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.8);backdrop-filter:blur(10px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.3);border-right-color:rgba(30, 64, 175, 0.3);border-bottom-color:rgba(30, 64, 175, 0.3);border-left-color:rgba(30, 64, 175, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.slider-control:hover{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.9);border-top-color:rgba(30, 64, 175, 0.8);border-right-color:rgba(30, 64, 175, 0.8);border-bottom-color:rgba(30, 64, 175, 0.8);border-left-color:rgba(30, 64, 175, 0.8);transform:scale(1.1);}.slider-indicator{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(31, 41, 55, 0.5);border-right-color:rgba(31, 41, 55, 0.5);border-bottom-color:rgba(31, 41, 55, 0.5);border-left-color:rgba(31, 41, 55, 0.5);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.slider-indicator.active{border-top-color:rgb(30, 64, 175);border-right-color:rgb(30, 64, 175);border-bottom-color:rgb(30, 64, 175);border-left-color:rgb(30, 64, 175);transform:scale(1.3);background-image:initial !important;background-position-x:initial !important;background-position-y:initial !important;background-size:initial !important;background-repeat:initial !important;background-attachment:initial !important;background-origin:initial !important;background-clip:initial !important;background-color:rgb(30, 64, 175) !important;}@keyframes fade-in{0%{opacity:0;transform:translateY(20px);}}@keyframes fade-in{100%{opacity:1;transform:translateY(0px);}}.animate-fade-in{animation-duration:0.6s;animation-timing-function:ease-out;animation-delay:0s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:running;animation-name:fade-in;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@media (max-width: 1023px){.slider-container{height:70vh;}}@media (max-width: 1023px){.hero-content h1{font-size:2.5rem !important;}}@media (max-width: 1023px){.hero-content p{font-size:1.1rem !important;}}@media (max-width: 768px){.slider-container{height:60vh;}}@media (max-width: 768px){.hero-content h1{font-size:2rem !important;line-height:1.2 !important;}}@media (max-width: 768px){.hero-content p{font-size:1rem !important;}}@media (max-width: 768px){.timeline-glow::before{left:12px;}}@media (max-width: 768px){.relative.pl-24{padding-left:80px;}}@media (max-width: 768px){.absolute.left-0.w-16.h-16{left:8px;width:48px;height:48px;}}@media (max-width: 768px){.slider-control{width:40px;height:40px;}}@media (max-width: 768px){.slider-control i{font-size:1.2rem;}}@media (max-width: 480px){.slider-container{height:50vh;}}@media (max-width: 480px){.hero-content h1{font-size:1.8rem !important;}}@media (max-width: 480px){.hero-content .flex-wrap button{width:100%;margin-bottom:10px;}}#ivpnb5{width:12px;height:12px;left:10%;animation-delay:0s;}#iviwfx{width:8px;height:8px;left:25%;animation-delay:2s;}#irrwk7{width:15px;height:15px;left:40%;animation-delay:4s;}#i47dzj{width:10px;height:10px;left:60%;animation-delay:1s;}#i7wrwj{width:12px;height:12px;left:75%;animation-delay:3s;}#ix5xu8{width:9px;height:9px;left:90%;animation-delay:5s;}
</style>


<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="bg-background">
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>

    <section class="container mx-auto px-4 py-12 pt-32 text-secondary_text font-body">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold font-heading text-primary_text mb-2"><?= htmlspecialchars($dynamicText['t_galerija_a5176b_f0e8cb']['text'] ?? 'Kolekcija Slika', ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="text-lg font-heading2 text-secondary_text"><?= htmlspecialchars($dynamicText['t_galerija_ba0338_550041']['text'] ?? 'Istražite našu pažljivo odabranu kolekciju slika. Kliknite na bilo koju sliku da je pogledate u punoj veličini i da se krećete kroz galeriju.', ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="gallery-grid">
            <?php foreach ($images as $index => $image): ?>
                <div class="gallery-item" data-id="<?= $image->id ?>" data-index="<?= $index ?>" data-title="<?= htmlspecialchars($image->title) ?>" data-description="<?= htmlspecialchars($image->description) ?>">
                    <img src="<?= $image->image_file_path ?>" alt="<?= htmlspecialchars($image->title) ?>" loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination mt-12">
            <?php if ($page > 1): ?>
                <div class="page-item">
                    <a href="?page=<?= $page - 1 ?>" class="page-link"><?= htmlspecialchars($dynamicText['t_galerija_6015be_14230d']['text'] ?? 'Prev', ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <div class="page-item">
                    <a href="?page=<?= $i ?>" class="page-link <?= $i == $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                </div>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <div class="page-item">
                    <a href="?page=<?= $page + 1 ?>" class="page-link"><?= htmlspecialchars($dynamicText['t_galerija_368f30_10ac3d']['text'] ?? 'Next', ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<div class="lightbox" id="lightbox">
    <button class="close-btn" id="closeLightbox">×</button>
    <button class="nav-btn prev-btn bg-primary hover:primary_hover" id="prevBtn">❮</button>

    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <div class="lightbox-info">
            <div class="lightbox-title" id="lightboxTitle"></div>
            <div class="lightbox-description" id="lightboxDescription"></div>
            <div class="mt-2 text-sm opacity-70" id="lightboxPosition"></div>
        </div>
    </div>

    <button class="nav-btn next-btn bg-primary hover:primary_hover" id="nextBtn">❯</button>
</div>

<script>
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const lightboxPosition = document.getElementById('lightboxPosition');
    const closeBtn = document.getElementById('closeLightbox');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;

    function showLightbox(index) {
        const item = galleryItems[index];
        lightboxImage.src = item.querySelector('img').src;
        lightboxTitle.textContent = item.dataset.title;
        lightboxDescription.textContent = item.dataset.description;
        lightboxPosition.textContent = `Slika ${index + 1} od ${galleryItems.length}`;
        currentIndex = index;
        lightbox.classList.add('active');
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => showLightbox(index));
    });

    closeBtn.addEventListener('click', () => lightbox.classList.remove('active'));
    prevBtn.addEventListener('click', () => showLightbox((currentIndex - 1 + galleryItems.length) % galleryItems.length));
    nextBtn.addEventListener('click', () => showLightbox((currentIndex + 1) % galleryItems.length));

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) lightbox.classList.remove('active');
    });
</script>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>


