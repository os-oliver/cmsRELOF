<?php
session_start();
use App\Controllers\AuthController;
use App\Models\AboutUs;
use App\Models\Employee;

$locale = \App\Utils\LocaleManager::get();
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

$dataAboutUS = new AboutUs();
$aboutUsData = $dataAboutUS->list($locale);
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'name_asc';
$limit = $_GET['limit'] ?? 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$employeeModel = new Employee();
[$teamMembers, $totalCount] = $employeeModel->list(limit: $limit, offset: $offset, search: $search, locale: $locale);
$totalPages = (int) ceil($totalCount / $limit);
$activeTab = 'settings';
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __("settings.site_settings") ?> | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a' } }, fontFamily: { sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'sans-serif'] }, boxShadow: { 'soft': '0 2px 8px rgba(0, 0, 0, 0.04)', 'medium': '0 4px 12px rgba(0, 0, 0, 0.08)', 'strong': '0 8px 24px rgba(0, 0, 0, 0.12)' } } } }
    </script>
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .glass-panel {
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.9));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04)
        }

        .sidebar-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1)
        }

        .sidebar-item:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transform: translateX(4px);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3)
        }

        .section-header {
            position: relative;
            padding-left: 1.25rem;
            margin-bottom: 2rem
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, #3b82f6, #2563eb);
            border-radius: 4px
        }

        .input-field {
            transition: all 0.2s ease;
            border: 1.5px solid #e5e7eb
        }

        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none
        }

        .input-field:hover:not(:focus) {
            border-color: #cbd5e1
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2)
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3)
        }

        .btn-primary:active {
            transform: translateY(0)
        }

        .action-btn {
            transition: all 0.2s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .action-btn:hover {
            transform: scale(1.1)
        }

        .table-row {
            transition: all 0.15s ease
        }

        .table-row:hover {
            background-color: #f8fafc;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04)
        }

        .modal-backdrop {
            animation: fadeIn 0.2s ease
        }

        .modal-content {
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1)
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .pagination-btn {
            transition: all 0.2s ease
        }

        .pagination-btn:hover:not(.active):not(:disabled) {
            background-color: #f1f5f9;
            transform: translateY(-1px)
        }

        .pagination-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3)
        }

        .stat-badge {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: fixed;
                z-index: 40;
                height: 100vh
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15)
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 30;
                backdrop-filter: blur(4px)
            }

            .overlay.active {
                display: block;
                animation: fadeIn 0.2s ease
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            animation: slideIn 0.3s ease
        }

        .toast.success {
            background: linear-gradient(135deg, #10b981, #059669)
        }

        .toast.error {
            background: linear-gradient(135deg, #ef4444, #dc2626)
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0
            }

            to {
                transform: translateX(0);
                opacity: 1
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50 text-gray-700 font-sans">
    <div class="overlay" id="overlay"></div>
    <div id="toastContainer"></div>

    <div class="flex h-screen overflow-hidden">
        <?php require_once __DIR__ . "/../components/sidebar.php" ?>
        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="mb-10">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-cog text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-2xl font-bold text-gray-900 mb-2">
                                <?= __("settings.site_settings") ?>
                            </h1>
                            <p class="text-gray-600 text-lg"><?= __("settings.manage_site_description") ?></p>
                        </div>
                    </div>
                </div>

                <div class="mb-10 w-full mx-auto">
                    <div class="flex space-x-0 -mb-px border-b-2 border-gray-200">
                        <button
                            class="tab-button tab-style px-6 py-3 font-semibold text-gray-700 transition-all rounded-t-xl"
                            data-tab="general"><?= __("settings.general_settings") ?></button>
                        <button
                            class="tab-button tab-style px-6 py-3 font-semibold text-gray-700 transition-all rounded-t-xl"
                            data-tab="goal"><?= __("settings.goal") ?></button>
                        <button
                            class="tab-button tab-style px-6 py-3 font-semibold text-gray-700 transition-all rounded-t-xl"
                            data-tab="mission"><?= __("settings.mission") ?></button>
                        <div class="flex-grow"></div>
                    </div>

                    <div class="tab-content-container">
                        <div id="general"
                            class="tab-content glass-panel p-8 bg-white shadow-md rounded-b-xl rounded-tr-xl">
                            <div class="mb-6">
                                <label for="siteTitle"
                                    class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-globe text-indigo-500"></i><?= __("settings.site_title") ?>
                                </label>
                                <input type="text" id="siteTitle"
                                    value="<?= htmlspecialchars($aboutUsData['title'] ?? '') ?>"
                                    class="input-field block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 border-gray-200"
                                    placeholder="<?= __("settings.enter_site_title") ?>">
                            </div>
                            <div class="flex justify-end pt-2">
                                <button id="saveSiteTitle"
                                    class="btn-primary bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-medium shadow-sm">
                                    <i class="fas fa-save mr-2"></i><?= __("settings.save_changes") ?>
                                </button>
                            </div>
                        </div>

                        <div id="goal"
                            class="tab-content hidden glass-panel p-8 bg-white shadow-md rounded-b-xl rounded-tr-xl">
                            <label for="cilj" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center">
                                    <i class="fas fa-bullseye text-indigo-600 text-sm"></i>
                                </div><?= __("settings.goal") ?>
                            </label>
                            <textarea id="cilj" rows="6"
                                class="input-field block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 resize-none focus:ring-indigo-500 focus:border-indigo-500 border-gray-200"
                                placeholder="<?= __("settings.enter_goal") ?>"><?= htmlspecialchars($aboutUsData['goal'] ?? '') ?></textarea>
                            <button id="goalBtn"
                                class="mt-6 btn-primary bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium w-full shadow-sm">
                                <i class="fas fa-save mr-2"></i><?= __("settings.save_goal") ?>
                            </button>
                        </div>

                        <div id="mission"
                            class="tab-content hidden glass-panel p-8 bg-white shadow-md rounded-b-xl rounded-tr-xl">
                            <label for="misija"
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                    <i class="fas fa-rocket text-purple-600 text-sm"></i>
                                </div><?= __("settings.mission") ?>
                            </label>
                            <textarea id="misija" rows="6"
                                class="input-field block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-400 resize-none focus:ring-indigo-500 focus:border-indigo-500 border-gray-200"
                                placeholder="<?= __("settings.enter_mission") ?>"><?= htmlspecialchars($aboutUsData['mission'] ?? '') ?></textarea>
                            <button id="missionBtn"
                                class="mt-6 btn-primary bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium w-full shadow-sm">
                                <i class="fas fa-save mr-2"></i><?= __("settings.save_mission") ?>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="section-header">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <i class="fas fa-users text-primary-600"></i><?= __("settings.team_members") ?>
                        </h2>
                    </div>
                    <div class="glass-panel rounded-3xl p-8">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900"><?= __("settings.employees_list") ?></h3>
                                <p class="text-sm text-gray-600 mt-1"><?= __("settings.showing") ?>
                                    <?= count($teamMembers) ?> <?= __("settings.of") ?> <?= $totalCount ?>
                                    <?= __("settings.members") ?>
                                </p>
                            </div>
                            <button id="addTeamMemberBtn"
                                class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-md whitespace-nowrap">
                                <i class="fas fa-plus mr-2"></i><?= __("settings.add_member") ?>
                            </button>
                        </div>
                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-soft">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                <?= __("settings.first_name") ?>
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                <?= __("settings.last_name") ?>
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                <?= __("settings.position") ?>
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                <?= __("settings.actions") ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <?php foreach ($teamMembers as $member): ?>
                                            <tr class="table-row" data-id="<?= $member['id'] ?>">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    <?= htmlspecialchars($member['name']) ?>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    <?= htmlspecialchars($member['surname']) ?>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200"><?= htmlspecialchars($member['position']) ?></span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-center gap-2">
                                                        <button
                                                            class="action-btn edit-member text-blue-600 hover:bg-blue-50 rounded-lg"
                                                            data-id="<?= $member['id'] ?>"
                                                            data-name="<?= htmlspecialchars($member['name']) ?>"
                                                            data-surname="<?= htmlspecialchars($member['surname']) ?>"
                                                            data-position="<?= htmlspecialchars($member['position']) ?>"
                                                            data-biography="<?= htmlspecialchars($member['biography']) ?>"
                                                            title="<?= __("settings.edit") ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button
                                                            class="action-btn delete-member text-red-600 hover:bg-red-50 rounded-lg"
                                                            data-id="<?= $member['id'] ?>"
                                                            title="<?= __("settings.delete") ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-panel rounded-3xl p-6 flex items-center justify-between">
                    <div class="hidden md:flex items-center gap-2">
                        <span
                            class="stat-badge px-4 py-2 rounded-full text-sm font-semibold text-blue-700"><?= count($teamMembers) ?>
                            / <?= $totalCount ?></span>
                        <span class="text-sm text-gray-600"><?= __("settings.members") ?></span>
                    </div>
                    <nav class="flex items-center gap-2 mx-auto md:mx-0">
                        <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                            class="pagination-btn px-4 py-2 rounded-lg border border-gray-200 text-gray-600 <?= $page <= 1 ? 'pointer-events-none opacity-40' : '' ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <?php for ($p = 1; $p <= min($totalPages, 5); $p++): ?>
                            <a href="?page=<?= $p ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                                class="pagination-btn px-4 py-2 rounded-lg font-medium <?= $p === $page ? 'active' : 'border border-gray-200 text-gray-700' ?>"><?= $p ?></a>
                        <?php endfor; ?>
                        <?php if ($totalPages > 5): ?>
                            <span class="px-2 text-gray-400">...</span>
                            <a href="?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                                class="pagination-btn px-4 py-2 rounded-lg border border-gray-200 text-gray-700 <?= $page === $totalPages ? 'active' : '' ?>"><?= $totalPages ?></a>
                        <?php endif; ?>
                        <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                            class="pagination-btn px-4 py-2 rounded-lg border border-gray-200 text-gray-600 <?= $page >= $totalPages ? 'pointer-events-none opacity-40' : '' ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </main>
        </div>
    </div>

    <div id="teamMemberModal"
        class="modal-backdrop fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[50] hidden p-4">
        <div class="modal-content bg-white rounded-3xl shadow-strong w-full max-w-lg">
            <div class="border-b border-gray-100 px-8 py-6">
                <h3 class="text-2xl font-bold text-gray-900" id="modalTitle"><?= __("settings.add_new_member") ?></h3>
            </div>
            <form id="teamMemberForm" class="p-8 space-y-6">
                <input type="hidden" id="memberId" name="id" value="">
                <div>
                    <label for="name"
                        class="block text-sm font-semibold text-gray-700 mb-2"><?= __("settings.member_first_name") ?></label>
                    <input type="text" id="name" name="name" required
                        class="input-field w-full rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400">
                </div>
                <div>
                    <label for="surname"
                        class="block text-sm font-semibold text-gray-700 mb-2"><?= __("settings.member_last_name") ?></label>
                    <input type="text" id="surname" name="surname" required
                        class="input-field w-full rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400">
                </div>
                <div>
                    <label for="position"
                        class="block text-sm font-semibold text-gray-700 mb-2"><?= __("settings.member_position") ?></label>
                    <input type="text" id="position" name="position" required
                        class="input-field w-full rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400">
                </div>
                <div>
                    <label for="biography"
                        class="block text-sm font-semibold text-gray-700 mb-2"><?= __("settings.biography") ?></label>
                    <textarea id="biography" name="biography" rows="4"
                        class="input-field w-full rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" id="cancelMemberBtn"
                        class="flex-1 px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-all"><?= __("settings.cancel") ?></button>
                    <button type="submit" class="flex-1 btn-primary text-white px-6 py-3 rounded-xl font-medium">
                        <i class="fas fa-save mr-2"></i><?= __("settings.save") ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            document.getElementById('toastContainer').appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');
        const inactiveClasses = ['bg-gray-100', 'text-gray-700', 'border-b-2', 'border-gray-200', 'border-t-0', 'border-x-0', 'z-0'];
        const activeClasses = ['bg-white', 'text-indigo-600', 'border-t-2', 'border-x-2', 'border-b-0', 'border-indigo-600', 'z-10'];
        const activeContentBaseClasses = ['rounded-b-xl', 'rounded-tr-xl', 'shadow-md'];

        function switchTab(targetTab) {
            tabs.forEach(tab => {
                const target = tab.getAttribute('data-tab');
                const content = document.getElementById(target);
                tab.classList.remove(...activeClasses);
                tab.classList.add(...inactiveClasses);
                content.classList.add('hidden');
            });

            const activeTabButton = document.querySelector(`.tab-button[data-tab="${targetTab}"]`);
            activeTabButton.classList.remove(...inactiveClasses);
            activeTabButton.classList.add(...activeClasses);

            tabs.forEach(t => t.classList.remove('rounded-tl-xl', 'rounded-tr-xl'));
            if (targetTab === 'general') activeTabButton.classList.add('rounded-tr-xl');
            else if (targetTab === 'mission') activeTabButton.classList.add('rounded-tl-xl');
            else activeTabButton.classList.add('rounded-tl-xl', 'rounded-tr-xl');

            const activeContent = document.getElementById(targetTab);
            activeContent.classList.remove('hidden', ...activeContentBaseClasses);
            activeContent.classList.add(...activeContentBaseClasses);
            activeContent.classList.remove('rounded-tl-xl');
            if (targetTab !== 'general') activeContent.classList.add('rounded-tl-xl');
        }

        tabs.forEach(tab => tab.addEventListener('click', () => switchTab(tab.getAttribute('data-tab'))));
        switchTab('general');

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('saveSiteTitle').addEventListener('click', async () => {
                const siteTitle = document.getElementById('siteTitle').value.trim();
                if (!siteTitle) return showToast('<?= __("settings.empty_site_title") ?>', 'error');
                try {
                    const response = await fetch('/settings', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ site_title: siteTitle }) });
                    if (!response.ok) throw new Error("<?= __("settings.save_error") ?>");
                    showToast("<?= __("settings.site_title_saved") ?>", 'success');
                } catch (e) {
                    showToast("<?= __("settings.save_error") ?>: " + e.message, 'error');
                }
            });

            document.getElementById('goalBtn').addEventListener('click', async () => {
                const goal = document.getElementById('cilj').value.trim();
                const mission = document.getElementById('misija').value.trim();
                if (!goal) return showToast('<?= __("settings.empty_goal") ?>', 'error');
                try {
                    const response = await fetch('/aboutus/1', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ goal, mission }) });
                    if (!response.ok) throw new Error("<?= __("settings.save_error") ?>");
                    showToast("<?= __("settings.saved_goal") ?>", 'success');
                } catch (e) {
                    showToast("<?= __("settings.save_error") ?>: " + e.message, 'error');
                }
            });

            document.getElementById('missionBtn').addEventListener('click', async () => {
                const goal = document.getElementById('cilj').value.trim();
                const mission = document.getElementById('misija').value.trim();
                if (!mission) return showToast('<?= __("settings.empty_mission") ?>', 'error');
                try {
                    const response = await fetch('/aboutus/1', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ goal, mission }) });
                    if (!response.ok) throw new Error('<?= __("settings.save_error") ?>');
                    showToast('<?= __("settings.save_success") ?>', 'success');
                } catch (e) {
                    showToast('<?= __("settings.save_error") ?>: ' + e.message, 'error');
                }
            });

            const modal = document.getElementById('teamMemberModal');
            const modalTitle = document.getElementById('modalTitle');
            const memberForm = document.getElementById('teamMemberForm');
            const addBtn = document.getElementById('addTeamMemberBtn');
            const cancelBtn = document.getElementById('cancelMemberBtn');

            addBtn.addEventListener('click', () => {
                modalTitle.textContent = '<?= __("settings.add_member_title") ?>';
                memberForm.reset();
                document.getElementById('memberId').value = '';
                modal.classList.remove('hidden');
            });

            document.querySelectorAll('.edit-member').forEach(btn => {
                btn.addEventListener('click', () => {
                    modalTitle.textContent = '<?= __("settings.edit_member_title") ?>';
                    document.getElementById('memberId').value = btn.dataset.id;
                    document.getElementById('name').value = btn.dataset.name;
                    document.getElementById('surname').value = btn.dataset.surname;
                    document.getElementById('position').value = btn.dataset.position;
                    document.getElementById('biography').value = btn.dataset.biography;
                    modal.classList.remove('hidden');
                });
            });

            document.querySelectorAll('.delete-member').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.dataset.id;
                    if (!confirm('<?= __("settings.confirm_delete") ?>')) return;
                    try {
                        const response = await fetch(`/employees/${id}`, { method: 'DELETE' });
                        if (!response.ok) throw new Error('<?= __("settings.error_delete") ?>');
                        showToast('<?= __("settings.success_delete") ?>', 'success');
                        location.reload();
                    } catch (e) {
                        showToast('<?= __("settings.error_delete") ?>: ' + e.message, 'error');
                    }
                });
            });

            cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
            document.addEventListener('keydown', (e) => e.key === 'Escape' && !modal.classList.contains('hidden') && modal.classList.add('hidden'));

            memberForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const id = document.getElementById('memberId').value;
                const formData = {
                    name: document.getElementById('name').value.trim(),
                    surname: document.getElementById('surname').value.trim(),
                    position: document.getElementById('position').value.trim(),
                    biography: document.getElementById('biography').value.trim()
                };
                if (!formData.name || !formData.surname || !formData.position) return showToast('<?= __("settings.required_fields_msg") ?>', 'error');
                try {
                    const url = id ? `/employees/${id}` : '/employees';
                    const method = id ? 'PUT' : 'POST';
                    const response = await fetch(url, { method, headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(formData) });
                    if (!response.ok) throw new Error('<?= __("settings.save_error") ?>');
                    showToast('<?= __("settings.save_success_msg") ?>', 'success');
                    modal.classList.add('hidden');
                    location.reload();
                } catch (e) {
                    showToast('<?= __("settings.save_error") ?>: ' + e.message, 'error');
                }
            });
        });
    </script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
</body>

</html>