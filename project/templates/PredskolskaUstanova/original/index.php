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

        .preschool-hero {
            position: relative;
            isolation: isolate;
            overflow: hidden;
        }

        .preschool-hero::before,
        .preschool-hero::after {
            position: absolute;
            z-index: -1;
            content: '';
            inset: 0;
        }

        .preschool-hero::before {
            inset: -8px;
            background: url('https://images.unsplash.com/photo-1761403942462-04b8b97f1fe9?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D') center / cover no-repeat;
            filter: blur(10px);
            transform: scale(1.02);
        }

        .preschool-hero::after {
            background: rgba(255, 255, 255, 0.24);
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
                position: relative;
                isolation: isolate;
                overflow: hidden;
                background:
                    radial-gradient(ellipse at 82% 18%, rgba(255, 255, 255, 0.8), transparent 28%),
                    linear-gradient(135deg, #f3faf5 0%, #e4f0e7 52%, #f6eced 100%);
            }

            .hero-container {
                width: min(1240px, 100%);
                margin: 0 auto;
                padding: 8.5rem 1.5rem 5rem;
                display: grid;
                grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
                align-items: center;
                gap: clamp(2rem, 5vw, 4.5rem);
            }

            .hero-copy {
                max-width: 610px;
            }

            .hero-kicker {
                display: inline-flex;
                align-items: center;
                gap: 0.55rem;
                margin-bottom: 1.4rem;
                padding: 0.55rem 0.9rem;
                border: 1px solid rgba(110, 126, 204, 0.14);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.76);
                color: #536da9;
                font-size: 0.92rem;
                font-weight: 800;
                letter-spacing: 0.01em;
                box-shadow: 0 8px 24px rgba(58, 83, 91, 0.06);
            }

            .hero-kicker-dot {
                width: 0.55rem;
                height: 0.55rem;
                border-radius: 50%;
                background: #f3b84b;
                box-shadow: 0 0 0 4px rgba(243, 184, 75, 0.18);
            }

            .hero-title {
                margin: 0;
                color: #294c55;
                font-family: 'Fredoka', sans-serif;
                font-size: clamp(3.2rem, 6.2vw, 5.35rem);
                font-weight: 600;
                letter-spacing: -0.045em;
                line-height: 0.99;
            }

            .hero-title-accent {
                display: block;
                margin-top: 0.12em;
                color: #6e7ecc;
            }

            .hero-description {
                max-width: 35rem;
                margin: 1.5rem 0 0;
                color: #557177;
                font-size: clamp(1.05rem, 1.6vw, 1.2rem);
                line-height: 1.75;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 0.85rem;
                margin-top: 2rem;
            }

            .hero-button {
                display: inline-flex;
                min-height: 3.35rem;
                align-items: center;
                justify-content: center;
                gap: 0.65rem;
                padding: 0.85rem 1.35rem;
                border-radius: 999px;
                font-size: 1rem;
                font-weight: 800;
                text-decoration: none;
                transition: transform 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
            }

            .hero-button:hover {
                transform: translateY(-2px);
            }

            .hero-button-primary {
                background: #6e7ecc;
                color: #fff;
                box-shadow: 0 12px 24px rgba(93, 112, 190, 0.24);
            }

            .hero-button-primary:hover {
                background: #5f70bf;
                box-shadow: 0 16px 28px rgba(93, 112, 190, 0.3);
            }

            .hero-button-secondary {
                border: 1px solid rgba(85, 113, 119, 0.17);
                background: rgba(255, 255, 255, 0.64);
                color: #45636a;
            }

            .hero-button-secondary:hover {
                background: #fff;
                box-shadow: 0 10px 24px rgba(58, 83, 91, 0.09);
            }

            .hero-visual {
                position: relative;
                width: 100%;
                max-width: 570px;
                justify-self: end;
                padding: 1.1rem;
            }

            .hero-art-card {
                overflow: hidden;
                border: 8px solid rgba(255, 255, 255, 0.82);
                border-radius: 2.5rem;
                background: #fffaf0;
                box-shadow: 0 28px 70px rgba(62, 91, 91, 0.16);
                transform: rotate(1.5deg);
            }

            .hero-illustration {
                display: block;
                width: 100%;
                height: auto;
            }

            .hero-float {
                position: absolute;
                z-index: 1;
                display: inline-flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.8rem 1rem;
                border: 1px solid rgba(255, 255, 255, 0.9);
                border-radius: 1rem;
                background: rgba(255, 255, 255, 0.95);
                color: #45636a;
                font-size: 0.88rem;
                font-weight: 800;
                box-shadow: 0 12px 30px rgba(54, 80, 84, 0.13);
            }

            .hero-float-top {
                top: 2.4rem;
                right: -0.35rem;
            }

            .hero-float-bottom {
                bottom: 1.9rem;
                left: -0.45rem;
            }

            .hero-float-icon {
                display: grid;
                width: 2rem;
                height: 2rem;
                place-items: center;
                border-radius: 0.7rem;
                background: #fff0c7;
                color: #b77821;
            }

            .hero-float-dots {
                display: flex;
                gap: 0.2rem;
            }

            .hero-float-dots span {
                width: 0.55rem;
                height: 0.55rem;
                border-radius: 50%;
            }

            @media (max-width: 900px) {
                .hero-container {
                    grid-template-columns: minmax(0, 1fr) minmax(0, 0.9fr);
                    gap: 1.5rem;
                }

                .hero-visual {
                    padding: 0.65rem;
                }

                .hero-float {
                    font-size: 0.78rem;
                }
            }

            @media (max-width: 720px) {
                .hero-container {
                    grid-template-columns: 1fr;
                    gap: 2rem;
                    padding-top: 7.5rem;
                    padding-bottom: 3.5rem;
                }

                .hero-copy {
                    max-width: 600px;
                    text-align: center;
                    margin: 0 auto;
                }

                .hero-description {
                    margin-right: auto;
                    margin-left: auto;
                }

                .hero-actions {
                    justify-content: center;
                }

                .hero-visual {
                    width: min(100%, 520px);
                    justify-self: center;
                }
            }

            @media (max-width: 480px) {
                .hero-container {
                    padding-right: 1.1rem;
                    padding-left: 1.1rem;
                }

                .hero-title {
                    font-size: clamp(2.8rem, 13vw, 4rem);
                }

                .hero-kicker {
                    font-size: 0.82rem;
                }

                .hero-float {
                    padding: 0.6rem 0.7rem;
                    font-size: 0.72rem;
                }

                .hero-float-top {
                    top: 0.5rem;
                    right: -0.2rem;
                }

                .hero-float-bottom {
                    bottom: 0.6rem;
                    left: -0.2rem;
                }

                .hero-art-card {
                    border-width: 5px;
                    border-radius: 1.8rem;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .hero-button {
                    transition: none;
                }
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
                                <i class="fas fa-history mr-2 text-primary"></i>Istorijat
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
                        </div>
                    </div>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Vesti
                    </a>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Manifestacije
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
            <a href="/" class="flex items-center flex-shrink-0 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                <img src="/assets/img/logo-slika.jpg" alt="Naziv institucije"
                    class="h-12 sm:h-14 md:h-16 w-auto block" />
            </a>
            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-8 font-heading2 text-secondary_text hover:text-primary_text">
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
                            <i class="fas fa-question mr-2 text-primary"></i>Pitanja
                        </a>
                        <a href="#" static="true"
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
                        class="fas fa-calendar-alt mr-2 text-primary"></i>
                    <span class="hidden xl:inline">Manifestacije</span>
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
                    'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>']
                ];

                if (!isset($languages[$locale])) {
                    $locale = 'sr';
                }
                ?>
                <div class="locale dropdown nonPage relative group">
                    <button class="nav-link transition-colors flex items-center whitespace-nowrap">
                        <span class="mr-2 text-primary_text hover:text-secondary_text"><?= $languages[$locale]['flag'] ?></span>
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
    <section class="preschool-hero relative">
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-background to-transparent"></div>

        <div class="container relative z-10 mx-auto px-6 md:px-12 py-24">
            <!-- Dekorativni krugovi u pozadini -->
            <div class="pointer-events-none absolute -top-10 -right-10 w-72 h-72 rounded-full bg-primary/20 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-1/3 w-56 h-56 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative max-w-3xl">
                <!-- Značka iznad naslova -->
                <div class="inline-flex items-center gap-3 mb-8 mt-10 px-5 py-2 rounded-full
                            bg-white/10 border border-white/20 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs md:text-sm font-body tracking-[0.25em] uppercase text-white/80">
                        Dobrodošli na zvaničan sajt
                    </span>
                </div>

                <!-- Naslov -->
                <h1 class="mb-6 leading-[1.05]">
                    <span class="block font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-primary_text">
                        Predškolska ustanova
                    </span>
                    <span class="block font-heading2 text-6xl md:text-7xl lg:text-8xl italic text-primary_text mt-1">
                        Čuperak
                    </span>

                    <!-- Linija + lokacija -->
                    <span class="flex items-center gap-4 mt-5">
                        <span class="h-[3px] w-14 rounded-full bg-primary"></span>
                        <span class="text-lg md:text-2xl font-body text-white/80">
                            Kraljevo, Srbija
                        </span>
                    </span>
                </h1>

                <p class="mb-10 max-w-xl text-lg md:text-xl leading-relaxed text-white/80 border-l-4 border-primary/70 pl-5">
                    Mesto gde svaki dečji osmeh, ideja i korak predstavljaju početak velikih mogućnosti, a igra, znanje i kreativnost put ka srećnom odrastanju.
                </p>

                <!-- Dugmad -->
                <div class="flex flex-wrap gap-4">
                    <a href="/0-nama/misija"
                        class="group inline-flex items-center gap-2 bg-primary text-background
                            px-8 py-4 rounded-full text-lg font-semibold shadow-lg shadow-primary/30
                            hover:bg-primary_hover hover:-translate-y-0.5 transition-all">
                        Saznajte o nama
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                    <a href="/za-roditelje/jelovnik"
                        class="inline-flex items-center px-8 py-4 rounded-full text-lg font-semibold
                            bg-white/10 border border-white/40 text-white backdrop-blur-sm
                            hover:bg-white hover:text-black hover:-translate-y-0.5 transition-all">
                        Aktuelan jelovnik
                    </a>
                    <a href="/manifestacije"
                        class="group inline-flex items-center gap-2 bg-primary text-background
                            px-8 py-4 rounded-full text-lg font-semibold shadow-lg shadow-primary/30
                            hover:bg-primary_hover hover:-translate-y-0.5 transition-all">
                        Naše manifestacije
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indikator -->
        <a href="#repertoar" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-2 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </a>
    </section>
    <!-- vesti -->
    <section id="vesti" class="py-20 bg-gradient-to-br from-surface to-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Najnovije vesti
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
                                Naslov
                            </h3>

                            <p id="g-opis" class="text-secondary_text mb-5 line-clamp-3 leading-relaxed">
                                Opis
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
                    Pogledajte sve vesti
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>
    </section>
    <!-- objekti -->
    <section id="vrtici" class="bg-secondary_background text-secondary_text font-heading2">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">Objekti
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent via-primary to-secondary rounded-full">
                    </div>
                </h2>
            </div>
            <div id="vrticiCards" class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                <!-- Kartica 1 -->
                <div class="vrtici-card group flex items-center bg-surface rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 h-48 overflow-hidden">
                    <a href="#" class="w-1/4 h-full relative overflow-hidden flex-shrink-0">
                        <img
                            id="g-image"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Objekat">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary_text/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text font-heading text-2xl group-hover:text-accent transition-colors">
                            <p id="g-title" class="text-3xl">Lorem ipsum</p>
                        </h3>
                        <p id="g-description" class="mt-3 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>

                <!-- Kartica 2 -->
                <div class="vrtici-card group flex items-center bg-surface rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 h-48 overflow-hidden">
                    <a href="#" class="w-1/4 h-full relative overflow-hidden flex-shrink-0">
                        <img
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Objekat">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary_text/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text font-heading text-2xl group-hover:text-accent transition-colors">
                            <p class="text-3xl">Lorem ipsum</p>
                        </h3>
                        <p class="mt-3 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>

                <!-- Kartica 3 -->
                <div class="vrtici-card group flex items-center bg-surface rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 h-48 overflow-hidden">
                    <a href="#" class="w-1/4 h-full relative overflow-hidden flex-shrink-0">
                        <img
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Objekat">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary_text/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text font-heading text-2xl group-hover:text-accent transition-colors">
                            <p class="text-3xl">Lorem ipsum</p>
                        </h3>
                        <p class="mt-3 mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>

                <!-- Kartica 4 -->
                <div class="vrtici-card group flex items-center bg-surface rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 h-48 overflow-hidden">
                    <a href="#" class="w-1/4 h-full relative overflow-hidden flex-shrink-0">
                        <img
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                            alt="Objekat">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary_text/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <div class="p-5 w-3/4">
                        <h3 class="text-primary_text font-heading text-2xl group-hover:text-accent transition-colors">
                            <p class="text-3xl">Lorem ipsum</p>
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
    <section id="gallery" class="py-20 bg-secondary_background text-secondary_text font-heading2">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Galerija
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent via-primary to-secondary rounded-full">
                    </div>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6">
                    Nekoliko fotografija iz naše ustanove
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
    <footer class="bg-background text-primary_text font-heading2 pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <a href="/" class="flex items-center flex-shrink-0 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <img src="/assets/img/logo-slika.jpg" alt="Naziv institucije"
                                class="h-12 sm:h-14 md:h-16 w-auto block" />
                        </a>
                    </div>
                    <p class="mb-4">
                        Kraljevo, Srbija
                    </p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/pudecjaradost.cuprija/?locale=sr_RS"
                            class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="/o-nama/istorijat" class="text-logocolor2/90 hover:text-primary_text transition-colors">Istorijat</a></li>
                        <li><a href="/vesti" class="text-logocolor2/90 hover:text-primary_text transition-colors">Vesti</a></li>
                        <li><a href="/manifestacije" class="text-logocolor2/90 hover:text-primary_text transition-colors">Manifestacije</a></li>
                        <li><a href="/vrtici" class="text-logocolor2/90 hover:text-primary_text transition-colors">Vrtići</a></li>
                        <li><a href="/obavestenja" class="text-logocolor2/90 hover:text-primary_text transition-colors">Obaveštenja</a></li>
                        <li><a href="/jelovnik" class="text-logocolor2/90 hover:text-primary_text transition-colors">Jelovnik</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li><a href="/ankete" class="text-logocolor2/90 hover:text-primary_text transition-colors">Ankete o zadovoljstvu korisnika</a></li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
                            <span>035 8472 163</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
                            <span data-translate="off">mejl@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-logocolor2 mt-1 mr-3"></i>
                            <span>
                                PON - PET: 08:00 - 16:00<br>
                                SUB: 08:00 - 14:00<br>
                                NED: Zatvoreno
                            </span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-6">Mapa lokacije</h4>
                    <div class="relative w-full overflow-hidden rounded-xl" style="aspect-ratio: 16 / 9;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d539414.6606786619!2d19.954245878904146!3d43.673838441214045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47570131a3dab72b%3A0xdb47d37d816e319e!2z0J_RgNC10LTRiNC60L7Qu9GB0LrQtSDRg9GB0YLQsNC90L7QstCwICws0KfRg9C_0LXRgNCw0LonJw!5e0!3m2!1ssr!2srs!4v1795523693449!5m2!1ssr!2srs"
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
                <p class="pt-6 text-secondary_text">&copy; Predškosla ustanova Čuperak, Kraljevo, Srbija</p>
            </div>
        </div>
    </footer>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        logocolor1: '#809bce',
                        logocolor2: '#809bce',
                        primary: '#8090ce',
                        primary_hover: '#6979cd',
                        secondary: '#85bad0',
                        secondary_hover: '#6fa9d3',
                        accent: "#6e7ecc",
                        accent_hover: "#809bce",
                        primary_text: '#6e7ecc',
                        secondary_text: '#72aad1',
                        background: '#eae9d6',
                        secondary_background: '#fcfcfc',
                        surface: "#eadce2",
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