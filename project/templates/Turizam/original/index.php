<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KRAGUJEVAC | Gradska Turistička Organizacija</title>

  <!-- Roboto & Roboto Slab only (you can drop Playfair/Inter since you don't use them anymore) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600;700&display=swap"
    rel="stylesheet"
  />

  <!-- 1) CDN FIRST -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- 2) THEN CONFIG -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            /* main CTA buttons – deep logo blue */
            primary: '#0B3F7A',
            primary_hover: '#072A51',

            /* headings / key text – red from ornament row */
            secondary: '#B52B2E',
            secondary_hover: '#8F2023',

            /* accent – sun yellow from top-right */
            accent: '#FFD84A',
            accent_hover: '#F2C335',

            /* text + backgrounds tuned to logo tones */
            primary_text: '#122034',        // dark blue-gray for main text
            secondary_text: '#5E6A7A',      // softer gray-blue for paragraphs
            background: '#FFFFFF',          // clean white base
            secondary_background: '#101725',// very dark blue for footer/overlays
            surface: '#F5F3EE',             // warm light surface (stone-ish)
            muted_surface: '#E3ECF4',       // pale bluish section background

            /* extra highlight – teal from decorative pattern */
            logocolor2: '#008A8A',
          },
          fontFamily: {
            /* big hero title + section titles */
            heading: ['Montserrat', 'Arial', 'Helvetica', 'sans-serif'],

            /* subheadings, card titles */
            heading2: ['Montserrat', 'Arial', 'Helvetica', 'sans-serif'],

            /* body text, buttons, nav */
            body: ['Open Sans', 'Arial', 'Helvetica', 'sans-serif'],
          },
        }
      }
    }
  </script>



  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

    /* Only basic layout now – no pseudo-elements */
.section-heading {
  /* font, color, size handled by Tailwind classes */
  text-align: center;
  position: relative;
  display: inline-block;
  padding-bottom: 0;   /* no extra space for old circle */
}

