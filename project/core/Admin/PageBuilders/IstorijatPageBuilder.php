<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class IstorijatPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex overflow-hidden pt-16 bg-gradient-to-br from-green-50 to-teal-50 ">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-7xl mx-auto font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-16 mb-4 text-center">Istorijat naše ustanove</h1>
      <section class="mx-5 space-y-6 text-gray-700 leading-relaxed text-xl">

        <p>
            U susret novim zakonskim regulativama i iz nastojanja da se obezbedi kvalitetnija i odgovornija društvena briga o svakom građaninu grada Zrenjanina, Skupština grada Zrenjanina je dana 27.09.2019. godine donela Odluku o osnivanju Centra za pružanje usluga socijalne zaštite grada Zrenjanina – Most.
        </p>

        <p>
            Centar je počeo sa radom 01.01.2020. godine.
        </p>

        <p class="font-semibold text-gray-900">
            U sklopu Centra Most funkcioniše osam usluga socijalne zaštite:
        </p>

        <ul class="list-disc pl-6 space-y-2">
            <li>Prihvatilište za odrasle i stare u kriznim situacijama, beskućnike i prosjake</li>
            <li>Prihvatilište za žene i decu žrtve nasilja u porodici</li>
            <li>Dnevni boravak za decu i mlade sa telesnim invaliditetom, odnosno intelektualnim teškoćama „Alternativa“</li>
            <li>Dnevni boravak za odrasle sa telesnim invaliditetom, odnosno intelektualnim teškoćama „Naša priča“</li>
            <li>Usluga stanovanja uz podršku za mlade koji se osamostaljuju</li>
            <li>Produženo stanovanje za žene i decu žrtve nasilja u porodici</li>
            <li>Savetodavno-terapijske i socijalno-edukativne usluge „Savetovalište“</li>
            <li>Usluga lični pratilac deteta</li>
        </ul>

    </section>
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
