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
      src="/assets/img/istorija/hero.jpg"
      alt="Istorijski predeli Lužnice"
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
    <div class="max-w-5xl mx-auto px-4 md:px-0 font-body text-secondary_text leading-relaxed space-y-20 md:space-y-24">

      <!-- BLOK 1: ISTORIJA LUŽNICE -->
      <section aria-labelledby="section-istorija">
        <!-- Glavna slika sa naslovom preko -->
        <div class="relative rounded-3xl overflow-hidden shadow-xl mb-10">
          <img
            src="/assets/img/istorija/nekad.jpg"
            alt="Istorijski motivi Lužničkog kraja"
            class="w-full h-[260px] md:h-[340px] lg:h-[380px] object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
          <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
            <h2 id="section-istorija" class="text-2xl md:text-3xl lg:text-4xl font-heading text-white drop-shadow">
              Istorija Lužničkog kraja
            </h2>
            <p class="mt-2 text-sm md:text-base text-white/80 max-w-2xl">
              Legende, rimska naselja, ustanci i ratovi – prošlost Babušnice i Lužnice ostavila je dubok trag u istoriji Srbije.
            </p>
          </div>
        </div>

        <!-- Tekstualni deo -->
        <div class="space-y-4">
          <p>
            Za Babušničku opštinu i Lužničku kotlinu vezano je više legendi i narodnih verovanja. Po jednoj legendi planina Stol („Stolski kamen“ ili u žargonu „Stolski kamik“) je dobila ime zbog toga što, posmatrana iz daljine, izgleda kao sto (stol). Po drugoj legendi planina Stol je zaravnjena jer je svojevremeno Marko Kraljević stao na tu planinu i bacio kamen čak na drugu planinu. Po sličnoj legendi je Marko Kraljević sa susednog brda skočio na „Stol“ i od siline ga zaravnio. To mesto odakle je navodno Marko Kraljević skočio zove se „Skokovje“.
          </p>

          <p>
            Po legendi jedan od izvora reke Lužnice u selu Ljuberađa nema dno. To mesto se zove „Komaričko vrelo“ ili „Komarički vir“. Na tom mestu u njega pada voda sa visine i izvire voda iz dubine tako da pored velike dubine voda ima nepravilno kretanje (kovitlanje). Osim toga, u tom vrelu (viru) ima mnogo rastinja tako da se do dna klasičnim metodama ne može dopreti. Ljudi su, navodno, pokušavali, motkama i konopcem na kome je vezan kamen, da dođu do dna ali nisu uspevali. Priča se da su se tu ranije mnogi kupači udavili zbog „lude hrabrosti“ i neopreznosti. Reka Murgovica, koja se u selu Ljuberađa uliva u reku Lužnicu, navodno je dobila naziv po tome što je često mutna („murgava“) – zbog sastava zemljišta kroz koje protiče ova reka se i kod malih kiša zamuti.
          </p>

          <p>
            Zbog pogodnih prirodnih uslova za ljudski život, ova oblast je neprekidno nastanjena – od praistorijskih vremena do danas. Arheološki nalazi pokazuju da je ovaj teren bio naseljen još u antičko doba, a ostaci rimskih utvrđenja i puteva svedoče da je ovde za vlade Rimljana postojalo više naselja. Lekoviti izvori Zvonačke banje bili su poznati ljudima od davnina. I u ovoj banji u antičko doba izvori su bili kaptirani, a na mestu današnje banje postojalo je naselje. Od rimskih banjskih naselja, prilikom raskopavanja terena 1903. godine, pronađeni su raznovrsni ostaci materijalne kulture. Otkriveno je više starih rimskih bazena, patos u jednom od njih, jedna spomen ploča, ostaci crkve i mnogi rimski novčići.
          </p>

          <p>
            Kod sela Strelac postoji gradić zvani Mogilika, gde je 1906. godine pronađena kompletna rimska vojna oprema, a tragovi gradića se i danas mogu videti. Pored ovih postoje i drugi tragovi vojničkih i drugih naselja u ostalim krajevima Lužnice za koje se pretpostavlja da su iz vremena Rimljana.
          </p>

          <p>
            Za vreme cara Dušana i neposredno posle njegove smrti, ovaj kraj je bio u sastavu srpske srednjovekovne države. Postoje podaci o ovom kraju za vreme turske vladavine. Kasnije, u XIX veku, pominju se ustanci stanovništva ovog kraja protiv Turaka. Za vreme Prvog srpskog ustanka došlo je ovde do previranja, jer je u blizini Lužnice operisao leskovački vojvoda Ilija Strelja sa svojim ustanicima. I kasnije, sve do oslobođenja ovog kraja od Turaka 1878. godine, bilo je nekoliko buna protiv obesne turske uprave.
          </p>

          <p>
            Lužničani su učestvovali u Prvom balkanskom ratu, kada je poginulo oko 250 vojnika. U Prvom svetskom ratu poginulo je oko 468 Lužničana. Nepovoljni događaji u drugim krajevima Srbije doveli su do povlačenja srpske vojske iz Lužnice. Mnogi borci iz Lužnice napustili su zavičaj i preko neprohodnih planina Albanije krenuli ka Jadranskoj obali. U proboju Solunskog fronta poginulo je 322 Lužničana. Na teritoriji Lužnice u toku Drugog svetskog rata poginulo je oko 820 ljudi.
          </p>

          <p>
            Godine 1889. donet je Zakon o opštinama koji je predviđao opštinsku samoupravu i omogućavao da opština (misli se na sresku opštinu) može imati najmanje 200 poreskih glava, što je omogućilo cepanje većih jedinica na manje opštine. Na teritoriji sreza Lužnica (današnja teritorija opštine Babušnica) došlo je do povećanja broja opština, tako da je na teritoriji ovog sreza u periodu od 1899. do 1918. godine ukinuto 24, a osnovane su 29 opština (treba imati u vidu da je u ovom periodu teritoriju opštine Babušnica naseljavalo više od 40.000 stanovnika).
          </p>

          <p>
            Posle Drugog svetskog rata došlo je do izvesnih teritorijalnih pregrupisavanja sreskih opština između susednih sreskih oblasti, tako da 1950. godine Lužnički srez ima 53 naselja koja se i do danas nalaze u sastavu opštine Babušnica. Lužnički srez 1960. godine (Službeni glasnik br. 51/59 od 01.01.1960. godine) postaje opština u sastavu Niškog sreza. Rasformiranjem srezova i formiranjem međuopštinskih regionalnih zajednica, opština Babušnica čini sastavni deo Niškog regiona.
          </p>
        </div>

        <!-- Mala galerija -->
        <div class="mt-10 grid gap-6 md:grid-cols-3">
          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img1.jpg"
              alt="Predeli Lužničke kotline"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Lužnička kotlina – prostor legendi i verovanja
            </figcaption>
          </figure>

          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img2.jpg"
              alt="Planina Stol"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Planina Stol – priče o Marku Kraljeviću
            </figcaption>
          </figure>

          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img3.jpg"
              alt="Rimski tragovi u Lužnici"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Rimska utvrđenja, putevi i banjska naselja
            </figcaption>
          </figure>
        </div>
      </section>

      <!-- BLOK 2: BABUŠNICA DANAS -->
      <section aria-labelledby="section-danas">
        <!-- Glavna slika sa naslovom preko -->
        <div class="relative rounded-3xl overflow-hidden shadow-xl mb-10">
          <img
            src="/assets/img/istorija/sad.jpg"
            alt="Panorama Babušnice"
            class="w-full h-[260px] md:h-[340px] lg:h-[380px] object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
          <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
            <h2 id="section-danas" class="text-2xl md:text-3xl lg:text-4xl font-heading text-white drop-shadow">
              Babušnica danas
            </h2>
            <p class="mt-2 text-sm md:text-base text-white/80 max-w-2xl">
              Savremeno središte Lužničke kotline – administrativni, kulturni i turistički centar okružen netaknutom prirodom.
            </p>
          </div>
        </div>

        <!-- Tekstualni deo -->
        <div class="space-y-4">
          <p>
            Babušnica je gradsko naselje u jugoistočnom delu centralne Srbije. Smeštena je u Lužničkoj kotlini, u dolini reke Lužnice.
          </p>

          <p>
            Babušnica je administrativno, kulturno, obrazovno, industrijsko i turističko središte opštine. Po popisu iz 2011. godine u njoj živi 4.578 stanovnika. Opštinu Babušnica, površine 529 kilometara kvadratnih, čine istoimeno gradsko naselje i pedeset dva naseljena mesta seoskog karaktera: Aleksandrovac, Berduj, Berin Izvor, Bogdanovac, Bratiševac, Brestov Dol, Vava, Valniš, Veliko Bonjince, Vojnici, Vrelo, Vuči Del, Gornje Krnjino, Gornji Striževac, Gorčinci, Grnčar, Dol, Donje Krnjino, Donji Striževac, Draginac, Dučevac, Zavidince, Zvonce, Izvor, Jasenov Del, Kaluđerovo, Kambelevci, Kijevac, Leskovica, Linovo, Ljuberađa, Malo Bonjince, Masurovci, Mezgraja, Modra Stena, Našuškovica, Ostatovica, Preseka, Provaljenik, Radinjinci, Radoševac, Rakita, Rakov Dol, Raljin, Resnik, Stol, Strelac, Studena, Suračevo, Crvena Jabuka i Štrbovac.
          </p>

          <p>
            Na teritoriji Babušnice život je prisutan od praistorijskih vremena. Ostaci rimskih utvrđenja i puteva govore o prisustvu antičkih Rimljana, koji su koristili termalne i lekovite izvore Zvonačke banje, oko koje postoje brojni ostaci građevina iz tog doba, među kojima su bazeni uređeni mozaicima i drugi nalazi. Za vremena cara Dušana kraj je bio u sastavu srednjovekovne srpske države. U XIV veku pada pod vlast Turaka sve do oslobođenja 1878. godine.
          </p>

          <p>
            Donošenjem zakona o opštinama 1889. godine, kojim je predviđeno da opštinsko mesto mora imati najmanje 200 poreskih obveznika, u lužničkom kraju status opštine je do 1918. godine dobilo 29 naselja.
          </p>
        </div>

        <!-- Mala galerija -->
        <div class="mt-10 grid gap-6 md:grid-cols-3">
          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img4.jpg"
              alt="Ulice Babušnice"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Babušnica – gradsko središte Lužnice
            </figcaption>
          </figure>

          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img5.jpg"
              alt="Lužnički pejzaži"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Prirodni pejzaži oko Babušnice
            </figcaption>
          </figure>

          <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
            <img
              src="/assets/img/istorija/img6.jpg"
              alt="Panorama Babušnice"
              class="w-full h-40 md:h-44 object-cover"
            />
            <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
              Panorama – spoj naselja i planina
            </figcaption>
          </figure>
        </div>
      </section>

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
