export const stats = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-chart-line mr-2"></i>
  </div>
  <div class="block-label">
    Statistika
  </div>
</div>`,
  category: "Komponente",
  content: `
        <section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900 text-white">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold mb-4">Naši Rezultati Govore</h2>
              <p class="text-xl text-blue-100">Brojevi koje smo postigli zajedno sa našim klijentima</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
              <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-users text-2xl text-white"></i>
                </div>
                <div class="text-4xl font-bold mb-2">500+</div>
                <p class="text-blue-200">Zadovoljnih Klijenata</p>
              </div>
              <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-project-diagram text-2xl text-white"></i>
                </div>
                <div class="text-4xl font-bold mb-2">1200+</div>
                <p class="text-blue-200">Završenih Projekata</p>
              </div>
              <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-award text-2xl text-white"></i>
                </div>
                <div class="text-4xl font-bold mb-2">50+</div>
                <p class="text-blue-200">Osvojenih Nagrada</p>
              </div>
              <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-red-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-clock text-2xl text-white"></i>
                </div>
                <div class="text-4xl font-bold mb-2">24/7</div>
                <p class="text-blue-200">Dostupna Podrška</p>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