/* Completely disable old underline + circle badge everywhere */
.section-heading::before,
.section-heading::after {
  content: none !important;
}

    /* horizontal partners scroller – hide scrollbar */
    .scrollbar-hide {
      -ms-overflow-style: none; /* IE and Edge */
      scrollbar-width: none;    /* Firefox */
    }
    .scrollbar-hide::-webkit-scrollbar {
      display: none;            /* Chrome, Safari, Opera */
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
          <h2 class="text-xl text-primary_text font-heading2">Menu</h2>
          <button id="closeMobileMenu" class="text-primary_text transition-colors">
            <i class="fas fa-times text-xl"></i>
          </button>
        </div>

        <nav id="navBarIDm" class="space-y-4">
          <a href="/" class="flex items-center py-3 px-4 rounded-lg transition-all font-body">
            <i class="fas fa-home mr-3 text-primary"></i>Početna
          </a>

          <div class="mobile-dropdown">
            <button class="flex items-center justify-between w-full py-3 px-4 rounded-lg transition-all" id="mobileAboutToggle">
              <div class="flex items-center font-body"><i class="fas fa-info-circle mr-3 text-primary"></i>O nama</div>
              <i class="fas fa-chevron-down  transition-transform duration-200" id="mobileAboutIcon"></i>
            </button>
            <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
              <a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                            </a>
              <!--<a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-users-cog mr-2 text-primary"></i>Rukovodstvo</a>-->
              <a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-flag mr-2 text-primary"></i>Misija</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-history mr-2 text-primary"></i>Istorijat</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fa-question mr-2 text-primary"></i>Pitanja</a>
              <a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-bullhorn mr-2 text-primary"></i>Informacije</a>
              <!--<a href="#" class="flex items-center py-2 px-4 transition-colors font-body"><i class="fas fa-users mr-2 text-primary"></i>Timovi</a>-->
            </div>
          </div>

          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-map-marker-alt mr-3 text-primary"></i>Destinacije</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-bed mr-3 text-primary"></i>Smeštaj</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-person-hiking mr-3 text-primary"></i>Manifestacije</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-utensils mr-3 text-primary"></i>Gastronomija</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-pepper-hot mr-3 text-primary"></i>Brendovi</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all font-body"><i class="fas fa-file-alt mr-3 text-primary"></i>Dokumenti</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-address-book mr-3 text-primary"></i>Kontakt</a>
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i class="fas fa-calendar-alt mr-2 text-primary"></i>Vesti</a>
          <!--<a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all font-body"><i  class="fas fa-diagram-project mr-2 text-primary"></i>Događaji</a>-->
          <a href="#" class="flex items-center py-3 px-4 rounded-lg transition-all hover:bg-gray-50 font-body"><i  class="fas fa-images mr-2 text-primary"></i>Multimedija</a>
        </nav>
      </div>
    </div>
  </div>

  <!-- Font size button -->
  <button id="increaseFontBtn" class="fixed bottom-6 right-6 z-40 bg-primary hover:bg-primary_hover text-white py-3 px-5 rounded-full shadow-lg transition font-heading2" aria-label="Povećaj font">A+</button>

  <!-- ===== Sticky Header ===== -->
  <header id="navbar" class="fixed w-full z-30 transition-all duration-300 py-3 bg-background/95 backdrop-blur-md">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="/" class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
          <img src="/assets/img/LOGO.png" alt="" style="width:75px;height:auto;" />
        </div>
        <div class="hidden sm:block">
          <div class="text-xl font-bold text-primary_text font-heading2">OPŠTINA BABUŠNICA</div>
          <div class="text-xs text-secondary_text font-body">Turistička Organizacija</div>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-6 text-secondary_text">
        <div class="dropdown relative group transition-colors">
          <button class="px-3 py-2 nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">
            <span class="hidden xl:inline flex items-center font-heading2">O nama</span>
            <i class="fas fa-chevron-down ml-1 text-xs"></i>
          </button>
          <div class="dropdown-menu absolute top-full left-0 w-48 bg-background rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Organizaciona struktura</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Organi upravljanja</a>
            <!--<a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Rukovodstvo</a>-->
            <a href="#" static="true" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Misija</a>
            <a href="#" static="true" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Istorijat</a>
            <!--<a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Timovi</a>-->
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Pitanja</a>
            <a href="#" class="dropdown-item flex items-center px-4 py-2 transition-colors rounded-md text-sm font-body">Informacije</a>
          </div>
        </div>

        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Destinacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Smeštaj</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Manifestacije</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Gastronomija</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Brendovi</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Multimedija</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Vesti</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Kontakt</a>
        <a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Dokumenti</a>
        <!--<a href="#" class="nav-link transition-colors flex items-center whitespace-nowrap px-1 font-heading2">Događaji</a>-->

        <!-- Language dropdown -->
        <?php
          if (isset($_GET['locale'])) { $_SESSION['locale'] = $_GET['locale']; }
          $locale = $_SESSION['locale'] ?? 'sr';
          $languages = [
            'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
            'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
          ];
          if (!isset($languages[$locale])) { $locale = 'sr'; }
        ?>
        <div class="dropdown nonPage relative group ">
          <button class="nav-link text-secondary_text font-semibold hover:text-accent transition-all duration-200 flex items-center px-3 py-2 rounded-lg group font-heading2">
            <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
            <span class="hidden xl:inline text-sm font-medium font-body"><?= $languages[$locale]['label'] ?></span>
            <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
          </button>
          <div class="dropdown-menu absolute top-full right-0 min-w-max bg-surface rounded-xl shadow-2xl border border-gray-100 z-50 py-2 backdrop-blur-sm">
            <?php foreach ($languages as $key => $lang): ?>
              <a href="?locale=<?= $key ?>" class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1 font-body">
                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                <span class="font-medium font-body"><?= $lang['label'] ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </nav>

      <!-- Right: Search button & Hamburger -->
      <div class="flex items-center space-x-2 sm:space-x-4">
        <div class="relative">
          <button id="searchButton" class="text-secondary_text hover:text-primary_text p-2 font-body" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
          <div id="searchInputContainer" class="absolute right-0 top-full mt-2 opacity-0 hidden z-50 min-w-[300px] bg-surface rounded-md shadow-lg border border-gray-200 overflow-hidden">
            <form id="searchForm" class="flex items-center w-full p-2" action="/pretraga" method="GET">
              <input id="searchInput" type="text" name="q" placeholder="Pretražite destinacije, smeštaj, manifestacije…" class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-2 placeholder-gray-400 font-body" required />
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

<script>
  (function () {
    const scroller = document.getElementById('partnersScroller');
    const prev = document.getElementById('partnersPrev');
    const next = document.getElementById('partnersNext');
    if (!scroller || !prev || !next) return;

    const step = 260; // how much to move per click (px)

    prev.addEventListener('click', () => {
      scroller.scrollBy({ left: -step, behavior: 'smooth' });
    });

    next.addEventListener('click', () => {
      scroller.scrollBy({ left: step, behavior: 'smooth' });
    });
  })();
</script>

<!-- ===== HERO: Fiksirana pozadinska slika + naslov + pretraga ===== -->
<!-- ===== HERO: CAROUSEL ===== -->
<section
  id="heroCarousel"
  class="relative pt-20 min-h-[80vh] lg:min-h-[92vh] overflow-hidden bg-black"
>
  <div class="absolute inset-0">
    <!-- === SLIDE 1 === -->
    <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-out">
      <img
        src="assets/img/hero/panorama.jpg"
        alt="PANORAMA PIROTA"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/20 to-black/60"></div>

      <div class="relative z-10 h-full">
        <div class="container mx-auto h-full px-4 flex items-center">
          <!-- text on RIGHT -->
          <div
            class="hero-slide-content max-w-xl ml-auto text-right text-white opacity-0 transition-all duration-700 ease-out"
            data-enter-class="translate-x-8 md:translate-x-16"
          >
            <p class="font-body tracking-[0.35em] uppercase text-xs md:text-sm text-white/70 mb-3">
              Pirot
            </p>
            <h2 class="font-heading text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight">
              <span class="font-bold">PANORAMA</span> PIROTA
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- === SLIDE 2 === -->
    <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-out">
      <img
        src="/assets/img/hero/kej.webp"
        alt="PIROTSKI KEJ"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/10 to-black/60"></div>

      <div class="relative z-10 h-full">
        <div class="container mx-auto h-full px-4 flex items-center">
          <!-- text on LEFT -->
          <div
            class="hero-slide-content max-w-xl mr-auto text-left text-white opacity-0 transition-all duration-700 ease-out"
            data-enter-class="-translate-x-8 md:-translate-x-16"
          >
            <p class="font-body tracking-[0.35em] uppercase text-xs md:text-sm text-white/70 mb-3">
              KEJ
            </p>
            <h2 class="font-heading text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight">
              PIROTSKI <span class="font-bold">KEJ</span>
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- === SLIDE 3 === -->
    <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-out">
      <img
        src="/assets/img/hero/stara.webp"
        alt="STARA PLANINA"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/15 to-black/70"></div>

      <div class="relative z-10 h-full">
        <div class="container mx-auto h-full px-4 flex items-center">
          <!-- text on RIGHT -->
          <div
            class="hero-slide-content max-w-xl ml-auto text-right text-white opacity-0 transition-all duration-700 ease-out"
            data-enter-class="translate-x-8 md:translate-x-16"
          >
            <p class="font-body tracking-[0.35em] uppercase text-xs md:text-sm text-white/70 mb-3">
              Pirot
            </p>
            <h2 class="font-heading text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight">
              <span class="font-bold">STARA PLANINA</span>
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- === SLIDE 4 === -->
    <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-out">
      <img
        src="assets/img/hero/centar.jpg"
        alt="CENTAR GRADA"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-b from-black/45 via-black/15 to-black/70"></div>

      <div class="relative z-10 h-full">
        <div class="container mx-auto h-full px-4 flex items-center">
          <!-- text on LEFT -->
          <div
            class="hero-slide-content max-w-xl mr-auto text-left text-white opacity-0 transition-all duration-700 ease-out"
            data-enter-class="-translate-x-8 md:-translate-x-16"
          >
            <p class="font-body tracking-[0.35em] uppercase text-xs md:text-sm text-white/70 mb-3">
              CENTAR GRADA
            </p>
            <h2 class="font-heading text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight">
              CENTAR
              <span class="font-bold">GRADA</span>
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- === SLIDE 5 === -->
    <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-out">
      <img
        src="/assets/img/hero/zavojsko.jpg"
        alt="Zavojsko jezero"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/20 to-black/70"></div>

      <div class="relative z-10 h-full">
        <div class="container mx-auto h-full px-4 flex items-center">
          <!-- text on RIGHT -->
          <div
            class="hero-slide-content max-w-xl ml-auto text-right text-white opacity-0 transition-all duration-700 ease-out"
            data-enter-class="translate-x-8 md:translate-x-16"
          >
            <p class="font-body tracking-[0.35em] uppercase text-xs md:text-sm text-white/70 mb-3">
              Zavojsko jezero
            </p>
            <h2 class="font-heading text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight">
              <span class="font-bold">ZAVOJSKO JEZERO</span>
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- DOTS / NAVIGATION -->
  <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-3">
    <button class="hero-dot h-2 rounded-full bg-white/40 transition-all duration-300"></button>
    <button class="hero-dot h-2 rounded-full bg-white/40 transition-all duration-300"></button>
    <button class="hero-dot h-2 rounded-full bg-white/40 transition-all duration-300"></button>
    <button class="hero-dot h-2 rounded-full bg-white/40 transition-all duration-300"></button>
    <button class="hero-dot h-2 rounded-full bg-white/40 transition-all duration-300"></button>
  </div>
</section>

<script>
  (function () {
    const carousel = document.getElementById('heroCarousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.hero-slide');
    const dots = carousel.querySelectorAll('.hero-dot');
    if (!slides.length) return;

    let current = 0;
    const delay = 7000; // ms between slides
    let timer;

    // Prepare text elements (start off-screen + invisible)
    slides.forEach(slide => {
      const content = slide.querySelector('.hero-slide-content');
      if (!content) return;
      const enterClasses = (content.dataset.enterClass || '').split(' ').filter(Boolean);
      content.classList.add(...enterClasses, 'opacity-0');
    });

    function setActive(index) {
      slides.forEach((slide, i) => {
        const content = slide.querySelector('.hero-slide-content');
        const enterClasses = (content?.dataset.enterClass || '').split(' ').filter(Boolean);

        if (i === index) {
          // show slide
          slide.classList.add('opacity-100', 'z-10');
          slide.classList.remove('opacity-0', 'z-0');

          if (content) {
            // text "lands" – remove offset + fade in
            content.classList.remove('opacity-0', ...enterClasses);
          }
        } else {
          // hide slide
          slide.classList.add('opacity-0', 'z-0');
          slide.classList.remove('opacity-100', 'z-10');

          if (content) {
            // reset text back off-screen for next time
            content.classList.add('opacity-0', ...enterClasses);
          }
        }
      });

      // dots
      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add('bg-white', 'w-8');
          dot.classList.remove('bg-white/40', 'w-3');
        } else {
          dot.classList.add('bg-white/40', 'w-3');
          dot.classList.remove('bg-white', 'w-8');
        }
      });

      current = index;
    }

    function next() {
      const nextIndex = (current + 1) % slides.length;
      setActive(nextIndex);
    }

    function startTimer() {
      stopTimer();
      timer = setInterval(next, delay);
    }

    function stopTimer() {
      if (timer) clearInterval(timer);
    }

    // dots click
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        setActive(index);
        startTimer();
      });
    });

    // pause on hover
    carousel.addEventListener('mouseenter', stopTimer);
    carousel.addEventListener('mouseleave', startTimer);

    // init
    setActive(0);
    startTimer();
  })();
