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
      <h2 class="text-3xl mx-5 italic mb-4 text-justify">Regionalno pozorište Novi Pazar je profesionalna pozorišna ustanova u Novom Pazaru, osnovana 2003. godine. Predstavlja jednu od najmlađih pozorišnih institucija u Srbiji i značajan kulturni centar regiona. Radi u zgradi Kulturnog centra Novi Pazar uz podršku Ministarstva kulture Republike Srbije. Regionalno pozorište Novi Pazar smešteno je u zgradi Kulturnog centra Novi Pazar, u ulici Stefana Nemanje br. 2, u samom centru grada. Nalazi se u neposrednoj blizini centralne pešačke zone (Ulica 28. novembra), Žitnog trga i Muzeja „Ras”. Pozorište i Kulturni centar ostvaruju blisku saradnju u realizaciji programa. Trenutni direktor pozorišta je Seadetin Mujezinović.</h2>
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
