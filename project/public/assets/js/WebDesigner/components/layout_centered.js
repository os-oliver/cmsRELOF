export const layout_centered = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-align-center mr-2"></i></div>
      <div class="block-label">Centrirani tekst</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class=" bg-gray-50 flex flex-col justify-center items-center py-20 text-center">
      <h1 class="text-5xl font-bold mb-6">Naslov u centru</h1>
      <p class="text-gray-700 text-xl max-w-2xl mb-8">
        Kratak opis ili citat koji je centriran i fokusira pažnju korisnika.
      </p>
      <img src="https://placehold.co/800x400" alt="Centirana slika" class="rounded-xl shadow-lg w-full max-w-3xl">
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
