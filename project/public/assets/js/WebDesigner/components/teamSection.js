export const teamSection = {
  label: `    <div class="block">
  <div class="block-icon">
    <i class="fas  fa-user-friends mr-2"></i>
  </div>
  <div class="block-label">
    Naš Tim
  </div>
</div>`,
  category: "Komponente",
  content: `
        <section class="py-20 bg-white">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Upoznajte Naš Tim</h2>
              <p class="text-xl text-gray-600 max-w-2xl mx-auto">Stručnjaci koji stoje iza vašeg uspeha</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
              <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="relative mb-6">
                  <img src="https://via.placeholder.com/150x150/3B82F6/FFFFFF?text=AM" alt="Ana Marković" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                  <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Ana Marković</h3>
                <p class="text-blue-600 font-semibold mb-4">CEO & Osnivač</p>
                <p class="text-gray-600 mb-6">Vodi tim sa preko 10 godina iskustva u digitalnom marketingu i razvoju.</p>
                <div class="flex justify-center space-x-4">
                  <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center text-white hover:bg-gray-700 transition">
                    <i class="fab fa-twitter"></i>
                  </a>
                </div>
              </div>
              <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="relative mb-6">
                  <img src="https://via.placeholder.com/150x150/8B5CF6/FFFFFF?text=MJ" alt="Miloš Jovanović" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                  <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Miloš Jovanović</h3>
                <p class="text-purple-600 font-semibold mb-4">Lead Developer</p>
                <p class="text-gray-600 mb-6">Stručnjak za full-stack razvoj sa fokusom na moderne web tehnologije.</p>
                <div class="flex justify-center space-x-4">
                  <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-white hover:bg-gray-900 transition">
                    <i class="fab fa-github"></i>
                  </a>
                </div>
              </div>
              <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="relative mb-6">
                  <img src="https://via.placeholder.com/150x150/10B981/FFFFFF?text=SP" alt="Sofija Petrović" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                  <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Sofija Petrović</h3>
                <p class="text-green-600 font-semibold mb-4">UX/UI Designer</p>
                <p class="text-gray-600 mb-6">Kreira neverovatna korisnička iskustva kroz inovativne dizajne.</p>
                <div class="flex justify-center space-x-4">
                  <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white hover:bg-pink-700 transition">
                    <i class="fab fa-dribbble"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
