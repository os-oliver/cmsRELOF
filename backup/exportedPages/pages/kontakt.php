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

        .form-toggle input:checked + label {
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
        }
    

        .form-toggle input:checked + label {
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
        }
    
.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(31, 41, 55);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(241, 245, 249);}*{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;box-sizing:border-box;}body{font-family:Inter, sans-serif;overflow-x:hidden;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}h1, h2, h3, h4{font-family:"Playfair Display", serif;}.glass{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.6);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(255, 255, 255, 0.3);border-right-color:rgba(255, 255, 255, 0.3);border-bottom-color:rgba(255, 255, 255, 0.3);border-left-color:rgba(255, 255, 255, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.glass-dark{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.9);backdrop-filter:blur(20px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.2);border-right-color:rgba(30, 64, 175, 0.2);border-bottom-color:rgba(30, 64, 175, 0.2);border-left-color:rgba(30, 64, 175, 0.2);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 32px;}.slider-container{position:relative;overflow-x:hidden;overflow-y:hidden;height:100vh;}.slider-wrapper{display:flex;transition-behavior:normal;transition-duration:0.8s;transition-timing-function:cubic-bezier(0.645, 0.045, 0.355, 1);transition-delay:0s;transition-property:transform;height:100%;}.slider-item{min-width:100%;height:100%;position:relative;}.slider-item img{width:100%;height:100%;object-fit:cover;object-position:center center;}.slider-overlay{position:absolute;top:0px;right:0px;bottom:0px;left:0px;}.float{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:float;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes float{0%, 100%{transform:translateY(0px);}}@keyframes float{50%{transform:translateY(-20px);}}.card-hover{transition-behavior:normal;transition-duration:0.4s;transition-timing-function:cubic-bezier(0.175, 0.885, 0.32, 1.275);transition-delay:0s;transition-property:all;position:relative;overflow-x:hidden;overflow-y:hidden;}.card-hover::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(30, 64, 175, 0.2), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.card-hover:hover::before{left:100%;}.card-hover:hover{transform:translateY(-10px) scale(1.02);box-shadow:rgba(30, 64, 175, 0.2) 0px 25px 50px;}.parallax{background-attachment:fixed;background-position-x:center;background-position-y:center;background-repeat:no-repeat;background-size:cover;}::-webkit-scrollbar{width:10px;}::-webkit-scrollbar-track{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(248, 250, 252);}::-webkit-scrollbar-thumb{background-image:linear-gradient(45deg, rgb(30, 64, 175), rgb(30, 58, 138));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;}.pulse{animation-duration:2s;animation-timing-function:ease;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:pulse;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes pulse{0%, 100%{opacity:1;}}@keyframes pulse{50%{opacity:0.5;}}.glow{text-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px, rgba(30, 64, 175, 0.2) 0px 0px 40px, rgba(30, 64, 175, 0.1) 0px 0px 60px;}.stat-number{font-size:3rem;font-weight:900;background-image:linear-gradient(135deg, rgb(30, 64, 175) 0%, rgb(245, 158, 11) 50%, rgb(30, 64, 175) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-color:initial;-webkit-text-fill-color:transparent;background-clip:text;}.timeline-glow::before{content:"";position:absolute;left:0px;top:0px;bottom:0px;width:4px;background-image:linear-gradient(rgb(30, 64, 175), rgb(30, 58, 138), rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;box-shadow:rgba(30, 64, 175, 0.4) 0px 0px 20px;}.img-overlay{position:relative;overflow-x:hidden;overflow-y:hidden;}.img-overlay::after{content:"";position:absolute;top:0px;left:0px;right:0px;bottom:0px;background-image:linear-gradient(135deg, rgba(30, 64, 175, 0.3), rgba(248, 250, 252, 0.7));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;opacity:0;transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:opacity;}.img-overlay:hover::after{opacity:1;}.btn-shine{position:relative;overflow-x:hidden;overflow-y:hidden;}.btn-shine::before{content:"";position:absolute;top:0px;left:-100%;width:100%;height:100%;background-image:linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:left;}.btn-shine:hover::before{left:100%;}.particles{position:absolute;width:100%;height:100%;overflow-x:hidden;overflow-y:hidden;pointer-events:none;}.particle{position:absolute;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.3);border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-right-radius:50%;border-bottom-left-radius:50%;animation-duration:12s;animation-timing-function:ease-in;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:rise;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes rise{0%{bottom:-100px;opacity:0;transform:translateX(0px) rotate(0deg);}}@keyframes rise{50%{opacity:1;}}@keyframes rise{100%{bottom:120%;opacity:0;transform:translateX(100px) rotate(360deg);}}.card-3d{transform-style:preserve-3d;transition-behavior:normal;transition-duration:0.6s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.card-3d:hover{transform:rotateY(5deg) rotateX(5deg);}.hero-content{animation-duration:1s;animation-timing-function:ease-out;animation-delay:0.3s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:both;animation-play-state:running;animation-name:fadeInUp;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@keyframes fadeInUp{0%{opacity:0;transform:translateY(40px);}}@keyframes fadeInUp{100%{opacity:1;transform:translateY(0px);}}.decorative-line{position:relative;display:inline-block;}.decorative-line::before{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, transparent, rgb(30, 64, 175));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;right:calc(100% + 20px);}.decorative-line::after{content:"";position:absolute;top:50%;width:60px;height:2px;background-image:linear-gradient(90deg, rgb(30, 64, 175), transparent);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;left:calc(100% + 20px);}.slider-control{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(255, 255, 255, 0.8);backdrop-filter:blur(10px);border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(30, 64, 175, 0.3);border-right-color:rgba(30, 64, 175, 0.3);border-bottom-color:rgba(30, 64, 175, 0.3);border-left-color:rgba(30, 64, 175, 0.3);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.slider-control:hover{background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgba(30, 64, 175, 0.9);border-top-color:rgba(30, 64, 175, 0.8);border-right-color:rgba(30, 64, 175, 0.8);border-bottom-color:rgba(30, 64, 175, 0.8);border-left-color:rgba(30, 64, 175, 0.8);transform:scale(1.1);}.slider-indicator{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgba(31, 41, 55, 0.5);border-right-color:rgba(31, 41, 55, 0.5);border-bottom-color:rgba(31, 41, 55, 0.5);border-left-color:rgba(31, 41, 55, 0.5);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;}.slider-indicator.active{border-top-color:rgb(30, 64, 175);border-right-color:rgb(30, 64, 175);border-bottom-color:rgb(30, 64, 175);border-left-color:rgb(30, 64, 175);transform:scale(1.3);background-image:initial !important;background-position-x:initial !important;background-position-y:initial !important;background-size:initial !important;background-repeat:initial !important;background-attachment:initial !important;background-origin:initial !important;background-clip:initial !important;background-color:rgb(30, 64, 175) !important;}@keyframes fade-in{0%{opacity:0;transform:translateY(20px);}}@keyframes fade-in{100%{opacity:1;transform:translateY(0px);}}.animate-fade-in{animation-duration:0.6s;animation-timing-function:ease-out;animation-delay:0s;animation-iteration-count:1;animation-direction:normal;animation-fill-mode:forwards;animation-play-state:running;animation-name:fade-in;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}@media (max-width: 1023px){.slider-container{height:70vh;}}@media (max-width: 1023px){.hero-content h1{font-size:2.5rem !important;}}@media (max-width: 1023px){.hero-content p{font-size:1.1rem !important;}}@media (max-width: 768px){.slider-container{height:60vh;}}@media (max-width: 768px){.hero-content h1{font-size:2rem !important;line-height:1.2 !important;}}@media (max-width: 768px){.hero-content p{font-size:1rem !important;}}@media (max-width: 768px){.timeline-glow::before{left:12px;}}@media (max-width: 768px){.relative.pl-24{padding-left:80px;}}@media (max-width: 768px){.absolute.left-0.w-16.h-16{left:8px;width:48px;height:48px;}}@media (max-width: 768px){.slider-control{width:40px;height:40px;}}@media (max-width: 768px){.slider-control i{font-size:1.2rem;}}@media (max-width: 480px){.slider-container{height:50vh;}}@media (max-width: 480px){.hero-content h1{font-size:1.8rem !important;}}@media (max-width: 480px){.hero-content .flex-wrap button{width:100%;margin-bottom:10px;}}#ivpnb5{width:12px;height:12px;left:10%;animation-delay:0s;}#iviwfx{width:8px;height:8px;left:25%;animation-delay:2s;}#irrwk7{width:15px;height:15px;left:40%;animation-delay:4s;}#i47dzj{width:10px;height:10px;left:60%;animation-delay:1s;}#i7wrwj{width:12px;height:12px;left:75%;animation-delay:3s;}#ix5xu8{width:9px;height:9px;left:90%;animation-delay:5s;}
</style>


<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="pt-2 flex-grow">
<div class="py-12 mt-20 px-4 flex-1">
        <div>
            <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
                A+
            </button>
        </div>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-orange-600 to-blue-600 bg-clip-text text-transparent"><?= htmlspecialchars($dynamicText['t_kontakt_a6cb55_e42ffd']['text'] ?? 'Kontaktirajte nas', ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed"><?= htmlspecialchars($dynamicText['t_kontakt_14c095_091dff']['text'] ?? 'Vaše mišljenje nam je važno. Kontaktirajte nas za sve informacije ili pošaljite žalbu kako bismo
                    mogli da poboljšamo naše usluge.', ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover h-fit">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8"><?= htmlspecialchars($dynamicText['t_kontakt_c4a2f6_d6f9f0']['text'] ?? 'Kontakt informacije', ENT_QUOTES, 'UTF-8'); ?></h2>

                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="icon-bg p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($dynamicText['t_kontakt_6d9858_f6999f']['text'] ?? 'Adresa', ENT_QUOTES, 'UTF-8'); ?></h3>
                                    <p class="text-gray-600 leading-relaxed"><?= htmlspecialchars($dynamicText['t_kontakt_d377bd_b4afdb']['text'] ?? 'Centar za umetnost i baštinu', ENT_QUOTES, 'UTF-8'); ?><br><?= htmlspecialchars($dynamicText['t_kontakt_f7c9e0_34702e']['text'] ?? 'Trg
                                        slobode 1', ENT_QUOTES, 'UTF-8'); ?><br><?= htmlspecialchars($dynamicText['t_kontakt_a94093_f6fc64']['text'] ?? '21000 Novi Sad, Srbija', ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-blue p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($dynamicText['t_kontakt_c11a0e_0975cf']['text'] ?? 'Telefon', ENT_QUOTES, 'UTF-8'); ?></h3>
                                    <p class="text-gray-600 text-lg">+381 21 123 456</p>
                                    <p class="text-gray-500 text-sm"><?= htmlspecialchars($dynamicText['t_kontakt_b33706_ac7bef']['text'] ?? 'Ponedeljak - Petak: 09:00 - 17:00', ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-green p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($dynamicText['t_kontakt_d81d68_ce8ae9']['text'] ?? 'Email', ENT_QUOTES, 'UTF-8'); ?></h3>
                                    <p class="text-gray-600 text-lg" data-translate="off">info@kulturnynexus.rs</p>
                                    <p class="text-gray-500 text-sm"><?= htmlspecialchars($dynamicText['t_kontakt_8a9e3f_c0d269']['text'] ?? 'Odgovaramo u roku od 24h', ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 p-6 bg-gradient-to-br from-orange-50 to-blue-50 rounded-2xl border border-orange-100">
                            <h3 class="text-xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_kontakt_52a8fd_16f2a3']['text'] ?? 'Radno vreme', ENT_QUOTES, 'UTF-8'); ?></h3>
                            <div class="text-gray-700 space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium"><?= htmlspecialchars($dynamicText['t_kontakt_98b9b1_0286e5']['text'] ?? 'Ponedeljak - Petak:', ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span>09:00 - 17:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium"><?= htmlspecialchars($dynamicText['t_kontakt_108544_d9c89f']['text'] ?? 'Subota:', ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span>10:00 - 14:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium"><?= htmlspecialchars($dynamicText['t_kontakt_bdabc6_454f27']['text'] ?? 'Nedelja:', ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span class="text-red-500"><?= htmlspecialchars($dynamicText['t_kontakt_49ad3e_f50368']['text'] ?? 'Zatvoreno', ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover">


                        <!-- Success Message (hidden by default) -->
                        <div id="success-message" class="hidden mb-8 p-6 bg-green-50 border-2 border-green-200 rounded-2xl success-message">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-green-800 font-bold text-lg" id="success-title"><?= htmlspecialchars($dynamicText['t_kontakt_644902_63e66c']['text'] ?? 'Vaša poruka je
                                        uspešno poslata!', ENT_QUOTES, 'UTF-8'); ?></p>
                                    <p class="text-green-700"><?= htmlspecialchars($dynamicText['t_kontakt_17b1a3_d0ce73']['text'] ?? 'Odgovoriće vam u najkraćem mogućem roku.', ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <form id="contact-form" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3"><?= htmlspecialchars($dynamicText['t_kontakt_4ba022_3539f9']['text'] ?? 'Ime i prezime *', ENT_QUOTES, 'UTF-8'); ?></label>
                                    <input type="text" name="ime" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="Unesite vaše ime i prezime">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3"><?= htmlspecialchars($dynamicText['t_kontakt_c35a44_ad4848']['text'] ?? 'Email adresa *', ENT_QUOTES, 'UTF-8'); ?></label>
                                    <input type="email" name="email" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="vasa.email@primer.com">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3"><?= htmlspecialchars($dynamicText['t_kontakt_32f0fd_693039']['text'] ?? 'Broj telefona', ENT_QUOTES, 'UTF-8'); ?></label>
                                    <input type="tel" name="telefon" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="+381 xx xxx xxxx">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        <span id="subject-label"><?= htmlspecialchars($dynamicText['t_kontakt_504db5_55e18c']['text'] ?? 'Naslov poruke *', ENT_QUOTES, 'UTF-8'); ?></span>
                                    </label>
                                    <input type="text" name="naslov" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="Kratko opišite razlog kontakta" id="subject-input">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3">
                                    <span id="message-label"><?= htmlspecialchars($dynamicText['t_kontakt_ff1769_9a1399']['text'] ?? 'Vaša poruka *', ENT_QUOTES, 'UTF-8'); ?></span>
                                </label>
                                <textarea name="poruka" required="" rows="6" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg resize-none" placeholder="Detaljno opišite vaš upit ili problem..." id="message-input"></textarea>
                            </div>

                            <div class="pt-6">
                                <button type="submit" class="w-full text-white font-bold py-5 px-8 rounded-2xl submit-btn text-lg" id="submit-button">
                                    <span class="flex items-center justify-center space-x-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        <span id="submit-text"><?= htmlspecialchars($dynamicText['t_kontakt_600545_701225']['text'] ?? 'Pošaljite poruku', ENT_QUOTES, 'UTF-8'); ?></span>
                                    </span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>


<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const fullName = document.querySelector('input[name="ime"]').value.trim();
    const parts = fullName.split(' ').filter(p => p.length > 0);

    if (parts.length < 2) {
        alert("Molimo unesite i ime i prezime.");
        return;
    }

    const ime = parts[0];
    const prezime = parts.slice(1).join(' ');

    const formData = {
        ime: ime || '',
        prezime: prezime || '',
        email: document.querySelector('input[name="email"]').value,
        phone: document.querySelector('input[name="telefon"]').value,
        naslov: document.querySelector('input[name="naslov"]').value,
        poruka: document.querySelector('textarea[name="poruka"]').value
    };

    try {
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            // Show success message
            const successMessage = document.getElementById('success-message');
            successMessage.classList.remove('hidden');

            // Reset form
            this.reset();

            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.classList.add('hidden');
            }, 5000);
        } else {
            throw new Error('Failed to send message');
        }
    } catch (error) {
        alert('Error sending message: ' + error.message);
    }
});
</script>