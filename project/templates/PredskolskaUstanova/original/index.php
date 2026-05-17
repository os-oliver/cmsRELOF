<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predškolska ustanova | Detinjstvo Žabalj</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style type="text/css">
        .dropdown.locale {
            margin-top: 0px !important;
        }

        .dropdown {
            margin-top: 6px;
        }

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
                        #F1F7ED 0%,
                        #a4d1aaff 50%,
                        #F1F7ED 100%);
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

<body class="bg-background font-heading2 text-secondary_text min-h-screen overflow-x-hidden">
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
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-primary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down  transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-school mr-2 text-primary"></i>Vrtići
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fa-question mr-2 text-primary"></i>Pitanja
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije
                            </a>
                        </div>
                    </div>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all"
                            id="mobileParentsToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-primary"></i>Za roditelje
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"
                                id="mobileParentsIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileParentsMenu">
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-utensils mr-2 text-primary"></i>Jelovnik
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-info-circle mr-2 text-primary"></i>Obaveštenja
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-receipt mr-2 text-primary"></i>Cenovnik
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-file-alt mr-2 text-primary"></i>Upis
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-clock mr-2 text-primary"></i>Raspored aktivnosti
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-comments mr-2 text-primary"></i>Savetovalište
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-star mr-2 text-primary"></i>Posebne usluge
                            </a>
                        </div>
                    </div>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Vesti
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-primary"></i>Dokumenti
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
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
    <header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm bg-background/95">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo Section -->
            <a href="/" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                    <img src="" alt="" style="width:75px;height:auto;" />
                </div>
                <div class="hidden sm:block font-heading text-primary_text">
                    <div class="text-xl leading-tight">PU "Detinjstvo"</div>
                    <div class="text-xs tracking-wide hidden md:block">Žabalj</div>
                </div>
            </a>
            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-8 font-heading2 text-secondary_text hover:text-primary_text">
                <a href="#"
                    class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-home mr-2 text-primary transition-colors"></i>
                    <span class="hidden xl:inline">Početna</span>
                </a>
                <div class="dropdown relative group transition-colors">
                    <button
                        class="nav-link transition-colors flex items-center whitespace-nowrap">
                        <i class="fas fa-info-circle mr-2 text-primary"></i>
                        <span class="hidden xl:inline">O nama</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-flag mr-2 text-primary"></i>Misija
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-school mr-2 text-primary"></i>Vrtići
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-question mr-2 text-primary"></i>Pitanja
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije
                        </a>
                    </div>
                </div>
                <div class="dropdown relative group transition-colors">
                    <button
                        class="nav-link transition-colors flex items-center whitespace-nowrap">
                        <i class="fas fa-users mr-2 text-primary"></i>
                        <span class="hidden xl:inline">Za roditelje</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="#"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-utensils mr-2 text-primary"></i>Jelovnik
                        </a>
                        <a href="#"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-info-circle mr-2 text-primary"></i>Obaveštenja
                        </a>
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-receipt mr-2 text-primary"></i>Cenovnik
                        </a>
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-file-alt mr-2 text-primary"></i>Upis
                        </a>
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-clock mr-2 text-primary"></i>Raspored aktivnosti
                        </a>
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-comments mr-2 text-primary"></i>Savetovalište
                        </a>
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-star mr-2 text-primary"></i>Posebne usluge
                        </a>
                    </div>
                </div>
                <a href="#"
                    class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i
                        class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Vesti</span>
                </a>
                <a href="#"
                    class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-images mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Galerija</span>
                </a>
                <a href="#"
                    class="nav-link transition-colors group flex items-center whitespace-nowrap">
                    <i class="fas fa-folder-open mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Dokumenti</span>
                </a>
                <a href="#"
                    class="nav-link transition-colors flex items-center whitespace-nowrap">
                    <i class="fas fa-address-book mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Kontakt</span>
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
                    'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                    'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
                ];

                if (!isset($languages[$locale])) {
                    $locale = 'sr';
                }
                ?>
                <div class="locale dropdown nonPage relative group">
                    <button class="nav-link transition-colors flex items-center whitespace-nowrap">
                        <span class="mr-2 text-secondary_text hover:text-primary_text"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline"><?= $languages[$locale]['label'] ?></span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg z-50">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>" class="dropdown-item flex items-center px-4 py-2 rounded-md text-sm text-secondary_text hover:text-primary_text">
                                <span class="mr-2"><?= $lang['flag'] ?></span>
                                <?= $lang['label'] ?>
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
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-background">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-secondary/40 via-background/60 to-accent/30"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-20 py-12 sm:py-16 lg:py-24 relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
                <div class="space-y-6 sm:space-y-8">
                    <div class="inline-block"><span class="px-4 sm:px-6 py-2 bg-accent/10 text-accent_text rounded-full text-xs sm:text-sm font-semibold tracking-wide"><i class="fas fa-sparkles mr-2"></i>Dobrodošli u naš svet</span></div>
                    <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl leading-tight text-primary_text">Dobrodošli</h1>
                    <p class="font-body text-base sm:text-lg lg:text-xl text-secondary_text leading-relaxed max-w-xl">Gde svaki dan počinje osmehom i igrom, a svako dete otkriva svoj jedinstveni put kroz čarobni svet detinjstva.</p>
                    <div class="relative group">
                        <div class="slider-item overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl"><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/4f/+RXhpZgAASUkqAAgAAAANAA8BAgASAAAArAAAABABAgAMAAAAwAAAABIBAwABAAAAAQAAABoBBQABAAAAzAAAABsBBQABAAAA1AAAACgBAwABAAAAAgAAADEBAgAKAAAA3AAAADIBAgAUAAAA6AAAADsBAgAlAAAA/AAAABMCAwABAAAAAgAAAJiCAgA3AAAAJAEAAGmHBAABAAAAXAEAACWIBAABAAAAIJoAADSaAAAAAE5JS09OIENPUlBPUkFUSU9OAAAATklLT04gRDcxMDAALAEAAAEAAAAsAQAAAQAAAFZlci4xLjAxIAAAADIwMTY6MDU6MDUgMTU6MDk6MTkAICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgAAAAACAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAAAKQCaggUAAQAAAFADAACdggUAAQAAAFgDAAAiiAMAAQAAAAIAAAAniAMAAQAAAJABAAAwiAMAAQAAAAIAAAAAkAcABAAAADAyMzADkAIAFAAAAGADAAAEkAIAFAAAAHQDAAABkQcABAAAAAECAwACkQUAAQAAAIgDAAAEkgoAAQAAAJADAAAFkgUAAQAAAJgDAAAHkgMAAQAAAAUAAAAIkgMAAQAAAAAAAAAJkgMAAQAAABAAAAAKkgUAAQAAAKADAAB8kgcAHJYAAOQDAACGkgcALAAAAKgDAACQkgIAAwAAADgwAACRkgIAAwAAADgwAACSkgIAAwAAADgwAAAAoAcABAAAADAxMDABoAMAAQAAAAEAAAACoAMAAQAAAJARAAADoAMAAQAAALgLAAAFoAQAAQAAAACaAAAXogMAAQAAAAIAAAAAowcAAQAAAAMAAAABowcAAQAAAAEAAAACowcACAAAANQDAAABpAMAAQAAAAAAAAACpAMAAQAAAAAAAAADpAMAAQAAAAAAAAAEpAUAAQAAANwDAAAFpAMAAQAAABsAAAAGpAMAAQAAAAAAAAAHpAMAAQAAAAEAAAAIpAMAAQAAAAAAAAAJpAMAAQAAAAAAAAAKpAMAAQAAAAAAAAAMpAMAAQAAAAAAAAAAAAAAAAAKAAAAoA8AAGQAAAAKAAAAMjAxNjowNTowNSAxNTowOToxOQAyMDE2OjA1OjA1IDE1OjA5OjE5AAQAAAABAAAA/v///wYAAAAeAAAACgAAALQAAAAKAAAAQVNDSUkAAAAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICACAAIAAAEBAgEAAAABAAAATmlrb24AAhEAAElJKgAIAAAAOQABAAcABAAAADAyMTECAAMAAgAAAAAAkAEEAAIACAAAALoCAAAFAAIADQAAAMICAAAHAAIABwAAANICAAAIAAIADQAAANoCAAAJAAIAFAAAAOoCAAALAAgAAgAAAAAAAAAMAAUABAAAAP4CAAANAAcABAAAAAABBgAOAAcABAAAAAABDAARAAQAAQAAACI4AAASAAcABAAAAAABBgATAAMAAgAAAAAAkAEWAAMABAAAAB4DAAAXAAcABAAAAAABBgAYAAcABAAAAAABBgAZAAoAAQAAACYDAAAbAAMABwAAAC4DAAAcAAcAAwAAAAABBgAdAAIACAAAAD4DAAAeAAMAAQAAAAEAAAAfAAcACAAAAEYDAAAiAAMAAQAAAAAAAAAjAAcAOgAAAE4DAAAkAAcABAAAADwAAAIlAAcADgAAAIoDAAArAAcAEAAAAJoDAAAsAAcAPgIAAKoDAAAyAAcACAAAAOoFAAA1AAcABgAAAPIFAAA7AAUABAAAAPoFAACDAAEAAQAAAA4AAACEAAUABAAAABoGAACHAAEAAQAAAAAAAACJAAMAAQAAAAAAAACKAAMAAQAAAAEAAACLAAcABAAAAFQBDACRAAcAJi4AADoGAACVAAIABQAAAGI0AACXAAcASAIAAGo0AACYAAcAIQAAALI2AACeAAMACgAAANY2AACiAAQAAQAAAKpvewCjAAEAAQAAAAAAAACnAAQAAQAAAFaXAACoAAcAMQAAAOo2AACrAAIAEAAAAB43AACwAAcAEAAAAC43AACxAAMAAQAAAAQAAAC2AAcACAAAAD43AAC3AAcAHgAAAEY3AAC4AAcArAAAAGY3AAC5AAcABAAAAAH/AAC7AAcACAAAABI4AAC/AAMAAQAAAAAAAADAAAcACAAAABo4AAAAAAAARklORSAgIABBVVRPMSAgICAgICAAAAAAQUYtUyAgAAAgICAgICAgICAgICAAAAAAICAgICAgICAgICAgICAgICAg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                    4fCSRRoPcUuWVYkxTd7gWkSnesJ+r1Bp9/ZpUKx8wXqkRljj308ziFWXSXAPHqKbB+U7AT/vEqq3NCmTbbyDu2eEGSKcjvK                    t7i3RdEG                    kv3a0ipcoMmOvEOwYCIhWH4G4Bw5yapT8ikROneEZRaZ7wX+uUWj0SWrvrX                        AANP4DqaQvMpJ1a4W6ZKc6Ib2N8sgV1ArRrV0BuqQlmCKeLbGO/xBiIRMHKgsbxNkcKo2xSMbpzKSCoSF3h2e6UbJBkDM2Fuub/sL+D+eenitd5TMZ0m+MN0kwpkAGvXgMdK1Sa/X0a1KmfsN4pkRa4dVNNUZVlUlyDRyzCQWfeQM9XQRgtTYqXS/ukbllgh4tm4XrwxZ3C6TPJGOJxST9Qf8s0ul0d+/QKP5HmkTHu2N                        1yBLuPgI65AWashrwT7SpVogyTc/kp3hYRcN9rFJ68QtXrZN9wHuku2Qc4kwyiVSUSHUOH6GYBuY6Aj7sEau2MSiQbL2CxGb5GF+f8/DKF9YIs89fY9jGK/pI/CfT6HV26NMt/UD5IcbYYlzPswrPF8jyhJ8iGYVtq                            TFN3uBaRKd6wn6vUGn39mlQrHzBeqRGWOPfTzK0RZdJcAzhXDcH0X                    fcAqFWyc                N+wnq8AA                AAAAAAAADAxMDYAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgICAgICAgICAgICAgICAAMDEwMAAAAAAAAAAAAAAAAAAAAAAAAAAAMDEwMAAAAQEBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwMTAwAACHAL0hAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA            AAAAAAAA            AAAAAAAAAAAAAAAAAAAAMDIwMP///wA8AQwAhAEMAAcAAwEDAAEAAAAGAAAAGgEFAAEAAAB+OAAAGwEFAAEAAACGOAAAKAEDAAEAAAACAAAAAQIEAAEAAAAGOgAAAgIEAAEAAAB4WgAAEwIDAAEAAAACAAAAAAAAAAAALAEAAAEAAAAsAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/2P/bAIQADRIUFxQRGxcWFx4cGyAoQysoJSUoUjo+MENhVWZkX1VdXGt4mYJrcZFzXF2FtYeRnqOrratngLzJuqbImairpQENHh4oIyhOKytOp            aWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWl/8AAE                f/EAaIAAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKCxAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0                    So0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8j                        x8vP09fb3+Pn6AQADAQEBAQEBAQEBAAA                    BAgQEAwQ                    SQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm                AAwDAQAC                He2w8HBNeZHXQyRVG7cdqkjGDio23qgz909DXctjQI92cp1zxVlGZiQc4PXjmmBoC3WIrIhD5OcDjFNu52WIxLlQzEkD+VFxGdbqWOP51pOV                    OR1I5Bro47G3ubdn3MtxggHOOR6imIyws1uViaNJlYZ+XOaheO2UbkG4ngxsSGX6UwM4bS3C4HQjNbscnmoVPUYw3TBrNgUhZtLMdzHpWtBYq                        uOoHv71xV4jwzeXsA2nAz3qxGla                    lOODjOe9                    DMVkyQuOnWt5apGUdGyBYfLYD7wHbvXUW2pxhFVlPHXHNcyZsyjqLQu0U0B56bfeorF3Kt5hwDkYxWyetzJ7Dv3bKY1OQetQsGhtyyxgMnPB/CkncDESOSZS6NyThgKfbwSvIyDJPUUrXLuaStHbSAs7bwMEGqSTq829yTzwvrUbCO106RXyNuGFbx4Fb                aZI0kCoy                rk5rnky0PmvZWUCAAZOC3XFUFiCnfIxZj3PJNZuVzRKxJu44GwfrVZm3Hy0GPUnrUlEgAUACnDn6dql6IoXrzTfc1gURt9KaAMninYBpC+tJ                    4x+VWEgOemP1NapEl5IQOg/E1Y2ADk5/SocuxokNBOQBgD0FPBPfFYFAefWkCetMROV4AxSjimAZp65DKfQ5rRIlnZnpUY+8Poa6CR9FMR5z5Ydt2evSo                        O7I4qqxG3HJOa7SyNSVwQasJKwPyZ                    AyM3mDqG                    lVYAcYrG4x8Tr8zgYI9DUiyksXLAnOCM81VySaOVAwb5Sc4+Y8AGs2YSTs0c7R7c5DY5x7GtU9AMaW2bduiDmInGSOa1LQbY2Vu/tk1LKHzeYhDhsc9fWmJOTJk5yO1ZgbipMVLxvtIJPyjtUcdqdTUNn5lY5bHU+9aIC2tubPcVC7gMAg9Kr                l3by24kZ            aFwTnIyf        hkWZg4xu        W7MDwRWbGaULl4HuGZflPccmrccZOcnggnrik            bNvLc8bRVw3M2c3CH8pjygHY9a1dPnZZfL2nPqa1irMG7o0rjTN0by8s5GaxLe0nEu0oM5wDSnHsCZ2+nwGNSXUBz1rQmYKOTTWgHJS3BEwA5UnH/1627eQsOgAFZxeoMqTXSoST68VkS3MnzEEYPUUN                O2WPp0pPVAI3GNg69TTAQG9T6ms0aDZn2gKBlj09qrquwepPWqBD15+lP5J9qxZY4/pSVIEWDnpTcdhVCFIwPWoS3GKdhES+ijc                epqY/KOB                GbcnOMVIExyaoQ/A+tOqkiSQn5gPakosMKcK1RB2SnKg+oqMfeH0NbCJaSgZ5IJiq4UsSe5rQCs33m3N0+tcbRmZV1btLyow386zVtXS                7VOLINkk                bsEHimxkc1yMlY8kHpTY0JXcB35Ap                    ihDLIKlWPQegp8ZVVAIO0dyKQGlI7JGoUdP0rIEoWQjoDzj3qrgX                        KoYJwCelTMGt5DJbSsqnG8Hv6mrQy7PdW0g+fkgcGpIDHLAY5V27sde1XfURzep28SXcaKuYyoAYeua61oY4bdZVG1UHBB7VYFP7epkKuRjbiqE0EGMsqnf8wHtWVwM9rMK5aBmdTyVPb/GsyeQsNpyT2pDLdoNsaqzDAOQT1r                        8u2hJY4GTn8a7bnOXILpXlMQHTvV47F54rnudCI3nRAxLAACufubpW6Nke3epuM55MzTnH3RzW7Iwiiyx+Y9MVmhswsfOXZmfA5C84rLLPKzRgAfNnmhjOhtLTYd3f19a1ZY8Q5I6Nx7VrbQi+pn/AIVRdwmT3z0rA0I0B5duWNSY7UixfbtS9T7VgMWmEnPtVkj                    gJxvJY9x                    JDsmg5OKyKFC1JgCqJEzxxThnPNWkIdTqskkbtSUDCnVQjrYeYUPsKT+MfjWoiaigZ5OVRDgZBPSrkZ6ZBLe1cpJKynOTjispnaO4y43J                        DKMYQnoCc5pJLc8lscdFFFxEHlKiklPpTlfKllcKAKoo0I/kTDksDyapTQYIZWz3zipAqlXXLbTjitS3VdwZgd3XnmrAsSTgDAHzfy+tQMIcl22k47UhCRsoI29/WlLqYjkjLHg0hleOZYTjIPHNJ5pnLBB8o6j3piJFRYvnI3YOQfSr0dxvfAU4xz6Uhg7KG3OeR04rPn1CV2Ea52enrV3EQxHBJkI/GrMbB8OCSB0BqRl/czLlRmsfyiZTIxGe+KSAljU78HBU                        cCqzYmPzcAUN6hYk+0eXIAg9s1da52INxyTWi2YmZxugyBs8dMGswTFht6DoaVyi1ZxNMTtO05zWwLbduLqTzwSc1cUDNgRAIQAKxTaDzlkAye5rdoyRuImAPUVBc/6k1T2J6mC7BVJJwBWavzuZGGPQVxnSiXP50nsDWbKFIHAp2akBP4qjeQLwSM+grQghHmvnb8o96nSFRyfmPqaHpuUWtvv+VNbI6HA9q5m7mlgBPrTqgoULT+BVEhn2owTVpEhj                        mI6q3OYE+lK331+v9K0GS0UAeUJbuSHYnmtaMKMc8/SuVEjpAN2ACcjNZ0pAX5yAM0xlEyO52xKST0pF3b2WVjuBxWltCR3nxouGOR6DvUj3A4IOT6UrAMS4kdsFcH3FbsUVvIqxy554445qktRmNIs1reqJS3kvwrdflzWrasEHluchmwCATirsBLLs+eNSVB9/6VhhpkYYYcHpisxFl45WBZEYnuSK1bXTjLb7zJ8x7CtuUCmlr+9IclgDjHanTsd/IHTke                        3yA8Dv04qeKbYu0jGDk89akCAu9w4UN3xmlWBwxwRkHmgAZMY3MOerU+BlhJDnIzkGkBoRStIxYEhPWoZQNwIIGB0PegCKaV5AqIuCeprTijWNMAZIpAUJWJBGdtQLKwUDaDx1zTEWIztO5hk5/KrV5PGQqRAk98VonoBksJJACE2+tTwQq3JJ3HvSYzoY3MGAycf3u351pLcps3Yx6Z710J2M7FF7ol2weMce3vUlpcCZ2x91eBnvQnqKxtGqF222E+9bvYzW5x7sZn                        rGXJ45PoKokeFkf7x2LVhI0TkDn1NDdikicY+tNJ571zN3NBwPvTsGkA4Lil+lUIXk0oFXYkCQKZuJ6CrELtJ6mpQoouBIKWpGPzhcdKKYBS1RJ01oc261M3UfWtBklJQB5qZXIAXk1UBkLncxXnkVyXRJqIS7EDlQOtVpohIMAABj175ppjMpomhJLqdnbrTElWTAAwSc59a0EZ0sW2UKAa1EQJtcDlSKq4GgABKjHBLfoamuFKgkDGOcDvS31C5WmYki                        BppZJmPOeoyO1SBJYQsk6naD8vcE+hqr                        jAZyMfN/ga2JLcjQxXX70hN68g9Mj/wDX+lY2oiCAtL1jPy/Ke9SyjknjEBDZDrwef60tm5nljjlPBbGT2z/kVkUbU1skIZAMyKf++h2Nc1JIWm5+UZ/Khokvxuqp9O9PaUlsRHOe9ZWGVp18lvnDZPTIqmr7iAFOelUBfWQqMkc59KrF2k9c9znFIZYglKHac5HrWhFKUwxPJ4+lIGUZ7gSHGDx61Yi3FW+XntntQBN5OWAkcjPTaKdJNBGuVADA4yKtCIRJ5pYrwD+tW7YMXHyjb                        kzNIbHbmXbk9ffrXT28WwYOaqKE2OmuoouN25umBXLXd3Jct5a/Kg64pyl0KUepVGMYHQUwvzXOaibgBmovMycICxpCJBE7cyNgegqyqhB8owKTdhpEgPcg0EBq52zQcOT0p4WgB4AFLntVEi4pelXYQzcO3NGGPtVEjgo+v1qQUhiEgdTiovNXOBT2AnDjtkn2ow59FH5mgCdVwnUn60tMAopiOisTmHHoausMgirAUHIopjPJVkYemW+YnHNTOWxgkMQOnrXkXZmTw                        mTITa46+lRPbxtsOADjqK6NRFRgEl5fJ                        aex54qrjGSW4PzEgBecCmhCgDJkN/CR1+lFwFYQttYAhiMEE4wfWtF4s2Riik8xO2exxXTdEnPCKRBtzhM/drtbTH2QKOUKkHPalHUbIw5nQCeI+bHjGcHj/wDVVbUlC2sbbN6Z3fL3J5rQDOkb7RYtMY/LIxjC1zxLLCi4ywbI/LpWTKNeyllVhPncg7Oecdxn8qsSrbSTBxlRJ64PPtiqJM97cuxSM5UcFh0NW/sU0OCwAVgMHHSs7FXL13CZzHG75fA                        IUBCnaenvVxkcQ5EZVsfePSoNCgi5zu49sUq5UEk8AcDNIRcWMMQWBQ+/TFaCR+WwZzlf51TRNyJWXzCcAp+dNeNZGCqAE68VIy5bwDacLjmozI8fVScdgOtOzEQBmkOFI9cmteK0Eq4bNaKN2Q2aO6G2yCPmHYVmTXrvwDsHsa1k+iKjHqzFkkYny1+8euO1PUBRtH4msDRleSUDhagQu5yoyf0oJLIgJ5ds+wq6gAHAAHtUN2KsGTnrT+ccVzlihalx                        c0wJAuOlOxikBVklVDjv71Ua4OOP8KTlYdiqZXccdPaliUEk57Vi33KN+MYUU8sAcZ59K6SCVTlTxiigBKKYjdsD8jD3rTqwGr0+nFOpjPMPLDDA6DpVkpunUqv3cdO/FcVjMzZIJJ3cs6ps6DHWqEUsY5Y/PnpVRtsM20uvOVlAHA6kZqTDgAcYxzVANMUZX1PXINVmhKvvHHf14pCLO5wBtABA/Opl5GWAUE9u9BRAxMilB1Q8+h/GrCABMA5NNgDI                        WtmGY28W0ZORyDz+FbQeojJjuJ53barx7QfcYrqdPUCLYXDqDxk5xXQtyS3cpGls2FGPSsYRx/aPLdFwFVlPrzzVCMy5kSxmZTCrQTEn5h0PcVz0ab5HaHKopztPPFZM1R0iXflW21YgXf34FdJDLttE84gtjGKdyDEnZMknAwAFx1rK1J2RIWUZZD1BPSsOpSIbEySIoyrbDwrDrWlLA0zlSPLz/Dmq3LMS/tZ41EgBKjgt70WkbSJlsn1o5XsK5soULEAH056AVDNHAFIYkMSCMf                        0qErjLsd2FUbSvofc1Zd9wJIG5T1z0qr                        ZzOSSc81UeYDvk+tI1bHptVcj7zUxxIflUY9SaZIqQrnJyx/SrQ4OAKxb7FpDiMinKPasSiTbTxgVQh1LitLEjiQKTJ7CqEKFJ6n8qkCgdqQEmKWmA3cPX8qT5j0AH1pAUp48jcckiqgjMmCBWT3KLSwAdcmrCxKvQChRC5bC8cmngYrckmXoabTASigRsaeeXH0rXqwGj7zD8afTGeURXBlbCqBgVpKNqjOTnuDXKQNXPzBMe/FYc8KmRsMNx5qk                        lRnjgVWdsscdAPrWYiGQ4Geo/WmM5IVADz0PpQBYRAoIXJJ/WrKPg4A5pjKkk4XIADep9KzzK0qsG+6B+FUBYjDSIuPunv6VupHG8gVuo71S3JZfjDQqo3Bhgj5utV7N/JboNrccdq6ebWwrFy9lZkUIdoByT+Brn4pEkmUOxYqv3gevNaN2JRvybZp1VhlEU/jnFc5cWqQ3RaDITbyp6A1k3dFEU8+2XKICRg4FVxeYZt3yjr8vGKwTLLFrMJWBJJ                        McZFPnkdlZhJnIx8/ai5ZetLmQ2pS4bcCcfN6Up/czhIQSrcZ6j2x+tdSelzFrWxdlhCQP5i7gx+8vUGuamjMkgKFmU8AnvUNDRd+yvDJGoxyPStO2c+VKWGODjNNaMT1MtxHsbu4bGVGBVJpigznnHesZWbLSCNxI2XNXEmSBAcjHTr0rMZgSSMCSBwe2ahU7iATirEWPMwOPWtFW3rnNRIaJQe3NSbc1gbDwuKeKokdg07A71pYQbvQZowx6nF                        zPU5osA8ACjNMREwJHpUCDaMCoYyXBp6jmkMmySOB+fFLgnqfyrQRLGAM0UANopiNSwP70j2rc71YEfSX6r/L/9dSUxnmqRBD1NLN05ztz2P61zEjcjaGK5OOq1WmjEhwpCsR34pASxfu0Rd+3HBGKYZgDhCBjkmrELHON7FyMYwBURlRY/vZNSNFZZJG3BgGA45qe3GE80sSW4yaWw7FjzdoBDDOcAetTqS5MjEDFIRnyo7Zw2QeSKhWMYycjB59KsZopIAq4BG444FWWkOwOFIP0piIo7                    SRNdsrNE                3cLDoZmd            75z60lew            Ic/SptYZt2iqj7SowBn0re+3wWwCy+ueDnFaRAwbqeC6meRJCvYAjtVVNhRkOAB1NQ1qWieRvKC7PunjgVuxGNIlQ4DFcYz6citImbHea9yRtIMXfFFjbRrN8wQ85wB0+taiLuoXV            SxUHr71g            C3Bzz+FRYsqNLjIU/lVfce5Jpkk5VtgJ78VEkbPnHQUPQRaijxnJ71pxja2PWsmy0XMAU8UrDHYo3AVoSL8x9qcE9eaAJgtPGKAGlwO/wCVICx7Y+tADsA9WzUoAHTFOwh2fTmjn6UwFxS0            1pAT9qTc        xTqAG0lM    wrfPWrQiT7H+lS0xbJ6ds1gzSSpKEBG0n0rmW5JZhVo/lLAjkjHpUrYXnvQBQZ5GOGHynpxVZjtJO7B9D3q0IgeTOQudp9e1LFG7yBFHJOSfT3qkijaW2dELSAgdAf8A61VnKKpXOAelJq24rj        UiPcgd+9QBDFKpYBeVYZAq5KgMeBwPXFAyqG2qTg49KQsWztJ5/CqESCND1Qs3t1rQRZEjD4O0dQD0qrMRmG6G9tq8DvVuJfOU7G+YDP1ppXBmjY+XGxE2NuMgntUN1JtYqhyhHy45x3rboT1OekOZCdwPOeOlX7e13D689KySuxvQkuomijVsZBHUVjgCR8sBUNWKWpK1uu0kAVWVmTgc+1K5RrOjAqQd3pmpGLtGVfJLcfShCFiMkOd7bQOigdatGeaXLcAn+76VfNpYLdTKZizbBznrTJpREOGyahDMZ5mfuSP0qEnPU5+lU2IkWNm9hVpYlHvWTZZoED7OnH8RFNVewAAq57kR2JgoFKPvr9aySLLo        Un8OKmVcd    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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/+EH/Wh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8AP3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iPjxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+PC9yZGY6UkRGPjwveDp4bXBtZXRhPiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgI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" alt="Naša predškolska ustanova" class="w-full h-64 sm:h-72 lg:h-80 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent">
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6">
                                <h3 class="font-heading2 font-semibold text-xl sm:text-2xl text-white mb-1 sm:mb-2"><i class="fas fa-school mr-2"></i>Naša ustanova</h3>
                                <p class="font-body text-white/90 text-xs sm:text-sm">Tradicija, kvalitet i ljubav prema deci od 1981. godine</p>
                            </div>
                        </div>
                        <div class="absolute -top-3 -right-3 sm:-top-4 sm:-right-4 bg-accent text-white px-4 sm:px-6 py-2 sm:py-3 rounded-2xl shadow-xl text-xs sm:text-sm font-semibold transform rotate-3"><i class="fas fa-trophy mr-2"></i><?= htmlspecialchars($dynamicText['t_ivg14g_6ae209_8ff28f']['text'] ?? 'Akreditovana ustanova', ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 pt-4"><a href="/o-nama/vrtici" class="font-body px-6 sm:px-8 py-3 sm:py-4 bg-primary hover:bg-primary_hover text-white rounded-xl text-base sm:text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-center"><?= htmlspecialchars($dynamicText['t_ivg14g_250a23_29cc1b']['text'] ?? 'Saznajte više', ENT_QUOTES, 'UTF-8'); ?></a><a href="/kontakt" class="font-body px-6 sm:px-8 py-3 sm:py-4 bg-surface hover:bg-secondary_background text-primary_text rounded-xl text-base sm:text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl text-center"><?= htmlspecialchars($dynamicText['t_ivg14g_b611ba_e42ffd']['text'] ?? 'Kontaktirajte nas', ENT_QUOTES, 'UTF-8'); ?></a></div>
                    <div class="grid grid-cols-3 gap-3 sm:gap-6 pt-6 sm:pt-8">
                        <div class="text-center p-3 sm:p-4 bg-secondary_background/60 backdrop-blur-sm rounded-xl sm:rounded-2xl">
                            <div class="font-heading2 text-2xl sm:text-3xl font-bold text-accent_text"><i class="fas fa-child mb-1"></i>
                                <div id="izqpi">600+<br></div>
                            </div>
                            <div class="font-body text-xs sm:text-sm text-secondary_text mt-1">Srećne dece</div>
                        </div>
                        <div class="text-center p-3 sm:p-4 bg-secondary_background/60 backdrop-blur-sm rounded-xl sm:rounded-2xl">
                            <div class="font-heading2 text-2xl sm:text-3xl font-bold text-accent_text"><i class="fas fa-star mb-1"></i>
                                <div id="iv0vj">5.0</div>
                            </div>
                            <div class="font-body text-xs sm:text-sm text-secondary_text mt-1">Ocena roditelja</div>
                        </div>
                        <div class="text-center p-3 sm:p-4 bg-secondary_background/60 backdrop-blur-sm rounded-xl sm:rounded-2xl">
                            <div class="font-heading2 text-2xl sm:text-3xl font-bold text-accent_text"><i class="fas fa-calendar-alt mb-1"></i>
                                <div id="ij7bz3">1981</div>
                            </div>
                            <div class="font-body text-xs sm:text-sm text-secondary_text mt-1">Osnovan</div>
                        </div>
                    </div>
                </div>
                <div class="relative mt-8 lg:mt-0">
                    <div class="bg-surface/80 backdrop-blur-lg rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl border border-accent/10 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 sm:w-40 h-32 sm:h-40 bg-accent/10 rounded-full blur-3xl">
                        </div>
                        <div class="absolute bottom-0 left-0 w-24 sm:w-32 h-24 sm:h-32 bg-secondary/10 rounded-full blur-3xl">
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-accent/20 rounded-full flex items-center justify-center"><i class="fas fa-music text-accent_text text-lg sm:text-xl"></i></div>
                                <h3 class="font-heading2 font-semibold text-xl sm:text-2xl text-primary_text">Naša pesmica</h3>
                            </div>
                            <div class="font-body space-y-2 sm:space-y-3 text-base sm:text-lg text-secondary_text leading-relaxed">
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">Jeste li ikada razmišljali o tome,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">vi primerci odrasle vrste,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">šta bi bilo da morate na prste,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">da se propinjete svakog minuta i sata,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">da bi otvorili obična vrata?</p>
                                <div class="h-2 sm:h-4"></div>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent font-semibold">Jeste li ikada razmišljali o tome?</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent italic text-accent_text">Niste, dabome!</p>
                                <div class="h-2 sm:h-4"></div>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">Što srce žudi, to igra budi,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">talasi sreće sada nas nose,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">igrom rastemo dobri ljudi,</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent font-bold text-secondary">Igrajmo se, igrajmo se!</p>
                                <div class="h-2 sm:h-4"></div>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">Neka vesele pesme drage</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">ispune dvorac naš šareni</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent">dolaze nama nove snage</p>
                                <p class="hover:text-primary_text transition-colors duration-200 pl-3 sm:pl-4 border-l-2 border-transparent hover:border-accent font-bold text-accent_text">dobro došao narode maleni!</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 w-16 h-16 sm:w-20 sm:h-20 bg-accent rounded-full opacity-20 animate-bounce">
                    </div>
                    <div class="absolute -bottom-3 -left-3 sm:-bottom-4 sm:-left-4 w-12 h-12 sm:w-16 sm:h-16 bg-secondary rounded-full opacity-20 animate-pulse">
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-0"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1440 320" class="w-full">
                <path fill="currentColor" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" class="text-accent">
                </path>
            </svg></div>
    </section>
    <!-- objekti -->
    <section id="vrtici" class="bg-background text-secondary_text font-heading2">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-heading text-primary_text relative inline-block">Objekti
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
            </div>
            <div id="vrticiCards" class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                <div class="vrtici-card flex items-center bg-surface rounded-lg shadow h-48">
                    <a href="#" class="w-1/4 h-full">
                        <img
                            id="g-image"
                            class="w-full h-full object-cover rounded-l-lg"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80">
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text font-heading text-2xl">
                            <p id="g-title" class="text-3xl">Lorem ipsum</p>
                        </h3>
                        <p id="g-description" class="mt-3 mb-4 text-sm line-clamp-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="vrtici-card flex  items-center bg-surface rounded-lg shadow h-48">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Art Exhibition" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text tracking-tight text-2xl">
                            <p id="g-naslov">Lorem ipsum</p>
                        </h3>
                        <p class="mt-3 mb-4 text-sm line-clamp-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="vrtici-card flex items-center bg-surface rounded-lg shadow h-48">
                    <a href="#" class="w-1/4 h-full">
                        <img
                            class="w-full h-full object-cover rounded-l-lg"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80">
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text tracking-tight text-2xl">
                            <p>Lorem ipsum</p>
                        </h3>
                        <p class="mt-3 mb-4 text-sm line-clamp-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="vrtici-card flex items-center bg-surface rounded-lg shadow h-48">
                    <a href="#" class="w-1/4 h-full">
                        <img
                            class="w-full h-full object-cover rounded-l-lg"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80">
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text tracking-tight text-2xl">
                            <p>Lorem ipsum</p>
                        </h3>
                        <p class="mt-3 mb-4 text-sm line-clamp-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="/o-nama/vrtici"
                    class="bg-primary text-background text-lg px-8 py-4 rounded-full hover:bg-primary_hover transition-colors flex items-center shadow-lg mx-auto w-fit">
                    Pogledaj sve
                </a>
            </div>
        </div>
    </section>
    <section class="py-16 bg-background text-secondary_text">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <?php
                $stats = [
                    ['number' => '20', 'label' => 'Generacija'],
                    ['number' => '4', 'label' => 'Objekta'],
                    ['number' => '1000+', 'label' => 'Osmeha'],
                    ['number' => '50+', 'label' => 'Zaposlenih'],
                ];
                foreach ($stats as $index => $stat): ?>
                    <div class="bg-surface p-6 rounded-xl shadow-lg transform transition hover:scale-105"
                        style="animation-delay: <?= $index * 0.2 ?>s">
                        <div class="text-4xl text-primary_text mb-2"><?= $stat['number'] ?></div>
                        <div><?= $stat['label'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-background text-secondary_text font-heading2">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading text-primary_text mb-4 relative inline-block">
                    Galerija
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
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
    <footer class="bg-secondary_background text-secondary_text font-heading2 pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
                            <img src="" alt="" style="width:75px;height:auto;" />
                        </div>
                        <h3 class="text-xl font-heading">PU "Detinjstvo" Žabalj</h3>
                    </div>
                    <p class="mb-4">
                        Pratite nas
                    </p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/people/%D0%9F%D1%83-%D0%94%D0%B5%D1%82%D0%B8%D1%9A%D1%81%D1%82%D0%B2%D0%BE-%D0%96%D0%B0%D0%B1%D0%B0%D1%99/100087466317139/#"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/pu_detinjstvo_zabalj/"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="/ankete" class="text-logocolor2/90 hover:text-primary_text transition-colors">Ankete o zadovoljstvu korisnika</a></li>
                        <li><a href="/vesti" class="text-logocolor2/90 hover:text-primary_text transition-colors">Vesti</a></li>
                        <li><a href="/galerija" class="text-logocolor2/90 hover:text-primary_text transition-colors">Galerija</a></li>
                        <li><a href="/dokumenti" class="text-logocolor2/90 hover:text-primary_text transition-colors">Dokumenti</a></li>
                        <li><a href="/kontakt" class="text-logocolor2/90 hover:text-primary_text transition-colors">Kontakt</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
                            <span>+381 21 2931 326</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
                            <span data-translate="off">detinjstvozabalj@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Mapa lokacije</h4>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2802.864498804511!2d20.063800699999998!3d45.3717293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b230463a09207%3A0xf95b56f00f5f5d35!2sPredskolska%20ustanova%20%22Detinjstvo%22%20Zabalj!5e0!3m2!1sen!2srs!4v1763427079830!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm">
                <div class="flex flex-col items-center border-t border-secondary_text pt-8 text-center text-secondary_text text-sm">
                    <img
                        src="/assets/img/SECO-logo-640px.png"
                        alt="SECO logo"
                        class="w-full max-w-md md:max-w-lg h-auto mb-4">
                    <p> Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno zvanični stav Vlade Švajcarske.</p>
                </div>
                <p class="pt-6">Copyright &copy; 2026 | Detinjstvo Žabalj</p>
            </div>
        </div>
    </footer>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        logocolor1: 'rgba(233, 168, 3, 1)',
                        logocolor2: '#2D6A4F',
                        primary: '#e9a803ff',
                        primary_hover: '#d39802ff',
                        secondary: '#32604dff',
                        secondary_hover: '#255943ff',
                        accent: "#e9a803ff",
                        accent_hover: "#d39802ff",
                        primary_text: '#1B4332',
                        secondary_text: '#2a644aff',
                        background: '#F1F7ED',
                        secondary_background: '#e5cc8c6b',
                        surface: "#e5cc8c6b",
                    },
                    fontFamily: {
                        heading: ['Fredoka', 'sans-serif'],
                        heading2: ['Nunito', 'sans-serif'],
                        body: ['Nunito', 'sans-serif']
                    },
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
        const mobileParentsToggle = document.getElementById('mobileParentsToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileParentsMenu = document.getElementById('mobileParentsMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');
        const mobileParentsIcon = document.getElementById('mobileParentsIcon');

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

        function toggleMobileParents() {
            const isHidden = mobileParentsMenu.classList.contains('hidden');

            if (isHidden) {
                mobileParentsMenu.classList.remove('hidden');
                mobileParentsIcon.style.transform = 'rotate(180deg)';
            } else {
                mobileAboutMenu.classList.add('hidden');
                mobileParentsIcon.style.transform = 'rotate(0deg)';
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

        if (mobileParentsToggle) {
            mobileParentsToggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleMobileParents();
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