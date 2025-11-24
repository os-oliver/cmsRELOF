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

<section class="pt-24 pb-16 font-body text-secondary_text">
  <div class="max-w-4xl mx-auto">

    <h1 class="text-primary text-5xl font-heading font-bold mb-6 text-center">Историјат</h1>

    <p class="text-lg leading-relaxed text-justify">
     Narodna biblioteka Pirot je jedna od najstarijih kulturnih institucija u gradu. Iako postoje naznake da je postojala i u vreme Turaka, prvi pisani podatak o Čitaonici u Pirotu, koja je bila preteča današnje Biblioteke, objavljen je u listu „Istok“ 31. decembra 1878. godine (9. januara 1879. godine po novom kalendaru). Povod je bio priređivanje, na treći dan Božića, „prve besede sa igrankom, a u korist sirotnih đaka pirotskih“. Godine 1880. Čitaonica je imala 45 članova sa godišnjim ulogom od osam dinara. Članovi su mogli da čitaju srpske listove: „Videlo“, „Ratnik“, „Starmali“, „Javor“, „Tagblat“ i druge, a na raspolaganju im je bilo 348 knjiga. Fond je bio smešten u privatnoj kući. Početni entuzijazam je trajao kratko, do 1881. godine kada Čitaonica prestaje sa radom.
      <img src=""
           class="float-right w-72 ml-4 mb-2 rounded shadow"
           alt="">
     Prvi ozbiljniji napor za oživljavanje čitaonice u Pirotu učinjen je tokom 1908-1909. godine, kada je Ukazom Kralja Petra I Karađorđevića od 14. januara ustanovljena Javna biblioteka u Pirotu. Uprkos preduzetim opsežnim merama za nabavku i kupovinu potrebnih knjiga, časopisa i ostalog što je potrebno za rad biblioteke, Javna biblioteka u Pirotu je u svom radu nailazila na često nepremostive teškoće. U odgovoru Živka Joksimovića, knjižničara, na dopis Ministarstva prosvete stoji: „Rad još nije otpočet, niti će to uskoro biti, jer: 1) inventar još nije gotov; 2) bibliotekar još nije ispisao kartone; 3)  Biblioteka je bez ogreva; 4) nema momka da pomogne bibliotekaru; 4) nema nikakvih pravila o davanju knjiga; 6) nema novčanih sredstava za podmirivanje tekućih potreba; 7) treba izabrati bibliotekara koji će imati dovoljno vremena za rad u Biblioteci; 8) treba odrediti stalnu godišnju pomoć; 9) uz Biblioteku treba otvoriti i Čitaonicu“.
    </p>

    <p class="clear-both text-lg leading-relaxed text-justify mt-6">
      Rad Javne biblioteke u Pirotu potpuno je zamro u godinama balkanskih i Prvog svetskog rata kada su bugarski okupatori uništili fond spaljivanjem i prenošenjem knjiga u Sofiju. U periodu između dva svetska rata, kao ni za vreme Drugog svetskog rata, Javna biblioteka nije radila. Postojala je školska biblioteka u Gimnaziji sa većim fondom knjiga.

      Gradski Narodni front Pirota 17. maja 1947. godine, obnavljajući bibliotečku delatnost, osnovao je Gradsku knjižnicu sa čitaonicom.
      <img src=""
           class="float-left w-72 mr-4 mb-2 rounded shadow"
           alt="">
      Prvi period po formiranju Biblioteke u Pirotu je značajan po ogromnom angažovanju na popularizaciji knjige i čitanja. Da bi se stiglo i do najudaljenijih naselja u opštini koristili su se motocikl, konji i mazge. Šezdesetih godina prošlog veka pirotska Biblioteka je imala vrlo razgranatu mrežu stacioniranih ogranaka u seoskim naseljima i jedan ogranak u industrijskoj zoni grada, dok je bibliobusom opsluživano 36 naselja.
    </p>

    <p class="clear-both text-lg leading-relaxed text-justify mt-6">
      Biblioteka je postala centar kulturnih događanja u opštini, organizovane su književne večeri, tečajevi za učenje stranih jezika, radionice za likovne talente, postojalo je i malo lutkarsko pozorište, a izdavan je i dečji list „Glas najmlađih“.
      <img src=""
           class="float-right w-72 ml-4 mb-2 rounded shadow"
           alt="">
      Za postignute rezultate u razvijanju bibliotečke delatnosti, Narodna biblioteka Pirot je dobila Sedmojulsku povelju 1963. godine i nagradu „Milorad Panić Surep“ 1980. Surepovu nagradu za unapređivanje bibliotečke delatnosti i razvoj bibliotekarstva dobio je 1971. godine i tadašnji direktor Biblioteke Siniša Jovanović. Pored njegovog višedecenijskog upravljanja Bibliotekom, na čelu ove ustanove bili su i Slobodan Jončić, Dragana Jovanović-Đurđić, Momčilo Antić a trenutno biblioteku vodi Nadica Kostić.
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
