export const layout_image_left = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-align-left mr-2"></i></div>
      <div class="block-label">Slika levo / Tekst desno</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-10">
        <img src="https://placehold.co/600x400" alt="Slika levo" class="rounded-xl shadow-lg w-full md:w-1/2">
        <div class="md:w-1/2 space-y-4">
          <h2 class="text-3xl font-bold">Naslov sekcije</h2>
          <p class="text-gray-700 text-lg">
            Opisni tekst koji detaljno objašnjava sadržaj slike ili funkcionalnost prikazanu sa leve strane.
          </p>
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
