export const heroGradient = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-images mr-2"></i>
  </div>
  <div class="block-label">
    Hero gradijent
  </div>
</div>`,

  category: "Hero Sekcije",
  content: `
      <section class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-600 to-teal-500 flex items-center justify-center text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
          <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Dobrodošli u <span class="text-yellow-300">Budućnost</span>
          </h1>
          <p class="text-xl md:text-2xl mb-8 text-gray-200">
            Kreirajte neverovatne web stranice sa našim modernim alatima
          </p>
          <div class="space-x-4">
            <button class="bg-yellow-400 text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transform hover:scale-105 transition duration-300 shadow-lg">
              Počni Odmah
            </button>
            <button class="border-2 border-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-800 transition duration-300">
              Saznaj Više
            </button>
          </div>
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
          <i class="fas fa-chevron-down text-2xl text-white opacity-70"></i>
        </div>
      </section>
    `,
  attributes: { class: "gjs-block-section" },
};
