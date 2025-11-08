<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorem ipsum dolor</title>
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
                                <i class="fas fa-bullseye mr-2 text-primary"></i>Cilj
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Zaposleni
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-history mr-2 text-primary"></i>Istorijat
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-school mr-2 text-primary"></i>Vrtići
                            </a>
                            <a href="#"
                                class="items-center py-2 px-4 text-sm text-primary hover:text-primary_hover transition-colors hidden">
                                <i class="hidden xl:inline"></i>Pitanja
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users mr-2 text-primary"></i>Timovi
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
                        <i class="fas fa-diagram-project mr-3 text-primary"></i>Projekti
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
                <div
                    class="w-11 h-11 bg-gradient-to-br from-[#CC8B3C] via-[#C85A3E] to-[#E07856] rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <img src="" alt="" style="width:75px;height:auto;" />
                </div>
                <div class="hidden sm:block font-heading text-primary_text">
                    <div class="text-xl leading-tight">Lorem ipsum dolor</div>
                    <div class="text-xs tracking-wide hidden md:block">Lorem ipsum dolor sit amet consectetu</div>
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
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            <i class="fas fa-bullseye mr-2 text-primary"></i>Cilj
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-sitemap mr-2 text-primary"></i>Zaposleni
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-flag mr-2 text-primary"></i>Misija
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-history mr-2 text-primary"></i>Istorijat
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-school mr-2 text-primary"></i>Vrtići
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            <i class="fas fa-users mr-2 text-primary"></i>Timovi
                        </a>
                        <a href="#"
                            class="dropdown-item items-center px-5 py-3 text-primary hover:text-primary_hover text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2 hidden">
                            <i class="fas fa-circle-question mr-3 text-coral flex-shrink-0 w-4 text-sm"></i>
                            <span class="hidden xl:inline">Pitanja</span>
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
                    <i
                        class="fas fa-diagram-project mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Projekti</span>
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
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient text-secondary_text">
        <div class="container max-w-full mx-10 px-4 py-24 relative z-10">
            <div class="grid items-center">
                <div>
                    <div class="mb-8 text-center">
                        <h1 class="text-5xl md:text-6xl leading-tight mb-8">
                            <span class="block font-heading text-primary_text">Lorem ipsum dolor</span>
                            <span class="block mt-2 text-secondary_text font-heading2">Lorem ipsum dolor sit</span>
                        </h1>
                        <p class="mx-4 md:mx-20 mb-10">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit.
                            Quisque faucibus ex sapien vitae pellentesque sem placerat.
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor.
                            Lorem ipsum dolor sit amet consectetur adipiscing elit.
                            Quisque faucibus ex sapien vitae pellentesque sem placerat.
                            In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor.
                        </p>
                        <a href="/o-nama/cilj"
                            class="bg-primary text-background px-6 py-4 rounded-full text-lg hover:bg-primary_hover transition-colors w-fit">
                            Saznajte o nama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- VESTI -->
    <section id="events" class="py-20 bg-background text-secondary_text">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 font-heading2">
                <h2 class="text-4xl font-heading mb-4 relative inline-block text-primary_text">
                    Lorem ipsum
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto mt-4">
                    Lorem ipsum dolor sit amet consectetur adipiscing elit
                </p>
            </div>
            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Art Exhibition" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-naziv" class="text-primary_text">Otvoren novi vrtić</span>
                        </div>
                        <h3 id="g-title" class="text-xl mb-2">Novo mesto za učenje i igru
                        </h3>
                        <a id="g-ovise" href="#"
                            class="bg-secondary text-background px-4 py-2 rounded-full hover:bg-secondary_hover transition-colors">
                            Pročitaj
                        </a>
                    </div>
                </div>
                <!-- Event 2 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Art Exhibition" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-naziv" class="text-primary_text">Otvoren novi vrtić</span>
                        </div>
                        <h3 id="g-title" class="text-xl mb-2">Novo mesto za učenje i igru
                        </h3>
                        <button
                            class="bg-secondary text-background px-4 py-2 rounded-full hover:bg-secondary_hover transition-colors">
                            Pročitaj
                        </button>
                    </div>
                </div>
                <!-- Event 3 -->
                <div class="event-card bg-surface rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Art Exhibition" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span id="g-naziv" class="text-primary_text">Otvoren novi vrtić</span>
                        </div>
                        <h3 id="g-title" class="text-xl mb-2">Novo mesto za učenje i igru
                        </h3>
                        <button
                            class="bg-secondary text-background px-4 py-2 rounded-full hover:bg-secondary_hover transition-colors">
                            Pročitaj
                        </button>
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
    <!-- objekti -->
    <section id="vrtici" class="bg-background text-secondary_text font-heading2">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-heading text-primary_text relative inline-block">Objekti
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></span>
                </h2>
                <p class="lg:mb-16 sm:text-xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
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
                        <p id="g-description" class="mt-3 mb-4">
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
                        <p class="mt-3 mb-4">
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
                        <p class="mt-3 mb-4">
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
                        <p class="mt-3 mb-4">
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
                    ['number' => '15', 'label' => 'Objekata'],
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
                <p class="text-2xl max-w-2xl mx-auto">
                    Lorem ipsum dolor amet consectetur adipiscing
                </p>
            </div>
            <div id="galleryCards" class="gallery-grid gap-6">
                <div class="gallery-item rounded-xl overflow-hidden relative">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?auto=format&fit=crop&w=600&q=80"
                        alt="Gallery Space" class="w-full h-full object-cover">
                    <div class="overlay-content text-background">
                        <h3 id="g-description">Lorem ipsum</h3>
                        <p id="g-title">Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?auto=format&fit=crop&w=600&q=80"
                        alt="Cinema" class="w-full h-full object-cover">
                    <div class="overlay-content text-background">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1562788865-5638f7446611?auto=format&fit=crop&w=600&q=80"
                        alt="Theater" class="w-full h-full object-cover">
                    <div class="overlay-content text-background">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop" class="w-full h-full object-cover">
                    <div class="overlay-content text-background">
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum</p>
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
                        <div class="w-12 h-12 bg-logocolor2 rounded-lg flex items-center justify-center text-background mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-logocolor2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl">Lorem ipsum dolor</h3>
                    </div>
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                        <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-logocolor2 mt-1 mr-3"></i>
                            <span>Lorem ipsum dolor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
                            <span>Lorem ipsum dolor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
                            <span data-translate="off">Lorem ipsum dolor</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-logocolor2 mt-1 mr-3"></i>
                            <span>
                                Lorem ipsum dolor<br>
                                Lorem ipsum dolor
                            </span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Mapa lokacije</h4>
                    <div class="rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d20.4541920155352!3d44.81407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sKnez%20Mihailova%2C%20Beograd!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm">
                <div class="flex flex-col items-center border-t border-secondary_text pt-8 text-center text-secondary_text text-sm">
                    <img
                        src="/assets/img/SECO-logo-640px.png"
                        alt="SECO logo"
                        class="w-2/3 sm:w-1/2 md:w-1/3 lg:w-1/4 h-auto mb-4">
                    <p> Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno zvanični stav Vlade Švajcarske.</p>
                </div>
                <p class="pt-6">&copy; Lorem ipsum dolor sit amet consectetur adipiscing elit</p>
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