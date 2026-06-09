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
        Dom kulture je osnovan 1986 godine a raspolažemo objektom od 2.000 kvadratnih metara sa velikom salom koja prima 360 gledalaca, većim brojem sala za probe igračkih i muzičkih sekcija, Medija centrom, tonskim studijom i savremenim Klubom koji prima do 130 gledalaca.

        Folklorni ansambl raspolaže velikim fundusom narodnih nošnji i instrumenata, a ustanova poseduje dva koncertna klavira, razglas 12 KW, montažnu binu od 250 m2, i veći broj savremenih audio i video sredstava.

        Osnivač Doma kulture: SO Pirot.

        Direktor: Miško Ćirić
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
