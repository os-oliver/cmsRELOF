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
        Naša predškolska ustanova svedok je davnih vremena, učitelj sadašnjih i putokaz
        budućih. Naša istorija je duga preko 45 godina. Izgradnja prvog namenskog „Dečjeg
        vrtića“ (današnji objekat „Dečja radost“) započeo je 1975. godine, a završen je 1977.
        godine. Odbor za osnivanje vrtića donosi jula 1978. godine odluku o prijemu prvih
        radnika, a vrata vrtića ostvorena su za prvu generaciju od 7 predškolaca. Od te godine
        broj dece se iz dana u dan povećavao, a ustanova je proširivala svoje kapacitete, kao i
        broj zaposlenih.
        Danas je naš vrtić savremena predškolska ustanova koja deci pruža bezbedno,
        podsticajno i inspirativno okruženje za odrastanje, igru i učenje. Tokom godina objekat
        je kontinuirano unapređivan i prilagođavan potrebama dece i savremenim standardima
        predškolskog vaspitanja i obrazovanja. Dugi niz godina vrtić je bio namenjen deci
        uzrasta od tri godine do polaska u školu, a od 2022. godine proširio je svoje kapacitete
        otvaranjem jaslenih grupa, čime je omogućena briga i vaspitno-obrazovni rad sa decom
        najmlađeg uzrasta.
        Danas naš vrtić predstavlja mesto u kojem deca rastu, uče, istražuju i razvijaju
        svoje potencijale u atmosferi poverenja, uvažavanja i partnerstva sa porodicom i
        lokalnom zajednicom.
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
