<?php
session_start();
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
// 1. Use the Contact model and require authentication
use App\Models\Contact;
use App\Controllers\AuthController;


AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// 2. Set defaults for search and pagination
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc'; // Keep sort for newest/oldest contacts

// Pagination
$limit = 9; // Adjusted for a 3-column layout
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

// 3. Instantiate the Contact model and fetch data
$contactModal = new Contact();
[$contacts, $totalCount] = $contactModal->list(
    limit: $limit,
    offset: $offset,

);

// Calculate total pages for pagination
$totalPages = (int) ceil($totalCount / $limit);
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __("chats.chats") ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dashboard/documents.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        light: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">

    <?php // require_once __DIR__ . "/../components/contactViewer.php" ?>

    <div class="overlay" id="overlay"></div>
    <!-- Contact Details Modal -->
    <div id="contact-modal" class="fixed inset-0 hidden z-50">
        <!-- backdrop -->
        <div id="modal-backdrop" class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- modal panel -->
        <div class="relative mx-auto my-20 max-w-md bg-white rounded-2xl shadow-lg overflow-hidden" role="dialog"
            aria-modal="true">
            <!-- header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-900">
                    <?= __("chats.contact_details") ?>
                </h2>
                <button id="modal-close"
                    class="text-gray-500 hover:text-gray-900 text-2xl leading-none">&times;</button>
            </div>
            <!-- content -->
            <div class="p-6 space-y-4">
                <p><span class="font-medium">
                        <?= __("chats.name") ?>:
                    </span> <span id="modal-name"></span></p>

                <p><span class="font-medium">
                        <?= __("chats.email") ?>:
                    </span> <span id="modal-email"></span></p>

                <p><span class="font-medium">
                        <?= __("chats.phone") ?>:</span> <span id="modal-phone"></span></p>

                <p><span class="font-medium">
                        <?= __("chats.message") ?>:
                    </span></p>

                <div id="modal-message" class="whitespace-pre-wrap bg-gray-50 p-3 rounded-lg"></div>

                <p class="text-sm text-gray-500"><span class="font-medium">
                        <?= __("chats.sent") ?>:
                    </span> <span id="modal-date"></span></p>
            </div>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <?php
        $activeTab = 'chats'; // Set the active tab for the sidebar
        require_once __DIR__ . "/../components/sidebar.php"
            ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php" ?>

            <div class="overflow-y-auto container mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            <?= __("chats.contact_management") ?>
                        </h1>
                        <p class="text-light-600">
                            <?= __("chats.overview") ?>
                        </p>
                    </div>
                </div>

                <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                    <div class="flex flex-col lg:flex-row gap-4 items-center">
                        <div class="relative flex-1 w-full lg:w-auto">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                                placeholder="<?= __("chats.search") ?>"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-primary-500 focus:border-primary-500 transition">
                        </div>

                        <select name="sort"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-primary-500 focus:border-primary-500 transition">
                            <option value="date_desc" <?= $sort === 'date_desc' ? 'selected' : '' ?>>
                                <?= __("chats.newest_first") ?>
                            </option>
                            <option value="date_asc" <?= $sort === 'date_asc' ? 'selected' : '' ?>>
                                <?= __("chats.oldest_first") ?>
                            </option>
                        </select>


                        <button type="submit"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg">
                            <?= __("chats.apply") ?>
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    <?php if (empty($contacts)): ?>
                        <p class="text-center text-gray-500 col-span-full">
                            <?= __("chats.no_contacts") ?>
                        </p>
                    <?php else: ?>
                        <?php foreach ($contacts as $contact): ?>
                            <?php
                            // Format date for display
                            $date = date('j. F Y. \u\ H:i\h', strtotime($contact['created_at']));
                            ?>
                            <div class="contact-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden group relative"
                                data-id="<?= htmlspecialchars($contact['id']) ?>"
                                data-name="<?= htmlspecialchars($contact['ime'] . ' ' . $contact['prezime']) ?>"
                                data-email="<?= htmlspecialchars($contact['email']) ?>"
                                data-phone="<?= htmlspecialchars($contact['phone'] ?? '') ?>"
                                data-message="<?= htmlspecialchars($contact['poruka']) ?>"
                                data-date="<?= htmlspecialchars($contact['created_at']) ?>">

                                <div
                                    class="absolute inset-0 bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                    <div class="flex gap-6">
                                        <button
                                            class="view-contact w-20 h-20 hover:bg-white/30 text-gray-700 rounded-full flex items-center justify-center transition hover:scale-110"
                                            title="<?= __("chats.view_message") ?>">
                                            <i class="hover:text-cyan-500 fas fa-eye text-3xl"></i>
                                        </button>
                                        <button
                                            class="delete-contact w-20 h-20 hover:bg-white/30 text-gray-700 rounded-full flex items-center justify-center transition hover:scale-110"
                                            title="<?= __("chats.delete") ?>">
                                            <i class="hover:text-red-500 fas fa-trash text-3xl"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="p-6 contact-card-content h-[187px]">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-envelope-open-text text-2xl text-primary-600"></i>
                                            </div>
                                            <div>
                                                <h3
                                                    class="text-lg font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">
                                                    <?= htmlspecialchars($contact['ime'] . ' ' . $contact['prezime']) ?>
                                                </h3>
                                                <p class="text-sm text-gray-500"><?= htmlspecialchars($contact['email']) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        <?= htmlspecialchars($contact['poruka']) ?>
                                    </p>
                                </div>

                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-calendar-alt h-4 w-4"></i>
                                            <span><?= $date ?></span>
                                        </div>
                                        <span class="text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-full">
                                            <?= __("chats.new") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div
                    class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                    <div class="hidden md:block text-sm text-gray-700">
                        <div class="hidden md:block text-sm text-gray-700">
                            <?= __("chats.showing") ?>
                            <span class="font-medium"><?= count($contacts) ?></span>
                            <?= __("chats.of") ?>
                            <span class="font-medium"><?= $totalCount ?></span>
                            <?= __("chats.contacts") ?>
                        </div>
                    </div>
                    <nav class="flex items-center gap-2">
                        <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                            class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 <?= $page <= 1 ? 'pointer-events-none opacity-50' : '' ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <a href="?page=<?= $p ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                                class="px-4 py-2 rounded-lg <?= $p === $page ? 'bg-primary-600 text-white' : 'border text-gray-700 hover:bg-gray-50' ?>">
                                <?= $p ?>
                            </a>
                        <?php endfor; ?>
                        <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"
                            class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 <?= $page >= $totalPages ? 'pointer-events-none opacity-50' : '' ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.delete-contact').forEach(btn => {
            btn.addEventListener('click', async () => {
                const card = btn.closest('.contact-card');
                const id = card.dataset.id;

                if (!confirm('<?= __("chats.delete_confirm_msg") ?>')) {
                    return;
                }

                try {
                    const res = await fetch('/contact/' + id, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ id })
                    });

                    if (res.ok) {
                        // Optionally show a toast here
                        card.remove();
                    } else {
                        const err = await res.json();
                        alert('<?= __("chats.delete_error_msg") ?>' + (err.error || res.statusText));
                    }
                } catch (e) {
                    console.error(e);
                    alert('<?= __("chats.network_error_msg") ?>');
                }
            });
        });
        const modal = document.getElementById('contact-modal');
        const backdrop = document.getElementById('modal-backdrop');
        const closeBtn = document.getElementById('modal-close');
        const nameField = document.getElementById('modal-name');
        const emailField = document.getElementById('modal-email');
        const phoneField = document.getElementById('modal-phone');
        const messageField = document.getElementById('modal-message');
        const dateField = document.getElementById('modal-date');

        // Function to open modal and fill data
        function openModal(card) {
            nameField.textContent = card.dataset.name;
            emailField.textContent = card.dataset.email;
            phoneField.textContent = card.dataset.phone || '—';
            messageField.textContent = card.dataset.message;
            // format the date nicely
            const dt = new Date(card.dataset.date);
            dateField.textContent = dt.toLocaleString('sr-RS', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Close/hide modal
        function closeModal() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Attach click handlers to all “view” buttons
        document.querySelectorAll('.view-contact').forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.contact-card');
                openModal(card);
            });
        });

        // Close when clicking backdrop or close button
        backdrop.addEventListener('click', closeModal);
        closeBtn.addEventListener('click', closeModal);</script>
    <script src="/assets/js/dashboard/dashboard.js"></script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>

</body>

</html>