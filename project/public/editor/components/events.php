<div class="content-card p-5 rounded-xl border-2 border-gray-100 shadow-sm bg-gradient-to-br from-white to-gray-50">

    <div class="flex justify-between items-center mb-5 pb-3 border-b-2 border-gray-100">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                <i class="fas fa-newspaper text-primary-600 text-lg"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">
                <?= __('news.latest_from_library') ?>
            </h3>
        </div>
        <a href="/kontrolna-tabla/Vesti"
            class="text-primary-600 hover:text-primary-800 flex items-center text-sm font-semibold hover:gap-2 transition-all group">
            <span><?= __('news.view_all') ?></span>
            <i class="fas fa-chevron-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <!-- Scrollable container, now a vertical flex column (gap-3 for compactness) -->
    <div
        class="flex flex-col gap-3 max-h-[18rem] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        <?php if (!empty($news) && is_iterable($news)): ?>
            <?php foreach ($news as $item):
                $category = htmlspecialchars($item->naziv ?? '');
                $date = !empty($item->datum) ? date('d/m/Y', strtotime($item->datum)) : '';
                $author = htmlspecialchars($item->autor ?? 'Nepoznat autor');
                $desc = htmlspecialchars($item->opis ?? '');
                $url = !empty($item->link) ? htmlspecialchars($item->link) : "/sadrzaj?id={$item->id}&tip=vesti";
                ?>
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg border-2 border-primary-200 transition-all duration-300 hover:-translate-y-0.5 flex flex-col p-3 cursor-pointer">

                    <!-- Content (Title, Category, Description) -->
                    <a href="<?= $url ?>" class="block text-gray-800 hover:text-primary-600 focus:outline-none">

                        <div class="flex justify-between items-start mb-2">
                            <!-- Title (Smaller text-sm) -->
                            <h4 class="text-sm font-bold line-clamp-2 pr-4 leading-snug">
                                <?= htmlspecialchars($item->naslov ?? '') ?>
                            </h4>

                            <!-- Category Badge (Smaller text-[9px] and compact) -->
                            <span
                                class="flex-shrink-0 bg-primary-600 text-white text-[9px] px-2 py-0.5 rounded-full font-semibold uppercase">
                                <?= $category ?>
                            </span>
                        </div>

                        <!-- Description (Smallest text-xs) -->
                        <p class="text-xs text-gray-600 line-clamp-3 leading-snug mb-3"><?= $desc ?></p>
                    </a>

                    <!-- Metadata Footer (Very compact and subtle) -->
                    <div class="flex justify-between items-center text-[10px] text-gray-500 border-t pt-2 mt-auto">
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center gap-1">
                                <i class="far fa-calendar text-primary-500"></i> <?= $date ?>
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="far fa-user text-primary-500"></i> <?= $author ?>
                            </span>
                        </div>

                        <!-- Read More Link (More subtle) -->
                        <a href="<?= $url ?>"
                            class="text-xs font-semibold text-primary-600 hover:text-primary-800 flex items-center transition-all group">
                            <span><?= __('news.read_more') ?></span>
                            <i class="fas fa-chevron-right ml-1 text-[9px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-10">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">Trenutno nema objavljenih vesti.</p>
            </div>
        <?php endif; ?>
    </div>

    <button id="newNewsButton"
        class="mt-6 w-full py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-lg flex items-center justify-center text-sm font-bold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <i class="fas fa-plus mr-2 text-sm"></i>
        <span><?= __('news.add_news') ?></span>
    </button>
</div>
