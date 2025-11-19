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
      <h2 class="text-3xl mx-5 italic mb-4 text-justify">
        Prvi pisani tragovi o pozorišnom životu u Pirotu datiraju još od davne 1887. god. osnivanjem pirotske pozorišne družine. Kao u slučaju većine srpskih pozorišta, početak teatarskog života u Pirotu vezan je za sredinu četrdesetih godine prošlog veka. Naime, okružno diletantsko pozorište nastalo krajem 1944. god. inaguirisano je u Okružno narodno pozoršte februara 1945. godine i tada je određen repertoar, uprava i ansambl, a uz blagoslov Ministarstva prosvete. Maja 1946. godine održana je osnivačka skupština na kojoj je istaknuto da pozorište treba da bude namenjeno najširim slojevima i treba da bude ,,izvanredno sredstvo'' za vaspitanje; dakle, kako bi to Aristotel rekao - da zabavi i pouči. Pedesetih godina prošlog veka, dolazi do zamora amatera koji su radili u pozorištu, ali i do brojnih finansijskih problema. To je uslovilo sve oskudniji repertoar. Šezdesetih godina pirotsko Narodno pozorište uvodi u praksu angažovanje profesionalnih glumaca i saradnju sa rediteljima i scenografima.
        Godine 1967. u pozorištu je ostalo samo nekoliko glumaca, ali je vitalnost ove ideje proizvela činjenicu da se Narodno pozorište iz Pirota još uvek nalazi na teatarskoj mapi Srbije.
        Narodno pozorište Pirot postoji već 70 godina. Jedno je od najstarijih u zemlji. U svom profesionalnom radu imalo je i padova i uspona ali je uspelo da se održi čak i kada je u pozorištu radio samo jedan glumac. Danas, Narodno pozorište Pirot radi sa malim ali veoma talentovanim ansamblom i svake godine učestvuje sa uspehom na nekom od prestižnih festivala u Srbiji. Možemo se pohvaliti raznolikim repertoarom jer se trudimo da zadovoljimo potrebe i ukuse svakog gledaoca.  Pored saradnje sa pozorištima širom Srbije, Narodno pozorište Pirot uspešno sarađuje sa pozorištima iz inostranstva.
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