</script>

<!-- ===== WELCOMING / UVODNI TEKST ===== -->
<section class="section-intro py-14 md:py-20 bg-surface">
  <div class="container mx-auto px-4 max-w-6xl">

    <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
      <!-- LEFT: IMAGE -->
      <div class="order-2 md:order-1">
        <img
          src="/assets/img/welcome.jpg"
          alt="Doživite Pirot i njegovu okolinu"
          class="w-full h-full max-h-[480px] object-cover rounded-3xl shadow-2xl border border-gray-100"
        />
      </div>

      <!-- RIGHT: TEXT -->
      <div class="order-1 md:order-2 text-center">
        <!-- Main heading (line + icon are handled by .section-heading CSS) -->
        <h2
          class="section-heading font-heading font-bold text-3xl md:text-4xl lg:text-5xl text-primary_text tracking-[0.35em] uppercase"
        >
          DOBRODOŠLI
        </h2>

        <!-- line – title-icon – line -->
        <div class="mt-6 flex items-center justify-center gap-4">
          <span class="h-px w-16 md:w-24 bg-secondary_text"></span>

          <!-- center icon; change src to your real icon if needed -->
          <img
            src="/assets/img/title-icon.png"
            alt=""
            class="h-4 w-auto"
          />

          <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
        </div>

        <!-- Subheading -->
        <p class="mt-6 font-heading2 text-2xl md:text-3xl text-primary_text">
          Doživite Pirot i njegovu okolinu
        </p>

        <!-- Body text -->
        <p
          class="mt-6 text-secondary_text leading-relaxed text-lg md:text-xl max-w-xl mx-auto font-heading2"
        >
          Upoznajte ovo područje, netaknutu prirodu, dođite i vidite Staru planinu, njenu nesvakidašnju lepotu, moć i čari
          koje krije u isprepletanim prirodnim i antropogenim motivima, koji karakterišu svako njeno područje i selo na sebi
          svojstven način. Ovde ne postoji prirodna monotonija, osetite adrenalin, snagu i divljinu planina koje okružuju ovaj kraj,
          nesvakidašnjicu i osećaj koji vam pruža boravak na ovom neotkrivenom području. Veliki broj kristalno čistih izvora,
          reka, jedno od najvećih prirodno-veštačkih jezera – Zavojsko jezero, dužine…
        </p>

        <!-- Button -->
        <div class="mt-10 flex justify-center">
          <a href="/destinacije"
             class="bg-primary hover:bg-primary_hover text-white px-10 py-4 rounded-full font-heading2 font-semibold shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
            Najpopularnije Destinacije...
          </a>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== VESTI (full-width rows) ===== -->
