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

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-5xl mx-auto text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading mt-10 mb-4">Istorijat naše ustanove</h1>
      <h2 class="text-3xl mx-5 italic mb-4 text-justify">
        Turistička organizacija regije Zapadna Srbija osnovana je sa ciljem da objedini napore lokalnih turističkih organizacija i promoviše turistički potencijal cele regije. Tokom godina, organizacija je postala ključni akter u razvoju turizma, aktivno radeći na očuvanju kulturnog i istorijskog nasleđa, promociji prirodnih atrakcija i razvijanju manifestacija koje privlače posetioce iz zemlje i inostranstva.

Kroz kontinuiranu saradnju sa opštinama, privredom i kulturnim institucijama, Turistička organizacija Zapadna Srbija je doprinela jačanju turističke infrastrukture, unapređenju turističke ponude i prepoznatljivosti regije kao atraktivne destinacije za sve vrste turizma – od kulturnog i istorijskog do aktivnog i gastronomskog.

Danas, organizacija predstavlja centralnu tačku za koordinaciju, promociju i razvoj turizma u Zapadnoj Srbiji, sa posebnim fokusom na održivi razvoj i uključivanje lokalnih zajednica u turističke inicijative.
</h2>
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
