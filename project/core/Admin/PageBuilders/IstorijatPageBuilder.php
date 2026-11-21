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

  <section class="relative min-h-screen flex items-start overflow-hidden pt-16 bg-background">
    <div class="relative z-10 w-full max-w-5xl mx-auto text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-10 mb-4">Istorijat naše ustanove</h1>
      <p class="text-3xl mx-5 italic mt-8 text-justify font-body">
        Regionalno pozorište Novi Pazar je jedno od najmlađih pozorišnih institucija u zemlji, otvoreno je 2003. u istoj zgradi sa Kulturnim centrom Novi Pazar godine i podržano je od Ministarstva kulture Republike Srbije. Pozorište svake godine učestvuje na prestižnim pozorišnim festivalima, i dobitnik je mnogih nagrada, od kojih je najbitnija Sterijina nagrada za najbolju predstavu na 66. Pozorju u Novom Sadu ( 18–26. jun 2021.) za delo „Ako dugo gledaš u ponor”.
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
