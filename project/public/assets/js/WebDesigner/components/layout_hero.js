export const layout_hero = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-image mr-2"></i></div>
      <div class="block-label">Hero sekcija</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="min-h-screen bg-gradient-to-b from-blue-50 to-white flex flex-col justify-center items-center py-20">
      <h1 class="text-5xl font-bold mb-6 text-center">Veliki naslov</h1>
      <p class="text-gray-700 text-xl max-w-2xl text-center mb-10">
        Uvodni tekst koji objašnjava svrhu stranice ili proizvoda. Idealno za privlačenje pažnje posetilaca.
      </p>
      <img src="https://placehold.co/1200x600" alt="Hero slika" class="rounded-xl shadow-lg w-full max-w-4xl">
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
