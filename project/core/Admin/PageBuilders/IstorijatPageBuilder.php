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
      Galerija „Lazar Vozarević“ osnovana je i počela sa radom novembra 1973. godine izložbom slika i crteža Lazara Vozarevića. Galerija ima dva jasno profilisana dela: memorijalni i živi.<br><br>

      Osnovno galerijsko jezgro čini memorijalni deo koji se sastoji od originalnih slika, crteža, kolaža i materijala koji se vezuje za stvaralaštvo Lazara Vozarevića.<br><br>

      Lazar Vozarević rođen je 1925. godine u Sremskoj Mitrovici, a umro 1968. godine u Beogradu. Završio je Akademiju likovne umetnosti u Beogradu. Boravio je u Parizu 1951-1952, 1954-1956, 1958 i 1962. Pored slikarstva bavio se mozaikom i ilustracijom. Bio je docent na Akademiji likovnih umetnosti u Beogradu. Dela mu se nalaze u Galeriji “Lazar Vozarević“, Sremska Mitrovica, Muzeju savremene umetnosti u Beogradu, Umetničkoj galeriji na Cetinju kao i u značajnim zbirkama u inostranstvu: David Rockfeller (SAD), Guido Tervizan (Italija), Vila Lobos (Brazil), Philipe Baudet (Francuska), Paul Flockerman (SAD) i dr. Vozarević je samostalno izlagao u Beogradu, Zagrebu, Sremskoj Mitrovici, Parizu, Rimu, Brazilu, Veneciji, Njujorku i dr. Lazar Vozarević je u okviru jugoslovenske selekcije izlagao na Bijenalu mladih u Parizu, na Međunarodnoj izložbi u Tokiju, na Mediteranskom bijenalu u Aleksandriji i na Bijenalu u Sao Paolu.<br><br>

      Drugi deo u strukturi Galerije odnosi se na dinamičke akcije u oblasti žive i savremene umetnosti. Galerija organizuje dve stalne manifestacije: Sremskomitrovački salon (Vojvođanski salon) koji svake druge godine prikazuje najnovija dostignuća u oblasti likovne i primenjene umetnosti i arhitekture u Vojvodini i Likovni salon Srema na kome izlažu likovni stvaraoci sa ovog područja. Galerija je do sada organizovala preko 160 izložbi u svojim prostorijama i dvadesetak izložbi u zemlji i inostranstvu.
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
