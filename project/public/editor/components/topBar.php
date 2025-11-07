<?php
use App\Models\Contact;
$contact = new Contact();
$numOfContacts = $contact->count();
?>

<header class="glass-panel py-4 px-6 flex items-center justify-between border-b border-gray-200">
    <div class="flex items-center">
        <button id="mobile-menu-btn" class=" mobile-menu-btn mr-3 text-gray-600 lg:hidden" id="mobile-menu">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800">
            <?= __('topbar.welcome') . ', ' . $name ?>
        </h2>
    </div>

    <div class="flex items-center space-x-4">
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
        <div class="relative inline-block">
            <button id="languageDropdownButton"
                class="flex items-center px-3 py-2 rounded-md bg-white shadow hover:bg-gray-50 transition cursor-pointer">
                <span class="mr-2"><?= $languages[$locale]['flag'] ?></span>
                <span class="hidden xl:inline"><?= $languages[$locale]['label'] ?></span>
                <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200"
                    id="languageDropdownChevron"></i>
            </button>

            <div id="languageDropdownMenu"
                class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible transition-opacity duration-200 z-50">
                <?php foreach ($languages as $key => $lang): ?>
                    <a href="?locale=<?= $key ?>"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <span class="mr-2"><?= $lang['flag'] ?></span>
                        <?= $lang['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex space-x-4">


            <a href="/logout" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-power-off text-xl"></i>
            </a>

            <a href="/help" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-question-circle text-xl"></i>
            </a>
        </div>

    </div>
</header>

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