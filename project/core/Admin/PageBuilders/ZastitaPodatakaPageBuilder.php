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

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 pb-16 hero-gradient">
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-5xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading text-primary_text mb-8 mt-5">Zaštita podataka o ličnosti</h1>

      <div class="text-left text-lg md:text-xl leading-relaxed space-y-4">
        <p>
          Predškolska ustanova „Pčelica“ Sremska Mitrovica, sa sedištem u ulici Marka Peričina Kamenjara broj 16, kao rukovalac podacima o ličnosti, obrađuje podatke o ličnosti u skladu sa Zakonom o zaštiti podataka o ličnosti („Službeni glasnik RS“, broj 87/2018) i drugim važećim propisima.
        </p>

        <p>
          Ustanova obrađuje podatke o ličnosti u svrhu obavljanja zakonom utvrđene delatnosti predškolskog vaspitanja i obrazovanja, ostvarivanja prava i obaveza dece, roditelja, odnosno drugih zakonskih zastupnika, zaposlenih i drugih lica, kao i radi ispunjavanja zakonskih obaveza ustanove.
        </p>

        <p>
          Obrada podataka vrši se u skladu sa načelima zakonitosti, poštenja, transparentnosti, ograničenja svrhe, minimizacije podataka, tačnosti, ograničenja čuvanja i obezbeđivanja odgovarajuće zaštite podataka.
        </p>

        <p>
          Ustanova primenjuje organizacione i tehničke mere zaštite podataka o ličnosti, radi sprečavanja neovlašćenog pristupa, korišćenja, otkrivanja, izmene ili gubitka podataka.
        </p>

        <p>
          Lica čiji se podaci obrađuju imaju prava utvrđena Zakonom o zaštiti podataka o ličnosti, uključujući pravo na pristup, ispravku, brisanje i ograničenje obrade, kada su za to ispunjeni zakonski uslovi, kao i pravo na podnošenje pritužbe Povereniku za informacije od javnog značaja i zaštitu podataka o ličnosti.
        </p>

        <p>
          Za pitanja koja se odnose na obradu i zaštitu podataka o ličnosti, zainteresovana lica mogu se obratiti licu za zaštitu podataka o ličnosti.
        </p>

        <h2 class="text-2xl md:text-3xl font-heading text-primary_text pt-4">
          Kontakt podaci lica za zaštitu podataka o ličnosti
        </h2>

        <ul class="space-y-1">
          <li><strong>Ime i prezime:</strong> Jelica Radaković</li>
          <li>
            <strong>Elektronska pošta:</strong>
            <a href="mailto:jelicaradakovic265@gmail.com" class="underline hover:text-primary">jelicaradakovic265@gmail.com</a>
          </li>
          <li>
            <strong>Kontakt telefon:</strong>
            <a href="tel:+381642523001" class="underline hover:text-primary">+381642523001</a>
          </li>
        </ul>

        <p class="font-semibold">Predškolska ustanova „Pčelica“ Sremska Mitrovica</p>

        <p class="text-base md:text-lg italic pt-4">
          Napomena: Navedeni tekst predstavlja osnovno obaveštenje. Detaljnija obaveštenja o konkretnim obradama podataka obezbeđuju se u skladu sa zakonom i dokumentacijom ustanove.
        </p>
      </div>
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
