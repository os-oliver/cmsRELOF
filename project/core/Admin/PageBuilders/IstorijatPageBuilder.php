<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class IstorijatPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="mt-20">
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
      <h2 class="text-3xl mx-5 italic mb-4 text-justify">KUĆA PORODICE HRISTIĆ – KONAK MALOG RISTE</h2>
      <p>Kuća porodice Hristić predstavlja najbolje očuvani spomenik tradicionalne arhitekture iz sredine XIX veka u Pirotu. Svojom lepotom i graditeljskim karakteristikama premašuje granice Srbije i čini deo kulturne baštine Balkana.
          Pripadala je uglednom pirotskom trgovcu Hristi Jovanoviću. On ju je podigao kao dom za svoju porodicu. Po predanju građena je dve godine i dovršena je 5. aprila 1848. godine. O tome svedoči urezan tekst na spratu kuće. Za zidanje kuće, Malom Risti, kako su ga zvali, bila je potrebna dozvola od turskih vlasti, jer je nameravao da to bude velika kuća na sprat. Tako je, na periferiji Pirota, podignuta jedna od najraskošnijih hrišćanskih kuća u Pirotu onog doba.Na žalost, nigde ne postoje podaci o majstorima koji su je podigli.</p>

      <p>I do danas je ostala enigma, ko je došao na ideju da podigne takvu kuću – da li gazda Rista, putujući turskim carstvom za svojim trgovačkim poslovima ili izuzetni majstori koji su je podigli utkajući u nju spoj mašte i graditeljskog iskustva.</p>

      <p>U kući je živeo Hrista Jovanović sa svojom porodicom, a kasnije i njegovi naslednici, koji su prezime Jovanović, preinačili u Hristić. Posle Drugog svetskog rata, kuća menja svoju namenu jer je Opština Pirot dodeljuje novoformiranom narodnom muzeju u Pirotu. Kuća u rasporedu i detaljima ima sve odlike balkansko orijentalnog stila. Karakteriše je sklad unutrašnjih prostorija i u isto vreme raskošnost fasade i krova.</p>

      <p>Bondručna konstrukcija i veština majstora u njenom izvođenju dali su joj začuđujuću lakoću. U osnovi je tip simetrične zgrade skoro kvadratnog oblika, sa krstastim holom. Sastoji se od podruma, prizemlja i sprata. Krunu građevine čini jedinstveno rešenje krova sa konstrukcijom vidikovca. Na blistavo beloj fasadi glavni dekorativni elementi su drveni ramovi prozora, kao i uglovi zidova koji su obloženi daskama ukrašenim profilisanim letvicama.</p>
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
