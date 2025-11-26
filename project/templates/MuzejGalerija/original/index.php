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
         <a href="/">
          <div class="flex items-center gap-4 flex-shrink-0">
            <!-- Veći, formalniji logo -->
            <div
              class="w-14 h-14 lg:w-16 lg:h-16 border border-surface/90 bg-gradient-to-br from-surface via-secondary_background to-surface flex items-center justify-center shadow-lg shadow-black/20">
              <img src="../../../uploads/logo muzej ponisavlja.jpg"
                alt="Logo" class="rounded-xl w-full">
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
        </a>

        <!-- SREDINA: glavna navigacija (desktop) -->
        <nav id="navBarID"
            class="hidden lg:flex items-center gap-3 xl:gap-5 text-[0.85rem] xl:text-[0.92rem] uppercase tracking-[0.16em]">

          <!-- O nama dropdown -->
          <div class="dropdown relative group">
            <button
              class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
              <span>O NAMA</span>
              <i
                class="fas fa-chevron-down ml-1 text-[0.6rem] text-secondary_text group-hover:rotate-180 transition-transform duration-200"></i>
            </button>
            <div
              class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 min-w-[240px] max-w-xs bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2.5">
              <a href="#" static="true"
                class="dropdown-item flex items-center px-4 py-2.5  hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="">Misija i vizija</span>
              </a>
              <a href="#" static="true"
                class="dropdown-item flex items-center px-4 py-2.5  hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="">Istorijat</span>
              </a>
              <a href="#"
                class="dropdown-item flex items-center px-4 py-2.5 hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="">Rukovodstvo</span>
              </a>
            </div>
          </div>

          <a
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span>Izložbe</span>
          </a>

          <a
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span>Projekti</span>
          </a>

          <a href="#"
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span>Galerija</span>
          </a>

          <a href="#"
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span>Dokumenti</span>
          </a>

          <a href="#"
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
            <span>Informacije</span>
          </a>

          <!-- Aktivnosti dropdown -->
          <div class="dropdown relative group">
            <button
              class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
              <span>AKTIVNOSTI</span>
              <i
                class="fas fa-chevron-down ml-1 text-[0.6rem] text-secondary_text group-hover:rotate-180 transition-transform duration-200"></i>
            </button>

            <div
              class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 min-w-[220px] bg-secondary_background/98 rounded-xl shadow-2xl border border-surface/80 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2.5">
              <a href="#"
                class="dropdown-item flex items-center px-4 py-2.5 hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="">Vesti</span>
              </a>

              <a href="#"
                class="dropdown-item flex items-center px-4 py-2.5 hover:bg-surface/80 rounded-lg transition-colors duration-150">
                <span class="">Ankete</span>
              </a>
            </div>
          </div>

          <a href="#"
            class="nav-link inline-flex items-center px-3.5 py-2.5 border-b-2 border-transparent text-primary_text/90 hover:text-primary hover:border-accent transition-all duration-200">
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


  <!-- HERO SEKCIJA -->
  <section class="relative w-full bg-secondary_background pt-36 pb-28 overflow-hidden border-b border-surface/60 relative pt-36 lg:pt-40">

    <!-- Suptilna pozadina -->
    <div class="pointer-events-none absolute inset-0">
      <div class="absolute -top-32 -left-24 w-[420px] h-[420px] bg-primary/7 rounded-full blur-3xl"></div>
      <div class="absolute bottom-[-6rem] right-[-4rem] w-[520px] h-[520px] bg-accent/7 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 lg:px-8 xl:px-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 xl:gap-20 items-center">

        <!-- CENTRALNI BLOK – naslov i uvod -->
        <div class="lg:col-span-7">
          <p class="text-[0.8rem] tracking-[0.28em] uppercase text-secondary_text mb-4">
            Čuvar kulturne baštine Ponišavlja
          </p>

          <div class="relative mb-8">
            <!-- velika, svetla pozadinska reč -->
            <div
              class="pointer-events-none absolute -top-10 -left-2 text-6xl md:text-7xl font-heading text-primary_text/5 uppercase tracking-[0.3em]">
              Ponišavlje
            </div>

            <h1 class="relative font-heading text-primary_text font-semibold text-4xl md:text-5xl lg:text-[3.4rem] leading-tight">
              MUZEJ PONIŠAVLJA PIROT<br class="hidden md:block" />
            </h1>
          </div>

          <p class="text-[1.05rem] md:text-lg text-primary_text/90 leading-relaxed max-w-xl mb-6">
            Muzej smešten u istorijskom Konaku Malog Riste čuva etnografske, istorijske i umetničke zbirke
            koje svedoče o životu, običajima i identitetu Pirota i Ponišavlja.
          </p>

          <p class="text-sm md:text-[0.9rem] text-secondary_text leading-relaxed border-l-2 border-surface/80 pl-4 mb-10 max-w-xl">
            Otkrijte stalne postavke, tematske izložbe i posebne programe posvećene nasleđu ćilimarstva,
            urbanog života starog Pirota i kulturnih veza ovog kraja sa svetom.
          </p>

          <!-- CTA + kratke informacije -->
          <div class="flex flex-wrap items-center gap-6 mb-10">
            <div class="flex gap-4">
              <a href="/poseta"
                class="px-8 py-3.5 rounded-md bg-primary text-white text-sm tracking-[0.14em] uppercase font-medium hover:bg-primary_hover transition">
                Planirajte posetu
              </a>

              <a href="/izlozbe"
                class="px-8 py-3.5 rounded-md border border-surface text-sm tracking-[0.14em] uppercase text-primary_text bg-secondary_background/70 hover:border-primary hover:text-primary transition">
                Stalne postavke
              </a>
            </div>

            <div class="hidden md:block text-xs text-secondary_text tracking-[0.18em] uppercase">
              Otvoreno: utorak–nedelja • 10:00–18:00
            </div>
          </div>

          <!-- Statistika u liniji -->
          <div class="flex flex-wrap gap-8 md:gap-12">
            <div>
              <div class="font-heading text-2xl md:text-3xl font-semibold text-primary_text mb-1">50+</div>
              <p class="text-[0.78rem] text-secondary_text tracking-[0.12em] uppercase">Godina rada</p>
            </div>
            <div>
              <div class="font-heading text-2xl md:text-3xl font-semibold text-primary_text mb-1">3</div>
              <p class="text-[0.78rem] text-secondary_text tracking-[0.12em] uppercase">Zbirke</p>
            </div>
            <div>
              <div class="font-heading text-2xl md:text-3xl font-semibold text-primary_text mb-1">10K+</div>
              <p class="text-[0.78rem] text-secondary_text tracking-[0.12em] uppercase">Posetilaca godišnje</p>
            </div>
          </div>
        </div>

        <!-- DESNA STRANA – kolaž slika kao „zid postavke“ -->
        <div class="lg:col-span-5">
          <div class="relative h-[460px] xl:h-[500px]">

            <!-- glavna velika slika -->
            <div class="absolute top-0 right-0 w-[78%] h-[68%] rounded-2xl overflow-hidden shadow-2xl border border-surface/80 bg-surface/80">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/f/f7/Pirot_Konak_Malog_Riste.JPG"
                alt="Konak Malog Riste – spoljašnji izgled"
                class="w-full h-full object-cover object-center">
              <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent px-5 py-4">
                <p class="text-[0.7rem] tracking-[0.18em] uppercase text-slate-200/80 mb-1">Istorijski objekat</p>
                <p class="text-sm text-white font-medium">Konak Malog Riste, kraj XIX veka</p>
              </div>
            </div>

            <!-- manja slika – detalj dvorišta / postavke -->
            <div class="absolute bottom-0 left-0 w-[60%] h-[52%] rounded-2xl overflow-hidden shadow-xl border border-surface/80 bg-surface/80">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/f/f7/Pirot_Konak_Malog_Riste.JPG"
                alt="Dvorište muzeja"
                class="w-full h-full object-cover object-bottom">
              <div class="absolute inset-0 bg-black/30 mix-blend-multiply"></div>
              <div class="absolute bottom-4 left-4">
                <p class="text-[0.7rem] tracking-[0.18em] uppercase text-slate-100/80">Muzejsko dvorište</p>
                <p class="text-xs text-slate-100/90">Prostor za programe na otvorenom</p>
              </div>
            </div>

            <!-- vertikalna uska slika – „detalj postavke“ -->
            <div class="hidden xl:block absolute top-10 -left-8 w-32 h-[260px] rounded-2xl overflow-hidden shadow-lg border border-surface/80 bg-surface/80">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/f/f7/Pirot_Konak_Malog_Riste.JPG"
                alt="Detalj enterijera"
                class="w-full h-full object-cover object-center">
              <div class="absolute inset-0 bg-black/25 mix-blend-multiply"></div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- indikator skrolovanja -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
      <div class="flex flex-col items-center gap-2 text-secondary_text/80 text-[0.7rem] tracking-[0.18em] uppercase">
        <span class="hidden sm:inline">Pomeri nadole</span>
        <div class="w-7 h-12 rounded-full border border-surface flex items-start justify-center p-1">
          <div class="w-1.5 h-1.5 rounded-full bg-primary animate-bounce"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Current Exhibitions -->
  <section id="izlozbe" class="relative py-10 bg-secondary_background overflow-hidden">

    <div class="relative max-w-7xl mx-auto px-4 lg:px-8 xl:px-10">

      <!-- Naslov sekcije -->
      <div class="text-center mb-16">
        <p class="text-xs uppercase tracking-[0.26em] text-secondary_text mb-3">
          Program izložbi
        </p>

        <h2 class="text-4xl md:text-5xl font-heading font-semibold text-primary_text mb-6">
          Predstojeće izložbe
        </h2>

        <div class="w-16 h-[2px] bg-primary mx-auto mb-6"></div>

        <p class="text-lg text-secondary_text max-w-2xl mx-auto">
          Istražite postavke koje uskoro otvaramo – nove priče, kolekcije i umetnička čitanja Ponišavlja.
        </p>
      </div>

      <!-- Kartice izložbi -->
      <div id="izlozbeCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <div
            class="izlozba-card bg-white/70 backdrop-blur-sm border border-surface/70 rounded-2xl overflow-hidden shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

            <!-- Slika -->
            <div class="relative h-60">
              <img id="g-slika"
                  src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=800&q=80"
                  alt="Naslovna slika izložbe"
                  class="w-full h-full object-cover">

              <!-- datum kao diskretan overlay -->
              <div class="absolute top-4 left-4 bg-black/65 text-white px-3 py-1.5 rounded-full text-[0.7rem] tracking-[0.18em] uppercase flex items-center gap-2">
                <span>Početak</span>
                <span id="g-datumPocetka" class="font-semibold tracking-normal normal-case">
                  20. decembar 2025.
                </span>
              </div>
            </div>

            <!-- Tekstualni deo -->
            <div class="p-6 flex flex-col h-full">
              <p id="g-naziv" class="text-2xl font-heading font-semibold text-primary_text mb-4 hover:text-primary transition-colors duration-200">
                Kreativni impulsi
              </p>

              <p id="g-opis" class="text-sm text-secondary_text mb-6 line-clamp-3">
                Izložba savremene umetnosti koja kroz različite medije i autorske poetike promišlja identitet,
                nasleđe i svakodnevicu Ponišavlja.
              </p>

              <div class="mt-auto pt-2">
                <a id="g-ovise" href="#"
                  class="inline-flex items-center justify-center w-full text-sm font-medium tracking-[0.12em] uppercase border border-primary_text/30 text-primary_text px-4 py-3 rounded-md hover:border-primary hover:text-primary transition-colors duration-200">
                  Pogledajte detaljnije
                </a>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <!-- Link ka svim izložbama -->
      <div class="text-center mt-16">
        <a href="/izlozbe" id="izlozbeView"
          class="inline-flex items-center justify-center px-9 py-3.5 rounded-md bg-primary text-white text-sm font-medium tracking-[0.14em] uppercase hover:bg-primary_hover transition shadow-md">
          Prikaži sve izložbe
        </a>
      </div>

    </div>
  </section>


  <!-- About Section -->
  <section id="about" class="relative py-10 bg-secondary_background overflow-hidden">

    <div class="relative max-w-7xl mx-auto px-4 lg:px-8 xl:px-10">

      <!-- Naslov -->
      <div class="text-center mb-20">
        <p class="text-xs uppercase tracking-[0.26em] text-secondary_text mb-3">
          Naša istorija i uloga
        </p>

        <h2 class="text-4xl md:text-5xl font-heading font-semibold text-primary_text mb-6">
          Naša Priča<br class="hidden md:block" /> i Misija
        </h2>

        <p class="text-lg text-secondary_text max-w-3xl mx-auto">
          Muzej je posvećen očuvanju, istraživanju i predstavljanju bogatog nasleđa Ponišavlja –
          kroz zbirke, izložbe i programe koji čuvaju identitet našeg kraja.
        </p>
      </div>

      <!-- Glavni layout -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 xl:gap-20">

        <!-- Tekst leva kolona -->
        <div class="lg:col-span-6 space-y-10">

          <div class="pl-6 border-l-2 border-primary/40">
            <h3 class="text-xl font-heading font-semibold text-primary_text mb-4">
              Počeci Muzeja
            </h3>
            <p class="text-secondary_text leading-relaxed">
              Muzej je osnovan oktobra 1947. godine odlukom Gradskog narodnog odbora Pirota pod nazivom
              Narodni muzej. Već tada posedovao je izvestan broj predmeta – pretežno poklone građana Pirota
              i okoline. Odlukom Skupštine opštine Pirot, Muzej je 1969. godine dobio današnji naziv.
            </p>
          </div>

          <div class="pl-6 border-l-2 border-primary/40">
            <h3 class="text-xl font-heading font-semibold text-primary_text mb-4">
              Naša regionalna uloga
            </h3>
            <p class="text-secondary_text leading-relaxed">
              Kao zavičajna muzejska ustanova kompleksnog tipa, Muzej proučava, štiti i prezentuje kulturna
              dobra na prostoru Pirota, Dimitrovgrada, Babušnice i Bele Palanke. Delatnost obuhvata
              etnološko, istorijsko, umetničko i kulturno nasleđe regiona.
            </p>
          </div>

        </div>

        <!-- Tekst desna kolona u posebnoj kartici -->
        <div class="lg:col-span-6">
          <div
            class="bg-white/60 backdrop-blur-sm border border-surface/70 rounded-2xl shadow-xl px-8 py-10">

            <h3 class="text-xl font-heading font-semibold text-primary_text mb-6">
              Zbirke i struktura Muzeja
            </h3>

            <p class="text-secondary_text leading-relaxed mb-6">
              Muzej je organizovan kroz odeljenja za arheologiju, etnologiju, numizmatiku, istoriju i istoriju
              umetnosti. Zbirke navedenih odeljenja čine muzejski fond od oko 6.500 predmeta.
            </p>

            <p class="text-secondary_text leading-relaxed mb-6">
              U sastav fonda ulazi i Galerija fresaka u Starom gradu – reprodukcije fresaka iz manastira
              Svetog Jovana Bogoslova u Poganovu – kao i dva legata, Ćire Rančića i Duška Ćirića.
            </p>

            <p class="text-secondary_text leading-relaxed">
              Muzej ima depandanse u Babušnici, Beloj Palanci i Dimitrovgradu, čime svoju kulturnu misiju
              širi na čitavo područje Ponišavlja.
            </p>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Najnovije vesti -->
  <section id="vesti" class="relative py-24 bg-secondary_background border-t border-surface/60">
    <div class="relative max-w-7xl mx-auto px-4 lg:px-8 xl:px-10">

      <!-- Naslov sekcije -->
      <div class="text-center mb-16">
        <p class="text-xs uppercase tracking-[0.26em] text-secondary_text mb-3">
          Program vesti
        </p>

        <h2 class="text-4xl md:text-5xl font-heading font-semibold text-primary_text mb-6">
          Najnovije vesti
        </h2>

        <div class="w-16 h-[2px] bg-primary mx-auto mb-6"></div>

        <p class="text-lg text-secondary_text max-w-2xl mx-auto">
          Budite u toku sa najnovijim dešavanjima iz muzeja, izložbi i kulturnog života Ponišavlja.
        </p>
      </div>

      <!-- Kartice vesti -->
      <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <article
            class="relative max-w-sm mx-auto bg-white/70 backdrop-blur-sm border border-surface/70 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">

            <!-- Slika -->
            <div class="relative h-52">
              <img id="g-slika"
                  src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                  alt="Galerijska slika"
                  class="w-full h-full object-cover">

              <!-- Datum kao badge -->
              <div class="absolute top-4 left-4 bg-black/65 text-white px-3 py-1.5 rounded-full text-[0.7rem] tracking-[0.18em] uppercase flex items-center gap-2">
                <span id="g-datum" class="tracking-normal normal-case">
                  15. oktobar 2025.
                </span>
              </div>
            </div>

            <!-- Tekstualni deo -->
            <div class="p-6 flex flex-col h-full">
              <h3 id="g-naslov"
                  class="text-xl font-heading font-semibold text-primary_text mb-3 line-clamp-2">
                Novi kulturni centar otvara vrata građanima
              </h3>

              <p id="g-tekst"
                class="text-sm text-secondary_text leading-relaxed mb-5 line-clamp-3">
                Nakon dve godine izgradnje, novi kulturni centar spreman je da postane epicentar kreativnosti
                i umetnosti u našem gradu.
              </p>

              <div class="mt-auto pt-1">
                <a id="g-ovise" href="#"
                  class="inline-flex items-center text-sm font-medium tracking-[0.12em] uppercase text-primary_text hover:text-primary transition-colors">
                  Pogledaj detalje
                </a>
              </div>
            </div>
          </article>
        <?php endfor; ?>
      </div>

      <!-- Dugme ka svim vestima -->
      <div class="text-center mt-16">
        <a href="/aktivnosti/vesti">
          <button id="vestiView"
                  class="inline-flex items-center justify-center px-9 py-3.5 rounded-md bg-primary text-white text-sm font-medium tracking-[0.14em] uppercase hover:bg-primary_hover transition shadow-md">
            Pogledaj sve vesti
          </button>
        </a>
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
              <span data-translate="off">muzejpirot@gmail.com</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-clock text-accent mt-1 mr-3"></i>
              <span>
                Ponedeljak - Petak 08-16h<br>
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