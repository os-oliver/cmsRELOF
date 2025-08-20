<?php
use App\Controllers\AuthController;
use App\Models\AboutUs;
use App\Models\Employee;
use App\Models\TeamMember; // New model for team members

if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// Get about us data
$dataAboutUS = new AboutUs();
$aboutUsData = $dataAboutUS->list();

// Get team members
// Get parameters from _GET
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'name_asc';
// Pagination settings
$limit = $_GET['limit'] ?? 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$employeeModel = new Employee();

// Fetch employees with pagination and filters
[$teamMembers, $totalCount] = $employeeModel->list(
    limit: $limit,
    offset: $offset,
    search: $search,
);
$totalPages = (int) ceil($totalCount / $limit);

?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php switch ($locale) {
            case 'sr': echo 'O nama - Administracija'; break;
            case 'en': echo 'About Us - Administration'; break;
            default: echo 'О нама - Администрација'; break;
        } ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        };
    </script>
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(209, 213, 219, 0.5);
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(127, 167, 207, 0.8);
            transform: translateX(4px);
            color: white;
        }

        .stat-card {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .content-card {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .action-card:hover {
            transform: scale(1.05);
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                z-index: 40;
                height: 100vh;
            }

            .sidebar.active {
                transform: translateX(0);
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
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-700 font-sans">
    <!-- Mobile Overlay -->
    <div class="overlay" id="overlay"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <?php
        $activeTab = 'aboutus';
        require_once __DIR__ . "/../components/sidebar.php"
            ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <?php require_once __DIR__ . "/../components/topBar.php" ?>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Goal and Mission Section -->
                <div class="grid  grid-cols-1 gap-6 mb-8">
                    <!-- Goal and Mission Column -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Goal -->
                        <div class="glass-panel rounded-2xl p-6">
                            <label for="cilj" class="block text-sm font-medium text-gray-700 mb-2">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Cilj'; break;
                                    case 'en': echo 'Goal'; break;
                                    default: echo 'Циљ'; break;
                                } ?>
                            </label>
                            <textarea id="cilj" rows="4"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-3 shadow-sm placeholder-gray-400 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all"
                                placeholder="<?php
                                    switch ($locale) {
                                        case 'sr': echo 'Unesite cilj...'; break;
                                        case 'en': echo 'Enter goal...'; break;
                                        default: echo 'Унесите циљ...'; break;
                                    }
                                ?>"
                            ><?= htmlspecialchars($aboutUsData['goal'] ?? '') ?></textarea>
                            <button id="goal"
                                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all shadow">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Sačuvaj cilj'; break;
                                    case 'en': echo 'Save goal'; break;
                                    default: echo 'Сачувај циљ'; break;
                                } ?>
                            </button>
                        </div>

                        <!-- Mission -->
                        <div class="glass-panel rounded-2xl p-6">
                            <label for="misija" class="block text-sm font-medium text-gray-700 mb-2">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Misija'; break;
                                    case 'en': echo 'Mission'; break;
                                    default: echo 'Мисија'; break;
                                } ?>
                            </label>
                            <textarea id="misija" rows="4"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-3 shadow-sm placeholder-gray-400 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all"
                                placeholder="<?php
                                    switch ($locale) {
                                        case 'sr': echo 'Unesite misiju...'; break;
                                        case 'en': echo 'Enter mission...'; break;
                                        default: echo 'Унесите мисију...'; break;
                                    }
                                ?>"
                            ><?= htmlspecialchars($aboutUsData['mission'] ?? '') ?></textarea>
                            <button id="mission"
                                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all shadow">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Sačuvaj misiju'; break;
                                    case 'en': echo 'Save mission'; break;
                                    default: echo 'Сачувај мисију'; break;
                                } ?>
                            </button>
                        </div>
                    </div>

                    
                    <!-- Team Members Column -->
                    <div class="glass-panel rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Zaposleni'; break;
                                    case 'en': echo 'Employees'; break;
                                    default: echo 'Запослени'; break;
                                } ?></h2>
                            <button id="addTeamMemberBtn"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                                <i class="fas fa-plus mr-2"></i>
                                <?php switch ($locale) {
                                    case 'sr': echo 'Dodaj člana'; break;
                                    case 'en': echo 'Add member'; break;
                                    default: echo 'Додај члана'; break;
                                } ?>
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Ime'; break;
                                                case 'en': echo 'First Name'; break;
                                                default: echo 'Име'; break;
                                            } ?>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Prezime'; break;
                                                case 'en': echo 'Last Name'; break;
                                                default: echo 'Презиме'; break;
                                            } ?>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Pozicija'; break;
                                                case 'en': echo 'Position'; break;
                                                default: echo 'Позиција'; break;
                                            } ?>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Akcije'; break;
                                                case 'en': echo 'Actions'; break;
                                                default: echo 'Акције'; break;
                                            } ?>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($teamMembers as $member): ?>
                                        <tr class="hover:bg-gray-50" data-id="<?= $member['id'] ?>">
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                <?= htmlspecialchars($member['name']) ?>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                <?= htmlspecialchars($member['surname']) ?>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                <?= htmlspecialchars($member['position']) ?>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex space-x-2">
                                                    <button
                                                        class="edit-member p-2 text-blue-600 hover:bg-blue-50 rounded-lg"
                                                        data-id="<?= $member['id'] ?>"
                                                        data-name="<?= htmlspecialchars($member['name']) ?>"
                                                        data-surname="<?= htmlspecialchars($member['surname']) ?>"
                                                        data-position="<?= htmlspecialchars($member['position']) ?>"
                                                        data-biography="<?= htmlspecialchars($member['biography']) ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        class="delete-member p-2 text-red-600 hover:bg-red-50 rounded-lg"
                                                        data-id="<?= $member['id'] ?>">
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
                    <div
                        class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                        <div class="hidden md:block text-sm text-gray-700">
                            <?php switch ($locale) {
                                case 'sr': echo 'Prikazano'; break;
                                case 'en': echo 'Showing'; break;
                                default: echo 'Приказано'; break;
                            } ?>
                            <span class="font-medium"><?= count($teamMembers) ?></span>
                            <?php switch ($locale) {
                                case 'sr': echo 'od'; break;
                                case 'en': echo 'of'; break;
                                default: echo 'од'; break;
                            } ?>
                            <span class="font-medium"><?= $totalCount ?></span>
                            <?php switch ($locale) {
                                case 'sr': echo 'kontakata'; break;
                                case 'en': echo 'contacts'; break;
                                default: echo 'контаката'; break;
                            } ?>
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
            </main>
        </div>
    </div>

    <!-- Team Member Modal -->
    <div id="teamMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">
                    <?php switch ($locale) {
                        case 'sr': echo 'Dodaj novog člana tima'; break;
                        case 'en': echo 'Add new team member'; break;
                        default: echo 'Додај новог члана тима'; break;
                    } ?>
                </h3>
            </div>
            <form id="teamMemberForm" class="p-6">
                <input type="hidden" id="memberId" name="id" value="">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php switch ($locale) {
                            case 'sr': echo 'Ime'; break;
                            case 'en': echo 'First Name'; break;
                            default: echo 'Име'; break;
                        } ?>
                    </label>
                    <input type="text" id="name" name="name" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all">
                </div>

                <div class="mb-4">
                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php switch ($locale) {
                            case 'sr': echo 'Prezime'; break;
                            case 'en': echo 'Last Name'; break;
                            default: echo 'Презиме'; break;
                        } ?>
                    </label>
                    <input type="text" id="surname" name="surname" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all">
                </div>

                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php switch ($locale) {
                            case 'sr': echo 'Pozicija'; break;
                            case 'en': echo 'Position'; break;
                            default: echo 'Позиција'; break;
                        } ?>
                    </label>
                    <input type="text" id="position" name="position" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all">
                </div>

                <div class="mb-6">
                    <label for="biography" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php switch ($locale) {
                            case 'sr': echo 'Biografija'; break;
                            case 'en': echo 'Biography'; break;
                            default: echo 'Биографија'; break;
                        } ?>
                    </label>
                    <textarea id="biography" name="biography" rows="4"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-all"></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" id="cancelMemberBtn"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        <?php switch ($locale) {
                            case 'sr': echo 'Otkaži'; break;
                            case 'en': echo 'Cancel'; break;
                            default: echo 'Откажи'; break;
                        } ?>
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow">
                        <?php switch ($locale) {
                            case 'sr': echo 'Sačuvaj'; break;
                            case 'en': echo 'Save'; break;
                            default: echo 'Сачувај'; break;
                        } ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        <?php
        switch ($locale) {
            case 'sr': // latinica
                $emptyGoal = 'Polje Cilj ne može biti prazno.';
                $savedGoal = 'Cilj uspešno sačuvan!';
                $saveError = 'Greška pri čuvanju: ';
                $consoleError = 'Greška:';
                $emptyMission = 'Polje Misija ne može biti prazno.';
                $saveSuccess = 'Misija uspešno sačuvana!';
                $addMemberTitle = 'Dodaj novog člana tima';
                $editMemberTitle = 'Uredi člana tima';
                $confirmDelete = 'Da li ste sigurni da želite da obrišete ovog člana tima?';
                $successDelete = 'Član tima uspešno obrisan!';
                $errorDelete = 'Greška pri brisanju';
                $requiredFieldsMsg = 'Ime, prezime i pozicija su obavezna polja';
                $saveSuccessMsg = 'Član tima uspešno sačuvan!';
                break;
            case 'en': // engleski
                $emptyGoal = 'Goal field cannot be empty.';
                $savedGoal = 'Goal saved successfully!';
                $saveError = 'Error while saving: ';
                $consoleError = 'Error:';
                $emptyMission = 'Mission field cannot be empty.';
                $saveSuccess = 'Mission saved successfully!';
                $addMemberTitle = 'Add new team member';
                $editMemberTitle = 'Edit team member';
                $confirmDelete = 'Are you sure you want to delete this team member?';
                $successDelete = 'Team member successfully deleted!';
                $errorDelete = 'Error while deleting';
                $requiredFieldsMsg = 'Name, surname and position are required fields';
                $saveSuccessMsg = 'Team member saved successfully!';
                break;
            default: // ćirilica
                $emptyGoal = 'Поље Циљ не може бити празно.';
                $savedGoal = 'Циљ успешно сачуван!';
                $saveError = 'Грешка при чувању: ';
                $consoleError = 'Грешка:';
                $emptyMission = 'Поље Мисија не може бити празно.';
                $saveSuccess = 'Мисија успешно сачувана!';
                $addMemberTitle = 'Додај новог члана тима';
                $editMemberTitle = 'Уреди члана тима';
                $confirmDelete = 'Да ли сте сигурни да желите да обришете овог члана тима?';
                $successDelete = 'Члан тима успешно обрисан!';
                $errorDelete = 'Грешка при брисању';
                $requiredFieldsMsg = 'Име, презиме и позиција су обавезна поља';
                $saveSuccessMsg = 'Члан тима успешно сачуван!';
                break;
        }
        ?>

        document.addEventListener('DOMContentLoaded', () => {
            // Goal and mission saving
            document.getElementById('goal').addEventListener('click', async () => {
                const goal = document.getElementById('cilj').value.trim();
                if (!goal) return alert("<?= $emptyGoal ?>");

                try {
                    const response = await fetch('/aboutus/1', {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ goal })
                    });

                    if (!response.ok) throw new Error("<?= $saveError ?>" + response.statusText);
                    alert("<?= $savedGoal ?>");
                } catch (e) {
                    console.error("<?= $consoleError ?>", e);
                    alert("<?= $saveError ?>" + e.message);
                }
            });

            document.getElementById('mission').addEventListener('click', async () => {
                const mission = document.getElementById('misija').value.trim();
                if (!mission) return alert('<?= $emptyMission ?>');

                try {
                    const response = await fetch('/aboutus/1', {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ mission })
                    });

                    if (!response.ok) throw new Error('<?= $saveError ?>');
                    alert('<?= $saveSuccess ?>');
                } catch (e) {
                    console.error('<?= $consoleError ?>', e);
                    alert('<?= $saveError ?>: ' + e.message);
                }
            });

            // Team member modal handling
            const modal = document.getElementById('teamMemberModal');
            const modalTitle = document.getElementById('modalTitle');
            const memberForm = document.getElementById('teamMemberForm');
            const addBtn = document.getElementById('addTeamMemberBtn');
            const cancelBtn = document.getElementById('cancelMemberBtn');

            // Open modal for adding new member
            addBtn.addEventListener('click', () => {
                modalTitle.textContent = '<?= $addMemberTitle ?>';
                memberForm.reset();
                document.getElementById('memberId').value = '';
                modal.classList.remove('hidden');
            });

            // Open modal for editing existing member
            document.querySelectorAll('.edit-member').forEach(btn => {
                btn.addEventListener('click', () => {
                    modalTitle.textContent = '<?= $editMemberTitle ?>';
                    document.getElementById('memberId').value = btn.dataset.id;
                    document.getElementById('name').value = btn.dataset.name;
                    document.getElementById('surname').value = btn.dataset.surname;
                    document.getElementById('position').value = btn.dataset.position;
                    document.getElementById('biography').value = btn.dataset.biography;
                    modal.classList.remove('hidden');
                });
            });

            // Delete member
            document.querySelectorAll('.delete-member').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.dataset.id;
                    if (!confirm('<?= $confirmDelete ?>')) return;

                    try {
                        const response = await fetch(`/employees/${id}`, {
                            method: 'DELETE'
                        });

                        if (!response.ok) throw new Error('<?= $errorDelete ?>');
                        alert('<?= $successDelete ?>');
                        location.reload();
                    } catch (e) {
                        console.error('<?= $consoleError ?>', e);
                        alert('<?= $errorDelete ?>: ' + e.message);
                    }
                });
            });

            // Close modal
            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Form submission
            memberForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const id = document.getElementById('memberId').value;
                const formData = {
                    name: document.getElementById('name').value.trim(),
                    surname: document.getElementById('surname').value.trim(),
                    position: document.getElementById('position').value.trim(),
                    biography: document.getElementById('biography').value.trim()
                };

                // Validation
                if (!formData.name || !formData.surname || !formData.position) {
                    return alert('<?= $requiredFieldsMsg ?>');
                }

                try {
                    const url = id ? `/employees/${id}` : '/employees';
                    const method = id ? 'PUT' : 'POST';

                    const response = await fetch(url, {
                        method,
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) throw new Error('<?= $saveError ?>');
                    alert('<?= $saveSuccessMsg ?>');
                    modal.classList.add('hidden');
                    location.reload();
                } catch (e) {
                    console.error('<?= $consoleError ?>', e);
                    alert('<?= $saveError ?> ' + e.message);
                }
            });
        });
    </script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>

</body>

</html>