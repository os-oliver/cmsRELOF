<?php

use App\Controllers\TransparencyScoreController;

// Placeholder score — replace with actual calculation
$transparencyScore = (new TransparencyScoreController())->getTransparencyScore();
#$transparencyScore = 75;

// Color mapping
function getTransparencyColor($score)
{
    if ($score >= 80)
        return '#2ecc71'; // green
    if ($score >= 60)
        return '#ffcc00'; // yellow
    return '#e60000'; // red
}

function getTransparencyStatus($score)
{
    if ($score >= 80)
        return 'Excellent';
    if ($score >= 60)
        return 'Good';
    return __('transparency.score.need_more');
}

// Extra classes for Tailwind utility colors (if you want closer integration)
function getTailwindClasses($score)
{
    if ($score >= 80) {
        return ['bg' => 'bg-green-100', 'icon' => 'text-green-600', 'border' => 'border-green-500'];
    }
    if ($score >= 60) {
        return ['bg' => 'bg-yellow-100', 'icon' => 'text-yellow-600', 'border' => 'border-yellow-500'];
    }
    return ['bg' => 'bg-red-100', 'icon' => 'text-red-600', 'border' => 'border-red-500'];
}

$color = getTransparencyColor($transparencyScore);
$status = getTransparencyStatus($transparencyScore);
$tw = getTailwindClasses($transparencyScore);

?>

<div
    class="stat-card p-4 md:p-5 rounded-xl border-l-4 border-t border-r border-b bg-white transition-all duration-300 hover:shadow-lg <?= $tw['border'] ?>">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="p-3 rounded-full <?= $tw['bg'] ?>">
                <i class="fas fa-chart-pie <?= $tw['icon'] ?>"></i>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <h3 class="text-sm font-medium text-gray-700"><?php echo __('transparency.score.title'); ?></h3>
            <div class="mt-2 flex items-center">
                <div class="relative h-12 w-12">
                    <canvas id="transparency-chart" width="48" height="48"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800"><?= $transparencyScore ?></span>
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-xs uppercase font-medium" style="color: <?= $color ?>"><?= $status ?></div>
                    <div class="text-xs text-gray-500 mt-0.5"><?php echo __('transparency.score.update_age'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('transparency-chart');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [<?= $transparencyScore ?>, <?= 100 - $transparencyScore ?>],
                        backgroundColor: ['<?= $color ?>', '#e6e6e6'],
                        borderWidth: 0,
                        cutout: '72%'
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    animation: { duration: 350 }
                }
            });
        }
    });
</script>