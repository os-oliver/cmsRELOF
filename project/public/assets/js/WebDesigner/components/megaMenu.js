export const megaMenu = {
  label: `
    <div class="block">
      <div class="block-icon">
        <i class="fas fa-th-large mr-2"></i>
      </div>
      <div class="block-label">
        Mega Menu
      </div>
    </div>`,
  category: "Navigacija",
  content: `
    <div class="dropdown nonPage megaMenu relative group">
      <button
        class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
        <i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i>
        <span class="hidden xl:inline"><p>Naslov</p></span>
        <i class="fas fa-chevron-down ml-1 text-xs"></i>
      </button>

      <!-- MEGA MENU -->
      <div
        class="dropdown-menu absolute top-full left-0 w-[600px] bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 p-6 grid grid-cols-3 gap-6">

        <!-- Sekcija (dinamički se dodaje) -->
        <div>
          <h3 class="font-bold text-slate mb-2">[Naslov sekcije]</h3>
          <ul class="space-y-2">
            <li>
              <a href="#" class="flex items-center text-sm hover:text-terracotta">
                <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 1]
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center text-sm hover:text-terracotta">
                <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 2]
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center text-sm hover:text-terracotta">
                <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 3]
              </a>
            </li>
          </ul>
        </div>

        <!-- Dupliraj ili izbriši sekciju po potrebi -->
      </div>
    </div>
  `,
  attributes: { class: "gjs-block-section" },
};
