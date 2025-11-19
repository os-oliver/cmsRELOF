<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zapadna Srbija | Otkrijte Našu Prirodnu Baštinu</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Tailwind Play CDN config — tokenized colors & fonts
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#059669',            // ≈ emerald-600
            primary_hover: '#047857',      // ≈ emerald-700
            secondary: '#0d9488',          // ≈ teal-600
            secondary_hover: '#0f766e',    // ≈ teal-700
            accent: '#0ea5e9',             // ≈ sky-500
            accent_hover: '#0284c7',       // ≈ sky-600
            primary_text: '#111827',       // ≈ gray-900
            secondary_text: '#4b5563',     // ≈ gray-600
            background: '#f9fafb',         // ≈ gray-50
            secondary_background: '#111827',
            surface: '#ffffff',            // cards / panels
          },
          fontFamily: {
            heading: ['"Playfair Display"', 'serif'],
            heading2: ['"Inter"', 'sans-serif'],
            body: ['"Inter"', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    /* Brand CSS variables so custom CSS can use same tokens */
    :root{
      --color-primary: #059669;
      --color-primary_hover: #047857;
      --color-secondary: #0d9488;
      --color-secondary_hover: #0f766e;
      --color-accent: #0ea5e9;
      --color-accent_hover: #0284c7;
      --color-primary_text: #111827;
      --color-secondary_text: #4b5563;
      --color-background: #f9fafb;
      --color-secondary_background: #111827;
      --color-surface: #ffffff;
    }

    .nav-link::after {
      content:''; display:block; width:0; height:3px;
      background:linear-gradient(to right,var(--color-accent),var(--color-primary));
      transition:width .3s;
    }
    .nav-link:hover::after { width:100%; }

    .dropdown:hover .dropdown-menu { display:block; }
    .dropdown-menu {
      display:none; position:absolute; background:var(--color-surface); min-width:200px; box-shadow:0 8px 16px rgba(0,0,0,.1);
      z-index:50; border-radius:8px; overflow:hidden;
    }
    .dropdown-item { padding:12px 16px; display:block; color:var(--color-primary_text); transition:all .2s; border-left:3px solid transparent; }
    .dropdown-item:hover { background:#f3f4f6; border-left:3px solid var(--color-primary); }

    /* Off-canvas mobile menu */
    #mobileMenuPanel { transition: transform .35s cubic-bezier(.77,0,.175,1); }
    .hamburger span { transition: all .3s ease; }
    .hamburger.active span:nth-child(1){ transform: rotate(45deg) translate(6px,6px); }
    .hamburger.active span:nth-child(2){ opacity:0; }
    .hamburger.active span:nth-child(3){ transform: rotate(-45deg) translate(5px,-5px); }

    /* Search popover animation */
    #searchInputContainer { transition: opacity .2s ease, transform .2s ease; transform: translateY(-4px); }
    #searchInputContainer.show { opacity:1 !important; transform: translateY(0); }

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
  </style>
</head>

<body class="bg-background font-body text-primary_text">

  <!-- ===== Mobile Offcanvas ===== -->
  <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>

    <div
      id="mobileMenuPanel"
      class="fixed top-0 right-0 h-full w-80 max-w-full bg-surface shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
    >
      <div class="p-6 text-secondary_text">
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-xl text-primary_text">Menu</h2>
          <button id="closeMobileMenu" class="text-primary_text transition-colors">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <nav id="navBarIDm" class="space-y-4">
          <a href="/" class="flex items-center py-3 px-4 rounded-lg transition-all">
            <i class="fas fa-home mr-3 text-primary"></i>Početna
          </a>

          <!--<div class="mobile-dropdown">
            <button
              class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all"
              id="mobileAboutToggle"
              aria-expanded="false"
              aria-controls="mobileAboutMenu"
            >
              <div class="flex items-center">
                <i class="fas fa-info-circle mr-3 text-primary"></i>O nama
              </div>
              <i class="fas fa-chevron-down transition-transform duration-200" id="mobileAboutIcon"></i>
            </button>

            <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
              <a href="/o-nama/cilj" class="flex items-center py-2 px-4 transition-colors rounded-lg hover:bg-gray-50">
                <i class="fas fa-bullseye mr-2 text-primary"></i>Cilj
              </a>
              <a href="/o-nama/zaposleni" class="flex items-center py-2 px-4 transition-colors rounded-lg hover:bg-gray-50">
                <i class="fas fa-sitemap mr-2 text-primary"></i>Zaposleni
              </a>
              <a href="/o-nama/misija" class="flex items-center py-2 px-4 transition-colors rounded-lg hover:bg-gray-50">
                <i class="fas fa-flag mr-2 text-primary"></i>Misija
              </a>
              <a href="#"
                  class="items-center py-2 px-4 text-sm text-primary hover:text-primary_hover transition-colors hidden">
                  <i class="hidden xl:inline"></i>Pitanja
              </a>
            </div>
          </div>
  -->
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
                                <i class="fas fa-bullseye mr-2 text-primary"></i>Cilj
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Rukovodstvo
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
                                <i class="fa-question mr-2 text-primary"></i>Pitanja
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije
                            </a>
                            <a href="#"
                                class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users mr-2 text-primary"></i>Timovi
                            </a>
                        </div>
                    </div>

          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-map-marker-alt mr-3 text-primary"></i>Destinacije
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-calendar-alt mr-3 text-primary"></i>Manifestacije
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-bed mr-3 text-primary"></i>Smeštaj
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-person-hiking mr-3 text-primary"></i>Aktivnosti
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-utensils mr-3 text-primary"></i>Gastronomija
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all">
              <i class="fas fa-images mr-3 text-primary"></i>Galerija
          </a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50">
            <i class="fas fa-address-book mr-3 text-primary"></i>Kontakt
          </a>
        </nav>
      </div>
    </div>
  </div>

  <!-- Font size button (A+) -->
  <button id="increaseFontBtn"
          class="fixed bottom-6 right-6 z-40 bg-primary hover:bg-primary_hover text-white py-3 px-5 rounded-full shadow-lg transition"
          aria-label="Povećaj font">A+</button>

  <!-- ===== Sticky Header ===== -->
  <header id="navbar" class="fixed w-full z-30 transition-all duration-300 py-3 bg-background/95 backdrop-blur-md">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="/" class="flex items-center gap-3">
        <!--<div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
          <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
          </svg>
        </div>-->
        <div
            class="w-11 h-11 bg-gradient-to-br from-[#CC8B3C] via-[#C85A3E] to-[#E07856] rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <img src="" alt="" style="width:75px;height:auto;" />
        </div>
        <div class="hidden sm:block">
          <div class="text-xl font-bold text-primary_text font-heading2">Zapadna Srbija</div>
          <div class="text-xs text-secondary_text">Turistička Organizacija</div>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-6 text-secondary_text">
        <!--<div class="dropdown relative group">
          <button class="nav-link hover:text-primary transition-all duration-200 px-3 py-2 rounded-lg">
            <span class="transition-colors flex items-center whitespace-nowrap px-1">O nama 
              <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200 group-hover:rotate-180"></i></span>
          </button>

          <div class="dropdown-menu absolute top-full left-0 min-w-[220px] bg-surface rounded-xl shadow-2xl border border-gray-100 z-50 py-2 backdrop-blur-sm">
            <a static="true" href="/o-nama/cilj" class="dropdown-item block px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1 font-medium">Cilj</a>
            <a static="true" href="/o-nama/misija" class="dropdown-item block px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1 font-medium">Misija</a>
            <a static="true" href="/o-nama/zaposleni" class="dropdown-item block px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1 font-medium">Zaposleni</a>
            <a href="#"
                class="dropdown-item items-center px-5 py-3 text-primary hover:text-primary_hover text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2 hidden">
                <span class="hidden xl:inline">Pitanja</span>
            </a>
          </div>
        </div>-->
        <div class="dropdown relative group transition-colors">
                    <button
                        class="px-3 py-2 nav-link transition-colors flex items-center whitespace-nowrap px-1">
                        <!--<i class="fas fa-info-circle mr-2 text-primary"></i>-->
                        <span class="hidden xl:inline flex items-center">O nama</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="#" static="true"
                            class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">
                            Cilj
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Organizaciona struktura
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Rukovodstvo
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Misija
                        </a>
                        <a href="#" static="true"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Istorijat
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Timovi
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Pitanja
                        </a>
                        <a href="#"
                            class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">
                            Informacije
                        </a>
                    </div>
                </div>

        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Destinacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Manifestacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Smeštaj</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Aktivnosti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Gastronomija</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Dokumenti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Kontakt</a>

        <a href="#"
            class="nav-link transition-colors flex items-center whitespace-nowrap px-1">
            <i
                class="fas fa-calendar-alt mr-2 text-primary"></i>
            <span class="hidden xl:inline">Vesti</span>
        </a>
        <a href="#"
            class="nav-link transition-colors flex items-center whitespace-nowrap px-1">
            <i
                class="fas fa-diagram-project mr-2 text-primary"></i>
            <span class="hidden xl:inline">Projekti</span>
        </a>
        <a href="#"
            class="nav-link transition-colors flex items-center whitespace-nowrap px-1">
            <i class="fas fa-images mr-2 text-primary"></i>
            <span class="hidden xl:inline">Galerija</span>
        </a>
        <a href="#" class="hidden">
            Ankete
        </a>
        <!-- Language dropdown (PHP kept) -->
        <?php
          if (isset($_GET['locale'])) { $_SESSION['locale'] = $_GET['locale']; }
          $locale = $_SESSION['locale'] ?? 'sr';
          $languages = [
            'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
            'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
            'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
          ];
          if (!isset($languages[$locale])) { $locale = 'sr'; }
        ?>
        <div class="dropdown nonPage relative group ">
          <button class="nav-link text-secondary_text font-semibold hover:text-accent transition-all duration-200 flex items-center px-3 py-2 rounded-lg group">
            <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
            <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
            <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
          </button>
          <div class="dropdown-menu absolute top-full right-0 min-w-max bg-surface rounded-xl shadow-2xl border border-gray-100 z-50 py-2 backdrop-blur-sm">
            <?php foreach ($languages as $key => $lang): ?>
              <a href="?locale=<?= $key ?>" class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                <span class="font-medium"><?= $lang['label'] ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </nav>

      <!-- Right: Search button & Hamburger -->
      <div class="flex items-center space-x-2 sm:space-x-4">
        <div class="relative">
          <button id="searchButton" class="text-secondary_text hover:text-primary_text p-2" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
          <div id="searchInputContainer"
               class="absolute right-0 top-full mt-2 opacity-0 hidden z-50 min-w-[300px] bg-surface rounded-md shadow-lg border border-gray-200 overflow-hidden">
            <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
              <input id="searchInput" type="text" name="q" placeholder="Pretražite destinacije, smeštaj, manifestacije…"
                     class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-2 placeholder-gray-400" required />
              <button type="submit" class="p-2 w-8 h-8 flex items-center justify-center" aria-label="Submit search">
                <i class="fas fa-search text-sm"></i>
              </button>
              <button type="button" id="closeSearch" class="p-2 w-8 h-8 flex items-center justify-center" aria-label="Clear">
                <i class="fas fa-times text-sm"></i>
              </button>
            </form>
          </div>
        </div>

        <!-- Hamburger -->
        <button id="hamburger" class="hamburger lg:hidden text-primary_text w-8 h-8 flex flex-col justify-center space-y-1 p-1">
          <span class="block w-6 h-0.5 bg-primary_text rounded"></span>
          <span class="block w-6 h-0.5 bg-primary_text rounded"></span>
          <span class="block w-6 h-0.5 bg-primary_text rounded"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- ===== Header Scripts ===== -->
  <script>
    // sticky/shrink
    (function(){
      const header = document.querySelector('header');
      const onScroll = () => {
        if (window.scrollY > 50) { header.classList.add('bg-surface','shadow-sm'); header.classList.remove('bg-background/95'); }
        else { header.classList.remove('bg-surface','shadow-sm'); header.classList.add('bg-background/95'); }
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    })();

    // Search popover
    (function(){
      const btn = document.getElementById('searchButton');
      const box = document.getElementById('searchInputContainer');
      const input = document.getElementById('searchInput');
      const closeBtn = document.getElementById('closeSearch');
      function openBox(){ if (!box) return; box.classList.remove('hidden'); requestAnimationFrame(()=>{ box.classList.add('show'); box.classList.remove('opacity-0'); setTimeout(()=> input && input.focus(), 80); }); }
      function closeBox(){ if (!box) return; box.classList.add('opacity-0'); box.classList.remove('show'); setTimeout(()=> box.classList.add('hidden'), 180); }
      if (btn) btn.addEventListener('click', (e)=>{ e.stopPropagation(); openBox(); });
      if (closeBtn) closeBtn.addEventListener('click', closeBox);
      document.addEventListener('click', (e)=>{ if (!box) return; if (!box.contains(e.target) && !btn.contains(e.target)) closeBox(); });
    })();

    // Mobile off-canvas (single controller)
    (function(){
      const hamburger = document.getElementById('hamburger');
      const mobileMenu = document.getElementById('mobileMenu');
      const panel = document.getElementById('mobileMenuPanel');
      const overlay = document.getElementById('mobileMenuOverlay');
      const closeBtn = document.getElementById('closeMobileMenu');
      const mobileAboutToggle = document.getElementById('mobileAboutToggle');

      function openMenu(){
        mobileMenu.classList.remove('hidden');
        requestAnimationFrame(()=> {
          panel.style.transform = 'translateX(0)';
          hamburger.classList.add('active');
          document.body.style.overflow = 'hidden';
        });
      }
      function closeMenu(){
        panel.style.transform = 'translateX(100%)';
        hamburger.classList.remove('active');
        setTimeout(()=> mobileMenu.classList.add('hidden'), 300);
        document.body.style.overflow = '';
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

      if (hamburger) hamburger.addEventListener('click', (e)=>{ e.stopPropagation(); openMenu(); });
      if (overlay) overlay.addEventListener('click', closeMenu);
      if (closeBtn) closeBtn.addEventListener('click', closeMenu);
      if (mobileAboutToggle) {
            mobileAboutToggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleMobileAbout();
            });
        }
      document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) closeMenu(); });
      document.querySelectorAll('#mobileMenu nav a').forEach(a=> a.addEventListener('click', ()=> setTimeout(closeMenu, 120)));
      window.addEventListener('resize', ()=> { if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) closeMenu(); });
    })();

    // A+ button
    (function(){
      const btn = document.getElementById('increaseFontBtn');
      if (!btn) return;
      let currentSize = 16, step = 2, maxSteps = 3, count = 0, increasing = true;
      btn.addEventListener('click', () => {
        if (increasing) { currentSize += step; count++; if (count === maxSteps) { increasing = false; btn.textContent = 'A-'; } }
        else { currentSize -= step; count--; if (count === 0) { increasing = true; btn.textContent = 'A+'; } }
        document.body.style.fontSize = currentSize + 'px';
      });
    })();
  </script>

  <!-- Hero Section with Geometric Shapes and Search -->
  <section class="relative pt-20 overflow-hidden">
    <!-- Full-screen Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
      <img src="https://westserbia.org/wp-content/uploads/2022/05/Zlatar6@2x.png" alt="Mountain landscape"
        class="w-full h-full object-cover" />
      <!-- Dark tint overlay (removed green tint) -->
      <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/60"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10 py-32 lg:py-40">
      <div class="max-w-5xl mx-auto text-center">
        <!-- Badge -->
        <div
          class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-sm font-medium mb-8 animate-fade-in">
          <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <span>Vaša početna stanica za odmor u našoj regiji</span>
        </div>

        <!-- Heading -->
        <h1
          class="font-heading text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-up">
          Dobrodošli u<br />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Zapadnu Srbiju</span>
        </h1>

        <p class="text-xl md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto animate-fade-in-up font-heading2">
          Doživite nezaboravnu avanturu kroz spektakularne planine, kristalne reke i bogatu tradiciju
        </p>

        <!-- Simplified Glass Search -->
        <div class="max-w-3xl mx-auto mb-12">
          <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 border border-white/20 search-glow">
            <div class="relative">
              <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
                <input id="searchInput" type="text" name="q" placeholder="Pretražite destinacije, smeštaj, manifestacije…"
                     class="w-full px-6 py-4 bg-white/10 rounded-xl border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-primary/50" required />
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 bg-primary/80 hover:bg-primary rounded-lg transition-all duration-300 group" aria-label="Submit search">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
          <!-- Popular Searches -->
          <div class="flex flex-wrap justify-center items-center gap-3 mt-4">
            <a href="/pretraga?q=Rafting"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Rafting
            </a>
            <a href="/pretraga?q=Planinarenje"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Planinarenje
            </a>
            <a href="/pretraga?q=Manifestacije"
              class="px-4 py-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-full text-white text-sm transition-all duration-300">
              Manifestacije
            </a>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto">
          <div class="text-center">
            <div class="text-4xl lg:text-5xl font-bold text-white mb-2">14+</div>
            <div class="text-sm lg:text-base text-gray-300">Destinacija</div>
          </div>
          <div class="text-center">
            <div class="text-4xl lg:text-5xl font-bold text-white mb-2">28</div>
            <div class="text-sm lg:text-base text-gray-300">Vidikovaca</div>
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

  <!-- Destinacije: left text / right image (matches current site convention) -->
  <section id="destinacije" class="py-20 bg-background">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">
        <!-- Left: title + text + list -->
        <div>
          <p class="text-sm uppercase text-secondary text-left mb-3 font-semibold">TURISTIČKA REGIJA ZAPADNA SRBIJA</p>
          <h2 class="text-5xl lg:text-6xl font-bold mb-6 font-heading text-primary_text">Destinacije</h2>

          <p class="text-lg text-secondary_text max-w-2xl mb-6">
            Turistička organizacija regije Zapadna Srbija obuhvata 14 celina i prožeta je manjim urbanim centrima, ruralnim predelima sa idiličnim turističkim lokalitetima kao i planinama koje čine osnov turizma ove regije.
          </p>

          <hr class="border-t border-primary/20 mb-6 w-24">

          <div class="grid grid-cols-2 gap-4 text-sm text-primary_text">
            <ul class="space-y-2">
              <li>Užice</li>
              <li>Zlatibor</li>
              <li>Tara - Drina - Bajina Bašta</li>
              <li>Zlatar - Nova Varoš</li>
              <li>Čačak</li>
              <li>Prijepolje</li>
              <li>Ljubovija</li>
            </ul>
            <ul class="space-y-2">
              <li>Ivanjica</li>
              <li>Sjenica</li>
              <li>Dragačevo - Guča</li>
              <li>Arilje</li>
              <li>Požega</li>
              <li>Kosjerić</li>
              <li>Mali Zvornik</li>
            </ul>
          </div>
        </div>

        <!-- Right: map / picture -->
        <div class="text-right">
          <img src="https://westserbia.org/wp-content/uploads/2022/11/Mapa.svg" alt="Mapa Zapadne Srbije" class="w-full h-auto rounded-xl shadow-lg object-contain"/>
        </div>
      </div>

      <!-- Dynamic destination cards (backend-connected) -->
      <div id="destinacijeCards" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
        <!-- Destination Card 1 (kept IDs for backend mapping) -->
        <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img id="g-slika" src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop" alt="Mountain peak" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div id="g-naziv" class="inline-block px-3 py-1 bg-primary rounded-full text-sm font-medium mb-3">Planina</div>
            <h3 id="g-naziv_destinacije" class="text-2xl font-bold mb-2">Vrhovi Regije</h3>
            <p id="g-kratak_opis" class="text-gray-200 mb-4">Spektakularni pogledi i planinarske staze</p>
            <a id="g-ovise" href="#" class="inline-flex items-center text-white font-medium hover:text-accent transition">Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 2 -->
        <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=600&h=400&fit=crop" alt="Forest" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div class="inline-block px-3 py-1 bg-secondary rounded-full text-sm font-medium mb-3">Priroda</div>
            <h3 class="text-2xl font-bold mb-2">Nacionalni Parkovi</h3>
            <p class="text-gray-200 mb-4">Očuvana divljina i biodiverzitet</p>
            <a href="#" class="inline-flex items-center text-white font-medium hover:text-accent transition">Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 3 -->
        <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img src="https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=600&h=400&fit=crop" alt="River" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
            <div class="inline-block px-3 py-1 bg-accent rounded-full text-sm font-medium mb-3">Reka</div>
            <h3 class="text-2xl font-bold mb-2">Reke i Kanjoni</h3>
            <p class="text-gray-200 mb-4">Rafting i avanturistički sportovi</p>
            <a href="#" class="inline-flex items-center text-white font-medium hover:text-accent transition">Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>


    <!-- Footer -->
    <footer class="bg-secondary_background text-secondary_text font-heading2 pt-12 pb-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
      <div>
        <h3 class="text-lg font-semibold mb-2">Turistička organizacija regije Zapadna Srbija</h3>
        <address class="not-italic text-sm text-gray-200 mb-3">
        D.Tucovića 52, 31000 Užice<br>
        <a href="tel:+38131500155" class="hover:text-primary">+381 31/ 500 - 155</a><br>
        <a href="mailto:office@westserbia.org" class="hover:text-primary">office@westserbia.org</a>
        </address>
      </div>

      <div>
        <h4 class="mb-2 font-semibold">Navigacija</h4>
        <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-primary">Organizacija</a></li>
        <li><a href="#" class="hover:text-primary">O nama</a></li>
        <li><a href="#" class="hover:text-primary">Brošure</a></li>
        <li><a href="#" class="hover:text-primary">OPEN AIR EVERYWHERE</a></li>
        <li><a href="#" class="hover:text-primary">Kontakt</a></li>
        <li><a href="#" class="hover:text-primary">Informator</a></li>
        <li><a href="#" class="hover:text-primary">Turizam</a></li>
        <li><a href="#" class="hover:text-primary">Seoski turizam</a></li>
        <li><a href="#" class="hover:text-primary">Aktivni odmor</a></li>
        <li><a href="#" class="hover:text-primary">Gastronomija</a></li>
        <li><a href="#" class="hover:text-primary">Manifestacije</a></li>
        <li><a href="#" class="hover:text-primary">Vesti</a></li>
        <li><a href="#" class="hover:text-primary">Turistički centri</a></li>
        </ul>
      </div>

      <div>
        <h4 class="mb-2 font-semibold">Turistički centri</h4>
        <ul class="grid grid-cols-2 gap-2 text-sm">
        <li>Užice</li>
        <li>Zlatibor</li>
        <li>Tara – Drina – Bajina Bašta</li>
        <li>Zlatar – Nova Varoš</li>
        <li>Čačak</li>
        <li>Prijepolje</li>
        <li>Ivanjica</li>
        <li>Sjenica</li>
        <li>Dragačevo – Guča</li>
        <li>Arilje</li>
        <li>Požega</li>
        <li>Kosjerić</li>
        <li>Ljubovija</li>
        <li>Mali Zvornik</li>
        </ul>
      </div>
      </div>

      <div class="border-t border-secondary_text pt-4 text-center text-sm text-gray-400">
      <p>&copy; 2021 Turistička organizacija regije Zapadna Srbija. All rights reserved.</p>
      </div>
    </div>
    </footer>

  <!-- Bottom helper scripts -->
  <script>
    (function(){
      const navbar = document.getElementById('navbar');
      if (!navbar) return;
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 20) {
          navbar.classList.add('shadow-lg', 'bg-surface');
          navbar.classList.remove('bg-background/95', 'backdrop-blur-md');
        } else {
          navbar.classList.remove('shadow-lg', 'bg-surface');
          navbar.classList.add('bg-background/95', 'backdrop-blur-md');
        }
      }, { passive: true });
    })();

    (function(){
      const mobileBtn = document.getElementById('mobileBtn');
      const mobileMenu = document.getElementById('mobileMenu');
      if (!mobileBtn || !mobileMenu) return;
      mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    })();

    (function(){
      const searchBtn = document.getElementById('searchBtn');
      const searchDropdown = document.getElementById('searchDropdown');
      if (!searchBtn || !searchDropdown) return;
      searchBtn.addEventListener('click', () => {
        searchDropdown.classList.toggle('hidden');
      });
    })();
  </script>

</body>
</html>
