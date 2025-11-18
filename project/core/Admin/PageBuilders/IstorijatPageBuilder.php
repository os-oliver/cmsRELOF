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
      <p class="font-body mb-4 text-left">
        Regionalni centri za profesionalni razvoj zaposlenih u obrazovanju uspostavljeni su kroz projekat Stručnog usavršavanja  obrazovnog kadra (Professional Development Project – PDP), zahvaljujući memorandumu o razumevanju, potpisanom 24. jula 2003, između vlada Švajcarske - Agencije za razvoj i saradnju (SDC) i Republike Srbije - Ministarstva prosvete.
      </p>
      <p class="font-body mb-4 text-left">
        Regionalni centar za profesionalni razvoj zaposlenih u obrazovanju – Užice, osnovala je 2006. godine Opština Užice, kao opštinsku instituciju odgovornu za obuku nastavnika i profesionalno usavršavanje u regionu, u skladu sa dokumentom Strategije Ministarstva prosvete Republike Srbije za period od 2005. do 2010. godine.
      </p>
      <h2 class="text-2xl mb-2 font-heading">Čime se bavi Regionalni centar?</h2>
      <p class="font-body mb-4 text-left">
        Regionalni centar primenjuje i sprovodi strategiju stručnog usavršavanja u regionu, u skladu sa strategijom profesionalnog razvoja koju je utvrdio Centar za profesionalni razvoj u saradnji sa drugim bitnim činiocima sistema obrazovanja Republike Srbije.
        
        Regionalni centar priprema i realizuje godišnje programe rada u skladu sa specifičnim potrebama u regionu, a u saradnji sa Centrom za profesionalni razvoj i Školskom upravom sprovodi programe od javnog i posebnog interesa.
      </p>
      <h2 class="text-2xl mb-2 font-heading">Osnovni zadaci i aktivnosti:</h2>
      <ul class="list-disc mb-4 text-left">
        <li>Snimanje i analiza potreba za stručnim usavršavanjem zaposlenih u obrazovanju</li>
        <li>Planiranje obuka i drugih vidova stručnog usavršavanja</li>
        <li>Organizovanje seminara i drugih oblika stručnog usavršavanja</li>
        <li>Kreiranje novih programa stručnog usavršavanja</li>
        <li>Praćenje primene i efekata različitih oblika stručnog usavršavanja</li>
        <li>Analiza ponude programa stručnog usavršavanja</li>
        <li>Formiranje i održavanje baze podataka</li>
        <li>Saradnja sa obrazovno-vaspitnim ustanovama, lokalnom zajednicom, 
          Zavodom / Centrom za profesionalni razvoj i Ministarstvom prosvete / Školskom upravom
        </li>
      </ul>
      <h2 class="text-2xl mb-2 font-heading">Regionalni centar je:</h2>
      <ul class="list-disc mb-4 text-left">
        <li>Mesto organizovanja i realizacije programa obuka</li>
        <li>
            Resursni centar (biblioteka sa stručnom literaturom, metodičko/didaktičkim materijalom, 
            pedagoško-psihološkim, video i audio materijalom; informacioni sistem: štampani i/ili 
            on-line informatori koji sadrže ponudu programa stručnog usavršavanja akreditovanih od strane 
            Zavoda za unapređivanje obrazovanja i vaspitanja / Centra za profesionalni razvoj)
        </li>
        <li>Mesto vrednovanja i praćenja kvaliteta stručnog usavršavanja</li>
        <li>Mesto okupljanja i razmene profesionalnih iskustava</li>
    </ul>
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
