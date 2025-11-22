<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KRAGUJEVAC | Gradska Turistička Organizacija</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Tailwind Play CDN config — tokenized colors & fonts
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#059669',
            primary_hover: '#047857',
            secondary: '#0d9488',
            secondary_hover: '#0f766e',
            accent: '#0ea5e9',
            accent_hover: '#0284c7',
            primary_text: '#111827',
            secondary_text: '#4b5563',
            background: '#f9fafb',
            secondary_background: '#111827',
            surface: '#ffffff',
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

    .mobile-dropdown-content { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
    .mobile-dropdown.active .mobile-dropdown-content { max-height: 500px; }
    .mobile-dropdown.active .mobile-dropdown-chevron { transform: rotate(180deg); }

    /* ========= GLOBAL SECTION HEADINGS ========= */
    .section-heading {
      font-family: "Playfair Display", serif;
      font-weight: 700;
      color: var(--color-primary_text);
      font-size: clamp(2.4rem, 3vw, 3rem);
      text-align: center;
      position: relative;
      display: inline-flex;
      flex-direction: column;
      align-items: center;
      gap: 0.65rem;
      padding-bottom: 2.6rem; /* space for line + icon */
    }

    /* underline */
    .section-heading::before {
      content: "";
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 1.6rem;
      width: 120px;
      height: 3px;
      border-radius: 9999px;
      background: linear-gradient(
        to right,
        var(--color-primary),
        var(--color-accent)
      );
      opacity: 0.85;
    }

    /* circle badge + icon */
    .section-heading::after {
      content: "\f5a0"; /* default map pin */
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 0;
      width: 40px;
      height: 40px;
      border-radius: 9999px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      background: #ffffff;
      color: var(--color-primary);
      border: 1px solid rgba(15, 23, 42, 0.06);
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.18);
    }

    /* Dobro došli – srce */
    .section-intro .section-heading::after {
      content: "\f004";
      color: var(--color-accent);
    }
    .section-intro .section-heading::before {
      background: linear-gradient(
        to right,
        var(--color-accent),
        var(--color-primary)
      );
    }

    /* Destinacije – location pin */
    #destinacije .section-heading::after {
      content: "\f3c5";
      color: var(--color-primary);
    }
    #destinacije .section-heading::before {
      background: linear-gradient(
        to right,
        var(--color-primary),
        var(--color-secondary)
      );
    }

    /* Multimedija – play icon */
    #gallery .section-heading::after {
      content: "\f04b";
      color: var(--color-secondary);
    }
    #gallery .section-heading::before {
      background: linear-gradient(
        to right,
        var(--color-secondary),
        var(--color-accent)
      );
    }

    /* Događaji – calendar icon */
    #events .section-heading::after {
      content: "\f133";
      color: var(--color-primary);
    }
    #events .section-heading::before {
      background: linear-gradient(
        to right,
        var(--color-secondary),
        var(--color-primary)
      );
      width: 140px;
    }

    /* Vesti – newspaper icon */
    #vesti .section-heading::after {
      content: "\f1ea";
      color: var(--color-accent);
    }
    #vesti .section-heading::before {
      background: linear-gradient(
        to right,
        var(--color-primary),
        var(--color-accent)
      );
    }

    /* Section background accents (subtle radial glows behind headings) */
    #destinacije,
    #gallery,
    #events,
    #vesti {
      position: relative;
      overflow: hidden;
    }

    #destinacije::before,
    #gallery::before,
    #events::before,
    #vesti::before {
      content: "";
      position: absolute;
      inset-inline: 10%;
      top: -120px;
      height: 260px;
      pointer-events: none;
      opacity: 0.7;
      filter: blur(6px);
      z-index: -1;
    }

    #destinacije::before {
      background: radial-gradient(circle at center, rgba(16, 185, 129, 0.16), transparent 70%);
    }

    #gallery::before {
      background: radial-gradient(circle at center, rgba(14, 165, 233, 0.18), transparent 72%);
    }

    #events::before {
      background: radial-gradient(circle at center, rgba(34, 197, 94, 0.18), transparent 72%);
    }

    #vesti::before {
      background: radial-gradient(circle at center, rgba(59, 130, 246, 0.2), transparent 72%);
    }

    /* Diagonal cut for destination card images */
    .clip-diagonal {
      clip-path: polygon(0 0, 100% 0, 100% 82%, 0 100%);
    }

    /* Destination cards */
    .dest-card {
      position: relative;
      border-radius: 1.5rem;
      overflow: hidden;
      background: var(--color-surface);
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
      transition: transform .3s ease, box-shadow .3s ease;
    }
    .dest-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 26px 55px rgba(15, 23, 42, 0.22);
    }
    .dest-card-gradient {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top,
        rgba(15, 23, 42, 0.9),
        rgba(15, 23, 42, 0.55),
        transparent
      );
      z-index: 1;
    }
    .dest-card-footer {
      position: absolute;
      inset-inline: 0;
      bottom: 0;
      padding: 1.25rem 1.75rem 1.65rem;
      color: #f9fafb;
      z-index: 2;
    }
    .dest-card-badge {
      background: linear-gradient(to right, var(--color-primary), var(--color-secondary));
      backdrop-filter: blur(10px);
    }

    /* Gallery / Multimedija */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    }
    .gallery-item {
      position: relative;
      min-height: 230px;
      background: #020617;
      box-shadow: 0 18px 35px rgba(15, 23, 42, 0.18);
      overflow: hidden;
      transition: transform .35s ease, box-shadow .35s ease;
    }
    .gallery-item img {
      height: 100%;
      width: 100%;
      object-fit: cover;
      transition: transform .5s ease;
    }
    .gallery-item::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to top,
        rgba(15, 23, 42, 0.95),
        rgba(15, 23, 42, 0.25)
      );
      opacity: .9;
      transition: opacity .35s ease;
    }
    .gallery-item:hover {
      transform: translateY(-6px);
      box-shadow: 0 24px 45px rgba(15, 23, 42, 0.28);
    }
    .gallery-item:hover img {
      transform: scale(1.06);
    }
    .gallery-item:hover::after {
      opacity: 1;
    }
    .overlay-content {
      position: absolute;
      inset-inline: 0;
      bottom: 0;
      padding: 1.5rem 1.75rem 1.75rem;
      z-index: 10;
    }
    .overlay-content h3 {
      font-family: "Playfair Display", serif;
      font-size: 1.35rem;
      margin-bottom: .25rem;
    }
    .overlay-content p {
      font-family: "Inter", sans-serif;
      font-size: .82rem;
      text-transform: uppercase;
      letter-spacing: .12em;
      opacity: .85;
    }

    /* Event cards */
    .event-card {
      border-radius: 1.25rem;
      overflow: hidden;
      box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
      border: 1px solid rgba(148, 163, 184, 0.35);
      background: var(--color-surface);
      transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .event-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(15, 23, 42, 0.16);
      border-color: rgba(45, 212, 191, 0.65);
    }
    .event-title-color {
      color: var(--color-primary_text);
    }

    /* News / Vesti cards */
    .news-card {
      border-radius: 1.25rem;
      overflow: hidden;
      background: var(--color-surface);
      box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .news-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 22px 45px rgba(15, 23, 42, 0.16);
    }
    .news-image {
      position: relative;
      min-height: 210px;
    }
    .news-image::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to top,
        rgba(15, 23, 42, 0.8),
        rgba(15, 23, 42, 0.15)
      );
      opacity: .4;
      transition: opacity .3s ease;
    }
    .news-card:hover .news-image::after {
      opacity: .7;
    }
    .news-badge {
      background: linear-gradient(to-br, var(--color-accent), var(--color-primary));
    }

    /* Partner logos */
    .partners-strip img {
      filter: grayscale(100%);
      opacity: 0.8;
      transition: filter .25s ease, opacity .25s ease, transform .25s ease;
    }
    .partners-strip img:hover {
      filter: grayscale(0%);
      opacity: 1;
      transform: translateY(-2px);
    }

    @media (max-width: 768px) {
      /* nothing special for headings, just let them breathe */
    }
  </style>
