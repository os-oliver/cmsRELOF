<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omladinski Centar | Aktivnosti za mlade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B6B',
                        primary_hover: '#ea580c',
                        secondary: '#4ECDC4',
                        secondary_hover: '#fdba74',
                        accent: '#FFD166',
                        accent_hover: '#fbbf24',
                        primary_text: '#332a21',
                        secondary_text: '#7c5e3d',
                        dark: '#1A535C',
                        light: '#F7FFF7'
                    }
                }
            }
        }
    </script>
    <style>
        * {
            color: black;
        }

        .instagram-feed {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 8px;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            background-color: rgba(255, 214, 102, 0.1);
        }

        .program-card:hover .program-icon {
            transform: scale(1.1);
        }

        .stat-card:hover {
            background-color: rgba(122, 197, 205, 0.1);
        }
    </style>
</head>

<body class="bg-light font-sans text-dark">

    <!-- Enhanced Header -->
    <div id="mobileMenu" class="fixed inset-0 z-40  hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary_background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-primary_text font-heading font-bold">Menu</h2>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>

                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-secondary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-flag mr-2 text-secondary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-history mr-2 text-accent"></i>Istorijat
                            </a>
                            <a data-page="Rukovodstvo" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-users-cog mr-2 text-secondary"></i>Rukovodstvo
                            </a>
                            <a data-page="OrganizacionaStruktura" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-sitemap mr-2 text-secondary"></i>Organizaciona struktura
                            </a>

                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                            </a>
                            <a data-page="Donacije i podrška" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-accent"></i>Donacije i podrška
                            </a>
                            <a data-page="Partneri" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-handshake mr-2 text-primary"></i>Partneri
                            </a>
                        </div>
                    </div>

                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-accent"></i>Dokumenti
                    </a>

                    <a data-page="Vesti" href="#"
                        class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-newspaper mr-2 text-primary"></i>Vesti
                    </a>

                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-secondary"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 bg-slate-950 border-b border-slate-800 backdrop-blur-xl border-b border-slate-800 shadow-[0_0_40px_rgba(56,189,248,0.4)]">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3 md:py-4">
            <!-- LOGO + TITLE -->
            <div class="flex items-center">
                <div
                    class="w-11 h-11 md:w-12 md:h-12 rounded-2xl bg-gradient-to-tr from-sky-500 via-fuchsia-500 to-amber-400 flex items-center justify-center mr-3 shadow-lg shadow-sky-500/40">
                    <i class="fas fa-bolt text-white text-xl md:text-2xl drop-shadow-md"></i>
                </div>
                <div class="flex flex-col leading-tight">
                    <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-slate-50">
                        Omladinski <span
                            class="bg-gradient-to-r from-sky-400 via-fuchsia-400 to-amber-300 bg-clip-text text-transparent">Centar</span>
                    </h1>
                    <span class="text-xs md:text-sm text-slate-400">
                        prostor za ideje, muziku, film i druženje
                    </span>
                </div>
            </div>

            <!-- NAV DESKTOP -->
            <nav id="navBarID" class="hidden md:flex items-center space-x-2 lg:space-x-4">
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Početna
                </a>

                <!-- O NAMA DROPDOWN -->
                <div class="dropdown relative group">
                    <button
                        class="nav-link flex items-center text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 border border-slate-700/60 hover:border-sky-400/70 hover:text-white transition-all duration-200">
                        <span class="hidden xl:inline mr-1 text-white">O nama</span>
                        <i
                            class="fas fa-chevron-down text-[0.6rem] group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>

                    <div
                        class="dropdown-menu absolute top-[115%] left-1/2 -translate-x-1/2 min-w-max max-w-xs w-auto bg-slate-900/95 border border-slate-700 rounded-2xl shadow-[0_0_35px_rgba(129,140,248,0.55)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-3 backdrop-blur-xl">
                        <a href="#" static="true"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(56,189,248,0.6)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-book mr-3 text-sky-400 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Uvod</span>
                        </a>
                        <a href="#" static="true"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(236,72,153,0.7)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-flag mr-3 text-pink-400 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Misija i vizija</span>
                        </a>
                        <a href="#" static="true"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(248,250,252,0.7)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-history mr-3 text-amber-300 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Istorijat</span>
                        </a>
                        <a href="#"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(110,231,183,0.7)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-users-cog mr-3 text-emerald-300 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Rukovodstvo</span>
                        </a>
                        <a href="#"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(59,130,246,0.7)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-sitemap mr-3 text-sky-300 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Organizaciona struktura</span>
                        </a>
                        <a href="#" static="true"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(148,163,184,0.8)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-building mr-3 text-slate-300 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Objekat</span>
                        </a>
                        <a href="#" static="true"
                           class="dropdown-item flex items-center px-5 py-3 text-sm text-slate-100/90 hover:bg-slate-800/80 hover:shadow-[0_0_0_1px_rgba(244,114,182,0.8)] transition-all duration-150 rounded-xl mx-2">
                            <i class="fas fa-hand-holding-heart mr-3 text-rose-300 flex-shrink-0 w-4 text-sm"></i>
                            <span class="font-medium text-white">Donacije i podrška</span>
                        </a>
                    </div>
                </div>

                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Vesti
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Manifestacije
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Koncerti
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Izložbe
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Predstave
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Filmovi
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Galerija
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Dokumenti
                </a>
                <a href="#"
                   class="nav-link text-xs lg:text-sm font-semibold tracking-wide px-4 py-2 rounded-full text-slate-100/80 hover:text-white border border-transparent hover:border-sky-400/70 hover:bg-sky-500/10 transition-all duration-200">
                    Kontakt
                </a>

                <!-- LOCALE DROPDOWN (PHP KOD OSTAO ISTI, SAMO STIL PROMENJEN) -->
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
                <div class="locale dropdown nonPage relative group ml-1">
                    <button
                        class="nav-link flex items-center text-xs font-semibold px-3 py-2 rounded-full bg-slate-900/80 border border-slate-700/70 text-slate-100/90 hover:border-sky-400/80 hover:bg-slate-800/90 transition-all duration-200">
                        <span class="mr-1 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="text-white hidden xl:inline text-[0.75rem] font-medium">
                            <?= $languages[$locale]['label'] ?>
                        </span>
                        <i class="fas fa-chevron-down ml-1 text-[0.55rem] group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-[115%] left-1/2 -translate-x-1/2 min-w-max max-w-xs w-auto bg-slate-900/95 border border-slate-700 rounded-2xl shadow-[0_0_35px_rgba(56,189,248,0.5)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-3 backdrop-blur-xl">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                               class="dropdown-item flex items-center px-4 py-2.5 hover:bg-slate-800/80 text-sm whitespace-nowrap text-slate-100/90 rounded-xl mx-1 transition-all duration-150">
                                <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                <span class="font-medium text-white"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    </header>

    <div class="bg-slate-950 text-slate-50">

        <!-- HERO SECTION -->
        <section id="hero" class="relative overflow-hidden pt-28 pb-20">
            <!-- Gradient blobs in background -->
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -top-24 -left-16 w-72 h-72 bg-sky-500/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-16 right-0 w-80 h-80 bg-fuchsia-500/25 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-4 relative">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- LEFT: TEXT -->
                    <div>
                        <div class="inline-flex items-center px-3 py-1 rounded-full border border-sky-400/60 bg-slate-900/70 text-xs font-semibold tracking-wide text-sky-200 mb-5">
                            <i class="fas fa-bolt mr-2 text-[0.7rem]"></i>
                            Mesto gde se ideje pretvaraju u događaje
                        </div>

                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-4 text-white">
                            Omladinski centar
                            <span class="block bg-gradient-to-r from-sky-400 via-fuchsia-400 to-amber-300 bg-clip-text text-transparent">
                                za muziku, film, igru i druženje
                            </span>
                        </h1>

                        <p class="text-base md:text-lg text-slate-300 max-w-xl mb-8">
                            Koncerti, radionice, filmske večeri, predstave i još mnogo toga – sve na jednom mestu
                            za tinejdžere i mlade koji žele da se povežu, nauče nešto novo i lepo provedu vreme.
                        </p>

                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            <a href="#vesti"
                            class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-sky-500 via-fuchsia-500 to-amber-400 text-sm font-semibold text-slate-950 shadow-lg shadow-sky-500/40 hover:brightness-110 transition-all">
                                <i class="fas fa-calendar-star mr-2"></i>
                                Pogledaj aktuelne događaje
                            </a>
                            <a href="#"
                            class="inline-flex items-center px-6 py-3 rounded-full border border-slate-600 text-sm font-semibold text-slate-100 hover:border-sky-400 hover:bg-slate-900/70 transition-all">
                                <i class="fas fa-user-plus mr-2"></i>
                                Postani volonter
                            </a>
                        </div>

                        <div class="flex flex-wrap gap-3 text-xs md:text-sm text-slate-300">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-900/70 border border-sky-500/50 text-white">
                                <i class="fas fa-music mr-2 text-sky-400"></i>
                                Bendovi & open mic
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-900/70 border border-fuchsia-500/50 text-white">
                                <i class="fas fa-theater-masks mr-2 text-fuchsia-400"></i>
                                Predstave & improv
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-900/70 border border-amber-400/60 text-white">
                                <i class="fas fa-film mr-2 text-amber-300"></i>
                                Filmske večeri
                            </span>
                        </div>
                    </div>

                    <!-- RIGHT: FEATURED CARD / PREVIEW -->
                    <div class="md:justify-self-end">
                        <div class="bg-slate-900/80 border border-slate-700/80 rounded-3xl p-5 md:p-6 shadow-[0_0_40px_rgba(56,189,248,0.5)] max-w-md mx-auto">
                            <div class="text-xs font-semibold uppercase tracking-wide text-sky-300 mb-2">
                                Sledeći događaj
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-slate-50 mb-2">
                                Veče kratkog filma & razgovor sa autorima
                            </h3>
                            <p class="text-sm text-slate-300 mb-4">
                                Pridruži nam se na projekciji kratkih filmova lokalnih autora, uz Q&A sesiju i druženje
                                u chill zoni centra.
                            </p>

                            <div class="space-y-2 mb-4 text-sm">
                                <div class="flex items-center text-slate-200">
                                    <i class="fas fa-calendar-day mr-2 text-sky-400"></i>
                                    Petak, 12. april · 19:00
                                </div>
                                <div class="flex items-center text-slate-200">
                                    <i class="fas fa-location-dot mr-2 text-fuchsia-400"></i>
                                    Velika sala · Omladinski centar
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-800/80 text-xs text-sky-200 border border-sky-500/40">
                                    <i class="fas fa-ticket mr-2 text-sky-400"></i>
                                    Ulaz slobodan
                                </span>
                                <a href="#vesti"
                                class="text-sm font-semibold text-sky-300 hover:text-sky-200 inline-flex items-center gap-2">
                                    Detalji događaja
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- NAJNOVIJE VESTI (NEWS CARDS) -->
        <section id="vesti" class="py-20 relative">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-80 h-80 bg-sky-500/15 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-4 relative">
                <div class="text-center mb-12">
                    <h2 class="inline-block text-3xl md:text-4xl font-extrabold text-slate-50 tracking-tight mb-3 relative">
                        Najnovije vesti
                        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-32 h-[3px] rounded-full bg-gradient-to-r from-sky-400 via-fuchsia-400 to-amber-300"></span>
                    </h2>
                    <p class="text-base md:text-lg text-slate-300 max-w-2xl mx-auto mt-6">
                        Prati šta se dešava u centru – nove radionice, koncerti, izložbe, filmske večeri i svi
                        programi koji ne smeju da se propuste.
                    </p>
                </div>

                <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- News 1 -->
                    <article class="event-card bg-slate-900/80 border border-slate-700/70 rounded-2xl overflow-hidden shadow-lg hover:shadow-[0_0_35px_rgba(56,189,248,0.6)] transition-all duration-200 group">
                        <div class="h-48 relative overflow-hidden">
                            <img id="g-slika" src="https://picsum.photos/600/300" alt="Art Exhibition"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-80"></div>
                            <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-950/80 text-sky-300 border border-sky-400/60">
                                <i class="fas fa-bullhorn mr-2"></i>
                                Novo
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span id="g-kategorije" class="text-xs font-semibold uppercase tracking-wide text-sky-400">
                                    Lorem ipsum
                                </span>
                            </div>
                            <h3 id="g-naslov"
                                class="text-lg md:text-xl font-bold text-slate-50 mb-3 group-hover:text-sky-300 transition-colors">
                                Lorem ipsum dolor sit amet
                            </h3>

                            <p id="g-tekst" class="text-sm text-slate-300 mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio nulla, porttitor vitae
                                suscipit quis, pharetra a dui.
                            </p>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-xs text-slate-400">
                                    <i class="fas fa-calendar-days mr-2 text-sky-400"></i>
                                    <span class="text-white" id="g-datum">28.9.2025.</span>
                                </div>
                                <a id="g-ovise" href="#"
                                class="inline-flex items-center text-sm font-semibold text-sky-300 hover:text-sky-200 gap-2 transition-all group/link">
                                    Pročitaj više
                                    <i class="fas fa-arrow-right text-xs group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- News 2 -->
                    <article class="event-card bg-slate-900/80 border border-slate-700/70 rounded-2xl overflow-hidden shadow-lg hover:shadow-[0_0_35px_rgba(236,72,153,0.6)] transition-all duration-200 group">
                        <div class="h-48 relative overflow-hidden">
                            <img id="g-slika" src="https://picsum.photos/601/300" alt="Event image"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-80"></div>
                            <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-950/80 text-fuchsia-300 border border-fuchsia-400/60">
                                <i class="fas fa-music mr-2"></i>
                                Muzika
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span id="g-kategorije" class="text-xs font-semibold uppercase tracking-wide text-fuchsia-300">
                                    Lorem ipsum
                                </span>
                            </div>
                            <h3 id="g-naslov"
                                class="text-lg md:text-xl font-bold text-slate-50 mb-3 group-hover:text-fuchsia-300 transition-colors">
                                Lorem ipsum dolor sit amet
                            </h3>

                            <p id="g-tekst" class="text-sm text-slate-300 mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio nulla, porttitor vitae
                                suscipit quis, pharetra a dui.
                            </p>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-xs text-slate-400">
                                    <i class="fas fa-calendar-days mr-2 text-fuchsia-400"></i>
                                    <span class="text-white" id="g-datum">28.9.2025.</span>
                                </div>
                                <a id="g-ovise" href="#"
                                class="inline-flex items-center text-sm font-semibold text-fuchsia-300 hover:text-fuchsia-200 gap-2 transition-all group/link">
                                    Pročitaj više
                                    <i class="fas fa-arrow-right text-xs group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- News 3 -->
                    <article class="event-card bg-slate-900/80 border border-slate-700/70 rounded-2xl overflow-hidden shadow-lg hover:shadow-[0_0_35px_rgba(251,191,36,0.6)] transition-all duration-200 group">
                        <div class="h-48 relative overflow-hidden">
                            <img id="g-slika" src="https://picsum.photos/602/300" alt="Event image"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-80"></div>
                            <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-950/80 text-amber-300 border border-amber-400/70">
                                <i class="fas fa-palette mr-2"></i>
                                Izložba
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span id="g-kategorije" class="text-xs font-semibold uppercase tracking-wide text-amber-300">
                                    Lorem ipsum
                                </span>
                            </div>
                            <h3 id="g-naslov"
                                class="text-lg md:text-xl font-bold text-slate-50 mb-3 group-hover:text-amber-300 transition-colors">
                                Lorem ipsum dolor sit amet
                            </h3>

                            <p id="g-tekst" class="text-sm text-slate-300 mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis odio nulla, porttitor vitae
                                suscipit quis, pharetra a dui.
                            </p>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-xs text-slate-400">
                                    <i class="fas fa-calendar-days mr-2 text-amber-300"></i>
                                    <span class="text-white" id="g-datum">28.9.2025.</span>
                                </div>
                                <a id="g-ovise" href="#"
                                class="inline-flex items-center text-sm font-semibold text-amber-300 hover:text-amber-200 gap-2 transition-all group/link">
                                    Pročitaj više
                                    <i class="fas fa-arrow-right text-xs group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="text-center mt-12">
                    <a href="/vesti"
                    class="bg-gradient-to-r from-sky-500 via-fuchsia-500 to-amber-400 text-slate-950 px-8 py-3 rounded-full font-semibold hover:brightness-110 transition-all inline-flex items-center shadow-lg shadow-sky-500/40">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Pogledaj sve vesti
                    </a>
                </div>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/80 pt-14 pb-10 relative overflow-hidden">
        <!-- subtle background glow -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -top-24 right-[-40px] w-64 h-64 bg-fuchsia-500/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 left-[-40px] w-72 h-72 bg-sky-500/15 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
                <!-- Col 1 -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-slate-50">
                        Omladinski Centar
                    </h3>
                    <p class="mb-5 text-sm text-slate-300 leading-relaxed">
                        Prostor za mlade da razvijaju svoje potencijale, stiču nova znanja i iskustva
                        kroz raznovrsne programe i aktivnosti.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                        class="w-9 h-9 rounded-full border border-slate-700/70 flex items-center justify-center text-slate-200 hover:text-sky-300 hover:border-sky-400/80 hover:bg-sky-500/10 transition-all duration-150">
                            <i class="fab fa-facebook-f text-sm text-slate-300 hover:text-sky-300 transition-colors"></i>
                        </a>
                        <a href="#"
                        class="w-9 h-9 rounded-full border border-slate-700/70 flex items-center justify-center text-slate-200 hover:text-pink-400 hover:border-pink-400/80 hover:bg-pink-500/10 transition-all duration-150">
                            <i class="fab fa-instagram text-sm text-slate-300 hover:text-sky-300 transition-colors"></i>
                        </a>
                        <a href="#"
                        class="w-9 h-9 rounded-full border border-slate-700/70 flex items-center justify-center text-slate-200 hover:text-red-500 hover:border-red-500/80 hover:bg-red-500/10 transition-all duration-150">
                            <i class="fab fa-youtube text-sm text-slate-300 hover:text-sky-300 transition-colors"></i>
                        </a>
                        <a href="#"
                        class="w-9 h-9 rounded-full border border-slate-700/70 flex items-center justify-center text-slate-200 hover:text-sky-300 hover:border-sky-300/80 hover:bg-sky-500/10 transition-all duration-150">
                            <i class="fab fa-twitter text-sm text-slate-300 hover:text-sky-300 transition-colors"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2 -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-slate-50">
                        Brzi Linkovi
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Početna</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">O nama</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Programi</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Vesti</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Partneri</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Dokumenti</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-sky-300 transition-colors">Kontakt</a></li>
                    </ul>
                </div>

                <!-- Col 4 -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-slate-50">
                        Kontakt
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-sky-400 mt-1 mr-3"></i>
                            <span class="text-slate-300 hover:text-sky-300 transition-colors">Omladinska ulica 15, Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-sky-400 mt-1 mr-3"></i>
                            <span class="text-slate-300 hover:text-sky-300 transition-colors">+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-sky-400 mt-1 mr-3"></i>
                            <span class="text-slate-300 hover:text-sky-300 transition-colors">info@omladinskicentar.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-sky-400 mt-1 mr-3"></i>
                            <span class="text-slate-300 hover:text-sky-300 transition-colors">Pon-Pet: 09:00 - 20:00<br>Sub: 10:00 - 15:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-10 pt-5 text-center text-xs md:text-sm text-slate-500 relative">
                <p>&copy; 2023 Omladinski Centar. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple JavaScript for mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.querySelector('button[class*="md:hidden"]');
            const nav = document.querySelector('nav');

            menuBtn.addEventListener('click', function () {
                nav.classList.toggle('hidden');
                nav.classList.toggle('flex');
                nav.classList.toggle('flex-col');
                nav.classList.toggle('absolute');
                nav.classList.toggle('bg-white');
                nav.classList.toggle('top-16');
                nav.classList.toggle('left-0');
                nav.classList.toggle('right-0');
                nav.classList.toggle('p-4');
                nav.classList.toggle('space-y-4');
                nav.classList.toggle('shadow-lg');
            });
        });
    </script>
</body>

</html>