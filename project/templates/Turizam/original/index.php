<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turizam [Regija] | Priroda. Kultura. Avantura</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script> 
    
    <!-- Alpine.js za interaktivnost -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"  defer></script>
    
    <!-- Google Fonts -->
    <link href="tailwindCSS.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header sa paralaks efektom -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            class="fixed w-full z-50 transition-all duration-300" 
            :class="scrolled ? 'bg-white/95 shadow-md backdrop-blur-sm' : 'bg-transparent'">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="#" class="text-2xl hero-title font-bold text-green-700 flex items-center gap-2"> 
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    Turizam [Regija]
                </a>
                
                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden text-gray-700">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Desktop nav -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#destinations" class="text-gray-700 hover:text-green-600 font-medium">Destinacije</a>
                    <a href="#events" class="text-gray-700 hover:text-green-600 font-medium">Manifestacije</a>
                    <a href="#accommodation" class="text-gray-700 hover:text-green-600 font-medium">Smeštaj</a>
                    <a href="#map" class="text-gray-700 hover:text-green-600 font-medium">Mapa</a>
                    <a href="#gallery" class="text-gray-700 hover:text-green-600 font-medium">Galerija</a>
                    <a href="#contact" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition">
                        Kontakt
                    </a>
                </nav>
            </div>

                <!-- Mobile menu -->
                <div x-show="open" x-transition class="md:hidden py-2 absolute left-0 right-0 bg-white/95 backdrop-blur-sm mt-1 rounded-b-lg shadow-lg">
                    <div class="flex flex-col p-4 space-y-3">
                        <a href="#destinations" class="text-gray-700 py-2">Destinacije</a>
                        <a href="#events" class="text-gray-700 py-2">Manifestacije</a>
                        <a href="#accommodation" class="text-gray-700 py-2">Smeštaj</a>
                        <a href="#map" class="text-gray-700 py-2">Mapa</a>
                        <a href="#gallery" class="text-gray-700 py-2">Galerija</a>
                        <a href="#contact" class="bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-lg">
                            Kontakt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero section sa video pozadinom -->
    <section class="relative h-screen flex items-center overflow-hidden">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="videos/hero.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 via-blue-900/60 to-transparent"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="hero-title text-5xl md:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-down">
                    Otkrivanje prirodne lepote [Regije]
                </h1>
                <p class="text-xl text-white/90 mb-8 max-w-2xl animate-fade-in-up">
                    Planine, reke, kulturna baština i avanture čekaju vas u srcu prirode [Regije]. 
                    Pronađite savršen put za inspiraciju i opuštanje.
                </p>
                <div class="flex flex-wrap gap-4 animate-fade-in-up" style="animation-delay: 0.5s">
                    <a href="#destinations" class="bg-white text-green-700 hover:bg-green-50 px-8 py-4 rounded-lg font-medium shadow-lg transition transform hover:scale-105">
                        Pogledaj destinacije
                    </a>
                    <a href="#search" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-medium shadow-lg transition transform hover:scale-105">
                        Pretraži smeštaj
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistike sa animacijama -->
    <section class="py-16 bg-gradient-to-br from-green-50 to-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <?php 
                $stats = [
                    ['number' => '120+', 'label' => 'Destinacija'],
                    ['number' => '50+', 'label' => 'Manifestacija godišnje'],
                    ['number' => '2000+', 'label' => 'Hotela i apartmana'],
                    ['number' => '15', 'label' => 'Prirodnih rezervata']
                ];
                
                foreach($stats as $index => $stat): ?>
                <div class="bg-white p-6 rounded-xl shadow-lg transform transition hover:scale-105" 
                     style="animation-delay: <?= $index * 0.2 ?>s">
                    <div class="text-4xl font-bold text-green-600 mb-2"><?= $stat['number'] ?></div>
                    <div class="text-gray-600"><?= $stat['label'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Najbolje destinacije -->
    <section id="destinations" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 hero-title">Istražite najlepše destinacije</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pronađite inspiraciju za svoju sledeću avanturu kroz naše spektakularne planine, istorijske lokacije i prirodne čuda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php 
                $destinations = [
                    [
                        'name' => 'Nacionalni park [Ime]',
                        'image' => 'destination1.jpg',
                        'desc' => 'Prepoznati za svoju divlju lepotu i planinarske staze...',
                        'type' => 'nature'
                    ],
                    [
                        'name' => '[Planina] planina',
                        'image' => 'destination2.jpg',
                        'desc' => 'Spektakularan vrh sa panoramskim pogledom...',
                        'type' => 'mountain'
                    ],
                    [
                        'name' => '[Reka] reka',
                        'image' => 'destination3.jpg',
                        'desc' => 'Idealno mesto za rafting i prirodne ljubitelje...',
                        'type' => 'river'
                    ]
                ];
                
                $icons = [
                    'nature' => '<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0-8h2v6h-2z"/></svg>',
                    'mountain' => '<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M6 18l8.5-6L6 6v12zM16 6v12l8.5-6L16 6z"/></svg>',
                    'river' => '<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 20c-4.42 0-8-1.79-8-4s3.58-4 8-4 8 1.79 8 4-3.58 4-8 4zm0-6c-2.21 0-4 .9-4 2s1.79 2 4 2 4-.9 4-2-1.79-2-4-2zM2 4l10 6 10-6v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V4z"/></svg>'
                ];
                
                foreach($destinations as $dest): ?>
                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="images/<?= $dest['image'] ?>" alt="<?= $dest['name'] ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium">
                            <?= $dest['type'] == 'nature' ? 'Priroda' : ($dest['type'] == 'mountain' ? 'Planina' : 'Reka') ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <?= $icons[$dest['type']] ?>
                            <h3 class="text-xl font-semibold"><?= $dest['name'] ?></h3>
                        </div>
                        <p class="text-gray-600 mb-4"><?= $dest['desc'] ?></p>
                        <a href="#" class="inline-flex items-center text-green-600 font-medium hover:text-green-800">
                            Saznaj više
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Weather Widget sa Glassmorphism efektom -->
    <section class="py-12 bg-gradient-to-br from-blue-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto backdrop-blur-lg bg-white/60 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Vremenska prognoza</h3>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>3. avgust 2024</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-4xl font-bold">22°C</p>
                            <p class="text-gray-600">Sunčano</p>
                        </div>
                        <div class="text-5xl">
                            ☀️
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between text-sm">
                            <div class="text-center">
                                <div>Max</div>
                                <div class="font-medium">26°C</div>
                            </div>
                            <div class="text-center">
                                <div>Min</div>
                                <div class="font-medium">18°C</div>
                            </div>
                            <div class="text-center">
                                <div>Vlažnost</div>
                                <div class="font-medium">65%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interaktivna mapa -->
    <section id="map" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold mb-4 hero-title">Istražite našu regiju</h2>
                    <p class="text-gray-600 mb-6">
                        Naša interaktivna mapa vam omogućava da otkrijete sve destinacije, smeštaje i aktivnosti u realnom vremenu.
                    </p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Destinacije</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Hoteli i restorani</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Manifestacije</span>
                        </li>
                    </ul>
                    <a href="map.php" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Otvori mapu
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="md:w-1/2 w-full">
                    <div id="interactive-map" class="h-96 w-full rounded-xl overflow-hidden shadow-lg">
                        <!-- Mapa će biti prikazana ovde -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 hero-title">Turizam [Regija]</h3>
                    <p class="text-gray-400 mb-4">Promovišemo prirodne lepote i kulturnu baštinu [regije] putem savremenih turističkih usluga.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465.668.254 1.213.598 1.782 1.167.57.57.913 1.115 1.167 1.783.246.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.88 4.88 0 01-1.167 1.782 4.88 4.88 0 01-1.783 1.167c-.637.246-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.88 4.88 0 01-1.782-1.167 4.88 4.88 0 01-1.167-1.783c-.246-.637-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.88 4.88 0 011.167-1.782 4.88 4.88 0 011.783-1.167c.636-.246 1.363-.416 2.427-.465 1.067-.048 1.407-.06 4.123-.06h.08zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Brzi linkovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#destinations" class="text-gray-400 hover:text-white">Destinacije</a></li>
                        <li><a href="#events" class="text-gray-400 hover:text-white">Manifestacije</a></li>
                        <li><a href="#accommodation" class="text-gray-400 hover:text-white">Smeštaj</a></li>
                        <li><a href="#map" class="text-gray-400 hover:text-white">Mapa</a></li>
                        <li><a href="#gallery" class="text-gray-400 hover:text-white">Galerija</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontakt</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>[Adresa], [Grad], [Poštanski broj]</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            <span>+381 [XX] XXX-XXX</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span>info@turizam-regija.rs</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Prijavite se za najnovije informacije o manifestacijama i ponudama.</p>
                    <form class="flex">
                        <input type="email" placeholder="Vaša email adresa" class="px-4 py-2 rounded-l-lg w-full focus:outline-none">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 rounded-r-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Turizam [Regija]. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    
    <!-- JavaScript za interaktivne elemente -->
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById('interactive-map'), {
                center: {lat: 43.8555, lng: 20.3947},
                zoom: 8,
                styles: [
                    {
                        elementType: 'geometry',
                        stylers: [{color: '#ebebeb'}] 
                    },
                    {
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#ffffff'}]
                    }
                ]
            });
            
            // Dodaj marker za nacionalni park
            new google.maps.Marker({
                position: {lat: 43.8555, lng: 20.3947},
                map: map,
                title: "Nacionalni park",
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,
                    fillColor: "#10B981",
                    fillOpacity: 1,
                    strokeWeight: 2,
                    strokeColor: "#fff"
                }
            });
        }

        // FAQ accordion
        document.querySelectorAll('[data-faq]').forEach(item => {
            item.addEventListener('click', () => {
                const content = item.nextElementSibling;
                content.classList.toggle('hidden');
                item.querySelector('svg').classList.toggle('rotate-180');
            });
        });
    </script>

    <!-- CSS animacije -->
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
    </style>
</body>
</html>