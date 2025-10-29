<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturni Centar Nexus</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style type="text/css">
        :root {
            --gallery-gap: 1.25rem;
            --card-radius: 12px;
            --overlay-gradient: linear-gradient(180deg, rgba(0, 0, 0, 0.0) 30%, rgba(0, 0, 0, 0.45) 100%);
            --card-shadow: 0 8px 30px rgba(2, 6, 23, 0.08);
            --ochre: #CC8B3C;
            --terracotta: #C85A3E;
            --coral: #E07856;
            --slate: #2C3E50;
            --royal-blue: #4A6FA5;
            --deep-teal: #2A6B6A;
            --velvet: #8B4789;
            --sage: #7A9B76;
            --crimson: #A83737;
            --paper: #FEFAF6;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        header .flex-1 {
            flex-grow: 1;
        }

        nav#navBarID {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (max-width: 1024px) {
            nav#navBarID {
                justify-content: flex-start;
            }
        }

        .nav-link {
            position: relative;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--terracotta);
        }

        .nav-item .dropdown-menu {
            left: 50%;
            transform: translateX(-50%) translateY(-10px);
        }

        .nav-item:hover .dropdown-menu {
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
            padding: 8px 0;
        }

        .nav-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: var(--slate);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: var(--terracotta);
            padding-left: 20px;
        }

        .dropdown-item i {
            margin-right: 10px;
            width: 16px;
            text-align: center;
        }

        .hamburger span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--slate);
            margin: 4px 0;
            transition: all 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        #mobileMenu {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        #mobileMenu.active {
            transform: translateX(0);
        }

        .mobile-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-submenu.active {
            max-height: 600px;
        }

        .chevron-icon {
            transition: transform 0.3s ease;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        #searchBox {
            display: none;
        }

        #searchBox.active {
            display: block;
        }

        #overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }

        #overlay.active {
            display: block;
        }

        .text-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .artistic-underline {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 20"><path fill="none" stroke="%23d4a373" stroke-width="3" stroke-linecap="round" d="M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12"/></svg>') bottom center no-repeat;
            background-size: 100% 12px;
            padding-bottom: 12px;
        }

        .artistic-card {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 95% 100%, 0 100%);
            transition: all 0.4s ease;
        }

        .artistic-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.2);
        }

        .artistic-frame {
            position: relative;
        }

        .artistic-frame::before {
            content: '';
            position: absolute;
            top: -15px;
            left: -15px;
            right: -15px;
            bottom: -15px;
            border: 2px solid #d4a373;
            z-index: -1;
            transform: rotate(2deg);
        }

        .artistic-frame::after {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid #a3b18a;
            z-index: -1;
            transform: rotate(-1deg);
        }

        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(4px);
            z-index: 20;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #f5ebe0 0%, #d4a373 100%);
        }

        .mobile-menu .section-divider {
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="%23f5ebe0"></path></svg>');
            background-size: 100% 100px;
        }

        .mobile-menu .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .mobile-menu .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }

        .mobile-menu .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .event-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(to right, #d4a373, #bc6c25);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .event-card:hover::before {
            transform: translateY(0);
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .featured-card {
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }

        .featured-card-content {
            transform: translateZ(30px);
        }

        /* Gallery styles */
        #galleryCards.gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: var(--gallery-gap);
            align-items: start;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--card-radius);
            background: #f8fafc;
            aspect-ratio: 4 / 3;
            transition: transform .28s ease, box-shadow .28s ease;
            will-change: transform;
            display: block;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .6s cubic-bezier(.2, .8, .2, 1);
            transform-origin: center center;
        }

        .gallery-item:hover,
        .gallery-item:focus-within {
            transform: translateY(-6px);
            box-shadow: var(--card-shadow);
        }

        .gallery-item:hover img {
            transform: scale(1.06) rotate(0.2deg);
        }

        .gallery-item::after {
            content: "";
            position: absolute;
            inset: 0;
            background: var(--overlay-gradient);
            pointer-events: none;
            transition: opacity .35s ease;
            opacity: 1;
        }

        .overlay-content {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.9rem 1rem;
            transform: translateY(100%);
            transition: transform .34s cubic-bezier(.22, .9, .3, 1), opacity .34s ease;
            opacity: 0;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            z-index: 3;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.0) 0%, rgba(0, 0, 0, 0.32) 60%, rgba(0, 0, 0, 0.45) 100%);
        }

        .gallery-item:hover .overlay-content,
        .gallery-item:focus-within .overlay-content {
            transform: translateY(0%);
            opacity: 1;
        }

        .overlay-content h3 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.05;
            text-shadow: 0 6px 18px rgba(0, 0, 0, 0.55);
        }

        .overlay-content p {
            margin: 0;
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.9);
            opacity: 0.95;
        }

        .gallery-item .overlay-content * {
            color: inherit;
        }

        @media (max-width: 639px) {
            #galleryCards.gallery-grid {
                gap: 0.75rem;
            }

            .gallery-item {
                aspect-ratio: 5 / 4;
            }

            .overlay-content {
                padding: 0.75rem;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            #galleryCards.gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            #galleryCards.gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1280px) {
            #galleryCards.gallery-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .gallery-item:focus {
            outline: 3px solid rgba(59, 130, 246, 0.18);
            outline-offset: 4px;
        }

        /* keep dropdown display behavior for legacy .dropdown elements */
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body class="bg-paper font-body text-slate min-h-screen overflow-x-hidden">

    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-100">
        <div class="flex items-center w-full h-16 px-4 lg:px-6">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 flex-shrink-0">
                <div
                    class="w-11 h-11 bg-gradient-to-br from-[#CC8B3C] via-[#C85A3E] to-[#E07856] rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <img src="" alt="" style="width:75px;height:auto;" />
                </div>
                <div class="hidden sm:block">
                    <div class="text-xl font-display font-bold text-[#2C3E50] leading-tight">KULTURNI NEXUS</div>
                    <div class="text-xs text-[#C85A3E] tracking-wide hidden md:block">Centar za umetnost i baštinu</div>
                </div>
                <div class="sm:hidden text-base font-display font-bold text-[#2C3E50]">NEXUS</div>
            </a>

            <!-- Central Navigation -->
            <div class="flex-1 flex justify-center">
                <nav id="navBarID" class="hidden lg:flex items-center gap-1 flex-wrap">
                    <a href="/"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-home text-[#C85A3E] mr-1.5"></i>Početna
                    </a>

                    <!-- Dropdown O nama -->
                    <div class="dropdown nav-item relative">
                        <button
                            class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50 flex items-center">
                            <i class="fas fa-info-circle text-[#CC8B3C] mr-1.5"></i>O nama
                            <i class="fas fa-chevron-down text-xs ml-1.5"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="/o-nama/cilj" class="dropdown-item">
                                <i class="fas fa-bullseye text-[#4A6FA5]"></i>Cilj
                            </a>
                            <a href="/o-nama/misija" class="dropdown-item">
                                <i class="fas fa-flag text-[#E07856]"></i>Misija
                            </a>
                            <a href="/o-nama/zaposleni" class="dropdown-item">
                                <i class="fas fa-users text-[#2A6B6A]"></i>Zaposleni
                            </a>
                            <a href="/o-nama/istorijat" class="dropdown-item">
                                <i class="fas fa-history text-[#CC8B3C]"></i>Istorijat
                            </a>
                            <a static="true" href="/o-nama/objekat" class="dropdown-item">
                                <i class="fas fa-building text-[#C85A3E]"></i>Objekat
                            </a>
                            <div class="border-t border-gray-100 my-1 mx-3"></div>
                            <a href="/o-nama/donacije" class="dropdown-item">
                                <i class="fas fa-hand-holding-heart text-[#4A6FA5]"></i>Donacije
                            </a>
                            <a href="/o-nama/partneri" class="dropdown-item">
                                <i class="fas fa-handshake text-[#7A9B76]"></i>Partneri
                            </a>
                            <a href="/o-nama/licenca" class="dropdown-item">
                                <i class="fas fa-certificate text-[#CC8B3C]"></i>Licenca
                            </a>

                        </div>
                    </div>

                    <!-- Dropdown Događaji -->
                    <a href="/dogadjaji"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-calendar-alt text-[#4A6FA5] mr-3 w-5"></i>Dogadjaji
                    </a>


                    <a href="/sekcije"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-theater-masks text-[#8B4789] mr-1.5"></i>Sekcije
                    </a>

                    <a href="/projekti"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-project-diagram text-[#CC8B3C] mr-1.5"></i>Projekti
                    </a>

                    <!-- Dropdown Galerija -->
                    <div class="dropdown nav-item relative">
                        <button
                            class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50 flex items-center">
                            <i class="fas fa-images text-[#8B4789] mr-1.5"></i>Galerija
                            <i class="fas fa-chevron-down text-xs ml-1.5"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item"><i class="fas fa-camera"></i>Foto galerija</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-camera"></i>Video galerija</a>
                        </div>
                    </div>
                    <a href="/dokumenti"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-folder-open text-[#E07856] mr-1.5"></i>Dokumenti
                    </a>


                    <a href="/vesti"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-newspaper text-[#4A6FA5] mr-1.5"></i>Vesti
                    </a>
                    <a href="/kontakt"
                        class="nav-link px-3 py-2 text-sm font-semibold text-[#2C3E50] rounded-lg hover:bg-gray-50">
                        <i class="fas fa-address-book text-[#2A6B6A] mr-1.5"></i>Kontakt
                    </a>



                    <?php
                    if (isset($_GET['locale'])) {
                        $_SESSION['locale'] = $_GET['locale'];
                    }
                    $locale = $_SESSION['locale'] ?? 'sr';

                    $languages = [
                        'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                        'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                        'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
                    ];

                    if (!isset($languages[$locale])) {
                        $locale = 'sr';
                    }

                    ?>
                    <div class="locale dropdown nonPage relative group ">
                        <button
                            class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                            <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                            <span
                                class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                            <i
                                class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <div class="dropdown-menu>
                            <?php foreach ($languages as $key => $lang): ?>
                                <a href=" ?locale=<?= $key ?>"
                            class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2">
                <!-- Search -->
                <div class="relative">
                    <button id="searchToggle"
                        class="p-2 text-[#2C3E50] hover:text-[#C85A3E] rounded-full hover:bg-gray-50 transition">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="searchBox"
                        class="absolute right-0 top-full mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden hidden">
                        <form action="/search" method="GET" class="flex items-center p-3">
                            <input name="q" type="text" placeholder="Pretražite..."
                                class="flex-1 text-sm px-4 py-2 rounded-lg bg-gray-50 border-0 focus:ring-2 focus:ring-[#C85A3E] outline-none"
                                required>
                            <button type="submit" class="ml-2 p-2 text-[#C85A3E] hover:bg-gray-100 rounded-full">
                                <i class="fas fa-search"></i>
                            </button>
                            <button type="button" id="closeSearch" class="ml-1 p-2 hover:bg-gray-100 rounded-full">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Hamburger -->
                <button id="mobileToggle" class="lg:hidden hamburger p-2 rounded-lg hover:bg-gray-50">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Overlay -->
    <div id="overlay"></div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-y-0 right-0 w-full max-w-sm bg-white shadow-2xl z-50 overflow-y-auto">
        <div class="p-5">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-[#CC8B3C] to-[#E07856] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-[#2C3E50]">KULTURNI NEXUS</div>
                        <div class="text-xs text-[#C85A3E]">Centar za umetnost</div>
                    </div>
                </div>
                <button id="mobileClose" class="p-2 hover:bg-gray-100 rounded-lg">
                    <img src="" alt="" />
                </button>
            </div>

            <nav class="space-y-1">
                <a href="/" class="block px-4 py-3 rounded-lg hover:bg-gray-50 font-medium">
                    <i class="fas fa-home text-[#C85A3E] mr-3 w-5"></i>Početna
                </a>

                <div>
                    <button
                        class="mobile-accordion w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 font-medium flex items-center justify-between"
                        data-target="mob-o-nama">
                        <span><i class="fas fa-info-circle text-[#CC8B3C] mr-3 w-5"></i>O nama</span>
                        <img src="" alt="" />
                    </button>
                    <div id="mob-o-nama" class="mobile-submenu pl-4 space-y-1">
                        <a href="/o-nama/uvod" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Uvod</a>
                        <a href="/o-nama/misija" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Misija i
                            vizija</a>
                        <a href="/o-nama/istorijat"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Istorijat</a>
                        <a href="/o-nama/rukovodstvo"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Rukovodstvo</a>
                        <a href="/o-nama/objekat"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Objekat</a>
                        <a href="/o-nama/donacije"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Donacije</a>
                        <a href="/o-nama/partneri"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Partneri</a>
                        <a href="/o-nama/licenca"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Licenca</a>
                    </div>
                </div>
                <a href="/dogadjaji" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">
                    <span><i class="fas fa-calendar-alt text-[#4A6FA5] mr-3 w-5"></i>Događaji</span>
                </a>


                <a href="/sekcije" class="block px-4 py-3 rounded-lg hover:bg-gray-50 font-medium">
                    <i class="fas fa-theater-masks text-[#8B4789] mr-3 w-5"></i>Sekcije
                </a>

                <a href="/projekti" class="block px-4 py-3 rounded-lg hover:bg-gray-50 font-medium">
                    <i class="fas fa-project-diagram text-[#CC8B3C] mr-3 w-5"></i>Projekti
                </a>

                <div>
                    <button
                        class="mobile-accordion w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 font-medium flex items-center justify-between"
                        data-target="mob-galerija">
                        <span><i class="fas fa-images text-[#8B4789] mr-3 w-5"></i>Galerija</span>
                        <i class="fas fa-chevron-down chevron-icon text-sm"></i>
                    </button>
                    <div id="mob-galerija" class="mobile-submenu pl-4 space-y-1">
                        <a href="/galerija/prostori" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Foto
                            prostora</a>
                        <a href="/galerija/dokumentacija"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Dokumentacija</a>
                    </div>
                </div>
                <a href="/dokumenti" class="block px-4 py-3 rounded-lg hover:bg-gray-50 font-medium">
                    <i class="fas fa-folder-open text-[#E07856] mr-3 w-5"></i>Dokumenti
                </a>



                <a href="/vesti" class="block px-4 py-3 rounded-lg hover:bg-gray-50 font-medium">
                    <i class="fas fa-newspaper text-[#4A6FA5] mr-3 w-5"></i>Vesti
                </a>

                <div>
                    <button
                        class="mobile-accordion w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 font-medium flex items-center justify-between"
                        data-target="mob-kontakt">
                        <span><i class="fas fa-address-book text-[#2A6B6A] mr-3 w-5"></i>Kontakt</span>
                        <i class="fas fa-chevron-down chevron-icon text-sm"></i>
                    </button>
                    <div id="mob-kontakt" class="mobile-submenu pl-4 space-y-1">
                        <a href="/kontakt/lokacija"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Lokacija</a>
                        <a href="/kontakt/radno-vreme" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Radno
                            vreme</a>
                        <a href="/kontakt/formular" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Kontakt
                            obrazac</a>
                        <a href="/kontakt/anketa" class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Anketa</a>
                        <a href="/kontakt/cenovnik"
                            class="block px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Cenovnik</a>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-4 pt-4">
                    <div class="px-4 py-2 text-sm text-gray-500 font-medium">Jezik</div>
                    <a href="?locale=sr" class="block px-4 py-2 rounded-lg hover:bg-gray-50"><span
                            class="mr-2">🇷🇸</span>Srpski</a>
                    <a href="?locale=sr-Cyrl" class="block px-4 py-2 rounded-lg hover:bg-gray-50"><span
                            class="mr-2">🇷🇸</span>Српски</a>
                    <a href="?locale=en" class="block px-4 py-2 rounded-lg hover:bg-gray-50"><span
                            class="mr-2">🇬🇧</span>English</a>
                </div>
            </nav>
        </div>
    </div>




    <!-- Enhanced Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 z-0">
            <!-- Floating paint elements -->
            <div class="absolute top-20 left-10 w-80 h-40 bg-clay opacity-15 transform rotate-12 rounded-full floating">
            </div>
            <div class="absolute bottom-40 right-20 w-64 h-32 bg-deep-teal opacity-10 transform -rotate-6 rounded-full floating"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-ochre opacity-10 floating" style="animation-delay: 2s;">
            </div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 bg-crimson opacity-10 rounded-full floating"
                style="animation-delay: 3s;"></div>

            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#344e41 1px, transparent 1px); background-size: 20px 20px;">
            </div>

            <!-- Paint splatters -->
            <div class="absolute top-1/4 right-1/5 w-24 h-24 bg-ochre opacity-10 rounded-full"
                style="clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);"></div>
            <div class="absolute bottom-1/3 left-1/6 w-20 h-20 bg-terracotta opacity-10"
                style="clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);"></div>
        </div>

        <div class="container max-w-full mx-10 px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <div class="mb-8">
                        <span class="inline-block bg-sage text-slate px-4 py-1 rounded-full text-sm font-medium mb-6">
                            <i class="fas fa-star mr-2"></i>Istaknuto ovog meseca
                        </span>
                        <h1 class="text-5xl md:text-6xl font-display font-bold leading-tight text-slate mb-6">
                            <span class="block artistic-underline">Mesto gde se umetnost, film i</span>
                            <span class="block text-royal-blue mt-2">kultura susreću</span>
                        </h1>
                    </div>

                    <div class="mb-10 relative pl-6 border-l-4 border-ochre">
                        <p class="text-xl text-slate-700 leading-relaxed max-w-lg mb-6">
                            Doživite živopisnu spoju vizuelnih umetnosti, nezavisnog filma, pozorišta i kulturne baštine
                            u našem novom renoviranom prostoru.
                        </p>
                        <p class="text-slate-600 italic">
                            "Kulturni centar je srce zajednice, gde različiti izrazi pronalaze zajednički jezik."
                            <span class="block font-medium text-terracotta mt-2">— Elena Rodriguez, Umetnički
                                direktor</span>
                        </p>
                    </div>



                    <!-- Quick links -->
                    <div class="mt-10 flex flex-wrap gap-3">
                        <a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors">
                            <span class="w-3 h-3 bg-ochre rounded-full mr-2"></span>
                            Trenutne izložbe
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors">
                            <span class="w-3 h-3 bg-royal-blue rounded-full mr-2"></span>
                            Raspored filmova
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors">
                            <span class="w-3 h-3 bg-velvet rounded-full mr-2"></span>
                            Pozorišne predstave
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors">
                            <span class="w-3 h-3 bg-deep-teal rounded-full mr-2"></span>
                            Muzički događaji
                        </a>
                    </div>
                </div>

                <!-- Cultural Showcase Grid -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Art Exhibition -->
                        <div class="artistic-card h-80 rounded-xl overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1547891654-e66ed7ebb968?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-ochre/80 text-paper">Umetnost</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper">
                                <h3 class="font-display font-bold">Savremene Perspektive</h3>
                                <p class="text-sm">Savremena umetnička izložba</p>
                            </div>
                        </div>

                        <!-- Film -->
                        <div class="artistic-card h-80 rounded-xl overflow-hidden relative mt-12">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-royal-blue/80 text-paper">Bioskop</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper">
                                <h3 class="font-display font-bold">Međunarodni Filmski Festival</h3>
                                <p class="text-sm">15-30. jun</p>
                            </div>
                        </div>

                        <!-- Theater -->
                        <div class="artistic-card h-64 rounded-xl overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-velvet/80 text-paper">Pozorište</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper">
                                <h3 class="font-display font-bold">Šekspir u parku</h3>
                                <p class="text-sm">Predstave na otvorenom</p>
                            </div>
                        </div>

                        <!-- Music -->
                        <div class="artistic-card h-64 rounded-xl overflow-hidden relative -mt-6">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-deep-teal/80 text-paper">Muzika</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper">
                                <h3 class="font-display font-bold">Jazz & Blues Večeri</h3>
                                <p class="text-sm">Svakog petka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating info card -->
        <div class="absolute bottom-20 right-20 z-20 hidden xl:block animate-bounce-slow">
            <div class="relative">
                <div
                    class="w-66 h-auto bg-white/90 backdrop-blur-sm p-5 rounded-xl shadow-2xl border-2 border-ochre transform rotate-3">
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 bg-sage rounded-full mr-3 flex items-center justify-center text-paper">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-display font-bold">Radno vreme</h4>
                            <p class="text-terracotta text-sm">Utorak-Nedelja: 10:00-21:00</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Opšta:</span>
                            <span class="font-medium">1200 RSD</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Studenti/Penzioneri:</span>
                            <span class="font-medium">800 RSD</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Članovi:</span>
                            <span class="font-medium">Besplatno</span>
                        </div>
                    </div>

                </div>
                <div
                    class="absolute -top-6 -right-6 w-12 h-12 bg-sage rounded-full flex items-center justify-center text-paper shadow-lg">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-8 h-14 rounded-full border-2 border-terracotta flex justify-center p-1">
                <div class="w-2 h-2 bg-terracotta rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Section divider -->
    <div class="section-divider w-full bg-white"></div>

    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Predstojeći Događaji
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Istražite našu bogatu ponudu kulturnih događaja koji će vas inspirisati i zabaviti
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="event-card bg-paper rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Art Exhibition" class="w-full h-full object-cover">

                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-terracotta flex items-center justify-center text-paper mr-3">
                                <i class="fas fa-palette"></i>
                            </div>
                            <span id="g-naziv" class="text-terracotta font-bold">IZLOŽBA</span>
                        </div>
                        <h3 id="g-title" class="text-xl font-display font-bold text-slate mb-2">Savremene Perspektive
                        </h3>

                        <p id="g-description" class="text-slate-600 mb-4">Radovi mladih umetnika koji istražuju
                            identitet u digitalnom dobu.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span id="g-time">18:00 - 21:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span id="g-location">Galerija Savremene Umetnosti</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="event-card bg-paper rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Film Festival" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-royal-blue text-paper px-3 py-1 rounded-full text-sm font-bold">
                            20 JUN
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-royal-blue flex items-center justify-center text-paper mr-3">
                                <i class="fas fa-film"></i>
                            </div>
                            <span class="text-royal-blue font-bold">FILM</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Međunarodni Filmski Festival</h3>
                        <p class="text-slate-600 mb-4">Premijera nagrađivanog dokumentarca "Svet u pokretu".</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>19:30 - 22:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Nexus Bioskop</span>
                                </div>
                            </div>
                            <button
                                class="bg-royal-blue text-paper px-4 py-2 rounded-full text-sm font-medium hover:bg-deep-teal transition-colors">
                                Karte
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="event-card bg-paper rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://images.unsplash.com/photo-1543429776-2782fc586c9a?auto=format&fit=crop&w=600&q=80"
                            alt="Jazz Night" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-deep-teal text-paper px-3 py-1 rounded-full text-sm font-bold">
                            SVAKOG PETKA
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-deep-teal flex items-center justify-center text-paper mr-3">
                                <i class="fas fa-music"></i>
                            </div>
                            <span class="text-deep-teal font-bold">KONCERT</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Jazz & Blues Večeri</h3>
                        <p class="text-slate-600 mb-4">Uživajte u improvizacijama renomiranog kvarteta "Midnight Blue".
                        </p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>20:00 - 23:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Nexus Koncertna Sala</span>
                                </div>
                            </div>
                            <button
                                class="bg-deep-teal text-paper px-4 py-2 rounded-full text-sm font-medium hover:bg-slate transition-colors">
                                Karte
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/vesti" id="eventsView"
                    class="bg-gradient-to-r from-slate to-slate/90 text-paper px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Exhibition Section -->
    <section id="promocija" class="py-2index.ph0 bg-gradient-to-br from-paper to-ochre/10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 relative">
                    <div class="artistic-frame">
                        <img src="https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?auto=format&fit=crop&w=800&q=80"
                            alt="Featured Exhibition" class="rounded-xl shadow-2xl">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-32 h-32 bg-terracotta rounded-full flex items-center justify-center text-paper text-5xl font-display font-bold shadow-xl">
                        50%
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span class="inline-block bg-sage text-slate px-4 py-1 rounded-full text-sm font-medium mb-6">
                        <i class="fas fa-fire mr-2"></i>Specijalna ponuda
                    </span>
                    <h2 class="text-4xl font-display font-bold text-slate mb-6">
                        <span class="block">Retrospektiva</span>
                        <span class="block text-terracotta">Miodraga Miće Popovića</span>
                    </h2>
                    <p class="text-lg text-slate-700 mb-6 leading-relaxed">
                        Ekskluzivna izložba koja obuhvata najznačajnija dela jednog od najuticajnijih srpskih umetnika
                        20. veka. Ova retrospektiva predstavlja jedinstvenu priliku da se upoznate sa evolucijom
                        Popovićevog stvaralaštva kroz pet decenija.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-terracotta text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-slate-600">Datum</p>
                                <p class="font-medium">1. jun - 15. jul</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-terracotta text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-slate-600">Vreme</p>
                                <p class="font-medium">10:00 - 20:00</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-terracotta text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-slate-600">Lokacija</p>
                                <p class="font-medium">Galerija Savremene Umetnosti</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-gradient-to-r from-terracotta to-ochre text-paper px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Rezerviši karte
                        </button>
                        <button
                            class="border-2 border-terracotta text-terracotta px-8 py-4 rounded-full font-medium hover:bg-terracotta/10 transition-all flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Saznaj više
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="vesti" class="py-20 bg-gradient-to-br from-slate-50 to-paper">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Najnovije Vesti
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-terracotta via-royal-blue to-deep-teal rounded-full">
                    </div>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-6">
                    Budite u toku sa najnovijim dešavanjima iz sveta kulture, obrazovanja i inovacija
                </p>
            </div>

            <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Vest 1 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="h-56 relative overflow-hidden">
                        <img id="g-slika"
                            src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                            alt="Vest"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-terracotta to-terracotta/80 flex items-center justify-center text-paper shadow-md">
                                <i class="fas fa-newspaper text-lg"></i>
                            </div>
                            <div class="flex items-center text-sm text-slate-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span id="g-datum">15. Oktobar 2025</span>
                            </div>
                        </div>

                        <h3 id="g-naslov"
                            class="text-xl font-display font-bold text-slate mb-3 group-hover:text-terracotta transition-colors line-clamp-2">
                            Novi kulturni centar otvara vrata građanima
                        </h3>

                        <p id="g-opis" class="text-slate-600 mb-5 line-clamp-3 leading-relaxed">
                            Nakon dve godine izgradnje, novi kulturni centar spreman je da postane epicentar
                            kreativnosti i umetnosti u našem gradu.
                        </p>

                        <a id="g-ovise" href="#"
                            class="inline-flex items-center text-terracotta font-semibold hover:gap-3 gap-2 transition-all group/link">
                            Pročitaj više
                            <i class="fas fa-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>

                <!-- Vest 2 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="h-56 relative overflow-hidden">
                        <img id="g-slika"
                            src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=600&q=80"
                            alt="Vest"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-royal-blue to-royal-blue/80 flex items-center justify-center text-paper shadow-md">
                                <i class="fas fa-newspaper text-lg"></i>
                            </div>
                            <div class="flex items-center text-sm text-slate-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span id="g-datum">12. Oktobar 2025</span>
                            </div>
                        </div>

                        <h3 id="g-naslov"
                            class="text-xl font-display font-bold text-slate mb-3 group-hover:text-royal-blue transition-colors line-clamp-2">
                            Stipendije za mlade naučnike i istraživače
                        </h3>

                        <p id="g-opis" class="text-slate-600 mb-5 line-clamp-3 leading-relaxed">
                            Univerzitet najavljuje novi program stipendija za talentovane studente u oblasti nauke i
                            tehnologije.
                        </p>

                        <a id="g-link" href="#"
                            class="inline-flex items-center text-royal-blue font-semibold hover:gap-3 gap-2 transition-all group/link">
                            Pročitaj više
                            <i class="fas fa-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>

                <!-- Vest 3 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="h-56 relative overflow-hidden">
                        <img id="g-slika"
                            src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&q=80"
                            alt="Vest"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-deep-teal to-deep-teal/80 flex items-center justify-center text-paper shadow-md">
                                <i class="fas fa-newspaper text-lg"></i>
                            </div>
                            <div class="flex items-center text-sm text-slate-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span id="g-datum">10. Oktobar 2025</span>
                            </div>
                        </div>

                        <h3 id="g-naslov"
                            class="text-xl font-display font-bold text-slate mb-3 group-hover:text-deep-teal transition-colors line-clamp-2">
                            Inovativna AI platforma za obrazovanje
                        </h3>

                        <p id="g-opis" class="text-slate-600 mb-5 line-clamp-3 leading-relaxed">
                            Lokalni startup predstavlja revolucionarnu platformu koja koristi veštačku inteligenciju za
                            personalizovano učenje.
                        </p>

                        <a id="g-link" href="#"
                            class="inline-flex items-center text-deep-teal font-semibold hover:gap-3 gap-2 transition-all group/link">
                            Pročitaj više
                            <i class="fas fa-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>
            </div>

            <div class="text-center mt-16">
                <button id="vestiView"
                    class="bg-gradient-to-r from-slate via-slate/95 to-slate/90 text-paper px-10 py-4 rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center mx-auto group shadow-xl">
                    <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform"></i>
                    Pogledaj sve vesti
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4">
                    Upoznajte Naš Prostor
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Moderni, inspirativni prostori dizajnirani za raznovrsne kulturne aktivnosti
                </p>
            </div>

            <div id="galleryCards" class="gallery-grid gap-6">
                <div class="gallery-item rounded-xl overflow-hidden relative">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?auto=format&fit=crop&w=600&q=80"
                        alt="Gallery Space" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 id="g-description" class="font-bold text-lg">Galerija Savremene Umetnosti</h3>
                        <p id="g-title" class="text-sm">Prostor za izložbe</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?auto=format&fit=crop&w=600&q=80"
                        alt="Cinema" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-black text-lg">Nexus Bioskop</h3>
                        <p class="text-sm text-black">Projekcione sale</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1562788865-5638f7446611?auto=format&fit=crop&w=600&q=80"
                        alt="Theater" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Pozorišna Scena</h3>
                        <p class="text-sm">Mesto za predstave</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Kreativne Radionice</h3>
                        <p class="text-sm">Prostor za učenje</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1601924994987-69e26d50dc26?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Nexus Kafić</h3>
                        <p class="text-sm">Mesto za opuštanje</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=600&q=80"
                        alt="Library" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Umetnička Biblioteka</h3>
                        <p class="text-sm">Prostor za čitanje</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate text-paper pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-ochre rounded-lg flex items-center justify-center text-paper mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-display font-bold">KULTURNI NEXUS</h3>
                    </div>
                    <p class="text-paper/80 mb-4">
                        Centar za umetnost i kulturu koji okuplja kreativce i publiku u srcu Beograda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-ochre/30 hover:bg-ochre flex items-center justify-center text-paper transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-ochre/30 hover:bg-ochre flex items-center justify-center text-paper transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-ochre/30 hover:bg-ochre flex items-center justify-center text-paper transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-ochre/30 hover:bg-ochre flex items-center justify-center text-paper transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="asde" class="text-paper/80 hover:text-ochre transition-colors">Izložbe</a></li>
                        <li><a href="#" class="text-paper/80 hover:text-ochre transition-colors">Bioskop</a></li>
                        <li><a href="#" class="text-paper/80 hover:text-ochre transition-colors">Pozorište</a></li>
                        <li><a href="#" class="text-paper/80 hover:text-ochre transition-colors">Koncerti</a></li>
                        <li><a href="#" class="text-paper/80 hover:text-ochre transition-colors">Radionice</a></li>
                        <li><a href="#" class="text-paper/80 hover:text-ochre transition-colors">Kalendar događaja</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-ochre mt-1 mr-3"></i>
                            <span>Knez Mihailova 56, 11000 Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-ochre mt-1 mr-3"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-ochre mt-1 mr-3"></i>
                            <span>info@kulturninexus.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-ochre mt-1 mr-3"></i>
                            <span>
                                Utorak - Nedelja: 10:00 - 21:00<br>
                                Ponedeljak: zatvoreno
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Mapa lokacije</h4>
                    <div class="bg-paper/10 rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d20.4541920155352!3d44.81407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sKnez%20Mihailova%2C%20Beograd!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8 text-center text-paper/60 text-sm">
                <p>&copy; 2023 Kulturni Centar Nexus. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

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

        // Search Toggle
        const searchToggle = document.getElementById('searchToggle');
        const searchBox = document.getElementById('searchBox');
        const closeSearch = document.getElementById('closeSearch');
        const overlay = document.getElementById('overlay');

        searchToggle.addEventListener('click', () => {
            searchBox.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        closeSearch.addEventListener('click', () => {
            searchBox.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            searchBox.classList.remove('active');
            overlay.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileToggle.classList.remove('active');
        });

        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileClose = document.getElementById('mobileClose');

        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileToggle.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        mobileClose.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            mobileToggle.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Mobile Accordion
        const mobileAccordions = document.querySelectorAll('.mobile-accordion');

        mobileAccordions.forEach(accordion => {
            accordion.addEventListener('click', () => {
                const targetId = accordion.getAttribute('data-target');
                const submenu = document.getElementById(targetId);
                const chevron = accordion.querySelector('.chevron-icon');

                // Close other submenus
                document.querySelectorAll('.mobile-submenu').forEach(menu => {
                    if (menu.id !== targetId && menu.classList.contains('active')) {
                        menu.classList.remove('active');
                        const otherChevron = document.querySelector(`[data-target="${menu.id}"] .chevron-icon`);
                        if (otherChevron) otherChevron.classList.remove('rotated');
                    }
                });

                // Toggle current submenu
                submenu.classList.toggle('active');
                chevron.classList.toggle('rotated');
            });
        });

        // Close mobile menu on link click
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileToggle.classList.remove('active');
                overlay.classList.remove('active');
            });
        });

        // Sticky header effect
        let lastScroll = 0;
        const header = document.querySelector('header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll <= 0) {
                header.style.transform = 'translateY(0)';
                return;
            }

            if (currentScroll > lastScroll && currentScroll > 100) {
                // Scrolling down
                header.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                header.style.transform = 'translateY(0)';
            }

            lastScroll = currentScroll;
        });
    </script>
</body>

</html>