<section id="vesti" class="py-20 bg-background">
  <div class="container mx-auto px-4 relative z-10">
    <div class="text-center mb-16">
      <h2 class="section-heading font-heading text-3xl md:text-4xl lg:text-5xl text-primary_text">
        NAJNOVIJE&nbsp;<span class="font-bold">VESTI I DEŠAVANJA</span>
      </h2>
      <!-- line – title-icon – line -->
      <div class="mt-6 flex items-center justify-center gap-4">
        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>

        <!-- center icon; change src to your real icon if needed -->
        <img
          src="/assets/img/title-icon.png"
          alt=""
          class="h-4 w-auto"
        />

        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
      </div>
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
                <div class="flex items-center text-sm text-secondary_text font-body">
                  <i class="fas fa-calendar-alt mr-2"></i>
                  <span id="g-datum" class="font-body">15. oktobar 2025</span>
                </div>
              </div>

              <h3 id="g-naslov"
                  class="text-xl md:text-2xl font-heading font-bold text-primary_text mb-3 group-hover:text-accent transition-colors line-clamp-2">
                Novi sadržaji i ponuda za turiste u Babušnici
              </h3>

              <p id="g-opis" class="text-secondary_text mb-5 line-clamp-3 leading-relaxed font-body">
                Pratite aktuelne informacije o manifestacijama, kulturnim događajima, konkursima i turističkoj ponudi
                Lužničkog kraja.
              </p>
            </div>

            <div>
              <a id="g-ovise" href="#"
                 class="inline-flex items-center text-accent font-semibold hover:gap-3 gap-2 transition-all group/link font-body">
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
              class="bg-gradient-to-r from-primary via-primary_hover to-primary text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center mx-auto group shadow-xl font-heading2">
        <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform"></i>
        Pogledaj sve vesti
        <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
      </button>
    </div>
  </div>
