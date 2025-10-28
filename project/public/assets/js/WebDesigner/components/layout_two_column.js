export const layout_two_column = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-columns mr-2"></i></div>
      <div class="block-label">Dve kolone</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 text-center">Naslov sekcije</h2>
        <div class="flex flex-col md:flex-row gap-12 items-center">
          <div class="md:w-1/2 space-y-4">
            <p class="text-gray-700 text-lg">Leva kolona sa tekstom i objašnjenjem.</p>
            <p class="text-gray-700 text-lg">Dodatni pasusi ili liste sa detaljima.</p>
            <button class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Saznaj više</button>
          </div>
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400" alt="Dve kolone slika" class="rounded-xl shadow-lg w-full">
          </div>
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
