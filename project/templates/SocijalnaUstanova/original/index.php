<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centar za socijalni rad</title>
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

        .mobile-dropdown>div:last-child {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        .mobile-dropdown.active>div:last-child {
            max-height: 500px;
        }

        .mobile-dropdown.active .mobile-dropdown-chevron {
            transform: rotate(180deg);
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

        @layer utilities {
            .text-shadow {
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            }

            .text-shadow-strong {
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            }

            .text-shadow-medium {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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

            /* Remove underline from dropdown buttons */
            button.nav-link::after {
                display: none;
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
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-white font-display font-bold text-slate">Menu</h2>
                    <button id="closeMobileMenu" class="text-slate hover:text-terracotta transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <!-- O nama dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-blue-600"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
                        </button>
                        <div>
                            <a data-page="Sluzbe" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-user-md mr-2 text-orange-600"></i>Službe
                            </a>
                            <a data-page="OrganiUpravljanja" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-blue-600"></i>Organi upravljanja
                            </a>
                            <a data-page="OrganizacionaStruktura" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-sitemap mr-2 text-orange-600"></i>Organizaciona struktura
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-history mr-2 text-brown"></i>Istorijat
                            </a>
                        </div>
                    </div>
                    <a data-page="Vesti" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-primary hover:bg-background rounded-lg transition-all">
                        <i class="fas fa-newspaper mr-3 text-accent_indigo"></i>Vesti
                    </a>
                    <a data-page="Usluge" href="#"
                        class="flex items-center py-2 px-4 text-sm text-slate hover:text-primary transition-colors">
                        <i class="fas fa-concierge-bell mr-2 text-success"></i>Usluge Centra Most
                    </a>
                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-primary hover:bg-background rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-warning"></i>Dokumenti
                    </a>
                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-primary hover:bg-background rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Sigurna kuća
                    </a>
                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-primary hover:bg-background rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-accent_teal"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-info hover:bg-info_hover text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-info_ring transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
    <header
        class="fixed w-full z-50 transition-all duration-300 py-3 sm:py-4 backdrop-blur-md shadow-sm bg-background">
        <div class="container mx-auto px-3 sm:px-4 lg:px-6 flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-2 sm:space-x-3 flex-shrink-0">
                <a href="/" class="flex items-center flex-shrink-0">
                    <img
                        src="putanja-do-logo.png"
                        alt="Logo"
                        class="h-11 w-auto object-contain" />
                </a>
                <div class="hidden sm:block">
                    <a href="/#"
                        class="text-base sm:text-lg lg:text-xl xl:text-2xl font-display text-slate font-bold tracking-wider leading-tight">
                        Centar za pružanje usluga socijalne <br>
                        zaštite Grada Zrenjanina Most</a>
                </div>
                <div class="block sm:hidden">
                    <h1 class="text-base font-display text-slate font-bold tracking-wide">CSR</h1>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex items-center space-x-0.5 xl:space-x-1">
                <div class="dropdown relative group">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                        <i
                            class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">O nama</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-border_light transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-background hover:to-background_gray text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-user-md mr-3 text-accent_orange flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Službe</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-background hover:to-background_gray text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-users-cog mr-3 text-info flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Organi upravljanja</span>
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-background hover:to-background_gray text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-sitemap mr-3 text-accent_orange flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Organizaciona struktura</span>
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-background hover:to-background_gray text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-history mr-3 text-brown flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Istorijat</span>
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                    <i
                        class="fas fa-newspaper mr-2 text-accent_indigo group-hover:text-accent_indigo_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Vesti</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                    <i class="fas fa-hands-helping mr-2 text-success hover:text-primary transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Usluge Centra Most</span>
                </a>
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                    <i
                        class="fas fa-folder-open mr-2 text-warning group-hover:text-warning_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Dokumenti</span>
                </a>
                <a href="#" static="true"
                    class="nav-link text-slate font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                    <i
                        class="fas fa-home mr-2 text-primary group-hover:text-warning_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Sigurna kuća</span>
                </a>
                <a href="#" static="true"
                    class="nav-link text-slate font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                    <i
                        class="fas fa-address-book mr-2 text-accent_teal group-hover:text-accent_teal_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Kontakt</span>
                </a>

                <a href="#" class="hidden">
                    Ankete
                </a>

                <?php
                if (isset($_GET['locale'])) {
                    $_SESSION['locale'] = $_GET['locale'];
                }
                $locale = $_SESSION['locale'] ?? 'sr';

                $languages = [
                    'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>']
                ];

                if (!isset($languages[$locale])) {
                    $locale = 'sr';
                }
                ?>
                <div class="locale dropdown nonPage relative group ">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-background group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0 min-w-max bg-surface rounded-xl shadow-2xl border border-border_light z-50 py-2 backdrop-blur-sm">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>" class="locale-link dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-background hover:to-background_gray text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>

            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-1 sm:space-x-3">
                <!-- Search Container -->
                <div class="relative">
                    <button id="searchButton"
                        class="text-text_secondary hover:text-terracotta transition-all duration-200 focus:outline-none p-2 sm:p-2.5 rounded-full hover:bg-background"
                        aria-label="Search">
                        <i class="fas fa-search text-sm sm:text-base"></i>
                    </button>
                    <!-- Enhanced Search Input -->
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-surface rounded-xl shadow-2xl border border-border_medium overflow-hidden backdrop-blur-sm">
                        <form id="searchForm" class="flex items-center w-full p-2" action="/search" method="GET">
                            <input type="text" name="q" placeholder="Pretražite sadržaj..."
                                class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-4 py-2.5 text-text_gray_dark placeholder-text_gray_medium bg-background_gray rounded-lg"
                                id="searchInput" required />
                            <div class="flex items-center space-x-1 ml-2">
                                <button type="submit"
                                    class="text-text_secondary hover:text-terracotta transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-background_hover w-9 h-9 flex items-center justify-center"
                                    aria-label="Submit search">
                                    <i class="fas fa-search text-sm"></i>
                                </button>
                                <button type="button"
                                    class="text-text_secondary hover:text-primary transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-background_hover w-9 h-9 flex items-center justify-center"
                                    id="closeSearch" aria-label="Close search">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Enhanced Mobile Menu Button -->
                <button id="hamburger"
                    class="hamburger lg:hidden text-slate w-9 h-9 sm:w-10 sm:h-10 flex flex-col justify-center items-center space-y-1 p-2 rounded-lg hover:bg-background transition-all duration-200">
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>




    <!-- Hero Section -->
    <section class="slider-item hero relative flex items-center z-10 w-full h-[600px] overflow-hidden">
        <?php
        $slike = [
            '/assets/img/homepage-1.png',
            '/assets/img/homepage-2.png',
            '/assets/img/homepage-3.png',
        ];

        $izabrana = rand(0, count($slike) - 1);
        ?>
        <img id="g-slider-image-1" src="<?php echo $slike[$izabrana]; ?>" alt="Pozadinska slika za slider"
            class="absolute inset-0 w-full h-full object-cover z-10">

        <div class="overlay-blur-none absolute inset-0 z-20 backdrop-blur-sm-none bg-[rgba(42,157,143,0.1)]">
        </div>

        <div class="max-w-6xl mx-auto px-4 py-20 text-center relative z-30 text-white w-full">
            <div class="mb-8">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold leading-tight mb-6" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.6);">
                    Dobro došli u Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most
                </h1>
            </div>
        </div>
    </section>

    <!-- Featured News Section -->
    <section id="vesti" class="py-20 bg-gradient-to-br from-success_lightest to-info_light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Najnovije vesti
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary_light to-info_bg"></span>
                </h2>
            </div>

            <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- News 1 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://picsum.photos/600/300?random=10"
                            alt="Važna obaveštenje" class="w-full h-full object-cover">

                    </div>
                    <div class="p-6">
                        <h3 id="g-naslov" class="text-xl font-display font-bold text-slate mb-2">Nova usluga Centra za socijalni rad
                        </h3>

                        <p id="g-opis" class="text-text_secondary mb-4 line-clamp-1">Centar za socijalni rad proširuje ponudu usluga novim programom podrške porodicama.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-text_secondary">
                                    <i class="fas fa-calendar-days mr-2"></i>
                                    <span id="g-datum">15. novembar 2024.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News 2 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/300?random=11"
                            alt="Uspešan projekat" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-success_bg text-white px-3 py-1 rounded-full text-sm font-bold">
                            12 NOV
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Uspešno završen projekat podrške mladima</h3>
                        <p class="text-text_secondary mb-4">Program podrške mladima u riziku uspešno je završen uz učešće preko 50 korisnika naših usluga.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-text_secondary">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Autor: CSR Tim</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News 3 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/300?random=12"
                            alt="Saradnja sa institucijama" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-accent_orange_bg text-white px-3 py-1 rounded-full text-sm font-bold">
                            8 NOV
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Nova saradnja sa lokalnim organizacijama</h3>
                        <p class="text-text_secondary mb-4">Potpisani su sporazumi o saradnji sa pet lokalnih nevladinih organizacija za unapređenje socijalne zaštite.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-text_secondary">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Autor: Direkcija</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/vesti" id="vestiView"
                    class="bg-gradient-to-r from-info to-primary text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all inline-flex items-center shadow-lg">
                    <i class="fas fa-newspaper mr-3"></i>
                    Pogledaj sve vesti
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="sluzbe" class="py-20 bg-gradient-to-br from-success_lightest to-info_light">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Službe
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-info_bg to-success_bg"></span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Service 1 -->
                <div class="group">
                    <button class="w-full bg-surface hover:bg-accent_orange_light border border-border_medium hover:border-accent_orange_border rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-accent_orange_light group-hover:bg-accent_orange_border rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-home text-accent_orange text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-text_primary mb-2">Služba smeštaja</h3>
                    </button>
                </div>
                <!-- Service 2 -->
                <div class="group">
                    <button class="w-full bg-surface hover:bg-accent_purple_light border border-border_medium hover:border-accent_purple_border rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-accent_purple_light group-hover:bg-accent_purple_border rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-user-friends text-accent_purple text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-text_primary mb-2">Služba dnevnih usluga u zajednici</h3>
                    </button>
                </div>

                <!-- Service 3 -->
                <div class="group">
                    <button class="w-full bg-surface hover:bg-accent_pink_light border border-border_medium hover:border-accent_pink_hover rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-accent_pink_light group-hover:bg-accent_pink_hover rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-heart text-accent_pink text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-text_primary mb-2">Služba za osamostaljivanje i podršku</h3>
                    </button>
                </div>

                <!-- Service 4 -->
                <div class="group">
                    <button class="w-full bg-surface hover:bg-warning_light border border-border_medium hover:border-warning rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-warning_light group-hover:bg-warning_hover rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-coins text-warning text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-text_primary mb-2">Služba za pravne i finansijsko-administrativne poslove</h3>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <a data-page="Sluzbe" href="/o-nama/sluzbe" class="bg-gradient-to-r from-info to-success text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all inline-flex items-center shadow-lg">
                    <i class="fas fa-hands-helping mr-3"></i>
                    Saznaj više o našim službama
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate text-white pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center text-white mr-3">
                            <i class="fas fa-heart text-xl"></i>
                        </div>
                        <h3 class="text-xl font-display font-bold">CENTAR ZA SOCIJALNI RAD</h3>
                    </div>
                    <p class="text-white/80 mb-4">
                        Pružamo podršku i pomoć pojedincima, porodicama i zajednici u rešavanju životnih poteškoća.
                    </p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/centar.most.zr/"
                            class="w-10 h-10 rounded-full bg-primary/30 hover:bg-primary flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="text-lg font-display font-bold mb-6 text-center">Kontakt informacije</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary_lighter mt-1 mr-3"></i>
                            <span>Bulevar oslobođenja 26, 21000 Novi Sad</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-primary_lighter mt-1 mr-3"></i>
                            <span>+381 21 123 456</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-primary_lighter mt-1 mr-3"></i>
                            <span data-translate="off">info@csr-novisad.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-primary_lighter mt-1 mr-3"></i>
                            <span>
                                Ponedeljak - Petak: 07:00 - 15:00<br>
                            </span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-person text-primary_lighter mt-1 mr-3"></i>
                            <span>
                                Osoba zadužena za slobodan pristup informacijama od javnog značaja
                                <br>
                                <p data-translate="off">nevena.montresor@centarmostzr.com</p>
                                <br>
                                023 608 240
                            </span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-person text-primary_lighter mt-1 mr-3"></i>
                            <span>
                                Osoba zadužena za zaštitu podataka o ličnosti
                                <br>
                                <p data-translate="off">zastita.podataka@centarmostzr.com</p>
                                <br>
                                023 608 240
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Lokacija</h4>
                    <div class="bg-white/10 rounded-xl overflow-hidden" style="aspect-ratio:16 / 9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d19.8451920155352!3d45.25407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sBulevar%20oslobo%C4%91enja%2026%2C%20Novi%20Sad!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="border-t border-border_dark pt-8 text-center text-white/60 text-sm">
                <p>&copy; 2025 Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#dc2626',
                        'primary_hover': '#b91c1c',
                        'secondary': '#2563eb',
                        'secondary_hover': '#1d4ed8',
                        'accent': '#16a34a',
                        'accent_hover': '#15803d',
                        'primary_text': '#334155',
                        'secondary_text': '#64748b',
                        'background': '#f8fafc',
                        'secondary_background': '#f9fafb',
                        'surface': '#ffffff',
                        'primary_light': '#ef4444',
                        'primary_medium': '#dc2626',
                        'primary_lighter': '#f87171',
                        'primary_lightest': '#fef2f2',
                        'primary_hover_light': '#fecaca',
                        'primary_disabled': '#fca5a5',
                        'info': '#2563eb',
                        'info_bg': '#3b82f6',
                        'info_hover': '#1d4ed8',
                        'info_hover_light': '#bfdbfe',
                        'info_light': '#eff6ff',
                        'info_ring': '#93c5fd',
                        'info_disabled': '#93c5fd',
                        'success': '#16a34a',
                        'success_bg': '#22c55e',
                        'success_hover': '#15803d',
                        'success_hover_light': '#bbf7d0',
                        'success_light': '#dcfce7',
                        'success_lightest': '#f0fdf4',
                        'success_text': '#166534',
                        'success_border': '#86efac',
                        'warning': '#ca8a04',
                        'warning_bg': '#ca8a04',
                        'warning_light': '#fef9c3',
                        'warning_hover': '#a16207',
                        'accent_orange': '#ea580c',
                        'accent_orange_bg': '#f97316',
                        'accent_orange_hover': '#fed7aa',
                        'accent_orange_light': '#ffedd5',
                        'accent_orange_border': '#fdba74',
                        'accent_purple': '#9333ea',
                        'accent_purple_light': '#f3e8ff',
                        'accent_purple_border': '#d8b4fe',
                        'accent_pink': '#db2777',
                        'accent_pink_light': '#fce7f3',
                        'accent_pink_hover': '#fbcfe8',
                        'accent_indigo': '#4338ca',
                        'accent_indigo_light': '#e0e7ff',
                        'accent_indigo_hover': '#c7d2fe',
                        'accent_teal': '#0d9488',
                        'accent_teal_hover': '#0f766e',
                        'accent_teal_light': '#ccfbf1',
                        'accent_teal_lightest': '#99f6e4',
                        'text_primary': '#334155',
                        'text_secondary': '#64748b',
                        'text_tertiary': '#475569',
                        'text_gray_dark': '#374151',
                        'text_gray_medium': '#6b7280',
                        'background_gray': '#f9fafb',
                        'background_hover': '#f3f4f6',
                        'border_light': '#f3f4f6',
                        'border_medium': '#e5e7eb',
                        'border_dark': '#334155',
                        'white': '#ffffff',
                        'black': '#000000',
                        'slate': '#2F4F4F',
                        'clay': '#c97c5d',
                        'ochre': '#d4a373',
                        'sage': '#a3b18a',
                        'paper': '#f5ebe0',
                        'terracotta': '#bc6c25',
                        'coral': '#e76f51',
                        'deep-teal': '#2a9d8f',
                        'crimson': '#8d1b3d',
                        'royal-blue': '#1a4480',
                        'velvet': '#4a154b',
                    },
                    fontFamily: {
                        'heading': ['Playfair Display', 'serif'],
                        'heading2': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                        'display': ['Playfair Display', 'serif'],
                        'crimson': ['Crimson Pro', 'serif'],
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

        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown button');

        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
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

        // Close menu when clicking on menu links (except dropdown buttons)
        const menuLinks = document.querySelectorAll('#mobileMenu nav a');
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

        // Ensure language links always trigger full page reload
        document.querySelectorAll('.locale-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Allow default behavior (full page reload)
                // This ensures the PHP session gets the new locale value
                return true;
            });
        });
    </script>
</body>

</html>