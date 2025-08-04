export const buttonComponent = {
  // Label for the component in the UI, with a relevant icon.
  label: `<div class="block">
  <div class="block-icon">
    <i class="fas fa-mouse-pointer"></i>
  </div>
  <div class="block-label">
    Dugme
  </div>
</div>`,
  // Category for organizing components.
  category: "Osnovne Komponente",
  // The HTML content of the component, styled with Tailwind CSS.
  content: `
  <button type="submit" class="btn btn-primary h-15" style="width: 50%;">Dugme</button>

    `,
  // Default attributes for the component's root element.
  attributes: { class: "p-4" },
};
