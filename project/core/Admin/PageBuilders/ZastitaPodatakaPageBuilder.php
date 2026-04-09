<?php

namespace App\Admin\PageBuilders;

class ZastitaPodatakaPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-bold font-heading text-primary_text mb-4">Zakon o zaštiti podataka o ličnosti</h1>

      <p class="leading-relaxed mb-6 text-center text-xl">
        Sekretar ustanove Adrijana Jovanović je odgovorno lice za zaštitu podataka o ličnosti u PU „Dečja radost“ – Babušnica.
      </p>
      <p class="leading-relaxed mb-6 text-center text-xl">
        Telefon. 010/385-202, 069/3851255
      </p>
      <p class="leading-relaxed mb-6 text-center text-xl" data-translate="off">
        e-mail: sekretar.vrticbb@gmail.com
      </p>

      <div class="flex flex-col items-center">
        <a href="https://www.paragraf.rs/propisi/zakon_o_zastiti_podataka_o_licnosti.html"
          class="text-center font-body text-secondary_text hover:text-primary_hover mb-4"
          data-translate="off">
          https://www.paragraf.rs/propisi/zakon_o_zastiti_podataka_o_licnosti.html
        </a>

        <a href="/dokumenti" target="_blank"
          class="inline-block bg-primary hover:bg-primary_hover text-background py-3 px-6 rounded-lg shadow-md mb-4 transition"
          aria-label="Pogledajte dokumentaciju vezanu za Zakon o ličnosti">
          Dokumentacija
        </a>
      </div>

      <p class="text-sm mt-4 text-gray-600">
        Klikom na link bićete preusmereni na stranicu koja sadrži sva potrebna dokumenta.
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
