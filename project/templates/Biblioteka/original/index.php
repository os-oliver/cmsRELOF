<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturni Centar Nexus</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2C5530',
                        primary_hover: '#1F3D22',
                        secondary: '#8B6B61',
                        secondary_hover: '#6D544A',
                        accent: '#D4AF37',
                        accent_hover: '#B8941F',
                        primary_text: '#2C3E50',
                        secondary_text: '#5D4037',
                        background: '#F8F5F0',
                        secondary_background: '#E9E4D8',
                    },
                    fontFamily: {
                        'heading': ['Playfair Display', 'serif'],
                        'heading2': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
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
            color: #1f2937;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            border-left: 3px solid #1e40af;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: linear-gradient(to bottom, #f8f5f0, #e9e4d8);
            color: #333;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-crimson {
            font-family: 'Crimson Pro', serif;
        }

        .library-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23d4a373' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .book-spine {
            position: relative;
            overflow: hidden;
        }

        .book-spine::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 8px;
            background: linear-gradient(to bottom, #2C3E50, #1A252F);
        }

        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #8B6B61;
            transition: width 0.3s;
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

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .page-turn {
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .page-turn:hover {
            transform: rotateY(15deg) translateX(-5px);
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-heading font-bold text-primary_text">Menu</h2>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-secondary transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-secondary"></i>Početna
                    </a>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-accent"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-history mr-2 text-secondary"></i>Istorijat
                            </a>
                            <a data-page="Rukovodstvo" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Rukovodstvo
                            </a>
                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                            </a>
                            <a data-page="Donacije i podrška" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-primary"></i>Donacije i podrška
                            </a>
                            <a data-page="Partneri" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-handshake mr-2 text-primary"></i>Partneri
                            </a>
                        </div>
                    </div>
                    <a data-page="Dogadjaji" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Dogadjaji
                    </a>
                    <a data-page="Galerija" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-secondary"></i>Dokumenti
                    </a>
                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-primary"></i>Kontakt
                    </a>

                </nav>
            </div>
        </div>
    </div>

    <!-- Font size toggle button -->
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary_text hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none transition-all"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <!-- Header with library theme -->
    <header class="fixed w-full z-50 py-3 bg-primary_text shadow-md">
        <div class=" mx-2 px-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-14 h-14 bg-secondary rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-book-open text-2xl text-background"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-heading font-bold text-background tracking-wider">KULTURNI NEXUS</h1>
                    <p class="text-xs text-accent tracking-widest">CENTAR ZA UMETNOST I BAŠTINU</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-8 items-center">
                <a href="#" class="nav-link text-background font-semibold flex items-center">
                    <i class="fas fa-home mr-2 text-accent"></i>Početna
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                        <i
                            class="fas fa-info-circle mr-2 text-secondary group-hover:text-secondary_hover transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">O nama</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>

                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-secondary_background rounded-xl shadow-2xl border border-surface opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3 backdrop-blur-sm">

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-book mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Uvod</span>
                        </a>

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-flag mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Misija i vizija</span>
                        </a>

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-history mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Istorijat</span>
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-users-cog mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Rukovodstvo</span>
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-sitemap mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Organizaciona struktura</span>
                        </a>

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-building mr-3 text-secondary_text flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Objekat</span>
                        </a>

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-hand-holding-heart mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Donacije i podrška</span>
                        </a>

                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-handshake mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Partneri</span>
                        </a>

                    </div>
                </div>


                <!-- Aktivnosti Dropdown -->
                <div class="dropdown relative group">
                    <button class="nav-link text-background font-semibold flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-accent"></i>Aktivnosti
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute bg-background rounded-md shadow-lg py-2 min-w-[200px] mt-2 hidden group-hover:block">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-secondary_background rounded-md text-primary_text">
                            <i class="fas fa-calendar-day mr-2"></i>Dogadjaji
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-secondary_background rounded-md text-primary_text">
                            <i class="fas fa-newspaper mr-2"></i>Vesti
                        </a>
                    </div>
                </div>

                <div class="dropdown relative group">
                    <button class="nav-link text-background font-semibold flex items-center">
                        <i class="fas fa-child mr-2 text-accent"></i>Usluge
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute bg-background rounded-md shadow-lg py-2 min-w-[200px] mt-2 hidden group-hover:block">
                        <a static="true" href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-secondary_background rounded-md text-primary_text">
                            <i class="fas fa-book-open mr-2"></i>Za decu
                        </a>
                        <a static="true" href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-secondary_background rounded-md text-primary_text">
                            <i class="fas fa-paint-brush mr-2"></i>Radionica i igre
                        </a>
                    </div>
                </div>
                <a href="#" class="nav-link text-background font-semibold flex items-center">
                    <i class="fas fa-theater-masks mr-2 text-accent"></i>Repertoar
                </a>
                <a href="#" class="nav-link text-background font-semibold flex items-center">
                    <i class="fas fa-images mr-2 text-accent"></i>Galerija
                </a>
                <a href="#" class="nav-link text-background font-semibold group flex items-center">
                    <i class="fas fa-folder-open mr-2 text-accent"></i>
                    Dokumenti
                </a>
                <a href="#" class="nav-link text-background font-semibold flex items-center">
                    <i class="fas fa-address-book mr-2 text-accent"></i>Kontakt
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
                        class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0 min-w-max bg-secondary_background rounded-xl shadow-2xl border border-surface z-50 py-2 backdrop-blur-sm">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                                class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>


            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="searchButton"
                        class="text-background hover:text-accent transition-colors focus:outline-none"
                        aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="searchInputContainer"
                        class="absolute right-0 top-10 hidden w-64 bg-background rounded-md shadow-lg p-2 z-50">
                        <div class="flex">
                            <form action="/pretraga" method="get" class="flex w-full max-w-xs">
                                <input type="text" name="q" placeholder="Pretraži..."
                                    class="w-full border border-secondary rounded-l-md py-2 px-3 focus:outline-none focus:ring-1 focus:ring-secondary"
                                    id="searchInput" />
                                <button type="submit" class="bg-secondary text-background px-4 rounded-r-md"
                                    aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <button id="hamburger"
                    class="hamburger lg:hidden text-background w-8 h-8 flex flex-col justify-between">
                    <span class="block w-8 h-1 bg-background rounded"></span>
                    <span class="block w-8 h-1 bg-background rounded my-1"></span>
                    <span class="block w-8 h-1 bg-background rounded"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section with library theme -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 library-pattern">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background: radial-gradient(circle, #2C3E50 1px, transparent 1px); background-size: 40px 40px;">
            </div>
        </div>

        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl bg-background bg-opacity-90 p-8 rounded-xl shadow-xl">
                    <div class="mb-8">
                        <span
                            class="inline-block bg-accent text-primary_text px-4 py-1 rounded-full text-sm font-medium mb-6">
                            <i class="fas fa-star mr-2"></i>Istaknuto ovog meseca
                        </span>
                        <h1 class="text-4xl md:text-5xl font-heading font-bold leading-tight text-primary_text mb-6">
                            <span class="block">Mesto gde se umetnost, knjiga i</span>
                            <span class="block text-secondary mt-2">kultura susreću</span>
                        </h1>
                    </div>

                    <div class="mb-10 relative pl-6 border-l-4 border-secondary">
                        <p class="text-lg text-primary_text leading-relaxed max-w-lg mb-6">
                            Doživite bogatstvo književnosti, umetnosti i kulture u našem novom renoviranom prostoru.
                        </p>
                        <p class="text-primary_text italic">
                            "Biblioteka nije luksuz, već jedna od potreba života."
                            <span class="block font-medium text-secondary mt-2">— Henry Ward Beecher</span>
                        </p>
                    </div>

                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="flex items-center bg-secondary_background p-3 rounded-lg">
                            <i class="fas fa-book text-secondary text-xl mr-3"></i>
                            <span class="text-primary_text">Preko 50,000 naslova</span>
                        </div>
                        <div class="flex items-center bg-secondary_background p-3 rounded-lg">
                            <i class="fas fa-users text-secondary text-xl mr-3"></i>
                            <span class="text-primary_text">Čitaonice za sve uzraste</span>
                        </div>
                        <div class="flex items-center bg-secondary_background p-3 rounded-lg">
                            <i class="fas fa-calendar text-secondary text-xl mr-3"></i>
                            <span class="text-primary_text">Dnevni kulturni program</span>
                        </div>
                        <div class="flex items-center bg-secondary_background p-3 rounded-lg">
                            <i class="fas fa-wifi text-secondary text-xl mr-3"></i>
                            <span class="text-primary_text">Besplatan internet</span>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="book-spine bg-secondary h-96 rounded-lg shadow-lg transform rotate-1"></div>
                        <div class="book-spine bg-primary_text h-80 rounded-lg shadow-lg transform -rotate-2 mt-8">
                        </div>
                        <div class="book-spine bg-accent h-88 rounded-lg shadow-lg transform rotate-3 mt-4"></div>
                        <div class="book-spine bg-secondary h-84 rounded-lg shadow-lg transform -rotate-1 mt-12"></div>
                        <div class="book-spine bg-primary_text h-92 rounded-lg shadow-lg transform rotate-2 mt-6"></div>
                        <div class="book-spine bg-accent h-76 rounded-lg shadow-lg transform -rotate-3 mt-10"></div>
                    </div>

                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-background rounded-full flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <h3 class="font-heading text-xl font-bold text-primary_text">Kulturna Oaza</h3>
                            <p class="text-secondary mt-2">Prostor za učenje, razmišljanje i inspiraciju</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-8 h-14 rounded-full border-2 border-secondary flex justify-center p-1">
                <div class="w-2 h-2 bg-secondary rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block pb-2 border-b-4 border-secondary">
                    Predstojeći Događaji
                </h2>
                <p class="text-lg text-primary_text max-w-2xl mx-auto mt-4">
                    Istražite našu bogatu ponudu kulturnih događaja koji će vas inspirisati i zabaviti
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="card-hover bg-white rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=600&q=80"
                            alt="Reading Event" class="w-full h-full object-cover">
                        <div class="category-badge bg-secondary text-background">
                            <p id="g-naziv"></p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-background mr-3">
                                <i class="fas fa-book"></i>
                            </div>
                            <span id="g-naziv" class="text-secondary font-bold">KNJIŽEVNI VEČER</span>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-primary_text mb-2">Čitanje sa autorom</h3>
                        <p id="g-description" class="text-primary_text mb-4">Sastanak sa poznatim domaćim piscem i
                            čitanje iz najnovijeg romana.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span id="g-time">18:00 - 20:00</span>
                                </div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span id="g-location">Glavna čitaonica</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="card-hover bg-white rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 relative">
                        <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&w=600&q=80"
                            alt="Book Club" class="w-full h-full object-cover">
                        <div class="category-badge bg-primary_text text-background">KLUB</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-primary_text flex items-center justify-center text-background mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-primary_text font-bold">KNJIŽNI KLUB</span>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-primary_text mb-2">"Na Drini ćuprija"</h3>
                        <p class="text-primary_text mb-4">Diskusija o Andrićevom remek-delu u okviru knjižnog kluba.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>17:00 - 19:00</span>
                                </div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Diskusiona sala</span>
                                </div>
                            </div>
                            <button
                                class="bg-secondary text-background px-4 py-2 rounded-full text-sm font-medium hover:bg-secondary_hover transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="card-hover bg-white rounded-xl overflow-hidden shadow-md">
                    <div class="h-48 relative">
                        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80"
                            alt="Workshop" class="w-full h-full object-cover">
                        <div class="category-badge bg-accent text-primary_text">RADIONICA</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-primary_text mr-3">
                                <i class="fas fa-pen"></i>
                            </div>
                            <span class="text-accent font-bold">KREATIVNO PISANJE</span>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-primary_text mb-2">Radionica pisanja</h3>
                        <p class="text-primary_text mb-4">Kako razvijati kreativnost i savladati osnove pisanja priča.
                        </p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>16:00 - 18:00</span>
                                </div>
                                <div class="flex items-center text-sm text-primary_text">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Radionica prostor</span>
                                </div>
                            </div>
                            <button
                                class="bg-accent text-primary_text px-4 py-2 rounded-full text-sm font-medium hover:bg-accent_hover transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button id="eventsView"
                    class="bg-primary_text text-background px-8 py-4 rounded-full font-medium hover:bg-primary_hover transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Exhibition Section -->
    <section id="promocija" class="py-20 bg-secondary_background">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 relative page-turn">
                    <div class="overflow-hidden rounded-xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=800&q=80"
                            alt="Featured Exhibition" class="rounded-xl w-full">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-24 h-24 bg-secondary rounded-full flex items-center justify-center text-background text-2xl font-heading font-bold shadow-xl">
                        <span>30%</span>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span
                        class="inline-block bg-accent text-primary_text px-4 py-1 rounded-full text-sm font-medium mb-6">
                        <i class="fas fa-fire mr-2"></i>Specijalna ponuda
                    </span>
                    <h2 class="text-4xl font-heading font-bold text-primary_text mb-6">
                        <span class="block">Retrospektiva</span>
                        <span class="block text-secondary">srpskih pisaca</span>
                    </h2>
                    <p class="text-lg text-primary_text mb-6 leading-relaxed">
                        Ekskluzivna izložba koja obuhvata najznačajnija dela srpskih književnika 20. veka. Ova
                        retrospektiva predstavlja jedinstvenu priliku da se upoznate sa evolucijom srpske književnosti
                        kroz pet decenija.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-secondary text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-primary_text">Datum</p>
                                <p class="font-medium">1. jun - 15. jul</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-secondary text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-primary_text">Vreme</p>
                                <p class="font-medium">10:00 - 20:00</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-secondary text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-primary_text">Lokacija</p>
                                <p class="font-medium">Galerija književnosti</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-gradient-to-r from-secondary to-secondary_hover text-background px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Rezerviši karte
                        </button>
                        <button
                            class="border-2 border-secondary text-secondary px-8 py-4 rounded-full font-medium hover:bg-secondary/10 transition-all flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Saznaj više
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4">
                    Naši Prostori
                </h2>
                <p class="text-lg text-primary_text max-w-2xl mx-auto">
                    Moderni, inspirativni prostori dizajnirani za čitanje i kulturne aktivnosti
                </p>
            </div>

            <div id="galleryCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80"
                        alt="Reading Room"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 id="g-description" class="font-bold text-lg">Glavna čitaonica</h3>
                        <p id="g-title" class="text-sm">Prostor za čitanje i učenje</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=600&q=80"
                        alt="Bookshelves"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Knjižni fond</h3>
                        <p class="text-sm">Preko 50,000 naslova</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=600&q=80"
                        alt="Reading Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Dečija čitaonica</h3>
                        <p class="text-sm">Prostor za najmlađe čitaoce</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=80"
                        alt="Study Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Studijska zona</h3>
                        <p class="text-sm">Prostor za koncentraciju</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Radionica</h3>
                        <p class="text-sm">Prostor za kreativne radionice</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1491975474562-1f4e30bc9468?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Knjižni kafić</h3>
                        <p class="text-sm">Mesto za opuštanje uz knjigu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary_text text-background pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center text-background mr-3">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <h3 class="text-xl font-heading font-bold">KULTURNI NEXUS</h3>
                    </div>
                    <p class="text-background/80 mb-4">
                        Centar za umetnost i kulturu koji okuplja kreativce i publiku u srcu Beograda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Izložbe</a></li>
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Knjižni fond</a>
                        </li>
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Radionice</a>
                        </li>
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Događaji</a></li>
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Članstvo</a></li>
                        <li><a href="#" class="text-background/80 hover:text-accent transition-colors">Kalendar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
                            <span>Knez Mihailova 56, 11000 Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-accent mt-1 mr-3"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-accent mt-1 mr-3"></i>
                            <span>info@kulturninexus.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-accent mt-1 mr-3"></i>
                            <span>
                                Utorak - Nedelja: 10:00 - 20:00<br>
                                Ponedeljak: zatvoreno
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Newsletter</h4>
                    <p class="mb-4 text-background/80">Prijavite se za obaveštenja o novim događajima i promocijama</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Vaša email adresa"
                            class="w-full px-4 py-2 rounded-md bg-primary_hover text-background border border-secondary focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="submit"
                            class="bg-secondary text-background w-full py-2 rounded-md hover:bg-secondary_hover transition-colors">Prijavi
                            se</button>
                    </form>
                </div>
            </div>

            <div class="border-t border-primary_hover pt-8 text-center text-background/60 text-sm">
                <p>&copy; 2023 Kulturni Centar Nexus. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        // Font size toggle functionality
        const btn = document.getElementById('increaseFontBtn');
        if (btn) {
            let currentSize = 16;
            let step = 2;
            let maxSteps = 3;
            let count = 0;
            let increasing = true;

            btn.addEventListener('click', () => {
                if (increasing) {
                    currentSize += step;
                    count++;
                    if (count === maxSteps) {
                        increasing = false;
                        btn.textContent = 'A-';
                    }
                } else {
                    currentSize -= step;
                    count--;
                    if (count === 0) {
                        increasing = true;
                        btn.textContent = 'A+';
                    }
                }
                document.body.style.fontSize = currentSize + 'px';
            });
        }

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchInputContainer = document.getElementById('searchInputContainer');
        const closeSearch = document.getElementById('closeSearch');

        if (searchButton && searchInputContainer) {
            searchButton.addEventListener('click', () => {
                searchInputContainer.classList.toggle('hidden');
            });
        }

        if (closeSearch && searchInputContainer) {
            closeSearch.addEventListener('click', () => {
                searchInputContainer.classList.add('hidden');
            });
        }

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenu.classList.contains('hidden') &&
                    !mobileMenu.contains(e.target) &&
                    e.target !== hamburger &&
                    !hamburger.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            const closeMobileBtn = document.getElementById('closeMobileMenu');
            if (closeMobileBtn) {
                closeMobileBtn.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            }
        }

        // Mobile dropdown functionality
        const mobileAboutToggle = document.getElementById('mobileAboutToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');

        if (mobileAboutToggle && mobileAboutMenu && mobileAboutIcon) {
            mobileAboutToggle.addEventListener('click', () => {
                mobileAboutMenu.classList.toggle('hidden');
                mobileAboutIcon.classList.toggle('rotate-180');
            });
        }

        // Events view button
        const eventsViewBtn = document.querySelector("#eventsView");
        if (eventsViewBtn) {
            eventsViewBtn.addEventListener('click', () => {
                window.location.href = "/aktivnosti/dogadjaji";
            });
        }

        // Header scroll effect
        const header = document.querySelector('header');
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('shadow-lg');
                } else {
                    header.classList.remove('shadow-lg');
                }
            });
        }

        // Nav link hover effect (pseudo-elements can't be accessed in JS, use CSS instead)
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link) {
                link.addEventListener('mouseenter', () => {
                    link.classList.add('hover-effect'); // Use CSS for ::after
                });
                link.addEventListener('mouseleave', () => {
                    link.classList.remove('hover-effect');
                });
            }
        });

    </script>
</body>

</html>