<header class="glass-panel py-4 px-6 flex items-center justify-between border-b border-gray-200">
    <div class="flex items-center">
        <button class="mobile-menu-btn mr-3 text-gray-600 lg:hidden" id="mobile-menu">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800">Dobrodošli, <?= $name ?></h2>
    </div>

    <div class="flex items-center space-x-4">


        <div class="flex space-x-4">
            <button class="relative text-gray-500 hover:text-gray-700">
                <i class="fas fa-bell text-xl"></i>
                <span
                    class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
            </button>

            <button class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-envelope text-xl"></i>
            </button>

            <a href="/logout" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-power-off text-xl"></i>
            </a>
        </div>
    </div>
</header>