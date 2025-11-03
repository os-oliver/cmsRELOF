<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportski Centar Arena</title>
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
                        primary: '#FF4500',
                        primary_hover: '#E03E00',
                        secondary: '#1A1A2E',
                        secondary_hover: '#0F0F1E',
                        accent: '#FFD700',
                        accent_hover: '#FFC700',
                        primary_text: '#1A1A2E',
                        secondary_text: '#4A4A5E',
                        background: '#F5F5F5',
                        secondary_background: '#FFFFFF',
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
            background: #F5F5F5;
            color: #1A1A2E;
        }

        .font-display {
            font-family: 'Bebas Neue', sans-serif;
        }

        .font-oswald {
            font-family: 'Oswald', sans-serif;
        }

        .sports-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FF4500' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .diagonal-lines {
            background: linear-gradient(45deg, transparent 40%, rgba(255, 69, 0, 0.1) 40%, rgba(255, 69, 0, 0.1) 60%, transparent 60%),
                linear-gradient(-45deg, transparent 40%, rgba(255, 69, 0, 0.1) 40%, rgba(255, 69, 0, 0.1) 60%, transparent 60%);
            background-size: 20px 20px;
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
            background: #FF4500;
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
            box-shadow: 0 20px 40px -10px rgba(255, 69, 0, 0.3);
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
            background: linear-gradient(135deg, #FF4500, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
        <div class="fixed inset-0 bg-black bg-opacity-70" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-heading text-white">MENU</h2>
                    <button id="closeMobileMenu" class="text-white hover:text-primary transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-3">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>
                    <a data-page="Treninzi" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-dumbbell mr-3 text-accent"></i>Treninzi
                    </a>
                    <a data-page="Raspored" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Raspored
                    </a>
                    <a data-page="Clanarine" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-tag mr-3 text-accent"></i>Članarine
                    </a>
                    <a data-page="Galerija" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-white hover:text-primary hover:bg-secondary_hover rounded-lg transition-all">
                        <i class="fas fa-phone mr-3 text-accent"></i>Kontakt
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
    <header class="fixed w-full z-50 py-4 bg-secondary shadow-2xl">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center shadow-lg energy-pulse">
                    <i class="fas fa-fire text-3xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-heading font-bold text-white tracking-wider">SPORTSKI ARENA</h1>
                    <p class="text-xs text-accent tracking-widest font-oswald">SNAGA • IZDRŽLJIVOST • POBEDA</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav id="navBarID" class="hidden lg:flex space-x-8 items-center">
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-home mr-2"></i>Početna
                </a>
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-dumbbell mr-2"></i>Treninzi
                </a>
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-calendar-alt mr-2"></i>Raspored
                </a>
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-tag mr-2"></i>Članarine
                </a>
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-images mr-2"></i>Galerija
                </a>
                <a href="#"
                    class="nav-link text-white font-semibold flex items-center hover:text-primary transition-colors">
                    <i class="fas fa-phone mr-2"></i>Kontakt
                </a>
            </nav>

            <!-- Search & Mobile Toggle -->
            <div class="flex items-center space-x-4">
                <button id="searchButton" class="text-white hover:text-primary transition-colors focus:outline-none"
                    aria-label="Search">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <button id="hamburger" class="hamburger lg:hidden text-white w-8 h-8 flex flex-col justify-between">
                    <span class="block w-8 h-1 bg-white rounded"></span>
                    <span class="block w-8 h-1 bg-white rounded my-1"></span>
                    <span class="block w-8 h-1 bg-white rounded"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-20 sports-pattern">
        <div class="absolute inset-0 z-0 diagonal-lines opacity-30"></div>
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-secondary via-transparent to-primary opacity-20"></div>

        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <span
                        class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-6 shadow-lg">
                        <i class="fas fa-bolt mr-2"></i>NAJMODERNIJI CENTAR U GRADU
                    </span>
                    <h1 class="text-6xl md:text-7xl font-heading font-bold leading-tight text-primary_text mb-6">
                        <span class="block">PREVAZIĐI</span>
                        <span class="block text-primary mt-2">SVOJE GRANICE</span>
                    </h1>

                    <div class="mb-10">
                        <p class="text-xl text-primary_text leading-relaxed mb-6 font-medium">
                            Pridruži se zajednici koja teži izuzetnosti. Vrhunski trening, profesionalni treneri, i
                            oprema svetske klase.
                        </p>
                        <p class="text-primary_text italic text-lg border-l-4 border-primary pl-4">
                            "Jedina loša trening sesija je ona koja nije održana."
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <button
                            class="bg-primary hover:bg-primary_hover text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl transition-all transform hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i>Postani Član
                        </button>
                        <button
                            class="border-3 border-primary text-primary hover:bg-primary hover:text-white px-8 py-4 rounded-full font-bold text-lg transition-all">
                            <i class="fas fa-play mr-2"></i>Video Tura
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="stat-number font-heading">500+</div>
                            <p class="text-secondary_text font-semibold uppercase text-sm">Članova</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">15+</div>
                            <p class="text-secondary_text font-semibold uppercase text-sm">Programa</p>
                        </div>
                        <div class="text-center">
                            <div class="stat-number font-heading">24/7</div>
                            <p class="text-secondary_text font-semibold uppercase text-sm">Pristup</p>
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
                            <h3 class="font-heading text-2xl font-bold text-primary_text">BUDI ŠAMPION</h3>
                            <p class="text-secondary_text mt-2 font-medium">Trenira u najboljem ambijentu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scrolling indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <div class="animate-bounce w-10 h-16 rounded-full border-3 border-primary flex justify-center p-2">
                <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Featured Programs Section -->
    <section id="programs" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-4">
                    PROGRAMI
                </span>
                <h2 class="text-5xl font-heading font-bold text-primary_text mb-4">
                    NAŠI TRENINZI
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto font-medium">
                    Raznovrsni programi prilagođeni svim nivoima kondicije i fitnes ciljevima
                </p>
            </div>

            <div id="programsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // Primer podataka - u realnoj aplikaciji bi ovo došlo iz baze
                $programs = [
                    [
                        'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=600&q=80',
                        'category' => 'KARDIO',
                        'badge_color' => 'bg-primary',
                        'icon' => 'fa-running',
                        'icon_bg' => 'bg-primary',
                        'title' => 'CrossFit Intenziv',
                        'description' => 'Visoko-intenzivni funkcionalni trening za maksimalne rezultate.',
                        'time' => 'Pon-Pet 18:00',
                        'level' => 'Napredni'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80',
                        'category' => 'SNAGA',
                        'badge_color' => 'bg-secondary',
                        'icon' => 'fa-dumbbell',
                        'icon_bg' => 'bg-secondary',
                        'title' => 'Bodybuilding Pro',
                        'description' => 'Profesionalni program za izgradnju mišićne mase i definiciju.',
                        'time' => 'Uto-Čet 17:00',
                        'level' => 'Srednji'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=600&q=80',
                        'category' => 'WELLNESS',
                        'badge_color' => 'bg-accent',
                        'icon' => 'fa-spa',
                        'icon_bg' => 'bg-accent',
                        'title' => 'Yoga & Pilates',
                        'description' => 'Harmonija tela i uma kroz kontrolisane pokrete i disanje.',
                        'time' => 'Svakog dana 09:00',
                        'level' => 'Svi nivoi'
                    ]
                ];

                foreach ($programs as $program) {
                    echo '
                    <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg border-2 border-gray-100">
                        <div class="h-56 relative overflow-hidden">
                            <img src="' . $program['image'] . '" alt="' . $program['title'] . '" 
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            <div class="category-badge ' . $program['badge_color'] . ' text-white font-oswald">
                                ' . $program['category'] . '
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full ' . $program['icon_bg'] . ' flex items-center justify-center text-white mr-3 shadow-lg">
                                    <i class="fas ' . $program['icon'] . ' text-xl"></i>
                                </div>
                                <span class="text-primary_text font-bold font-oswald text-sm tracking-wider">' . $program['category'] . '</span>
                            </div>
                            <h3 class="text-2xl font-heading font-bold text-primary_text mb-2">' . $program['title'] . '</h3>
                            <p class="text-secondary_text mb-4 leading-relaxed">' . $program['description'] . '</p>
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <div>
                                    <div class="flex items-center text-sm text-secondary_text mb-2">
                                        <i class="fas fa-clock mr-2 text-primary"></i>
                                        <span class="font-medium">' . $program['time'] . '</span>
                                    </div>
                                    <div class="flex items-center text-sm text-secondary_text">
                                        <i class="fas fa-signal mr-2 text-primary"></i>
                                        <span class="font-medium">' . $program['level'] . '</span>
                                    </div>
                                </div>
                                <button class="bg-primary text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-primary_hover transition-all shadow-lg">
                                    Prijavi se
                                </button>
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
                    <i class="fas fa-th-large mr-3"></i>Svi Programi
                </button>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section id="promocija" class="py-20 bg-gradient-to-br from-primary to-secondary text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <div
                        class="overflow-hidden rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=800&q=80"
                            alt="Promo" class="rounded-2xl w-full">
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span class="inline-block bg-accent text-secondary px-6 py-2 rounded-full text-sm font-bold mb-6">
                        <i class="fas fa-fire mr-2"></i>LIMITIRANA PONUDA
                    </span>
                    <h2 class="text-5xl font-heading font-bold mb-6">
                        <span class="block">50% POPUST</span>
                        <span class="block text-accent">NA ČLANARINU</span>
                    </h2>
                    <p class="text-xl mb-8 leading-relaxed">
                        Započni svoju fitnes transformaciju danas! Posebna ponuda za nove članove - uključuje pristup
                        svim programima i opremi.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <i class="fas fa-check-circle text-accent text-2xl mr-3"></i>
                            <span class="font-medium">Neograničen pristup</span>
                        </div>
                        <div class="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <i class="fas fa-check-circle text-accent text-2xl mr-3"></i>
                            <span class="font-medium">Besplatan trener</span>
                        </div>
                        <div class="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <i class="fas fa-check-circle text-accent text-2xl mr-3"></i>
                            <span class="font-medium">Plan ishrane</span>
                        </div>
                        <div class="flex items-center bg-white/10 backdrop-blur-sm p-4 rounded-xl">
                            <i class="fas fa-check-circle text-accent text-2xl mr-3"></i>
                            <span class="font-medium">Sauna & spa</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-accent text-secondary px-10 py-4 rounded-full font-bold text-lg hover:bg-accent_hover transition-all shadow-xl">
                            <i class="fas fa-gift mr-2"></i>Iskoristi Ponudu
                        </button>
                        <button
                            class="border-3 border-white text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition-all">
                            <i class="fas fa-info-circle mr-2"></i>Detalji
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
                <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-bold mb-4">
                    GALERIJA
                </span>
                <h2 class="text-5xl font-heading font-bold text-primary_text mb-4">
                    NAŠ PROSTOR
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto">
                    Moderno opremljen centar sa najnovijom opremom i profesionalnim ambijentom
                </p>
            </div>

            <div id="galleryCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $gallery = [
                    [
                        'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Teretana',
                        'description' => 'Oprema svetske klase'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Kardio Zona',
                        'description' => 'Najnoviji trenažeri'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Yoga Studio',
                        'description' => 'Mir i harmonija'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Funkcionalni Trening',
                        'description' => 'Poseban prostor za CrossFit'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Garderobniza',
                        'description' => 'Luksuzne svlačionice'
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=600&q=80',
                        'title' => 'Smoothie Bar',
                        'description' => 'Zdrava ishrana'
                    ]
                ];

                foreach ($gallery as $item) {
                    echo '
                    <div class="overflow-hidden rounded-2xl relative h-80 group shadow-xl">
                        <img src="' . $item['image'] . '" alt="' . $item['title'] . '"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform">
                            <h3 class="font-heading text-2xl font-bold mb-1">' . $item['title'] . '</h3>
                            <p class="text-sm text-accent font-medium">' . $item['description'] . '</p>
                        </div>
                    </div>
                    ';
                }
                ?>