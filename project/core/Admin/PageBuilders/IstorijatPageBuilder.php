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

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-background">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-5xl mx-auto text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading mt-10 mb-4">Istorijat naše ustanove</h1>
      <p class="text-3xl mx-5 mb-4 text-left text-black/80">Centar za razvoj usluga socijalne zaštite „Kneginja Ljubica“ Kragujevac osnovan
        je od strane Skupštine Grada Kragujevca 27. maja 2011. godine, kao ustanova koja ima za cilj uspostavljanje,
        pružanje i razvijanje usluga socijalne zaštite iz nadležnosti lokalne samouprave.</p>
      <p class="text-3xl mx-5 mb-4 text-left text-black/80">Centar ima svojstvo pravnog lica i od 10. novembra 2011. godine realizuje usluge za decu,
        odrasla i starija lica, u skladu sa Zakonom o socijalnoj zaštiti
        Republike Srbije i Odlukom o socijalnoj zaštiti Grada Kragujevca.</p>
      <p class="text-3xl mx-5 mb-4 text-left text-black/80">Ustanova se finansira iz budžeta Grada Kragujevca i
        sredstava po osnovu participacije korisnika, kao i iz donatorskih sredstava i projekata.</p>
      <p class="text-3xl mx-5 mb-4 text-left text-black/80">Vizija Centra je razvijena i efikasna mreža usluga socijalne
        zaštite koja na kvalitetan način zadovoljava raznovrsne potrebe građana i porodice u najmanje restriktivnom okruženju.</p>
      <p class="text-3xl mx-5 mb-4 text-left text-black/80">Usluge Centra realizuje tim stručnih radnika i saradnika
        koji ulažu ogromne napore kako bi se potrebe korisnika zadovoljile u skladu sa postavljenim standardima usluga.</p>
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
