<!-- Events Section -->
<div class="content-card p-4 rounded-lg border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-base font-semibold text-gray-800">
            <?= __('events.upcoming_in_library') ?>
        </h3>
        <a href="/kontrolna-tabla/dogadjaji" class="text-primary-600 hover:text-primary-800 flex items-center text-sm">
            <span><?= __('events.view_all') ?></span>
            <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
    </div>

    <div class="space-y-3 max-h-72 overflow-y-auto pr-1">
        <?php if (!empty($events) && is_iterable($events)): ?>
            <?php foreach ($events as $event):
                $eventType = strtolower($event->naziv ?? '');
                $borderColor = $event->color_code ?? 'primary-500';
                $eventUrl = "/sadrzaj?id={$event->id}&tip={$event->type}";
                ?>
                <div
                    class="bg-white p-3 rounded-md shadow-sm border border-gray-100 hover:shadow-md transition-all duration-150">
                    <div class="flex justify-between items-start">
                        <h4 class="text-sm font-semibold text-gray-800 leading-snug">
                            <?php echo htmlspecialchars($event->title ?? ''); ?>
                        </h4>
                        <span
                            class="text-[10px] px-2 py-0.5 rounded-full bg-<?php echo htmlspecialchars($borderColor); ?> bg-opacity-10 text-<?php echo htmlspecialchars($borderColor); ?>">
                            <?php echo ucfirst(htmlspecialchars($eventType)); ?>
                        </span>
                    </div>

                    <div class="flex items-center text-xs text-gray-600 mt-2">
                        <i class="far fa-calendar-alt mr-1"></i>
                        <span><?php echo !empty($event->datum) ? date('d.m.Y.', strtotime($event->datum)) : ''; ?></span>
                        <span class="mx-1">•</span>
                        <i class="far fa-clock mr-1"></i>
                        <span><?php echo htmlspecialchars($event->time ?? ''); ?></span>
                    </div>

                    <?php if (!empty($event->location)): ?>
                        <div class="flex items-center text-xs text-gray-600 mt-1">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span class="truncate"><?php echo htmlspecialchars($event->location); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($event->description)): ?>
                        <div class="mt-2 text-xs text-gray-700 line-clamp-2 leading-snug">
                            <?php echo htmlspecialchars($event->description); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-2 flex justify-end">
                        <a href="<?php echo htmlspecialchars($eventUrl); ?>"
                            class="text-xs font-medium text-primary-600 hover:text-primary-800 flex items-center transition-all">
                            <span><?= __('events.info') ?></span>
                            <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 text-xs">Nema zakazanih događaja.</p>
        <?php endif; ?>
    </div>

    <button id="newEventButton"
        class="mt-4 w-full py-2 bg-white border border-primary-600 text-primary-600 hover:bg-primary-50 hover:text-primary-800 rounded-md flex items-center justify-center text-sm font-medium transition-all">
        <i class="fas fa-plus mr-1 text-xs"></i>
        <span><?= __('events.add_event') ?></span>
    </button>
</div>