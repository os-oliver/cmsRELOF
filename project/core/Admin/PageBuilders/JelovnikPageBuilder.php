<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class JelovnikPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">

    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading mb-4 text-primary_text">Naš jelovnik</h1>

      <p class="text-lg leading-relaxed mb-4 text-justify">Naš jelovnik okuplja najbolje ukuse iz sezone: pažljivo biramo svež sastojke od lokalnih proizvođača i spajamo tradicionalne recepte sa modernim pristupima kuvanja. Svako jelo pripremamo s namerom da istaknemo prirodnu aromu sastojaka i obezbedimo uravnotežnu, prijatnu degustaciju.</p>

      <p class="text-lg leading-relaxed mb-4 text-justify">Posebnu pažnju posvećujemo gostima sa dijetalnim zahtevima — uvek imamo opcije za vegetarijance, vegane i goste koji zahtevaju bezglutenske obroke. Ako imate alergije ili posebne zahteve, obavestite nas prilikom porudžbine kako bismo adekvatno prilagodili jelo.</p>

      <ul class="text-left list-disc list-inside max-w-3xl mx-auto mb-6">
        <li class="mb-2"><strong>Dnevne posebne ponude:</strong> Svakog dana pripremamo specijalitet koji je u centru pažnje i menja se u zavisnosti od sezone.</li>
        <li class="mb-2"><strong>Dečiji meni:</strong> Izbalansovane porcije i prilagođeni ukusi za najmlađe.</li>
        <li class="mb-2"><strong>Lokalan pristup:</strong> Podržavamo domaće proizvođače i koristimo sastojke iz poverenih izvora.</li>
      </ul>

      <div class="flex items-center justify-center gap-4">
        <a id="downloadMenuBtn" href="#" download class="inline-flex items-center gap-2 bm-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-5 rounded-lg shadow-md focus:outline-none focus:ring-4 focus:ring-green-300" aria-label="Preuzmi jelovnik">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 11-2 0V5H4v10a1 1 0 11-2 0V3z" clip-rule="evenodd"/><path d="M7 11a1 1 0 011.707-.707L9 11.586V2a1 1 0 112 0v9.586l.293-.293A1 1 0 0113 11l-3 3-3-3z"/></svg>
          Preuzmi PDF jelovnik
        </a>

        <a href="/kontakt" class="inline-block text-sm underline">Kontaktirajte nas za više informacija</a>
      </div>

      <p class="text-xs mt-4 text-gray-600">Napomena: Lorem ipsum...".</p>

    </div>
  </section>

  <script>
    (function () {
      const btn = document.getElementById('increaseFontBtn');
      const container = document.querySelector('section .relative.z-10');
      let scale = 1;
      btn?.addEventListener('click', () => {
        scale = Math.min(1.3, scale + 0.1);
        if (scale > 1.29) scale = 1; 
        container.style.transform = `scale(${scale})`;
        container.style.transition = 'transform 200ms ease';
      });

      const dl = document.getElementById('downloadMenuBtn');
      dl?.addEventListener('click', (e) => {
        const href = dl.getAttribute('href');
        if (!href) return;
      });
    })();
  </script>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
$menuDescription = "Naš jelovnik okuplja najbolje ukuse iz sezone: pažljivo biramo svež sastojke od lokalnih proizvođača i spajamo tradicionalne recepte sa modernim pristupima kuvanja."
; // koristimo varijablu ako negde drugde treba

PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
