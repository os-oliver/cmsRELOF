export const layout_split = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-columns mr-2"></i></div>
      <div class="block-label">Split screen</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="min-h-screen flex flex-col md:flex-row">
      <div class="md:w-1/2 bg-blue-600 flex items-center justify-center text-white p-12">
        <h2 class="text-4xl font-bold text-center">Leva polovina</h2>
      </div>
      <div class="md:w-1/2 bg-gray-50 flex flex-col items-center justify-center p-12 space-y-4">
        <h2 class="text-4xl font-bold text-center">Desna polovina</h2>
        <p class="text-gray-600 text-lg text-center">
          Opis, dugme ili poziv na akciju na desnoj strani ekrana.
        </p>
        <button class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
          Saznaj više
        </button>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
