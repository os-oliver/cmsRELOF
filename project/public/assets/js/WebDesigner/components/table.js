import { TableRow } from "./TableRow.js";

export const table = {
  label: `
    <div class="block">
      <div class="block-icon">
        <i class="fas fa-table mr-2"></i>
      </div>
      <div class="block-label">
        Tabela
      </div>
    </div>`,
  category: "Komponente",
  content: `
    <section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-3"><p>Pregled Podataka</p></h2>
          <p class="text-lg text-gray-600"><p>Formalna tabela za prikaz važnih informacija</p></p>
        </div>

        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
          <table class="min-w-full border-collapse">
            <thead class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
              <tr>
                <th class="py-4 px-6 text-left text-sm font-semibold tracking-wide border-r border-blue-400"><p>#</p></th>
                <th class="py-4 px-6 text-left text-sm font-semibold tracking-wide border-r border-blue-400"><p>Naziv</p></th>
                <th class="py-4 px-6 text-left text-sm font-semibold tracking-wide border-r border-blue-400"><p>Opis</p></th>
                <th class="py-4 px-6 text-left text-sm font-semibold tracking-wide"><p>Vrednost</p></th>
              </tr>
            </thead>
            <tbody class="text-gray-800 divide-y divide-gray-200">
              ${TableRow({
                id: 1,
                naziv: "Ukupan broj korisnika",
                opis: "Broj registrovanih naloga u sistemu",
                vrednost: "542",
              })}
              ${TableRow({
                id: 2,
                naziv: "Prosečna ocena",
                opis: "Srednja vrednost korisničkih ocena",
                vrednost: "4.7",
              })}
              ${TableRow({
                id: 3,
                naziv: "Broj aktivnih pretplata",
                opis: "Trenutno aktivne mesečne pretplate",
                vrednost: "218",
              })}
              ${TableRow({
                id: 4,
                naziv: "Ukupni prihodi",
                opis: "Prihod ostvaren tokom prethodnog meseca",
                vrednost: "$12,430",
              })}
              ${TableRow({
                id: 5,
                naziv: "Broj podržanih projekata",
                opis: "Ukupan broj projekata u okviru platforme",
                vrednost: "35",
              })}
            </tbody>
          </table>
        </div>

        <div class="text-sm text-gray-500 text-center mt-6">
          <p>Podaci su ažurirani automatski – poslednje osvežavanje: 28. oktobar 2025.</p>
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
