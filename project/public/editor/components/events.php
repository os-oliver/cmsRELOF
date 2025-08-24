<?php
    if (isset($_GET['locale'])) {
        $_SESSION['locale'] = $_GET['locale'];
    }
    $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
?>

<!-- Events Section -->
<div class=" content-card p-5 rounded-xl border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">
            <?php
                switch ($locale) {
                    case 'sr': echo 'Predstojeći događaji u biblioteci'; break;
                    case 'en': echo 'Upcoming events in the library'; break;
                    default: echo 'Предстојећи догађаји у библиотеци'; break;
                }
            ?></h3>
        <a href="/dashboard/dogadjaji" class="text-primary-600 hover:text-primary-800 flex items-center">
            <span>
                <?php
                    switch ($locale) {
                        case 'sr': echo 'Pogledaj sve'; break;
                        case 'en': echo 'View all'; break;
                        default: echo 'Погледај све'; break;
                    }
                ?>
            </span>
            <i class="fas fa-chevron-right ml-1 text-sm"></i>
        </a>
    </div>

    <div class="space-y-4 max-h-80 overflow-y-auto">
        <?php foreach ($events as $event):
            $eventType = strtolower($event['naziv']);
            $borderColor = $event['color_code'] ?? 'primary-500';
            ?>
            <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-<?php echo $borderColor; ?>">
                <div class="flex justify-between items-start">
                    <h4 class="font-medium text-gray-800"><?php echo htmlspecialchars($event['title']); ?></h4>
                    <span
                        class="text-xs px-2 py-1 rounded-full bg-<?php echo $borderColor; ?> bg-opacity-10 text-<?php echo $borderColor; ?>">
                        <?php echo ucfirst($eventType); ?>
                    </span>
                </div>

                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="far fa-clock mr-2"></i>
                    <span><?php echo date('d.m.Y.', strtotime($event['date'])); ?> u
                        <?php echo htmlspecialchars($event['time']); ?></span>
                </div>

                <?php if (!empty($event['location'])): ?>
                    <div class="flex items-center text-sm text-gray-600 mt-1">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span><?php echo htmlspecialchars($event['location']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($event['description'])): ?>
                    <div class="mt-3 text-sm text-gray-600">
                        <p><?php echo htmlspecialchars($event['description']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="mt-3 flex justify-end">
                    <button class="text-xs text-primary-600 hover:text-primary-800 flex items-center">
                        <span>Više informacija</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button id="newEventButton"
        class="mt-6 w-full py-3 bg-white border border-primary-600 text-primary-600 hover:bg-primary-50 hover:text-primary-800 rounded-lg flex items-center justify-center font-medium transition-all">
        <i class="fas fa-plus mr-2"></i>
        <span>
            <?php
                switch ($locale) {
                    case 'sr': echo 'Dodaj događaj'; break;
                    case 'en': echo 'Add event'; break;
                    default: echo 'Додај догађај'; break;
                }
            ?>
        </span>
    </button>
</div>