</section>

<!-- ===== DESTINACIJE – NAJPOPULARNIJE ===== -->
<section id="destinacije" class="py-20 bg-background">
  <div class="container mx-auto px-4 relative z-10">
    <div class="text-center mb-16">
      <h2 class="section-heading font-heading text-3xl md:text-4xl lg:text-5xl text-primary_text">
        POGLEDAJTE NAJPOPULARNIJE&nbsp;<span class="font-bold">DESTINACIJE</span>
      </h2>
      <!-- line – title-icon – line -->
      <div class="mt-6 flex items-center justify-center gap-4">
        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>

        <!-- center icon; change src to your real icon if needed -->
        <img
          src="/assets/img/title-icon.png"
          alt=""
          class="h-4 w-auto"
        />

        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
      </div>
      <p class="text-lg md:text-xl max-w-3xl mx-auto text-secondary_text mt-4 font-body">
        Svi vole da putuju, ali ne vole svi da putuju na isti način. Pirotski okrug može da ponudi za svakog po nešto.
Veliki izbor turističkih destinacija garantuje sjajan provod i želju za što dužim boravkom.
      </p>
    </div>

    <div id="destinacijeCards" class="grid gap-8 sm:grid-cols-2 xl:grid-cols-4">
      <!-- Destination Card 1 -->
      <div class="group dest-card bg-surface">
        <div class="relative h-80 overflow-hidden clip-diagonal">
          <img
            id = "g-slika"
            src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop"
            alt="Tradicionalni izlet Šanac"
            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
          <div class="dest-card-gradient"></div>
        </div>
        <div class="dest-card-footer">
          <div id="g-naziv" class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3 font-heading2">
            Izlet
          </div>
          <h3 id="g-naziv_destinacije" class="text-2xl font-heading font-bold mb-1">
            Tradicionalni izlet – Šanac
          </h3>
          <p id="g-kratak_opis" class="text-sm text-gray-100 mb-4 font-body">
            Mesto okupljanja, druženja i uživanja u prirodi nadomak Babušnice.
          </p>
          <a id="g-ovise" href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition font-body">
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
            alt="Kanjon Skokovi"
            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
          <div class="dest-card-gradient"></div>
        </div>
        <div class="dest-card-footer">
          <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3 font-heading2">
            Kanjon
          </div>
          <h3 class="text-2xl font-heading font-bold mb-1">
            Kanjon Skokovi
          </h3>
          <p class="text-sm text-gray-100 mb-4 font-body">
            Divlji krajolik, vodene kaskade i staze za istinske ljubitelje avanture.
          </p>
          <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition font-body">
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
            alt="Komarički vir"
            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
          <div class="dest-card-gradient"></div>
        </div>
        <div class="dest-card-footer">
          <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3 font-heading2">
            Priroda
          </div>
          <h3 class="text-2xl font-heading font-bold mb-1">
            Komarički vir
          </h3>
          <p class="text-sm text-gray-100 mb-4 font-body">
            Bistra reka, stene i zelenilo – idealno mesto za beg od gradske vreve.
          </p>
          <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition font-body">
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
            alt="Vidikovci Lužnice"
            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
          <div class="dest-card-gradient"></div>
        </div>
        <div class="dest-card-footer">
          <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase dest-card-badge mb-3 font-heading2">
            Vidikovac
          </div>
          <h3 class="text-2xl font-heading font-bold mb-1">
            Vidikovci Lužnice
          </h3>
          <p class="text-sm text-gray-100 mb-4 font-body">
            Pogledi na dolinu, planinske vrhove i selo koje živi u ritmu prirode.
          </p>
          <a href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition font-body">
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

