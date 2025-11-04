export const layout_gallery = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-image mr-2"></i></div>
      <div class="block-label">Galerija</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-12 text-center">Galerija slika</h2>
        <div class="grid gap-6 md:grid-cols-3">
          ${[1, 2, 3, 4, 5, 6]
            .map(
              (i) => `
            <div class="overflow-hidden rounded-xl shadow-md">
              <img src="https://placehold.co/600x400" alt="Galerija ${i}" class="w-full h-44 object-cover">
              <div class="p-4 text-center space-y-2">
                <h3 class="font-semibold">Slika ${i}</h3>
                <p class="text-gray-700 text-sm">Kratak opis slike ${i}.</p>
              </div>
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
