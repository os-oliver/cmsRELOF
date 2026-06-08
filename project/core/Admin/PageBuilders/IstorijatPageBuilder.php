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
      <p>
      Centar za socijalni rad Pirot je ustanova socijalne zaštite u kojoj se ostvaruju prava, primenjuju mere porodične i pravne zaštite, obezbeđuje pružanje usluga i obavljaju drugi poslovi u oblasti socijalne zaštite građana na području grada Pirota. 

Ova ustanova je osnovana 1. januara 1978. godine i do 2005. godine funkcionisala je kao međuopštinska organizacija nadležna za područja opština Pirot, Dimitrovgrad i Babušnica. Od 12. decembra 2005. godine nastavlja sa radom kao opštinska ustanova pod nazivom Centar za socijalni rad za opštinu Pirot. Nakon što je opština Pirot stekla status grada, 21. aprila 2017. godine ustanova dobija sadašnji naziv - Centar za socijalni rad Pirot.


      </p>
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
