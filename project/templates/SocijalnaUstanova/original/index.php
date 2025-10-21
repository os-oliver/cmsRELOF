<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centar za socijalni rad</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        .mobile-dropdown > div:last-child {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        .mobile-dropdown.active > div:last-child {
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
                background: linear-gradient(135deg, #f5ebe0 0%, #d4a373 100%);
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
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="%23f5ebe0"></path></svg>');
                background-size: 100% 100px;
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

            /* Hero Image Slider Styles */
            .hero-slider {
                position: relative;
                width: 100%;
                height: 100%;
                overflow: hidden;
                border-radius: 12px;
            }

            .hero-slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }

            .hero-slide.active {
                opacity: 1;
            }

            .hero-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* Slider Dots */
            .slider-dots {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 10px;
                z-index: 10;
            }

            .dot {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: rgba(255,255,255,0.5);
                cursor: pointer;
                transition: all 0.3s ease;
                border: 1px solid rgba(255,255,255,0.8);
            }

            .dot.active {
                background: white;
                transform: scale(1.2);
                box-shadow: 0 0 10px rgba(255,255,255,0.8);
            }

            .dot:hover {
                background: rgba(255,255,255,0.8);
                transform: scale(1.1);
            }
        }
    </style>
</head>

<body class="bg-light font-body text-slate min-h-screen overflow-x-hidden">
    <!-- Enhanced Header -->
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-light shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-white font-display font-bold text-slate">Menu</h2>
                    <button id="closeMobileMenu" class="text-slate hover:text-terracotta transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-red-600"></i>Početna
                    </a>
                    
                    <!-- O nama dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-blue-600"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
                        </button>
                        <div>
                            <a data-page="Cilj" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-bullseye mr-2 text-green-600"></i>Cilj
                            </a>
                            <a data-page="Misija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-compass mr-2 text-blue-600"></i>Misija
                            </a>
                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-building mr-2 text-teal-600"></i>Objekat
                            </a>
                            <a data-page="Zaposleni" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-user-tie mr-2 text-purple-600"></i>Zaposleni
                            </a>
                            <a data-page="Sluzbe" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-user-md mr-2 text-orange-600"></i>Službe
                            </a>
                            <a data-page="Podrska" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-pink-600"></i>Podrška
                            </a>
                        </div>
                    </div>

                    <!-- Prava i usluge dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-hands-helping mr-3 text-green-600"></i>Prava i usluge
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
                        </button>
                        <div>
                            <a data-page="Prava" href="/prava-i-usluge/prava"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-clipboard-list mr-2 text-blue-600"></i>Prava
                            </a>
                            <a data-page="Usluge" href="/prava-i-usluge/usluge"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-concierge-bell mr-2 text-green-600"></i>Usluge
                            </a>
                            <a data-page="ProgramiObuke" href="/prava-i-usluge/programi-obuke"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-graduation-cap mr-2 text-orange-600"></i>Programi obuke
                            </a>
                        </div>
                    </div>

                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-yellow-600"></i>Dokumenti
                    </a>

                    <a data-page="Dogadjaji" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-blue-600"></i>Dogadjaji
                    </a>

                    <!-- Za korisnike dropdown -->
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-user-friends mr-3 text-purple-600"></i>Za korisnike
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
                        </button>
                        <div>
                            <a data-page="NasiKorisnici" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-users mr-2 text-blue-600"></i>Naši korisnici
                            </a>
                            <a data-page="Obrasci" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-file-signature mr-2 text-green-600"></i>Obrasci za podnošenje zahteva
                            </a>
                            <a data-page="FAQ" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-red-600 transition-colors">
                                <i class="fas fa-question-circle mr-2 text-orange-600"></i>FAQ
                            </a>
                        </div>
                    </div>

                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-red-600 hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-teal-600"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
    <header
        class="fixed w-full z-50 transition-all duration-300 py-3 sm:py-4 backdrop-blur-md shadow-lg bg-light/95 border-b border-gray-100">
        <div class="container mx-auto px-3 sm:px-4 lg:px-6 flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-2 sm:space-x-3 flex-shrink-0">
                <div
                    class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6 lg:h-8 lg:w-8 text-white drop-shadow-sm" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M21.4 9.64C21.4 5.24 18.29 2 12 2S2.6 5.24 2.6 9.64c0 2.5 1.1 4.8 2.8 6.4L12 22l6.6-6c1.7-1.6 2.8-3.9 2.8-6.36zM12 11.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                        <circle cx="9" cy="9" r="1" opacity="0.7"/>
                        <circle cx="15" cy="9" r="1" opacity="0.7"/>
                        <circle cx="12" cy="13" r="1" opacity="0.7"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <h1
                        class="text-base sm:text-lg lg:text-xl xl:text-2xl font-display text-slate font-bold tracking-wider leading-tight">
                        CENTAR ZA SOCIJALNI RAD</h1>
                    <p
                        class="text-xs sm:text-xs lg:text-sm text-red-600 tracking-widest hidden md:block opacity-80 font-medium">
                        PODRŠKA I BRIGA ZA ZAJEDNICU</p>
                </div>
                <div class="block sm:hidden">
                    <h1 class="text-base font-display text-slate font-bold tracking-wide">CSR</h1>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex items-center space-x-0.5 xl:space-x-1">
                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                    <i class="fas fa-home mr-2 text-terracotta group-hover:text-coral transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Početna</span>
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                        <i
                            class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">O nama</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 min-w-max max-w-xs w-auto bg-white rounded-xl shadow-2xl border border-gray-100 hidden group-hover:block transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-bullseye mr-3 text-green-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Cilj</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-compass mr-3 text-blue-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Misija</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-building mr-3 text-teal-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Objekat</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-user-tie mr-3 text-purple-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Zaposleni</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-user-md mr-3 text-orange-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Službe</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-hand-holding-heart mr-3 text-pink-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Podrška</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                        <i
                            class="fas fa-hands-helping mr-2 text-green-600 group-hover:text-green-700 transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">Prava i usluge</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 min-w-max max-w-xs w-auto bg-white rounded-xl shadow-2xl border border-gray-100 hidden group-hover:block transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                        <a href="/prava-i-usluge/prava"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-clipboard-list mr-3 text-blue-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Prava</span>
                        </a>
                        <a href="/prava-i-usluge/usluge"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-concierge-bell mr-3 text-green-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Usluge</span>
                        </a>
                        <a href="/prava-i-usluge/programi-obuke"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-graduation-cap mr-3 text-orange-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Programi obuke</span>
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-red-600 transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                    <i
                        class="fas fa-folder-open mr-2 text-yellow-600 group-hover:text-yellow-700 transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Dokumenti</span>
                </a>

                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-red-600 transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                    <i
                        class="fas fa-calendar-alt mr-2 text-blue-600 group-hover:text-blue-700 transition-colors text-sm"></i>
                    <span class="hidden xl:inline text-sm">Dogadjaji</span>
                </a>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                        <i
                            class="fas fa-user-friends mr-2 text-purple-600 group-hover:text-purple-700 transition-colors text-sm"></i>
                        <span class="hidden xl:inline text-sm">Za korisnike</span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 min-w-max max-w-xs w-auto bg-white rounded-xl shadow-2xl border border-gray-100 hidden group-hover:block transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-users mr-3 text-blue-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Naši korisnici</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-file-signature mr-3 text-green-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">Obrasci za podnošenje zahteva</span>
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                            <i class="fas fa-question-circle mr-3 text-orange-600 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium">FAQ</span>
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="nav-link text-slate font-semibold hover:text-red-600 transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                    <i
                        class="fas fa-address-book mr-2 text-teal-600 group-hover:text-teal-700 transition-colors text-sm"></i>
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
                <div class="dropdown nonPage relative group ">
                    <button
                        class="nav-link text-slate font-semibold hover:text-terracotta transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-slate-50 group">
                        <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                        <i
                            class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0 min-w-max bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-2 backdrop-blur-sm">
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
            <div class="flex items-center space-x-1 sm:space-x-3">
                <!-- Search Container -->
                <div class="relative">
                    <button id="searchButton"
                        class="text-slate-500 hover:text-terracotta transition-all duration-200 focus:outline-none p-2 sm:p-2.5 rounded-full hover:bg-slate-50"
                        aria-label="Search">
                        <i class="fas fa-search text-sm sm:text-base"></i>
                    </button>
                    <!-- Enhanced Search Input -->
                    <div id="searchInputContainer"
                        class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] sm:min-w-[320px] bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden backdrop-blur-sm">
                        <form id="searchForm" class="flex items-center w-full p-2" action="/search" method="GET">
                            <input type="text" name="q" placeholder="Pretražite sadržaj..."
                                class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-4 py-2.5 text-gray-700 placeholder-gray-400 bg-gray-50 rounded-lg"
                                id="searchInput" required />
                            <div class="flex items-center space-x-1 ml-2">
                                <button type="submit"
                                    class="text-slate-500 hover:text-terracotta transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-gray-100 w-9 h-9 flex items-center justify-center"
                                    aria-label="Submit search">
                                    <i class="fas fa-search text-sm"></i>
                                </button>
                                <button type="button"
                                    class="text-slate-500 hover:text-red-500 transition-all duration-200 focus:outline-none p-2 rounded-full hover:bg-gray-100 w-9 h-9 flex items-center justify-center"
                                    id="closeSearch" aria-label="Close search">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Enhanced Mobile Menu Button -->
                <button id="hamburger"
                    class="hamburger lg:hidden text-slate w-9 h-9 sm:w-10 sm:h-10 flex flex-col justify-center items-center space-y-1 p-2 rounded-lg hover:bg-slate-50 transition-all duration-200">
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-slate rounded transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </header>




    <!-- Enhanced Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-gradient-to-br from-blue-50 via-white to-red-50">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 z-0">
            <!-- Floating care elements -->
            <div class="absolute top-20 left-10 w-80 h-40 bg-blue-200 opacity-15 transform rotate-12 rounded-full floating">
            </div>
            <div class="absolute bottom-40 right-20 w-64 h-32 bg-green-200 opacity-10 transform -rotate-6 rounded-full floating"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-red-200 opacity-10 floating" style="animation-delay: 2s;">
            </div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 bg-orange-200 opacity-10 rounded-full floating"
                style="animation-delay: 3s;"></div>

            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 20px 20px;">
            </div>

            <!-- Heart shapes -->
            <div class="absolute top-1/4 right-1/5 w-24 h-24 bg-red-300 opacity-10 rounded-full"
                style="clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);"></div>
            <div class="absolute bottom-1/3 left-1/6 w-20 h-20 bg-blue-300 opacity-10"
                style="clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);"></div>
        </div>

        <div class="container max-w-full mx-10 px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <div class="mb-8">
                        <span class="inline-block bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-medium mb-6">
                            <i class="fas fa-heart mr-2"></i>Podrška za sve
                        </span>
                        <h1 class="text-5xl md:text-6xl font-display font-bold leading-tight text-slate mb-6">
                            <span class="block">Dobro došli u</span>
                            <span class="block text-red-600 mt-2">Centar za socijalni rad</span>
                        </h1>
                    </div>

                    <div class="mb-10 relative pl-6 border-l-4 border-red-500">
                        <p class="text-xl text-slate-700 leading-relaxed max-w-lg mb-6">
                            Naš cilj je da pružimo podršku i pomoć pojedincima, porodicama i zajednici u rešavanju životnih poteškoća i unapređenju kvaliteta života.
                        </p>
                        <p class="text-slate-600 italic">
                            "Centar za socijalni rad je tu da vas sasluša, posavetuje i podrži. Zajedno gradimo društvo solidarnosti."
                            <span class="block font-medium text-red-600 mt-2">— Dr Marija Petrović, Direktor</span>
                        </p>
                    </div>

                    <!-- Quick links -->
                    <div class="mt-10 flex flex-wrap gap-3">
                        <a href="#" class="flex items-center text-slate-600 hover:text-red-600 transition-colors">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            Službe
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-red-600 transition-colors">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            Programi obuke
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-red-600 transition-colors">
                            <span class="w-3 h-3 bg-orange-500 rounded-full mr-2"></span>
                            Događaji
                        </a>
                        <a href="#" class="flex items-center text-slate-600 hover:text-red-600 transition-colors">
                            <span class="w-3 h-3 bg-teal-500 rounded-full mr-2"></span>
                            Kontakt
                        </a>
                    </div>
                </div>

                <!-- Social Services Showcase -->
                <div class="relative flex justify-center h-full" style="margin-top: 120px;">
                    <!-- Hero Image Slider -->
                    <div class="bg-white rounded-xl overflow-hidden relative shadow-lg hover:shadow-xl transition-shadow" style="width: 900px; height: 500px; min-height: 500px;">
                        <div class="hero-slider">
                            <!-- Slide 1 -->
                            <div class="hero-slide active">
                                <img src="https://picsum.photos/800/600?random=1" alt="Socijalna zaštita" />
                            </div>
                            <!-- Slide 2 -->
                            <div class="hero-slide">
                                <img src="https://picsum.photos/800/600?random=2" alt="Porodična podrška" />
                            </div>
                            <!-- Slide 3 -->
                            <div class="hero-slide">
                                <img src="https://picsum.photos/800/600?random=3" alt="Pomoć starima" />
                            </div>
                            
                            <!-- Dots Indicator -->
                            <div class="slider-dots">
                                <span class="dot active" data-slide="0"></span>
                                <span class="dot" data-slide="1"></span>
                                <span class="dot" data-slide="2"></span>
                            </div>
                        </div>
                        
                        <div class="absolute top-4 right-4 bg-blue-500/80 text-white px-3 py-1.5 rounded-lg text-sm font-medium z-10">
                            Socijalna zaštita
                        </div>
                    </div>
                </div>
            </div>
        </div>

       


    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Predstojeći događaji
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-blue-500"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Pratite naše nadolazeće događaje i učestvujte u aktivnostima koje organizujemo za građane. Svi događaji su besplatni i otvoreni za javnost.
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img id="g-image"
                            src="https://picsum.photos/600/300?random=10"
                            alt="Dan otvorenih vrata" class="w-full h-full object-cover">

                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <span id="g-naziv" class="text-blue-600 font-bold">DAN OTVORENIH VRATA</span>
                        </div>
                        <h3 id="g-title" class="text-xl font-display font-bold text-slate mb-2">Dan otvorenih vrata u Centru za socijalni rad
                        </h3>

                        <p id="g-description" class="text-slate-600 mb-4">Centar za socijalni rad vas poziva na Dan otvorenih vrata, gde možete da se upoznate sa našim službama i programima.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-calendar-days mr-2"></i>
                                    <span id="g-date">15. novembar 2024.</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span id="g-time">09:00 - 15:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span id="g-location">Velika sala Centra</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/300?random=11"
                            alt="Radionica roditeljskih veština" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            22 NOV
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <span class="text-green-600 font-bold">OBUKA</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Radionica roditeljskih veština</h3>
                        <p class="text-slate-600 mb-4">Program obuke namenjen roditeljima koji žele da unaprede svoje veštine u odgajanju dece i rešavanju porodičnih problema.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>10:00 - 14:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Sala za obuke</span>
                                </div>
                            </div>
                            <button
                                class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 transition-colors">
                                Prijava
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/300?random=12"
                            alt="Tribina o digitalnom nasilju" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            5 DEC
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-orange-600 font-bold">TRIBINA</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Sprečavanje digitalnog nasilja</h3>
                        <p class="text-slate-600 mb-4">Stručna tribina o prepoznavanju i sprečavanju digitalnog nasilja nad decom i mladima. Predavanje za roditelje i nastavnike.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>18:00 - 20:00</span>
                                </div>
                                <div class="flex items-center text-sm text-slate-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Amfiteatar</span>
                                </div>
                            </div>
                            <button
                                class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-orange-600 transition-colors">
                                Rezerviši
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/dogadjaji" id="eventsView"
                    class="bg-gradient-to-r from-blue-600 to-red-600 text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all inline-flex items-center shadow-lg">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </a>
            </div>
        </div>
    </section>

    <!-- Training Programs Section -->
    <section id="obuke" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Programi obuke
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-blue-500"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Učestvujte u našim programima obuke i unapredite svoje veštine. Svi programi su besplatni i prilagođeni različitim grupama korisnika.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Training Program 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/400?random=20"
                            alt="Roditeljske veštine" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-green-500/80 text-white px-2 py-1 rounded text-sm">Novo</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-baby"></i>
                            </div>
                            <span class="text-green-600 font-bold">RODITELJSTVO</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Program obuke „Roditeljske veštine"</h3>
                        <p class="text-slate-600 mb-4">Ovaj program namenjen je roditeljima koji žele da unaprede svoje veštine u odgajanju dece i rešavanju porodičnih problema.</p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-slate-500">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Svake nedelje</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>18:00 - 20:00</span>
                                </div>
                            </div>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Training Program 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/400?random=21"
                            alt="Komunikacija sa decom" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-comments"></i>
                            </div>
                            <span class="text-blue-600 font-bold">KOMUNIKACIJA</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Efikasna komunikacija sa decom</h3>
                        <p class="text-slate-600 mb-4">Naučite tehnike konstruktivnog razgovora sa decom različitih uzrasta i kako da rešavate konflikte u porodici.</p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-slate-500">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Mesečno</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>16:00 - 18:00</span>
                                </div>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-600 transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Training Program 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                    <div class="h-48 relative">
                        <img src="https://picsum.photos/600/400?random=22"
                            alt="Podrška starima" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white mr-3">
                                <i class="fas fa-heart"></i>
                            </div>
                            <span class="text-orange-600 font-bold">STARIJI</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-slate mb-2">Nega i podrška starijih osoba</h3>
                        <p class="text-slate-600 mb-4">Program obuke za članove porodice koji brinu o starijim osobama, sa fokusom na praktične veštine i emocionalnu podršku.</p>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-slate-500">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Kvartalno</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>14:00 - 17:00</span>
                                </div>
                            </div>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-orange-600 transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="/prava-i-usluge/programi-obuke" class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all inline-flex items-center shadow-lg">
                    <i class="fas fa-graduation-cap mr-3"></i>
                    Pogledaj sve programe obuke
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="sluzbe" class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4 relative inline-block">
                    Službe
                    <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-green-500"></span>
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto mt-4">
                    Centar za socijalni rad pruža širok spektar usluga namenjenih različitim kategorijama građana koji se nalaze u stanju socijalne potrebe.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Service 1 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-blue-100 group-hover:bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Sigurna dečja kuća</h3>
                        <p class="text-sm text-slate-600">Zaštićeno stanovanje za decu</p>
                    </button>
                </div>

                <!-- Service 2 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-green-50 border border-gray-200 hover:border-green-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-green-100 group-hover:bg-green-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-child text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Zaštita dece i omladine</h3>
                        <p class="text-sm text-slate-600">Sveobuhvatna zaštita maloletnika</p>
                    </button>
                </div>

                <!-- Service 3 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-orange-100 group-hover:bg-orange-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-home text-orange-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Dnevni boravak za decu</h3>
                        <p class="text-sm text-slate-600">Dnevna briga i aktivnosti</p>
                    </button>
                </div>

                <!-- Service 4 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-purple-50 border border-gray-200 hover:border-purple-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-purple-100 group-hover:bg-purple-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-user-friends text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Zaštita odraslih i starih</h3>
                        <p class="text-sm text-slate-600">Podrška za odrasle i starije</p>
                    </button>
                </div>

                <!-- Service 5 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-yellow-50 border border-gray-200 hover:border-yellow-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-yellow-100 group-hover:bg-yellow-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-coins text-yellow-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Novčana socijalna pomoć</h3>
                        <p class="text-sm text-slate-600">Finansijska podrška porodicama</p>
                    </button>
                </div>

                <!-- Service 6 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-pink-50 border border-gray-200 hover:border-pink-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-pink-100 group-hover:bg-pink-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-heart text-pink-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Sigurna ženska kuća</h3>
                        <p class="text-sm text-slate-600">Zaštićeno stanovanje za žene</p>
                    </button>
                </div>

                <!-- Service 7 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-teal-50 border border-gray-200 hover:border-teal-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-teal-100 group-hover:bg-teal-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-comments text-teal-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Savetovalište</h3>
                        <p class="text-sm text-slate-600">Stručno savetovanje i podrška</p>
                    </button>
                </div>

                <!-- Service 8 -->
                <div class="group">
                    <button class="w-full bg-white hover:bg-indigo-50 border border-gray-200 hover:border-indigo-300 rounded-xl p-6 transition-all duration-300 hover:shadow-lg text-center">
                        <div class="w-16 h-16 bg-indigo-100 group-hover:bg-indigo-200 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                            <i class="fas fa-building text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">Odeljenja</h3>
                        <p class="text-sm text-slate-600">Specijalizovana odeljenja</p>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <button class="bg-gradient-to-r from-blue-600 to-green-600 text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-hands-helping mr-3"></i>
                    Saznaj više o našim službama
                </button>
            </div>
        </div>
    </section>


    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-slate mb-4">
                    Upoznajte naš prostor
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Pogledajte fotografije našeg centra i aktivnosti koje organizujemo za korisnike naših usluga.
                </p>
            </div>

            <div id="galleryCards" class="gallery-grid gap-6">
                <div class="gallery-item rounded-xl overflow-hidden relative">
                    <img id="g-image_file_path"
                        src="https://picsum.photos/600/400?random=30"
                        alt="Prijem građana" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 id="g-description" class="font-bold text-lg">Prijem građana</h3>
                        <p id="g-title" class="text-sm">Prostran i prijatan prijem</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/600/400?random=31"
                        alt="Savetovalište" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-white text-lg">Savetovalište</h3>
                        <p class="text-sm text-white">Prostor za privatne razgovore</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/600/400?random=32"
                        alt="Sala za obuke" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Sala za obuke</h3>
                        <p class="text-sm">Prostor za edukativne programe</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/600/400?random=33"
                        alt="Dečji boravak" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Dečji boravak</h3>
                        <p class="text-sm">Sigurno mesto za decu</p>
                    </div>
                </div>
                <div class="gallery-item rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/600/400?random=34"
                        alt="Kancelarije službi" class="w-full h-full object-cover">
                    <div class="overlay-content">
                        <h3 class="font-bold text-lg">Kancelarije službi</h3>
                        <p class="text-sm">Radno mesto stručnjaka</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate text-white pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center text-white mr-3">
                            <i class="fas fa-heart text-xl"></i>
                        </div>
                        <h3 class="text-xl font-display font-bold">CENTAR ZA SOCIJALNI RAD</h3>
                    </div>
                    <p class="text-white/80 mb-4">
                        Pružamo podršku i pomoć pojedincima, porodicama i zajednici u rešavanju životnih poteškoća.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-red-600/30 hover:bg-red-600 flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-red-600/30 hover:bg-red-600 flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-red-600/30 hover:bg-red-600 flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-red-600/30 hover:bg-red-600 flex items-center justify-center text-white transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Naše službe</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Zaštita dece</a></li>
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Porodično savetovanje</a></li>
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Pomoć starima</a></li>
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Novčana pomoć</a></li>
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Programi obuke</a></li>
                        <li><a href="#" class="text-white/80 hover:text-red-400 transition-colors">Sigurna kuća</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Kontakt informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-red-400 mt-1 mr-3"></i>
                            <span>Bulevar oslobođenja 26, 21000 Novi Sad</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-red-400 mt-1 mr-3"></i>
                            <span>+381 21 123 456</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-red-400 mt-1 mr-3"></i>
                            <span>info@csr-novisad.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-red-400 mt-1 mr-3"></i>
                            <span>
                                Ponedeljak - Petak: 07:30 - 15:30<br>
                                Hitni slučajevi: 24/7
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Lokacija</h4>
                    <div class="bg-white/10 rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d19.8451920155352!3d45.25407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sBulevar%20oslobo%C4%91enja%2026%2C%20Novi%20Sad!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8 text-center text-white/60 text-sm">
                <p>&copy; 2024 Centar za socijalni rad Novi Sad. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>

        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'clay': '#c97c5d',
                        'ochre': '#d4a373',
                        'sage': '#a3b18a',
                        'slate': '#6BA6E8',
                        'paper': '#f5ebe0',
                        'terracotta': '#bc6c25',
                        'coral': '#e76f51',
                        'deep-teal': '#2a9d8f',
                        'crimson': '#8d1b3d',
                        'royal-blue': '#1a4480',
                        'velvet': '#4a154b',
                        ochre: '#CC7722',
                        terracotta: '#E2725B',
                        paper: '#F5F5DC',
                        slate: '#2F4F4F',
                        'royal-blue': '#4169E1',
                        'deep-teal': '#008B8B',
                        velvet: '#872657',
                        crimson: '#DC143C',
                        coral: '#FF7F50',
                        sage: '#9CAF88'
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'crimson': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                    },
                    backgroundImage: {
                        'art-pattern': "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmNWViZTAiPjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiLz48L2c+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0idXJsKCNhKSIvPjxwYXRoIGQ9Ik0wIDBoMjB2MjBIMHoiIGZpbGw9IiNkNGExYjEiIG9wYWNpdHk9Ii4xIi8+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6IiBmaWxsPSIjYTNiMThhIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0wIDIwaDIwdjIwSDB6IiBmaWxsPSIjYjk3YzVkIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0yMCAyMGgyMHYyMEgyMHoiIGZpbGw9IiMzNDRlNDEiIG9wYWNpdHk9Ii4xIi8+PC9nPjwvc3ZnPg==')",
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/></svg>')",
                    }
                }
            }
        }


        // Hero Image Slider Functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            // Show current slide
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto slider - change every 4 seconds
        setInterval(nextSlide, 4000);

        // Dot click functionality
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        const btn = document.getElementById('increaseFontBtn');

        let currentSize = 16;       // initial font size in px
        let step = 2;               // px to increase or decrease per click
        let maxSteps = 3;           // max increments before toggling direction
        let count = 0;              // how many increments or decrements done
        let increasing = true;      // track if currently increasing font size

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

        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown button');

        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdown = toggle.closest('.mobile-dropdown');
                dropdown.classList.toggle('active');
            });
        });
        document.getElementById('searchButton').addEventListener('click', function () {
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

        document.getElementById('closeSearch').addEventListener('click', function () {
            const container = document.getElementById('searchInputContainer');
            container.classList.add('opacity-0');
            setTimeout(() => {
                container.classList.add('hidden');
            }, 300);
        });

        document.addEventListener('click', function (e) {
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
        window.addEventListener('scroll', function () {
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

        // Event listeners
        if (hamburger) {
            hamburger.addEventListener('click', function (e) {
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

        // Close menu when clicking on menu links (except dropdown buttons)
        const menuLinks = document.querySelectorAll('#mobileMenu nav a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Close menu after a short delay to allow for navigation
                setTimeout(closeMobileMenuFunc, 150);
            });
        });

        // Close menu on window resize if screen becomes large
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Handle escape key to close menu
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Prevent menu panel clicks from closing the menu
        if (mobileMenuPanel) {
            mobileMenuPanel.addEventListener('click', function (e) {
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
        }, { threshold: 0.1 });

        document.querySelectorAll('.event-card, .gallery-item, .section-divider').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>