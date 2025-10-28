export const layout_grid = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-th-large mr-2"></i></div>
      <div class="block-label">Mrežni raspored</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-16">
      <div class="container mx-auto px-6">
        <header class="text-center mb-12">
          <h2 class="text-4xl font-bold mb-3">Naslov mreže</h2>
          <p class="text-gray-700 max-w-2xl mx-auto">
            Uvodni tekst koji objašnjava šta se nalazi u mreži — idealno za prikaz proizvoda, usluga ili timova.
          </p>
        </header>

        <div class="grid gap-8 md:grid-cols-3">
          ${[1, 2, 3, 4, 5, 6]
            .map(
              (i) => `
            <article class="bg-white rounded-2xl shadow-md overflow-hidden transition transform hover:-translate-y-1">
              <img src="https://placehold.co/800x500" alt="Kartica ${i}" class="w-full h-44 object-cover" />
              <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">Naslov ${i}</h3>
                <p class="text-gray-700 mb-4">Kratak opis za stavku ${i} — može sadržati ključne prednosti ili cenu.</p>
                <div class="flex items-center justify-between">
                  <p class="text-sm text-gray-500">Meta info</p>
                </div>
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
