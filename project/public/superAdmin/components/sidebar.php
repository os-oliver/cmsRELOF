<?php
use App\Controllers\AuthController;
AuthController::requireAdmin();
[$name, $surname, $role] = AuthController::getUserInfo();
error_log($name);
?>
<aside id="sidebar" class="flex flex-col sidebar w-64 min-h-screen fixed lg:relative text-white p-4">
    <div class="flex items-center justify-between mb-10">
        <div class="flex items-center space-x-2">
            <div class="bg-primary w-10 h-10 rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-white"></i>
            </div>
            <h2 class="text-xl font-bold">
                <?= __("superadmin_sidebar.admin_panel") ?>
            </h2>
        </div>
        <button class="lg:hidden text-white text-xl" id="closeSidebarBtn">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="space-y-2">
        <a href="/sadmin/stil-stranica"
            class="nav-item <?= $activeTab == 'pages' ? 'active' : '' ?> flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-file w-5 text-center"></i>
            <span>
                <?= __("superadmin_sidebar.pages") ?>
            </span>
        </a>
        <a href="/sadmin/korisnici"
            class="nav-item <?= $activeTab == 'users' ? 'active' : '' ?>  flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-users w-5 text-center"></i>
            <span>
                <?= __("superadmin_sidebar.users") ?>
            </span>
        </a>
        <a href="/sadmin/kategorije"
            class="nav-item flex items-center space-x-3 p-3 rounded-lg  <?= $activeTab == 'categories' ? 'active' : '' ?>">
            <i class="fas fa-chart-bar w-5 text-center"></i>
            <span>
                <?= __("superadmin_sidebar.categories") ?>
            </span>
        </a>
        <a href="" class="nav-item flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>
                <?= __("superadmin_sidebar.settings") ?>
            </span>
        </a>
    </nav>

    <div class="pt-10">
        <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div>
                <p class="font-medium"><?=$name . ' ' . $surname?></p>
                <p class="text-xs text-gray-400"><?=$role?></p>
            </div>
        </div>
    </div>

    <?php
        if (isset($_GET['locale'])) {
            $_SESSION['locale'] = $_GET['locale'];
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

        $languages = [
            'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
            'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
            'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
        ];

        if (!isset($languages[$locale])) {
            $locale = 'sr-Cyrl';
        }
    ?>

    <div class="relative mt-auto">
        <button id="languageDropdownButton" 
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 transition cursor-pointer">
            <div class="flex items-center">
                <span class="mr-2"><?= $languages[$locale]['flag'] ?></span>
                <span class="text-sm"><?= $languages[$locale]['label'] ?></span>
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="languageDropdownChevron"></i>
        </button>

        <div id="languageDropdownMenu" 
            class="absolute bottom-full mb-2 w-full bg-gray-800 rounded-md shadow-lg opacity-0 invisible transition-opacity duration-200 z-50">
            <?php foreach ($languages as $key => $lang): ?>
                <a href="?locale=<?= $key ?>" 
                class="flex items-center px-4 py-2 text-sm hover:bg-gray-700 transition">
                    <span class="mr-2"><?= $lang['flag'] ?></span>
                    <?= $lang['label'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</aside>

<script>
    const languageDropdownButton = document.getElementById("languageDropdownButton");
    const languageDropdownMenu = document.getElementById("languageDropdownMenu");
    const languageDropdownChevron = document.getElementById("languageDropdownChevron");

    languageDropdownButton.addEventListener("click", () => {
        languageDropdownMenu.classList.toggle("opacity-0");
        languageDropdownMenu.classList.toggle("invisible");
        languageDropdownMenu.classList.toggle("opacity-100");
        languageDropdownMenu.classList.toggle("visible");

        languageDropdownChevron.classList.toggle("rotate-180");
    });

    document.addEventListener("click", (e) => {
        if (!languageDropdownButton.contains(e.target) && !languageDropdownMenu.contains(e.target)) {
            languageDropdownMenu.classList.add("opacity-0", "invisible");
            languageDropdownMenu.classList.remove("opacity-100", "visible");
            languageDropdownChevron.classList.remove("rotate-180");
        }
    });
</script>