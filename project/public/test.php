<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .modal-input {
            @apply w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
        }

        .modal-label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }

        .modal-button {
            @apply px-4 py-2 text-sm font-medium rounded-md transition-colors;
        }

        .primary-button {
            @apply modal-button bg-blue-600 text-white hover:bg-blue-700;
        }

        .secondary-button {
            @apply modal-button bg-white text-gray-700 border border-gray-300 hover:bg-gray-50;
        }
    </style>
    <title>Event Form Demo</title>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <?php

    use App\Utils\ModalGenerator;

    // Example with modern form fields and descriptions
    $newsConfig = [
        'title' => 'objekat',
        'method' => 'POST',
        'endpoint' => '/document',
        'fields' => [
            ['name' => 'slikaObjekta', 'type' => 'file', 'label' => 'izaberi sliku', 'required' => true],
            ['name' => 'nazivObjekta', 'type' => 'text', 'label' => 'Naziv objekta', 'required' => true, 'readonly' => true],
            ['name' => 'vaspitac', 'type' => 'text', 'label' => 'Deskripcija vrtica'],
            ['name' => 'description', 'type' => 'textarea', 'label' => 'Glavni Vaspitac'],
            ['name' => 'lokacija', 'type' => 'textarea', 'label' => 'lokacija'],

        ]
    ];



    $newsModal = new ModalGenerator($newsConfig, 'newsModal');
    echo $newsModal->render();
    ?>
</body>


</html>