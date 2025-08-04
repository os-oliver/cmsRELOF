export const pricing = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-tags mr-2"></i>
  </div>
  <div class="block-label">
    Cenovnik
  </div>
</div>`,
  category: "Komponente",
  content: `
        <section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Izaberite Svoj Plan</h2>
              <p class="text-xl text-gray-600">Fleksibilni paketi prilagođeni vašim potrebama</p>
            </div>
            <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
              <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200 hover:border-blue-500 transition duration-300">
                <div class="text-center">
                  <h3 class="text-2xl font-bold text-gray-800 mb-2">Osnovni</h3>
                  <div class="text-4xl font-bold text-blue-600 mb-4">$29<span class="text-lg text-gray-500">/mesec</span></div>
                  <p class="text-gray-600 mb-6">Perfektan za početak</p>
                </div>
                <ul class="space-y-4 mb-8">
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>5 Web stranica</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>10GB prostor</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Osnovna podrška</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>SSL sertifikat</li>
                </ul>
                <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">Izaberi Plan</button>
              </div>
              <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-2xl p-8 text-white transform scale-105 relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-1 rounded-full text-sm font-bold">
                  NAJPOPULARNIJI
                </div>
                <div class="text-center">
                  <h3 class="text-2xl font-bold mb-2">Pro</h3>
                  <div class="text-4xl font-bold mb-4">$59<span class="text-lg opacity-80">/mesec</span></div>
                  <p class="opacity-90 mb-6">Za rastuće biznise</p>
                </div>
                <ul class="space-y-4 mb-8">
                  <li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i>25 Web stranica</li>
                  <li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i>100GB prostor</li>
                  <li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i>Prioritetna podrška</li>
                  <li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i>Analitika</li>
                  <li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i>E-commerce</li>
                </ul>
                <button class="w-full bg-white text-blue-600 py-3 rounded-lg font-bold hover:bg-gray-100 transition">Izaberi Plan</button>
              </div>
              <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200 hover:border-purple-500 transition duration-300">
                <div class="text-center">
                  <h3 class="text-2xl font-bold text-gray-800 mb-2">Enterprise</h3>
                  <div class="text-4xl font-bold text-purple-600 mb-4">$99<span class="text-lg text-gray-500">/mesec</span></div>
                  <p class="text-gray-600 mb-6">Za velike organizacije</p>
                </div>
                <ul class="space-y-4 mb-8">
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Neograničeno stranica</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>500GB prostor</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>24/7 podrška</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Napredna analitika</li>
                  <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i>Custom integracije</li>
                </ul>
                <button class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition">Izaberi Plan</button>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
