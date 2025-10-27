export const contactForm = {
  label: `
    <div class="block">
  <div class="block-icon">
    <i class="fas fa-envelope mr-2"></i>
  </div>
  <div class="block-label">
    Kontakt Forma
  </div>
</div>`,
  category: "Kontakt",
  content: `
        <section class="py-20 bg-gray-900">
          <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
              <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">Stupite u Kontakt</h2>
                <p class="text-xl text-gray-400">Spremni smo da odgovorimo na sva vaša pitanja</p>
              </div>
              <div class="grid lg:grid-cols-2 gap-12">
                <div>
                  <h3 class="text-2xl font-bold text-white mb-6">Pošaljite Poruku</h3>
                  <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                      <input type="text" placeholder="Ime" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition">
                      <input type="email" placeholder="Email" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition">
                    </div>
                    <input type="text" placeholder="Tema" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition">
                    <textarea rows="5" placeholder="Vaša poruka..." class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition resize-none"></textarea>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-bold hover:shadow-xl transform hover:scale-105 transition duration-300">
                      <i class="fas fa-paper-plane mr-2"></i>Pošalji Poruku
                    </button>
                  </form>
                </div>
                <div>
                  <h3 class="text-2xl font-bold text-white mb-6">Kontakt Informacije</h3>
                  <div class="space-y-6">
                    <div class="flex items-center">
                      <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-map-marker-alt text-white"></i>
                      </div>
                      <div>
                        <h4 class="text-white font-bold">Adresa</h4>
                        <p class="text-gray-400">Beograd, Srbija 11000</p>
                      </div>
                    </div>
                    <div class="flex items-center">
                      <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-phone text-white"></i>
                      </div>
                      <div>
                        <h4 class="text-white font-bold">Telefon</h4>
                        <p class="text-gray-400">+381 60 123 4567</p>
                      </div>
                    </div>
                    <div class="flex items-center">
                      <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-envelope text-white"></i>
                      </div>
                      <div>
                        <h4 class="text-white font-bold">Email</h4>
                        <p class="text-gray-400">info@vasafirma.rs</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
