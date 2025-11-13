<?php
use App\Controllers\AuthController;
use App\Models\Document;
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
      <!-- Blocks Container -->
      <?php
      $documents = (new Document())->list();
      ?>

      <div id="navBlock" class="hidden w-full max-w-lg backdrop-blur-md border shadow-2xl p-6 text-gray-100 z-50">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-xl font-bold">Podešavanje linka</h3>
          <button id="navClose" class="text-gray-400 hover:text-gray-200 transition" aria-label="Zatvori">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="space-y-6">
          <div>
            <label for="documentSelect" class="block text-sm font-medium text-gray-300 mb-2">Izaberi dokument</label>
            <select id="documentSelect"
              class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="">-- Izaberi dokument --</option>
              <?php foreach ($documents[0] as $doc):
                error_log(json_encode($doc));
                ?>
                <option value="/uploads/documents/<?php echo htmlspecialchars($doc['filepath']); ?>">
                  <?php
                  $naslov = !empty($doc['title']) ? $doc['title'] : $doc['filepath'];
                  echo htmlspecialchars($naslov); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label for="linkHref" class="block text-sm font-medium text-gray-300 mb-2">Putanja (Href)</label>
            <input id="linkHref" type="text"
              class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500"
              placeholder="/putanja-do-stranice" />
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center space-x-3">
              <input id="linkStatic" type="checkbox"
                class="h-5 w-5 text-blue-500 border-gray-600 rounded focus:ring-blue-400" />
              <span class="text-sm">Označi kao statičan link</span>
            </label>
            <p id="navBlockNotice" class="text-xs text-gray-400">Kliknite na link unutar editor platna da biste ga
              izmenili.
            </p>
          </div>

          <div class="flex items-center gap-4">
            <button id="applyLink"
              class="flex-1 px-4 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 transition">Primeni</button>
            <button id="resetLink"
              class="hidden px-4 py-3 border border-gray-600 rounded-xl text-gray-200 hover:bg-gray-700 transition">Poništi</button>
            <button id="delete"
              class="px-4 py-3 border border-gray-600 rounded-xl text-gray-200 hover:bg-red-700 transition">Obriši</button>

          </div>
        </div>
      </div>


      <!-- Icon chooser modal -->
      <div id="iconChooser" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-xl w-11/12 max-w-4xl p-4">
          <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-semibold">Izaberite ikonu i boju</h3>
            <button id="closeIconChooser" class="text-gray-500 hover:text-gray-700">Zatvori</button>
          </div>
          <div class="grid grid-cols-12 gap-4">
            <div class="col-span-8">
              <div class="grid grid-cols-8 gap-3 max-h-72 overflow-auto p-2 border rounded" id="iconGrid">
                <!-- sample icons -->
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded" data-icon="fas fa-home"><i
                    class="fas fa-home"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded" data-icon="fas fa-search"><i
                    class="fas fa-search"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded" data-icon="fas fa-user"><i
                    class="fas fa-user"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded"
                  data-icon="fas fa-calendar-alt"><i class="fas fa-calendar-alt"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded" data-icon="fas fa-images"><i
                    class="fas fa-images"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded"
                  data-icon="fas fa-folder-open"><i class="fas fa-folder-open"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded"
                  data-icon="fas fa-address-book"><i class="fas fa-address-book"></i></button>
                <button class="icon-item p-2 text-center text-lg hover:bg-gray-100 rounded"
                  data-icon="fas fa-info-circle"><i class="fas fa-info-circle"></i></button>
                <!-- more icons can be added -->
              </div>
            </div>

            <div class="col-span-4 p-3 border rounded">
              <div class="mb-3">
                <label class="text-xs text-gray-600 block mb-1">Boja ikone</label>
                <input id="iconColor" type="color" value="#000000" class="w-full h-10 p-1 rounded" />
              </div>
              <div class="mb-3">
                <label class="text-xs text-gray-600 block mb-1">Veličina</label>
                <select id="iconSize" class="w-full p-2 border rounded">
                  <option value="text-sm">Mala</option>
                  <option value="text-lg" selected>Srednja</option>
                  <option value="text-2xl">Velika</option>
                  <option value="text-3xl">Veća</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="text-xs text-gray-600 block mb-1">Preview</label>
                <div id="iconPreview" class="w-full h-20 flex items-center justify-center border rounded bg-gray-50">
                  <i id="iconPreviewI" class="fas fa-home text-2xl" style="color:#000"></i>
                </div>
              </div>
              <div class="mt-4 flex space-x-2">
                <button id="applyIconAndColor"
                  class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition">Primeni</button>
                <button id="resetIconAndColor"
                  class="px-3 py-2 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition">Poništi</button>
              </div>
            </div>
          </div>
        </div>
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
    <script type="module" src="/assets/js/WebDesigner/pageBuilder.js"></script>
    <script>
      const select = document.getElementById('documentSelect');
      const hrefInput = document.getElementById('linkHref');

      select.addEventListener('change', () => {
        hrefInput.value = select.value;
      });
    </script>
  </div>
</body>

</html>