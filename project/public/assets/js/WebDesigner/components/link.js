export const link = {
  label: `
    <div class="block">
      <div class="block-icon">
        <i class="fas fa-link mr-2 text-terracotta"></i>
      </div>
      <div class="block-label">
        Link
      </div>
    </div>`,
  category: "Navigacija",
  content: `
    <a href="#"
      class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap group">
      <i class="fas fa-home mr-2 text-terracotta group-hover:text-coral transition-colors"></i>
      <span class="hidden xl:inline">Početna</span>
    </a>
  `,
  attributes: { class: "gjs-block-section" },
};
