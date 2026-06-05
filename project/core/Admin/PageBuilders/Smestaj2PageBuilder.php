<?php

namespace App\Admin\PageBuilders;

class Smestaj2PageBuilder extends BasePageBuilder
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
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-14 mb-4">Smeštaj</h1>
      <p class="max-w-4xl mx-auto text-lg leading-8 mb-12">
        Regionalni centar se nalazi u okviru šireg centra grada, na obodu parka „Sveti Sava“, pored crkve sv. Cara Konstantina i carice Jelene, osnovne škole „Sveti Sava“ i zgrade gradske opštine Medijana. Linijama gradskog saobraćaja 6 i 13 dobro je povezan sa najužim centrom grada.
        Centar od smeštajnih kapaciteta raspolaže sa 30 ležajeva (13 dvokrevetnih i 4 jednokrevetne sobe – TWC, AC, WiFi), uz mogućnost kompletne ishrane u samom objektu centra (doručak, ručak, večera, osveženje, kokteli). Recepcija radi 24 sata. Parking prostor za goste nalazi se u dvorištu centra, besplatan je, zaštićen i pod video nadzorom.
      </p>

      <?php
      $roomImages = [
          ['src' => '/uploads/48124e8d-dddb-4ed3-c3cd-e33c5c886a3e.png', 'alt' => 'Soba 1'],
          ['src' => '/uploads/22ebf2b4-b193-4c86-c349-8edae625a6b6.png', 'alt' => 'Soba 2'],
          ['src' => '/uploads/a4228a5a-0dd3-4814-84e6-9649a7f5c899.png', 'alt' => 'Soba 3'],
          ['src' => '/uploads/df318483-cc8e-4c73-f42d-bd4383d2b04f.png', 'alt' => 'Soba 4'],
          ['src' => '/uploads/dbf418ae-50cc-447e-af3a-a16ac3d99a0e.png', 'alt' => 'Soba 5'],
          ['src' => '/uploads/40adaf86-a4a3-4c07-a603-fe5f27a3316b.jpg', 'alt' => 'Soba 6'],
          ['src' => '/uploads/7d6bb5ef-2018-493f-f4eb-821da9865754.png', 'alt' => 'Soba 7'],
          ['src' => '/uploads/9546892a-9f3e-4e32-d7e6-3d73fa0d7a75.png', 'alt' => 'Soba 8'],
          ['src' => '/uploads/d3a5bf0a-e60d-49f0-ca90-ab07ec936e2a.png', 'alt' => 'Soba 9'],
          ['src' => '/uploads/66346f66-6a68-40a9-c93c-f7c96abfb2e5.png', 'alt' => 'Soba 10'],
      ];

      $diningImages = [
          ['src' => '/uploads/90d94bf7-4be2-43f1-90e5-2f9074afc72c.jpg', 'alt' => 'Trpezarija 1'],
          ['src' => '/uploads/887f1b0e-236e-4621-9dfb-8edae60cd08f.jpg', 'alt' => 'Trpezarija 2'],
          ['src' => '/uploads/51184de2-f963-4309-b62f-cb8c54f2aa9b.jpg', 'alt' => 'Trpezarija 3'],
      ];
      ?>
      
        <section class="gallery-slider mt-8 mb-10" data-gallery-slider>
            <h2 class="text-3xl font-heading font-bold text-primary_text text-left ml-2 mb-2">Sobe</h2>
            <div class="gallery-slider__stage">
                <button type="button" class="gallery-slider__nav gallery-slider__nav--prev" data-slider-prev
                    aria-label="Prethodna">&#10094;</button>
                <img src="<?= htmlspecialchars($roomImages[0]['src'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= htmlspecialchars($roomImages[0]['alt'], ENT_QUOTES, 'UTF-8'); ?>"
                    class="gallery-slider__main-image" data-slider-main>
                <button type="button" class="gallery-slider__nav gallery-slider__nav--next" data-slider-next
                    aria-label="Sledeća">&#10095;</button>
            </div>
            <div class="gallery-slider__thumbs" data-slider-thumbs>
                <?php foreach ($roomImages as $i => $img): ?>
                <button type="button" class="gallery-slider__thumb <?= $i===0? 'is-active':'' ?>" data-slider-thumb
                    data-src="<?= htmlspecialchars($img['src'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-alt="<?= htmlspecialchars($img['alt'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars($img['src'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?= htmlspecialchars($img['alt'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                </button>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="gallery-slider mt-8 mb-10" data-gallery-slider>
            <h2 class="text-3xl font-heading font-bold text-primary_text text-left ml-2 mb-2">Trpezarija</h2>
            <div class="gallery-slider__stage">
                <button type="button" class="gallery-slider__nav gallery-slider__nav--prev" data-slider-prev
                    aria-label="Prethodna">&#10094;</button>
                <img src="<?= htmlspecialchars($diningImages[0]['src'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= htmlspecialchars($diningImages[0]['alt'], ENT_QUOTES, 'UTF-8'); ?>"
                    class="gallery-slider__main-image" data-slider-main>
                <button type="button" class="gallery-slider__nav gallery-slider__nav--next" data-slider-next
                    aria-label="Sledeća">&#10095;</button>
            </div>
            <div class="gallery-slider__thumbs" data-slider-thumbs>
                <?php foreach ($diningImages as $i => $img): ?>
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
