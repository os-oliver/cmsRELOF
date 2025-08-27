<div class="glass-panel w-64 flex flex-col h-full sidebar" id="sidebar">
    <!-- Logo and Close Button -->
    <div class="p-5 flex items-center justify-between border-b border-gray-200">
        <div class="flex items-center">
            <div
                class="bg-gradient-to-r from-primary-600 to-primary-700 w-10 h-10 rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-sliders-h text-white text-lg"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800 ml-3 tracking-tight">
                <?= __('sidebar.control_panel') ?>
            </h1>
        </div>
        <button class="sidebar-close-btn text-gray-600 hidden" id="sidebar-close">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Navigation -->
    <div class="flex-1 mt-5 px-3 overflow-y-auto">
        <h3 class="text-xs uppercase text-primary-600 tracking-wider font-medium mb-3 pl-3">
            <?= __('sidebar.main_menu') ?>
        </h3>
        <ul>
            <li class="mb-1">
                <a href="/dashboard" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'dashboard')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:bg-primary-900' ?>">
                    <i
                        class="fas fa-chart-line  <?= ($activeTab === 'dashboard') ? 'text-primary-200' : 'text-primary-500' ?> mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.dashboard') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/dokumenti" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'documents')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i
                        class="fas fa-file-alt  <?= ($activeTab === 'documents') ? 'text-primary-200' : 'text-primary-500' ?> mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.documents') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/dogadjaji" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'events')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i class="fas fa-calendar-alt text-primary-500 mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.events') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/gallery" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'gallery')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i class="fas fa-image text-primary-500 mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.gallery') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/promotion" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'promotion')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i class="fas fa-users text-primary-500 mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.promotion') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/poruke" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'chats')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i class="fas fa-comments text-primary-500 mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.messages') ?>
                    </span>
                </a>
            </li>
            <li class="mb-1">
                <a href="/dashboard/o-nama" class="sidebar-item flex items-center p-3 rounded-lg <?= ($activeTab === 'aboutus')
                    ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700'
                    : 'text-gray-600 hover:text-gray-900' ?>">
                    <i class="fas fa-info text-primary-500 mr-3 text-lg w-6 text-center"></i>
                    <span class="font-medium">
                        <?= __('sidebar.about_us') ?>
                    </span>
                </a>
            </li>
        </ul>

    </div>

    <!-- User Profile -->
    <div class="p-4 border-t border-gray-200 flex items-center">
        <div class="relative">
            <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="User"
                class="w-10 h-10 rounded-full border-2 border-primary-600">
            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-gray-800"><?= $name . ' ' . $surname ?> </p>
            <p class="text-xs text-primary-600"><?= $role ?></p>
        </div>
    </div>
</div>