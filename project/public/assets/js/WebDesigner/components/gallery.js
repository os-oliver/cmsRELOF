export const gallery = {
  label: `    <div class="block">
    <div class="block-icon">
      <i class="fas  fa-images mr-2"></i>
    </div>
    <div class="block-label">
      Galerija slika
    </div>
  </div>`,
  category: "Osnovne Komponente",
  content: `
        <section class="py-20 bg-gray-50">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Naša Galerija</h2>
              <p class="text-xl text-gray-600">Pogledajte neke od naših najlepših radova</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/3B82F6/FFFFFF?text=Projekt+1" alt="Projekt 1" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">Web Aplikacija</h3>
                    <p class="text-gray-200">Moderna e-commerce platforma</p>
                  </div>
                </div>
              </div>
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/8B5CF6/FFFFFF?text=Projekt+2" alt="Projekt 2" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">Mobilna App</h3>
                    <p class="text-gray-200">iOS i Android aplikacija</p>
                  </div>
                </div>
              </div>
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/10B981/FFFFFF?text=Projekt+3" alt="Projekt 3" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">Branding</h3>
                    <p class="text-gray-200">Kompletna vizuelna identifikacija</p>
                  </div>
                </div>
              </div>
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/F59E0B/FFFFFF?text=Projekt+4" alt="Projekt 4" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">Dashboard</h3>
                    <p class="text-gray-200">Analitički dashboard</p>
                  </div>
                </div>
              </div>
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/EF4444/FFFFFF?text=Projekt+5" alt="Projekt 5" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">Landing Page</h3>
                    <p class="text-gray-200">Konverzije-optimizovana stranica</p>
                  </div>
                </div>
              </div>
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
                <img src="https://via.placeholder.com/400x300/8B5CF6/FFFFFF?text=Projekt+6" alt="Projekt 6" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-xl font-bold">SaaS Platforma</h3>
                    <p class="text-gray-200">Oblačko rešenje za upravljanje</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
