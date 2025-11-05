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
            transition: all 0.3s ease;
        }

        .mobile-dropdown-icon {
            transition: transform 0.3s ease;
        }

        .mobile-dropdown-open .mobile-dropdown-icon {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-70" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
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
                        <div class="ml-6 mt-2 space-y-2 hidden mobile-dropdown-menu" id="mobileAboutMenu">
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
                            <a data-page="Rukovodstvo" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-users-cog mr-2 text-secondary"></i>Rukovodstvo
                            </a>
                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                            </a>
                            <a data-page="Donacije i podrška" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-accent"></i>Donacije i podrška
                            </a>
                            <a data-page="Partneri" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-handshake mr-2 text-primary"></i>Partneri
                            </a>
                        </div>
                    </div>

                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileSportsToggle">
                            <div class="flex items-center">
                                <i class="fas fa-basketball-ball mr-3 text-secondary"></i>Sportovi
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                id="mobileSportsIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden mobile-dropdown-menu" id="mobileSportsMenu">
                            <a data-page="Fudbal" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-futbol mr-2 text-primary"></i>Fudbal
                            </a>
                            <a data-page="Košarka" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-basketball-ball mr-2 text-secondary"></i>Košarka
                            </a>
                            <a data-page="Odbojka" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-volleyball-ball mr-2 text-accent"></i>Odbojka
                            </a>
                            <a data-page="Tenis" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-table-tennis mr-2 text-secondary_text"></i>Tenis
                            </a>
                            <a data-page="Plivanje" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-swimmer mr-2 text-accent"></i>Plivanje
                            </a>
                            <a data-page="Atletika" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-running mr-2 text-primary"></i>Atletika
                            </a>
                        </div>
                    </div>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileMembershipToggle">
                            <div class="flex items-center">
                                <i class="fas fa-id-card mr-3 text-secondary"></i>Članstvo
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-icon"
                                id="mobileMembershipIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden mobile-dropdown-menu" id="mobileMembershipMenu">
                            <a data-page="Uslovi upisa" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-file-signature mr-2 text-primary"></i>Uslovi upisa
                            </a>
                            <a data-page="Cenovnik" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-tags mr-2 text-secondary"></i>Cenovnik
                            </a>
                            <a data-page="Pravilnici" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-book-open mr-2 text-accent"></i>Pravilnici
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
                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-secondary"></i>Kontakt
                    </a>

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
    <header class="fixed w-full z-40 py-4 bg-white shadow-lg">
        <div class=" px-4 flex  mx-5 justify-between items-center">
            <div class="flex items-center space-x-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-lg energy-pulse">
                    <i class="fas fa-dumbbell text-3xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-heading font-bold text-secondary tracking-wider">SPORTSKI ARENA</h1>
                    <p class="text-xs text-primary tracking-widest font-oswald">PROFESIONALNI SPORTSKI OBJEKAT</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-8 items-center">
                <a href="#"
                    class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-home mr-2"></i>Početna
                </a>
                <div class="dropdown">
                    <button href="#"
                        class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                        <i class="fas fa-info-circle mr-2"></i>O nama <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-book mr-2 text-primary"></i>Uvod
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-flag mr-2 text-secondary"></i>Misija i vizija
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-history mr-2 text-accent"></i>Istorijat
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users-cog mr-2 text-secondary"></i>Rukovodstvo
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-hand-holding-heart mr-2 text-accent"></i>Donacije i podrška
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-handshake mr-2 text-primary"></i>Partneri
                        </a>
                    </div>
                </div>
                <a href="#"
                    class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-basketball-ball mr-2"></i>Sportovi
                </a>
                <div class="dropdown">
                    <button href="#"
                        class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                        <i class="fas fa-id-card mr-2"></i>Članstvo <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file-signature mr-2 text-primary"></i>Uslovi upisa
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-tags mr-2 text-secondary"></i>Cenovnik
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-book-open mr-2 text-accent"></i>Pravilnici
                        </a>
                    </div>
                </div>
                <a href="#"
                    class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-images mr-2"></i>Galerija
                </a>
                <a href="#"
                    class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-folder-open mr-2"></i>Dokumenti
                </a>
                <div class="dropdown">
                    <button
                        class="nav-link text-primary_text font-semibold flex items-center hover:text-primary transition-colors">
                        <i class="fas fa-bullhorn mr-2 text-primary"></i>
                        Aktivnosti
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item flex items-center">
                            <i class="fas fa-newspaper mr-2 text-primary"></i>
                            Vesti
                        </a>

                        <a href="#" class="dropdown-item flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-secondary"></i>
                            Događaji
                        </a>

                        <a href="#" class="dropdown-item flex items-center">
                            <i class="fas fa-poll mr-2 text-accent"></i>
                            Ankete
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-secondary font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-phone mr-2"></i>Kontakt
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
                <button id="searchButton" class="text-secondary hover:text-primary transition-colors focus:outline-none"
                    aria-label="Search">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <div id="searchInputContainer"
                    class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-white rounded-xl shadow-2xl border border-surface overflow-hidden backdrop-blur-sm">
                    <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
                        <input type="text" name="q" placeholder="Pretražite sadržaj..."
                            class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-4 py-2.5 text-primary_text placeholder-secondary_text bg-surface rounded-lg"
                            id="searchInput" required />
                        <div class="flex items-center space-x-1 ml-2">
                            <button type="submit"
                                class="text-secondary_text hover:text-primary transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-surface w-9 h-9 flex items-center justify-center"
                                aria-label="Submit search">
                                <i class="fas fa-search text-sm"></i>
                            </button>
                            <button type="button"
                                class="text-secondary_text hover:text-accent transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-surface w-9 h-9 flex items-center justify-center"
                                id="closeSearch" aria-label="Close search">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <button id="hamburger" class="hamburger lg:hidden text-secondary w-8 h-8 flex flex-col justify-between">
                    <span class="block w-8 h-1 bg-secondary rounded"></span>
                    <span class="block w-8 h-1 bg-secondary rounded my-1"></span>
                    <span class="block w-8 h-1 bg-secondary rounded"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-20 gradient-figures">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-secondary via-transparent to-primary opacity-20"></div>

        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <span
                        class="inline-block bg-accent text-secondary px-6 py-2 rounded-full text-sm font-bold mb-6 shadow-lg">
                        <i class="fas fa-medal mr-2"></i>VODEĆI SPORTSKI CENTAR
                    </span>
                    <h1 class="text-6xl md:text-7xl font-heading font-bold leading-tight text-white mb-6">
                        <span class="block">IZUZETAN</span>
                        <span class="block text-accent mt-2">SPORTSKI DOŽIVLJAJ</span>
                    </h1>

                    <div class="mb-10">
                        <p class="text-xl text-white leading-relaxed mb-6 font-medium">
                            Najsavremeniji sportski objekat sa olimpijskim standardima, profesionalnim trenerima i
                            najnovijom opremom za sve sportske aktivnosti.
                        </p>
                        <p class="text-white italic text-lg border-l-4 border-accent pl-4">
                            "Sport gradi karakter, podstiče timski rad i podučava vrednost napornog rada."
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <button
                            class="bg-primary hover:bg-primary_hover text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl transition-all transform hover:scale-105">
                            <i class="fas fa-calendar-check mr-2"></i>Rezerviši termin
                        </button>
                        <button
                            class="border-3 border-accent text-accent hover:bg-accent hover:text-white px-8 py-4 rounded-full font-bold text-lg transition-all">
                            <i class="fas fa-play mr-2"></i>Video prezentacija
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="stat-number font-heading">12+</div>
                            <p class="text-white font-semibold uppercase text-sm">Sportova</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">25+</div>
                            <p class="text-white font-semibold uppercase text-sm">Trenera</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">5</div>
                            <p class="text-white font-semibold uppercase text-sm">Olimpijaca</p>
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
                            <i class="fas fa-trophy text-6xl text-primary mb-4"></i>
                            <h3 class="font-heading text-2xl font-bold text-primary_text">POSTIGNUĆA</h3>
                            <p class="text-secondary_text mt-2 font-medium">Brojni trofeji i medalje</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
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


    <!-- Featured Sports Section -->
    <section id="Sportovi" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-4">
                    SPORTOVI
                </span>
                <h2 class="text-5xl font-heading font-bold text-primary_text mb-4">
                    NAŠI SPORTOVI
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto font-medium">
                    Raznovrsni sportovi prilagođeni svim nivoima i interesovanjima
                </p>
            </div>

            <div id="SportoviCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // Primer podataka - u realnoj aplikaciji bi ovo došlo iz baze
                $sports = [
                    [
                        'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=600&q=80',
                        'naziv' => 'Fudbal',
                        'termin' => 'Pon-Pet 18:00'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80',
                        'naziv' => 'Košarka',
                        'termin' => 'Uto-Čet 17:00'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=600&q=80',
                        'naziv' => 'Yoga',
                        'termin' => 'Svakog dana 09:00'
                    ]
                ];

                foreach ($sports as $sport) {
                    echo '

        <!-- helper css (stavi u globalni stylesheet ili ovde) -->
<style>
  /* fallback za višelinijski clamp ako ne koristiš Tailwind plugin */
  .clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

<div class="card-hover bg-transparent rounded-2xl overflow-hidden shadow-2xl border border-gray-100 max-w-sm">
  <div class="relative h-64 overflow-hidden rounded-2xl">
    <!-- slika -->
    <img id="g-image" src="' . $sport['image'] . '" alt="' . $sport['naziv'] . '"
         class="w-full h-full object-cover transition-transform duration-700 transform hover:scale-110">

    <!-- tamni gradient preko slike -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent pointer-events-none"></div>

    <!-- overlay kartica (frosted glass feel) -->
    <div class="absolute left-4 right-4 bottom-4 p-4 rounded-xl backdrop-blur-md bg-white/10 border border-white/10 text-white">
      <div class="flex items-start justify-between gap-3">
        <div class="flex-1">
          <h3 id="g-nazivSporta" class="text-lg md:text-2xl font-heading font-bold leading-tight">
            ' . $sport['naziv'] . '
          </h3>

          <p id="g-opis" class="mt-2 text-sm md:text-base leading-relaxed clamp-3">
            ' . ($sport['opis'] ?? '') . '
          </p>

          <div class="mt-3 flex items-center text-sm text-gray-100/90">
            <i class="fas fa-clock mr-2 text-sm"></i>
            <span class="font-medium text-sm">' . ($sport['termin'] ?? 'Nije određeno') . '</span>
          </div>
        </div>

        <!-- href dugme -->
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
                <button
                    class="bg-secondary text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-secondary_hover transition-all shadow-xl transform hover:scale-105">
                    <i class="fas fa-th-large mr-3"></i>Svi Sportovi
                </button>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-dumbbell text-xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-heading font-bold">SPORTSKI ARENA</h3>
                            <p class="text-xs text-accent tracking-widest font-oswald">PROFESIONALNI SPORTSKI OBJEKAT
                            </p>
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
                    <h4 class="text-xl font-heading font-bold mb-6 text-accent">SPORTOVI</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Fudbal</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Košarka</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Odbojka</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Tenis</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Plivanje</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i> Atletika</a></li>
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
                            <span class="text-gray-300">info@sportskaarena.rs</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-primary mr-3"></i>
                            <span class="text-gray-300">Pon-Ned: 06:00 - 23:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; 2023 Sportski Centar Arena. Sva prava zadržana.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm">Uslovi korišćenja</a>
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm">Politika
                        privatnosti</a>
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Safe JavaScript with element existence checks
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile menu functionality
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

            if (hamburger && mobileMenu && closeMobileMenu && mobileMenuOverlay) {
                hamburger.addEventListener('click', () => {
                    mobileMenu.classList.remove('hidden');
                    setTimeout(() => {
                        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
                        if (mobileMenuPanel) {
                            mobileMenuPanel.classList.remove('translate-x-full');
                        }
                    }, 10);
                });

                closeMobileMenu.addEventListener('click', closeMenu);
                mobileMenuOverlay.addEventListener('click', closeMenu);

                function closeMenu() {
                    const mobileMenuPanel = document.getElementById('mobileMenuPanel');
                    if (mobileMenuPanel) {
                        mobileMenuPanel.classList.add('translate-x-full');
                    }
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            }

            // Mobile dropdown functionality
            const setupMobileDropdown = (toggleId, menuId, iconId) => {
                const toggle = document.getElementById(toggleId);
                const menu = document.getElementById(menuId);
                const icon = document.getElementById(iconId);

                if (toggle && menu && icon) {
                    toggle.addEventListener('click', (e) => {
                        e.preventDefault();
                        menu.classList.toggle('hidden');
                        toggle.parentElement.classList.toggle('mobile-dropdown-open');
                    });
                }
            };

            // Setup all mobile dropdowns
            setupMobileDropdown('mobileAboutToggle', 'mobileAboutMenu', 'mobileAboutIcon');
            setupMobileDropdown('mobileSportsToggle', 'mobileSportsMenu', 'mobileSportsIcon');
            setupMobileDropdown('mobileMembershipToggle', 'mobileMembershipMenu', 'mobileMembershipIcon');

            // Font size increase functionality
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
                        increaseFontBtn.textContent = 'A-';
                    } else {
                        elements.forEach(el => {
                            el.style.fontSize = '';
                        });
                        fontSizeIncreased = false;
                        increaseFontBtn.textContent = 'A+';
                    }
                });
            }

            // Search functionality
            const searchButton = document.getElementById('searchButton');
            if (searchButton) {
                searchButton.addEventListener('click', function () {
                    searchInputContainer.classList.remove('hidden');
                    setTimeout(() => searchInputContainer.classList.remove('opacity-0'), 10);
                });
            }

            // Smooth scrolling for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>