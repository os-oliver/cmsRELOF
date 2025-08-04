export const heroVideo = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-play mr-2"></i>
  </div>
  <div class="block-label">
    Hero video
  </div>
</div>`,
  category: "Hero Sekcije",
  content: `
        <section class="relative h-screen flex items-center justify-center text-white overflow-hidden">
          <div class="absolute inset-0 bg-gray-900">
            <div class="w-full h-full bg-gradient-to-r from-purple-900/80 to-blue-900/80 flex items-center justify-center">
              <i class="fas fa-play text-6xl text-white opacity-30"></i>
            </div>
          </div>
          <div class="relative z-10 text-center px-6 max-w-5xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
              Vaša Priča Počinje <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-yellow-400">Ovde</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 text-gray-300 max-w-2xl mx-auto">
              Otkrijte moć kreativnosti i tehnologije. Napravite nešto neverovatno već danas.
            </p>
            <button class="bg-gradient-to-r from-pink-500 to-yellow-500 px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition duration-300">
              <i class="fas fa-rocket mr-2"></i>Lansirati Projekat
            </button>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
