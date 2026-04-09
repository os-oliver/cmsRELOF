<?php

namespace App\Admin\PageBuilders;

class UpisPageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading text-primary_text mb-4">Upis</h1>

      <p class="leading-relaxed mb-6 text-center text-xl">
        Poštovani roditelji,
        Obaveštavamo vas da će se upis dece uzrasta od 1 do 6,5 godina, u PU “Dečja radost” za radnu 2022/2023. godinu vršiti od <strong class="mx-1">01. APRILA do 1. MAJA 2022.</strong> godine.
        Obrazac prijave možete preuzeti na portalu 
        <a href="https://euprava.gov.rs/usluge/5577" class="hover:text-primary_hover ml-1" data-translate="off">https://euprava.gov.rs/usluge/5577</a>,
        <a href="/dokumenti?search=&sort=date_desc&categories%5B%5D=7" class="hover:text-primary_hover mx-1">sajtu Predškolske ustanove</a>
        ili ličnim dolaskom roditelja/staratelja u ustanovu. Upis se odnosi na decu koja se <strong class="mx-1">prvi put</strong> prijavljuju za pohađanje Predškolske ustanove.
        Za decu koja su već upisana i pohađaju Predškolsku ustanovu nije potrebno podnositi novu prijavu, već je roditelj/staratelj u obavezi da do 31. 8.2022. godine zaključi novi <strong class="mx-1">Ugovor o boravku deteta</strong>.
        Dokumentacija, koju je potrebno priložiti uz prijavu biće sastavni deo teksta konkursa koji će biti objavljen 1. aprila na sajtu PU.
        Detaljnije informacije o upisu roditelji će dobiti na <strong class="mx-1">DAN OTVORENIH VRATA</strong> u PU «DEČJA RADOST» dana 1. aprila 2022. godine sa početkom u 12 časova.
        PU “Dečja radost”
      </p>

      <p data-translate="off">
        sekretar.vrticbb@gmail.com
      </p>
      <p>
        Za sve dodatne informacije javite se na telefon 010 385 202
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
