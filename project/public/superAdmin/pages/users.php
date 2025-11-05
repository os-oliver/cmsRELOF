<?php
use App\Controllers\AuthController;
use App\Models\User;
AuthController::requireAdmin();


// Simulated database functions

$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination as before
$limit = 6;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$documentModal = new User();
// now pass filters into your Document model
[$users, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset,
    search: $search,
    sort: $sort,
);
$totalPages = (int) ceil($totalCount / $limit);


?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <h1><?= __('users.admin_panel_title') ?></h1>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .content-area {
            background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .page-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.95);
        }

        .nav-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(1px);
            animation: float 6s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 256px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content-area {
                margin-left: 0 !important;
                width: 100%;
            }

            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .mobile-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }

        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
                margin: 1rem !important;
            }

            .floating-orb {
                display: none;
            }

            .page-card {
                padding: 1rem !important;
            }

            .glass-effect {
                margin: 0.5rem;
                padding: 1rem !important;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr !important;
            }

            .activity-item {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans overflow-x-hidden">
    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <?php
        $activeTab = 'users';
        require_once __DIR__ . "/../components/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="content-area flex-1 min-h-screen">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                <?= __('users.user_management') ?>
                            </h1>
                            <p class="text-gray-600">
                                <?= __('users.user_management_description') ?>
                            </p>
                        </div>
                        <button onclick="openUserModal('create')"
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <?= __('users.new_user') ?>
                        </button>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('users.user') ?>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('users.role') ?>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('users.created') ?>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('users.actions') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($users as $user): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                                    <?= $user['name'][0] . $user['surname'][0] ?>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">
                                                        <?= htmlspecialchars($user['name'] . ' ' . $user['surname']) ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        @<?= htmlspecialchars($user['username']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php
                                            $roleClasses = [
                                                'admin' => 'bg-purple-100 text-purple-800',
                                                'editor' => 'bg-blue-100 text-blue-800',
                                                'user' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $roleIcons = [
                                                'admin' => 'fa-user-shield',
                                                'editor' => 'fa-user-edit',
                                                'user' => 'fa-user'
                                            ];
                                            $roleLabels = [
                                                'admin' => 'Administrator',
                                                'editor' => 'Urednik',
                                                'user' => 'Korisnik'
                                            ];
                                            ?>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $roleClasses[$user['role']] ?>">
                                                <i class="fas <?= $roleIcons[$user['role']] ?> mr-1"></i>
                                                <?= $roleLabels[$user['role']] ?>
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            <?= date('d.m.Y', strtotime($user['created_at'])) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openUserModal('edit', <?= $user['id'] ?>)"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                    title="Uredi">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="openDeleteModal(<?= $user['id'] ?>)"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Obriši">
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

                <!-- Pagination -->
                <div class="flex items-center justify-end  rounded-2xl  p-6 border border-gray-100">


                    <nav class="flex items-center gap-2">
                        <!-- Previous -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page <= 1 ? 'disabled' : '' ?> onclick="location.href='?page=<?= $page - 1 ?>'">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <!-- Page numbers -->
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <button
                                class="px-4 py-2 rounded-lg <?= $p === $page ? 'bg-blue-600 text-white' : 'border text-gray-700 hover:bg-gray-50' ?>"
                                onclick="location.href='?page=<?= $p ?>'">
                                <?= $p ?>
                            </button>
                        <?php endfor; ?>

                        <!-- Next -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page >= $totalPages ? 'disabled' : '' ?>
                            onclick="location.href='?page=<?= $page + 1 ?>'">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>

                </div>
            </div>

            <!-- User Modal -->
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300"
                id="userModal">
                <div
                    class="bg-white rounded-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-300">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">
                                <?= __('users.new_user_button') ?>
                            </h3>
                            <button onclick="closeUserModal()"
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <form id="userForm" class="p-6 space-y-6">
                        <input type="hidden" id="userId">

                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.name') ?>
                                </label>
                                <input type="text" id="name" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.lastname') ?>
                                </label>
                                <input type="text" id="surname" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.username') ?>
                                </label>
                                <input type="text" id="username" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                            <!-- User Role -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.user_role') ?>
                                </label>
                                <select id="userRole" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <option value="admin">
                                        <?= __('users.role_admin') ?>
                                    </option>
                                    <option value="editor">
                                        <?= __('users.role_editor') ?>
                                    </option>
                                </select>
                            </div>
                        </div>


                        <!-- Password -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.password') ?>
                                </label>
                                <div class="relative">
                                    <input type="password" id="userPassword" required
                                        class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <button type="button" onclick="togglePassword('userPassword')"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('users.confirm_password') ?>
                                </label>
                                <div class="relative">
                                    <input type="password" id="confirmPassword" required
                                        class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <button type="button" onclick="togglePassword('confirmPassword')"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>



                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-save mr-2"></i>
                                <?= __('users.save_user') ?>
                            </button>
                            <button type="button" onclick="closeUserModal()"
                                class="flex-1 border border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                                <?= __('users.cancel') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300"
                id="deleteModal">
                <div
                    class="bg-white rounded-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    <?= __('users.delete_user') ?>
                                </h3>
                                <p class="text-gray-600">
                                    <?= __('users.action_cannot_be_undone') ?>
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-6">
                            <?= __('users.confirm_delete_user') ?>
                            <strong id="deleteUserName"></strong>?
                        </p>
                        <div class="flex gap-3">
                            <button onclick="confirmDelete()"
                                class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl font-semibold transition-colors">
                                <?= __('users.yes_delete') ?>
                            </button>
                            <button onclick="closeDeleteModal()"
                                class="flex-1 border border-gray-300 text-gray-700 px-4 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                                <?= __('users.cancel_del_modal') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let users = <?= json_encode($users) ?>;
        let editingUserId = null;
        let deleteUserId = null;

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile menu functionality
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    mobileOverlay.classList.toggle('active');
                });

                if (closeSidebarBtn) {
                    closeSidebarBtn.addEventListener('click', () => {
                        sidebar.classList.remove('active');
                        mobileOverlay.classList.remove('active');
                    });
                }

                mobileOverlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');
                });
            }
        });

        // Modal functions
        function openUserModal(mode, userId = null) {
            const modal = document.getElementById('userModal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('userForm');

            let titleText = '';

            if (mode === 'create') {
                titleText = "<?= __('users.modal_title_create') ?>";
            } else if (mode === 'edit') {
                titleText = "<?= __('users.modal_title_edit') ?>";
            }

            modalTitle.textContent = titleText;

            if (mode === 'create') {
                form.reset();
                document.getElementById('userId').value = '';
                editingUserId = null;
            } else if (mode === 'edit' && userId) {
                const user = users.find(u => u.id === userId);
                if (user) {
                    populateForm(user);
                    editingUserId = userId;
                }
            }

            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }

        function closeUserModal() {
            const modal = document.getElementById('userModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.classList.remove('opacity-100', 'visible');
            modal.querySelector('.transform').classList.add('scale-95');
            modal.querySelector('.transform').classList.remove('scale-100');
        }

        function populateForm(user) {
            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('surname').value = user.surname;
            document.getElementById('username').value = user.username;
            document.getElementById('userRole').value = user.role;

            // Clear password fields for editing
            document.getElementById('userPassword').removeAttribute('required');
            document.getElementById('confirmPassword').removeAttribute('required');
        }

        // Password toggle
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Form submission
        document.getElementById('userForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = {
                surname: document.getElementById('surname').value,
                name: document.getElementById('name').value,
                username: document.getElementById('username').value,
                role: document.getElementById('userRole').value,
            };

            const password = document.getElementById('userPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Provera lozinki
            if (!editingUserId && password !== confirmPassword) {
                const message = "<?= __('users.passwords_do_not_match') ?>";
                alert(message);
                return;
            }

            if (!editingUserId && password.length < 6) {
                const message = "<?= __('users.password_min_length') ?>";
                alert(message);
                return;
            }

            if (password) {
                formData.password = password;
            }

            const url = editingUserId ? `/users/${editingUserId}` : '/users';
            const method = editingUserId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    let message;
                    if (data.success) {
                        const message = editingUserId
                            ? "<?= __('users.user_updated') ?>"
                            : "<?= __('users.user_created') ?>";

                        showNotification(message, 'success');
                        closeUserModal();
                    } else {
                        const message = data.message || "<?= __('users.error_saving_user') ?>";
                        alert(message);
                    }
                })
                .catch(error => {
                    const message = "<?= __('users.server_communication_error') ?>";
                    console.error('Greška:', error);
                    alert(message);
                });
        });

        // Delete modal functions
        function openDeleteModal(userId) {
            const user = users.find(u => u.id === userId);
            if (user) {
                document.getElementById('deleteUserName').textContent =
                    `${user.name} ${user.surname}`;
                deleteUserId = userId;

                const modal = document.getElementById('deleteModal');
                modal.classList.remove('opacity-0', 'invisible');
                modal.classList.add('opacity-100', 'visible');
                modal.querySelector('.transform').classList.remove('scale-95');
                modal.querySelector('.transform').classList.add('scale-100');
            }
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.classList.remove('opacity-100', 'visible');
            modal.querySelector('.transform').classList.add('scale-95');
            modal.querySelector('.transform').classList.remove('scale-100');
            deleteUserId = null;
        }

        function confirmDelete() {
            if (deleteUserId) {
                fetch(`/users/${deleteUserId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("<?= __('users.error_deleting_user') ?>");
                        }
                        return response.json(); // ako šalješ JSON response
                    })
                    .then(data => {
                        const message = "<?= __('users.user_deleted_success') ?>";
                        showNotification(message, 'success');
                        closeDeleteModal();
                        location.reload();
                    })
                    .catch(error => {
                        const message = "<?= __('users.error_prefix') ?> " + error.message;
                        showNotification(message, 'error');
                    });
            }
        }


        // Notification system
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg transform translate-x-full transition-all duration-300 ${type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                    'bg-blue-500 text-white'
                }`;

            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
                notification.classList.add('translate-x-0');
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.remove('translate-x-0');
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Close modals on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeUserModal();
                closeDeleteModal();
            }
        });

        // Close modals on outside click (same as Cancel)
        document.getElementById('userModal').addEventListener('click', (e) => {
            if (e.target.id === 'userModal') {
                closeUserModal();
            }
        });
        document.getElementById('deleteModal').addEventListener('click', (e) => {
            if (e.target.id === 'deleteModal') {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>