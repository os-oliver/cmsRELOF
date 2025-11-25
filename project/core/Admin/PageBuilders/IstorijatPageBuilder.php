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
      src="/assets/img/pirot_nekad.jpg"
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
            src="/assets/img/pirot_nekad.jpg"
            alt="Pirot nekad"
            class="w-full h-[260px] md:h-[340px] lg:h-[380px] object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
          <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
            <h2 id="section-istorija" class="text-2xl md:text-3xl lg:text-4xl font-heading text-white drop-shadow">
              Istorija Pirota
            </h2>
            <p class="mt-2 text-sm md:text-base text-white/80 max-w-2xl">
              Od rimskog utvrđenja Mutacio Turess, preko srednjovekovnog Pirgosa i turskog Šerkjoja,
              Pirot je kroz vekove prolazio kroz poplave, zemljotrese, okupacije i ratove, ali je očuvao
              svoj duh i postao prepoznatljiv po ćilimima, kačkavalju, jagnjetini i zanatstvu.
            </p>
          </div>
          </div>

          <!-- Tekstualni deo -->
          <div class="space-y-4">
            <p>
              Prvobitno naselje formirano je na severozapadnom obodu istoimene kotline, oko zidina starog
              rimskog utvrđenja (gradić), koje je bilo u ondašnje karte (III vek) upisano pod imenom
              Mutacio Turess, što na latinskom znači kula. Naselje se razvilo zahvaljujući blizini
              poznate saobraćajnice toga vremena – Via militaris, a u srednjem veku poznate pod imenom
              Carigradski drum. U XIV veku se pominje pod nazivom Pirgos, što ima isto značenje.
              Turci uvode i nov naziv za Pirot – Šerkjoj, što znači varoško selo.
            </p>

            <p>
              U drugoj polovini XIX veka, kada je naš kraj bio pod Turcima, u blizini Pirota naselilo se
              muhamedansko pleme tatarskog porekla. Proterano iz Rusije, doselilo se u Tursku gde je
              raseljeno po celoj carevini. Blizu Velikog sela podigli su svoje selo – Čorin dol.
              Narod ga je kasnije nazvao čerkesko selo. Turci su ih odatle proterali, a selo spalili.
            </p>

            <p>
              U toku svog postojanja Pirot su deset puta plavile reke na čijim se obalama nalazi, a dva
              puta su ga ozbiljno potresli i razorili zemljotresi. Pirot i okolina podneli su veoma teško
              ropstvo pod Turcima, koje je trajalo 442 godine i okončano je 29. decembra 1877. godine.
              Posle borbi na Nišoru, Budin delu i u Pirotu, Turci su zauvek oterani iz ovog grada i naše zemlje.
            </p>

            <p>
              U srpsko–turskom ratu 1912. godine i u Prvom svetskom ratu 1914. godine, Piroćanci su se
              veoma hrabro borili i imali 7.610 poginulih boraca. U Drugom svetskom ratu 1941. godine
              Pirot i okolina, kao i čitava naša zemlja, bili su zanemareni i napušteni. Nemci su ušli
              u Pirot, a jedanaest dana kasnije prepustili ga, kao i čitav kraj, bugarskim fašistima.
              Tada je počela treća po redu, najduža bugarska okupacija. Počela je teška borba za
              oslobođenje koja je trajala tri i po godine.
            </p>

            <p>
              U Pirot je 8. septembra 1944. godine ušao Udarni bataljon Pirotskog partizanskog odreda
              i oslobodio ga. U narodnooslobodilačkoj borbi dalo je živote oko 2.000 Piroćanaca.
            </p>

            <p>
              Nekadašnji gradić zanatlija i pečalbara postao je poznat po svojim divnim ćilimovima,
              kačkavalju, jagnjetini, siru i grnčarskim proizvodima. Uz to, neverovatna lepota i
              bogatstvo prirodnim resursima Stare planine još tada je pružala sve svoje darove za život
              i rad na planini i proizvodnji najukusnijih proizvoda Balkana.
            </p>
            <br>
          </div>


        

      <!-- BLOK 2: Pirot DANAS -->
      <section aria-labelledby="section-danas">
      <!-- Glavna slika sa naslovom preko -->
      <div class="relative rounded-3xl overflow-hidden shadow-xl mb-10">
        <img
          src="/assets/img/danas.jpg"
          alt="Panorama Pirota"
          class="w-full h-[260px] md:h-[340px] lg:h-[380px] object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
          <h2 id="section-danas" class="text-2xl md:text-3xl lg:text-4xl font-heading text-white drop-shadow">
            Pirot danas
          </h2>
          <p class="mt-2 text-sm md:text-base text-white/80 max-w-2xl">
            Grad na istočno–mediteranskom pravcu, okružen Starom planinom i
            rezervatom Jerma, sa bogatim kulturnim nasleđem i prepoznatljivim
            gastronomskim brendovima.
          </p>
        </div>
      </div>

      <!-- Tekstualni deo -->
      <div class="space-y-4">
        <p>
          Položaj ove oblasti uslovljen je brojnom raznovrsnošću turističkih
          atrakcija, kao i njihovim različitim teritorijalnim rasporedom. Osim
          što zavisi od objekata i motiva, razvoj turizma ovde je vezan i za
          turistički pravac kretanja – istočno–mediteranski pravac koji povezuje
          Zapadnu i Srednju Evropu sa Bliskim istokom i Istočnim Mediteranom.
        </p>

        <p>
          Područje grada Pirota okruženo je sa severa i severoistoka Starom
          planinom, sa najvišim vrhom Midžorom (2.169 m n.v.). Južni i
          jugozapadni rub Pirotske kotline čine ogranci Vlaške planine
          (1.442 m n.v.) i Suve planine (1.809 m n.v.), dok severozapadni deo
          okružuju ogranci Svrljiške planine (1.334 m n.v.).
        </p>

        <p>
          Kroz ovu oblast prolazio je stari antički put Via Militaris
          (vojnički put), kasnije poznat kao Carigradski drum. Grad je, prolazeći
          kroz različite istorijske periode, menjao imena: u vreme Rimskog
          carstva u III i IV veku zvao se <em>Turres</em> (kula), a kasnije
          Pirgos, Thurib, Momčilov grad, Kale. Arheološka istraživanja srednjeg
          dela Pirotskog grada ukazuju da je na tom mestu postojalo naselje još
          pre oko 5.000 godina. U predelu starog grada otkriveni su tragovi iz
          eneolita i gvozdenog doba, a zatim i iz perioda antike, rane Vizantije
          i srednjeg veka.
        </p>

        <p>
          Danas je Pirot grad sa istom strateškom važnošću koju je imao i u
          prošlosti. Opština Pirot je jedna od najvećih u Srbiji po površini, sa
          ukupno 57.552 stanovnika (popis 2011). Istovremeno, grad Pirot je
          najveće naseljeno mesto i sedište Pirotskog okruga, koji obuhvata
          četiri opštine.
        </p>

        <p>
          Grad Pirot sa turističkim destinacijama Stara planina i Specijalni
          rezervat prirode Jerma spada u turistička mesta III kategorije, sa
          turističkim područjem površine veće od 1.000 km².
        </p>

        <p>
          Turistička ponuda Pirota i okoline obuhvata prirodno bogatstvo Parka
          prirode Stara planina i Specijalnog rezervata prirode Jerma, vodopade,
          reke, jezera, kanjone, klisure i pećine. Kulturno bogatstvo čine
          tradicija, običaji i pirotski govor, pirotsko ćilimarstvo i elementi
          sa Nacionalne liste nematerijalnog kulturnog nasleđa Srbije, srednjevekovna
          tvrđava Momčilov grad, Muzej Ponišavlja, kameno selo Gostuša i mnogi
          drugi lokaliteti.
        </p>

        <p>
          Sve to prati jedinstvena staroplaninska trpeza – pirotski kačkavalj,
          đubek, pirotska peglana kobasica, staroplaninska jagnjetina,
          staroplaninski med, sir, domaća vina i rakije, zahvaljujući kojima je
          Pirot prepoznat kao izuzetna evropska destinacija lokalne gastronomije.
          Posetite Pirot i uživajte u najlepšim pogledima Stare planine i
          ukusima pirotske trpeze.
        </p>
      </div>



        <!-- Mala galerija -->
        <div class="mt-10 grid gap-6 md:grid-cols-3">
        <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
          <img
            src="/assets/img/istorija/prt1.jpg"
            alt="Ulica u centru Pirota"
            class="w-full h-40 md:h-44 object-cover"
          />
          <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
            Spomenik slobodi u gradskom parku – simbol grada Pirota
          </figcaption>
        </figure>

        <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
          <img
            src="/assets/img/istorija/prt2.jpg"
            alt="Spomenik slobodi u Pirotu"
            class="w-full h-40 md:h-44 object-cover"
          />
          <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
            Pirotski kej – šetalište uz reku Nišavu u zalazak sunca
          </figcaption>
        </figure>

        <figure class="bg-surface rounded-xl overflow-hidden shadow-md">
          <img
            src="/assets/img/istorija/prt3.jpg"
            alt="Pirotski kej uz reku Nišavu"
            class="w-full h-40 md:h-44 object-cover"
          />
          <figcaption class="px-3 py-2 text-xs text-secondary_text italic">
            Staro gradsko jezgro Pirota – fasade i gradske kuće u centru
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
