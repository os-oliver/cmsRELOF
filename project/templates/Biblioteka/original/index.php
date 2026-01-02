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
                        // Background colors
                        background: '#FFFFFF',
                        secondary_background: '#FAF5FF',

                        // Primary colors
                        primary: '#8B5CF6',
                        primary_hover: '#7C3AED',

                        // Secondary colors
                        secondary: '#64748B',
                        secondary_hover: '#475569',

                        // Accent colors
                        accent: '#EC4899',
                        accent_hover: '#DB2777',

                        // Text colors
                        primary_text: '#1E293B',
                        secondary_text: '#64748B',

                        // Surface color
                        surface: '#F3E8FF'
                    },
                }
            }
        }
    </script>

    <style>
        /* Prilagođena klasa za text-shadow radi poboljšanja čitljivosti */
        .text-shadow-custom {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            /* Blaga tamna senka */
        }

        /* Dodatna klasa za jaču masku */
        .bg-image-mask {
            background-color: rgba(0, 0, 0, 0.55);
            /* Povećana tamna maska */
        }

        @media (min-width: 1024px) {
            .dropdown:hover .dropdown-menu {
                opacity: 1;
                visibility: visible;
            }
        }

        .dropdown-menu {
            position: absolute;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 1;
            border-radius: 0.75rem;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) translateX(-50%);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            margin: 0.25rem;
            border-radius: 0.5rem;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-background);
            border-left-color: var(--primary);
        }

        @media (max-width: 1023px) {
            .nav-link {
                width: 100%;
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
            }

            .nav-link:hover {
                background-color: var(--secondary-background);
            }
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: linear-gradient(to bottom, #f8f5f0, #e9e4d8);
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

        .nav-link:hover::after {
            width: 100%;
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
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 2xl:hidden hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" id="mobileMenuOverlay">
        </div>
        <div class="fixed top-0 right-0 h-full w-[280px] max-w-[90vw] bg-surface shadow-2xl transform translate-x-full transition-transform duration-300 ease-out"
            id="mobileMenuPanel">
            <div class="flex flex-col h-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-heading font-bold text-primary_text">Menu</h2>
                        <button id="closeMobileMenu"
                            class="p-2 -mr-2 text-primary_text hover:text-secondary transition-colors rounded-lg hover:bg-gray-100">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="/"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-secondary"></i>Početna
                    </a>
                    <div class="mobile-dropdown nonPage megaMenu relative group">
                        <button
                            class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                            <i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i>
                            <span class="hidden xl:inline">
                                <p>Naslov</p>
                            </span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>

                        <!-- MEGA MENU -->
                        <div
                            class="mobile-dropdown-menu absolute top-full left-0 w-[600px] bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 p-6 grid grid-cols-3 gap-6">

                            <!-- Sekcija (dinamički se dodaje) -->
                            <div>
                                <h3 class="font-bold text-slate mb-2">[Naslov sekcije]</h3>
                                <ul class="space-y-2">
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 1]
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 2]
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 3]
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dupliraj ili izbriši sekciju po potrebi -->
                        </div>
                    </div>
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
                            <a data-page="Uvod" href="/o-nama/uvod"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="/o-nama/misija-i-vizija"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="/o-nama/istorijat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-history mr-2 text-secondary"></i>Istorijat
                            </a>
                            <a data-page="Organizaciona struktura" href="/o-nama/organizaciona-struktura"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a data-page="Organi upravljanja" href="/o-nama/organi-upravljanja"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-users-cog mr-2 text-secondary"></i>Organi upravljanja
                            </a>
                            <a data-page="Objekat" href="/o-nama/objekat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                            </a>
                            <a data-page="Informacije" href="/o-nama/informacije"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-accent"></i>Informacije
                            </a>
                            <a data-page="Pitanja" href="/o-nama/pitanja"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-handshake mr-2 text-primary"></i>Pitanja
                            </a>
                        </div>
                    </div>

                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileActivitiesToggle">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-accent"></i>Aktivnosti
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileActivitiesIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileActivitiesMenu">
                            <a data-page="Ankete" href="/aktivnosti/ankete"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-poll mr-2 text-secondary"></i>Ankete
                            </a>
                            <a data-page="Vesti" href="/aktivnosti/vesti"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-newspaper mr-2 text-secondary"></i>Vesti
                            </a>
                        </div>
                    </div>

                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileServicesToggle">
                            <div class="flex items-center">
                                <i class="fas fa-concierge-bell mr-3 text-accent"></i>Usluge
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileServicesIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileServicesMenu">
                            <a data-page="Odeljenje za odrasle" href="/usluge/odeljenje-za-odrasle"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-user mr-2 text-primary"></i>Odeljenje za odrasle
                            </a>
                            <a data-page="Dečje odeljenje" href="/usluge/decje-odeljenje"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-child mr-2 text-secondary"></i>Dečje odeljenje
                            </a>

                        </div>
                    </div>

                    <a data-page="Dogadjaji" href="/dogadjaji"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Događaji
                    </a>

                    <a data-page="Galerija" href="/galerija"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>

                    <a data-page="Dokumenti" href="/dokumenti"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-secondary"></i>Dokumenti
                    </a>

                    <a data-page="Kontakt" href="/kontakt"
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
    <header class="fixed w-full z-50 py-3 bg-background shadow-md">
        <div class="mx-2 px-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-14 h-14 overflow-hidden rounded-lg shadow-lg">
                    <img src="" alt="Logo" class="w-full h-full object-cover bg-secondary" />
                </div>
                <div>
                    <h1 class="text-2xl font-heading font-bold text-primary_text tracking-wider">BIBLIOTEKA NEXUS</h1>
                    <p class="text-xs text-accent tracking-widest">ČUVARI ZNANJA I KULTURE</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden 2xl:flex space-x-6 items-center">
                <a href="/"
                    class="nav-link text-primary_text font-semibold flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background transition-all duration-200">
                    <i class="fas fa-home mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                    <span class="text-sm">Početna</span>
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-secondary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background group">
                        <i
                            class="fas fa-info-circle mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                        <span class="hidden xl:inline text-sm">O nama</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>

                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3">
                        <a static="true" href="/o-nama/uvod"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-book mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Uvod</span>
                        </a>
                        <a href="/o-nama/misija-i-vizija"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-flag mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Misija i vizija</span>
                        </a>
                        <a static="tre" href="/o-nama/istorijat"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-history mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Istorijat</span>
                        </a>
                        <a href="/o-nama/organizaciona-struktura"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-sitemap mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Organizaciona struktura</span>
                        </a>
                        <a href="/o-nama/organi-upravljanja"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-users-cog mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Organi upravljanja</span>
                        </a>
                        <a static="true" href="/o-nama/objekat"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-building mr-3 text-secondary_text flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Objekat</span>
                        </a>

                        <a static="true" href="/o-nama/informacije"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-hand-holding-heart mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Informacije</span>
                        </a>
                        <a href="/o-nama/pitanja"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-handshake mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Pitanja</span>
                        </a>
                    </div>
                </div>

                <!-- Aktivnosti Dropdown -->
                <div class="dropdown relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-secondary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background group">
                        <i
                            class="fas fa-calendar-alt mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                        <span class="hidden xl:inline text-sm">Aktivnosti</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3">
                        <a href="/aktivnosti/ankete"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-poll mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Ankete</span>
                        </a>

                        <a href="/aktivnosti/vesti"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-newspaper mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Vesti</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-secondary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background group">
                        <i
                            class="fas fa-concierge-bell mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                        <span class="hidden xl:inline text-sm">Usluge</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3">
                        <a href="/usluge/odeljenje-za-odrasle"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2"
                            static="true">
                            <i class="fas fa-user mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Odeljenje za odrasle</span>
                        </a>

                        <a href="/usluge/decje-odeljenje"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2"
                            static="true">
                            <i class="fas fa-child mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Dečje odeljenje</span>
                        </a>

                        <a href="/usluge/zavicajni-fond"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2"
                            static="true">
                            <i class="fas fa-archive mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Zavičajni fond</span>
                        </a>


                    </div>
                </div>


                <a href="/galerija"
                    class="nav-link text-primary_text font-semibold flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background transition-all duration-200">
                    <i
                        class="fas fa-images mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                    <span class="text-sm">Galerija</span>
                </a>
                <a href="/dokumenti"
                    class="nav-link text-primary_text font-semibold flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background transition-all duration-200">
                    <i
                        class="fas fa-folder-open mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                    <span class="text-sm">Dokumenti</span>
                </a>
                <a href="/kontakt"
                    class="nav-link text-primary_text font-semibold flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background transition-all duration-200">
                    <i
                        class="fas fa-address-book mr-2 text-accent text-sm group-hover:text-accent_hover transition-colors"></i>
                    <span class="text-sm">Kontakt</span>
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
                <div class="locale dropdown nonPage relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-secondary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-secondary_background group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-surface rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-secondary_background text-primary_text text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>

            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="searchButton"
                            class="text-primary_text hover:text-accent transition-colors focus:outline-none"
                            aria-label="Search">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="searchInputContainer"
                            class="absolute right-0 top-10 hidden w-64 bg-surface rounded-md shadow-lg p-2 z-50">
                            <div class="flex">
                                <form action="/pretraga" method="get" class="flex w-full max-w-xs">
                                    <input type="text" name="q" placeholder="Pretraži..."
                                        class="w-full border border-secondary rounded-l-md py-2 px-3 focus:outline-none focus:ring-1 focus:ring-secondary text-primary_text"
                                        id="searchInput" />
                                    <button type="submit" class="bg-secondary text-background px-4 rounded-r-md"
                                        aria-label="Search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile menu button -->
                    <button id="mobileMenuButton"
                        class="2xl:hidden text-primary_text hover:text-secondary transition-colors">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section with library theme -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-12 pb-24 bg-surface text-primary_text">

        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1610116306796-6fea9f4fae38?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Background image of books" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-image-mask backdrop-blur-sm"></div>
        </div>

        <div class="absolute inset-0 z-0 opacity-5">
            <div
                class="absolute top-1/4 left-1/4 w-72 h-72 bg-secondary rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse">
            </div>
            <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-accent rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-6 py-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-7 max-w-2xl order-2 lg:order-1 space-y-8">

                    <span
                        class="inline-flex items-center bg-secondary text-white border border-secondary px-5 py-2 rounded-full text-sm font-semibold mb-6 transition-colors duration-300 shadow-md hover:bg-secondary_hover">
                        <i class="fas fa-landmark mr-2"></i>
                        Biblioteka „Veljko Petrović"
                    </span>

                    <h1
                        class="text-5xl md:text-6xl font-heading font-extrabold leading-snug mb-6 text-shadow-custom text-surface">
                        <span class="block text-surface">Otkrijte svet</span>
                        <span
                            class="block bg-gradient-to-r from-secondary to-accent bg-clip-text text-transparent mt-1">
                            pisane reči.
                        </span>
                    </h1>

                    <p class="text-xl text-surface leading-relaxed font-light mb-8 text-shadow-custom">
                        Stolećima inspirišemo, obrazujemo i povezujemo ljude kroz moć pisane reči, otvarajući vrata
                        novim svetovima znanja.
                    </p>

                    <div
                        class="bg-secondary_background/90 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-secondary_background transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="text-accent">
                                <i class="fas fa-search text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-primary_text">Pretražite katalog</h3>
                                <p class="text-primary_text/80 text-sm">COBISS digitalna baza</p>
                            </div>
                        </div>

                        <div class="relative">
                            <input type="text" placeholder="Unesite naslov, autora ili ključnu reč..."
                                class="w-full px-5 py-3 pr-28 rounded-lg border border-secondary_background focus:border-accent outline-none text-primary_text bg-surface text-base transition-colors shadow-inner" />
                            <button
                                class="absolute right-1.5 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-secondary to-accent text-surface px-4 py-2 rounded-md font-semibold text-sm hover:opacity-90 transition-opacity flex items-center gap-1">
                                <i class="fas fa-arrow-right"></i>
                                <span>Traži</span>
                            </button>
                        </div>

                        <a href="https://plus-legacy.cobiss.net/cobiss/sr/sr/colib/ZABALJ" target="_blank"
                            class="mt-3 block text-accent hover:text-secondary transition-colors duration-300 text-xs font-medium w-fit">
                            Napredna pretraga COBISS
                        </a>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4">
                        <div
                            class="flex flex-col items-center p-4 rounded-xl transition-all duration-300 bg-secondary_background/50 hover:bg-secondary_background/70 hover:shadow-xl cursor-pointer border-t-2 border-transparent hover:border-secondary group">
                            <div
                                class="bg-secondary p-3 rounded-full mb-2 transition-colors duration-300 group-hover:bg-secondary_hover group-hover:scale-105">
                                <i class="fas fa-book-reader text-white text-xl"></i>
                            </div>
                            <span class="text-primary_text font-medium text-sm text-center">Čitaonice</span>
                        </div>

                        <div
                            class="flex flex-col items-center p-4 rounded-xl transition-all duration-300 bg-secondary_background/50 hover:bg-secondary_background/70 hover:shadow-xl cursor-pointer border-t-2 border-transparent hover:border-accent group">
                            <div
                                class="bg-accent p-3 rounded-full mb-2 transition-colors duration-300 group-hover:bg-accent_hover group-hover:scale-105">
                                <i class="fas fa-theater-masks text-white text-xl"></i>
                            </div>
                            <span class="text-primary_text font-medium text-sm text-center">Kulturni programi</span>
                        </div>

                        <div
                            class="flex flex-col items-center p-4 rounded-xl transition-all duration-300 bg-secondary_background/50 hover:bg-secondary_background/70 hover:shadow-xl cursor-pointer border-t-2 border-transparent hover:border-secondary group">
                            <div
                                class="bg-secondary p-3 rounded-full mb-2 transition-colors duration-300 group-hover:bg-secondary_hover group-hover:scale-105">
                                <i class="fas fa-laptop text-white text-xl"></i>
                            </div>
                            <span class="text-primary_text font-medium text-sm text-center">Digitalna zbirka</span>
                        </div>

                        <div
                            class="flex flex-col items-center p-4 rounded-xl transition-all duration-300 bg-secondary_background/50 hover:bg-secondary_background/70 hover:shadow-xl cursor-pointer border-t-2 border-transparent hover:border-accent group">
                            <div
                                class="bg-accent p-3 rounded-full mb-2 transition-colors duration-300 group-hover:bg-accent_hover group-hover:scale-105">
                                <i class="fas fa-child text-white text-xl"></i>
                            </div>
                            <span class="text-primary_text font-medium text-sm text-center">Dečji program</span>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-5 relative flex items-center justify-center order-1 lg:order-2 h-[550px]">
                    <div class="relative w-full h-full flex items-center justify-center">

                        <div
                            class="absolute -top-10 lg:-top-16 left-1/2 transform -translate-x-1/2 bg-surface p-5 rounded-xl shadow-2xl border-l-4 border-secondary max-w-sm z-40">
                            <p class="text-primary_text text-lg italic leading-relaxed mb-3">
                                "Biblioteka je čarobno mesto gde svaka knjiga otvara vrata u novi svet."
                            </p>
                            <p class="font-bold text-secondary text-sm text-right">
                                — Neil Gaiman
                            </p>
                        </div>

                        <div class="relative mt-20" style="perspective: 1000px;">

                            <div
                                class="absolute top-8 -right-4 w-60 h-80 bg-gray-300 rounded-lg shadow-xl transform rotate-3 transition-all duration-500 z-10">
                                <div class="p-6 h-full flex flex-col justify-between">
                                    <div class="text-primary_text/50 font-bold text-sm">ISTORIJA</div>
                                    <div class="space-y-2">
                                        <div class="w-full h-1.5 bg-primary_text/20 rounded"></div>
                                        <div class="w-4/5 h-1.5 bg-primary_text/20 rounded"></div>
                                    </div>
                                </div>
                                <div class="absolute inset-0 border border-white/20 rounded-lg"></div>
                            </div>

                            <div class="relative mt-20" style="perspective: 1500px;">
                                <div
                                    class="absolute -top-4 -left-20 w-72 h-[360px] bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg shadow-2xl transform -rotate-12 transition-all duration-500 z-10 opacity-75">
                                    <div class="p-8 h-full flex flex-col justify-between">
                                        <div class="text-white/60 font-bold text-sm tracking-widest">ROMAN</div>
                                        <div class="space-y-3">
                                            <div class="w-full h-2 bg-white/30 rounded"></div>
                                            <div class="w-4/5 h-2 bg-white/30 rounded"></div>
                                            <div class="w-3/5 h-2 bg-white/30 rounded"></div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute -top-8 -right-20 w-72 h-[360px] bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg shadow-2xl transform rotate-12 transition-all duration-500 z-10 opacity-75">
                                    <div class="p-8 h-full flex flex-col justify-between">
                                        <div class="text-white/60 font-bold text-sm tracking-widest">BIOGRAFIJA</div>
                                        <div class="space-y-3">
                                            <div class="w-full h-2 bg-white/30 rounded"></div>
                                            <div class="w-4/5 h-2 bg-white/30 rounded"></div>
                                            <div class="w-3/5 h-2 bg-white/30 rounded"></div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute top-0 left-1/2 transform -translate-x-1/2 w-80 h-[400px] bg-gradient-to-br from-blue-400 to-teal-500 rounded-lg shadow-2xl transition-all duration-500 z-20 opacity-85">
                                    <div class="p-8 h-full flex flex-col justify-between">
                                        <div class="text-white/70 font-bold text-base tracking-widest">KLASICI</div>
                                        <div class="space-y-3">
                                            <div class="w-full h-2 bg-white/40 rounded"></div>
                                            <div class="w-5/6 h-2 bg-white/40 rounded"></div>
                                            <div class="w-4/6 h-2 bg-white/40 rounded"></div>
                                            <div class="w-3/6 h-2 bg-white/40 rounded"></div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="relative w-96 h-[480px] bg-gradient-to-br from-secondary to-accent rounded-lg shadow-2xl transform hover:scale-[1.05] transition-all duration-500 z-30 group">
                                    <div class="p-10 h-full flex flex-col justify-between">
                                        <div>
                                            <div class="text-surface font-bold text-xl mb-6 tracking-widest">KNJIŽEVNOST
                                            </div>
                                            <i class="fas fa-book-open text-surface text-6xl opacity-95"></i>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="w-full h-2.5 bg-surface opacity-80 rounded"></div>
                                            <div class="w-5/6 h-2.5 bg-surface opacity-80 rounded"></div>
                                            <div class="w-4/6 h-2.5 bg-surface opacity-80 rounded"></div>
                                            <div class="w-3/6 h-2.5 bg-surface opacity-80 rounded"></div>
                                            <div class="w-2/6 h-2.5 bg-surface opacity-80 rounded"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-surface px-5 py-2 rounded-full shadow-xl border border-secondary_background z-40">
                                <span class="text-primary_text font-semibold text-sm flex items-center">
                                    <i class="fas fa-heart mr-2 text-accent"></i>
                                    Srce zajednice
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-6 h-10 rounded-full border border-secondary flex justify-center p-0.5">
                <div class="w-1 h-1 bg-secondary rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>
    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-secondary_background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Predstojeći Događaji
                    <span
                        class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></span>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-4">
                    Istražite našu bogatu ponudu kulturnih događaja koji će vas inspirisati i zabaviti
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <article
                        class="news-card bg-surface rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 max-w-3xl mx-auto flex flex-col md:flex-row overflow-hidden">

                        <!-- Slika -->
                        <div class="w-full md:w-1/3 relative flex-shrink-0 h-64 md:h-auto">
                            <img id="g-image"
                                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                                alt="Vest slika"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div
                                class="absolute top-3 left-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold shadow-md uppercase tracking-wide">
                                Vest
                            </div>
                        </div>

                        <!-- Tekstualni deo -->
                        <div class="w-full md:w-2/3 p-6 flex flex-col justify-between">
                            <div class="mb-4">
                                <h3 id="g-naslov"
                                    class="text-xl md:text-2xl font-heading font-bold text-primary_text hover:text-accent transition-colors duration-300 mb-2 line-clamp-2">
                                    Gostovanje poznatog pisca i književna radionica
                                </h3>

                                <p id="g-opis"
                                    class="text-secondary_text text-sm md:text-base leading-relaxed line-clamp-3 mb-3">
                                    U velikoj sali Biblioteke održano je gostovanje poznatog pisca uz interaktivnu književnu
                                    radionicu za sve
                                    ljubitelje savremene proze.
                                </p>
                            </div>


                            <!-- Dugme -->
                            <div>
                                <a id="g-ovise" href="#"
                                    class="bg-accent text-white font-bold py-2 px-6 rounded-lg hover:bg-accent_hover transition-colors duration-300 text-sm inline-block text-center w-full md:w-auto">
                                    Pročitaj više
                                </a>
                            </div>
                        </div>
                    </article>

                <?php endfor; ?>
            </div>
            <div class="text-center mt-12">
                <a href="/aktivnosti/dogadjaji" id="eventsView"
                    class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center justify-center shadow-lg mx-auto max-w-xs w-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </a>
            </div>
        </div>
    </section>

    <section id="vesti" class="py-20 bg-gradient-to-br from-secondary_background to-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Najnovije Vesti
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent via-primary to-secondary rounded-full">
                    </div>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6">
                    Budite u toku sa najnovijim dešavanjima iz sveta kulture, obrazovanja i inovacija
                </p>
            </div>

            <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <article
                        class="news-card bg-surface rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 max-w-3xl mx-auto flex flex-col md:flex-row overflow-hidden">

                        <!-- Slika -->
                        <div class="w-full md:w-1/3 relative flex-shrink-0 h-64 md:h-auto">
                            <img id="g-image"
                                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                                alt="Vest slika"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div
                                class="absolute top-3 left-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold shadow-md uppercase tracking-wide">
                                <p id="g-naziv">asd</p>
                            </div>
                        </div>

                        <!-- Tekstualni deo -->
                        <div class="w-full md:w-2/3 p-6 flex flex-col justify-between">
                            <div class="mb-4">
                                <h3 id="g-naslov"
                                    class="text-xl md:text-2xl font-heading font-bold text-primary_text hover:text-accent transition-colors duration-300 mb-2 line-clamp-2">
                                    Gostovanje poznatog pisca i književna radionica
                                </h3>

                                <p id="g-opis"
                                    class="text-secondary_text text-sm md:text-base leading-relaxed line-clamp-3 mb-3">
                                    U velikoj sali Biblioteke održano je gostovanje poznatog pisca uz interaktivnu književnu
                                    radionicu za sve
                                    ljubitelje savremene proze.
                                </p>
                            </div>


                            <!-- Dugme -->
                            <div>
                                <a id="g-ovise" href="#"
                                    class="bg-accent text-white font-bold py-2 px-6 rounded-lg hover:bg-accent_hover transition-colors duration-300 text-sm inline-block text-center w-full md:w-auto">
                                    Pročitaj više
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>
            </div>

            <div class="text-center mt-16">
                <button id="vestiView"
                    class="bg-gradient-to-r from-primary via-primary_hover to-primary text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center mx-auto group shadow-xl">
                    <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform"></i>
                    Pogledaj sve vesti
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </button>
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
    <footer class="bg-secondary text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">

                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-dumbbell text-xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-heading font-bold">Sportski objekti</h3>
                            <p class="text-xs text-accent tracking-widest font-oswald">JAVNA USTANOVA</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Vodeći sportski centar sa najsavremenijom opremom, profesionalnim trenerima i raznovrsnim
                        programima za sve uzraste i nivoe.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-heading font-bold mb-6 text-accent">BRZI LINKOVI</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Početna</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> O nama</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Sportovi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Članstvo</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Dokumenti</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Kontakt</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-heading font-bold mb-6 text-accent">KONTAKT</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary mr-3 mt-1"></i>
                            <span class="text-gray-300">Sportska 15, 11000 Beograd</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-primary mr-3"></i>
                            <span class="text-gray-300">+381 11 123 4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-primary mr-3"></i>
                            <span class="text-gray-300">info@sportskiobjekti.rs</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-primary mr-3"></i>
                            <span class="text-gray-300">Pon-Ned: 06:00 - 23:00</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div
                class="border-t border-primary/10 pt-6 mt-6 flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="text-xs opacity-80 md:w-3/5 order-2 md:order-1 text-center md:text-left">
                    <p class="mb-2">© 2023 Javna ustanova "Sportski objekti". Sva prava zadržana.</p>
                    <div class="flex items-center justify-center md:justify-start gap-3 mt-3">
                        <p>
                            Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno
                            zvanični stav Vlade Švajcarske.
                        </p>
                    </div>
                </div>

                <div class="flex items-center order-1 md:order-2">
                    <img src="/assets/img/SECO-logo-640px-white.png" alt="SECO Logo"
                        class="h-15 md:h-15 object-contain hover:scale-105 transition-transform duration-300" />
                </div>
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

        if (searchButton && searchInputContainer) {
            searchButton.addEventListener('click', () => {
                searchInputContainer.classList.toggle('hidden');
            });
        }

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
            }, 10);
        }

        function closeMobileMenuFn() {
            mobileMenuPanel.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', openMobileMenu);
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFn);
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFn);
        }

        // Handle mobile dropdowns
        const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
        mobileDropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('div[id$="Menu"]');
            const icon = dropdown.querySelector('i[id$="Icon"]');

            if (button && menu && icon) {
                button.addEventListener('click', () => {
                    const isExpanded = menu.classList.contains('hidden');

                    // Close all other dropdowns
                    mobileDropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('div[id$="Menu"]');
                            const otherIcon = otherDropdown.querySelector('i[id$="Icon"]');
                            if (otherMenu && !otherMenu.classList.contains('hidden')) {
                                otherMenu.classList.add('hidden');
                                otherIcon?.classList.remove('rotate-180');
                            }
                        }
                    });

                    // Toggle current dropdown
                    menu.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            }
        });

        // Handle resize events to ensure proper menu state
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1713) { // 2xl breakpoint
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                mobileMenuPanel.classList.add('translate-x-full');
            }
        });

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

        // Nav link hover effect
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link) {
                link.addEventListener('mouseenter', () => {
                    link.classList.add('hover-effect');
                });
                link.addEventListener('mouseleave', () => {
                    link.classList.remove('hover-effect');
                });
            }
        });
    </script>
</body>

</html>