<aside id="sidebar" class="sidebar w-64 min-h-screen fixed lg:relative text-white p-4">
    <div class="flex items-center justify-between mb-10">
        <div class="flex items-center space-x-2">
            <div class="bg-primary w-10 h-10 rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-white"></i>
            </div>
            <h2 class="text-xl font-bold">Admin Panel</h2>
        </div>
        <button class="lg:hidden text-white text-xl" id="closeSidebarBtn">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="space-y-2">
        <a href="/sadmin/style"
            class="nav-item <?= $activeTab == 'pages' ? 'active' : '' ?> flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-file w-5 text-center"></i>
            <span>Stranice</span>
        </a>
        <a href="/sadmin/users"
            class="nav-item <?= $activeTab == 'users' ? 'active' : '' ?>  flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-users w-5 text-center"></i>
            <span>Korisnici</span>
        </a>
        <a href="/sadmin/categories"
            class="nav-item flex items-center space-x-3 p-3 rounded-lg  <?= $activeTab == 'categories' ? 'active' : '' ?>">
            <i class="fas fa-chart-bar w-5 text-center"></i>
            <span>Kategorije</span>
        </a>
        <a href="" class="nav-item flex items-center space-x-3 p-3 rounded-lg">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Podešavanja</span>
        </a>
    </nav>

    <div class="mt-auto pt-10">
        <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div>
                <p class="font-medium">Admin Korisnik</p>
                <p class="text-xs text-gray-400">admin@example.com</p>
            </div>
        </div>
    </div>
</aside>