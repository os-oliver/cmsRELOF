<?php
// You can calculate the score based on your data
// For now, I'll use a placeholder score - you can replace this with actual calculation
$transparencyScore = 75; // Example score from 0-100

// Calculate color and status based on score
function getTransparencyColor($score) {
    if ($score >= 80) return '#2ecc71'; // green
    if ($score >= 60) return '#ffcc00'; // yellow
    return '#e60000'; // red
}

function getTransparencyStatus($score) {
    if ($score >= 80) return 'Excellent';
    if ($score >= 60) return 'Good';
    return 'Needs work';
}

$color = getTransparencyColor($transparencyScore);
$status = getTransparencyStatus($transparencyScore);
?>

<div class="lg:col-span-1 content-card p-5 rounded-xl border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Skor Transparentnosti</h3>
        </div>
        <div class="bg-primary-100 p-2 rounded-lg">
            <i class="fas fa-chart-pie text-primary-600 text-xl"></i>
        </div>
    </div>

    <div class="flex flex-col items-center">
        <!-- Circle Progress -->
        <div class="relative w-48 h-48">
            <canvas id="transparency-chart" width="192" height="192"></canvas>
            
            <!-- Score Label -->
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="text-center">
                    <span class="text-3xl font-bold text-gray-800"><?= $transparencyScore ?></span>
                    <span class="text-sm text-gray-500 ml-1">/100</span>
                    <div class="text-xs uppercase tracking-wider mt-1 font-medium" 
                         style="color: <?= $color ?>">
                        <?= $status ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <div class="font-medium text-gray-800">Updated</div>
                    <div class="text-primary-600">Today</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing transparency chart...'); // Debug log
    
    const ctx = document.getElementById('transparency-chart');
    if (ctx) {
        console.log('Canvas element found, creating chart...'); // Debug log
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [<?= $transparencyScore ?>, <?= 100 - $transparencyScore ?>],
                    backgroundColor: ['<?= $color ?>', '#e6e6e6'],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                animation: {
                    duration: 300
                }
            }
        });
        
        console.log('Chart created successfully!'); // Debug log
    } else {
        console.error('Canvas element not found!'); // Debug log
    }
});
</script>
