<?php
use App\Controllers\AuthController;
AuthController::requireEditor();
?>
<!DOCTYPE html>
<html lang="sr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MD fd Builder</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="/assets/css/WebDesigner/grapes.min.css" rel="stylesheet" />

  <link href="/assets/css/WebDesigner/style.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


</head>

<body>
  <div id="app-container" class="flex h-screen overflow-hidden">
    <!-- Enhanced Sidebar -->
    <div id="toolbar"
      class="flex flex-col w-64 min-w-[16rem] bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0">
      <!-- Header -->
      <div class="header p-4 border-b border-gray-200">
        <div class="logo-container flex items-center space-x-3">
          <div class="logo w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100">
            <i class="fas fa-paint-brush text-blue-600"></i>
          </div>
          <div class="logo-text">
            <h1 class="text-lg font-bold">MD Page Builder</h1>
            <p class="text-sm text-gray-600">RELOF3</p>
          </div>
        </div>
      </div>

      <!-- Toolbar Actions -->
      <div class="toolbar-actions">
        <button id="component" class="action-btn primary">
          <i class="fas fa-shapes"></i>
        </button>
        <button id="settingsbtn" class="action-btn">
          <i class="fas fa-brush"></i>
        </button>
        <button id="navbtn" class="action-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <!-- Device Selector -->
      <div class="device-selector p-4 border-b border-gray-200">
        <div class="Devices flex justify-center space-x-4 mb-4">
          <button class="device-btn active p-2 rounded hover:bg-gray-100" data-device="desktop">
            <i class="fas fa-desktop"></i>
          </button>
          <button class="device-btn p-2 rounded hover:bg-gray-100" data-device="tablet">
            <i class="fas fa-tablet-alt"></i>
          </button>
          <button class="device-btn p-2 rounded hover:bg-gray-100" data-device="mobile">
            <i class="fas fa-mobile-alt"></i>
          </button>
        </div>
        <div class="Devices flex justify-center space-x-4">
          <button id="undo-btn" class="device-btn p-2 rounded hover:bg-gray-100">
            <i class="fas fa-undo"></i>
          </button>
          <button id="redo-btn" class="device-btn p-2 rounded hover:bg-gray-100">
            <i class="fas fa-redo"></i>
          </button>
        </div>
      </div>

      <!-- Blocks Container -->
      <div id="navBlock" style="display:none;">
        <button class="m-8 action-btn primary">
          <i class="fas fa-eye"></i> Pregled
        </button>

      </div>

      <div id="settingsBlock" class="hidden"></div>
      <div id="blocks" class="space-y-6">


      </div>

      <!-- Footer -->
      <div class="footer">
        <button id="export" class="action-btn">
          <i class="fas fa-save"></i> Sačuvaj
        </button>
        <button class="action-btn primary">
          <i class="fas fa-eye"></i> Pregled
        </button>
      </div>
    </div>

    <!-- Main Editor -->
    <div id="gjs">

    </div>

    <script src="assets/js/WebDesigner/grapesjs/grapes.min.js"></script>
    <script>
      // Wait for DOM to be fully loaded
      document.addEventListener('DOMContentLoaded', function () {
        // Function to safely apply classes with null checks
        const applyClasses = (element) => {
          if (!element) return; // Guard against null elements
          // Your class manipulation code here
        };

        // Initialize device buttons
        const initDeviceButtons = () => {
          const deviceBtns = document.querySelectorAll('.device-btn');
          if (!deviceBtns) return;

          deviceBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
              if (!this || !this.classList) return;
              deviceBtns.forEach(b => b.classList?.remove('active'));
              this.classList.add('active');
            });
          });
        };

        // Initialize all buttons and handlers
        initDeviceButtons();

        // Handle toolbar responsiveness
        const toolbar = document.getElementById('toolbar');
        const toggleToolbar = () => {
          if (window.innerWidth < 768) {
            toolbar?.classList.add('collapsed');
          } else {
            toolbar?.classList.remove('collapsed');
          }
        };

        // Listen for window resize
        window.addEventListener('resize', toggleToolbar);
        // Initial check
        toggleToolbar();
      });
    </script>
    <script type="module" src="/assets/js/WebDesigner/pageBuilder.js"></script>

</body>

</html>