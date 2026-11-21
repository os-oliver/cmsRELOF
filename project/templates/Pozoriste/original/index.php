<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorem ipsum dolor</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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

            .hero-gradient {
                background: linear-gradient(to bottom,
                        rgb(247, 241, 237) 0%,
                        rgb(239, 178, 178) 50%,
                        rgba(255, 255, 255, 0.96) 100%);
                text-align: left;
                padding-top: 8rem;
                padding-bottom: 6rem;
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

            .repertoar-card {
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .repertoar-card::before {
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

            .repertoar-card:hover::before {
                transform: translateY(0);
            }

            .repertoar-card:hover {
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


<body class="font-body text-secondary_text min-h-screen overflow-x-hidden">
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6 text-secondary_text hover:text-primary_text">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-white text-primary_text">Menu</h2>
                    <button id="closeMobileMenu" class="text-primary_text transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>
                    <div class="mobile-dropdown">

                        <button class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-primary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down  transition-transform duration-200" id="mobileAboutIcon"></i>
                        </button>

                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-history mr-2 text-primary"></i>Istorijat
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Organi Upravljanja
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-question mr-2 text-primary"></i>Pitanja
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije
                            </a>
                        </div>

                    </div>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-users mr-3 text-primary"></i>Ansambl
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-theater-masks mr-3 text-primary"></i>Predstave
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Repertoar
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-newspaper mr-3 text-primary"></i>Vesti
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-primary"></i>Dokumenti
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-primary"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-secondary hover:bg-secondary_hover text-background py-3 px-5 rounded-full shadow-lg transition-colors"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm bg-background">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo Section -->
            <a href="/" class="flex items-center pr-4 flex-shrink-0">
                <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                    <img src="" alt="" style="width:75px;height:auto;" />
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-xl lg:text-2xl font-heading text-primary font-bold tracking-wider">Regionalno pozorište</h1>
                    <p class="text-xs text-barn_red tracking-widest hidden md:block">Novi Pazar</p>
                </div>
                <div class="block sm:hidden">
                    <h1 class="text-lg font-heading text-primary font-bold">RPNP</h1>
                </div>
            </a>


            <!-- Desktop Navigation -->
            <nav id="navBarID"
                class="hidden lg:flex space-x-4 xl:space-x-8 font-body text-secondary_text hover:text-primary_text">
                <a href="#" class="hover:text-primary_hover transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-home mr-2 text-primary transition-colors"></i>
                    <span class="hidden xl:inline">Početna</span>
                </a>
                <div class="dropdown relative group transition-colors">
                    <button class="nav-link transition-colors flex items-center px-3 py-2 whitespace-nowrap">
                        <i class="fas fa-info-circle mr-2 text-primary"></i>
                        <span class="hidden xl:inline">O nama</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-flag mr-2 text-primary"></i>Misija
                        </a>
                        <a static="true" href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-history mr-2 text-primary"></i>Istorijat
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-users-cog mr-2 text-primary"></i>Organi Upravljanja
                        </a>

                        <a data-page="#" href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-question mr-2 text-primary"></i>Pitanja
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-bullhorn  mr-2 text-primary"></i>Informacije
                        </a>

                    </div>
                </div>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-users mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Ansambl</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-theater-masks mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Predstave</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Repertoar</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-newspaper mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Vesti</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-images mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Galerija</span>
                </a>
                <a href="#" class="nav-link transition-colors group flex items-center whitespace-nowrap">
                    <i class="fas fa-folder-open mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Dokumenti</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-address-book mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Kontakt</span>
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
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0  min-w-max bg-paper rounded-xl shadow-2xl border border-gray-100 z-50 py-2 backdrop-blur-sm">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                                class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>
            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <div class="relative">
                    <button id="searchButton"
                        class="text-secondary_text hover:text-primary_text transition-colors focus:outline-none p-2"
                        aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-2 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden">
                        <form id="searchForm" class="flex items-center w-full p-1.5" action="/pretraga" method="GET">
                            <input type="text" name="q" placeholder="Search..."
                                class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-1.5 placeholder-gray-400"
                                id="searchInput" required />
                            <div class="flex items-center space-x-1 ml-2">
                                <button type="submit"
                                    class="transition-colors focus:outline-none p-1.5 rounded-full w-8 h-8 flex items-center justify-center"
                                    aria-label="Submit search">
                                    <i class="fas fa-search text-sm"></i>
                                </button>
                                <button type="button"
                                    class="transition-colors focus:outline-none p-1.5 rounded-full w-8 h-8 flex items-center justify-center"
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
                    class="hamburger lg:hidden text-primary_text w-8 h-8 flex flex-col justify-center space-y-1 p-1">
                    <span class="block w-6 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-6 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-6 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>


    <!-- Enhanced Hero Section -->
    <section class="hero relative flex items-center z-10 w-full min-h-[600px] h-[85vh] overflow-hidden text-white">

        <!-- Background image: keep as a direct img element for CMS editing -->
        <img
            src="https://picsum.photos/1600/900"
            alt="Pozadinska slika aktuelne pozorišne predstave"
            class="absolute inset-0 w-full h-full object-cover object-center z-10">

        <!-- Dark gradient overlay -->
        <div class="absolute inset-0 z-20 bg-gradient-to-r from-black/85 via-black/50 to-black/10 pointer-events-none"></div>
        <div class="absolute inset-0 z-20 bg-gradient-to-t from-black/40 via-transparent to-black/20 pointer-events-none"></div>

        <!-- Hero content -->
        <div class="container max-w-full mx-10 px-4 py-24 relative z-30 w-full">

            <div class="max-w-2xl text-left">

                <span class="inline-block text-sm tracking-[0.25em] uppercase mb-6 text-white/80">
                    Na repertoaru
                </span>

                <h1 class="font-heading text-5xl md:text-6xl lg:text-7xl leading-tight mb-6">
                    KUĆA NA GRANICI
                </h1>

                <p class="text-base md:text-lg leading-relaxed text-white/85 mb-9 max-w-xl">
                    Predstava se bavi aktuelnim temama i u pitanju je teatar apsurda koji govori o apsurdima današnje svetske politike i povlačenja granica kroz priču čoveka kome se to dešava u sopstvenoj kući
                </p>

                <div class="flex flex-wrap items-center gap-4">

                    <a
                        href="/predstave"
                        class="inline-flex items-center px-7 py-4 rounded-full
                           bg-primary text-white
                           hover:bg-primary_hover transition-colors">
                        Pogledajte predstave
                    </a>

                    <a
                        href="/repertoar"
                        class="inline-flex items-center text-white font-semibold hover:text-white/70 transition-colors px-7 py-4 rounded-full border border-white/20  hover:bg-white/10">
                        Celokupan repertoar
                    </a>

                </div>

            </div>

        </div>
    </section>



    <!-- Repertoar -->
    <section id="repertoar" class="pt-20 text-secondary_text bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 font-body">
                <h2 class="text-4xl font-heading mb-4 relative inline-block text-primary_text">
                    Sledeće na repertoaru
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto mt-4">
                    Pogledajte trenutni repertoar našeg pozorišta
                </p>
            </div>

            <div id="repertoarCards" class="flex justify-center gap-8 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                <!-- repertoar card 1 -->
                <div class="repertoar-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container with Genre Badge -->
                    <div class="w-full aspect-[4/5] relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika predstave"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" />
                        <!-- Category moved to a clean badge over the image -->
                        <span id="g-naziv" class="absolute top-3 left-3 bg-surface/90 backdrop-blur-sm text-background text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                            Komedija
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <!-- Date & Time with subtle icons -->
                        <div class="flex items-center text-primary_text/75 text-xs font-medium mb-2.5">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum">17/11/2026</span>
                            <span class="mx-2 opacity-40">•</span>
                            <svg class="w-3.5 h-3.5 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="g-vreme">20:00</span>
                        </div>

                        <!-- Performance Title -->
                        <h3 id="g-naslov" class="text-xl font-bold text-primary_text leading-snug mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                            Lorem ipsum dolor sit amet
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- repertoar card 2 -->
                <div class="repertoar-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container with Genre Badge -->
                    <div class="w-full aspect-[4/5] relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika predstave"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" />
                        <!-- Category moved to a clean badge over the image -->
                        <span id="g-naziv" class="absolute top-3 left-3 bg-surface/90 backdrop-blur-sm text-background text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                            Komedija
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <!-- Date & Time with subtle icons -->
                        <div class="flex items-center text-primary_text/75 text-xs font-medium mb-2.5">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum">17/11/2026</span>
                            <span class="mx-2 opacity-40">•</span>
                            <svg class="w-3.5 h-3.5 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="g-vreme">20:00</span>
                        </div>

                        <!-- Performance Title -->
                        <h3 id="g-naslov" class="text-xl font-bold text-primary_text leading-snug mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                            Lorem ipsum dolor sit amet
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- repertoar card 3 -->
                <div class="repertoar-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container with Genre Badge -->
                    <div class="w-full aspect-[4/5] relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika predstave"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" />
                        <!-- Category moved to a clean badge over the image -->
                        <span id="g-naziv" class="absolute top-3 left-3 bg-surface/90 backdrop-blur-sm text-background text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                            Komedija
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <!-- Date & Time with subtle icons -->
                        <div class="flex items-center text-primary_text/75 text-xs font-medium mb-2.5">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum">17/11/2026</span>
                            <span class="mx-2 opacity-40">•</span>
                            <svg class="w-3.5 h-3.5 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="g-vreme">20:00</span>
                        </div>

                        <!-- Performance Title -->
                        <h3 id="g-naslov" class="text-xl font-bold text-primary_text leading-snug mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                            Lorem ipsum dolor sit amet
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- repertoar card 4 -->
                <div class="repertoar-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container with Genre Badge -->
                    <div class="w-full aspect-[4/5] relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika predstave"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500" />
                        <!-- Category moved to a clean badge over the image -->
                        <span id="g-naziv" class="absolute top-3 left-3 bg-surface/90 backdrop-blur-sm text-background text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                            Komedija
                        </span>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <!-- Date & Time with subtle icons -->
                        <div class="flex items-center text-primary_text/75 text-xs font-medium mb-2.5">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum">17/11/2026</span>
                            <span class="mx-2 opacity-40">•</span>
                            <svg class="w-3.5 h-3.5 mr-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="g-vreme">20:00</span>
                        </div>

                        <!-- Performance Title -->
                        <h3 id="g-naslov" class="text-xl font-bold text-primary_text leading-snug mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                            Lorem ipsum dolor sit amet
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="/repertoar" id="repertoarView"
                    class="bg-primary text-background px-8 py-4 text-lg rounded-full hover:bg-primary_hover transition-colors flex items-center shadow-lg mx-auto w-fit">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Ceo repertoar
                </a>
            </div>

        </div>
    </section>


    <!-- Vesti -->
    <section id="vesti" class="py-20 text-secondary_text bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 font-body">
                <h2 class="text-4xl font-heading mb-4 relative inline-block text-primary_text">
                    Vesti
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto mt-4">
                    Pogledajte aktuelne vesti našeg pozorišta
                </p>
            </div>

            <div id="vestiCards" class="flex justify-center gap-8 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">

                <!-- vest 1 -->
                <div class="news-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container -->
                    <div class="h-48 relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika vesti"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">

                        <!-- Date Row -->
                        <div class="flex items-center mb-3">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum" class="text-primary_text/70 text-xs font-medium whitespace-nowrap">
                                15. Decembar 2024
                            </span>
                        </div>

                        <!-- News Headline -->
                        <h3 id="g-naslov" class="text-lg font-bold text-primary_text leading-snug mb-5 line-clamp-3 group-hover:text-primary transition-colors">
                            Naslov vesti
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- vest 2 -->
                <div class="news-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container -->
                    <div class="h-48 relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika vesti"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">

                        <!-- Date Row -->
                        <div class="flex items-center mb-3">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum" class="text-primary_text/70 text-xs font-medium whitespace-nowrap">
                                15. Decembar 2024
                            </span>
                        </div>

                        <!-- News Headline -->
                        <h3 id="g-naslov" class="text-lg font-bold text-primary_text leading-snug mb-5 line-clamp-3 group-hover:text-primary transition-colors">
                            Naslov vesti
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- vest 3 -->
                <div class="news-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container -->
                    <div class="h-48 relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika vesti"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">

                        <!-- Date Row -->
                        <div class="flex items-center mb-3">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum" class="text-primary_text/70 text-xs font-medium whitespace-nowrap">
                                15. Decembar 2024
                            </span>
                        </div>

                        <!-- News Headline -->
                        <h3 id="g-naslov" class="text-lg font-bold text-primary_text leading-snug mb-5 line-clamp-3 group-hover:text-primary transition-colors">
                            Naslov vesti
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="news-card group bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex-shrink-0 w-80 flex flex-col border border-black/5">

                    <!-- Image Container -->
                    <div class="h-48 relative overflow-hidden">
                        <img
                            id="g-slika"
                            src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80"
                            alt="Slika vesti"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">

                        <!-- Date Row -->
                        <div class="flex items-center mb-3">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="g-datum" class="text-primary_text/70 text-xs font-medium whitespace-nowrap">
                                15. Decembar 2024
                            </span>
                        </div>

                        <!-- News Headline -->
                        <h3 id="g-naslov" class="text-lg font-bold text-primary_text leading-snug mb-5 line-clamp-3 group-hover:text-primary transition-colors">
                            Naslov vesti
                        </h3>

                        <!-- Bottom Action Link (pinned to bottom) -->
                        <div class="mt-auto pt-3 border-t border-black/5">
                            <a id="g-ovise" href="#" class="inline-flex items-center text-sm text-primary font-semibold hover:text-accent transition-colors">
                                Saznajte više
                                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="/vesti" id="eventsView"
                    class="bg-primary text-background px-8 py-4 text-lg rounded-full hover:bg-primary_hover transition-colors flex items-center shadow-lg mx-auto w-fit">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Sve vesti
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-surface text-secondary_text font-body pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                            <img src="" alt="" style="width:75px;height:auto;" />
                        </div>
                        <h3 class="text-xl font-heading font-bold">Regionalno pozorište <br>Novi Pazar</h3>
                    </div>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/RegionalnoPozoristeNoviPazar/"
                            class="w-10 h-10 rounded-full bg-accent hover:bg-accent_hover flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/regionalnopozoriste"
                            class="w-10 h-10 rounded-full bg-accent hover:bg-accent_hover flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@regpoznp"
                            class="w-10 h-10 rounded-full bg-accent hover:bg-accent_hover flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="https://www.kcnovipazar.rs/" class="hover:text-primary_text transition-colors">Kulturni centar Novi Pazar</a></li>
                        <li><a href="/predstave" class="hover:text-primary_text transition-colors">Predstave</a></li>
                        <li><a href="/repertoar" class="hover:text-primary_text transition-colors">Repertoar</a></li>

                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
                            <span>Stevana Nemanje 2, Novi Pazar, Srbija, 36300</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-accent mt-1 mr-3"></i>
                            <span>+381 64 0919293</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-accent mt-1 mr-3"></i>
                            <span data-translate="off">regionalnopozoristenp@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-accent mt-1 mr-3"></i>
                            <span>
                                Radno vreme:<br>
                                Ponedeljak - Petak: 08:00 - 15:00<br>
                            </span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Mapa lokacije</h4>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1029.288703283759!2d20.51835539739654!3d43.140899429970595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47562812ee381053%3A0x492685d7fb12acf9!2sStevana%20Nemanje%202%2C%20Novi%20Pazar%2036300!5e0!3m2!1sen!2srs!4v1794926906574!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex flex-col items-center space-y-4 text-center">
                <div class="w-full border-t-2 border-primary"></div>
                <img src="/assets/img/SECO-logo-640px.png" alt="SECO logo" class="max-h-24 w-auto object-contain mt-4">
                <p class="text-xs md:text-sm text-primary_text max-w-5xl">
                    Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno zvanični stav Vlade Švajcarske.
                </p>
            </div>
        </div>
    </footer>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B1E3F', // velvet burgundy
                        primary_hover: '#701932',

                        secondary: '#292124', // theater charcoal
                        secondary_hover: '#1E181B',

                        accent: '#C5A46D', // antique gold
                        accent_hover: '#AD8B55',

                        primary_text: '#292124', // warm charcoal
                        secondary_text: '#68595A', // warm taupe

                        background: '#F7F2EA', // warm ivory
                        secondary_background: '#EAE0D4', // champagne beige

                        surface: '#8B1E3F1A', // translucent burgundy
                    },
                    fontFamily: {
                        heading: ['"Bodoni Moda"', 'serif'], // headings (classic & dramatic)
                        body: ['Inter', 'sans-serif']
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

        document.querySelectorAll('.repertoar-card, .gallery-item, .section-divider').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>