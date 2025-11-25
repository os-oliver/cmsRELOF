<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galerija i Muzej Umetnosti</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Crimson+Pro:wght@300;400;500;600&family=Raleway:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#8B4513',
            primary_hover: '#654321',
            secondary: '#2F4F4F',
            secondary_hover: '#1E3A3A',
            accent: '#DAA520',
            accent_hover: '#B8860B',
            primary_text: '#2F4F4F',
            secondary_text: '#696969',
            background: '#FAF0E6',
            secondary_background: '#FFFFFF',
            surface: '#F5F5F5'
          },
          fontFamily: {
            'heading': ['Playfair Display', 'serif'],
            'heading2': ['Crimson Pro', 'serif'],
            'body': ['Raleway', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    .artistic-pattern {
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238B4513' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
      height: 2px;
      background: #8B4513;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .card-hover {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px -10px rgba(139, 69, 19, 0.2);
    }

    .category-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      z-index: 20;
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

    .artistic-frame {
      position: relative;
    }

    .artistic-frame::before {
      content: '';
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      border: 2px solid #8B4513;
      z-index: -1;
      transform: rotate(1deg);
    }

    .artistic-frame::after {
      content: '';
      position: absolute;
      top: -5px;
      left: -5px;
      right: -5px;
      bottom: -5px;
      border: 2px solid #DAA520;
      z-index: -1;
      transform: rotate(-1deg);
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
  </style>
</head>

<body class="bg-background text-primary_text font-body">
  <!-- Mobile Menu -->
  <div id="mobileMenu" class="fixed inset-0 z-50 lg:hidden hidden">
    <div class="fixed inset-0 bg-black bg-opacity-70" id="mobileMenuOverlay"></div>
    <div
      class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary_background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
      id="mobileMenuPanel">
      <div class="p-6">
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-xl font-heading text-primary_text">MENU</h2>
          <button id="closeMobileMenu" class="text-primary_text hover:text-primary transition-colors">
            <i class="fas fa-times text-2xl"></i>
          </button>
        </div>
        <nav id="navBarIDm" class="space-y-3">
          <a href="index.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-home mr-3 text-primary"></i>Početna
          </a>
          <div class="mobile-dropdown">
            <button
              class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all"
              id="mobileAboutToggle">
              <div class="flex items-center">
                <i class="fas fa-info-circle mr-3 text-secondary"></i>O nama
              </div>
              <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
            </button>
            <div class="ml-6 mt-2 space-y-2 mobile-dropdown-content">
              <a href="mission.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Misija i vizija
              </a>
              <a href="history.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Istorijat
              </a>
              <a href="management.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Rukovodstvo
              </a>
            </div>
          </div>
          <div class="mobile-dropdown">
            <button
              class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all"
              id="mobileExhibitionsToggle">
              <div class="flex items-center">
                <i class="fas fa-palette mr-3 text-accent"></i>Izložbe
              </div>
              <i class="fas fa-chevron-down text-sm transition-transform duration-200 mobile-dropdown-chevron"></i>
            </button>
            <div class="ml-6 mt-2 space-y-2 mobile-dropdown-content">
              <a href="current-exhibitions.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Trenutne izložbe
              </a>
              <a href="upcoming-exhibitions.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Najavljene izložbe
              </a>
              <a href="archive.html"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Arhiva izložbi
              </a>
            </div>
          </div>
          <a href="artists.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-user mr-3 text-accent"></i>Umetnici
          </a>
          <a href="programs.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-calendar-alt mr-3 text-secondary"></i>Programi i događaji
          </a>
          <a href="projects.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-project-diagram mr-3 text-primary"></i>Projekti
          </a>
          <a href="publications.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-book mr-3 text-accent"></i>Publikacije
          </a>
          <a href="news.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-newspaper mr-3 text-secondary"></i>Vesti
          </a>
          <a href="contact.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            <i class="fas fa-phone mr-3 text-primary"></i>Kontakt
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
<header
  class="fixed top-0 inset-x-0 z-50 bg-secondary_background/98 backdrop-blur-md border-b border-surface/80 shadow-md">
  <div class="px-3 sm:px-4 lg:px-6">
    <div class="flex items-center justify-between gap-6 py-4 lg:py-5">
      <!-- LEVA STRANA: logo + naziv -->
      <div class="flex items-center gap-4 flex-shrink-0">
        <!-- Veći, formalniji logo -->
        <div
          class="w-14 h-14 lg:w-16 lg:h-16 rounded-full border border-surface/90 bg-gradient-to-br from-surface via-secondary_background to-surface flex items-center justify-center shadow-lg shadow-black/20">
          <i class="fas fa-landmark text-2xl lg:text-3xl text-accent"></i>
        </div>

        <!-- Naziv ustanove -->
        <div class="leading-tight">
          <div
            class="font-heading text-primary_text tracking-[0.18em] text-xs lg:text-sm xl:text-[0.9rem] uppercase">
            USTANOVA KULTURE
          </div>
          <h1
            class="mt-1 font-heading text-primary_text text-lg sm:text-xl lg:text-2xl xl:text-[1.55rem] font-semibold tracking-[0.12em] uppercase">
            MUZEJ PONIŠAVLJA PIROT
          </h1>
          <p class="hidden md:block mt-1 text-[0.78rem] text-secondary_text tracking-[0.14em] uppercase">
            Tradicija, nasleđe i identitet
          </p>
        </div>
      </div>

      <!-- SREDINA: glavna navigacija (desktop) -->
      <nav id="navBarID"
           class="hidden lg:flex items-center gap-3 xl:gap-5 text-[0.85rem] xl:text-[0.92rem] uppercase tracking-[0.16em]">
        <a href="#"
           class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-home mr-2 text-sm text-primary/90"></i>
          <span>Početna</span>
        </a>

        <!-- O nama dropdown -->
        <div class="dropdown relative group">
          <button
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <i class="fas fa-info-circle mr-2 text-sm text-secondary"></i>
            <span>O NAMA</span>
            <i
              class="fas fa-chevron-down ml-1 text-[0.6rem] text-secondary_text group-hover:rotate-180 transition-transform duration-200"></i>
          </button>
          <div
            class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 mt-3 min-w-[240px] max-w-xs bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2.5">
            <a href="#" static="true"
               class="dropdown-item flex items-center px-4 py-2.5  hover:bg-surface/80 rounded-lg transition-colors duration-150">
              <i class="fas fa-flag mr-3 text-secondary w-4 text-xs flex-shrink-0"></i>
              <span class="">Misija i vizija</span>
            </a>
            <a href="#" static="true"
               class="dropdown-item flex items-center px-4 py-2.5  hover:bg-surface/80 rounded-lg transition-colors duration-150">
              <i class="fas fa-history mr-3 text-accent w-4 text-xs flex-shrink-0"></i>
              <span class="">Istorijat</span>
            </a>
            <a href="#"
               class="dropdown-item flex items-center px-4 py-2.5 hover:bg-surface/80 rounded-lg transition-colors duration-150">
              <i class="fas fa-users-cog mr-3 text-secondary w-4 text-xs flex-shrink-0"></i>
              <span class="">Rukovodstvo</span>
            </a>
          </div>
        </div>

        <a
          class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-palette mr-2 text-sm text-primary/90"></i>
          <span>Izložbe</span>
        </a>

        <a
          class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-project-diagram mr-2 text-sm text-primary/90"></i>
          <span>Projekti</span>
        </a>

        <a href="#"
           class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-images mr-2 text-sm text-secondary"></i>
          <span>Galerija</span>
        </a>

        <a href="#"
           class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-folder-open mr-2 text-sm text-accent"></i>
          <span>Dokumenti</span>
        </a>

        <a href="#"
           class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-info mr-2 text-sm text-accent"></i>
          <span>Informacije</span>
        </a>

        <!-- Aktivnosti dropdown -->
        <div class="dropdown relative group">
          <button
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <i class="fas fa-bullhorn mr-2 text-sm text-primary/90"></i>
            <span>AKTIVNOSTI</span>
            <i
              class="fas fa-chevron-down ml-1 text-[0.6rem] text-secondary_text group-hover:rotate-180 transition-transform duration-200"></i>
          </button>

          <div
            class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 mt-3 min-w-[220px] bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2.5">
            <a href="#"
               class="dropdown-item flex items-center px-4 py-2.5 text-[0.8rem] text-primary_text/95 hover:bg-surface/80 rounded-lg transition-colors duration-150">
              <i class="fas fa-newspaper mr-3 text-primary w-4 text-xs flex-shrink-0"></i>
              <span class="font-medium normal-case tracking-normal">Vesti</span>
            </a>

            <a href="#"
               class="dropdown-item flex items-center px-4 py-2.5 text-[0.8rem] text-primary_text/95 hover:bg-surface/80 rounded-lg transition-colors duration-150">
              <i class="fas fa-poll mr-3 text-accent w-4 text-xs flex-shrink-0"></i>
              <span class="font-medium normal-case tracking-normal">Ankete</span>
            </a>
          </div>
        </div>

        <a href="#"
           class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
          <i class="fas fa-address-book mr-2 text-sm text-secondary"></i>
          <span>Kontakt</span>
        </a>

        <!-- LOCALE DROPDOWN (PHP logika ostaje, samo klase) -->
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
        <div class="locale dropdown nonPage relative group">
          <button
            class="nav-link inline-flex items-center px-3 py-2 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
            <span class="hidden xl:inline text-[0.8rem] font-medium normal-case tracking-normal"><?= $languages[$locale]['label'] ?></span>
            <i
              class="fas fa-chevron-down ml-1 text-[0.6rem] text-secondary_text group-hover:rotate-180 transition-transform duration-200"></i>
          </button>
          <div
            class="dropdown-menu absolute top-full right-0 mt-3 min-w-[190px] bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 z-50 py-2">
            <?php foreach ($languages as $key => $lang): ?>
              <a href="?locale=<?= $key ?>"
                 class="dropdown-item flex items-center px-3.5 py-2.5 text-[0.8rem] text-primary_text/95 hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                <span class="font-medium normal-case tracking-normal"><?= $lang['label'] ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </nav>

      <!-- DESNA STRANA: search + hamburger (uvek tu) -->
      <div class="flex items-center gap-1.5 sm:gap-3">
        <!-- PRETRAGA -->
        <div class="relative">
          <button id="searchButton"
                  class="text-secondary_text hover:text-primary transition-colors duration-200 focus:outline-none p-2.5 rounded-full hover:bg-surface/80"
                  aria-label="Search">
            <i class="fas fa-search text-sm sm:text-base"></i>
          </button>
          <div id="searchInputContainer"
               class="absolute right-0 top-full mt-3 hidden opacity-0 transition-all duration-300 ease-out z-50 min-w-[280px] sm:min-w-[320px] bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 overflow-hidden">
            <form id="searchForm" class="flex items-center w-full p-2.5" action="/search" method="GET">
              <input type="text" name="q" placeholder="Pretražite sadržaj..."
                     class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3.5 py-2.5 text-primary_text bg-surface rounded-lg placeholder-secondary_text"
                     id="searchInput" required />
              <div class="flex items-center gap-1.5 ml-2">
                <button type="submit"
                        class="text-secondary_text hover:text-primary transition-colors duration-200 focus:outline-none p-2 rounded-full hover:bg-surface/80 w-9 h-9 flex items-center justify-center"
                        aria-label="Submit search">
                  <i class="fas fa-search text-xs"></i>
                </button>
                <button type="button"
                        class="text-secondary_text hover:text-accent transition-colors duration-200 focus:outline-none p-2 rounded-full hover:bg-surface/80 w-9 h-9 flex items-center justify-center"
                        id="closeSearch" aria-label="Close search">
                  <i class="fas fa-times text-xs"></i>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- HAMBURGER (mobilni meni) -->
        <button id="hamburger"
                class="hamburger lg:hidden text-primary_text w-10 h-10 flex flex-col justify-center items-center space-y-1.5 p-2.5 rounded-lg border border-surface/80 bg-secondary_background/95 hover:bg-surface/80 transition-all duration-200">
          <span class="block w-6 h-[2px] bg-primary_text rounded transition-all duration-300"></span>
          <span class="block w-6 h-[2px] bg-primary_text rounded transition-all duration-300"></span>
          <span class="block w-6 h-[2px] bg-primary_text rounded transition-all duration-300"></span>
        </button>
      </div>
    </div>
  </div>
</header>


  <!-- Hero Section -->
  <section class="relative min-h-screen flex items-center overflow-hidden pt-20 artistic-pattern">
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-surface via-transparent to-primary opacity-10"></div>

    <div class="container mx-auto px-4 py-24 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="max-w-2xl">
          <span class="inline-block bg-primary text-white px-6 py-2 rounded-full text-sm font-medium mb-6 shadow-md">
            <i class="fas fa-star mr-2"></i>ISTAKNUTO OVOG MESECA
          </span>
          <h1 class="text-5xl md:text-6xl font-heading font-bold leading-tight text-primary_text mb-6">
            <span class="block">SVET UMETNOSTI</span>
            <span class="block text-primary mt-2">I KULTURNE BAŠTINE</span>
          </h1>

          <div class="mb-10">
            <p class="text-xl text-primary_text leading-relaxed mb-6">
              Doživite bogatstvo kulturnog nasleđa kroz izložbe, edukativne programe i umetničke događaje u srcu grada.
            </p>
            <p class="text-primary_text italic text-lg border-l-4 border-primary pl-4">
              "Umetnost je laž koja nam omogućava da shvatimo istinu."
              <span class="block font-medium text-accent mt-2">— Pablo Picasso</span>
            </p>
          </div>

          <div class="flex flex-wrap gap-4 mb-8">
            <a href="/izlozbe"
              class="bg-primary hover:bg-primary_hover text-white px-8 py-4 rounded-lg font-medium shadow-lg transition-all transform hover:scale-105">
              <i class="fas fa-eye mr-2"></i>Trenutne izložbe
            </a>
          </div>

          <div class="grid grid-cols-3 gap-6 mt-12">
            <div class="text-center">
              <div class="text-3xl font-heading font-bold text-primary mb-2">50+</div>
              <p class="text-secondary_text font-medium text-sm">Godina postojanja</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-heading font-bold text-primary mb-2">200+</div>
              <p class="text-secondary_text font-medium text-sm">Izložbi godišnje</p>
            </div>
            <div class="text-center">
              <div class="text-3xl font-heading font-bold text-primary mb-2">10K+</div>
              <p class="text-secondary_text font-medium text-sm">Posetilaca</p>
            </div>
          </div>
        </div>

        <div class="relative hidden lg:block">
          <div class="artistic-frame rounded-xl overflow-hidden shadow-2xl">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f7/Pirot_Konak_Malog_Riste.JPG"
              alt="Galerija prostor" class="rounded-xl w-full">
          </div>
          <div
            class="absolute -bottom-6 -right-6 w-32 h-32 bg-accent rounded-full flex items-center justify-center text-white text-4xl font-heading font-bold shadow-xl">
            <i class="fas fa-paint-brush"></i>
          </div>
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


  <!-- Current Exhibitions -->
  <section id="izlozbe" class="py-20 bg-secondary_background">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
          Predstojeće Izložbe
          <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></span>
        </h2>
        <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-4">
          Istražite najnovija umetnička dela i postavke u našem centru.
        </p>
      </div>

      <div id="izlozbeCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <div
            class="izlozba-card bg-surface rounded-3xl overflow-hidden shadow-2xl hover:shadow-primary/50 transition-all duration-500 transform hover:-translate-y-1">

            <div class="relative h-64">
              <img id="g-slika"
                src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=800&q=80"
                alt="Naslovna slika izložbe"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">

              <div
                class="absolute bottom-0 left-0 right-0 bg-primary/90 text-white p-3 flex justify-between items-center text-sm font-semibold">

                <div class="flex items-center gap-2">
                  <i class="fas fa-calendar-check"></i>
                  Početak: <span id="g-datumPocetka">20. Decembar 2025</span>
                </div>

                <i class="fas fa-arrow-right"></i>
              </div>
            </div>

            <div class="p-6">

              <h3 id="g-naziv"
                class="text-3xl font-heading font-extrabold text-primary_text mb-3 hover:text-primary transition-colors duration-300 line-clamp-2">
                Kreativni Impulsi
              </h3>



              <a id="g-ovise" href="#"
                class="mt-4 block text-center bg-accent text-white font-bold py-3 rounded-xl hover:bg-accent/90 transition-colors duration-300">
                Pogledajte Detaljnije
                <i class="fas fa-external-link-alt ml-2"></i>
              </a>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <div class="text-center mt-16">
        <a href="/izlozbe" id="izlozbeView"
          class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center justify-center shadow-lg mx-auto max-w-xs w-auto">
          <i class="fas fa-palette mr-3"></i>
          Prikaži sve izložbe
        </a>
      </div>

    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-20 bg-secondary_background">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <span class="inline-block bg-surface text-primary_text px-6 py-2 rounded-full text-sm font-medium mb-4">
          O GALERIJI
        </span>
        <h2 class="text-4xl font-heading font-bold text-primary_text mb-4">
          Naša Priča i Misija
        </h2>
        <p class="text-lg text-secondary_text max-w-3xl mx-auto">
          Muzej je posvećen očuvanju, istraživanju i promovisanju umetničkog nasleđa i savremene umetničke prakse
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="space-y-6">
            <div>
              <p class="text-secondary_text leading-relaxed">
                Muzej je osnovan oktobra 1947. godine odlukom Gradskog narodnog odbora Pirota pod nazivom Narodni muzej. Već je posedovao izvestan broj predmeta, uglavnom poklona od građana Pirota i okoline. Odlukom Skupštine opštine Pirot, Muzej je 1969. godine dobio današnji naziv.
              </p>
            </div>

            <div>
              <p class="text-secondary_text leading-relaxed">
                Kao regionalna muzejska ustanova, koja koncepcijski spada u kategoriju zavičajnih muzejskih ustanova kompleksnog tipa, delatnost proučavanja, zaštite i prezentacije kulturnog tipa, delatnost i proučavanje, zaštite i prezentacije kulturno umetničkih i istorijskih dela, odnosno pokretnih kulturnih dobara, ova muzejska ustanova obavlja na teritoriji opštine Pirot, Dimitrovgrad, Babušnica i Bela Palanka.
              </p>
            </div>

            <div>
              <p class="text-secondary_text leading-relaxed">
                Organizacionu strukturu Muzeja čine odeljenja za arheologiju, etnologiju, numizmatiku, istoriju i istoriju umetnosti. Zbirke navedenih odeljenja formiraju muzejski fond od oko 6.500 predmeta. U sastav muzejskog fonda ulazi i fond Galerije fresaka u Starom gradu koga čine reprodukcije fresaka iz manastira Svetog Jovana Bogoslova, zadužbine Konstantina Dejanovića, u selu Poganovu, kao i dva legata, od kojih je jedan legat učitelja Ćire Rančića iz oblasti dečije književnosti, a drugi legat učitelja Duška Ćirića sa etnološko-istorijskom građom. Pored toga, Muzej ima depandanse u Babušnici, Beloj Palanci i Dimitrovgradu.
              </p>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="grid grid-cols-2 gap-4">
            <div class="space-y-4">
              <div class="h-48 bg-gradient-to-br from-primary to-secondary rounded-xl shadow-lg"></div>
              <div class="h-64 bg-gradient-to-br from-accent to-primary rounded-xl shadow-lg"></div>
            </div>
            <div class="space-y-4 mt-8">
              <div class="h-64 bg-gradient-to-br from-secondary to-primary rounded-xl shadow-lg"></div>
              <div class="h-48 bg-gradient-to-br from-primary to-accent rounded-xl shadow-lg"></div>
            </div>
          </div>

          <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white rounded-full flex items-center justify-center shadow-2xl">
            <div class="text-center p-6">
              <i class="fas fa-university text-5xl text-primary mb-4"></i>
              <h3 class="font-heading text-xl font-bold text-primary_text">MUZEJ</h3>
              <p class="text-secondary_text mt-2 text-sm">Od 1947. godine</p>
            </div>
          </div>
        </div>
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
          Budite u toku sa najnovijim dešavanjima iz sveta kulture i umetnosti.
        </p>
      </div>

      <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <article
            class="relative rounded-xl overflow-hidden shadow-2xl transition-all duration-500 group cursor-pointer bg-black/50 aspect-video md:aspect-[4/3] max-w-sm mx-auto">
            <img id="g-slika"
              src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
              alt="Galerijska Slika"
              class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700 ease-in-out">

            <div
              class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-6 flex flex-col justify-end transition-all duration-500">

              <div class="relative z-10 text-white">

                <div
                  class="flex items-center text-sm mb-2 opacity-70 group-hover:opacity-100 transition-opacity duration-500 delay-150">
                  <i class="far fa-calendar-alt mr-2 text-accent"></i>
                  <span id="g-datum">15. Oktobar 2025</span>
                </div>

                <h3 id="g-naslov"
                  class="text-2xl font-heading font-bold mb-2 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500 delay-200 line-clamp-2">
                  Novi kulturni centar otvara vrata građanima
                </h3>

                <p id="g-opis"
                  class="text-sm mb-4 max-h-0 opacity-0 group-hover:max-h-full group-hover:opacity-100 transition-all duration-500 ease-out line-clamp-3">
                  Nakon dve godine izgradnje, novi kulturni centar spreman je da postane epicentar
                  kreativnosti i umetnosti u našem gradu.
                </p>

                <a id="g-ovise" href="#"
                  class="inline-flex items-center text-accent font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-300">
                  Pogledaj detalje
                  <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
              </div>
            </div>

            <div class="absolute top-4 left-4 p-2 bg-accent rounded-full text-white shadow-lg z-20">
              <i class="fas fa-camera text-lg"></i>
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
  <footer class="bg-secondary text-white py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <div>
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center text-white mr-3">
              <img src="../../../uploads/logo muzej ponisavlja.jpg" alt="Logo" class="rounded-xl w-full">
            </div>
            <h3 class="text-2xl font-heading font-bold">MUZEJ PONIŠAVLJA PIROT</h3>
          </div>
          <p class="text-gray-300 mb-4 leading-relaxed ">
            Vodeća kulturna institucija posvećena očuvanju, istraživanju i promovisanju umetničkog nasleđa i savremene umetničke prakse u Pirotu.
          </p>
          <div class="flex space-x-3">
            <a href="https://muzejpirot.com/#"
              class="w-10 h-10 bg-primary hover:bg-primary_hover rounded-full flex items-center justify-center text-white transition-colors">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://muzejpirot.com/#"
              class="w-10 h-10 bg-primary hover:bg-primary_hover rounded-full flex items-center justify-center text-white transition-colors">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://muzejpirot.com/#"
              class="w-10 h-10 bg-primary hover:bg-primary_hover rounded-full flex items-center justify-center text-white transition-colors">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Brzi Linkovi</h4>
          <ul class="space-y-3 text-gray-300">
            <li><a href="/" class="text-gray-300 hover:text-accent transition-colors">Početna</a></li>
            <li><a href="/o-nama/istorijat" class="text-gray-300 hover:text-accent transition-colors">O nama</a></li>
            <li><a href="/izlozbe" class="text-gray-300 hover:text-accent transition-colors">Izložbe</a></li>
            <li><a href="/projekti" class="text-gray-300 hover:text-accent transition-colors">Projekti</a></li>
            <li><a href="/dokumenti" class="text-gray-300 hover:text-accent transition-colors">Dokumenti</a></li>
            <li><a href="/galerija" class="text-gray-300 hover:text-accent transition-colors">Galerija</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Informacije</h4>
          <ul class="space-y-3 text-gray-300">
            <li class="flex items-start ">
              <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
              <span>18300 Pirot, Nikole Pašića 49</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-phone text-accent mt-1 mr-3"></i>
              <span>010-313850</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-envelope text-accent mt-1 mr-3"></i>
              <span>muzejpirot@gmail.com</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-clock text-accent mt-1 mr-3"></i>
              <span>
                Ponedeljak - Petar 08-16h<br>
                Subota 09-15h<br>
                Nedelja - ukoliko ima zakazanih poseta<br>
              </span>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Lokacija</h4>
          <div class="bg-white/10 rounded-xl overflow-hidden aspect-w-16 aspect-h-9 h-48">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5461.047773539655!2d22.585724051300488!3d43.16160586090616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47553d326473e795%3A0xfb1d0cdfc71f6bc4!2sMuseum%20of%20Poni%C5%A1avlje!5e0!3m2!1sen!2srs!4v1763575719150!5m2!1sen!2srs"
            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
        <p>&copy; © 2024 Sva prava zadržava Muzej Ponišavlja Pirot</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Mobile menu functionality
      const hamburger = document.getElementById('hamburger');
      const mobileMenu = document.getElementById('mobileMenu');
      const closeMobileMenu = document.getElementById('closeMobileMenu');
      const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
      const mobileAboutToggle = document.getElementById('mobileAboutToggle');
      const mobileExhibitionsToggle = document.getElementById('mobileExhibitionsToggle');

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

      // Toggle mobile dropdowns
      mobileAboutToggle.addEventListener('click', function () {
        const dropdownContent = this.parentElement.querySelector('.mobile-dropdown-content');
        dropdownContent.classList.toggle('hidden');
        this.parentElement.classList.toggle('active');
      });

      mobileExhibitionsToggle.addEventListener('click', function () {
        const dropdownContent = this.parentElement.querySelector('.mobile-dropdown-content');
        dropdownContent.classList.toggle('hidden');
        this.parentElement.classList.toggle('active');
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

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });
    });
  </script>
</body>

</html>