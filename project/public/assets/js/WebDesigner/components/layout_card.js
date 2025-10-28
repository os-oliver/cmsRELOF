export const layout_card = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-layer-group mr-2"></i></div>
      <div class="block-label">Kartica</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-12 bg-gray-50">
      <div class="max-w-sm mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
        <img src="https://placehold.co/600x400" alt="Slika" class="w-full h-48 object-cover" />
        <div class="p-6 text-center space-y-3">
          <h3 class="text-2xl font-bold text-gray-800">Naslov kartice</h3>
          <p class="text-gray-700 text-base">
            Ovo je opis kartice — možeš ga iskoristiti za kratke informacije ili uvod.
          </p>
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
