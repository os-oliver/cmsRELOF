<?php

namespace App\Admin\PageBuilders;

use App\Models\Employee;
use App\Controllers\AuthController;

class EmployeesPageBuilder extends BasePageBuilder
{
    /**
     * HTML template stranice
     */
    protected string $html = <<<'HTML'
<main class="flex-grow pt-24 bg-background">
    <div class="container mx-auto px-4 py-12 text-secondary_text font-body">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 text-primary_text font-heading">Naš tim</h1>
            <p class="text-lg max-w-2xl mx-auto">
                Upoznajte članove našeg tima koji svakodnevno rade na unapređenju naše organizacije
            </p>
        </div>

        <!-- Search Form -->
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

        <!-- Employees Grid -->
        <?php if (count($employees) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($employees as $employee): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover fade-in">
                        <div class="p-6">
                            <div class="flex items-center mb-6">
                                <div class="initials-avatar bg-primary text-white rounded-full w-16 h-16 flex items-center justify-center text-xl font-bold">
                                    <?= mb_substr($employee['name'], 0, 1, 'UTF-8') . mb_substr($employee['surname'], 0, 1, 'UTF-8') ?>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-primary_text">
                                        <?= htmlspecialchars($employee['name'] . ' ' . $employee['surname'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                    </h3>
                                    <p class="font-medium">
                                        <?= htmlspecialchars($employee['position'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                    </p>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 pt-4">
                                <p class="text-gray-600 line-clamp-3">
                                    <?= htmlspecialchars($employee['biography']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
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
HTML;

    /**
     * Generiše i vraća kompletan sadržaj stranice za zaposlene
     */
    public function buildPage(): string
    {
        // PHP kod koji se izvršava pre HTML template-a
        $additionalPHP = <<<'PHP'
    use App\Models\Employee;
    use App\Controllers\AuthController;

// Parametri iz GET
$search = $_GET['search'] ?? '';
$limit = $_GET['limit'] ?? 3;
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