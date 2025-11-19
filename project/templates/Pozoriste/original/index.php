<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narodno pozorište Pirot</title>
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
                                <i class="fas fa-flag mr-2 text-primary"></i>Istorijat
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                            </a>
                            <a static="true" href="#"
                                class="hidden">
                                Bon ton
                            </a>
                            <a static="true" href="#"
                                class="hidden">
                                Rezervacija karata
                            </a>
                            <a static="true" href="#"
                                class="hidden">
                                Scena
                            </a>
                        </div>

                    </div>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Ansambl
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-primary"></i>Predstave
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-primary"></i>Repertoar
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Vesti
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
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-question mr-3 text-primary"></i>Pitanja
                    </a>
                    <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Informacije
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

    <header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm ">
        <div class="container mx-auto px-4 flex justify-between items-center">


            <!-- Logo Section -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div
                    class="w-13 h-13 bg-gradient-to-br from-[#CC8B3C] via-[#C85A3E] to-[#E07856] rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <img src="" alt="" style="width:75px;height:auto;" />
                </div>

                <div class="hidden sm:block font-body text-primary_text mr-2">
                    <h1 class="text-xl lg:text-2xl tracking-wider">Narodno pozorište</h1>
                    <p class="text-l tracking-widest hidden md:block">Pirot</p>
                </div>
                <div class="block sm:hidden">
                    <h1 class="text-lg text-primary_text">Narodno pozorište</h1>
                </div>
            </div>


            <!-- Desktop Navigation -->
            <nav id="navBarID"
                class="hidden lg:flex space-x-4 xl:space-x-8 font-body text-secondary_text hover:text-primary_text ml-5">
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-home mr-2 text-primary transition-colors"></i>
                    <span class="hidden xl:inline">Početna</span>
                </a>
                <div class="dropdown relative group transition-colors">
                    <button class="nav-link transition-colors flex items-center whitespace-nowrap mt-1">
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
                            <i class="fas fa-flag mr-2 text-primary"></i>Istorijat
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                        </a>

                        <a data-page="OrganizacionaStruktura" href="#"
                            class="flex items-center py-2 px-4 text-sm transition-colors">
                            <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-question mr-2 text-primary"></i>Pitanja
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-flag mr-2 text-primary"></i>Informacije
                        </a>
                        <a static="true" href="#"
                            class="hidden">
                            Bon ton
                        </a>
                        <a static="true" href="#"
                            class="hidden">
                            Rezervacija karata
                        </a>
                        <a static="true" href="#"
                            class="hidden">
                            Scena
                        </a>
                    </div>
                </div>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Ansambl</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Predstave</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Repertoar</span>
                </a>
                <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>
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
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient text-secondary_text">
        <div class="container max-w-full mx-10 px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
                <div>
                    <div class="mb-8 text-left">
                        <h1 class="text-5xl md:text-6xl leading-tight mb-8">
                            <span class="block font-heading text-primary_text">Dobrodošli u</span>
                            <span class="block mt-2 text-secondary_text font-body">Narodno pozorište Pirot</span>
                        </h1>
                        <p class="mb-10">
                            U srcu Pirota, naše pozorište već decenijama čuva duh zajedništva i ljubavi prema umetnosti.
                            Publika nam je porodica, a svaka predstava novo putovanje kroz smeh, suze i emocije.
                            Naš repertoar je pažljivo biran za sve generacije.
                            Zakoračite u svet gde se susreću tradicija i savremena scena.
                        </p>
                        <a href="/repertoar"
                            class="bg-primary text-background px-6 py-4 rounded-full text-lg hover:bg-primary_hover transition-colors w-fit">
                            Pogledajte repertoar
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex justify-center">
                    <img class="dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/girl-shopping-list.svg"
                        alt="shopping illustration" />
                </div>
            </div>
        </div>
    </section>

    <!-- Repertoar -->
    <section id="repertoar" class="py-20 text-secondary_text">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 font-body">
                <h2 class="text-4xl font-heading mb-4 relative inline-block text-primary_text">
                    Naš Repertoar
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto mt-4">
                    Pogledajte trenutni repertoar našeg pozorišta
                </p>
            </div>

            <div id="repertoarCards" class="flex gap-8 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                <!-- repertoar card 1 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-datumVreme" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>
                        <h3 id="g-nazivPredstave" class="text-xl mb-4">Naslov predstave</h3>
                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija predstave</h2>
                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- repertoar card 2 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-datumVreme" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>
                        <h3 id="g-nazivPredstave" class="text-xl mb-4">Naslov predstave</h3>
                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija predstave</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- repertoar card 3 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-datumVreme" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>
                        <h3 id="g-nazivPredstave" class="text-xl mb-4">Naslov predstave</h3>
                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija predstave</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- repertoar card 4 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-datumVreme" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>
                        <h3 id="g-nazivPredstave" class="text-xl mb-4">Naslov predstave</h3>
                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija predstave</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="/repertoar" id="repertoarView"
                    class="bg-primary text-background px-8 py-4 text-lg rounded-full hover:bg-primary_hover transition-colors flex items-center shadow-lg mx-auto w-fit">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sav repertoar
                </a>
            </div>

        </div>
    </section>


    <!-- Vesti -->
    <section id="vesti" class="py-20 text-secondary_text">
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

            <div id="vestiCards" class="flex gap-8 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">

                <!-- vest 1 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">

                        <div class="flex items-center mb-3">
                            <span id="g-datum" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>

                        <h3 id="g-naslov" class="text-xl mb-4">Naslov vestu</h3>

                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija vesti</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- vest 2 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">

                        <div class="flex items-center mb-3">
                            <span id="g-datum" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>

                        <h3 id="g-naslov" class="text-xl mb-4">Naslov vestu</h3>

                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija vesti</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- vest 3 -->
                <div class="repertoar-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl flex-shrink-0 w-80">
                    <div class="h-48 relative">
                        <img id="g-slika" src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80" alt="shopping illustration" />
                    </div>
                    <div class="p-6">

                        <div class="flex items-center mb-3">
                            <span id="g-datum" class="text-primary_text text-sm">15. Decembar 2024</span>
                        </div>

                        <h3 id="g-naslov" class="text-xl mb-4">Naslov vestu</h3>

                        <h2 id="g-naziv" class="text-xl mb-4">Kategorija vesti</h2>

                        <a id="g-ovise" href="#" class="inline-flex items-center text-primary font-medium hover:text-accent transition">
                            Saznajte više
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </div>


            </div>

            <div class="text-center mt-12">
                <a href="/vesti" id="eventsView"
                    class="bg-primary text-background px-8 py-4 text-lg rounded-full hover:bg-primary_hover transition-colors flex items-center shadow-lg mx-auto w-fit">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve
                </a>
            </div>
        </div>
    </section>

    <!-- Prijatelji -->
    <section class="py-16 text-secondary_text">
        <div class="text-center mb-16 font-body">
            <h2 class="text-4xl font-heading mb-4 relative inline-block text-primary_text">
                Prijatelji pozorišta
                <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
            </h2>
        </div>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <?php
                $stats = [
                    ['label' => 'Opština Pirot'],
                    ['label' => 'Osnivač'],
                    ['label' => 'Samostalni sindikat TIGAR TYRES'],
                    ['label' => 'Sindikat zapošljenih u zdravstvu'],
                    ['label' => 'Opšta bolnica Pirot'],
                    ['label' => 'Sindikat Doma zdravlja'],
                    ['label' => 'Organizacija sindikata HE pirot'],
                    ['label' => 'PSSS Pirot'],
                    ['label' => 'Samostalni i nezavisni sindikat JP Komunalac'],
                    ['label' => 'ED Jugoistok DOO Niš - SOED Pirot'],
                    ['label' => 'Sindikat Telekoma "Srbija" - Pirot'],
                    ['label' => 'JP "Pošta Srbije"'],
                    ['label' => 'RJ Poštansko saobraćaja "Pirot"'],
                    ['label' => 'Nezavisni sindikat Policije'],
                ];
                foreach ($stats as $index => $stat): ?>
                    <div class="bg-surface p-6 rounded-xl shadow-lg transform transition hover:scale-105"
                        style="animation-delay: <?= $index * 0.2 ?>s">
                        <div><?= $stat['label'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-surface text-secondary_text font-body pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-logocolor2 rounded-lg flex items-center justify-center text-background mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-logocolor2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl">Narodno pozorište Pirot</h3>
                    </div>
                    <p class="mb-4">
                        Posetite nas i na društvenim mrežama
                    </p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/people/Narodno-Pozoriste-Pirot/100081268901840/"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.youtube.com/results?search_query=narodno+pozoriste+pirot"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="https://www.kultura.gov.rs/" class="text-logocolor2/90 hover:text-primary_text transition-colors">Ministarstvo kulture i informisanja RS</a></li>
                        <li><a href="https://www.pirot.rs/" class="text-logocolor2/90 hover:text-primary_text transition-colors">Grad Pirot - lokalna samouprava</a></li>
                        <li><a href="o-nama/bon-ton" class="text-logocolor2/90 hover:text-primary_text transition-colors">Pozorišni bon ton</a></li>
                        <li><a href="o-nama/rezervacija-karata" class="text-logocolor2/90 hover:text-primary_text transition-colors">Rezervacija karata - Marketing NP Pirot</a></li>
                        <li><a href="o-nama/scena" class="text-logocolor2/90 hover:text-primary_text transition-colors">Scena Narodnog pozorišta Pirot</a></li>
                        <li><a href="https://informator.poverenik.rs/informator?org=PdspbBiA5onEJPonZ" class="text-logocolor2/90 hover:text-primary_text transition-colors">Informator o radu</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-logocolor2 mt-1 mr-3"></i>
                            <span>Branka Radičevića 1, 18300 Srbija</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
                            <span>010/321 587</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
                            <span>010/322 677</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
                            <span data-translate="off">pozoristepi@open.telekom.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
                            <span data-translate="off">pozoristepi@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Mapa lokacije</h4>
                    <div class="rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2910.5676419736833!2d22.586171699999998!3d43.155607599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47553d255f8e1bb9%3A0xa818f2b55505f94f!2sNational%20Theater%20Pirot!5e0!3m2!1ssr!2srs!4v1763577172290!5m2!1ssr!2srs"
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
                <p class="pt-6">&copy; Narodno pozorište Pirot. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#F7F2EA', // warm parchment
                        secondary_background: '#faf0ca',
                        primary: '#8B1E3F', // velvet red
                        primary_hover: '#701932',
                        secondary: '#2D3047', // deep navy
                        secondary_hover: '#24273B',
                        primary_text: '#1F1A1A', // charcoal
                        secondary_text: '#5D4E4E', // warm gray
                        logocolor1: '#8B1E3F', // gold
                        logocolor2: '#2D3047', // pairs with gold
                        primarybtntxt: '#FFF7E6', // soft ivory on red/navy
                        surface: '#8B1E3F1A', // translucent velvet for cards
                        footerbg: '#EFE3D6', // creamy footer
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