<?php

namespace App\Admin\PageBuilders;

class ObjekatPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-sans antialiased pt-10">

  <section class="py-20 bg-background">
    <div class="container mx-auto px-6 max-w-5xl">

      <!-- Naslov sekcije sa linijom -->
      <h2 class="text-4xl font-extrabold text-text_primary mb-6 relative inline-block">
        Naš Objekat
        <span class="block w-24 h-1 bg-primary mt-2 rounded-full"></span>
      </h2>

      <!-- Glavni sadržaj -->
      <div class="flex flex-col md:flex-row md:gap-12 mt-10">

        <!-- Leva strana: slika i vertikalna linija -->
        <div class="flex flex-col items-center md:items-start md:w-1/3 relative">
<img src="" alt="Fotografija objekta" class="w-full h-auto rounded-lg mb-6 shadow-sm">

          <!-- Vertikalna linija -->
          <div class="hidden md:block absolute top-0 left-full h-full w-1 bg-primary ml-6 rounded-full"></div>
        </div>

        <!-- Desna strana: tekst -->
        <div class="md:w-2/3 flex flex-col justify-start">
          <p class="text-text_secondary text-base leading-relaxed mb-4">
            Ovaj objekat predstavlja funkcionalan i kvalitetno opremljen prostor, koncipiran tako da zadovolji profesionalne standarde i bezbednosne propise. Njegova lokacija omogućava odličnu povezanost sa centralnim tačkama, dok unutrašnja infrastruktura pruža pouzdanost i efikasnost u svakodnevnom radu.
          </p>

          <p class="text-text_secondary text-base leading-relaxed mb-4">
            Struktura objekta je jasno definisana, sa logičnim rasporedom prostorija i pristupačnim komunikacionim putevima, što doprinosi produktivnosti i jednostavnom korišćenju.
          </p>

          <!-- Horizontalna linija na kraju teksta -->
          <div class="w-full border-t border-primary mt-6"></div>
        </div>

      </div>

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
