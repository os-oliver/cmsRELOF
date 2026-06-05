<?php

namespace App\Admin\PageBuilders;

class RadniProstorPageBuiler extends BasePageBuilder
{
    protected string $css = <<<'CSS'
  .gallery-slider { background: rgba(255,255,255,0.72); border: 1px solid rgba(0,0,0,0.06); border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 20px 45px rgba(15,23,42,0.08); backdrop-filter: blur(10px); }
  .gallery-slider__stage { position: relative; border-radius: 1.25rem; overflow: hidden; background: #0f172a; aspect-ratio: 16/9; }
  .gallery-slider__main-image { width:100%; height:100%; object-fit:cover; display:block; }
  .gallery-slider__nav { position:absolute; top:50%; transform:translateY(-50%); width:3rem; height:3rem; border-radius:9999px; background:rgba(255,255,255,0.9); color:#1f2937; display:flex; align-items:center; justify-content:center; font-size:1.5rem; font-weight:700; box-shadow:0 10px 20px rgba(15,23,42,0.18); transition:transform .2s ease, background .2s ease; z-index:2; }
  .gallery-slider__nav--prev { left:1rem; }
  .gallery-slider__nav--next { right:1rem; }
  .gallery-slider__thumbs { display:grid; grid-template-columns:repeat(auto-fit, minmax(88px,1fr)); gap:.75rem; margin-top:1rem; }
  .gallery-slider__thumb { position:relative; border-radius:.9rem; overflow:hidden; border:2px solid transparent; opacity:.72; transform:translateY(0); transition:opacity .2s ease, transform .2s ease, border-color .2s ease; aspect-ratio:4/3; }
  .gallery-slider__thumb:hover { opacity:1; transform:translateY(-2px); }
  .gallery-slider__thumb.is-active { opacity:1; border-color:#bc6c25; box-shadow:0 10px 18px rgba(188,108,37,0.18); }
  .gallery-slider__thumb img { width:100%; height:100%; object-fit:cover; display:block; }
CSS;
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-background">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-5xl mx-auto text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-14 mb-4">Radni prostor</h1>
      <div class="font-body text-left">
        <p>Centar u svom sastavu ima:</p>
        <ul class="list-disc ml-8 my-1">
          <li>Konferencijsku salu sa 150 sedišta, kompletno tehnički opremljenu (laptop, projektor, platno, mikrofoni, ozvučenje, bela tabla, flip-čart tabla);</li>
          <li>4 standardne učionice sa po maksimalno 40 sedišta, svaka kompletno tehnički opremljena;</li>
          <li>Računarsku učionicu sa 16 umreženih računara i kompletnom tehničkom opremom za predavanja.</li>
        </ul>
        <p>Prema zahtevima klijenata prostor može biti namešten u raznim formama i za različite tipove rada. Sve prostorije za rad su klimatizovane. U toku rada mogu se koristiti i usluge keteringa.</p>
      </div>
      <a href="/uploads/documents/nasi_kapaciteti.pdf" target="_blank" class="my-4 inline-block bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition">
        Kapacitet učionica i sale
      </a>

      <?php
      $images = [
          ['src' => '/uploads/048ea103-ca69-4203-c2bc-e911f49c059e.jpg','alt'=>'Radni 1'],
          ['src' => '/uploads/c5d117ae-5fab-4a96-cee2-462ea4be6041.jpg','alt'=>'Radni 2'],
          ['src' => '/uploads/IMG_8499_resize.jpg','alt'=>'Radni 3'],
          ['src' => '/uploads/IMG_2206.jfif','alt'=>'Radni 4'],
          ['src' => '/uploads/9797c0d3-cd4c-4598-8278-c69d406ebed5.jpg','alt'=>'Radni 5'],
          ['src' => '/uploads/88fa0cdc-ae0f-4e92-8dbc-8026db87cdc7.jpg','alt'=>'Radni 6'],
          ['src' => '/uploads/e52d97ab-eb45-4c8a-bfa5-a398e6459280.jpg','alt'=>'Radni 7'],
          ['src' => '/uploads/4dc2e4f1-e9f0-439d-b364-2967f95ee986.jpg','alt'=>'Radni 8'],
          ['src' => '/uploads/a52c82f2-112e-466b-80eb-f29ce5e7749f.jpg','alt'=>'Radni 9'],
          ['src' => '/uploads/0bceb942-fcf1-456e-80de-d4db0c18a914.jpg','alt'=>'Radni 10'],
          ['src' => '/uploads/8523c9d2-c750-4abd-c00b-51ae9ccde771.jpg','alt'=>'Radni 11'],
          ['src' => '/uploads/47f2e6b6-7ab6-47de-8dc4-336d027caba6.jpg','alt'=>'Radni 12'],
          ['src' => '/uploads/3757a07b-5241-439c-f935-5b27d41ab3de.jpg','alt'=>'Radni 13'],
          ['src' => '/uploads/75c2f8d4-fbf5-473a-d0cc-b190229e7416.jpg','alt'=>'Radni 14'],
      ];
      ?>

        <section class="gallery-slider mt-8 mb-10" data-gallery-slider>
            <div class="gallery-slider__stage">
                <button type="button" class="gallery-slider__nav gallery-slider__nav--prev" data-slider-prev
                    aria-label="Prethodna">&#10094;</button>
                <img src="<?= htmlspecialchars($images[0]['src'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= htmlspecialchars($images[0]['alt'], ENT_QUOTES, 'UTF-8'); ?>" class="gallery-slider__main-image"
                    data-slider-main>
                <button type="button" class="gallery-slider__nav gallery-slider__nav--next" data-slider-next
                    aria-label="Sledeća">&#10095;</button>
            </div>
            <div class="gallery-slider__thumbs" data-slider-thumbs>
                <?php foreach ($images as $i => $img): ?>
                <button type="button" class="gallery-slider__thumb <?= $i===0? 'is-active':'' ?>" data-slider-thumb
                    data-src="<?= htmlspecialchars($img['src'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-alt="<?= htmlspecialchars($img['alt'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars($img['src'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?= htmlspecialchars($img['alt'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                </button>
                <?php endforeach; ?>
            </div>
        </section>

      <script>
      document.addEventListener('DOMContentLoaded', ()=>{
        document.querySelectorAll('[data-gallery-slider]').forEach(slider=>{
          const main = slider.querySelector('[data-slider-main]');
          const prev = slider.querySelector('[data-slider-prev]');
          const next = slider.querySelector('[data-slider-next]');
          const thumbs = Array.from(slider.querySelectorAll('[data-slider-thumb]'));
          if(!main||thumbs.length===0) return;
          let idx = Math.max(0, thumbs.findIndex(t=>t.classList.contains('is-active')));
          if(idx<0) idx=0;
          const set = i=>{ idx=(i+thumbs.length)%thumbs.length; const a=thumbs[idx]; const img=a.querySelector('img'); main.src=img?.src||a.dataset.src||main.src; main.alt=img?.alt||a.dataset.alt||main.alt; thumbs.forEach((t,n)=>t.classList.toggle('is-active',n===idx)); };
          thumbs.forEach((t,i)=>t.addEventListener('click',()=>set(i)));
          if(prev) prev.addEventListener('click',()=>set(idx-1));
          if(next) next.addEventListener('click',()=>set(idx+1));
          set(idx);
        });
      });
      </script>
    </div>
  </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
    $dataAboutUS = new AboutUs();
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
