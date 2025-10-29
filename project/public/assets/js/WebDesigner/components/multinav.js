export const multiLink = {
  label: `    <div class="block">
      <div class="block-icon">
        <i class="fas  fa-url mr-2"></i>
      </div>
      <div class="block-label">
        multi link
      </div>
    </div>`,
  category: "Link navigacije",
  content: `
     <div class="relative group">
  <button class="text-gray-700 hover:text-blue-900 font-medium flex items-center gap-1">
    Link <i class="fas fa-chevron-down text-xs"></i>
  </button>
  <div class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
    <a href="#" data-gjs-type="text" class="block px-4 py-2 hover:bg-gray-100">
      Link1
    </a>
    <a href="#"data-gjs-type="text" class="block px-4 py-2 hover:bg-gray-100">
      Link2
    </a>
    <a href="#" data-gjs-type="text" class="block px-4 py-2 hover:bg-gray-100">
      Link3
    </a>

  </div>
</div>
      `,
  attributes: { class: "gjs-block-section" },
};
