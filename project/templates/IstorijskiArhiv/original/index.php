<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istorijski Arhiv - Digitalno Čuvanje Nasleđa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gold': {
                            50: '#fdfbf7',
                            100: '#faf6ed',
                            200: '#f4ebd2',
                            300: '#eedeb7',
                            400: '#e8d19c',
                            500: '#d4af37',
                            600: '#c9a961',
                            700: '#b8963c',
                            800: '#8b6f2d',
                            900: '#5e4a1e',
                        },
                        'dark': {
                            50: '#f5f6f7',
                            100: '#e4e7eb',
                            200: '#cbd2dc',
                            300: '#9aa5b6',
                            400: '#7b8794',
                            500: '#616e7c',
                            600: '#52606d',
                            700: '#3e4c59',
                            800: '#323f4b',
                            900: '#1f2933',
                            950: '#0a0f14',
                        }
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

<body class="bg-dark-950 text-white">
    <header>
        <nav class="fixed w-full z-50 glass-dark">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-gold-500 to-gold-700 flex items-center justify-center shadow-lg shadow-gold-500/30">
                            <i class="fas fa-landmark text-2xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white glow">Istorijski Arhiv</h1>
                            <p class="text-xs text-gold-400">Digitalno nasleđe</p>
                        </div>
                    </div>

                    <ul class="hidden md:flex space-x-6 text-white">
                        <li><a href="#" class="hover:text-gold-400 transition">Početna</a></li>
                        <li><a href="#fondovi" class="hover:text-gold-400 transition">Fondovi</a></li>
                        <li><a href="#digitalna" class="hover:text-gold-400 transition">Digitalna Arhiva</a></li>
                        <li><a href="#usluge" class="hover:text-gold-400 transition">Usluge</a></li>
                        <li><a href="#kontakt" class="hover:text-gold-400 transition">Kontakt</a></li>
                    </ul>

                    <div class="flex items-center space-x-4">
                        <button
                            class="px-5 py-2 bg-gradient-to-r from-gold-500 to-gold-600 rounded-full hover:shadow-lg hover:shadow-gold-500/50 transition btn-shine text-white font-medium">
                            <i class="fas fa-search mr-2"></i>Pretraga
                        </button>
                        <button
                            class="px-4 py-2 border border-gold-500 rounded-full hover:bg-gold-500 transition text-white">EN</button>
                    </div>
                </div>
            </div>
        </nav>
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
                                class="inline-block px-4 py-2 bg-gold-500/20 border border-gold-500/50 rounded-full text-gold-300 text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-star mr-2"></i>Preko 150.000 dokumenata
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-white leading-tight">
                                Čuvamo Prošlost<br />
                                <span class="text-gold-400">Za Budućnost</span>
                            </h1>
                            <p class="text-2xl mb-10 text-gray-300 max-w-2xl leading-relaxed">
                                Digitalizovani dokumenti iz 8 vekova istorije, dostupni svima koji žele da istraže naše
                                bogato nasleđe
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-gold-500 to-gold-600 rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-gold-500/50 transition btn-shine text-white transform hover:scale-105">
                                    <i class="fas fa-book-open mr-2"></i>Istraži Fondove
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-white transform hover:scale-105">
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
                                class="inline-block px-4 py-2 bg-gold-500/20 border border-gold-500/50 rounded-full text-gold-300 text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-laptop mr-2"></i>Pristup 24/7
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-white leading-tight">
                                Digitalna<br />
                                <span class="text-gold-400">Revolucija</span>
                            </h1>
                            <p class="text-2xl mb-10 text-gray-300 max-w-2xl leading-relaxed">
                                Pristupite arhivskoj građi online, bilo gde, bilo kada. Vaša istorija na dohvat ruke
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-gold-500 to-gold-600 rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-gold-500/50 transition btn-shine text-white transform hover:scale-105">
                                    <i class="fas fa-laptop mr-2"></i>Digitalna Čitaonica
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-white transform hover:scale-105">
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
                                class="inline-block px-4 py-2 bg-gold-500/20 border border-gold-500/50 rounded-full text-gold-300 text-sm font-medium mb-6 backdrop-blur-sm">
                                <i class="fas fa-users mr-2"></i>Stručna podrška
                            </div>
                            <h1 class="text-7xl md:text-8xl font-bold mb-6 glow text-white leading-tight">
                                Istraživačke<br />
                                <span class="text-gold-400">Usluge</span>
                            </h1>
                            <p class="text-2xl mb-10 text-gray-300 max-w-2xl leading-relaxed">
                                Profesionalna podrška za vaša istorijska istraživanja od strane certificovanih arhivista
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button
                                    class="px-8 py-4 bg-gradient-to-r from-gold-500 to-gold-600 rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-gold-500/50 transition btn-shine text-white transform hover:scale-105">
                                    <i class="fas fa-calendar-check mr-2"></i>Zakaži Posetu
                                </button>
                                <button
                                    class="px-8 py-4 glass rounded-full text-lg font-semibold hover:bg-white/20 transition text-white transform hover:scale-105">
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
            <i class="fas fa-chevron-left text-2xl text-white"></i>
        </button>

        <button id="nextButton" onclick="nextSlide()"
            class="slider-control absolute right-6 top-1/2 transform -translate-y-1/2 w-14 h-14 rounded-full flex items-center justify-center z-10">
            <i class="fas fa-chevron-right text-2xl text-white"></i>
        </button>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
            <button id="indicator0" onclick="goToSlide(0)"
                class="slider-indicator w-3 h-3 rounded-full bg-white active"></button>
            <button id="indicator1" onclick="goToSlide(1)"
                class="slider-indicator w-3 h-3 rounded-full bg-white/30"></button>
            <button id="indicator2" onclick="goToSlide(2)"
                class="slider-indicator w-3 h-3 rounded-full bg-white/30"></button>
        </div>

    </section>

    <section class="py-20 bg-dark-900">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="stat-number">150K+</div>
                    <p class="text-xl text-gray-400 mt-2">Digitalizovanih Dokumenata</p>
                </div>
                <div class="text-center">
                    <div class="stat-number">8</div>
                    <p class="text-xl text-gray-400 mt-2">Vekova Istorije</p>
                </div>
                <div class="text-center">
                    <div class="stat-number">45</div>
                    <p class="text-xl text-gray-400 mt-2">Fondova i Zbirki</p>
                </div>
                <div class="text-center">
                    <div class="stat-number">5M+</div>
                    <p class="text-xl text-gray-400 mt-2">Stranica Arhivske Građe</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fondovi" class="py-24 bg-dark-950">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 glow decorative-line text-white">Istaknuti Fondovi</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Istražite našu jedinstvenu kolekciju istorijskih
                    dokumenata</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-hover card-3d glass-dark rounded-2xl overflow-hidden">
                    <div class="img-overlay h-64">
                        <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600&h=400&fit=crop"
                            alt="Stari dokumenti" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 bg-gold-500 rounded-full text-sm font-semibold text-white">XIX
                                Vek</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-white">Građanska Matična Knjiga</h3>
                        <p class="text-gray-400 mb-4">Kompletni matični zapisi rođenih, venčanih i umrlih građana iz
                            perioda 1850-1920.</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gold-400"><i class="fas fa-file-alt mr-2"></i>2,847
                                dokumenata</span>
                            <span class="text-sm text-gray-500"><i class="fas fa-eye mr-2"></i>45,231 pregleda</span>
                        </div>
                        <button
                            class="w-full py-3 bg-gradient-to-r from-gold-500 to-gold-600 rounded-xl hover:shadow-lg hover:shadow-gold-500/30 transition btn-shine text-white font-medium">
                            Pregledaj Fond <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="card-hover card-3d glass-dark rounded-2xl overflow-hidden">
                    <div class="img-overlay h-64">
                        <img src="https://images.unsplash.com/photo-1568667256549-094345857637?w=600&h=400&fit=crop"
                            alt="Stara mapa" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 bg-gold-500 rounded-full text-sm font-semibold text-white">XVIII
                                Vek</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-white">Zemljišni Katastri</h3>
                        <p class="text-gray-400 mb-4">Originalni katastarski planovi i opisi zemljišnih poseda sa
                            detaljnim kartografskim prikazima.</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gold-400"><i class="fas fa-file-alt mr-2"></i>1,523
                                dokumenata</span>
                            <span class="text-sm text-gray-500"><i class="fas fa-eye mr-2"></i>32,108 pregleda</span>
                        </div>
                        <button
                            class="w-full py-3 bg-gradient-to-r from-gold-500 to-gold-600 rounded-xl hover:shadow-lg hover:shadow-gold-500/30 transition btn-shine text-white font-medium">
                            Pregledaj Fond <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="card-hover card-3d glass-dark rounded-2xl overflow-hidden">
                    <div class="img-overlay h-64">
                        <img src="https://images.unsplash.com/photo-1585776245991-cf89dd7fc73a?w=600&h=400&fit=crop"
                            alt="Ratni dokumenti" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 bg-gold-500 rounded-full text-sm font-semibold text-white">XX
                                Vek</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-white">Ratni Arhivi</h3>
                        <p class="text-gray-400 mb-4">Lični dnevnici, korespondencija i zvanični dokumenti iz perioda
                            dva svetska rata.</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gold-400"><i class="fas fa-file-alt mr-2"></i>3,912
                                dokumenata</span>
                            <span class="text-sm text-gray-500"><i class="fas fa-eye mr-2"></i>67,445 pregleda</span>
                        </div>
                        <button
                            class="w-full py-3 bg-gradient-to-r from-gold-500 to-gold-600 rounded-xl hover:shadow-lg hover:shadow-gold-500/30 transition btn-shine text-white font-medium">
                            Pregledaj Fond <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="px-10 py-4 glass rounded-full text-lg hover:bg-white/20 transition text-white">
                    Pogledaj Svih 45 Fondova <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <section id="digitalna" class="py-24 bg-gradient-to-b from-dark-900 to-dark-800">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-5xl font-bold mb-6 text-white">Digitalna Arhiva</h2>
                <p class="text-2xl text-gray-300 mb-12">Pristupite našoj digitalnoj kolekciji bilo gde, bilo kada</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition border border-gray-800">
                        <i class="fas fa-search text-5xl text-primary-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-3 text-white">Napredna Pretraga</h3>
                        <p class="text-gray-400">Pretraživanje po datumu, lokaciji, tipu dokumenta i ključnim rečima</p>
                    </div>

                    <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition border border-gray-800">
                        <i class="fas fa-download text-5xl text-primary-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-3 text-white">Preuzimanje</h3>
                        <p class="text-gray-400">Preuzmite dokumente u visokoj rezoluciji za vašu upotrebu</p>
                    </div>

                    <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition border border-gray-800">
                        <i class="fas fa-bookmark text-5xl text-primary-400 mb-4"></i>
                        <h3 class="text-xl font-bold mb-3 text-white">Čuvanje</h3>
                        <p class="text-gray-400">Sačuvajte omiljene dokumente u vašoj ličnoj biblioteci</p>
                    </div>
                </div>

                <button
                    class="px-12 py-5 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full text-xl font-semibold hover:shadow-2xl hover:shadow-primary-500/30 transition btn-shine text-white">
                    <i class="fas fa-rocket mr-2"></i>Započni Istraživanje
                </button>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="usluge" class="py-24 bg-dark-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white">Naše Usluge</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Profesionalna podrška za vaša istraživanja</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition border border-gray-800">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-book-reader text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Čitaonica</h3>
                    <p class="text-gray-400 mb-4">Pristup originalnim dokumentima u kontrolisanim uslovima</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Ponedeljak-Petak: 08-16h</li>
                        <li>Kapacitet: 15 istraživača</li>
                        <li>Rezervacija obavezna</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-primary-600 rounded-full hover:bg-primary-600 transition text-white">Zakažite
                        Posetu</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition border border-gray-800">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                        <i class="fas fa-laptop-code text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Digitalizacija</h3>
                    <p class="text-gray-400 mb-4">Profesionalno skeniranje arhivske građe</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Visoka rezolucija: 600 DPI</li>
                        <li>OCR obrada teksta</li>
                        <li>Metapodaci uključeni</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-blue-600 rounded-full hover:bg-blue-600 transition text-white">Naručite
                        Uslugu</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition border border-gray-800">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/30">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Stručna Pomoć</h3>
                    <p class="text-gray-400 mb-4">Konsultacije sa arhivskim stručnjacima</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Genealoška istraživanja</li>
                        <li>Istorijske analize</li>
                        <li>Online konsultacije</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-purple-600 rounded-full hover:bg-purple-600 transition text-white">Kontakt</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition border border-gray-800">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-600 to-green-800 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/30">
                        <i class="fas fa-copy text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Reprografija</h3>
                    <p class="text-gray-400 mb-4">Izrada kopija arhivskih dokumenata</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Digitalne kopije: 50 RSD</li>
                        <li>Fotokopije: 20 RSD</li>
                        <li>Brza isporuka</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-green-600 rounded-full hover:bg-green-600 transition text-white">Cenovnik</button>
                </div>
            </div>
        </div>
    </section>

    <section id="usluge" class="py-24 bg-dark-950">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 glow decorative-line text-white">Naše Usluge</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Profesionalna podrška za vaša istraživanja</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-gold-500 to-gold-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-gold-500/30">
                        <i class="fas fa-book-reader text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Čitaonica</h3>
                    <p class="text-gray-400 mb-4">Pristup originalnim dokumentima u kontrolisanim uslovima</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Ponedeljak-Petak: 08-16h</li>
                        <li>Kapacitet: 15 istraživača</li>
                        <li>Rezervacija obavezna</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-gold-500 rounded-full hover:bg-gold-500 transition text-white">Zakažite
                        Posetu</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                        <i class="fas fa-laptop-code text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Digitalizacija</h3>
                    <p class="text-gray-400 mb-4">Profesionalno skeniranje arhivske građe</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Visoka rezolucija: 600 DPI</li>
                        <li>OCR obrada teksta</li>
                        <li>Metapodaci uključeni</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-blue-500 rounded-full hover:bg-blue-500 transition text-white">Naručite
                        Uslugu</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/30">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Stručna Pomoć</h3>
                    <p class="text-gray-400 mb-4">Konsultacije sa arhivskim stručnjacima</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Genealoška istraživanja</li>
                        <li>Istorijske analize</li>
                        <li>Online konsultacije</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-purple-500 rounded-full hover:bg-purple-500 transition text-white">Kontakt</button>
                </div>

                <div class="glass-dark rounded-2xl p-8 text-center hover:bg-white/10 transition">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/30">
                        <i class="fas fa-copy text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white">Reprografija</h3>
                    <p class="text-gray-400 mb-4">Izrada kopija arhivskih dokumenata</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>Digitalne kopije: 50 RSD</li>
                        <li>Fotokopije: 20 RSD</li>
                        <li>Brza isporuka</li>
                    </ul>
                    <button
                        class="px-6 py-2 border border-green-500 rounded-full hover:bg-green-500 transition text-white">Cenovnik</button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-dark-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 glow decorative-line text-white">Naša Istorija</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Više od jednog veka čuvanja kulturnog nasleđa</p>
            </div>

            <div class="relative max-w-5xl mx-auto">
                <div class="timeline-glow absolute left-8 top-0 bottom-0"></div>

                <div class="space-y-12">
                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-700 rounded-full flex items-center justify-center shadow-lg shadow-gold-500/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-white">1912</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-white">Osnivanje Arhiva</h3>
                            <p class="text-gray-400 text-lg">Istorijski arhiv osnovan kao deo gradskog muzeja. Početna
                                kolekcija obuhvata 800 dokumenata iz lokalne istorije i administrative.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-700 rounded-full flex items-center justify-center shadow-lg shadow-gold-500/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-white">1945</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-white">Posleratna Obnova</h3>
                            <p class="text-gray-400 text-lg">Premeštanje u novi prostor i započinjanje sistematske
                                organizacije ratom oštećene građe. Inkorporacija arhiva likvidiranih institucija.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-700 rounded-full flex items-center justify-center shadow-lg shadow-gold-500/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-white">1987</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-white">Nova Zgrada</h3>
                            <p class="text-gray-400 text-lg">Preseljenje u posebno projektovanu zgradu sa modernim
                                depovima, klimatizacijom i prostorima za čuvanje arhivske građe.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-700 rounded-full flex items-center justify-center shadow-lg shadow-gold-500/30 group-hover:scale-110 transition">
                            <span class="text-xl font-bold text-white">2015</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition">
                            <h3 class="text-3xl font-bold mb-3 text-white">Digitalna Transformacija</h3>
                            <p class="text-gray-400 text-lg">Započinjanje masovnog projekta digitalizacije. Lansiranje
                                online platforme sa pretražljivom bazom podataka i digitalnom čitaonicom.</p>
                        </div>
                    </div>

                    <div class="relative pl-24 group">
                        <div
                            class="absolute left-0 w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-700 rounded-full flex items-center justify-center shadow-lg shadow-gold-500/30 group-hover:scale-110 transition pulse">
                            <span class="text-xl font-bold text-white">2023</span>
                        </div>
                        <div class="glass-dark rounded-2xl p-8 hover:bg-white/10 transition border-2 border-gold-500">
                            <h3 class="text-3xl font-bold mb-3 text-white">AI i Inovacije</h3>
                            <p class="text-gray-400 text-lg">Implementacija veštačke inteligencije za automatsku
                                kategorizaciju, OCR prepoznavanje rukopisa i naprednu semantičku pretragu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-dark-950">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 glow decorative-line text-white">Galerija Dokumenata</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Pregled najznačajnijih i najlepših dokumenata iz naše
                    kolekcije</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&h=400&fit=crop"
                        alt="Dokument 1" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1516414447565-b14be0adf13e?w=400&h=400&fit=crop"
                        alt="Dokument 2" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=400&fit=crop"
                        alt="Dokument 3" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=400&fit=crop"
                        alt="Dokument 4" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=400&h=400&fit=crop"
                        alt="Dokument 5" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1526243741027-444d633d7365?w=400&h=400&fit=crop"
                        alt="Dokument 6" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=400&h=400&fit=crop"
                        alt="Dokument 7" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>

                <div class="img-overlay rounded-xl overflow-hidden cursor-pointer group">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=400&fit=crop"
                        alt="Dokument 8" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-search-plus text-4xl text-white"></i>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="px-10 py-4 glass rounded-full text-lg hover:bg-white/20 transition text-white">
                    Pogledaj Celu Galeriju <i class="fas fa-images ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <footer class="bg-black text-gray-400 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-gold-500 to-gold-700 flex items-center justify-center mr-3">
                            <i class="fas fa-landmark text-xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Istorijski Arhiv</h3>
                    </div>
                    <p class="mb-4">Čuvamo i činimo dostupnim istorijsko nasleđe za sadašnje i buduće generacije.</p>
                    <p class="text-sm">&copy; 2023 Sva prava zadržana.</p>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Brzi Linkovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gold-400 transition">O Nama</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Fondovi i Zbirke</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Digitalna Arhiva</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Priručnici</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Vesti</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Usluge</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gold-400 transition">Čitaonica</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Reprografija</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Digitalizacija</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Stručna Pomoć</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Online Pretraga</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Resursi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gold-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Vodiči za Istraživače</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Propisi i Pravila</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Publikacije</a></li>
                        <li><a href="#" class="hover:text-gold-400 transition">Karijera</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm mb-4 md:mb-0">Dizajnirano sa <i class="fas fa-heart text-red-500"></i> za očuvanje
                    istorije</p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="hover:text-gold-400 transition">Politika Privatnosti</a>
                    <a href="#" class="hover:text-gold-400 transition">Uslovi Korišćenja</a>
                    <a href="#" class="hover:text-gold-400 transition">Mapa Sajta</a>
                </div>
            </div>
        </div>
    </footer>

    <button onclick="scrollToTop()" id="scrollTopBtn"
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-gold-500 to-gold-600 rounded-full flex items-center justify-center shadow-lg hover:shadow-gold-500/50 transition opacity-0 pointer-events-none z-50">
        <i class="fas fa-arrow-up text-xl text-white"></i>
    </button>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item');
        const indicators = document.querySelectorAll('.slider-indicator');
        const totalSlides = slides.length;

        function showSlide(index) {
            currentSlide = index;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;

            const slider = document.getElementById('slider');
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;

            indicators.forEach((indicator, i) => {
                if (i === currentSlide) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function goToSlide(index) {
            showSlide(index);
        }

        // Get all buttons by their IDs
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const indicator0 = document.getElementById('indicator0');
        const indicator1 = document.getElementById('indicator1');
        const indicator2 = document.getElementById('indicator2');

        // Attach click event listeners
        prevButton.addEventListener('click', prevSlide);
        nextButton.addEventListener('click', nextSlide);

        indicator0.addEventListener('click', () => goToSlide(0));
        indicator1.addEventListener('click', () => goToSlide(1));
        indicator2.addEventListener('click', () => goToSlide(2));



        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        const observerOptions = { threshold: 0.5, rootMargin: '0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card-hover').forEach(card => observer.observe(card));

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

        console.log('%c🏛️ Istorijski Arhiv', 'font-size: 24px; font-weight: bold; color: #d4af37;');
        console.log('%cDobrodošli u konzolu našeg arhiva!', 'font-size: 16px; color: #666;');
    </script>
</body>

</html>