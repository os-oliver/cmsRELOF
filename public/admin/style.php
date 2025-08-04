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
  <title>MD Page Builder</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="/assets/css/WebDesigner/grapes.min.css" rel="stylesheet" />

  <link href="/assets/css/WebDesigner/style.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


</head>

<body>
  <div id="app-container" class="flex h-screen">
    <!-- Enhanced Sidebar -->
    <div id="toolbar" class="flex flex-col">
      <!-- Header -->
      <div class="header">
        <div class="logo-container">
          <div class="logo">
            <i class="fas fa-paint-brush"></i>
          </div>
          <div class="logo-text">
            <h1>MD Page Builder</h1>
            <p>Developed my Mind Developement</p>
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
      <div class="device-selector">
        <div class="Devices">
          <button class="device-btn active" data-device="desktop">
            <i class="fas fa-desktop"></i>
          </button>
          <button class="device-btn" data-device="tablet">
            <i class="fas fa-tablet-alt"></i>
          </button>
          <button class="device-btn" data-device="mobile">
            <i class="fas fa-mobile-alt"></i>
          </button>
        </div>
        <div class="Devices">
          <button id="undo-btn" class="device-btn" data-device="desktop">
            <i class="fas fa-undo"></i>
          </button>
          <button id="redo-btn" class="device-btn" data-device="tablet">
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


    </script>
    <script type="module" src="/assets/js/WebDesigner/pageBuilder.js"></script>

</body>

</html>