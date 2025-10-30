export const layout_cards = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-th-large mr-2"></i></div>
      <div class="block-label">Kartice / Mreža</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <header class="text-center mb-12">
          <h2 class="text-4xl font-bold mb-3">Naslov mreže</h2>
          <p class="text-gray-700 max-w-2xl mx-auto">
            Kratki uvod koji opisuje sadržaj kartica.
          </p>
        </header>
        <div class="grid gap-8 md:grid-cols-3">
          ${[1, 2, 3, 4, 5, 6]
            .map(
              (i) => `
            <article class="bg-gray-50 rounded-2xl shadow-md overflow-hidden transition transform hover:-translate-y-1">
              <img src="https://placehold.co/800x500" alt="Kartica ${i}" class="w-full h-44 object-cover" />
              <div class="p-6 space-y-2">
                <h3 class="text-xl font-semibold">Naslov ${i}</h3>
                <p class="text-gray-700 text-sm">Kratak opis stavke ${i}</p>
                <p class="text-sm text-gray-500">Meta info</p>
              </div>
            </article>
          `
            )
            .join("")}
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
