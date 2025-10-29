export const TableRow = ({ id, naziv, opis, vrednost }) => `
  <tr class="hover:bg-gray-50 transition">
    <td class="py-4 px-6"><p>${id}</p></td>
    <td class="py-4 px-6 font-medium"><p>${naziv}</p></td>
    <td class="py-4 px-6"><p>${opis}</p></td>
    <td class="py-4 px-6"><p>${vrednost}</p></td>
  </tr>
`;
