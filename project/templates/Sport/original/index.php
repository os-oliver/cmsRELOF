<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportski Centar Arena - Profesionalni sportski objekat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@300;400;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E40AF',
                        primary_hover: '#1E3A8A',
                        secondary: '#0F4C75',
                        secondary_hover: '#0B3B5B',
                        accent: '#F59E0B',
                        accent_hover: '#D97706',
                        primary_text: '#1F2937',
                        secondary_text: '#4B5563',
                        background: '#F9FAFB',
                        surface: '#F3F4F6',
                    },
                    fontFamily: {
                        'heading': ['Bebas Neue', 'sans-serif'],
                        'heading2': ['Oswald', 'sans-serif'],
                        'body': ['Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #F9FAFB;
            color: #1F2937;
        }

        .font-display {
            font-family: 'Bebas Neue', sans-serif;
        }

        .font-oswald {
            font-family: 'Oswald', sans-serif;
        }

        .nav-link {
            position: relative;
            padding-bottom: 5px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: #1E40AF;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(30, 64, 175, 0.3);
        }

        .energy-pulse {
            animation: pulse-energy 2s ease-in-out infinite;
        }

        @keyframes pulse-energy {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(10px);
            z-index: 20;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1E40AF, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Gradient background with figures */
        .gradient-figures {
            background: linear-gradient(135deg, #0F4C75 0%, #1E293B 50%, #0F172A 100%);
            position: relative;
            overflow: hidden;
        }

        .gradient-figures::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 20% 80%, rgba(30, 64, 175, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(30, 64, 175, 0.08) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(-5%, -5%) rotate(5deg);
            }

            50% {
                transform: translate(5%, 5%) rotate(-5deg);
            }

            75% {
                transform: translate(-5%, 5%) rotate(5deg);
            }
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 220px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.15);
            z-index: 100;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #E5E7EB;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            color: #1F2937;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            border-bottom: 1px solid #F3F4F6;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #F3F4F6;
            color: #1E40AF;
        }

        /* Professional section styling */
        .professional-section {
            background: linear-gradient(135deg, #FFFFFF 0%, #F9FAFB 100%);
        }

        .professional-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .professional-card:hover {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        /* Mobile dropdown animation */
        .mobile-dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-dropdown-menu.show {
            max-height: 500px;
            opacity: 1;
        }

        .mobile-dropdown-icon {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
        }

        .mobile-dropdown-open .mobile-dropdown-icon {
            transform: rotate(180deg);
        }

        /* Prevent body scroll when mobile menu is open */
        body.mobile-menu-open {
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-[999] lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-70" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-heading text-primary_text">MENU</h2>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>

                    <!-- O nama dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-secondary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 mobile-dropdown-menu" id="mobileAboutMenu">
                            <a data-page="Uvod" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-flag mr-2 text-secondary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-history mr-2 text-accent"></i>Istorijat
                            </a>
                            <a data-page="Organizaciona struktura" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-users-cog mr-2 text-secondary"></i>Organizaciona struktura
                            </a>
                            <a data-page="Informacije" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-info-circle mr-2 text-accent"></i>Informacije
                            </a>
                            <a data-page="Pitanja" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-question-circle mr-2 text-secondary"></i>Pitanja
                            </a>
                            <a data-page="Organi upravljanja" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-gavel mr-2 text-primary"></i>Organi upravljanja
                            </a>
                        </div>
                    </div>



                    <!-- Ponuda dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileOfferToggle">
                            <div class="flex items-center">
                                <i class="fas fa-medal mr-3 text-secondary"></i>Ponuda
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                id="mobileOfferIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 mobile-dropdown-menu" id="mobileOfferMenu">
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-basketball-ball mr-2 text-primary"></i>Sportovi
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-building mr-2 text-secondary"></i>Objekti
                            </a>
                        </div>
                    </div>

                    <a data-page="Galerija" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-secondary"></i>Galerija
                    </a>

                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-accent"></i>Dokumenti
                    </a>

                    <!-- Aktivnosti dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileActivitiesToggle">
                            <div class="flex items-center">
                                <i class="fas fa-bullhorn mr-3 text-primary"></i>Aktivnosti
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                id="mobileActivitiesIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 mobile-dropdown-menu" id="mobileActivitiesMenu">
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-newspaper mr-2 text-primary"></i>Vesti
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-poll mr-2 text-accent"></i>Ankete
                            </a>
                        </div>
                    </div>

                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-phone mr-3 text-secondary"></i>Kontakt
                    </a>

                    <!-- Language Selector -->
                    <!-- Language Selector -->
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="mobile-dropdown mobile-language">
                            <button
                                class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                                id="mobileLanguageToggle">
                                <div class="flex items-center">
                                    <i class="fas fa-globe mr-3 text-secondary"></i>Jezik
                                </div>
                                <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                    id="mobileLanguageIcon"></i>
                            </button>

                            <!-- MENU -->
                            <div class="ml-6 mt-2 space-y-2 mobile-dropdown-menu hidden" id="mobileLanguageMenu">
                                <button data-locale="sr"
                                    class="block w-full text-left px-4 py-2 hover:bg-surface rounded">
                                    Srpski (Latin)
                                </button>

                                <button data-locale="sr-Cyrl"
                                    class="block w-full text-left px-4 py-2 hover:bg-surface rounded">
                                    Српски (Ћирилица)
                                </button>

                                <button data-locale="en"
                                    class="block w-full text-left px-4 py-2 hover:bg-surface rounded">
                                    English
                                </button>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </div>

    <!-- Font size toggle button -->
    <button id="increaseFontBtn"
        class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-bold py-3 px-5 rounded-full shadow-2xl focus:outline-none transition-all"
        aria-label="Increase font size">
        A+
    </button>

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="w-full mx-auto px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-lg energy-pulse">
                    <i class="fas fa-dumbbell text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-heading font-bold text-secondary tracking-wide">SPORTSKI ARENA</h1>
                    <p class="text-xs text-primary tracking-widest font-oswald uppercase">Profesionalni Sportski Objekat
                    </p>
                </div>
            </div>

            <nav id="navBarID" class="hidden lg:flex space-x-6 items-center">
                <a href="#"
                    class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                    <i class="fas fa-home mr-2 text-base"></i>Početna
                </a>

                <div class="dropdown group relative">
                    <button
                        class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                        <i class="fas fa-info-circle mr-2 text-base"></i>O nama <i
                            class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 hidden group-hover:block transition-all duration-300 ease-out origin-top">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-book mr-2 text-primary"></i>Uvod
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-flag mr-2 text-secondary"></i>Misija i vizija
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-history mr-2 text-accent"></i>Istorijat
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-users-cog mr-2 text-secondary"></i>Organizaciona struktura
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-info-circle mr-2 text-accent"></i>Informacije
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-question-circle mr-2 text-secondary"></i>Pitanja
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-gavel mr-2 text-primary"></i>Organi upravljanja
                        </a>
                    </div>
                </div>

                <div class="dropdown group relative">
                    <button
                        class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                        <i class="fas fa-medal mr-2 text-base"></i>Ponuda <i
                            class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 hidden group-hover:block transition-all duration-300 ease-out origin-top">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-basketball-ball mr-2 text-primary"></i>Sportovi
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-building mr-2 text-secondary"></i>Objekti </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                    <i class="fas fa-images mr-2 text-base"></i>Galerija
                </a>

                <a href="#"
                    class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                    <i class="fas fa-folder-open mr-2 text-base"></i>Dokumenti
                </a>

                <div class="dropdown group relative">
                    <button
                        class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                        <i class="fas fa-bullhorn mr-2 text-primary text-base"></i>Aktivnosti
                        <i
                            class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 hidden group-hover:block transition-all duration-300 ease-out origin-top">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-newspaper mr-2 text-primary"></i>Vesti
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150">
                            <i class="fas fa-poll mr-2 text-accent"></i>Ankete
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-secondary font-medium text-sm flex items-center hover:text-primary transition-colors py-2">
                    <i class="fas fa-phone mr-2 text-base"></i>Kontakt
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
                <div class="locale dropdown group relative">
                    <button
                        class="text-secondary font-medium text-sm hover:text-primary transition-all duration-200 flex items-center px-3 py-1.5 rounded-lg hover:bg-gray-50">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0 min-w-max bg-white rounded-xl shadow-2xl border border-gray-100 z-50 py-2 hidden group-hover:block transition-all duration-300 ease-out origin-top">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                                class="dropdown-item flex items-center px-4 py-2 hover:bg-gray-50 text-sm whitespace-nowrap transition-colors duration-150 rounded-lg mx-1">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium text-secondary"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>

            <div class="flex items-center space-x-3 relative">
                <button id="searchButton"
                    class="text-secondary hover:text-primary transition-colors focus:outline-none p-2 rounded-full hover:bg-gray-50"
                    aria-label="Search">
                    <i class="fas fa-search text-base"></i>
                </button>
                <div id="searchInputContainer"
                    class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">
                    <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
                        <input type="text" name="q" placeholder="Pretražite sadržaj..."
                            class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-4 py-2 text-primary_text placeholder-gray-400 bg-gray-50 rounded-lg"
                            id="searchInput" required />
                        <div class="flex items-center space-x-1 ml-2">
                            <button type="submit"
                                class="text-secondary hover:text-primary transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"
                                aria-label="Submit search">
                                <i class="fas fa-search text-xs"></i>
                            </button>
                            <button type="button"
                                class="text-secondary hover:text-accent transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"
                                id="closeSearch" aria-label="Close search">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <button id="hamburger"
                    class="hamburger lg:hidden text-secondary w-7 h-7 flex flex-col justify-around p-1">
                    <span class="block w-full h-0.5 bg-secondary rounded"></span>
                    <span class="block w-full h-0.5 bg-secondary rounded"></span>
                    <span class="block w-full h-0.5 bg-secondary rounded"></span>
                </button>
            </div>
        </div>
    </header>

    <section class="relative min-h-screen flex items-center overflow-hidden pt-20 gradient-figures">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-secondary via-transparent to-primary opacity-20"></div>

        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <span
                        class="inline-block bg-accent text-secondary px-6 py-2 rounded-full text-sm font-bold mb-6 shadow-lg">
                        <i class="fas fa-city mr-2"></i>JAVNA USTANOVA OPŠTINE ŽABALJ
                    </span>

                    <h1 class="text-6xl md:text-7xl font-heading font-bold leading-tight text-white mb-6">
                        <span class="block">SRCE SPORTA</span>
                        <span class="block text-accent mt-2">U OPŠTINI ŽABALJ</span>
                    </h1>

                    <div class="mb-10">
                        <p class="text-xl text-white leading-relaxed mb-6 font-medium">
                            Brinemo o održavanju, razvoju i dostupnosti sportske infrastrukture – od stadiona do
                            školskih
                            sala, čineći sport sastavnim delom života naše zajednice.
                        </p>
                        <p class="text-white italic text-lg border-l-4 border-accent pl-4">
                            "Sportski objekti su temelj za zdrav život i okupljanje svih generacija Žablja."
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <button
                            class="bg-primary hover:bg-primary_hover text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl transition-all transform hover:scale-105">
                            <i class="fas fa-map-marker-alt mr-2"></i>Vidi Lokacije Objekata
                        </button>
                        <button
                            class="border-3 border-accent text-accent hover:bg-accent hover:text-white px-8 py-4 rounded-full font-bold text-lg transition-all">
                            <i class="fas fa-file-alt mr-2"></i>Statut Ustanove
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="stat-number font-heading">4+</div>
                            <p class="text-white font-semibold uppercase text-sm">Velika Objekta</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">20+</div>
                            <p class="text-white font-semibold uppercase text-sm">Godišnjih Manifestacija</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">1000+</div>
                            <p class="text-white font-semibold uppercase text-sm">Korisnika Mesečno</p>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div
                                class="h-64 bg-gradient-to-br from-primary to-secondary rounded-2xl shadow-2xl transform rotate-3">
                            </div>
                            <div
                                class="h-48 bg-gradient-to-br from-accent to-primary rounded-2xl shadow-2xl transform -rotate-2">
                            </div>
                        </div>
                        <div class="space-y-4 mt-8">
                            <div
                                class="h-48 bg-gradient-to-br from-secondary to-primary rounded-2xl shadow-2xl transform -rotate-3">
                            </div>
                            <div
                                class="h-64 bg-gradient-to-br from-primary to-accent rounded-2xl shadow-2xl transform rotate-2">
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-white rounded-full flex items-center justify-center shadow-2xl">
                        <div class="text-center p-8">
                            <i class="fas fa-users text-6xl text-primary mb-4"></i>
                            <h3 class="font-heading text-2xl font-bold text-primary_text">ZAJEDNICA</h3>
                            <p class="text-secondary_text mt-2 font-medium">Mesto okupljanja i rekreacije</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
                <div class="animate-bounce w-10 h-16 rounded-full border-3 border-accent flex justify-center p-2">
                    <div class="w-2 h-2 bg-accent rounded-full animate-pulse"></div>
                </div>
            </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 professional-section">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-4">
                    O NAMA
                </span>
                <h2 class="text-5xl font-heading font-bold text-primary_text mb-4">
                    NAŠA MISIJA I VIZIJA
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto font-medium">
                    Posvećeni smo razvoju sporta i podsticanju zdravog načina života kroz vrhunske uslove i
                    profesionalne programe
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="professional-card p-8 text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bullseye text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Misija</h3>
                    <p class="text-secondary_text">
                        Naša misija je da kroz kvalitetne sportske programe i vrhunske uslove podstaknemo ljude svih
                        uzrasta na fizičku aktivnost i zdrav način života.
                    </p>
                </div>

                <div class="professional-card p-8 text-center">
                    <div class="w-20 h-20 bg-accent rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-eye text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Vizija</h3>
                    <p class="text-secondary_text">
                        Težimo ka tome da postanemo vodeći regionalni sportski centar prepoznat po izuzetnim uslovima,
                        stručnom kadru i rezultatima naših sportista.
                    </p>
                </div>

                <div class="professional-card p-8 text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-star text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Vrednosti</h3>
                    <p class="text-secondary_text">
                        Poštujemo timski rad, poštenje, posvećenost i kontinuirani napredak. Verujemo da sport gradi
                        karakter i podstiče pozitivne životne navike.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section id="Objekti" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-4">
                    SPORTSKI OBJEKTI
                </span>
                <h2 class="text-5xl font-heading font-bold text-primary_text mb-4">
                    NAŠI OBJEKTI
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto font-medium">
                    Sportski objekti dostupni za sve aktivnosti i događaje
                </p>
            </div>

            <div id="ObjektiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // Primer podataka - u realnoj aplikaciji bi ovo došlo iz baze
                $objekti = [
                    [
                        'slika' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
                        'nazivObjekta' => 'Sportska hala',
                        'adresa' => 'Ulica Sportista 1',
                        'radnoVreme' => 'Pon-Ned 08:00-22:00',
                        'kapacitet' => 500,
                        'opis' => 'Moderna hala za razne sportove i događaje.'
                    ],
                    [
                        'slika' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80',
                        'nazivObjekta' => 'Fudbalski stadion',
                        'adresa' => 'Stadionska 5',
                        'radnoVreme' => 'Pon-Ned 09:00-20:00',
                        'kapacitet' => 2000,
                        'opis' => 'Stadion sa tribinama i modernom infrastrukturom.'
                    ],
                    [
                        'slika' => 'https://images.unsplash.com/photo-1505843277359-0c2ba7a43dba?auto=format&fit=crop&w=600&q=80',
                        'nazivObjekta' => 'Teniski tereni',
                        'adresa' => 'Teniska 10',
                        'radnoVreme' => 'Pon-Ned 07:00-21:00',
                        'kapacitet' => 100,
                        'opis' => 'Otvoreni i zatvoreni tereni za tenis.'
                    ]
                ];

                foreach ($objekti as $objekat) {
                    echo '

    <style>
      .clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
    </style>

    <div class="card-hover bg-transparent rounded-2xl overflow-hidden shadow-2xl border border-gray-100 max-w-sm">
      <div class="relative h-64 overflow-hidden rounded-2xl">
        <img id="g-slika" src="' . $objekat['slika'] . '" alt="' . $objekat['nazivObjekta'] . '"
             class="w-full h-full object-cover transition-transform duration-700 transform hover:scale-110">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent pointer-events-none"></div>

        <div class="absolute left-4 right-4 bottom-4 p-4 rounded-xl backdrop-blur-md bg-white/10 border border-white/10 text-white">
          <div class="flex items-start justify-between gap-3">
            <div class="flex-1">
              <h3 id="g-nazivObjekta" class="text-lg md:text-2xl font-heading font-bold leading-tight">
                ' . $objekat['nazivObjekta'] . '
              </h3>
              <p class="mt-1 text-sm text-gray-100/90">
                <i class="fas fa-map-marker-alt mr-2"></i>' . $objekat['adresa'] . '
              </p>
              
            </div>
            <div class="flex-shrink-0 ml-3 self-center">
              <a href="#"
              id="g-ovise"
                 class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold
                        bg-gradient-to-r from-primary to-primary_hover shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Više</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

                ';
                }
                ?>
            </div>

            <div class="text-center mt-12">
                <a href="/ponuda/objekti"
                    class="bg-secondary text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-secondary_hover transition-all shadow-xl transform hover:scale-105 inline-flex items-center justify-center">
                    <i class="fas fa-th-large mr-3"></i>Svi Objekti
                </a>


            </div>
        </div>
    </section>
    <section id="vesti" class="py-20 bg-gradient-to-br from-surface to-background">
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
                        class="bg-secondary_background rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                        <div class="h-56 relative overflow-hidden">
                            <img id="g-slika"
                                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                                alt="Vest"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary_text/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-accent to-accent_hover flex items-center justify-center text-white shadow-md">
                                    <i class="fas fa-newspaper text-lg"></i>
                                </div>
                                <div class="flex items-center text-sm text-secondary_text">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span id="g-datum">15. Oktobar 2025</span>
                                </div>
                            </div>

                            <h3 id="g-naslov"
                                class="text-xl font-heading font-bold text-primary_text mb-3 group-hover:text-accent transition-colors line-clamp-2">
                                Novi kulturni centar otvara vrata građanima
                            </h3>
                            <p id="g-opis" class="text-secondary_text mb-5 line-clamp-3 leading-relaxed">
                                Nakon dve godine izgradnje, novi kulturni centar spreman je da postane epicentar
                                kreativnosti i umetnosti u našem gradu.
                            </p>
                            <a id="g-ovise" href="#"
                                class="inline-flex items-center text-accent font-semibold hover:gap-3 gap-2 transition-all group/link">
                                Pročitaj više
                                <i class="fas fa-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
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

                <div class="flex items-center order-1 md:order-1">
                    <img src="/assets/img/SECO-logo-640px-white.png" alt="SECO Logo"
                        class="h-15 md:h-15 object-contain hover:scale-105 transition-transform duration-300" />
                </div>

                <div class="text-xs opacity-80 md:w-3/5 order-2 md:order-2 text-center md:text-left">
                    <p class="mb-2">© 2023 Javna ustanova "Sportski objekti". Sva prava zadržana.</p>
                    <div class="flex items-center justify-center md:justify-start gap-3 mt-3">
                        <p>
                            Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno
                            zvanični stav Vlade Švajcarske.
                        </p>
                    </div>
                </div>
            </div>
    </footer>

    <script>
        // Modern Mobile Menu with improved logic
        document.addEventListener('DOMContentLoaded', function () {
            const langToggle = document.getElementById("mobileLanguageToggle");
            const langMenu = document.getElementById("mobileLanguageMenu");
            const langIcon = document.getElementById("mobileLanguageIcon");

            langToggle.addEventListener("click", () => {
                langMenu.classList.toggle("hidden");
                langIcon.classList.toggle("rotate-180");
            });

            // Handle locale selection
            document.querySelectorAll("#mobileLanguageMenu button").forEach(btn => {
                btn.addEventListener("click", () => {
                    const locale = btn.getAttribute("data-locale");

                    // Create new URL and update locale param while keeping all others
                    const url = new URL(window.location);
                    url.searchParams.set("locale", locale);

                    // Redirect
                    window.location = url.toString();
                });
            });
            // ============================================
            // MOBILE MENU - OPEN/CLOSE FUNCTIONALITY
            // ============================================
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            const body = document.body;

            const openMobileMenu = () => {
                mobileMenu.classList.remove('hidden');
                // Trigger reflow za animation
                void mobileMenuPanel.offsetWidth;
                mobileMenuPanel.classList.remove('translate-x-full');
                body.classList.add('mobile-menu-open');
            };

            const closeMobileMenuFn = () => {
                mobileMenuPanel.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    body.classList.remove('mobile-menu-open');
                }, 300);
            };

            if (hamburger && mobileMenu && closeMobileMenu && mobileMenuOverlay) {
                hamburger.addEventListener('click', openMobileMenu);
                closeMobileMenu.addEventListener('click', closeMobileMenuFn);
                mobileMenuOverlay.addEventListener('click', closeMobileMenuFn);

                // Close menu kada klikneš na link
                const mobileLinks = document.querySelectorAll('#navBarIDm a:not([href^="#"])');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', closeMobileMenuFn);
                });
            }

            // ============================================
            // MOBILE DROPDOWN - TOGGLE FUNCTIONALITY
            // ============================================
            const setupMobileDropdown = (toggleId, menuId, iconId) => {
                const toggle = document.getElementById(toggleId);
                const menu = document.getElementById(menuId);
                const icon = document.getElementById(iconId);

                if (!toggle || !menu || !icon) return;

                toggle.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Get parent dropdown element
                    const dropdownContainer = toggle.closest('.mobile-dropdown');

                    // Toggle current menu
                    const isOpen = menu.classList.contains('show');

                    if (isOpen) {
                        // Zatvori trenutni dropdown
                        menu.classList.remove('show');
                        dropdownContainer.classList.remove('mobile-dropdown-open');
                    } else {
                        // Zatvori sve druge dropdowne
                        document.querySelectorAll('.mobile-dropdown-menu.show').forEach(openMenu => {
                            openMenu.classList.remove('show');
                            openMenu.closest('.mobile-dropdown')?.classList.remove('mobile-dropdown-open');
                        });

                        // Otvori trenutni dropdown
                        menu.classList.add('show');
                        dropdownContainer.classList.add('mobile-dropdown-open');
                    }
                });
            };

            // Setup svi dropdowni
            setupMobileDropdown('mobileAboutToggle', 'mobileAboutMenu', 'mobileAboutIcon');
            setupMobileDropdown('mobileAutoToggle', 'mobileAutoMenu', 'mobileAutoIcon');
            setupMobileDropdown('mobileOfferToggle', 'mobileOfferMenu', 'mobileOfferIcon');
            setupMobileDropdown('mobileActivitiesToggle', 'mobileActivitiesMenu', 'mobileActivitiesIcon');
            setupMobileDropdown('mobileLanguageToggle', 'mobileLanguageMenu', 'mobileLanguageIcon');

            // ============================================
            // FONT SIZE TOGGLE
            // ============================================
            const increaseFontBtn = document.getElementById('increaseFontBtn');
            let fontSizeIncreased = false;

            if (increaseFontBtn) {
                increaseFontBtn.addEventListener('click', () => {
                    const elements = document.querySelectorAll('body, p, span, a, button, li, h1, h2, h3, h4, h5, h6');

                    if (!fontSizeIncreased) {
                        elements.forEach(el => {
                            const currentSize = window.getComputedStyle(el).fontSize;
                            const newSize = parseFloat(currentSize) * 1.2;
                            el.style.fontSize = `${newSize}px`;
                        });
                        fontSizeIncreased = true;
                        increaseFontBtn.innerHTML = '<i class="fas fa-minus"></i>';
                        increaseFontBtn.setAttribute('aria-label', 'Decrease font size');
                    } else {
                        elements.forEach(el => {
                            el.style.fontSize = '';
                        });
                        fontSizeIncreased = false;
                        increaseFontBtn.innerHTML = 'A+';
                        increaseFontBtn.setAttribute('aria-label', 'Increase font size');
                    }
                });
            }

            // ============================================
            // SEARCH FUNCTIONALITY
            // ============================================
            const searchButton = document.getElementById('searchButton');
            const searchInputContainer = document.getElementById('searchInputContainer');
            const searchInput = document.getElementById('searchInput');
            const closeSearch = document.getElementById('closeSearch');

            if (searchButton && searchInputContainer) {
                searchButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    searchInputContainer.classList.remove('hidden');
                    setTimeout(() => {
                        searchInputContainer.classList.remove('opacity-0');
                        searchInput?.focus();
                    }, 10);
                });

                if (closeSearch) {
                    closeSearch.addEventListener('click', () => {
                        searchInputContainer.classList.add('opacity-0');
                        setTimeout(() => {
                            searchInputContainer.classList.add('hidden');
                        }, 300);
                    });
                }

                // Close search kada klikneš van
                document.addEventListener('click', (e) => {
                    if (!searchInputContainer.contains(e.target) && !searchButton.contains(e.target)) {
                        searchInputContainer.classList.add('opacity-0');
                        setTimeout(() => {
                            searchInputContainer.classList.add('hidden');
                        }, 300);
                    }
                });
            }

            // ============================================
            // SMOOTH SCROLLING
            // ============================================
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');

                    // Preskoči ako je samo "#"
                    if (href === '#') return;

                    e.preventDefault();
                    const targetElement = document.querySelector(href);

                    if (targetElement) {
                        // Zatvori mobile menu ako je otvoren
                        if (!mobileMenu.classList.contains('hidden')) {
                            closeMobileMenuFn();
                        }

                        // Smooth scroll
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // ============================================
            // ESC KEY - Close mobile menu
            // ============================================
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    closeMobileMenuFn();
                }
            });
        });
    </script>
</body>

</html>