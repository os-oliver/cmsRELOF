<?php

namespace App\Admin\PageBuilders;

class UpisPageBuilder extends BasePageBuilder
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
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading text-primary_text mb-4">Upis</h1>

      <p class="leading-relaxed mb-6 text-center">
        Dobrodošli! Ovde možete pronaći sve informacije o upisu u našu predškolsku ustanovu. 
        Za detalje o dokumentaciji i procedurama, pogledajte dokumentaciju klikom na link ispod.
      </p>

      <a href="/dokumenti" target="_blank"
         class="inline-block bg-primary hover:bg-primary_hover text-background py-3 px-6 rounded-lg shadow-md mb-4 transition"
         aria-label="Pogledajte dokumentaciju za upis">
        Dokumentacija za upis
      </a>

      <p class="text-sm mt-4 text-gray-600">
        Klikom na link bićete preusmereni na stranicu koja sadrži sve potrebne informacije za upis.
      </p>
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
    })();
  </script>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
        $docUrl = '/files/upis-dokumentacija.pdf'; 
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
