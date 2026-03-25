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

      <div class="text-center text-lg md:text-2xl leading-relaxed space-y-4">
        <p>
          Poštovani roditelji/staratelji,
        </p>

        <p>
          Obaveštavamo vas da upis dece u PU „Pčelica‟ Sremska Mitrovica za radnu 2026/2027. godinu počinje 01.04.2026. godine i traje do 30.04.2026. godine.
        </p>

        <p class="font-semibold">
          VAŽNE NAPOMENE:
        </p>

        <p>
          - Pri kreiranju svog profila na eUpravi molimo vas da obratite pažnju i podesite ga tako da vam obaveštenja stižu putem mejla ili SMS-a. U protivnom, nećete dobiti obaveštenje da je zahtev za upis zaveden, niti ćete dobiti šifru koja se dodeljuje prilikom podnošenja zahteva.
        </p>

        <p>
          - Prilikom elektronskog popunjavanja zahteva za upis deteta, zahtev za jedno dete popuniti samo jedanput. Nema potrebe da se za isto dete zahtev popunjava više puta. Ukoliko roditelj nije siguran da je pravilno popunio zahtev elektronski, informaciju o tome može dobiti pola sata nakon popunjenog zahteva, radnim danima od 8:00 do 14:00 časova na broj telefona: 060/8010333.
        </p>

        <p>
          Za detalje o dokumentaciji, procedurama i uputstvom, pogledajte dokumentaciju klikom na link ispod.
        </p>
      </div>

      <a href="/dokumenti" target="_blank"
         class="inline-block bg-primary hover:bg-primary_hover text-background py-3 px-6 rounded-lg shadow-md mb-4 mt-10 transition"
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
