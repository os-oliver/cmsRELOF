<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Istorijski Arhiv - Digitalno Čuvanje Nasleđa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#d4af37',
                            hover: '#c9a961',
                        },
                        secondary: {
                            DEFAULT: '#616e7c',
                            hover: '#52606d',
                        },
                        accent: {
                            DEFAULT: '#f4ebd2',
                            hover: '#eedeb7',
                        },
                        primary_text: '#ffffff',
                        secondary_text: '#9ca3af',
                        background: '#0a0f14',
                        secondary_background: '#1f2933',
                        surface: '#1e293b',
                    },
                    fontFamily: {
                        heading: ['Playfair Display', 'serif'],
                        heading2: ['Playfair Display', 'serif'],
                        body: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #0a0f14;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        nav {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .slider-container {
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
            height: 100%;
        }

        .slider-item {
            min-width: 100%;
            height: 100%;
            position: relative;
        }

        .slider-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .slider-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 15, 20, 0.95) 0%, rgba(26, 32, 44, 0.85) 50%, rgba(10, 15, 20, 0.75) 100%);
        }

        .hero-gradient {
            background: linear-gradient(-45deg, #0a0f14, #1a202c, #2d3748, #1a202c);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
            transition: left 0.5s;
        }

        .card-hover:hover::before {
            left: 100%;
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(212, 175, 55, 0.3);
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0f14;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #d4af37, #c9a961);
            border-radius: 5px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .glow {
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.6),
                0 0 40px rgba(212, 175, 55, 0.4),
                0 0 60px rgba(212, 175, 55, 0.2);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, #d4af37 0%, #f4ebd2 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .timeline-glow::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #d4af37, #c9a961, #d4af37);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        }

        .img-overlay {
            position: relative;
            overflow: hidden;
        }

        .img-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.4), rgba(10, 15, 20, 0.8));
            opacity: 0;
            transition: opacity 0.4s;
        }

        .img-overlay:hover::after {
            opacity: 1;
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }

        .btn-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-shine:hover::before {
            left: 100%;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(212, 175, 55, 0.4);
            border-radius: 50%;
            animation: rise 12s infinite ease-in;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                opacity: 0;
                transform: translateX(0) rotate(0deg);
            }

            50% {
                opacity: 1;
            }

            100% {
                bottom: 120%;
                opacity: 0;
                transform: translateX(100px) rotate(360deg);
            }
        }

        .card-3d {
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg);
        }

        .hero-content {
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .decorative-line {
            position: relative;
            display: inline-block;
        }

        .decorative-line::before,
        .decorative-line::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37);
        }

        .decorative-line::before {
            right: calc(100% + 20px);
        }

        .decorative-line::after {
            left: calc(100% + 20px);
            background: linear-gradient(90deg, #d4af37, transparent);
        }

        .slider-control {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .slider-control:hover {
            background: rgba(212, 175, 55, 0.9);
            border-color: rgba(212, 175, 55, 0.8);
            transform: scale(1.1);
        }

        .slider-indicator {
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .slider-indicator.active {
            background: #d4af37 !important;
            border-color: #d4af37;
            transform: scale(1.3);
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary_background/95 backdrop-blur-md transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary_hover flex items-center justify-center mr-3">
                            <i class="fas fa-landmark text-xl text-primary_text"></i>
                        </div>
                        <h2 class="text-xl text-primary_text font-heading font-bold">Istorijski Arhiv</h2>
                    </div>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-primary transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a href="#pocetna"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface/30 rounded-lg transition-all duration-300">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-primary hover:bg-surface/30 rounded-lg transition-all duration-300"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-primary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a href="#uvod"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a href="#istorijat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                                <i class="fas fa-history mr-2 text-primary"></i>Istorijat
                            </a>
                            <a href="#fondovi"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                                <i class="fas fa-archive mr-2 text-primary"></i>Fondovi
                            </a>
                            <a href="#digitalizacija"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                                <i class="fas fa-digital-tachograph mr-2 text-primary"></i>Digitalizacija
                            </a>
                        </div>
                    </div>
                    <a href="#fondovi"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface/30 rounded-lg transition-all duration-300">
                        <i class="fas fa-archive mr-3 text-primary"></i>Fondovi
                    </a>
                    <a href="#digitalizacija"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface/30 rounded-lg transition-all duration-300">
                        <i class="fas fa-digital-tachograph mr-3 text-primary"></i>Digitalizacija
                    </a>
                    <a href="#kontakt"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface/30 rounded-lg transition-all duration-300">
                        <i class="fas fa-envelope mr-3 text-primary"></i>Kontakt
                    </a>
                </nav>
                <div class="mt-8 pt-6 border-t border-surface">
                    <div class="flex flex-col space-y-4">
                        <button
                            class="w-full px-4 py-2 bg-primary/10 hover:bg-primary/20 text-primary_text rounded-lg transition-all duration-300">
                            <i class="fas fa-search mr-2"></i>Pretraga
                        </button>
                        <div class="flex justify-center space-x-2">
                            <button
                                class="language-btn px-4 py-2 rounded-lg text-primary_text hover:bg-primary/10 transition-all duration-300"
                                data-lang="sr-Latn">SR</button>
                            <button
                                class="language-btn px-4 py-2 rounded-lg text-primary_text hover:bg-primary/10 transition-all duration-300"
                                data-lang="sr-Cyrl">СРБ</button>
                            <button
                                class="language-btn px-4 py-2 rounded-lg text-primary_text hover:bg-primary/10 transition-all duration-300"
                                data-lang="en">EN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header
        class="fixed w-full z-40 transition-all duration-300 py-2 sm:py-3 bg-secondary_background/95 backdrop-blur-md border-b border-surface/10">
        <div class="px-3 sm:px-4 lg:px-6 flex justify-between items-center">
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-landmark text-lg"></i>
                </div>

                <div class="hidden sm:block">
                    <h1
                        class="text-sm sm:text-base lg:text-lg font-heading text-primary_text font-bold tracking-wide leading-tight">
                        ISTORIJSKI ARHIV
                    </h1>
                    <p
                        class="text-xs sm:text-xs lg:text-sm text-primary tracking-widest hidden md:block opacity-80 font-medium">
                        DIGITALNO NASLEĐE
                    </p>
                </div>

                <div class="block sm:hidden">
                    <h1 class="text-xs sm:text-sm font-heading text-primary_text font-bold tracking-wide">ARHIV</h1>
                </div>
            </div>

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
                        <span class="hidden xl:inline text-sm">O Arhivu</span>
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
                        class="fas fa-archive mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Fondovi</span>
                </a>

                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-project-diagram mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Digitalizacija</span>
                </a>

                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                    <i
                        class="fas fa-images mr-2 text-secondary group-hover:text-secondary_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Virtuelna Izložba</span>
                </a>

                <a href="#"
                    class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group flex items-center px-3 py-2 rounded-lg hover:bg-surface">
                    <i
                        class="fas fa-folder-open mr-2 text-accent group-hover:text-accent_hover transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Pravila</span>
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                        <i
                            class="fas fa-bullhorn mr-2 text-primary group-hover:text-primary_hover transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">Aktivnosti</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>

                    <div
                        class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-secondary_background rounded-xl shadow-2xl border border-surface opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3 backdrop-blur-sm">

                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-newspaper mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Vesti</span>
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-calendar-alt mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Događaji</span>
                        </a>

                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-poll mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Ankete</span>
                        </a>
                    </div>
                </div>

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

            <div class="flex items-center space-x-1 sm:space-x-3">
                <div class="relative">
                    <button id="searchButton"
                        class="text-secondary_text hover:text-primary transition-all duration-200 focus:outline-none p-2 sm:p-2.5 rounded-full hover:bg-surface"
                        aria-label="Search">
                        <i class="fas fa-search text-sm sm:text-base"></i>
                    </button>
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-white rounded-xl shadow-2xl border border-surface overflow-hidden backdrop-blur-sm">
                        <form id="searchForm" class="flex items-center w-full p-2" action="/search" method="GET">
                            <input type="text" name="q" placeholder="Pretražite arhiv..."
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

                <button id="hamburger"
                    class="hamburger lg:hidden text-primary_text w-9 h-9 sm:w-10 sm:h-10 flex flex-col justify-center items-center space-y-1 p-2 rounded-lg hover:bg-surface transition-all duration-200">
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-primary_text rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>

    <section class="relative slider-container">
        <div class="particles">
            <div class="particle" style="width: 12px; height: 12px; left: 10%; animation-delay: 0s;"></div>
            <div class="particle" style="width: 8px; height: 8px; left: 25%; animation-delay: 2s;"></div>
            <div class="particle" style="width: 15px; height: 15px; left: 40%; animation-delay: 4s;"></div>
            <div class="particle" style="width: 10px; height: 10px; left: 60%; animation-delay: 1s;"></div>
            <div class="particle" style="width: 12px; height: 12px; left: 75%; animation-delay: 3s;"></div>
            <div class="particle" style="width: 9px; height: 9px; left: 90%; animation-delay: 5s;"></div>
        </div>

        <div class="slider-wrapper" id="slider">
            <div class="slider-item">
                <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1920&h=1080&fit=crop"
                    alt="Stare knjige">
                <div class="slider-overlay"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-4xl hero-content">
                            <div
                                class="inline-block px-4 py-2 bg-primary/20 border border-primary/50 rounded-full text-primary text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-star mr-2"></i>Preko 150.000 dokumenata
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-primary_text leading-tight">
                                Čuvamo Prošlost<br />
                                <span class="text-primary">Za Budućnost</span>
                            </h1>
                            <p class="text-2xl mb-10 text-secondary_text max-w-2xl leading-relaxed">
                                Digitalizovani dokumenti iz 8 vekova istorije, dostupni svima koji žele da istraže naše
                                bogato nasleđe
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-primary to-primary_hover rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-primary/50 transition btn-shine text-primary_text transform hover:scale-105">
                                    <i class="fas fa-book-open mr-2"></i>Istraži Fondove
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-primary_text transform hover:scale-105">
                                    <i class="fas fa-play mr-2"></i>Video Tour
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item">
                <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1920&h=1080&fit=crop"
                    alt="Arhivski dokumenti">
                <div class="slider-overlay"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-4xl hero-content">
                            <div
                                class="inline-block px-4 py-2 bg-primary/20 border border-primary/50 rounded-full text-primary text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-laptop mr-2"></i>Pristup 24/7
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-primary_text leading-tight">
                                Digitalna<br />
                                <span class="text-primary">Revolucija</span>
                            </h1>
                            <p class="text-2xl mb-10 text-secondary_text max-w-2xl leading-relaxed">
                                Pristupite arhivskoj građi online, bilo gde, bilo kada. Vaša istorija na dohvat ruke
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-primary to-primary_hover rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-primary/50 transition btn-shine text-primary_text transform hover:scale-105">
                                    <i class="fas fa-laptop mr-2"></i>Digitalna Čitaonica
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-primary_text transform hover:scale-105">
                                    <i class="fas fa-info-circle mr-2"></i>Saznaj Više
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1920&h=1080&fit=crop"
                    alt="Biblioteka">
                <div class="slider-overlay"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-4xl hero-content">
                            <div
                                class="inline-block px-4 py-2 bg-primary/20 border border-primary/50 rounded-full text-primary text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-users mr-2"></i>Stručna podrška
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-primary_text leading-tight">
                                Istraživačke<br />
                                <span class="text-primary">Usluge</span>
                            </h1>
                            <p class="text-2xl mb-10 text-secondary_text max-w-2xl leading-relaxed">
                                Profesionalna podrška za vaša istorijska istraživanja od strane certificovanih arhivista
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-primary to-primary_hover rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-primary/50 transition btn-shine text-primary_text transform hover:scale-105">
                                    <i class="fas fa-calendar-check mr-2"></i>Zakaži Posetu
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-primary_text transform hover:scale-105">
                                    <i class="fas fa-phone mr-2"></i>Kontaktiraj Nas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button id="prevButton" onclick="prevSlide()"
            class="slider-control slider-next absolute left-6 top-1/2 transform -translate-y-1/2 w-14 h-14 rounded-full flex items-center justify-center z-10">
            <i class="fas fa-chevron-left text-2xl text-primary_text"></i>
        </button>

        <button id="nextButton" onclick="nextSlide()"
            class="slider-control absolute right-6 top-1/2 transform -translate-y-1/2 w-14 h-14 rounded-full flex items-center justify-center z-10">
            <i class="fas fa-chevron-right text-2xl text-primary_text"></i>
        </button>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
            <button id="indicator0" onclick="goToSlide(0)"
                class="slider-indicator w-3 h-3 rounded-full bg-primary_text active"></button>
            <button id="indicator1" onclick="goToSlide(1)"
                class="slider-indicator w-3 h-3 rounded-full bg-primary_text/30"></button>
            <button id="indicator2" onclick="goToSlide(2)"
                class="slider-indicator w-3 h-3 rounded-full bg-primary_text/30"></button>
        </div>

    </section>



    <section id="fondovi" class="py-24 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Istaknuti Fondovi
                    <span
                        class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></span>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-4">
                    Istražite našu jedinstvenu kolekciju istorijskih dokumenata i kulturnog nasleđa
                </p>
            </div>

            <div id="fondoviCards" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="fond-card card-hover card-3d glass-dark rounded-2xl overflow-hidden">
                        <div class="img-overlay h-64">
                            <img id="g-image"
                                src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600&h=400&fit=crop"
                                alt="Fond slika" class="w-full h-full object-cover">
                            <div class="absolute top-4 right-4">
                                <span id="g-naziv"
                                    class="px-4 py-2 bg-primary rounded-full text-sm font-semibold text-primary_text">Istraživački
                                    fondovi</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 id="g-title" class="text-2xl font-bold mb-3 text-primary_text">Građanska Matična Knjiga</h3>
                            <p id="g-opis" class="text-secondary_text mb-4">Kompletni matični zapisi rođenih,
                                venčanih i umrlih građana
                                iz perioda 1850-1920.</p>
                            <div class="flex justify-between items-center mb-4">
                                <span id="g-organizacija" class="text-sm text-primary">
                                    <i class="fas fa-building mr-2"></i>Istorijski arhiv
                                </span>
                                <span id="g-rok" class="text-sm text-secondary_text">
                                    <i class="fas fa-calendar mr-2"></i>31.12.2025
                                </span>
                            </div>
                            <div class="mt-2 mb-4">
                                <span id="g-iznos" class="text-sm text-accent">
                                    <i class="fas fa-coins mr-2"></i>Iznos finansiranja: 500.000 RSD
                                </span>
                            </div>
                            <a href="#" id="g-ovise"
                                class="w-full py-3 bg-gradient-to-r from-primary to-primary_hover rounded-xl hover:shadow-lg hover:shadow-primary/30 transition btn-shine text-primary_text font-medium inline-block text-center">
                                Pregledaj Fond <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="text-center mt-12">
                <a href="/fondovi" id="fondsView"
                    class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center justify-center shadow-lg mx-auto max-w-xs w-auto">
                    <i class="fas fa-archive mr-3"></i>
                    Pogledaj sve fondove
                </a>
            </div>
        </div>
    </section>


    <section class="py-24 bg-background">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 glow decorative-line text-primary_text">Naša Istorija</h2>
                <p class="text-xl text-secondary_text max-w-3xl mx-auto">Više od jednog veka čuvanja kulturnog nasleđa
                </p>
            </div>

            <div class="relative max-w-5xl mx-auto">
                <div class="timeline-glow absolute left-8 top-0 bottom-0"></div>

                <div class="space-y-12">
                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-primary_text">1912</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-primary_text">Osnivanje Arhiva</h3>
                            <p class="text-secondary_text text-lg">Istorijski arhiv osnovan kao deo gradskog muzeja.
                                Početna
                                kolekcija obuhvata 800 dokumenata iz lokalne istorije i administrative.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-primary_text">1945</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-primary_text">Posleratna Obnova</h3>
                            <p class="text-secondary_text text-lg">Premeštanje u novi prostor i započinjanje sistematske
                                organizacije ratom oštećene građe. Inkorporacija arhiva likvidiranih institucija.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-primary_text">1987</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-primary_text">Nova Zgrada</h3>
                            <p class="text-secondary_text text-lg">Preseljenje u posebno projektovanu zgradu sa modernim
                                depovima, klimatizacijom i prostorima za čuvanje arhivske građe.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-primary_text">2015</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-primary_text">Digitalna Transformacija</h3>
                            <p class="text-secondary_text text-lg">Započinjanje masovnog projekta digitalizacije.
                                Lansiranje
                                online platforme sa pretražljivom bazom podataka i digitalnom čitaonicom.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg shadow-primary/30 group-hover:scale-110 transition pulse">
                            <span class="text-xl font-bold text-primary_text">2023</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition border-2 border-primary">
                            <h3 class="text-3xl font-bold mb-3 text-primary_text">AI i Inovacije</h3>
                            <p class="text-secondary_text text-lg">Implementacija veštačke inteligencije za automatsku
                                kategorizaciju, OCR prepoznavanje rukopisa i naprednu semantičku pretragu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <footer class="bg-background text-secondary_text py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary_hover flex items-center justify-center mr-3">
                            <i class="fas fa-landmark text-xl text-primary_text"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary_text">Istorijski Arhiv</h3>
                    </div>
                    <p class="mb-4">Čuvamo i činimo dostupnim istorijsko nasleđe za sadašnje i buduće generacije.</p>
                    <p class="text-sm">&copy; 2023 Sva prava zadržana.</p>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-primary_text mb-4">Brzi Linkovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">O Nama</a></li>
                        <li><a href="#" class="hover:text-primary transition">Fondovi i Zbirke</a></li>
                        <li><a href="#" class="hover:text-primary transition">Digitalna Arhiva</a></li>
                        <li><a href="#" class="hover:text-primary transition">Priručnici</a></li>
                        <li><a href="#" class="hover:text-primary transition">Vesti</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-primary_text mb-4">Usluge</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">Čitaonica</a></li>
                        <li><a href="#" class="hover:text-primary transition">Reprografija</a></li>
                        <li><a href="#" class="hover:text-primary transition">Digitalizacija</a></li>
                        <li><a href="#" class="hover:text-primary transition">Stručna Pomoć</a></li>
                        <li><a href="#" class="hover:text-primary transition">Online Pretraga</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-primary_text mb-4">Resursi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-primary transition">Vodiči za Istraživače</a></li>
                        <li><a href="#" class="hover:text-primary transition">Propisi i Pravila</a></li>
                        <li><a href="#" class="hover:text-primary transition">Publikacije</a></li>
                        <li><a href="#" class="hover:text-primary transition">Karijera</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-surface pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm mb-4 md:mb-0">Dizajnirano sa <i class="fas fa-heart text-red-500"></i> za očuvanje
                    istorije</p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="hover:text-primary transition">Politika Privatnosti</a>
                    <a href="#" class="hover:text-primary transition">Uslovi Korišćenja</a>
                    <a href="#" class="hover:text-primary transition">Mapa Sajta</a>
                </div>
            </div>
        </div>
    </footer>

    <button onclick="scrollToTop()" id="scrollTopBtn"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-primary to-primary_hover rounded-full flex items-center justify-center shadow-lg hover:shadow-primary/50 transition opacity-0 pointer-events-none z-50">
        <i class="fas fa-arrow-up text-xl text-primary_text"></i>
    </button>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item') || [];
        const indicators = document.querySelectorAll('.slider-indicator') || [];
        const totalSlides = slides.length || 0;

        function showSlide(index) {
            if (!totalSlides) return;
            currentSlide = index;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;

            const slider = document.getElementById('slider');
            if (slider) slider.style.transform = `translateX(-${currentSlide * 100}%)`;

            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === currentSlide);
            });
        }

        function nextSlide() { showSlide(currentSlide + 1); }
        function prevSlide() { showSlide(currentSlide - 1); }
        function goToSlide(index) { showSlide(index); }

        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const indicator0 = document.getElementById('indicator0');
        const indicator1 = document.getElementById('indicator1');
        const indicator2 = document.getElementById('indicator2');

        prevButton?.addEventListener('click', prevSlide);
        nextButton?.addEventListener('click', nextSlide);
        indicator0?.addEventListener('click', () => goToSlide(0));
        indicator1?.addEventListener('click', () => goToSlide(1));
        indicator2?.addEventListener('click', () => goToSlide(2));

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('animate-fade-in');
                });
            }, { threshold: 0.5, rootMargin: '0px' });
            document.querySelectorAll('.card-hover').forEach(card => observer.observe(card));
        }

        window.addEventListener('scroll', () => {
            const parallax = document.querySelector('.parallax');
            if (parallax) {
                const scrolled = window.pageYOffset;
                const rate = scrolled * 0.3;
                parallax.style.transform = `translate3d(0, ${rate}px, 0)`;
            }
        });

        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });
            document.querySelectorAll('img').forEach(img => imageObserver.observe(img));
        }

        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const openMobileMenu = document.getElementById('openMobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileAboutToggle = document.getElementById('mobileAboutToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');

        function toggleMobileMenu(show) {
            if (!mobileMenu || !mobileMenuPanel) return;
            mobileMenu.classList.toggle('hidden', !show);
            if (show) {
                setTimeout(() => {
                    mobileMenuPanel.style.transform = 'translateX(0)';
                }, 100);
            } else {
                mobileMenuPanel.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        }

        function toggleMobileAboutMenu() {
            if (!mobileAboutMenu || !mobileAboutIcon) return;
            const isHidden = mobileAboutMenu.classList.contains('hidden');
            mobileAboutMenu.classList.toggle('hidden');
            mobileAboutIcon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0)';
        }

        openMobileMenu?.addEventListener('click', () => toggleMobileMenu(true));
        closeMobileMenu?.addEventListener('click', () => toggleMobileMenu(false));
        mobileMenuOverlay?.addEventListener('click', () => toggleMobileMenu(false));
        mobileAboutToggle?.addEventListener('click', toggleMobileAboutMenu);

        const languageButtons = document.querySelectorAll('.language-btn') || [];
        let currentLang = 'sr-Latn';

        languageButtons.forEach(button => {
            button.addEventListener('click', function () {
                const lang = this.dataset.lang;
                if (lang === currentLang) return;

                languageButtons.forEach(btn => {
                    btn.classList.remove('bg-primary/10', 'text-primary');
                });

                this.classList.add('bg-primary/10', 'text-primary');
                currentLang = lang;
            });
        });

        const defaultLangButton = document.querySelector(`[data-lang="${currentLang}"]`);
        defaultLangButton?.classList.add('bg-primary/10', 'text-primary');

        console.log('%c🏛️ Istorijski Arhiv', 'font-size: 24px; font-weight: bold; color: #d4af37;');
        console.log('%cDobrodošli u konzolu našeg arhiva!', 'font-size: 16px; color: #666;');
    </script>

</body>

</html>