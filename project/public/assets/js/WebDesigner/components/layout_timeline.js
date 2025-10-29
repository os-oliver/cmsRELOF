export const layout_timeline = {
  label: `
    <div class="block">
      <div class="block-icon"><i class="fas fa-stream mr-2"></i></div>
      <div class="block-label">Vremenska linija</div>
    </div>`,
  category: "Layouti",
  content: `
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-12 text-center">Timeline / Faze projekta</h2>
        <div class="relative flex flex-col gap-12 before:absolute before:left-1/2 before:top-0 before:bottom-0 before:w-1 before:bg-blue-200">
          ${[1, 2, 3]
            .map(
              (i) => `
            <div class="flex flex-col md:flex-row items-center gap-6 relative">
              <div class="md:w-1/4 text-center font-semibold text-blue-600 z-10">${i}</div>
              <div class="md:w-3/4 bg-gray-50 p-6 rounded-xl shadow-md z-10">
                Faza ${i} projekta ili događaja sa detaljima.
              </div>
            </div>
          `
            )
            .join("")}
        </div>
      </div>
    </section>
  `,
  attributes: { class: "gjs-block-section" },
};
