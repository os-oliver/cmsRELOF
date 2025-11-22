<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class IstorijatPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button
      id="increaseFontBtn"
      class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
      aria-label="Povećaj veličinu fonta"
    >
      A+
    </button>
  </div>

  <!-- Hero sekcija -->
  <section class="relative min-h-[420px] md:min-h-[520px] lg:min-h-[600px] overflow-hidden pt-16">
    <img
      src="/assets/img/istorijat/img1.jpg"
      alt="Istorijska zgrada u Kragujevcu"
      class="absolute inset-0 w-full h-full object-cover"
    />
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

    <div class="relative z-10 max-w-5xl mx-auto h-full flex flex-col justify-center px-4">
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading text-white mb-3">
        Istorija
      </h1>
    </div>
  </section>

  <!-- Glavni sadržaj -->
  <section class="bg-background py-12 md:py-16">
    <div class="max-w-5xl mx-auto px-4 md:px-0 font-body text-secondary_text leading-relaxed">

      <!-- Istorija Kragujevca -->
      <h2 class="text-3xl md:text-4xl font-heading text-primary_text mb-6">
        Istorija Kragujevca
      </h2>

      <p class="mb-4">
        Na području Grada Kragujevca nalazimo brojne tragove ljudskog života i ostatke materijalne kulture još iz praistorije. Pre dolaska Slovena, na teritoriji grada (i čitavog Balkanskog poluostrva), živeli su Iliri i Rimljani, koji su, takođe, značajno uticali na razvoj ovih krajeva. Ovu teritoriju Stefan Nemanja osvaja od Vizantije i pripaja je srpskoj državi, u XII veku. Dolinama brojnih vodotoka, putevi su vodili ka teritoriji današnjeg grada, gde prvobitno nastaje „pazarište“, trg ili „panađur“, na kojem se, radi razmene proizvoda, okupljaju stanovnici iz okoline, a kasnije i putnici.
      </p>

      <p class="mb-4">
        Posle pada srpske države pod tursku vlast, na području Kragujevca razvija se veoma značajno naselje, koje se pod nazivom „Kragujevdža“, prvi put pominje 1476. godine u turskim spisima, koji se danas čuvaju u Arhivu vlade Turske u Istanbulu.
      </p>

      <p class="mb-8">
        Smatra se da naziv grada potiče od kraguja, ptica grabljivica, koje su se koristile za lov, poput današnjih sokolova, a izgledom podsećaju na orlove i nalaze se na današnjem grbu grada.
      </p>

      <figure class="my-10">
        <img
          src="/assets/img/istorijat/img2.jpg"
          alt="Crtež grada Kragujevca iz 1837. godine"
          class="w-full h-auto object-cover shadow-md"
        />
        <figcaption class="mt-3 text-sm text-secondary_text italic">
          Kragujevac, 1837. godina
        </figcaption>
      </figure>

      <p class="mb-4">
        Za vreme dugotrajne vladavine Turaka, teritorija grada dva puta pada pod austrijsku vlast. U vreme druge vladavine Austrije, grad postaje važan vojno-strategijski centar, kojim rukovodi ober-knez Staniša Marković Mlatišuma. Beogradskim mirom 1739. godine, ponovo je uvedena turska uprava na čelu sa zloglasnim dahijom Kučuk Alijom. Od 1804. godine do 1813. godine trajao je Prvi srpski ustanak, posle kojeg grad ponovo zauzimaju Turci, da bi ga konačno napustili posle Drugog ustanka 1815. godine.
      </p>

      <p class="mb-8">
        Prekretnica i najznačajniji period u razvoju grada počinje 1818. godine, kada je knez Miloš Obrenović Kragujevac proglasio za prestonicu Srbije 6. maja, na Skupštini narodnih starešina, u manastiru Vraćevšnica. Tokom narednog perioda grad se planski urbanizuje i teritorijalno širi i postaje upravni, politički, kulturni, prosvetni, zdravstveni, vojni i privredni centar Srbije. Grade se privatne kuće i brojne ustanove sa obeležjima narodne arhitekture, ulice se kaldrmišu i osvetljavaju karbidnim lampama, a kuće se po Miloševoj naredbi pokrivaju crepom, umesto slamom, u cilju zaštite od požara. Na Lepenici se u to vreme grade tri drvena i prvi kameni most. U ovom periodu nema ratova i sve je u znaku procvata.
      </p>

      <figure class="my-10">
        <img
          src="/assets/img/istorijat/img3.jpg"
          alt="Milošev konak u Kragujevcu"
          class="w-full h-auto object-cover shadow-md"
        />
        <figcaption class="mt-3 text-sm text-secondary_text italic">
          Milošev konak
        </figcaption>
      </figure>

      <p class="mb-4">
        Prestonica je 1841. godine premeštena u Beograd i od tada se smanjuje broj stanovnika u Kragujevcu zato što odlaze brojni činovnici državne uprave. Međutim, 1851. godine Topolivnica je preseljena u Kragujevac, 1853. izliven je prvi top, a njenim prerastanjem u „Vojnotehnički zavod“, 1883. godine, javlja se potreba za novom radnom snagom, pa se oko zavoda formiraju i nova naselja (Palilula, Kolonija i Pivara) u kojima žive radnici koji su se doselili i njihove porodice.
      </p>

      <p class="mb-4">
        U Kragujevcu su organizovane prve radničke demonstracije u Srbiji, 15. februara 1876. godine poznate kao „Crveni barjak“.
      </p>

      <p class="mb-8">
        Tokom Prvog svetskog rata Kragujevac je ponovo bio prestoni grad u kojem je boravio regent Aleksandar Karađorđević i u njemu se nalazila Vrhovna komanda srpske vojske na čelu sa Radomirom Putnikom. U Kragujevcu su nastali i planovi čuvene Cerske i Kolubarske bitke, koje se i danas izučavaju na vojnim akademijama širom sveta. Između dva rata Kragujevac ostaje revolucionarni i idejni centar radničke klase. Najveća tragedija zadesila je grad tokom Drugog svetskog rata 21. oktobra 1941. godine, kada je, zbog nemačkih gubitaka u borbi sa četničkim i partizanskim jedinicama na putu Kragujevac – Gornji Milanovac, u Kragujevcu streljano nekoliko hiljada stanovnika, muškaraca, žena, učenika i mlađe dece. Posle tri godine, a na isti dan, 21. oktobra 1944. Kragujevac je oslobođen od nemačke okupacije.
      </p>

      <figure class="my-10">
        <img
          src="/assets/img/istorijat/img4.jpg"
          alt="Zgrada vojno-zanatlijske škole u Kragujevcu"
          class="w-full h-auto object-cover shadow-md"
        />
        <figcaption class="mt-3 text-sm text-secondary_text italic">
          Vojno-zanatlijska škola
        </figcaption>
      </figure>

      <!-- Kragujevac danas -->
      <h2 class="text-3xl md:text-4xl font-heading text-primary_text mt-12 mb-6">
        Kragujevac danas
      </h2>

      <p class="mb-4">
        Posle oslobođenja, 1944. godine, grad se obnavlja i vremenom postaje prepoznatljiv po kompaniji „Zastava“ i proizvodnji sportskog i lovačkog oružja, kao i gotovo 4.000.000 putničkih i teretnih automobila. Devedesetih godina u gradu se gotovo gase automobilska i druga industrijska proizvodnja, da bi posle 2000. godine ponovo doživeo privrednu ekspanziju.
      </p>

      <p class="mb-4">
        U Kragujevcu danas živi oko 190.000 stanovnika i po veličini je četvrti grad u Srbiji. Nalazi se u kragujevačkoj kotlini, na tromeđi Gledićkih planina, Rudnika i Crnog Vrha, a do njega se može doći iz pet putnih pravaca. Najznačajnija je povezanost sa međunarodnim koridorom 10, kojim se od Beograda stiže autoputem za sat i po (140 km). Na teritoriji grada nalazi se geografski centar Srbije, 8 kilometara severozapadno od centra, zbog čega Kragujevac ima izuzetno povoljan saobraćajno-geografski položaj. Grad se nalazi na nadmorskoj visini od 173 do 200 metara i prostire se na oko 835 kilometara kvadratnih.
      </p>

      <p class="mb-4">
        Grad Kragujevac je nosilac industrijskog i privrednog razvoja regiona Šumadije i Pomoravlja, a ujedno je i administrativni, univerzitetski, zdravstveni, kulturni i sportski centar, a danas ga sa razlogom nazivaju gradom mladih, odnosno gradom budućnosti.
      </p>

      <p class="mb-8">
        Posetiocima se pruža mogućnost da se upoznaju sa vrednom kulturno-istorijskom zaostavštinom, verskim, prirodnim i sportskim znamenitostima, ali i da uživaju u kvalitetnoj ugostiteljskoj ponudi, bogatom noćnom životu i raznovrsnim dešavanjima.
      </p>

      <figure class="my-10">
        <img
          src="/assets/img/istorijat/img5.jpg"
          alt="Panorama grada Kragujevca"
          class="w-full h-auto object-cover shadow-md"
        />
        <figcaption class="mt-3 text-sm text-secondary_text italic">
          Panorama Kragujevca
        </figcaption>
      </figure>

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
