<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Turizam Regija | Otkrijte Našu Prirodnu Baštinu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <style>
    body {
      font-family: "Inter", sans-serif;
    }

    .hero-title {
      font-family: "Playfair Display", serif;
    }

    .clip-diagonal {
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .clip-shape-1 {
      clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 85%);
    }

    .clip-shape-2 {
      clip-path: polygon(30% 0%,
          70% 0%,
          100% 30%,
          100% 70%,
          70% 100%,
          30% 100%,
          0% 70%,
          0% 30%);
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }
    }

    .search-glow:focus-within {
      box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }
  </style>
</head>

<body class="bg-gray-50">
  <!-- Enhanced Navigation Bar -->
  <header>
    <nav id="navbar" class="fixed w-full z-50 bg-white/95 backdrop-blur-md transition-all duration-300">
      <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <a href="#" class="flex items-center gap-3">
            <div
              class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
              <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
              </svg>
            </div>
            <div>
              <div class="text-xl font-bold text-gray-900">Turizam Regija</div>
              <div class="text-xs text-gray-600">Turistička Organizacija</div>
            </div>
          </a>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex items-center space-x-1">
            <a href="#destinations"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Destinacije</a>
            <a href="#events"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Manifestacije</a>
            <a href="#accommodation"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Smeštaj</a>
            <a href="#activities"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Aktivnosti</a>
            <a href="#gastronomy"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Gastronomija</a>
            <a href="#info"
              class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition font-medium">Info
              Centar</a>
          </div>

          <!-- Right Side Actions -->
          <div class="hidden lg:flex items-center gap-3">

            <select
              class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
              <option>SR</option>
              <option>EN</option>
              <option>DE</option>
            </select>
            <a href="#contact"
              class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-lg transition font-medium shadow-md">
              Kontakt
            </a>
          </div>

          <!-- Mobile menu button -->
          <button id="mobileBtn" class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
            <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>

        <!-- Search Dropdown -->
        <div id="searchDropdown" class="hidden py-4 border-t border-gray-200">
          <div class="max-w-2xl mx-auto">
            <div class="relative rounded-xl bg-gray-50">
              <input type="text" placeholder="Pretražite destinacije, smeštaj, manifestacije..."
                class="w-full px-6 py-4 pr-12 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:outline-none text-gray-900">
              <button
                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </button>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="text-sm text-gray-600">Popularne pretrage:</span>
              <a href="#"
                class="text-sm px-3 py-1 bg-white rounded-full border border-gray-200 hover:border-emerald-500 hover:text-emerald-600 transition">Nacionalni
                parkovi</a>
              <a href="#"
                class="text-sm px-3 py-1 bg-white rounded-full border border-gray-200 hover:border-emerald-500 hover:text-emerald-600 transition">Rafting</a>
              <a href="#"
                class="text-sm px-3 py-1 bg-white rounded-full border border-gray-200 hover:border-emerald-500 hover:text-emerald-600 transition">Spa
                & Wellness</a>
            </div>
          </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden py-4 border-t border-gray-200">
          <div class="flex flex-col space-y-2">
            <a href="#destinations" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Destinacije</a>
            <a href="#events" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Manifestacije</a>
            <a href="#accommodation" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Smeštaj</a>
            <a href="#activities" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Aktivnosti</a>
            <a href="#gastronomy" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Gastronomija</a>
            <a href="#info" class="px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">Info Centar</a>
            <a href="#contact" class="px-4 py-3 bg-emerald-600 text-white text-center rounded-lg">Kontakt</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- Hero Section with Geometric Shapes and Search -->
  <section class="relative pt-20 overflow-hidden">
    <!-- Full-screen Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
      <img src="https://bookaweb.s3.eu-central-1.amazonaws.com/assets/62e7d75ccd410.jpg" alt="Mountain landscape"
        class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-gradient-to-b from-gray-900/30 via-gray-900/20 to-gray-900/25"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/30 to-teal-900/30"></div>

    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10 py-32 lg:py-40">
      <div class="max-w-5xl mx-auto text-center">
        <!-- Badge -->
        <div
          class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-sm font-medium mb-8 animate-fade-in">
          <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <span>Najbolja turistička destinacija 2025</span>
        </div>

        <!-- Heading -->
        <h1
          class="hero-title text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-up">
          Otkrijte Prirodnu Lepotu<br />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">Naše Regije</span>
        </h1>

        <p class="text-xl md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto animate-fade-in-up">
          Doživite nezaboravnu avanturu kroz spektakularne planine, kristalne reke i bogatu tradiciju
        </p>

        <!-- Simplified Glass Search -->
        <div class="max-w-3xl mx-auto mb-12">
          <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 border border-white/20 search-glow">
            <div class="relative">
              <input type="text" placeholder="Pretražite destinacije, atrakcije i doživljaje..."
                class="w-full px-6 py-4 bg-white/10 rounded-xl border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-emerald-500/50" />
              <button
                class="absolute right-3 top-1/2 -translate-y-1/2 p-2 bg-emerald-500/80 hover:bg-emerald-500 rounded-lg transition-all duration-300 group">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </button>
            </div>
          </div>
          <!-- Popular Searches -->
          <div class="flex flex-wrap justify-center items-center gap-3 mt-4">
            <a href="#"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Nacionalni parkovi
            </a>
            <a href="#"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Rafting
            </a>
            <a href="#"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Spa & Wellness
            </a>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto">
          <div class="text-center">
            <div class="text-4xl lg:text-5xl font-bold text-white mb-2">120+</div>
            <div class="text-sm lg:text-base text-gray-300">Destinacija</div>
          </div>
          <div class="text-center">
            <div class="text-4xl lg:text-5xl font-bold text-white mb-2">2000+</div>
            <div class="text-sm lg:text-base text-gray-300">Smeštaja</div>
          </div>
          <div class="text-center">
            <div class="text-4xl lg:text-5xl font-bold text-white mb-2">50+</div>
            <div class="text-sm lg:text-base text-gray-300">Manifestacija</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
      </svg>
    </div>
  </section>

  <!-- Featured Destinations with Geometric Cutouts -->
  <!-- Featured Destinations with Geometric Cutouts -->
  <section id="destinations" class="py-20 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-4xl lg:text-5xl font-bold mb-4 hero-title text-gray-900">
          Istaknute Destinacije
        </h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Istražite najlepše prirodne i kulturne destinacije naše regije
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Destination Card 1 -->
        <div
          class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop"
              alt="Mountain peak"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div class="inline-block px-3 py-1 bg-emerald-500 rounded-full text-sm font-medium mb-3">
              Planina
            </div>
            <h3 class="text-2xl font-bold mb-2">Vrhovi Regije</h3>
            <p class="text-gray-200 mb-4">
              Spektakularni pogledi i planinarske staze
            </p>
            <a href="#" class="inline-flex items-center text-white font-medium hover:text-emerald-300 transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 2 -->
        <div
          class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=600&h=400&fit=crop" alt="Forest"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div class="inline-block px-3 py-1 bg-teal-500 rounded-full text-sm font-medium mb-3">
              Priroda
            </div>
            <h3 class="text-2xl font-bold mb-2">Nacionalni Parkovi</h3>
            <p class="text-gray-200 mb-4">Očuvana divljina i biodiverzitet</p>
            <a href="#" class="inline-flex items-center text-white font-medium hover:text-emerald-300 transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 3 -->
        <div
          class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img src="https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=600&h=400&fit=crop" alt="River"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div class="inline-block px-3 py-1 bg-blue-500 rounded-full text-sm font-medium mb-3">
              Reka
            </div>
            <h3 class="text-2xl font-bold mb-2">Reke i Kanjoni</h3>
            <p class="text-gray-200 mb-4">
              Rafting i avanturistički sportovi
            </p>
            <a href="#" class="inline-flex items-center text-white font-medium hover:text-emerald-300 transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <div
              class="w-10 h-10 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
              </svg>
            </div>
            <div class="text-xl font-bold hero-title">Turizam Regija</div>
          </div>
          <p class="text-gray-400 mb-4">
            Promovišemo prirodne lepote i kulturnu baštinu kroz profesionalne
            turističke usluge.
          </p>
          <div class="flex gap-3">
            <a href="#"
              class="w-10 h-10 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
              </svg>
            </a>
            <a href="#"
              class="w-10 h-10 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465.668.254 1.213.598 1.782 1.167.57.57.913 1.115 1.167 1.783.246.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.88 4.88 0 01-1.167 1.782 4.88 4.88 0 01-1.783 1.167c-.637.246-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.88 4.88 0 01-1.782-1.167 4.88 4.88 0 01-1.167-1.783c-.246-.637-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.88 4.88 0 011.167-1.782 4.88 4.88 0 011.783-1.167c.636-.246 1.363-.416 2.427-.465 1.067-.048 1.407-.06 4.123-.06h.08zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Brzi Linkovi</h4>
          <ul class="space-y-2">
            <li>
              <a href="#destinations" class="text-gray-400 hover:text-emerald-400 transition">Destinacije</a>
            </li>
            <li>
              <a href="#events" class="text-gray-400 hover:text-emerald-400 transition">Manifestacije</a>
            </li>
            <li>
              <a href="#accommodation" class="text-gray-400 hover:text-emerald-400 transition">Smeštaj</a>
            </li>
            <li>
              <a href="#gastronomy" class="text-gray-400 hover:text-emerald-400 transition">Gastronomija</a>
            </li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Informacije</h4>
          <ul class="space-y-2">
            <li>
              <a href="#" class="text-gray-400 hover:text-emerald-400 transition">O Nama</a>
            </li>
            <li>
              <a href="#" class="text-gray-400 hover:text-emerald-400 transition">Info Centar</a>
            </li>
            <li>
              <a href="#" class="text-gray-400 hover:text-emerald-400 transition">Turistički Vodič</a>
            </li>
            <li>
              <a href="#" class="text-gray-400 hover:text-emerald-400 transition">Često Postavljana Pitanja</a>
            </li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Kontakt</h4>
          <ul class="space-y-3 text-gray-400">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 mt-0.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                  clip-rule="evenodd"></path>
              </svg>
              <span>Trg Republike 1, Grad 11000</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 mt-0.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                </path>
              </svg>
              <span>+381 11 123 4567</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 mt-0.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
              </svg>
              <span>info@turizam-regija.rs</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
        <p>
          &copy; 2025 Turizam Regija - Turistička Organizacija. Sva prava
          zadržana.
        </p>
      </div>
    </div>
  </footer>
  <script>
    // Scroll efekat
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 20) {
        navbar.classList.add('shadow-lg', 'bg-white');
        navbar.classList.remove('bg-white/95', 'backdrop-blur-md');
      } else {
        navbar.classList.remove('shadow-lg', 'bg-white');
        navbar.classList.add('bg-white/95', 'backdrop-blur-md');
      }
    });

    // Mobile menu toggle
    const mobileBtn = document.getElementById('mobileBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Search dropdown toggle
    const searchBtn = document.getElementById('searchBtn');
    const searchDropdown = document.getElementById('searchDropdown');
    searchBtn.addEventListener('click', () => {
      searchDropdown.classList.toggle('hidden');
    });
  </script>
</body>

</html>