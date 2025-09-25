<?php

namespace App\Admin\PageBuilders;


class EventsPageBuilder extends BasePageBuilder
{
    protected string $css = <<<CSS
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .page-item {
            margin: 0 0.25rem;
        }

        .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #d4a373;
            color: #344e41;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: #d4a373;
            color: white;
        }

        .page-link.active {
            background-color: #d4a373;
            color: white;
            border-color: #d4a373;
        }

        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
        }
    CSS;

    protected string $html = <<<'HTML'
 <main class="flex-1">
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
        <section class="relative min-h-screen flex items-center w-full overflow-hidden pt-16 hero-gradient">
            <section id="events" class="w-full py-20">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-[#344e41] mb-6 relative inline-block">
                            Događaji
                            <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#d4a373] to-[#bc6c25]"></span>
                        </h2>
                        <p class="text-lg text-[#344e41]/80 max-w-2xl mx-auto mt-4">
                            Istražite našu bogatu ponudu kulturnih događaja
                        </p>
                    </div>
    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($events as $event): ?>
                            <div class="event-card bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 h-full flex flex-col">
                                <div class="h-48 relative">
                                    <img alt="Event image"
                                        src="<?= htmlspecialchars($event['image'] ?? 'default.jpg') ?>"
                                        class="w-full h-full object-cover">
                                    <div class="category-badge bg-[#d4a373]/80 text-white">
                                        <?= htmlspecialchars($event['naziv'] ?? 'Događaj') ?>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex items-center mb-3">
                                        <div class="w-10 h-10 rounded-full bg-[#d4a373] flex items-center justify-center text-white mr-3">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <span class="text-[#d4a373] font-bold">Koncert</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-[#344e41] mb-2">
                                        <?= htmlspecialchars($event['title']) ?>
                                    </h3>
                                    <p class="text-[#344e41]/80 mb-4 flex-1">
                                        <?= htmlspecialchars($event['description']) ?>
                                    </p>
                                    <div class="flex justify-between items-center mt-auto">
                                        <div>
                                            <div class="flex items-center text-sm text-[#344e41]/70 mb-2">
                                                <i class="fas fa-clock mr-2"></i>
                                                <span>15.07.2023. | 20:00</span>
                                            </div>
                                            <div class="flex items-center text-sm text-[#344e41]/70">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span>Stari Grad, Trg Sv. Marka</span>
                                            </div>
                                        </div>
                                        <a href="#" class="text-[#d4a373] hover:text-[#bc6c25] transition-colors">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
    
                    <?php if ($totalPages > 1): ?>
                        <div class="pagination-container">
                            <ul class="pagination">
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $page <= 1 ? 'disabled' : '' ?>" href="?page=<?= $page - 1 ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <?php
                                $start = max(1, $page - 2);
                                $end = min($totalPages, $page + 2);
                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                    if ($start > 2) {
                                        echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                    }
                                }
                                for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item">
                                        <a class="page-link <?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>">
                                            <?= $i ?>
                                        </a>
                                    </li>
                                <?php endfor;
                                if ($end < $totalPages) {
                                    if ($end < $totalPages - 1) {
                                        echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
                                }
                                ?>
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $page >= $totalPages ? 'disabled' : '' ?>" href="?page=<?= $page + 1 ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
        use App\Models\Event;

        $limit = 6;
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * $limit;

        [$events, $totalCount] = (new Event())->all(
            limit: $limit,
            offset: $offset,
            lang: $locale
        );
        $totalPages = (int) ceil($totalCount / $limit);

        PHP;
        $content = $this->getHeader($this->css, $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}