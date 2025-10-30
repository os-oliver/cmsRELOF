export const layout_image_right = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-align-right mr-2"></i></div>
      <div class="block-label">Tekst levo / Slika desno</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-10">
        <div class="md:w-1/2 space-y-4">
          <h2 class="text-3xl font-bold">Naslov sekcije</h2>
          <p class="text-gray-700 text-lg">
            Opisni tekst sa leve strane koji detaljno objašnjava funkcionalnosti ili sadržaj koji se prikazuje.
          </p>
        </div>
        <img src="https://placehold.co/600x400" alt="Slika desno" class="rounded-xl shadow-lg w-full md:w-1/2">
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
