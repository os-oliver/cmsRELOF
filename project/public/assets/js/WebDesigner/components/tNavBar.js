export const topNavbarComponent = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-window-maximize mr-2"></i>
  </div>
  <div class="block-label">
    Gornja navigacija
  </div>
</div>`,
  category: "Navigacija",
  content: `
    <nav class="bg-white shadow-lg border-b-4 border-blue-500">
      <div class="container mx-auto px-6">
        <div class="flex items-center justify-between h-16">
          <!-- Logo (left) -->
          <div class="flex items-center space-x-2">
            <i class="fas fa-rocket text-2xl text-blue-600"></i>
            <span class="text-2xl font-bold text-gray-800">BrandName</span>
          </div>

          <!-- Navigation links (right) -->
          <ul class="hidden md:flex items-center space-x-8">
            <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Početna</a></li>
            <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">O Nama</a></li>
            <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Usluge</a></li>
            <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Kontakt</a></li>
          </ul>

          <!-- Mobile menu button -->
          <button class="md:hidden text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-bars text-2xl"></i>
          </button>
        </div>
      </div>
    </nav>
  `,
  attributes: { class: "gjs-block-section" },
};
