export const slider = {
  label: `
    <div class="block">
      <div class="block-icon">
        <i class="fas fa-images mr-2 text-terracotta"></i>
      </div>
      <div class="block-label">
        Hero Slider
      </div>
    </div>`,
  category: "Multimedia",
  content: {
    type: "slider",
    components: `
      <div class="gjs-slider relative w-full h-screen max-w-full overflow-hidden rounded-none shadow-lg">
        <!-- track -->
        <div class="slider-track flex transition-transform duration-500 ease-in-out">
          <div class="slider-item flex-none w-full relative h-screen">
            <img alt="Slide image" class="slider-image w-full h-full object-cover" />
            <div class="slide-overlay absolute inset-0 flex flex-col items-start justify-center bg-black/40 p-6 md:p-16">
              <h2 class="text-white text-3xl md:text-5xl font-extrabold">Heading</h2>
              <p class="mt-4 text-base md:text-lg text-white/90 max-w-xl">Subtitle or description goes here.</p>
              <a href="#" class="mt-6 inline-block bg-terracotta text-white font-semibold py-3 px-6 rounded-lg shadow-md">Call to action</a>
            </div>
          </div>

          <div class="slider-item flex-none w-full relative h-screen">
            <img alt="Slide image" class="slider-image w-full h-full object-cover" />
            <div class="slide-overlay absolute inset-0 flex flex-col items-start justify-center bg-black/40 p-6 md:p-16">
              <h2 class="text-white text-3xl md:text-5xl font-extrabold">Heading 2</h2>
              <p class="mt-4 text-base md:text-lg text-white/90 max-w-xl">Another subtitle.</p>
              <a href="#" class="mt-6 inline-block bg-terracotta text-white font-semibold py-3 px-6 rounded-lg shadow-md">Learn more</a>
            </div>
          </div>

          <div class="slider-item flex-none w-full relative h-screen">
            <img alt="Slide image" class="slider-image w-full h-full object-cover" />
            <div class="slide-overlay absolute inset-0 flex flex-col items-start justify-center bg-black/40 p-6 md:p-16">
              <h2 class="text-white text-3xl md:text-5xl font-extrabold">Heading 3</h2>
              <p class="mt-4 text-base md:text-lg text-white/90 max-w-xl">Short description.</p>
              <a href="#" class="mt-6 inline-block bg-terracotta text-white font-semibold py-3 px-6 rounded-lg shadow-md">Get started</a>
            </div>
          </div>
        </div>

        <!-- nav -->
        <button class="slider-btn slider-prev absolute left-4 top-1/2 -translate-y-1/2 rounded-full w-12 h-12 flex items-center justify-center bg-white/90 shadow-md hover:bg-white">
          <span class="text-slate-700 font-bold text-xl">&lt;</span>
        </button>
        <button class="slider-btn slider-next absolute right-4 top-1/2 -translate-y-1/2 rounded-full w-12 h-12 flex items-center justify-center bg-white/90 shadow-md hover:bg-white">
          <span class="text-slate-700 font-bold text-xl">&gt;</span>
        </button>

        <!-- dots -->
        <div class="slider-dots absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3"></div>
      </div>
    `,
    attributes: { class: "gjs-block-section" },
  },
};
