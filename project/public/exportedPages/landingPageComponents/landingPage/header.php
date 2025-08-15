<header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm bg-paper/95">
    <div class="container mx-auto px-4 flex justify-between items-center"><!-- Logo Section -->
        <div class="flex items-center space-x-3 flex-shrink-0">
            <div class="artistic-frame w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-ochre to-terracotta rounded-lg flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 sm:h-8 sm:w-8 text-paper">
                    <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"></path>
                </svg></div>
            <div class="hidden sm:block">
                <h1 class="text-xl lg:text-2xl font-display text-slate font-bold tracking-wider">KULTURNI NEXUS</h1>
                <p class="text-xs text-terracotta tracking-widest hidden md:block">CENTAR ZA UMETNOST I BAŠTINU</p>
            </div>
            <div class="block sm:hidden">
                <h1 class="text-lg font-display text-slate font-bold">NEXUS</h1>
            </div>
        </div><!-- Desktop Navigation -->
        <nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-8"><a href="/" title="" target="_self" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-home mr-2 text-terracotta group-hover:text-coral transition-colors"></i><span class="hidden xl:inline">Pocetna</span></a>
            <div class="dropdown relative group"><button class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i><span class="hidden xl:inline">O nama</span><i class="fas fa-chevron-down ml-1 text-xs"></i></button>
                <div class="dropdown-menu absolute top-full left-0 w-48 bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"><a href="/o-nama/cilj" title="" target="_self" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-bullseye mr-2 text-royal-blue"></i>Cilj
                    </a><a href="/o-nama/zaposleni" title="" target="_self" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-sitemap mr-2 text-terracotta"></i>Zaposleni
                    </a><a href="/o-nama/misija" title="" target="_self" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-flag mr-2 text-deep-teal"></i>Misija
                    </a></div>
            </div><a href="/dogadjaji" title="" target="_self" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-calendar-alt mr-2 text-royal-blue group-hover:text-deep-teal transition-colors"></i><span class="hidden xl:inline">Dogadjaji</span></a><a href="/galerija" title="" target="_self" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-images mr-2 text-velvet group-hover:text-crimson transition-colors"></i><span class="hidden xl:inline">Galerija</span></a><a href="/dokumenti" title="" target="_self" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors group flex items-center whitespace-nowrap"><i class="fas fa-folder-open mr-2 text-coral group-hover:text-terracotta transition-colors"></i><span class="hidden xl:inline">Dokumenti</span></a><a href="/kontakt" title="" target="_self" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-address-book mr-2 text-deep-teal group-hover:text-sage transition-colors"></i><span class="hidden xl:inline">Kontakt</span></a>
        <?php
            if (isset($_GET['locale'])) {
                $_SESSION['locale'] = $_GET['locale'];
            }
            $locale = $_SESSION['locale'] ?? 'sr';

            $languages = [
                'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
            ];

            if (!isset($languages[$locale])) {
                $locale = 'sr';
            }
        ?>
        <div class="dropdown relative group">
            <button class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                <span class="mr-2"><?= $languages[$locale]['flag'] ?></span>
                <span class="hidden xl:inline"><?= $languages[$locale]['label'] ?></span>
                <i class="fas fa-chevron-down ml-1 text-xs"></i>
            </button>
            <div class="dropdown-menu absolute top-full left-0 w-48 bg-paper rounded-md shadow-lg z-50">
                <?php foreach ($languages as $key => $lang): ?>
                    <a href="?locale=<?= $key ?>" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm">
                        <span class="mr-2"><?= $lang['flag'] ?></span>
                        <?= $lang['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        </nav><!-- Search & Mobile Toggle -->
        <div class="flex items-center space-x-2 sm:space-x-4"><!-- Search Container -->
            <div class="relative"><button id="searchButton" aria-label="Search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-2"><i class="fas fa-search"></i></button><!-- Search Input - positioned to avoid nav overlap -->
                <div id="searchInputContainer" class="absolute right-0 top-full mt-2 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden">
                    <form id="searchForm" action="/search" method="GET" class="flex items-center w-full p-1.5"><input type="text" name="q" placeholder="Search..." id="searchInput" required class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-1.5 text-gray-700 placeholder-gray-400" />
                        <div class="flex items-center space-x-1 ml-2"><button type="submit" aria-label="Submit search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"><i class="fas fa-search text-sm"></i></button><button type="button" id="closeSearch" aria-label="Clear search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"><i class="fas fa-times text-sm"></i></button></div>
                    </form>
                </div>
            </div><!-- Mobile Menu Button --><button id="hamburger" class="hamburger lg:hidden text-slate w-8 h-8 flex flex-col justify-center space-y-1 p-1"><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span></button>
        </div>
    </div>
</header>