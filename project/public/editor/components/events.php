<!-- Events Section -->
<div class="content-card p-5 rounded-xl border-2 border-gray-100 shadow-sm bg-gradient-to-br from-white to-gray-50">
    <div class="flex justify-between items-center mb-5 pb-3 border-b-2 border-gray-100">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                <i class="fas fa-calendar-alt text-primary-600 text-lg"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">
                <?= __('events.upcoming_in_library') ?>
            </h3>
        </div>
        <a href="/kontrolna-tabla/dogadjaji"
            class="text-primary-600 hover:text-primary-800 flex items-center text-sm font-semibold hover:gap-2 transition-all group">
            <span><?= __('events.view_all') ?></span>
            <i class="fas fa-chevron-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <div
        class="space-y-3 max-h-72 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        <?php if (!empty($events) && is_iterable($events)): ?>
            <?php foreach ($events as $event):
                $eventType = strtolower($event->naziv ?? '');
                $borderColor = $event->color_code ?? 'primary-500';
                $eventUrl = "/sadrzaj?id={$event->id}&tip={$event->type}";
                ?>
                <div
                    class="bg-white p-3 rounded-lg border-l-4 border-<?php echo htmlspecialchars($borderColor); ?> shadow-md hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5">
                    <div class="flex justify-between items-start gap-2 mb-2">
                        <h4 class="text-sm font-bold text-gray-800 leading-tight flex-1">
                            <?php echo htmlspecialchars($event->title ?? ''); ?>
                        </h4>
                        <span
                            class="text-[10px] px-2 py-0.5 rounded-full bg-<?php echo htmlspecialchars($borderColor); ?> bg-opacity-15 text-<?php echo htmlspecialchars($borderColor); ?> font-semibold border border-<?php echo htmlspecialchars($borderColor); ?> border-opacity-20 whitespace-nowrap">
                            <?php echo ucfirst(htmlspecialchars($eventType)); ?>
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-600 mb-2">
                        <div class="flex items-center">
                            <i class="far fa-calendar-alt mr-1 text-primary-500"></i>
                            <span><?php echo !empty($event->datum) ? date('d.m.Y.', strtotime($event->datum)) : ''; ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-1 text-primary-500"></i>
                            <span><?php echo htmlspecialchars($event->time ?? ''); ?></span>
                        </div>
                        <?php if (!empty($event->location)): ?>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-1 text-primary-500"></i>
                                <span class="truncate"><?php echo htmlspecialchars($event->location); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($event->description)): ?>
                        <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed mb-2">
                            <?php echo htmlspecialchars($event->description); ?>
                        </p>
                    <?php endif; ?>

                    <div class="flex justify-end">
                        <a href="<?php echo htmlspecialchars($eventUrl); ?>"
                            class="text-xs font-bold text-primary-600 hover:text-primary-800 flex items-center transition-all group">
                            <span><?= __('events.info') ?></span>
                            <i class="fas fa-chevron-right ml-1 text-[10px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-8">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">Nema zakazanih događaja.</p>
            </div>
        <?php endif; ?>
    </div>

    <button id="newEventButton"
        class="mt-4 w-full py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-lg flex items-center justify-center text-sm font-bold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <i class="fas fa-plus mr-2 text-sm"></i>
        <span><?= __('events.add_event') ?></span>
    </button>
</div>