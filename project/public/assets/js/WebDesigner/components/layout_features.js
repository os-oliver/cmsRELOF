export const layout_features = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-cogs mr-2"></i></div>
      <div class="block-label">Istaknute funkcije</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-12 text-center">Funkcionalnosti</h2>
        <div class="grid md:grid-cols-3 gap-8">
          ${[1, 2, 3]
            .map(
              (i) => `
            <div class="bg-white p-6 rounded-xl shadow-md text-center space-y-4">
              <div class="text-4xl text-blue-600"><i class="fas fa-star"></i></div>
              <h3 class="text-xl font-semibold">Funkcija ${i}</h3>
              <p class="text-gray-700 text-sm">Kratak opis funkcionalnosti ${i} i njenih prednosti.</p>
            </div>
          `
            )
            .join("")}
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