</head>

<body class="bg-background font-body text-primary_text">

  <!-- ===== Mobile Offcanvas ===== -->
  <div id="mobileMenu" class="fixed inset-0 z-40 lg:hidden hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
    <div id="mobileMenuPanel" class="fixed top-0 right-0 h-full w-80 max-w-full bg-surface shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out">
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

          <div class="mobile-dropdown">
            <button class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all" id="mobileAboutToggle">
              <div class="flex items-center"><i class="fas fa-info-circle mr-3 text-primary"></i>O nama</div>
              <i class="fas fa-chevron-down  transition-transform duration-200" id="mobileAboutIcon"></i>
            </button>
            <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-bullseye mr-2 text-primary"></i>Cilj</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-users-cog mr-2 text-primary"></i>Rukovodstvo</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-flag mr-2 text-primary"></i>Misija</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-history mr-2 text-primary"></i>Istorijat</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fa-question mr-2 text-primary"></i>Pitanja</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors"><i class="fas fa-users mr-2 text-primary"></i>Timovi</a>
            </div>
          </div>

          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-map-marker-alt mr-3 text-primary"></i>Destinacije</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-calendar-alt mr-3 text-primary"></i>Manifestacije</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-bed mr-3 text-primary"></i>Smeštaj</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-person-hiking mr-3 text-primary"></i>Aktivnosti</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-utensils mr-3 text-primary"></i>Gastronomija</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all"><i class="fas fa-file-alt mr-3 text-primary"></i>Dokumenti</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-address-book mr-3 text-primary"></i>Kontakt</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i class="fas fa-calendar-alt mr-2 text-primary"></i>Vesti</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all"><i  class="fas fa-diagram-project mr-2 text-primary"></i>Događaji</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50"><i  class="fas fa-images mr-2 text-primary"></i>Multimedija</a>
        </nav>
      </div>
    </div>
  </div>

  <!-- Font size button -->
  <button id="increaseFontBtn" class="fixed bottom-6 right-6 z-40 bg-primary hover:bg-primary_hover text-white py-3 px-5 rounded-full shadow-lg transition" aria-label="Povećaj font">A+</button>

  <!-- ===== Sticky Header ===== -->
  <header id="navbar" class="fixed w-full z-30 transition-all duration-300 py-3 bg-background/95 backdrop-blur-md">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="/" class="flex items-center gap-3">
        <div class="w-11 h-11 bg-gradient-to-br from-[#CC8B3C] via-[#C85A3E] to-[#E07856] rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
          <img src="" alt="" style="width:75px;height:auto;" />
        </div>
        <div class="hidden sm:block">
          <div class="text-xl font-bold text-primary_text font-heading2">KRAGUJEVAC</div>
          <div class="text-xs text-secondary_text">Gradska Turistička Organizacija</div>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-6 text-secondary_text">
        <div class="dropdown relative group transition-colors">
          <button class="px-3 py-2 nav-link transition-colors flex items-center whitespace-nowrap px-1">
            <span class="hidden xl:inline flex items-center">O nama</span>
            <i class="fas fa-chevron-down ml-1 text-xs"></i>
          </button>
          <div class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="#" static="true" class="transition-colors dropdown-item flex items-center px-4 py-2 rounded-md text-sm">Cilj</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Organizaciona struktura</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Rukovodstvo</a>
            <a href="#" static="true" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Misija</a>
            <a href="#" static="true" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Istorijat</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Timovi</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Pitanja</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm">Informacije</a>
          </div>
        </div>

        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Destinacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Manifestacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Smeštaj</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Aktivnosti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Gastronomija</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Dokumenti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Kontakt</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Vesti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Događaji</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1">Multimedija</a>

        <!-- Language dropdown -->
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
          <div id="searchInputContainer" class="absolute right-0 top-full mt-2 opacity-0 hidden z-50 min-w-[300px] bg-surface rounded-md shadow-lg border border-gray-200 overflow-hidden">
            <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
              <input id="searchInput" type="text" name="q" placeholder="Pretražite destinacije, smeštaj, manifestacije…" class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-2 placeholder-gray-400" required />
              <button type="submit" class="p-2 w-8 h-8 flex items-center justify-center" aria-label="Submit search">
                <i class="fas fa-search text-sm"></i>
              </button>
              <button type="button" id="closeSearch" class="p-2 w-8 h-8 flex items-center justify-center" aria-label="Clear">
                <i class="fas fa-times text-sm"></i>
              </button>
            </form>
          </div>
        </div>

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
    (function(){
      const header = document.querySelector('header');
      const onScroll = () => {
        if (window.scrollY > 50) {
          header.classList.add('bg-surface','shadow-sm');
          header.classList.remove('bg-background/95');
        } else {
          header.classList.remove('bg-surface','shadow-sm');
          header.classList.add('bg-background/95');
        }
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    })();

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

    (function(){
      const hamburger = document.getElementById('hamburger');
      const mobileMenu = document.getElementById('mobileMenu');
      const panel = document.getElementById('mobileMenuPanel');
      const overlay = document.getElementById('mobileMenuOverlay');
      const closeBtn = document.getElementById('closeMobileMenu');
      const mobileAboutToggle = document.getElementById('mobileAboutToggle');
      const mobileAboutMenu = document.getElementById('mobileAboutMenu');
      const mobileAboutIcon = document.getElementById('mobileAboutIcon');

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

      function toggleMobileAbout() {
        const isHidden = mobileAboutMenu.classList.contains('hidden');
        if (isHidden) {
          mobileAboutMenu.classList.remove('hidden');
          mobileAboutIcon.style.transform = 'rotate(180deg)';
        } else {
          mobileAboutMenu.classList.add('hidden');
          mobileAboutIcon.style.transform = 'rotate(0deg)';
        }
      }

      if (hamburger) hamburger.addEventListener('click', (e)=>{ e.stopPropagation(); openMenu(); });
      if (overlay) overlay.addEventListener('click', closeMenu);
      if (closeBtn) closeBtn.addEventListener('click', closeMenu);
      if (mobileAboutToggle) { mobileAboutToggle.addEventListener('click', function(e) { e.preventDefault(); toggleMobileAbout(); }); }
      document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) closeMenu(); });
      document.querySelectorAll('#mobileMenu nav a').forEach(a=> a.addEventListener('click', ()=> setTimeout(closeMenu, 120)));
      window.addEventListener('resize', ()=> { if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) closeMenu(); });
    })();

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

  <!-- ===== HERO: Video background with title + glass search ===== -->
  <section class="relative pt-20 overflow-hidden min-h-[80vh] lg:min-h-[92vh] flex items-center">
    <div class="absolute inset-0 z-0">
      <video
        class="w-full h-full object-cover"
        autoplay
        muted
        loop
        playsinline
        poster="/assets/img/hero-poster.jpg"
        preload="metadata">
        <source src="/assets/videos/Uvodni-spot-sa-novim-logotipom.webm" type="video/webm">
        <source src="/assets/videos/Uvodni-spot-sa-novim-logotipom.mp4"  type="video/mp4">
        Vaš pregledač ne podržava HTML5 video.
      </video>

      <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/80"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 py-40 lg:py-48">
      <div class="max-w-6xl mx-auto text-center">
        <h1 class="font-heading text-white text-5xl md:text-7xl font-bold drop-shadow-xl tracking-[0.25em] uppercase">
          Kragujevac
        </h1>

        <div class="max-w-3xl mx-auto mt-10">
          <div class="bg-white/10 backdrop-blur-md rounded-2xl p-2 border border-white/25 shadow-xl">
            <div class="relative">
              <form class="flex items-center w-full p-2" action="/pretraga" method="GET">
                <input
                  type="text"
                  name="q"
                  placeholder="Pretražite destinacije, smeštaj, manifestacije…"
                  class="w-full px-6 py-4 bg-white/5 rounded-xl border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-primary/70"
                  required
                />
                <button
                  type="submit"
                  class="absolute right-3 top-1/2 -translate-y-1/2 p-2 bg-gradient-to-r from-primary to-secondary_hover hover:from-secondary hover:to-primary_hover rounded-lg transition-all duration-300 shadow-md"
                  aria-label="Traži">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== DOBRO DOŠLI ===== -->
  <section class="section-intro py-14 md:py-20 bg-surface">
    <div class="container mx-auto px-4 max-w-6xl">
      <div class="flex items-center justify-between">
        <span class="hidden md:block w-24 h-[3px] bg-gradient-to-r from-primary to-accent rounded-full"></span>
        <h2 class="section-heading">
          Dobro došli u grad sa dušom, dobro došli u Kragujevac
        </h2>
        <span class="hidden md:block w-24 h-[3px] bg-gradient-to-r from-accent to-secondary rounded-full"></span>
      </div>
      <p class="mt-6 text-secondary_text leading-relaxed text-lg md:text-xl text-center max-w-4xl mx-auto font-heading2">
        Od tradicionalnih, kulturnih i verskih lokaliteta do jedinstvenih parkova, galerija i muzeja – Kragujevac ima atrakcije
        i znamenitosti za svačiji ukus. Grad spaja autentični ritam, gastronomiju i noćni život u prijatnoj, dinamičnoj atmosferi.
      </p>

      <div class="mt-10">
        <img
          src="/assets/img/ja-volim-kg.jpg"
          alt="Ja volim Kragujevac"
          style="width:100%;height:auto;"
          class="rounded-3xl shadow-2xl border border-gray-100"
        />
      </div>
    </div>
  </section>

  <!-- Featured Destinations -->
  <section id="destinacije" class="py-20 bg-background">
    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-16">
        <h2 class="section-heading">
          Šta videti - Istaknute destinacije
        </h2>
      </div>

      <div id="destinacijeCards" class="grid gap-8 sm:grid-cols-2 xl:grid-cols-4">
        <!-- Destination Card 1 -->
        <div class="group dest-card bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img id="g-slika"
              src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop"
              alt="Mountain peak"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="dest-card-gradient"></div>
          </div>
          <div class="dest-card-footer">
            <div id="g-naziv" class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3">
              Planina
            </div>
            <h3 id="g-naziv_destinacije" class="text-2xl font-heading font-bold mb-1">
              Vrhovi Regije
            </h3>
            <p id="g-kratak_opis" class="text-sm text-gray-100 mb-4">
              Spektakularni pogledi i planinarske staze.
            </p>
            <a id="g-ovise" href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 2 -->
        <div class="group dest-card bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img
              src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=600&h=400&fit=crop"
              alt="Forest"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="dest-card-gradient"></div>
          </div>
          <div class="dest-card-footer">
            <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3">
              Priroda
            </div>
            <h3 class="text-2xl font-heading font-bold mb-1">
              Nacionalni Parkovi
            </h3>
            <p class="text-sm text-gray-100 mb-4">
              Očuvana divljina i bogat biodiverzitet.
            </p>
            <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 3 -->
        <div class="group dest-card bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img
              src="https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=600&h=400&fit=crop"
              alt="River"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="dest-card-gradient"></div>
          </div>
          <div class="dest-card-footer">
            <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3">
              Reka
            </div>
            <h3 class="text-2xl font-heading font-bold mb-1">
              Reke i Kanjoni
            </h3>
            <p class="text-sm text-gray-100 mb-4">
              Rafting i avanturistički sportovi.
            </p>
            <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition">
              Saznajte više
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Destination Card 4 -->
        <div class="group dest-card bg-surface">
          <div class="relative h-80 overflow-hidden clip-diagonal">
            <img
              src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&h=400&fit=crop"
              alt="City"
              class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
            <div class="dest-card-gradient"></div>
          </div>
          <div class="dest-card-footer">
            <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3">
              Grad
            </div>
            <h3 class="text-2xl font-heading font-bold mb-1">
              Istorijsko Jezgro
            </h3>
            <p class="text-sm text-gray-100 mb-4">
              Šetnje kroz trgove, ulice i znamenitosti.
            </p>
            <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition">
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

  <!-- ===== MULTIMEDIJA / GALERIJA ===== -->
  <section id="gallery" class="py-20 bg-background text-secondary_text font-heading2">
    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-16">
        <h2 class="section-heading">
          Multimedija
        </h2>
        <p class="text-lg md:text-xl max-w-2xl mx-auto text-secondary_text mt-4">
          Doživite Kragujevac kroz fotografije, video zapise i virtuelne ture.
        </p>
      </div>

      <div id="galleryCards" class="gallery-grid gap-6">
        <div class="gallery-item rounded-2xl overflow-hidden relative">
          <img id="g-image_file_path"
            src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?auto=format&fit=crop&w=600&q=80"
            alt="Gallery Space" class="w-full h-full object-cover">
          <div class="overlay-content text-background">
            <h3 id="g-description">Galerije i muzeji</h3>
            <p id="g-title">Umetnost i istorija grada</p>
          </div>
        </div>
        <div class="gallery-item rounded-2xl overflow-hidden">
          <img
            src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?auto=format&fit=crop&w=600&q=80"
            alt="Cinema" class="w-full h-full object-cover">
          <div class="overlay-content text-background">
            <h3>Kino i projekcije</h3>
            <p>Filmske večeri i festivali</p>
          </div>
        </div>
        <div class="gallery-item rounded-2xl overflow-hidden">
          <img
            src="https://images.unsplash.com/photo-1562788865-5638f7446611?auto=format&fit=crop&w=600&q=80"
            alt="Theater" class="w-full h-full object-cover">
          <div class="overlay-content text-background">
            <h3>Pozorišne scene</h3>
            <p>Predstave i performansi</p>
          </div>
        </div>
        <div class="gallery-item rounded-2xl overflow-hidden">
          <img
            src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=600&q=80"
            alt="Workshop" class="w-full h-full object-cover">
          <div class="overlay-content text-background">
            <h3>Manifestacije</h3>
            <p>Koncerti, radionice i događaji</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== DOGAĐAJI ===== -->
  <section id="events" class="py-20 bg-background">
    <div class="container mx-auto px-4 text-center relative z-10">

      <div class="text-center mb-10">
        <h2 class="section-heading">
          Događaji
        </h2>
      </div>

      <div id="eventsCards" class="mt-6 grid md:grid-cols-3 gap-8 text-left">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <div class="event-card bg-surface flex flex-col">
            <div class="relative w-full h-56 md:h-60 overflow-hidden">
              <img id="g-image"
                src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=600&q=80"
                alt="Event image"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
              <div id="g-naziv"
                class="hidden absolute top-3 left-3 bg-primary text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase shadow-md">
                Kultura
              </div>
            </div>

            <div class="w-full p-6">
              <div class="mb-3">
                <h3 id="g-title"
                  class="font-heading text-2xl leading-snug event-title-color hover:text-accent transition-colors duration-200 underline-offset-2 hover:underline">
                  Savremene Perspektive
                </h3>
                <p id="g-description" class="hidden">
                  Radovi mladih umetnika koji istražuju identitet u digitalnom dobu. Inspiracija dolazi iz
                  savremenih trendova u umetnosti i tehnologiji.
                </p>
              </div>

              <div class="mt-1 text-secondary_text text-sm flex flex-wrap items-center gap-x-3 gap-y-1">
                <div class="flex items-center gap-2">
                  <span id="g-datum" class="font-semibold text-primary_text">30.10.2025</span>
                </div>
                <span class="text-secondary_text">•</span>
                <div class="flex items-center gap-2">
                  <span id="g-time" class="font-semibold text-primary_text">18:00 - 21:00</span>
                </div>
                <span class="text-secondary_text">•</span>
                <div class="flex items-center gap-2">
                  <span id="g-location" class="font-semibold text-primary_text">Galerija Savremene Umetnosti</span>
                </div>
              </div>

              <div class="mt-4">
                <a id="g-ovise"
                  class="inline-flex items-center text-primary hover:text-primary_hover font-medium">
                  Više informacija
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <div class="text-center mt-12">
        <a href="dogadjaji" id="eventsView"
          class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all inline-flex items-center justify-center shadow-lg mx-auto max-w-xs w-auto">
          <i class="fas fa-calendar-alt mr-3"></i>
          Pogledaj sve događaje
        </a>
      </div>
    </div>
  </section>

  <!-- ===== VESTI (full-width rows) ===== -->
  <section id="vesti" class="py-20 bg-background">
    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-16">
        <h2 class="section-heading">
          Najnovije Vesti
        </h2>
        <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6">
          Budite u toku sa najnovijim dešavanjima iz sveta kulture, obrazovanja i inovacija.
        </p>
      </div>

      <div id="vestiCards" class="grid grid-cols-1 gap-10">
        <?php for ($i = 0; $i < 3; $i++): ?>
          <article
            class="news-card group md:flex bg-surface transition-all duration-300">
            <div class="news-image md:w-2/5 overflow-hidden">
              <img id="g-slika"
                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                alt="Vest"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-6 md:w-3/5 flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-3 mb-4">
                  <div
                    class="w-12 h-12 rounded-full news-badge flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-newspaper text-lg"></i>
                  </div>
                  <div class="flex items-center text-sm text-secondary_text">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span id="g-datum">15. Oktobar 2025</span>
                  </div>
                </div>

                <h3 id="g-naslov"
                  class="text-xl md:text-2xl font-heading font-bold text-primary_text mb-3 group-hover:text-accent transition-colors line-clamp-2">
                  Novi kulturni centar otvara vrata građanima
                </h3>

                <p id="g-opis" class="text-secondary_text mb-5 line-clamp-3 leading-relaxed">
                  Nakon dve godine izgradnje, novi kulturni centar spreman je da postane epicentar
                  kreativnosti i umetnosti u našem gradu.
                </p>
              </div>

              <div>
                <a id="g-ovise" href="#"
                  class="inline-flex items-center text-accent font-semibold hover:gap-3 gap-2 transition-all group/link">
                  Pročitaj više
                  <i class="fas fa-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                </a>
              </div>
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

  <!-- ===== PARTNERI / LOGO TRAKA ===== -->
  <section class="py-10 bg-background">
    <div class="container mx-auto px-4">
      <div class="partners-strip grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
        <img src="https://raw.githubusercontent.com/ajcloud-dev/assets/main/kultura-kg.png" alt="Kultura Kragujevac" style="width:150px;height:auto;" />
        <img src="https://raw.githubusercontent.com/ajcloud-dev/assets/main/arsenal-fest.png" alt="Arsenal Fest" style="width:150px;height:auto;" />
        <img src="https://raw.githubusercontent.com/ajcloud-dev/assets/main/srce-srbije.png" alt="Srce Srbije" style="width:150px;height:auto;" />
        <img src="https://raw.githubusercontent.com/ajcloud-dev/assets/main/google-play-badge.png" alt="Google Play" style="width:150px;height:auto;" />
      </div>
    </div>
  </section>

  <!-- ===== Footer ===== -->
  <footer class="bg-secondary_background text-secondary_text text-gray-200 font-heading2 pt-20 pb-10">
      <div class="container mx-auto px-4">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
              <div>
                  <div class="flex items-center mb-6">
                      <div class="w-12 h-12 bg-logocolor2 rounded-lg flex items-center justify-center text-background mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-logocolor2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                          </svg>
                      </div>
                      <h3 class="text-xl">Lorem ipsum dolor</h3>
                  </div>
                  <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipiscing elit</p>
                  <div class="flex space-x-3">
                      <a href="#" class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors"><i class="fab fa-facebook-f"></i></a>
                      <a href="#" class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors"><i class="fab fa-instagram"></i></a>
                      <a href="#" class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors"><i class="fab fa-youtube"></i></a>
                      <a href="#" class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors"><i class="fab fa-spotify"></i></a>
                  </div>
              </div>
              <div>
                  <h4 class="mb-6">Brzi linkovi</h4>
                  <ul class="space-y-3">
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                      <li><a href="#" class="text-logocolor2/90 hover:text-primary_text transition-colors">Lorem</a></li>
                  </ul>
              </div>
              <div>
                  <h4 class="mb-6">Informacije</h4>
                  <ul class="space-y-3">
                      <li><a href="/ankete" class="hover:text-secondary transition-colors">Ankete o zadovoljstvu korisnika</a></li>
                      <li class="flex items-start"><i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i><span>Lorem ipsum dolor</span></li>
                      <li class="flex items-start"><i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i><span data-translate="off">Lorem ipsum dolor</span></li>
                      <li class="flex items-start"><i class="fas fa-clock text-logocolor2 mt-1 mr-3"></i><span> Lorem ipsum dolor<br> Lorem ipsum dolor </span></li>
                  </ul>
              </div>
              <div>
                  <h4 class="mb-6">Mapa lokacije</h4>
                  <div class="rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.565652849707!2d20.4541920155352!3d44.81407657909868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa9e7a3e0f5%3A0x534b0b3d3a3b7d4c!2sKnez%20Mihailova%2C%20Beograd!5e0!3m2!1sen!2srs!4v1623426789043!5m2!1sen!2srs" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>
              </div>
          </div>
          <div class="text-center text-sm">
              <div class="flex flex-col items-center border-t border-secondary_text pt-8 text-center text-secondary_text text-sm">
                  <img src="/assets/img/SECO-logo-640px-white.png" alt="SECO logo" class="w-full max-w-md md:max-w-lg h-auto mb-4">
                  <p class="text-gray-400"> Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno zvanični stav Vlade Švajcarske.</p>
              </div>
              <p class="pt-6 text-gray-400">&copy; Lorem ipsum dolor sit amet consectetur adipiscing elit</p>
          </div>
      </div>
  </footer>

</body>
</html>
