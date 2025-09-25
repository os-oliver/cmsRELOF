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
        .search-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 0;
            opacity: 0;
            padding: 0;
            border: none;
        }

        .search-input.open {
            width: 200px;
            opacity: 1;
            padding: 0.5rem 1rem;
            border: 1px solid #cbd5e1;
        }

        .mobile-dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .mobile-dropdown.active .mobile-dropdown-content {
            max-height: 500px;
        }

        .mobile-dropdown.active .mobile-dropdown-chevron {
            transform: rotate(180deg);
        }

        @layer utilities {
            .text-shadow {
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            }

            .artistic-underline {
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 20"><path fill="none" stroke="%23d4a373" stroke-width="3" stroke-linecap="round" d="M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12"/></svg>') bottom center no-repeat;
                background-size: 100% 12px;
                padding-bottom: 12px;
            }

            .nav-link::after {
                content: '';
                display: block;
                width: 0;
                height: 3px;
                background: linear-gradient(to right, #d4a373, #bc6c25);
                transition: width 0.3s;
            }

            .nav-link:hover::after {
                width: 100%;
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

            .mobile-menu {
                transform: translateX(100%);
                transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
            }

            .mobile-menu.active {
                transform: translateX(0);
            }

            .hamburger span {
                transition: all 0.3s ease;
            }

            .hamburger.active span:nth-child(1) {
                transform: rotate(45deg) translate(6px, 6px);
            }

            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active span:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }

            .section-divider {
                height: 100px;
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="%23f5ebe0"></path></svg>');
                background-size: 100% 100px;
            }

            .floating {
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

            .pulse {
                animation: pulse 2s infinite;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
            }

            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: white;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
                z-index: 1;
                border-radius: 8px;
                overflow: hidden;
            }

            .dropdown-item {
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                color: #344e41;
                transition: all 0.3s;
                border-left: 3px solid transparent;
            }

            .dropdown-item:hover {
                background-color: #f9f5f0;
                border-left: 3px solid #d4a373;
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

            .fade-in {
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

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .gallery-item {
                aspect-ratio: 3/4;
                overflow: hidden;
                position: relative;
            }

            .gallery-item img {
                transition: transform 0.5s ease;
            }

            .gallery-item:hover img {
                transform: scale(1.1);
            }

            .gallery-item::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 60%);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .gallery-item:hover::after {
                opacity: 1;
            }

            .gallery-item .overlay-content {
                position: absolute;
                bottom: -30px;
                left: 0;
                right: 0;
                padding: 15px;
                z-index: 10;
                transition: bottom 0.3s ease;
                color: white;
            }

            .gallery-item:hover .overlay-content {
                bottom: 0;
            }
        }
    </style>
</head>

<body class="bg-light font-body text-slate min-h-screen overflow-x-hidden">
    <!-- Enhanced Header -->
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-light shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-white font-display font-bold text-slate">Menu</h2>
                    <button id="closeMobileMenu" class="text-slate hover:text-terracotta transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-terracotta"></i>Početna
                    </a>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-ochre"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-bullseye mr-2 text-royal-blue"></i>Cilj
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-sitemap mr-2 text-terracotta"></i>Zaposleni
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-flag mr-2 text-deep-teal"></i>Misija
                            </a>
                        </div>
                    </div>
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-royal-blue"></i>Dogadjaji
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-velvet"></i>Galerija
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-coral"></i>Dokumenti
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fa-solid fa-graduation-cap mr-3 text-primary"></i>Naučni klub
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-deep-teal"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
    <header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm bg-light">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div
                    class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-xl lg:text-2xl font-display text-slate font-bold tracking-wider">Centar za obrazovanje</h1>
                    <p class="text-xs text-barn_red tracking-widest hidden md:block">CENTAR ZA OBRAZOVANJE</p>
                </div>
                <div class="block sm:hidden">
                    <h1 class="text-lg font-display text-slate font-bold">CZO</h1>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-8">
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-home mr-2 text-terracotta group-hover:text-coral transition-colors"></i>
                    <span class="hidden xl:inline">Pocetna</span>
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                        <i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i>
                        <span class="hidden xl:inline">O nama</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0  w-48 bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm">
                            <i class="fas fa-bullseye mr-2 text-royal-blue"></i>Cilj
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm">
                            <i class="fas fa-sitemap mr-2 text-terracotta"></i>Zaposleni
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm">
                            <i class="fas fa-flag mr-2 text-deep-teal"></i>Misija
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                    <i
                        class="fas fa-calendar-alt mr-2 text-royal-blue group-hover:text-deep-teal transition-colors"></i>
                    <span class="hidden xl:inline">Dogadjaji</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-images mr-2 text-velvet group-hover:text-crimson transition-colors"></i>
                    <span class="hidden xl:inline">Galerija</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors group flex items-center whitespace-nowrap">
                    <i class="fas fa-folder-open mr-2 text-coral group-hover:text-terracotta transition-colors"></i>
                    <span class="hidden xl:inline">Dokumenti</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                    <i class="fa-solid fa-graduation-cap mr-2 text-primary group-hover:text-sage transition-colors"></i>
                    <span class="hidden xl:inline">Naučni klub</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-address-book mr-2 text-deep-teal group-hover:text-sage transition-colors"></i>
                    <span class="hidden xl:inline">Kontakt</span>
                </a>
                <?php
                if (isset($_GET['locale'])) {
                    $_SESSION['locale'] = $_GET['locale'];
                }
                $locale = $_SESSION['locale'] ?? 'sr';

                $languages = [
                    'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
                ];

                if (!isset($languages[$locale])) {
                    $locale = 'sr';
                }
                ?>
                <div class="dropdown relative group">
                    <button class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                        <span class="mr-2"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline"><?= $languages[$locale]['label'] ?></span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute top-full left-0 w-48 bg-paper rounded-md shadow-lg z-50">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm">
                                <span class="mr-2"><?= $lang['flag'] ?></span>
                                <?= $lang['label'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>

            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Search Container -->
                <div class="relative">
                    <button id="searchButton"
                        class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-2"
                        aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    <!-- Search Input - positioned to avoid nav overlap -->
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-2 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden">
                        <form id="searchForm" class="flex items-center w-full p-1.5" action="/pretraga" method="GET">
                            <input type="text" name="q" placeholder="Search..."
                                class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-1.5 text-gray-700 placeholder-gray-400"
                                id="searchInput" required />
                            <div class="flex items-center space-x-1 ml-2">
                                <button type="submit"
                                    class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"
                                    aria-label="Submit search">
                                    <i class="fas fa-search text-sm"></i>
                                </button>
                                <button type="button"
                                    class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"
                                    id="closeSearch" aria-label="Clear search"
                                    onclick="document.getElementById('searchInput').value=''; document.getElementById('searchInput').focus();">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="hamburger"
                    class="hamburger lg:hidden text-slate w-8 h-8 flex flex-col justify-center space-y-1 p-1">
                    <span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>

    <section class="hero relative flex items-center z-10 bg-[linear-gradient(rgba(11,53,88,0.7),rgba(11,53,88,0.7)),url('https://picsum.photos/1600/600?blur')] bg-cover bg-center text-white w-full h-[600px]">
        <div class="max-w-6xl mx-auto px-4 py-20 text-center">
            <h2 class="text-3xl sm:text-4xl font-display font-bold leading-tight">Dobrodošli u našu ustanovu</h2>
            <p class="mt-4 text-lg max-w-2xl mx-auto">Znanje, inovacije i budućnost u srcu obrazovanja.</p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#" class="inline-flex items-center px-6 py-3 rounded-md bg-accent text-primary font-semibold shadow-md hover:brightness-95 transition">Saznaj više</a>
                <a href="#" class="inline-flex items-center px-6 py-3 rounded-md border border-white/20 text-white hover:bg-white/10 transition">Prijava na seminar</a>
            </div>
        </div>
    </section>

    <!-- Najnnovije vesti -->
    <section id="events" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-primary mb-4 relative inline-block">
                    Najnovije vesti
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-secondary"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices vitae nibh at ultrices. Etiam semper lobortis neque non eleifend.
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <button id="eventsView"
                    class="bg-primary text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve vesti
                </button>
            </div>
        </div>
    </section>


    <!-- Naucni klub -->
    <section class="py-20 bg-primary/90">
        <div class="container mx-auto px-4">
            <div class="text-center text-white mb-16">
                <h2 class="text-4xl font-display font-bold mb-4 relative inline-block">
                    Naučni klub
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-secondary"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices vitae nibh at ultrices. Etiam semper lobortis neque non eleifend.
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="event-card bg-light rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <div class="event-card bg-light rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <div class="event-card bg-light rounded-xl overflow-hidden shadow-md hover:shadow-xl">
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
                <button id="eventsView"
                    class="bg-accent text-black px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg mx-auto">
                    Saznaj više
                    <i class="fa-solid fa-arrow-right ml-3"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Nasa dostignuca -->
    <section class="relative bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1600&q=60')] bg-cover bg-center bg-fixed">
        <div class="bg-black/60 py-20 px-4">
            <div class="max-w-6xl mx-auto text-center text-white">
                <h2 class="text-4xl font-display font-bold">Naša dostignuća</h2>
                <p class="mt-2 text-lg text-slate-600">Ovde možete pogledati neke statistike Centra za obrazovanje</p>
                <div class="mt-10 grid grid-cols-2 md:grid-cols-5 gap-6">
                    <div>
                        <div class="text-accent text-4xl font-extrabold">995</div>
                        <p class="mt-1">Održanih seminara</p>
                    </div>
                    <div>
                        <div class="text-accent text-4xl font-extrabold">32,370</div>
                        <p class="mt-1">Učesnika seminara</p>
                    </div>
                    <div>
                        <div class="text-accent text-4xl font-extrabold">73</div>
                        <p class="mt-1">Državnih nagrada</p>
                    </div>
                    <div>
                        <div class="text-accent text-4xl font-extrabold">158</div>
                        <p class="mt-1">Ležajeva u odmaralištu</p>
                    </div>
                    <div>
                        <div class="text-accent text-4xl font-extrabold">131</div>
                        <p class="mt-1">Projekata Naučnog kluba</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl text-primary font-display font-bold mb-4 relative inline-block">
                    Galerija
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-secondary"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices vitae nibh at ultrices. Etiam semper lobortis neque non eleifend.
                </p>
            </div>

            <div id="galleryCards" class="gallery-grid gap-6">
                <div class="gallery-item rounded-xl overflow-hidden relative">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?auto=format&fit=crop&w=600&q=80"
                        alt="Gallery Space" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 id="g-description" class="font-bold text-lg">Lorem ipsum</h3>
                        <p id="g-title" class="text-sm">Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?auto=format&fit=crop&w=600&q=80"
                        alt="Cinema" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Lorem ipsum</h3>
                        <p class="text-sm">Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold  text-lg">Lorem ipsum</h3>
                        <p class="text-sm">Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1601924994987-69e26d50dc26?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold  text-lg">Lorem ipsum</h3>
                        <p class="text-sm">Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=600&q=80"
                        alt="Library" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Lorem ipsum</h3>
                        <p class="text-sm">Lorem ipsum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary/90 text-white pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div
                            class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-display font-bold">CENTAR ZA OBRAZOVANJE</h3>
                    </div>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-dark hover:bg-accent hover:text-black flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-dark/90 hover:bg-accent hover:text-black flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-dark/90 hover:bg-accent hover:text-black flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-dark/90 hover:bg-accent hover:text-black flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a></li>
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a></li>
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a></li>
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a></li>
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a></li>
                        <li><a href="#" class="hover:text-secondary transition-colors">Lorem ipsum</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-secondary mt-1 mr-3"></i>
                            <span>Knez Mihailova 56, 11000 Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-secondary mt-1 mr-3"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-secondary mt-1 mr-3"></i>
                            <span>info@example.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-secondary mt-1 mr-3"></i>
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
                <p>&copy; 2023 Centar za obrazovanje. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d3b66',
                        secondary: '#f4d35e',
                        accent: '#faf0ca',
                        dark: '#333',
                        light: '#E8F3FC',
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
                        sage: '#9CAF88',
                        barn_red: '#770D0D'
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

        let currentSize = 16; // initial font size in px
        let step = 2; // px to increase or decrease per click
        let maxSteps = 3; // max increments before toggling direction
        let count = 0; // how many increments or decrements done
        let increasing = true; // track if currently increasing font size

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
        document.getElementById('searchButton').addEventListener('click', function() {
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

        document.getElementById('closeSearch').addEventListener('click', function() {
            const container = document.getElementById('searchInputContainer');
            container.classList.add('opacity-0');
            setTimeout(() => {
                container.classList.add('hidden');
            }, 300);
        });

        document.addEventListener('click', function(e) {
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
        window.addEventListener('scroll', function() {
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
            hamburger.addEventListener('click', function(e) {
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
            mobileAboutToggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleMobileAbout();
            });
        }

        // Close menu when clicking on menu links (except dropdown toggle)
        const menuLinks = document.querySelectorAll('#mobileMenu nav a:not(#mobileAboutToggle)');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Close menu after a short delay to allow for navigation
                setTimeout(closeMobileMenuFunc, 150);
            });
        });

        // Close menu on window resize if screen becomes large
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Handle escape key to close menu
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Prevent menu panel clicks from closing the menu
        if (mobileMenuPanel) {
            mobileMenuPanel.addEventListener('click', function(e) {
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
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.event-card, .gallery-item, .section-divider').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>