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
            primary: '#3F6B68',
            primary_hover: '#315654',
            secondary: '#C9B79C',
            secondary_hover: '#B8A486',
            accent: '#A66A4A',
            accent_hover: '#8C583C',
            surface: '#FFFFFF',
            primary_text: '#2F4F4F',
            secondary_text: '#696969',
            background: '#F8F7F4',
            secondary_background: '#EFECE6',
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
      line-clamp: 2;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .line-clamp-3 {
      display: -webkit-box;
      line-clamp: 3;
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
            Početna
          </a>
          <div class="mobile-dropdown">
            <button
              class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-primary_hover rounded-lg transition-all"
              id="mobileAboutToggle">
              <span class="font-medium tracking-wide">O nama</span>
              <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                id="mobileAboutIcon"></i>
            </button>
            <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary_hover transition-colors">
                Misija i vizija
              </a>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary_hover transition-colors">
                Istorijat
              </a>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary_hover transition-colors">
                Lazar Vozarević
              </a>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary_hover transition-colors">
                Organi upravljanja
              </a>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary_hover transition-colors">
                Organizaciona struktura
              </a>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-primary transition-colors">
                Informacije
              </a>
            </div>
          </div>
          <a href="#"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            Izložbe
          </a>
          <a href="news.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            Vesti
          </a>
          <a href="#"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            Galerija
          </a>
          <a href="#"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            Dokumenti
          </a>
          <a href="contact.html"
            class="flex items-center py-3 px-4 text-primary_text hover:text-primary hover:bg-surface rounded-lg transition-all">
            Kontakt
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
    class="fixed w-full z-50 transition-all duration-300 py-2 sm:py-3 backdrop-blur-md shadow-lg bg-secondary_background/95 border-b border-surface">
    <div class="px-3 sm:px-4 lg:px-6 flex justify-between items-center">
      <a href="/" class="flex items-center space-x-3 flex-shrink-0">
        <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
          <img src="" alt="" style="width:75px;height:auto;" />
        </div>

        <div class="hidden sm:block">
          <h1
            class="text-lg sm:text-base lg:text-lg font-heading text-primary_text font-bold tracking-wide leading-tight">
            Galerija
          </h1>
          <p
            class="text-base sm:text-xs lg:text-sm text-secondary tracking-widest hidden md:block opacity-80 font-medium">
            Lazar Vozarević
          </p>
        </div>

        <div class="block sm:hidden">
          <h1 class="text-xs sm:text-sm font-heading text-primary_text font-bold tracking-wide">Galerija Lazar Vozarević</h1>
        </div>
      </a>

      <nav id="navBarID" class="hidden lg:flex gap-7 items-center space-x-1 xl:space-x-3">
        <a href="#"
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
          <span class="hidden xl:inline text-sm">Početna</span>
        </a>

        <div class="dropdown relative group">
          <button
            class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
            <span class="hidden xl:inline text-sm">O nama</span>
            <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
          </button>
          <div
            class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-secondary_background rounded-xl shadow-2xl border border-surface opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3 backdrop-blur-sm">
            <a href="#" static="true"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Misija i vizija</span>
            </a>
            <a href="#" static="true"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Istorijat</span>
            </a>
            <a href="#" static="true"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Lazar Vozarević</span>
            </a>
            <a href="#"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Organi upravljanja</span>
            </a>
            <a href="#"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Organizaciona struktura</span>
            </a>
            <a href="#"
              class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
              <span class="font-medium">Informacije</span>
            </a>
          </div>
        </div>

        <a
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group">
          <span class="hidden xl:inline text-sm tracking-wide">Izložbe</span>
        </a>

        <a href="#"
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group">
          <span class="hidden xl:inline text-sm tracking-wide">Vesti</span>
        </a>

        <a href="#"
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group">
          <span class="hidden xl:inline text-sm tracking-wide">Galerija</span>
        </a>

        <a href="#"
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group">
          <span class="hidden xl:inline text-sm tracking-wide">Dokumenti</span>
        </a>

        <a href="#"
          class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 group">
          <span class="hidden xl:inline text-sm tracking-wide">Kontakt</span>
        </a>

        <a href="#" class="hidden">
          Ankete
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
            <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
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
              <input type="text" name="q" placeholder="Pretražite sadržaj..."
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

  <!-- Hero Section -->
  <section class="relative overflow-hidden pt-28 pb-24 artistic-pattern">
    <div class="absolute inset-0 bg-gradient-to-b from-white/85 via-background/90 to-surface/95"></div>
    <div class="absolute -top-20 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-accent/10 blur-3xl"></div>
    <div class="absolute -bottom-24 right-0 h-96 w-96 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="container mx-auto px-4 relative z-10">
      <div class="mx-auto max-w-5xl text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.35em] text-secondary mb-5">Galerija Lazar Vozarević</p>
        <h1 class="text-5xl md:text-7xl font-heading font-bold leading-[0.95] text-primary_text mb-6">
          <span class="block">OTKRIJTE UMETNOST</span>
          <span class="block text-primary">DOŽIVITE KULTURU</span>
        </h1>
        <p class="mx-auto max-w-3xl text-lg md:text-xl leading-8 text-secondary_text">
        Istražite aktuelne izložbe, radionice i kulturne događaje u Galeriji "Lazar Vozearević"
        </p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
          <a href="/izlozbe"
            class="bg-primary hover:bg-primary_hover text-white px-8 py-4 rounded-2xl font-medium shadow-lg transition-all transform hover:-translate-y-0.5 hover:shadow-xl">
            <i class="fas fa-palette mr-2"></i>Pogledaj izložbe
          </a>
          <a href="/galerija"
            class="border border-primary/30 bg-white/80 text-primary hover:bg-primary hover:text-white px-8 py-4 rounded-2xl font-medium transition-all backdrop-blur">
            <i class="fas fa-images mr-2"></i>Pogledaj galeriju
          </a>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-[0.9fr_1.1fr] items-center text-left">
          <div class="rounded-[2rem] border border-primary/10 bg-secondary_background p-8 shadow-2xl">
            <h2 class="text-3xl font-heading font-bold text-primary_text mb-4">O galeriji</h2>
            <p class="text-secondary_text leading-7">
            Galerija „Lazar Vozarević“ u Sremskoj Mitrovici je ustanova kulture posvećena očuvanju, proučavanju i predstavljanju likovne baštine, sa posebnim fokusom na stvaralaštvo jednog od najznačajnijih srpskih slikara 20. veka – Lazara Vozarevića. Kroz izložbe, stručne programe, radionice i savremene projekte, Galerija povezuje umetničko nasleđe sa savremenim stvaralaštvom. Galerija doprinosi razvoju kulturnog života Sremske Mitrovice i neguje umetnost kao univerzalni jezik koji povezuje zajednicu.
            </p>
          </div>

          <div class="rounded-[2rem] overflow-hidden border border-white/70 bg-white shadow-2xl">
            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=1200&q=80"
              alt="Galerija prostor" class="h-[340px] w-full object-cover">
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Current Exhibitions -->
  <section id="izlozbe" class="py-20 bg-secondary_background">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
          Predstojeće izložbe
          <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></span>
        </h2>
        <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-4">
          Istražite najnovija umetnička dela i postavke u našoj galeriji.
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
                  Početak: <span id="g-datum">20. Decembar 2025</span>
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
                class="mt-4 block text-center bg-secondary text-white font-bold py-3 rounded-xl hover:bg-secondary_hover transition-colors duration-300">
                Pogledajte detaljnije
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
          Naša priča
        </h2>
        <p class="text-lg text-secondary_text max-w-3xl mx-auto">
        Galerija „Lazar Vozarević“ čuva, proučava i predstavlja umetničko nasleđe Lazara Vozarevića i drugih značajnih autora, podstiče savremeno umetničko stvaralaštvo i razvija kreativni potencijal kroz izložbe, edukativne programe i inovativne projekte. Kao otvorena i dostupna ustanova kulture, teži da inspiriše različite generacije, neguje kreativnost i doprinosi razvoju kulturnog života Sremske Mitrovice i šire zajednice.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="space-y-6">
            <div>
              <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Istorijat</h3>
              <p class="text-secondary_text leading-relaxed">
              Galerija „Lazar Vozarević“ u Sremskoj Mitrovici osnovana je 17. novembra 1973. godine, kada je svečano otvorena izložbom slika i crteža jednog od najznačajnijih srpskih slikara 20. veka – Lazara Vozarevića (1925–1968). Osnivanje Galerije predstavljalo je ostvarenje ideje da se u umetnikovom rodnom gradu trajno sačuva i predstavi njegovo bogato stvaralaštvo, ali i da se stvori prostor za razvoj savremene likovne umetnosti.

              Galerija je smeštena u delu zgrade nekadašnje Srpske narodne škole u Gradskom parku, u istorijskom jezgru Sremske Mitrovice. Njeno jezgro čini memorijalna zbirka sa delima Lazara Vozarevića – slikama, crtežima, kolažima i dokumentarnom građom koja svedoči o njegovom umetničkom razvoju i stvaralačkom putu.

              Tokom više od pet decenija rada, Galerija je izrasla iz memorijalne ustanove u savremen centar vizuelne umetnosti. Pored stalne postavke, organizuje samostalne i kolektivne izložbe domaćih i međunarodnih umetnika, stručna vođenja, predavanja, radionice, promocije publikacija i brojne edukativne programe namenjene deci, mladima i odraslima. Posebno mesto u programskoj delatnosti zauzimaju izložbe savremene umetnosti, kao i tradicionalne manifestacije koje afirmišu likovno stvaralaštvo i kulturno nasleđe Srema.


              Danas Galerija „Lazar Vozarević“ predstavlja važnu ustanovu kulture grada Sremske Mitrovice i Republike Srbije, koja čuva umetničko nasleđe svog znamenitog sugrađanina i istovremeno podržava savremene umetničke prakse.
              </p>
            </div>

            <div>
              <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Misija</h3>
              <p class="text-secondary_text leading-relaxed">
                Naša misija je da kroz izložbe, kulturne programe i saradnju sa umetnicima promovišemo umetnost i učinimo je dostupnom široj publici. 
              </p>
            </div>

            <div>
              <h3 class="text-2xl font-heading font-bold text-primary_text mb-4">Vizija</h3>
              <p class="text-secondary_text leading-relaxed">
              Težimo da galerija bude prepoznata kao mesto inspiracije, obrazovanja i kulturne razmene. Želimo da svojim radom doprinosimo razvoju umetničke scene i jačanju kulturnog identiteta zajednice.
              </p>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white shadow-2xl">
            <img src="https://images.unsplash.com/photo-1518998053901-5348d3961a04?auto=format&fit=crop&w=1200&q=80"
              alt="Unutrašnjost galerije" class="h-[420px] w-full object-cover">
          </div>

          <div class="-mt-10 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-primary/10 bg-secondary_background p-6 shadow-lg">
              <h3 class="text-2xl font-heading font-bold text-primary_text mb-2">O galeriji</h3>
              <p class="text-secondary_text leading-7">
                Savremeni izložbeni prostor posvećen promociji umetnosti, kulture i dijaloga između umetnika i publike.
              </p>
            </div>

            <div class="rounded-2xl border border-primary/10 bg-primary text-white p-6 shadow-lg">
              <h3 class="text-2xl font-heading font-bold mb-2">Događaji i program</h3>
              <p class="text-white/90 leading-7">
                Pratite otvaranja izložbi, vođenja kroz postavke, razgovore sa umetnicima i kreativne radionice tokom cele godine.
              </p>
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
          Najnovije vesti
          <div
            class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary rounded-full">
          </div>
        </h2>
        <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6">
          Budite u toku sa najnovijim dešavanjima iz sveta kulture
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
        <a href="/vesti"
          class="w-fit bg-gradient-to-r from-primary via-primary_hover to-primary text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center mx-auto group shadow-xl">
          <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform"></i>
          Pogledaj sve vesti
          <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
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
            <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl mr-4">
              <img src="" alt="" style="width:75px;height:auto;" />
            </div>
            <h3 class="text-2xl font-heading font-bold">Galerija Lazar Vozarević</h3>
          </div>
          <p class="text-white mb-4 leading-relaxed">
            Zapratite nas na društvenim mrežama i budite u toku sa najnovijim izložbama, događajima i vestima iz sveta umetnosti.
          </p>
          <div class="flex space-x-3">
            <a href="https://www.facebook.com/lazarvozarevic"
              class="w-10 h-10 bg-primary hover:bg-primary_hover rounded-full flex items-center justify-center text-white transition-colors">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/galerijalazarvozarevic/"
              class="w-10 h-10 bg-primary hover:bg-primary_hover rounded-full flex items-center justify-center text-white transition-colors">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Brzi Linkovi</h4>
          <ul class="space-y-3">
            <li><a href="/ankete" class="text-white hover:text-accent transition-colors">Ankete o zadovoljstvu korisnika</a></li>
            <li><a href="/izlozbe" class="text-white hover:text-accent transition-colors">Izložbe</a></li>
            <li><a href="https://www.kultura.gov.rs/" class="text-white hover:text-accent transition-colors">Ministarstvo kulture Republike Srbije</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Informacije</h4>
          <ul class="space-y-3">
            <li class="flex items-start">
              <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
              <span> Gradski park 4, 22000 Sremska Mitrovica</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-phone text-accent mt-1 mr-3"></i>
              <span>022/621-492</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-envelope text-accent mt-1 mr-3"></i>
              <span data-translate="off">galerijalazarvozarevic@gmail.com</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-clock text-accent mt-1 mr-3"></i>
              <span>
                Utorak - Petak: 09:00 - 19:00<br>
                Subota: 10:00 - 15:00<br>
              </span>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-heading font-bold mb-6">Lokacija</h4>
          <div class="rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2822.825005430709!2d19.607286199999997!3d44.9675492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475ba4d7d4f42de5%3A0x3556ff745226b3a8!2z0JPQsNC70LXRgNC40ZjQsCAi0JvQsNC30LDRgCDQktC-0LfQsNGA0LXQstC40Zsi!5e0!3m2!1ssr!2srs!4v1783684883657!5m2!1ssr!2srs"
              class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>

      <div class="flex flex-col items-center border-t border-white pt-8 text-center text-white text-sm">
        <img src="/assets/img/SECO-logo-640px-white.png" alt="SECO logo"
          class="w-full max-w-md md:max-w-lg h-auto mb-4">
        <p> Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno
          zvanični stav Vlade Švajcarske.</p>
      </div>

      <div class="pt-8 text-center text-white">
        <p>&copy; 2026 Galerija Lazar Vozarević. Sva prava zadržana.</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mobile menu functionality
      const hamburger = document.getElementById('hamburger');
      const mobileMenu = document.getElementById('mobileMenu');
      const closeMobileMenu = document.getElementById('closeMobileMenu');
      const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
      const mobileAboutToggle = document.getElementById('mobileAboutToggle');
      const mobileExhibitionsToggle = document.getElementById('mobileExhibitionsToggle');

      // Toggle mobile menu
      hamburger.addEventListener('click', function() {
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

      if (mobileAboutToggle) {
        mobileAboutToggle.addEventListener('click', function(e) {
          e.preventDefault();
          toggleMobileAbout();
        });
      }

      // Function to toggle mobile about submenu
      function toggleMobileCollection() {
        const isHidden = mobileCollectionMenu.classList.contains('hidden');

        if (isHidden) {
          // Show submenu
          mobileCollectionMenu.classList.remove('hidden');
          mobileCollectionIcon.style.transform = 'rotate(180deg)';
        } else {
          // Hide submenu
          mobileCollectionMenu.classList.add('hidden');
          mobileCollectionIcon.style.transform = 'rotate(0deg)';
        }
      }

      if (mobileCollectionToggle) {
        mobileCollectionToggle.addEventListener('click', function(e) {
          e.preventDefault();
          toggleMobileCollection();
        });
      }

      // Search functionality
      const searchButton = document.getElementById('searchButton');
      const searchInputContainer = document.getElementById('searchInputContainer');
      const closeSearch = document.getElementById('closeSearch');

      searchButton.addEventListener('click', function() {
        searchInputContainer.classList.toggle('hidden');
        setTimeout(() => {
          searchInputContainer.classList.toggle('opacity-0');
        }, 10);
      });

      closeSearch.addEventListener('click', function() {
        searchInputContainer.classList.add('opacity-0');
        setTimeout(() => {
          searchInputContainer.classList.add('hidden');
        }, 300);
      });

      // Font size increase functionality
      const increaseFontBtn = document.getElementById('increaseFontBtn');
      let fontSizeIncreased = false;

      increaseFontBtn.addEventListener('click', function() {
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
        anchor.addEventListener('click', function(e) {
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