<!-- ===== OPŠTI PODACI O LUŽNIČKOM KRAJU ===== -->
<section id="opsti-podaci" class="py-20 bg-secondary_background text-white relative">
  <div class="container mx-auto px-4 relative z-10">
    <div class="text-center mb-12">
      <h2 class="section-heading font-heading text-3xl md:text-4xl lg:text-5xl">
        OPŠTI&nbsp;<span class="font-bold">PODACI</span>&nbsp;O PIROTSKOM KRAJU
      </h2>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-people-group text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">38.785</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Broj stanovnika grada Pirota
        </p>
      </div>

      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-users text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">57.928</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Broj stanovnika Pirota sa selima
        </p>
      </div>

      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-map-marked-alt text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">1232 km²</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Površina grada Pirota
        </p>
      </div>

      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-envelope text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">18300</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Poštanski broj
        </p>
      </div>

      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-phone text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">+381 10</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Pozivni broj
        </p>
      </div>

      <div class="bg-black/40 border border-white/10 rounded-xl p-6 flex flex-col items-center text-center">
        <i class="fas fa-arrows-alt-v text-3xl mb-3"></i>
        <p class="text-2xl font-heading font-bold">367 m</p>
        <p class="text-xs uppercase tracking-[0.18em] mt-1 font-heading2">
          Nadmorska visina
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ===== BRENDOVI LUŽNICE ===== -->
<section id="brendovi" class="py-20 bg-background">
  <div class="container mx-auto px-4 relative z-10">
    <div class="text-center mb-12">
      <h2 class="section-heading font-heading font-bold text-3xl md:text-4xl lg:text-5xl text-primary_text">
        BRENDOVI PIROTA
      </h2>
      <!-- line – title-icon – line -->
      <div class="mt-6 flex items-center justify-center gap-4">
        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>

        <!-- center icon; change src to your real icon if needed -->
        <img
          src="/assets/img/title-icon.png"
          alt=""
          class="h-4 w-auto"
        />

        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
      </div>
      <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6 font-body">
        Izuzetno veliko bogatstvo materijalne i duhovne kulture čine ovaj kraj neiscrpnim i nedovoljno iskorišćenom mogućnošću za svestrano širenje turističke ponude uz kombinovanje sa drugim elementima...
      </p>
    </div>

    <div id="brendoviCards" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
      <!-- Vurda -->
      <article class="bg-surface rounded-2xl shadow-md overflow-hidden flex flex-col">
        <img
          id="g-slika"
          src="/assets/img/brendovi/vurda.jpg"
          alt="Vurda"
          class="w-full h-52 object-cover">
        <div class="p-6 flex flex-col flex-1">
          <div id="g-tip_brenda" class="text-xs uppercase tracking-[0.18em] text-secondary_text mb-2 font-heading2">
            Gastronomski proizvod
          </div>
          <h3 id="g-naziv_brenda" class="font-heading text-xl font-bold mb-1 text-primary_text">
            Vurda
          </h3>
          <p id="g-mesto_porekla" class="text-xs text-secondary_text mb-2 font-body">
            Babušnica, Lužnica
          </p>
          <p id="g-opis" class="font-body text-secondary_text text-sm mb-4 line-clamp-3">
            Autentični lužnički mlečni specijalitet čija se receptura vekovima prenosi sa kolena na koleno.
          </p>
          <a id="g-ovise" href="#" class="inline-flex items-center text-accent font-medium hover:text-accent_hover transition font-body">
            Saznajte više
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </article>

      <!-- Rakija -->
      <article class="bg-surface rounded-2xl shadow-md overflow-hidden flex flex-col">
        <img
          id="g-slika"
          src="/assets/img/brendovi/rakija.jpg"
          alt="Rakija"
          class="w-full h-52 object-cover">
        <div class="p-6 flex flex-col flex-1">
          <div id="g-tip_brenda" class="text-xs uppercase tracking-[0.18em] text-secondary_text mb-2 font-heading2">
            Piće
          </div>
          <h3 id="g-naziv_brenda" class="font-heading text-xl font-bold mb-1 text-primary_text">
            Rakija
          </h3>
          <p id="g-mesto_porekla" class="text-xs text-secondary_text mb-2 font-body">
            Lužnički kraj
          </p>
          <p id="g-opis" class="font-body text-secondary_text text-sm mb-4">
            Simbol lužničkog kraja – domaća rakija uz dobro društvo i priče iz kraja.
          </p>
          <a id="g-ovise" href="#"
             class="mt-auto inline-flex items-center text-accent font-semibold hover:text-accent_hover font-body text-sm">
            Saznajte više
            <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <!-- Banica -->
      <article class="bg-surface rounded-2xl shadow-md overflow-hidden flex flex-col">
        <img
          id="g-slika"
          src="/assets/img/brendovi/banica.jpg"
          alt="Banica"
          class="w-full h-52 object-cover">
        <div class="p-6 flex flex-col flex-1">
          <div id="g-tip_brenda" class="text-xs uppercase tracking-[0.18em] text-secondary_text mb-2 font-heading2">
            Gastronomski proizvod
          </div>
          <h3 id="g-naziv_brenda" class="font-heading text-xl font-bold mb-1 text-primary_text">
            Banica
          </h3>
          <p id="g-mesto_porekla" class="text-xs text-secondary_text mb-2 font-body">
            Lužnica
          </p>
          <p id="g-opis" class="font-body text-secondary_text text-sm mb-4">
            Lužnička suvana banica – tradicionalna pita koja se ne propušta ni na jednoj trpezi.
          </p>
          <a id="g-ovise" href="#"
             class="mt-auto inline-flex items-center text-accent font-semibold hover:text-accent_hover font-body text-sm">
            Saznajte više
            <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <!-- Punjena paprika -->
      <article class="bg-surface rounded-2xl shadow-md overflow-hidden flex flex-col">
        <img
          id="g-slika"
          src="/assets/img/brendovi/punjena-paprika.jpg"
          alt="Punjena paprika"
          class="w-full h-52 object-cover">
        <div class="p-6 flex flex-col flex-1">
          <div id="g-tip_brenda" class="text-xs uppercase tracking-[0.18em] text-secondary_text mb-2 font-heading2">
            Gastronomski proizvod
          </div>
          <h3 id="g-naziv_brenda" class="font-heading text-xl font-bold mb-1 text-primary_text">
            Punjena paprika
          </h3>
          <p id="g-mesto_porekla" class="text-xs text-secondary_text mb-2 font-body">
            Babušnica i okolina
          </p>
          <p id="g-opis" class="font-body text-secondary_text text-sm mb-4 line-clamp-3">
            Omiljeno jelo Lužničana – bilo da je mrsna ili posna varijanta, uvek ide uz dobro društvo.
          </p>
          <a id="g-ovise" href="#"
             class="mt-auto inline-flex items-center text-accent font-semibold hover:text-accent_hover font-body text-sm">
            Saznajte više
            <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ===== PARTNERI / LOGO TRAKA ===== -->
