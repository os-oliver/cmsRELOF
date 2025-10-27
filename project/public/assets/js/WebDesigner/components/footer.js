export const footer = {
  label: `    <div class="block">
    <div class="block-icon">
      <i class="fas  fa-grip-horizontal mr-2"></i>
    </div>
    <div class="block-label">
      Footer
    </div>
  </div>`,
  category: "Footer",
  content: `
        <footer class="bg-gray-900 text-white pt-16 pb-8">
          <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 mb-12">
              <div>
                <div class="flex items-center mb-6">
                  <i class="fas fa-cube text-2xl text-blue-400 mr-3"></i>
                  <h3 class="text-2xl font-bold">Vaša Firma</h3>
                </div>
                <p class="text-gray-400 mb-6">Kreiramo digitalna rešenja koja pokreću vaš biznis napred.</p>
                <div class="flex space-x-4">
                  <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center hover:shadow-lg transition">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center hover:shadow-lg transition">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-gradient-to-r from-pink-600 to-pink-700 rounded-full flex items-center justify-center hover:shadow-lg transition">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-700 to-blue-800 rounded-full flex items-center justify-center hover:shadow-lg transition">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </div>
              </div>
              <div>
                <h4 class="text-xl font-bold mb-6">Usluge</h4>
                <ul class="space-y-3 text-gray-400">
                  <li><a href="#" class="hover:text-white transition">Web Dizajn</a></li>
                  <li><a href="#" class="hover:text-white transition">Razvoj Aplikacija</a></li>
                  <li><a href="#" class="hover:text-white transition">SEO Optimizacija</a></li>
                  <li><a href="#" class="hover:text-white transition">Digital Marketing</a></li>
                  <li><a href="#" class="hover:text-white transition">E-commerce</a></li>
                </ul>
              </div>
              <div>
                <h4 class="text-xl font-bold mb-6">Kompanija</h4>
                <ul class="space-y-3 text-gray-400">
                  <li><a href="#" class="hover:text-white transition">O Nama</a></li>
                  <li><a href="#" class="hover:text-white transition">Naš Tim</a></li>
                  <li><a href="#" class="hover:text-white transition">Karijera</a></li>
                  <li><a href="#" class="hover:text-white transition">Blog</a></li>
                  <li><a href="#" class="hover:text-white transition">Kontakt</a></li>
                </ul>
              </div>
              <div>
                <h4 class="text-xl font-bold mb-6">Newsletter</h4>
                <p class="text-gray-400 mb-4">Budite u toku sa najnovijim vestima i ponudama.</p>
                <div class="flex">
                  <input type="email" placeholder="Vaš email" class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg focus:outline-none focus:border-blue-500">
                  <button class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-2 rounded-r-lg hover:shadow-lg transition">
                    <i class="fas fa-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
              <p class="text-gray-400">&copy; 2025 Vaša Firma. Sva prava zadržana.</p>
              <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-white transition">Politika Privatnosti</a>
                <a href="#" class="text-gray-400 hover:text-white transition">Uslovi Korišćenja</a>
              </div>
            </div>
          </div>
        </footer>
      `,
  attributes: { class: "gjs-block-section" },
};
