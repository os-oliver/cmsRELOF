export const table_row = {
  label: `
    <div class="block">
      <div class="block-icon">
        <i class="fas fa-grip-lines mr-2"></i>
      </div>
      <div class="block-label">
        Red u tabeli
      </div>
    </div>`,
  category: "Komponente",
  content: `
    <tr class="hover:bg-gray-50 transition">
      <td class="py-4 px-6"><p>1</p></td>
      <td class="py-4 px-6 font-medium"><p>Naziv stavke</p></td>
      <td class="py-4 px-6"><p>Kratak opis stavke ili informacije.</p></td>
      <td class="py-4 px-6"><p>Vrednost</p></td>
    </tr>

    
  `,
  attributes: { class: "gjs-block-table-row" },
};
