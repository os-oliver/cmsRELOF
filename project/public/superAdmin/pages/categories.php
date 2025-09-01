<?php
use App\Controllers\AuthController;
use App\Models\Category;
AuthController::requireAdmin();

// Simulated database functions
$tabActive = $_GET['tab'] ?? 'events'; // 'events' or 'documents'

// Pagination
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'name_asc';
$limit = 6;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$categoryModal = new Category();
[$categories, $totalCount] = $categoryModal->list(
    table: ($tabActive === 'events') ? 'kategorije_dogadjaja' : 'category_document',
    limit: $limit,
    offset: $offset,
    search: $search,
    sort: $sort
);
$totalPages = (int) ceil($totalCount / $limit);
?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __('categories.admin_panel_title') ?>
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

        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: inline-block;
            margin-right: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tab-button {
            padding: 10px 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .tab-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .tab-button.active {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }

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

        .active {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans overflow-x-hidden">
    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <?php
        $activeTab = 'categories';
        require_once __DIR__ . "/../components/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="content-area flex-1 min-h-screen">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                <?= __('categories.admin_panel') ?>
                            </h1>
                            <p class="text-gray-600">
                                <?= __('categories.admin_panel_description') ?>
                            </p>
                        </div>
                        <button onclick="openCategoryModal('create')"
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                                <?= __('categories.new_category') ?>
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex gap-2 mb-6">
                    <button class="tab-button <?= $tabActive === 'events' ? 'active' : '' ?>"
                        onclick="switchTab('events')">
                            <?= __('categories.event_categories') ?>
                    </button>
                    <button class="tab-button <?= $tabActive === 'documents' ? 'active' : '' ?>"
                        onclick="switchTab('documents')">
                            <?= __('categories.document_categories') ?>
                    </button>
                </div>

                <!-- Categories Table -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('categories.name') ?>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('categories.color') ?>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                        <?= __('categories.actions') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($categories as $category): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 font-semibold text-gray-900">
                                            <?= htmlspecialchars($category['name'] ?? $category['naziv']) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="color-preview"
                                                    style="background-color: <?= htmlspecialchars($category['color_code']) ?>">
                                                </div>
                                                <span
                                                    class="text-gray-600"><?= htmlspecialchars($category['color_code']) ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <button
                                                    onclick="openCategoryModal('edit', <?= $category['id'] ?>, '<?= $tabActive ?>')"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                    title="Uredi">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    onclick="openDeleteModal(<?= $category['id'] ?>, '<?= $tabActive ?>')"
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
                <div class="flex items-center justify-end rounded-2xl p-6 border border-gray-100">
                    <nav class="flex items-center gap-2">
                        <!-- Previous -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page <= 1 ? 'disabled' : '' ?>
                            onclick="location.href='?page=<?= $page - 1 ?>&tab=<?= $tabActive ?>'">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <!-- Page numbers -->
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <button
                                class="px-4 py-2 rounded-lg <?= $p === $page ? 'bg-blue-600 text-white' : 'border text-gray-700 hover:bg-gray-50' ?>"
                                onclick="location.href='?page=<?= $p ?>&tab=<?= $tabActive ?>'">
                                <?= $p ?>
                            </button>
                        <?php endfor; ?>

                        <!-- Next -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page >= $totalPages ? 'disabled' : '' ?>
                            onclick="location.href='?page=<?= $page + 1 ?>&tab=<?= $tabActive ?>'">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Category Modal -->
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300"
                id="categoryModal">
                <div
                    class="bg-white rounded-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-300">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">
                                <?= __('categories.new_category_cat_modal') ?>
                            </h3>
                            <button onclick="closeCategoryModal()"
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <form id="categoryForm" class="p-6 space-y-6">
                        <input type="hidden" id="categoryId">
                        <input type="hidden" id="categoryType" value="<?= $tabActive ?>">

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('categories.category_name') ?>
                            </label>
                                <input type="text" id="categoryName" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <?= __('categories.color_cat_modal') ?>
                                </label>
                                <div class="flex items-center gap-4">
                                    <input type="color" id="colorPicker" value="#6366F1"
                                        class="w-16 h-16 rounded-lg border-0 cursor-pointer">
                                    <input type="text" id="colorCode" value="#6366F1" required
                                        class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                                <p class="text-sm text-gray-500 mt-2">
                                    <?= __('categories.color_help') ?>
                                </p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-save mr-2"></i>
                                    <?= __('categories.save_category') ?>
                            </button>
                            <button type="button" onclick="closeCategoryModal()"
                                class="flex-1 border border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                                    <?= __('categories.cancel') ?>
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
                                    <?= __('categories.delete_category') ?>
                                </h3>
                                <p class="text-gray-600">
                                    <?= __('categories.cannot_undo') ?>
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-6">
                            <?= __('categories.confirm_delete_message') ?>
                             <strong
                                id="deleteCategoryName"></strong>?</p>
                        <div class="flex gap-3">
                            <button onclick="confirmDelete()"
                                class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl font-semibold transition-colors">    
                                    <?= __('categories.confirm_delete_button') ?>
                            </button>
                            <button onclick="closeDeleteModal()"
                                class="flex-1 border border-gray-300 text-gray-700 px-4 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                                    <?= __('categories.cancel_button') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let categories = <?= json_encode($categories) ?>;
        let editingCategoryId = null;
        let deleteCategoryId = null;
        let activeTab = '<?= $tabActive ?>';
        let deleteCategoryType = null;

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

            // Color picker interaction
            const colorPicker = document.getElementById('colorPicker');
            const colorCode = document.getElementById('colorCode');

            colorPicker.addEventListener('input', function () {
                colorCode.value = this.value;
            });

            colorCode.addEventListener('input', function () {
                const value = this.value;
                if (value.startsWith('#') && value.length === 7) {
                    colorPicker.value = value;
                }
            });
        });

        // Tab switching
        function switchTab(tab) {
            window.location.href = `?tab=${tab}`;
        }

        // Modal functions
        function openCategoryModal(mode, categoryId = null, categoryType = null) {
            const modal = document.getElementById('categoryModal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('categoryForm');
            const categoryTypeInput = document.getElementById('categoryType');

            if (categoryType) {
                categoryTypeInput.value = categoryType;
            }

            if (mode === 'create') {
                let titleText = "<?= __('categories.new_category_cat_modal') ?>";

                modalTitle.textContent = titleText;
                form.reset();
                document.getElementById('categoryId').value = '';
                document.getElementById('colorPicker').value = '#6366F1';
                document.getElementById('colorCode').value = '#6366F1';
                editingCategoryId = null;

            } else if (mode === 'edit' && categoryId) {
                const category = categories.find(c => c.id === categoryId);
                if (category) {
                    let titleText = "<?= __('categories.edit_category_title') ?>";
                    modalTitle.textContent = titleText;
                    populateForm(category);
                    editingCategoryId = categoryId;
                }
            }


            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }

        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.classList.remove('opacity-100', 'visible');
            modal.querySelector('.transform').classList.add('scale-95');
            modal.querySelector('.transform').classList.remove('scale-100');
        }

        function populateForm(category) {
            document.getElementById('categoryId').value = category.id;
            document.getElementById('categoryName').value = category.name || category.naziv;
            document.getElementById('colorCode').value = category.color_code;
            document.getElementById('colorPicker').value = category.color_code;
        }

        // Form submission
        document.getElementById('categoryForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = {
                id: document.getElementById('categoryId').value || null,
                name: document.getElementById('categoryName').value,
                color_code: document.getElementById('colorCode').value,
                table: document.getElementById('categoryType').value
            };

            const url = formData.id ? `/categories/${formData.id}` : '/categories';
            const method = formData.id ? 'PUT' : 'POST';

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
                        let message = formData.id ?
                            "<?= __('categories.save_success_update') ?>" :
                            "<?= __('categories.save_success_create') ?>";

                        showNotification(message, 'success');
                        closeCategoryModal();
                        setTimeout(() => location.reload(), 1000);
                    } else {
                       message = data.message || "<?= __('categories.save_error') ?>";
                       alert(message);
                    }
                })
                .catch(error => {
                    console.error('Greška:', error);
                    alert("<?= __('categories.server_error') ?>");
                });
        });

        // Delete modal functions
        function openDeleteModal(categoryId, categoryType) {
            const category = categories.find(c => c.id === categoryId);
            if (category) {
                document.getElementById('deleteCategoryName').textContent = category.name || category.naziv;
                deleteCategoryId = categoryId;
                deleteCategoryType = categoryType;

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
            deleteCategoryId = null;
            deleteCategoryType = null;
        }

        function confirmDelete() {
            if (deleteCategoryId && deleteCategoryType) {
                fetch(`/categories/${deleteCategoryId}?type=${deleteCategoryType}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("<?= __('categories.error_delete') ?>");
                    }
                    return response.json();
                })
                .then(data => {
                    let successMessage = "<?= __('categories.deleted_success') ?>";
                    showNotification(successMessage, 'success');
                    closeDeleteModal();
                    setTimeout(() => location.reload(), 1000);
                })
                .catch(error => {
                    let errorMsg = "<?= __('categories.error_prefix') ?>" + error.message;
                    showNotification(errorMsg, 'error');
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
                closeCategoryModal();
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>