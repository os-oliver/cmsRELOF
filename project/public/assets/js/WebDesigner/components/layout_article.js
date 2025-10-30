export const layout_article = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-newspaper mr-2"></i></div>
      <div class="block-label">Članski raspored</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6 max-w-4xl">
        <header class="mb-12 text-center">
          <h2 class="text-4xl font-bold mb-4">Naslov članka</h2>
          <p class="text-gray-700">Kratki uvod koji opisuje temu članka ili projekta.</p>
        </header>
        <article class="prose prose-lg max-w-full mx-auto">
          <p>Ovo je glavni tekst članka. Može uključivati više pasusa, citate i primer slike.</p>
          <img src="https://placehold.co/800x400" alt="Slika članka" class="rounded-lg mt-6 mb-6">
          <p>Nastavak teksta sa dodatnim informacijama, detaljima i zaključcima.</p>
        </article>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
