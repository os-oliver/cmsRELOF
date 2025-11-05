<?php

namespace App\Admin\PageBuilders;

class RukovodstvoPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-sans antialiased pt-10">

  <section class="py-20 bg-background text-center">
  <div class="container mx-auto px-6 max-w-4xl">
    
    <!-- Naslov -->
    <h2 class="text-5xl font-extrabold text-text_primary tracking-tight mb-6 relative inline-block">
      Održivost
      <span class="block w-24 h-1 bg-primary mx-auto mt-3 rounded-full"></span>
    </h2>

    <!-- Tekst -->
    <p class="text-lg md:text-xl text-text_secondary leading-relaxed font-light italic">
      Održivost je više od koncepta — to je način delovanja. Svaka naša odluka donosi dugoročnu vrednost zajednici i okolini, uz poštovanje prirodnih resursa i društvene odgovornosti. 
      Verujemo da napredak ima smisla samo ako je održiv i etički ispravan.
    </p>

  </div>
</section>
</main>
HTML;

  public function buildPage(): string
  {
    $content = $this->getHeader();
    $content .= $this->getCommonIncludes();
    $content .= $this->html;
    $content .= $this->getFooter();
    return $content;
  }
}
