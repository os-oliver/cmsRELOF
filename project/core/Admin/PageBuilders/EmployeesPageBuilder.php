<?php

namespace App\Admin\PageBuilders;

use App\Models\Employee;
use App\Controllers\AuthController;

class EmployeesPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="flex-grow pt-24 bg-background">
    <div class="container mx-auto px-4 py-12 text-secondary_text font-body">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 text-primary_text font-heading">Naš tim</h1>
            <p class="text-lg max-w-2xl mx-auto">
                Upoznajte članove našeg tima koji svakodnevno rade na unapređenju naše organizacije
            </p>
        </div>

        <form method="GET" class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        placeholder="Pretraži zaposlene..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>
                <button type="submit" class="bg-primary hover:bg-primary_hover text-white px-6 py-3 rounded-lg transition">
                    Primena
                </button>
            </div>
        </form>

        <?php if (count($employees) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($employees as $employee): ?>
                    <div class="bg-surface rounded-xl shadow-md overflow-hidden card-hover fade-in" 
                             data-employee-id="<?= htmlspecialchars($employee['id'] ?? '', ENT_QUOTES) ?>">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="initials-avatar bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-xl font-bold flex-shrink-0">
                                        <?= mb_substr($employee['name'], 0, 1, 'UTF-8') . mb_substr($employee['surname'], 0, 1, 'UTF-8') ?>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-primary_text">
                                            <?= htmlspecialchars($employee['name'] . ' ' . $employee['surname'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                        </h3>
                                        <p class="font-medium text-secondary_text">
                                            <?= htmlspecialchars($employee['position'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                        </p>
                                    </div>
                                </div>
                                <button type="button" 
                                        class="show-more-details text-primary hover:text-primary_hover transition p-2 rounded-full"
                                        aria-label="Prikaži više detalja"
                                        data-employee-id="<?= htmlspecialchars($employee['id'] ?? '', ENT_QUOTES) ?>"
                                        data-employee-name="<?= htmlspecialchars($employee['name'] . ' ' . $employee['surname'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                        data-employee-biography="<?= htmlspecialchars($employee['biography'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                        data-employee-email="<?= htmlspecialchars($employee['email'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                        data-employee-position="<?= htmlspecialchars($employee['position'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                                        >
                                    <i class="fas fa-eye text-2xl"></i>
                                </button>
                            </div>

                            <div class="border-t border-secondary pt-4 space-y-3">
                                <?php if (!empty($employee['email'])): ?>
                                <p class="flex items-center">
                                    <i class="fas fa-envelope mr-3 text-primary"></i>
                                    <a href="mailto:<?= htmlspecialchars($employee['email'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" class="text-gray-700 hover:text-primary transition truncate">
                                        <?= htmlspecialchars($employee['email'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                    </a>
                                </p>
                                <?php endif; ?>
                                <div class="text-gray-600 line-clamp-3">
                                    <p>
                                        <?= isset($employee['biography']) ? htmlspecialchars($employee['biography']) : 'Nema dostupne biografije.' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-12 flex justify-center items-center space-x-4">
                <?php if ($page > 1): ?>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
                       class="px-5 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                        <i class="fas fa-chevron-left mr-2"></i> Prethodna
                    </a>
                <?php endif; ?>

                <div class="flex space-x-2">
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    for ($i = $startPage; $i <= $endPage; $i++):
                    ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                           class="w-10 h-10 flex items-center justify-center rounded-lg <?= $i == $page ? 'bg-secondary text-white' : 'bg-white hover:bg-gray-100' ?> shadow">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <?php if ($page < $totalPages): ?>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
                       class="px-5 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                        Sledeća <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-users text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-primary text-primary_text mb-4">Nema pronađenih zaposlenih</h3>
                <p class="mb-6">
                    Promenite parametre pretrage ili proverite kasnije.
                </p>
                <a href="?" class="px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary_hover transition">
                    Resetuj pretragu
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<div id="employee-details-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center p-4">
    <div class="bg-white rounded-xl p-8 max-w-lg w-full m-4 shadow-2xl">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 id="modal-employee-name" class="text-2xl font-bold text-primary_text">Detalji zaposlenog</h2>
            <button id="close-modal" class="text-gray-500 hover:text-gray-800 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="space-y-3 mb-6">
            <p><strong class="text-primary_text">Pozicija:</strong> <span id="modal-employee-position"></span></p>
            <p id="modal-email-container"><strong class="text-primary_text">E-pošta:</strong> <a id="modal-employee-email" href="" class="text-primary hover:underline"></a></p>
        </div>

        <h3 class="text-lg font-semibold text-primary_text mb-2">Biografija:</h3>
        
        <div id="modal-employee-biography-wrapper" class="max-h-96 overflow-y-auto pr-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
             <p id="modal-employee-biography" class="text-gray-700 whitespace-pre-wrap"></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('employee-details-modal');
    const closeModalButton = document.getElementById('close-modal');
    const moreDetailsButtons = document.querySelectorAll('.show-more-details');
    const emailContainer = document.getElementById('modal-email-container'); // Novi element

    function openModal(employee) {
        document.getElementById('modal-employee-name').textContent = employee.name;
        document.getElementById('modal-employee-position').textContent = employee.position;
        
        const email = employee.email.trim();
        const emailLink = document.getElementById('modal-employee-email');
        
        // **USLOVNA LOGIKA ZA MODAL**
        if (email !== '') {
            emailContainer.classList.remove('hidden'); // Prikazuje e-poštu
            emailLink.textContent = email;
            emailLink.href = 'mailto:' + email;
        } else {
            emailContainer.classList.add('hidden'); // Sakriva e-poštu
            emailLink.textContent = '';
            emailLink.href = '';
        }
        // **KRAJ USLOVNE LOGIKE ZA MODAL**

        document.getElementById('modal-employee-biography').textContent = employee.biography;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; 
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    moreDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const employeeData = {
                id: this.dataset.employeeId,
                name: this.dataset.employeeName,
                biography: this.dataset.employeeBiography,
                email: this.dataset.employeeEmail,
                position: this.dataset.employeePosition
            };
            openModal(employeeData);
        });
    });

    closeModalButton.addEventListener('click', closeModal);

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
    use App\Models\Employee;
    use App\Controllers\AuthController;

$search = $_GET['search'] ?? '';
$limit = $_GET['limit'] ?? 12; 
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$employeeModel = new Employee();
[$employees, $totalCount] = $employeeModel->list(
    limit: $limit,
    offset: $offset,
    search: $search,
    locale: $locale
);

$totalPages = (int) ceil($totalCount / $limit);

PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }
}