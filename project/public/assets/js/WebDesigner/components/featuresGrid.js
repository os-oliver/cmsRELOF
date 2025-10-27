export const featuresGrid = {
  label: `    <div class="block">
    <div class="block-icon">
      <i class="fas fa-th mr-2"></i>
    </div>
    <div class="block-label">
      Karakteristike
    </div>
  </div>`,
  category: "Sadržaj",
  content: `
        <section class="py-20 bg-gray-50">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Zašto Izabrati Nas?</h2>
              <p class="text-xl text-gray-600 max-w-2xl mx-auto">Nudimo najbolje usluge sa modernim pristupom i profesionalnim timom</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
              <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                  <i class="fas fa-rocket text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Brza Implementacija</h3>
                <p class="text-gray-600 text-center">Realizujemo projekte brzo i efikasno, bez kompromisa u kvalitetu.</p>
              </div>
              <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                  <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Sigurnost</h3>
                <p class="text-gray-600 text-center">Vaši podaci su sigurni uz najnovije sigurnosne protokole.</p>
              </div>
              <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                  <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">24/7 Podrška</h3>
                <p class="text-gray-600 text-center">Naš tim je uvek dostupan za pomoć i podršku.</p>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
