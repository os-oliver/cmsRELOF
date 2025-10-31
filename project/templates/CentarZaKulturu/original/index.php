<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturni Centar Nexus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>

    </script>
    <style>
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
            outline: none;
        }

        .search-input.open {
            width: 200px;
            opacity: 1;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
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

        .text-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .artistic-underline {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 20"><path fill="none" stroke="%231e40af" stroke-width="3" stroke-linecap="round" d="M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12"/></svg>') bottom center no-repeat;
            background-size: 100% 12px;
            padding-bottom: 12px;
        }

        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 3px;
            background: linear-gradient(to right, #1e40af, #1e3a8a);
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
            border: 2px solid #1e40af;
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
            border: 2px solid #7e22ce;
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
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
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
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="%23f8fafc"></path></svg>');
            background-size: 100% 100px;
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
            color: #1f2937;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            border-left: 3px solid #1e40af;
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
            background: linear-gradient(to right, #1e40af, #1e3a8a);
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
            aspect-ratio: 1 / 1;
            overflow: hidden;
            position: relative;
        }

        .gallery-item img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .navbar-icon {
            height: 45px;
            max-width: 45px;
            height: auto;
            width: auto;
            border-radius: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .navbar-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-background font-body text-primary_text min-h-screen overflow-x-hidden">
    <!-- Enhanced Header -->
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary_background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-primary_text font-heading font-bold">Menu</h2>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-times text-xl"></i>
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
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
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
                    <a data-page="Dogadjaji" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Dogadjaji
                    </a>
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

    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-primary_hover transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <header
        class="fixed w-full z-50 transition-all duration-300 py-2 sm:py-3 backdrop-blur-md shadow-lg bg-secondary_background/95 border-b border-surface">
        <div class="px-3 sm:px-4 lg:px-6 flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <!-- Logo ikonica -->
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-landmark text-lg"></i>
                </div>

                <!-- Tekst za desktop -->
                <div class="hidden sm:block">
                    <h1
                        class="text-sm sm:text-base lg:text-lg font-heading text-primary_text font-bold tracking-wide leading-tight">
                        KULTURNI NEXUS
                    </h1>
                    <p
                        class="text-xs sm:text-xs lg:text-sm text-secondary tracking-widest hidden md:block opacity-80 font-medium">
                        CENTAR ZA UMETNOST I BAŠTINU
                    </p>
                </div>

                <!-- Tekst za mobilni -->
                <div class="block sm:hidden">
                    <h1 class="text-xs sm:text-sm font-heading text-primary_text font-bold tracking-wide">NEXUS</h1>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex items-center space-x-1 xl:space-x-3">
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i class="fas fa-home mr-2 text-primary group-hover:text-accent transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Početna</span>
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

                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-calendar-alt mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Dogadjaji</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-users mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Ansambl</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-newspaper mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Vesti</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-project-diagram mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Projekti</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-images mr-2 text-secondary group-hover:text-secondary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Galerija</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group flex items-center px-3 py-2 rounded-lg hover:bg-surface">
                    <i
                        class="fas fa-folder-open mr-2 text-accent group-hover:text-accent_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Dokumenti</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group flex items-center px-3 py-2 rounded-lg hover:bg-surface">
                    <i class="fas fa-poll mr-2 text-accent group-hover:text-accent_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Ankete</span>
                </a>
                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-address-book mr-2 text-secondary group-hover:text-secondary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Kontakt</span>
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
            <div class="flex items-center space-x-1 sm:space-x-3">
                <!-- Search Container -->
                <div class="relative">
                    <button id="searchButton"
                        class="text-secondary_text hover:text-primary transition-all duration-200 focus:outline-none p-2 sm:p-2.5 rounded-full hover:bg-surface"
                        aria-label="Search">
                        <i class="fas fa-search text-sm sm:text-base"></i>
                    </button>
                    <!-- Enhanced Search Input -->
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-white rounded-xl shadow-2xl border border-surface overflow-hidden backdrop-blur-sm">
                        <form id="searchForm" class="flex items-center w-full p-2" action="/search" method="GET">
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
                </div>

                <!-- Enhanced Mobile Menu Button -->
                <button id="hamburger"
                    class="hamburger lg:hidden text-primary_text w-9 h-9 sm:w-10 sm:h-10 flex flex-col justify-center items-center space-y-1 p-2 rounded-lg hover:bg-surface transition-all duration-200">
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Enhanced Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-gradient-to-br from-surface to-accent

">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 z-0">
            <!-- Floating paint elements -->
            <div
                class="absolute top-20 left-10 w-80 h-40 bg-primary opacity-15 transform rotate-12 rounded-full animate-float">
            </div>
            <div class="absolute bottom-40 right-20 w-64 h-32 bg-secondary opacity-10 transform -rotate-6 rounded-full animate-float"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-accent opacity-10 animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 bg-secondary opacity-10 rounded-full animate-float"
                style="animation-delay: 3s;"></div>

            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#1f2937 1px, transparent 1px); background-size: 20px 20px;">
            </div>

            <!-- Paint splatters -->
            <div class="absolute top-1/4 right-1/5 w-24 h-24 bg-secondary opacity-10 rounded-full"
                style="clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);"></div>
            <div class="absolute bottom-1/3 left-1/6 w-20 h-20 bg-primary opacity-10"
                style="clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);"></div>
        </div>

        <div class="container max-w-full mx-10 px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <div class="mb-8">
                        <span
                            class="inline-block bg-surface text-primary_text px-4 py-1 rounded-full text-sm font-medium mb-6">
                            <i class="fas fa-star mr-2 text-accent"></i>Istaknuto ovog meseca
                        </span>
                        <h1 class="text-5xl md:text-6xl font-heading font-bold leading-tight text-primary_text mb-6">
                            <span class="block artistic-underline">Mesto gde se umetnost, film i</span>
                            <span class="block text-primary mt-2">kultura susreću</span>
                        </h1>
                    </div>

                    <div class="mb-10 relative pl-6 border-l-4 border-secondary">
                        <p class="text-xl text-primary_text leading-relaxed max-w-lg mb-6">
                            Doživite živopisnu spoju vizuelnih umetnosti, nezavisnog filma, pozorišta i kulturne baštine
                            u našem novom renoviranom prostoru.
                        </p>
                        <p class="text-secondary_text italic">
                            "Kulturni centar je srce zajednice, gde različiti izrazi pronalaze zajednički jezik."
                            <span class="block font-medium text-accent mt-2">— Elena Rodriguez, Umetnički
                                direktor</span>
                        </p>
                    </div>

                    <!-- Quick links -->
                    <div class="mt-10 flex flex-wrap gap-3">
                        <a href="#" class="flex items-center text-secondary_text hover:text-accent transition-colors">
                            <span class="w-3 h-3 bg-secondary rounded-full mr-2"></span>
                            Trenutne izložbe
                        </a>
                        <a href="#" class="flex items-center text-secondary_text hover:text-accent transition-colors">
                            <span class="w-3 h-3 bg-primary rounded-full mr-2"></span>
                            Raspored filmova
                        </a>
                        <a href="#" class="flex items-center text-secondary_text hover:text-accent transition-colors">
                            <span class="w-3 h-3 bg-secondary rounded-full mr-2"></span>
                            Pozorišne predstave
                        </a>
                        <a href="#" class="flex items-center text-secondary_text hover:text-accent transition-colors">
                            <span class="w-3 h-3 bg-accent rounded-full mr-2"></span>
                            Muzički događaji
                        </a>
                    </div>
                </div>

                <!-- Cultural Showcase Grid -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Art Exhibition -->
                        <div class="artistic-card h-80 rounded-xl overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1547891654-e66ed7ebb968?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-primary/80 text-white">Umetnost</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text/90 to-transparent p-4 text-white">
                                <h3 class="font-heading font-bold">Savremene Perspektive</h3>
                                <p class="text-sm">Savremena umetnička izložba</p>
                            </div>
                        </div>

                        <!-- Film -->
                        <div class="artistic-card h-80 rounded-xl overflow-hidden relative mt-12">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-secondary/80 text-white">Bioskop</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text/90 to-transparent p-4 text-white">
                                <h3 class="font-heading font-bold">Međunarodni Filmski Festival</h3>
                                <p class="text-sm">15-30. jun</p>
                            </div>
                        </div>

                        <!-- Theater -->
                        <div class="artistic-card h-64 rounded-xl overflow-hidden relative">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-accent/80 text-white">Pozorište</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text/90 to-transparent p-4 text-white">
                                <h3 class="font-heading font-bold">Šekspir u parku</h3>
                                <p class="text-sm">Predstave na otvorenom</p>
                            </div>
                        </div>

                        <!-- Music -->
                        <div class="artistic-card h-64 rounded-xl overflow-hidden relative -mt-6">
                            <div
                                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div>
                            <div class="category-badge bg-primary/80 text-white">Muzika</div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text/90 to-transparent p-4 text-white">
                                <h3 class="font-heading font-bold">Jazz & Blues Večeri</h3>
                                <p class="text-sm">Svakog petka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating info card -->
        <div class="absolute bottom-20 right-20 z-20 hidden xl:block animate-bounce-slow">
            <div class="relative">
                <div
                    class="w-66 h-auto bg-white/90 backdrop-blur-sm p-5 rounded-xl shadow-2xl border-2 border-primary transform rotate-3">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-14 h-14 bg-secondary rounded-full mr-3 flex items-center justify-center text-white">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold">Radno vreme</h4>
                            <p class="text-accent text-sm">Utorak-Nedelja: 10:00-21:00</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Opšta:</span>
                            <span class="font-medium">1200 RSD</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Studenti/Penzioneri:</span>
                            <span class="font-medium">800 RSD</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Članovi:</span>
                            <span class="font-medium">Besplatno</span>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute -top-6 -right-6 w-12 h-12 bg-secondary rounded-full flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-8 h-14 rounded-full border-2 border-primary flex justify-center p-1">
                <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Section divider -->
    <div class="section-divider w-full bg-secondary_background"></div>

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
                    <div
                        class="event-card bg-surface rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 max-w-3xl mx-auto flex overflow-hidden h-64">
                        <!-- Slika sa leve strane -->
                        <div class="w-1/3 relative">
                            <img id="g-image"
                                src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                                alt="Event image"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div id="g-naziv"
                                class="absolute top-3 left-3 bg-primary text-white px-3 py-1 rounded-full text-sm font-bold shadow-md">
                                Kultura
                            </div>
                        </div>

                        <!-- Tekstualni deo -->
                        <div class="w-2/3 p-6 flex flex-col justify-between">
                            <!-- Naslov i opis -->
                            <div class="mb-3">
                                <h3 id="g-title"
                                    class="text-2xl font-heading font-bold text-primary hover:text-primary_hover transition-colors duration-300">
                                    Savremene Perspektive
                                </h3>
                                <p id="g-description" class="text-primary_text mb-4 line-clamp-3">
                                    Radovi mladih umetnika koji istražuju identitet u digitalnom dobu. Inspiracija dolazi iz
                                    savremenih trendova u umetnosti i tehnologiji.
                                </p>
                            </div>

                            <!-- Datum, vreme, lokacija -->
                            <div
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center text-sm text-secondary_text mb-4">
                                <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                    <span id="g-datum" class="font-semibold text-primary_text">30.10.2025</span>
                                </div>
                                <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                                    <i class="fas fa-clock text-secondary"></i>
                                    <span id="g-time" class="font-semibold text-primary_text">18:00 - 21:00</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-accent"></i>
                                    <span id="g-location" class="font-semibold text-primary_text">Galerija Savremene
                                        Umetnosti</span>
                                </div>
                            </div>

                            <!-- CTA dugme -->
                            <button
                                class="self-start bg-primary text-white font-bold py-2 px-6 rounded-lg hover:bg-primary_hover transition-colors duration-300">
                                Više informacija
                            </button>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="text-center mt-12">
                <button id="eventsView"
                    class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Exhibition Section -->
    <section id="promocija" class="py-20 bg-gradient-to-br from-background to-primary/10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 relative">
                    <div class="artistic-frame">
                        <img src="https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?auto=format&fit=crop&w=800&q=80"
                            alt="Featured Exhibition" class="rounded-xl shadow-2xl">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-32 h-32 bg-accent rounded-full flex items-center justify-center text-white text-5xl font-heading font-bold shadow-xl">
                        50%
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span
                        class="inline-block bg-surface text-primary_text px-4 py-1 rounded-full text-sm font-medium mb-6">
                        <i class="fas fa-fire mr-2 text-accent"></i>Specijalna ponuda
                    </span>
                    <h2 class="text-4xl font-heading font-bold text-primary_text mb-6">
                        <span class="block">Retrospektiva</span>
                        <span class="block text-accent">Miodraga Miće Popovića</span>
                    </h2>
                    <p class="text-lg text-primary_text mb-6 leading-relaxed">
                        Ekskluzivna izložba koja obuhvata najznačajnija dela jednog od najuticajnijih srpskih umetnika
                        20. veka. Ova retrospektiva predstavlja jedinstvenu priliku da se upoznate sa evolucijom
                        Popovićevog stvaralaštva kroz pet decenija.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-accent text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-secondary_text">Datum</p>
                                <p class="font-medium">1. jun - 15. jul</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-accent text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-secondary_text">Vreme</p>
                                <p class="font-medium">10:00 - 20:00</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-accent text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-secondary_text">Lokacija</p>
                                <p class="font-medium">Galerija Savremene Umetnosti</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-gradient-to-r from-accent to-accent_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Rezerviši karte
                        </button>
                        <button
                            class="border-2 border-accent text-accent px-8 py-4 rounded-full font-medium hover:bg-accent/10 transition-all flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Saznaj više
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
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

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-secondary_background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4">
                    Upoznajte Naš Prostor
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto">
                    Moderni, inspirativni prostori dizajnirani za raznovrsne kulturne aktivnosti
                </p>
            </div>

            <div id="galleryCards" class="gallery-grid gap-6">
                <div class="gallery-item rounded-xl overflow-hidden relative">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?auto=format&fit=crop&w=600&q=80"
                        alt="Gallery Space" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 id="g-description" class="font-bold text-lg">Galerija Savremene Umetnosti</h3>
                        <p id="g-title" class="text-sm">Prostor za izložbe</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?auto=format&fit=crop&w=600&q=80"
                        alt="Cinema" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Nexus Bioskop</h3>
                        <p class="text-sm">Projekcione sale</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1562788865-5638f7446611?auto=format&fit=crop&w=600&q=80"
                        alt="Theater" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Pozorišna Scena</h3>
                        <p class="text-sm">Mesto za predstave</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Kreativne Radionice</h3>
                        <p class="text-sm">Prostor za učenje</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1601924994987-69e26d50dc26?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Nexus Kafić</h3>
                        <p class="text-sm">Mesto za opuštanje</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=600&q=80"
                        alt="Library" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Umetnička Biblioteka</h3>
                        <p class="text-sm">Prostor za čitanje</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary_hover text-white pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center text-white mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-heading font-bold">KULTURNI NEXUS</h3>
                    </div>
                    <p class="text-white/80 mb-4">
                        Centar za umetnost i kulturu koji okuplja kreativce i publiku u srcu Beograda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-secondary/30 hover:bg-secondary flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="asde" class="text-white/80 hover:text-accent transition-colors">Izložbe</a></li>
                        <li><a href="#" class="text-white/80 hover:text-accent transition-colors">Bioskop</a></li>
                        <li><a href="#" class="text-white/80 hover:text-accent transition-colors">Pozorište</a></li>
                        <li><a href="#" class="text-white/80 hover:text-accent transition-colors">Koncerti</a></li>
                        <li><a href="#" class="text-white/80 hover:text-accent transition-colors">Radionice</a></li>
                        <li><a href="#" class="text-white/80 hover:text-accent transition-colors">Kalendar događaja</a>
                        </li>
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
                                Utorak - Nedelja: 10:00 - 21:00<br>
                                Ponedeljak: zatvoreno
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-heading font-bold mb-6">Mapa lokacije</h4>
                    <div class="bg-white/10 rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d20.4541920155352!3d44.81407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sKnez%20Mihailova%2C%20Beograd!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="border-t border-primary_text/70 pt-8 text-center text-white/60 text-sm">
                <p>&copy; 2023 Kulturni Centar Nexus. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',           // intenzivna kraljevsko-plava
                        primary_hover: '#1e40af',     // tamnija indigo plava
                        secondary: '#9333ea',         // vibrantna ljubičasta
                        secondary_hover: '#6b21a8',   // tamnija ljubičasta
                        accent: '#14b8a6',            // tirkizno-zelenkasta, osvežavajuća
                        accent_hover: '#0d9488',      // tamnija tirkiz
                        primary_text: '#111827',      // tamno siva, skoro crna
                        secondary_text: '#6b7280',    // neutralna hladna siva
                        background: '#f1f5f9',        // svetlo plavo-siva, hladna
                        secondary_background: '#e2e8f0', // svetla siva sa plavim tonom
                        surface: '#ffffff',           // bela za kartice i sekcije

                    },
                    fontFamily: {
                        heading: ['Playfair Display', 'serif'],
                        heading2: ['Crimson Pro', 'serif'],
                        body: ['Raleway', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 1s ease-in',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        fadeIn: {
                            from: { opacity: '0' },
                            to: { opacity: '1' },
                        }
                    }
                }
            }
        }

        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileAboutToggle = document.getElementById('mobileAboutToggle');
            const mobileAboutMenu = document.getElementById('mobileAboutMenu');
            const mobileAboutIcon = document.getElementById('mobileAboutIcon');

            // Toggle mobile menu
            hamburger.addEventListener('click', function () {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('mobileMenuPanel').classList.remove('translate-x-full');
                }, 10);
                hamburger.classList.add('active');
            });

            // Close mobile menu
            function closeMenu() {
                document.getElementById('mobileMenuPanel').classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
                hamburger.classList.remove('active');
            }

            closeMobileMenu.addEventListener('click', closeMenu);
            mobileMenuOverlay.addEventListener('click', closeMenu);

            // Toggle mobile dropdown
            mobileAboutToggle.addEventListener('click', function () {
                mobileAboutMenu.classList.toggle('hidden');
                mobileAboutToggle.parentElement.classList.toggle('active');
            });

            // Search functionality
            const searchButton = document.getElementById('searchButton');
            const searchInputContainer = document.getElementById('searchInputContainer');
            const closeSearch = document.getElementById('closeSearch');

            searchButton.addEventListener('click', function () {
                searchInputContainer.classList.toggle('hidden');
                setTimeout(() => {
                    searchInputContainer.classList.toggle('opacity-0');
                }, 10);
            });

            closeSearch.addEventListener('click', function () {
                searchInputContainer.classList.add('opacity-0');
                setTimeout(() => {
                    searchInputContainer.classList.add('hidden');
                }, 300);
            });

            // Font size increase functionality
            const increaseFontBtn = document.getElementById('increaseFontBtn');
            let fontSizeIncreased = false;

            increaseFontBtn.addEventListener('click', function () {
                const body = document.body;
                if (!fontSizeIncreased) {
                    body.style.fontSize = '1.1rem';
                    fontSizeIncreased = true;
                    increaseFontBtn.textContent = 'A-';
                } else {
                    body.style.fontSize = '';
                    fontSizeIncreased = false;
                    increaseFontBtn.textContent = 'A+';
                }
            });
        });
    </script>
</body>

</html>