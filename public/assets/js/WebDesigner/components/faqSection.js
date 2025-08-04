export const faqSection = {
  label: `
    <div class="block">
    <div class="block-icon">
      <i class="fas text-white fa-question-circle mr-2"></i>
    </div>
    <div class="block-label">
      Česta Pitanja
    </div>
  </div>
    
    `,
  category: "Osnovne Komponente",
  content: `
        <section class="py-20 bg-white">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Česta Pitanja</h2>
              <p class="text-xl text-gray-600">Odgovori na najčešće postavljena pitanja</p>
            </div>
            <div class="max-w-4xl mx-auto space-y-6">
              <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between cursor-pointer">
                  <h3 class="text-xl font-bold text-gray-800">Koliko vremena traje izrada web sajta?</h3>
                  <i class="fas fa-chevron-down text-gray-500"></i>
                </div>
                <div class="mt-4 text-gray-600">
                  <p>Vreme izrade zavisi od složenosti projekta. Jednostavan sajt može biti gotov za 1-2 nedelje, dok kompleksniji projekti mogu trajati 4-8 nedelja.</p>
                </div>
              </div>
              <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between cursor-pointer">
                  <h3 class="text-xl font-bold text-gray-800">Da li nudite održavanje sajta?</h3>
                  <i class="fas fa-chevron-down text-gray-500"></i>
                </div>
                <div class="mt-4 text-gray-600">
                  <p>Da, nudimo kompletne usluge održavanja koje uključuju sigurnosne ažuriranja, backup, monitoring performansi i tehničku podršku.</p>
                </div>
              </div>
              <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between cursor-pointer">
                  <h3 class="text-xl font-bold text-gray-800">Mogu li sам da ažuriram sadržaj?</h3>
                  <i class="fas fa-chevron-down text-gray-500"></i>
                </div>
                <div class="mt-4 text-gray-600">
                  <p>Apsolutno! Svi naši sajtovi dolaze sa jednostavnim CMS sistemom koji vam omogućava lako ažuriranje sadržaja bez tehničkih znanja.</p>
                </div>
              </div>
              <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between cursor-pointer">
                  <h3 class="text-xl font-bold text-gray-800">Da li su sajtovi optimizovani za mobilne uređaje?</h3>
                  <i class="fas fa-chevron-down text-gray-500"></i>
                </div>
                <div class="mt-4 text-gray-600">
                  <p>Svi naši sajtovi su responsive i potpuno optimizovani za sve vrste uređaja - telefone, tablete i desktop računare.</p>
                </div>
              </div>
              <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between cursor-pointer">
                  <h3 class="text-xl font-bold text-gray-800">Šta je uključeno u SEO optimizaciju?</h3>
                  <i class="fas fa-chevron-down text-gray-500"></i>
                </div>
                <div class="mt-4 text-gray-600">
                  <p>Naša SEO optimizacija uključuje keyword research, optimizaciju meta tagova, strukturirane podatke, brzinu učitavanja i tehnički SEO audit.</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      `,
  attributes: { class: "gjs-block-section" },
};
