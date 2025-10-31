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

    <style>
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

<body class="bg-[#f8f5f0] text-[#333]">
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-paper shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
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
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-terracotta"></i>Početna
                    </a>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-ochre"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-book mr-2 text-royal-blue"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-flag mr-2 text-deep-teal"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-history mr-2 text-terracotta"></i>Istorijat
                            </a>
                            <a data-page="Rukovodstvo" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-users-cog mr-2 text-indigo-500"></i>Rukovodstvo
                            </a>
                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-building mr-2 text-gray-500"></i>Objekat
                            </a>
                            <a data-page="Donacije i podrška" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-red-500"></i>Donacije i podrška
                            </a>
                            <a data-page="Partneri" href="#"
                                class="flex items-center py-2 px-4 text-sm text-slate hover:text-terracotta transition-colors">
                                <i class="fas fa-handshake mr-2 text-green-500"></i>Partneri
                            </a>
                        </div>

                    </div>
                    <a data-page="Dogadjaji" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-royal-blue"></i>Dogadjaji
                    </a>

                    <a data-page="Galerija" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-velvet"></i>Galerija
                    </a>
                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-coral"></i>Dokumenti
                    </a>
                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-slate hover:text-terracotta hover:bg-slate-50 rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-deep-teal"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Font size toggle button -->
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-[#2C3E50] hover:bg-[#1A252F] text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none transition-all"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <!-- Header with library theme -->
    <header class="fixed w-full z-50 py-3 bg-[#2C3E50] shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-14 h-14 bg-[#8B6B61] rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-book-open text-2xl text-[#F8F5F0]"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-display font-bold text-[#F8F5F0] tracking-wider">KULTURNI NEXUS</h1>
                    <p class="text-xs text-[#D4AF37] tracking-widest">CENTAR ZA UMETNOST I BAŠTINU</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-8">
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-home mr-2 text-[#D4AF37]"></i>Pocetna
                </a>

                <div class="dropdown relative group">
                    <button class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-2 text-[#D4AF37]"></i>O nama
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute bg-[#F8F5F0] rounded-md shadow-lg py-2 min-w-[200px] mt-2 hidden group-hover:block">
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-[#e9e4d8] rounded-md text-[#2C3E50]">
                            <i class="fas fa-bullseye mr-2"></i>Cilj
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-[#e9e4d8] rounded-md text-[#2C3E50]">
                            <i class="fas fa-sitemap mr-2"></i>Upravljačka struktura
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-[#e9e4d8] rounded-md text-[#2C3E50]">
                            <i class="fas fa-flag mr-2"></i>Misija
                        </a>
                    </div>
                </div>

                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-calendar-alt mr-2 text-[#D4AF37]"></i>Dogadjaji
                </a>
                <div class="dropdown relative group">
                    <button class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                        <i class="fas fa-child mr-2 text-[#D4AF37]"></i>Usluge
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute bg-[#F8F5F0] rounded-md shadow-lg py-2 min-w-[200px] mt-2 hidden group-hover:block">
                        <a static="true" href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-[#e9e4d8] rounded-md text-[#2C3E50]">
                            <i class="fas fa-book-open mr-2"></i>Za decu
                        </a>
                        <a static="true" href="#"
                            class="dropdown-item flex items-center px-4 py-2 hover:bg-[#e9e4d8] rounded-md text-[#2C3E50]">
                            <i class="fas fa-paint-brush mr-2"></i>Radionica i igre
                        </a>
                    </div>
                </div>
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-theater-masks mr-2 text-[#D4AF37]"></i>Repertoar
                </a>

                <!-- Vesti -->
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-newspaper mr-2 text-[#D4AF37]"></i>Vesti
                </a>
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-images mr-2 text-[#D4AF37]"></i>Galerija
                </a>
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold group flex items-center">
                    <i class="fas fa-folder-open mr-2 text-[#D4AF37]"></i>
                    Dokumenti
                </a>
                <a href="#" class="nav-link text-[#F8F5F0] font-semibold flex items-center">
                    <i class="fas fa-address-book mr-2 text-[#D4AF37]"></i>Kontakt
                </a>

            </nav>

            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="searchButton"
                        class="text-[#F8F5F0] hover:text-[#D4AF37] transition-colors focus:outline-none"
                        aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="searchInputContainer"
                        class="absolute right-0 top-10 hidden w-64 bg-[#F8F5F0] rounded-md shadow-lg p-2 z-50">
                        <div class="flex">
                            <input type="text" placeholder="Pretraži..."
                                class="w-full border border-[#8B6B61] rounded-l-md py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#8B6B61]"
                                id="searchInput" />
                            <button class="bg-[#8B6B61] text-[#F8F5F0] px-4 rounded-r-md" id="closeSearch"
                                aria-label="Close search">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button id="hamburger" class="hamburger lg:hidden text-[#F8F5F0] w-8 h-8 flex flex-col justify-between">
                    <span class="block w-8 h-1 bg-[#F8F5F0] rounded"></span>
                    <span class="block w-8 h-1 bg-[#F8F5F0] rounded my-1"></span>
                    <span class="block w-8 h-1 bg-[#F8F5F0] rounded"></span>
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
                <div class="max-w-2xl bg-[#F8F5F0] bg-opacity-90 p-8 rounded-xl shadow-xl">
                    <div class="mb-8">
                        <span
                            class="inline-block bg-[#D4AF37] text-[#2C3E50] px-4 py-1 rounded-full text-sm font-medium mb-6">
                            <i class="fas fa-star mr-2"></i>Istaknuto ovog meseca
                        </span>
                        <h1 class="text-4xl md:text-5xl font-display font-bold leading-tight text-[#2C3E50] mb-6">
                            <span class="block">Mesto gde se umetnost, knjiga i</span>
                            <span class="block text-[#8B6B61] mt-2">kultura susreću</span>
                        </h1>
                    </div>

                    <div class="mb-10 relative pl-6 border-l-4 border-[#8B6B61]">
                        <p class="text-lg text-[#2C3E50] leading-relaxed max-w-lg mb-6">
                            Doživite bogatstvo književnosti, umetnosti i kulture u našem novom renoviranom prostoru.
                        </p>
                        <p class="text-[#2C3E50] italic">
                            "Biblioteka nije luksuz, već jedna od potreba života."
                            <span class="block font-medium text-[#8B6B61] mt-2">— Henry Ward Beecher</span>
                        </p>
                    </div>

                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="flex items-center bg-[#e9e4d8] p-3 rounded-lg">
                            <i class="fas fa-book text-[#8B6B61] text-xl mr-3"></i>
                            <span class="text-[#2C3E50]">Preko 50,000 naslova</span>
                        </div>
                        <div class="flex items-center bg-[#e9e4d8] p-3 rounded-lg">
                            <i class="fas fa-users text-[#8B6B61] text-xl mr-3"></i>
                            <span class="text-[#2C3E50]">Čitaonice za sve uzraste</span>
                        </div>
                        <div class="flex items-center bg-[#e9e4d8] p-3 rounded-lg">
                            <i class="fas fa-calendar text-[#8B6B61] text-xl mr-3"></i>
                            <span class="text-[#2C3E50]">Dnevni kulturni program</span>
                        </div>
                        <div class="flex items-center bg-[#e9e4d8] p-3 rounded-lg">
                            <i class="fas fa-wifi text-[#8B6B61] text-xl mr-3"></i>
                            <span class="text-[#2C3E50]">Besplatan internet</span>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="book-spine bg-[#8B6B61] h-96 rounded-lg shadow-lg transform rotate-1"></div>
                        <div class="book-spine bg-[#2C3E50] h-80 rounded-lg shadow-lg transform -rotate-2 mt-8"></div>
                        <div class="book-spine bg-[#D4AF37] h-88 rounded-lg shadow-lg transform rotate-3 mt-4"></div>
                        <div class="book-spine bg-[#8B6B61] h-84 rounded-lg shadow-lg transform -rotate-1 mt-12"></div>
                        <div class="book-spine bg-[#2C3E50] h-92 rounded-lg shadow-lg transform rotate-2 mt-6"></div>
                        <div class="book-spine bg-[#D4AF37] h-76 rounded-lg shadow-lg transform -rotate-3 mt-10"></div>
                    </div>

                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#F8F5F0] rounded-full flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <h3 class="font-display text-xl font-bold text-[#2C3E50]">Kulturna Oaza</h3>
                            <p class="text-[#8B6B61] mt-2">Prostor za učenje, razmišljanje i inspiraciju</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-8 h-14 rounded-full border-2 border-[#8B6B61] flex justify-center p-1">
                <div class="w-2 h-2 bg-[#8B6B61] rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-[#F8F5F0]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl font-display font-bold text-[#2C3E50] mb-4 relative inline-block pb-2 border-b-4 border-[#8B6B61]">
                    Predstojeći Događaji
                </h2>
                <p class="text-lg text-[#2C3E50] max-w-2xl mx-auto mt-4">
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
                        <div class="category-badge bg-[#8B6B61] text-white">ČITANJE</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-[#8B6B61] flex items-center justify-center text-white mr-3">
                                <i class="fas fa-book"></i>
                            </div>
                            <span id="g-naziv" class="text-[#8B6B61] font-bold">KNJIŽEVNI VEČER</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-[#2C3E50] mb-2">Čitanje sa autorom</h3>
                        <p id="g-description" class="text-[#2C3E50] mb-4">Sastanak sa poznatim domaćim piscem i čitanje
                            iz najnovijeg romana.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span id="g-time">18:00 - 20:00</span>
                                </div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
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
                        <div class="category-badge bg-[#2C3E50] text-white">KLUB</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-[#2C3E50] flex items-center justify-center text-white mr-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-[#2C3E50] font-bold">KNJIŽNI KLUB</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-[#2C3E50] mb-2">"Na Drini ćuprija"</h3>
                        <p class="text-[#2C3E50] mb-4">Diskusija o Andrićevom remek-delu u okviru knjižnog kluba.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>17:00 - 19:00</span>
                                </div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Diskusiona sala</span>
                                </div>
                            </div>
                            <button
                                class="bg-[#8B6B61] text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-[#6d544a] transition-colors">
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
                        <div class="category-badge bg-[#D4AF37] text-[#2C3E50]">RADIONICA</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div
                                class="w-10 h-10 rounded-full bg-[#D4AF37] flex items-center justify-center text-[#2C3E50] mr-3">
                                <i class="fas fa-pen"></i>
                            </div>
                            <span class="text-[#D4AF37] font-bold">KREATIVNO PISANJE</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-[#2C3E50] mb-2">Radionica pisanja</h3>
                        <p class="text-[#2C3E50] mb-4">Kako razvijati kreativnost i savladati osnove pisanja priča.</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>16:00 - 18:00</span>
                                </div>
                                <div class="flex items-center text-sm text-[#2C3E50]">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Radionica prostor</span>
                                </div>
                            </div>
                            <button
                                class="bg-[#D4AF37] text-[#2C3E50] px-4 py-2 rounded-full text-sm font-medium hover:bg-[#bf982d] transition-colors">
                                Prijavi se
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button id="eventsView"
                    class="bg-[#2C3E50] text-white px-8 py-4 rounded-full font-medium hover:bg-[#1A252F] transition-all flex items-center shadow-lg mx-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Exhibition Section -->
    <section id="promocija" class="py-20 bg-[#e9e4d8]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 relative page-turn">
                    <div class="overflow-hidden rounded-xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=800&q=80"
                            alt="Featured Exhibition" class="rounded-xl w-full">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-24 h-24 bg-[#8B6B61] rounded-full flex items-center justify-center text-white text-2xl font-display font-bold shadow-xl">
                        <span>30%</span>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span
                        class="inline-block bg-[#D4AF37] text-[#2C3E50] px-4 py-1 rounded-full text-sm font-medium mb-6">
                        <i class="fas fa-fire mr-2"></i>Specijalna ponuda
                    </span>
                    <h2 class="text-4xl font-display font-bold text-[#2C3E50] mb-6">
                        <span class="block">Retrospektiva</span>
                        <span class="block text-[#8B6B61]">srpskih pisaca</span>
                    </h2>
                    <p class="text-lg text-[#2C3E50] mb-6 leading-relaxed">
                        Ekskluzivna izložba koja obuhvata najznačajnija dela srpskih književnika 20. veka. Ova
                        retrospektiva predstavlja jedinstvenu priliku da se upoznate sa evolucijom srpske književnosti
                        kroz pet decenija.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-[#8B6B61] text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-[#2C3E50]">Datum</p>
                                <p class="font-medium">1. jun - 15. jul</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-[#8B6B61] text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-[#2C3E50]">Vreme</p>
                                <p class="font-medium">10:00 - 20:00</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-[#8B6B61] text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-[#2C3E50]">Lokacija</p>
                                <p class="font-medium">Galerija književnosti</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-gradient-to-r from-[#8B6B61] to-[#6d544a] text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center shadow-lg">
                            <i class="fas fa-ticket-alt mr-3"></i>
                            Rezerviši karte
                        </button>
                        <button
                            class="border-2 border-[#8B6B61] text-[#8B6B61] px-8 py-4 rounded-full font-medium hover:bg-[#8B6B61]/10 transition-all flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Saznaj više
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-[#F8F5F0]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-display font-bold text-[#2C3E50] mb-4">
                    Naši Prostori
                </h2>
                <p class="text-lg text-[#2C3E50] max-w-2xl mx-auto">
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
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 id="g-description" class="font-bold text-lg">Glavna čitaonica</h3>
                        <p id="g-title" class="text-sm">Prostor za čitanje i učenje</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=600&q=80"
                        alt="Bookshelves"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 class="font-bold text-lg">Knjižni fond</h3>
                        <p class="text-sm">Preko 50,000 naslova</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=600&q=80"
                        alt="Reading Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 class="font-bold text-lg">Dečija čitaonica</h3>
                        <p class="text-sm">Prostor za najmlađe čitaoce</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=80"
                        alt="Study Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 class="font-bold text-lg">Studijska zona</h3>
                        <p class="text-sm">Prostor za koncentraciju</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 class="font-bold text-lg">Radionica</h3>
                        <p class="text-sm">Prostor za kreativne radionice</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1491975474562-1f4e30bc9468?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#2C3E50] to-transparent p-4 text-white">
                        <h3 class="font-bold text-lg">Knjižni kafić</h3>
                        <p class="text-sm">Mesto za opuštanje uz knjigu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#2C3E50] text-[#F8F5F0] pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-[#8B6B61] rounded-lg flex items-center justify-center text-[#F8F5F0] mr-3">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <h3 class="text-xl font-display font-bold">KULTURNI NEXUS</h3>
                    </div>
                    <p class="text-[#F8F5F0]/80 mb-4">
                        Centar za umetnost i kulturu koji okuplja kreativce i publiku u srcu Beograda.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#8B6B61]/30 hover:bg-[#8B6B61] flex items-center justify-center text-[#F8F5F0] transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#8B6B61]/30 hover:bg-[#8B6B61] flex items-center justify-center text-[#F8F5F0] transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#8B6B61]/30 hover:bg-[#8B6B61] flex items-center justify-center text-[#F8F5F0] transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#8B6B61]/30 hover:bg-[#8B6B61] flex items-center justify-center text-[#F8F5F0] transition-colors">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Brzi linkovi</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Izložbe</a>
                        </li>
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Knjižni
                                fond</a></li>
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Radionice</a>
                        </li>
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Događaji</a>
                        </li>
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Članstvo</a>
                        </li>
                        <li><a href="#" class="text-[#F8F5F0]/80 hover:text-[#D4AF37] transition-colors">Kalendar</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Informacije</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-[#D4AF37] mt-1 mr-3"></i>
                            <span>Knez Mihailova 56, 11000 Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-[#D4AF37] mt-1 mr-3"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-[#D4AF37] mt-1 mr-3"></i>
                            <span>info@kulturninexus.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-[#D4AF37] mt-1 mr-3"></i>
                            <span>
                                Utorak - Nedelja: 10:00 - 20:00<br>
                                Ponedeljak: zatvoreno
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-display font-bold mb-6">Newsletter</h4>
                    <p class="mb-4 text-[#F8F5F0]/80">Prijavite se za obaveštenja o novim događajima i promocijama</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Vaša email adresa"
                            class="w-full px-4 py-2 rounded-md bg-[#1A252F] text-[#F8F5F0] border border-[#8B6B61] focus:outline-none focus:ring-1 focus:ring-[#D4AF37]">
                        <button type="submit"
                            class="bg-[#8B6B61] text-white w-full py-2 rounded-md hover:bg-[#6d544a] transition-colors">Prijavi
                            se</button>
                    </form>
                </div>
            </div>

            <div class="border-t border-[#1A252F] pt-8 text-center text-[#F8F5F0]/60 text-sm">
                <p>&copy; 2023 Kulturni Centar Nexus. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        // Font size toggle functionality
        const btn = document.getElementById('increaseFontBtn');
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

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchInputContainer = document.getElementById('searchInputContainer');
        const closeSearch = document.getElementById('closeSearch');

        searchButton.addEventListener('click', () => {
            searchInputContainer.classList.toggle('hidden');
        });

        closeSearch.addEventListener('click', () => {
            searchInputContainer.classList.add('hidden');
        });

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu && mobileMenu.classList.contains('active') &&
                !mobileMenu.contains(e.target) &&
                e.target !== hamburger &&
                !hamburger.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Events view button
        document.querySelector("#eventsView").addEventListener('click', () => {
            window.location.href = "/dogadjaji";
        });

        // Header scroll effect
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>