<section id="partneri" class="py-16 bg-background">
  <div class="container mx-auto px-4">
    <!-- Heading -->
    <div class="text-center mb-10">
      <h2 class="section-heading font-heading text-3xl md:text-4xl lg:text-5xl text-primary_text">
        NAŠI&nbsp<span class="font-bold">PARTNERI</span>
      </h2>

      <!-- line – title-icon – line -->
      <div class="mt-4 flex items-center justify-center gap-4">
        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
        <img
          src="/assets/img/title-icon.png"
          alt=""
          class="h-4 w-auto"
        />
        <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
      </div>
    </div>

    <!-- Carousel -->
    <div class="relative">
      <!-- Left arrow -->
      <button
        id="partnersPrev"
        class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 z-20 w-8 h-8 items-center justify-center rounded-full border border-gray-300 text-gray-400 bg-white/80 hover:bg-white hover:text-primary hover:border-primary transition"
        aria-label="Prethodni partneri"
      >
        <i class="fas fa-chevron-left text-sm"></i>
      </button>

      <!-- Right arrow -->
      <button
        id="partnersNext"
        class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 z-20 w-8 h-8 items-center justify-center rounded-full border border-gray-300 text-gray-400 bg-white/80 hover:bg-white hover:text-primary hover:border-primary transition"
        aria-label="Sledeći partneri"
      >
        <i class="fas fa-chevron-right text-sm"></i>
      </button>

      <!-- Scroll area -->
      <div
        id="partnersScroller"
        class="scrollbar-hide overflow-x-auto px-8 md:px-12"
      >
        <div
          id="partnersTrack"
          class="partners-strip flex items-center gap-16 py-4 justify-start"
        >
          <!-- 13 placeholders: replace href/src with real links + logos -->
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-01.png" alt="Partner 1" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-02.png" alt="Partner 2" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-03.png" alt="Partner 3" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-04.png" alt="Partner 4" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-05.png" alt="Partner 5" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-06.png" alt="Partner 6" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-07.png" alt="Partner 7" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-08.png" alt="Partner 8" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-09.png" alt="Partner 9" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-10.png" alt="Partner 10" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-11.png" alt="Partner 11" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-12.png" alt="Partner 12" class="h-12 md:h-14 w-auto" />
          </a>
          <a href="#" target="_blank" rel="noopener">
            <img src="/assets/img/partneri/partner-13.png" alt="Partner 13" class="h-12 md:h-14 w-auto" />
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- ===== Footer ===== -->
<footer class="bg-secondary_background text-secondary_text text-gray-200 font-heading2 pt-20 pb-10">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
      <!-- Kolona 1: naziv + mreže -->
      <div>
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 bg-logocolor2 rounded-lg flex items-center justify-center text-background mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-logocolor2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <h3 class="text-xl font-heading text-gray-100">
            Turistička organizacija opštine Babušnica
          </h3>
        </div>
        <p class="mb-4 font-body">
          Zvanična turistička organizacija opštine Babušnica i Lužničkog kraja.
        </p>
        <div class="flex space-x-3">
          <a href="https://www.facebook.com/turistickaorganizacija.babusnica" target="_blank" rel="noopener"
             class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/to_babusnica/" target="_blank" rel="noopener"
             class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.youtube.com/@TuristickaorganizacijaBabusnica" target="_blank" rel="noopener"
             class="w-10 h-10 rounded-full bg-logocolor2/70 hover:bg-logocolor2 flex items-center justify-center text-background transition-colors">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>

      <!-- Kolona 2: brzi linkovi -->
      <div>
        <h4 class="mb-6 font-heading">
          Brzi linkovi
        </h4>
        <ul class="space-y-3">
          <li><a href="/" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Početna</a></li>
          <li><a href="/o-nama/informacije" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Informacije od javnog značaja</a></li>
          <li><a href="/o-nama/pitanja" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Česta pitanja</a></li>
          <li><a href="/dokumenti" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Dokumenti</a></li>
          <li><a href="/kontakt" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Kontakt</a></li>
          <li><a href="/vesti" class="text-logocolor2/90 hover:text-primary_text transition-colors font-body">Vesti</a></li>
        </ul>
      </div>

      <!-- Kolona 3: kontakt informacije -->
      <div>
        <h4 class="mb-6 font-heading">
          Informacije
        </h4>

        <div class="mb-6">
          <p class="font-semibold mb-2 font-heading2">
            Turistička organizacija opštine Babušnica
          </p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="fas fa-phone text-logocolor2 mt-1 mr-3"></i>
              <span class="font-body">010/383-161</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-envelope text-logocolor2 mt-1 mr-3"></i>
              <a href="mailto:turizambabusnica@gmail.com"
                 data-translate="off"
                 class="font-body hover:underline">
                turizambabusnica@gmail.com
              </a>
            </li>
            <li class="flex items-start">
              <i class="fas fa-globe text-logocolor2 mt-1 mr-3"></i>
              <a href="https://www.tobabusnica.com/" target="_blank" rel="noopener"
                 data-translate="off"
                 class="font-body hover:underline">
                www.tobabusnica.com
              </a>
            </li>
            <li class="flex items-start">
              <i class="fas fa-map-marker-alt text-logocolor2 mt-1 mr-3"></i>
              <span class="font-body">
                ul. Stevana Sindelića bb, 18330 Babušnica
              </span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Kolona 4: mapa lokacije -->
      <div>
        <h4 class="mb-6 font-heading">
          Mapa lokacije
        </h4>

        <div class="mb-6">
          <p class="font-semibold mb-2 font-heading2">
            Turistička organizacija opštine Babušnica
          </p>
          <div class="rounded-xl overflow-hidden aspect-w-16 aspect-h-9">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3484.0437752145644!2d22.406929!3d43.067608!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475514de93821a7b%3A0xa7238b91a9a3d97!2z0JrRg9C_0LDQu9C40YjQvdC4INC60L7QvNC_0LvQtdC60YEg0YMg0JHQsNCx0YPRiNC90LjRhtC4!5e1!3m2!1ssr!2srs!4v1763924539880!5m2!1ssr!2srs"
              width="320"
              height="200"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Donji deo footera ostaje isti -->
    <div class="text-center text-sm">
      <div class="flex flex-col items-center border-t border-secondary_text pt-8 text-center text-secondary_text text-sm">
        <img src="/assets/img/SECO-logo-640px-white.png" alt="SECO logo" class="w-full max-w-md md:max-w-lg h-auto mb-4">
        <p class="text-gray-400">
          Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno zvanični stav Vlade Švajcarske.
        </p>
      </div>
      <p class="pt-6 text-gray-400">&copy; RELOF3 PROJEKAT</p>
    </div>
  </div>
</footer>


</body>
</html>
