<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class IstorijatPageBuilder extends BasePageBuilder
{
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
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-10 mb-4">Istorijat naše ustanove</h1>
      <h2 class="text-3xl mx-5 italic mb-4 text-justify font-body">
        Gradski kulturni centar u Užicu je osnovan Odlukom Skupštine grada Užica broj I-022-23/2010 od 8.6.2010. godine („Službeni list grada Užica“ broj 14/2010) radi ostvarivanja prava, odnosno zadovoljavanja potreba građana u oblasti kulture, a naročito radi organizacije i promocije afirmativnih obrazovnih, kulturnih i sportskih sadržaja.
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
