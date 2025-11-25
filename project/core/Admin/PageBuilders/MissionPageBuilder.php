<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;
use App\Models\AboutUs;

class MissionPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-body text-secondary_text">

    <!-- Dugme za povećanje fonta -->
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-semibold py-2.5 px-4 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-accent transition"
            aria-label="Povećaj font">
            A+
        </button>
    </div>

    <!-- HERO: Misija i vizija -->
    <section
  class="relative border-b border-secondary/30 text-center bg-cover bg-center bg-no-repeat min-h-[560px] flex items-center"
  style="background-image: url('/assets/img/mhero.jpg');"
>
  <!-- dark overlay over the image -->
  <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>

  <div class="relative container mx-auto px-4">
    <div class="inline-block px-6 py-4 md:px-10 md:py-6 bg-black/35 backdrop-blur-sm rounded-3xl shadow-xl">
      <h1
        class="text-4xl md:text-5xl font-heading font-extrabold text-white mb-3 tracking-tight drop-shadow-[0_2px_6px_rgba(0,0,0,0.7)]"
      >
        Misija i Vizija
      </h1>
      <p
        class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto drop-shadow-[0_1px_4px_rgba(0,0,0,0.7)]"
      >
        Načela koja nas vode i ciljevi kojima težimo.
      </p>
    </div>
  </div>
</section>


    <!-- O NAMA -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4 max-w-5xl text-center">
            <h2 class="font-heading text-3xl md:text-4xl text-primary_text">
                O NAMA
            </h2>

            <!-- line – icon – line -->
            <div class="mt-4 flex items-center justify-center gap-4">
                <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
                <img
                    src="/assets/img/title-icon.png"
                    alt=""
                    class="h-4 w-auto"
                />
                <span class="h-px w-16 md:w-24 bg-secondary_text"></span>
            </div>

            <p class="mt-8 text-lg text-secondary_text max-w-3xl mx-auto">
                Turistička organizacija opštine Pirot, osnovana 9. 9. 2004. godine.  
                Kao takva, bavi se unapređenjem i promocijom turističkih vrednosti pirotskog kraja.
            </p>

            <div class="mt-6 space-y-2 text-sm md:text-base text-secondary_text text-left max-w-3xl mx-auto leading-relaxed">
                <p>– izradom programa razvoja turizma i odgovarajućih planskih akata za turistička mesta na teritoriji opštine;</p>
                <p>– unapređenjem opštih uslova boravka u opštini Pirot i turističke privrede radi stvaranja atraktivnog turističkog ambijenta;</p>
                <p>– usmeravanjem i koordinacijom aktivnosti nosilaca turističke ponude, kao i podsticanjem izgradnje i razvoja turističke infrastrukture, sportsko-rekreativnih i drugih sadržaja;</p>
                <p>– organizovanjem turističko-informativne i propagandne delatnosti na teritoriji opštine, radi prezentacije i promocije turističkih vrednosti;</p>
                <p>– valorizacijom, očuvanjem i zaštitom turističkih vrednosti, prirodnih i antropogenih motiva pirotskog kraja.</p>
            </div>
        </div>
    </section>

    <!-- DELATNOSTI (tekst levo, slika desno) -->
    <section aria-labelledby="section-delatnosti" class="py-16 lg:py-20">
        <div class="container mx-auto px-4">
            <!-- Naslov + line–icon–line -->
            

            <!-- 2 kolone: tekst (centriran) + slika -->
            <div class="mt-10 grid gap-6 md:grid-cols-2 md:items-center lg:gap-16">
            <!-- LEFT: TEKST, CENTRIRAN -->
            <div class="space-y-4 text-center flex flex-col justify-center h-full">
                 <h2 class="font-heading text-3xl md:text-4xl text-primary_text">
                DELATNOSTI
            </h2>

            <div class="mt-4 flex items-center justify-center gap-4">
                <span class="h-px w-16 md:w-24 bg-secondary_text/70"></span>

                <img
                src="/assets/img/title-icon.png"
                alt=""
                class="h-4 w-auto"
                />

                <span class="h-px w-16 md:w-24 bg-secondary_text/70"></span>
            </div>
                <p>
                Turistička organizacija se bavi organizacijom izleta, obilascima
                kulturno–istorijskih spomenika, objekata i lokaliteta, obilaskom
                grada u pratnji lokalnih vodiča, zakazivanjem i najavom poseta,
                organizuje kulturne i sportske manifestacije i sajmove – posebno
                onih sa etno obeležjima ovog kraja.
                </p>

                <p>
                Pored toga, organizuju se kongresi i naučni skupovi, seminari,
                aktivnosti na podizanju turističke kulture stanovništva, kreiranju
                prepoznatljivog brenda ovog kraja, različite promocije i priredbe,
                kao i plasiranje proizvoda sa etno obeležjima područja. Organizacija
                pruža informacije i niz drugih usluga u skladu sa potrebama
                posetilaca i lokalne zajednice.
                </p>
            </div>

            <!-- RIGHT: SLIKA -->
            <figure class="bg-surface rounded-3xl overflow-hidden shadow-xl">
                <img
                src="/assets/img/delatnosti.jpg"
                alt="Turistička organizacija opštine Pirot – info centar"
                class="w-full h-64 md:h-72 lg:h-80 object-cover"
                />
            </figure>
            </div>
        </div>
        </section>


    

    <!-- Glavni sadržaj: Misija & Vizija -->
    <section class="py-20 lg:py-28 container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 lg:gap-16">

            <!-- Misija -->
            <div class="bg-surface border border-secondary/20 rounded-2xl p-10 transition">
                <header class="border-b border-secondary/30 pb-4 mb-6">
                    <h2 class="text-3xl font-heading font-semibold text-primary mb-2">Naša Misija</h2>
                    <p class="text-secondary_text/70 text-sm uppercase tracking-widest font-medium">
                        Svrha i posvećenost
                    </p>
                </header>
                <div class="text-secondary_text leading-relaxed prose prose-neutral max-w-none text-justify text-[1.05rem]">
                    <?= $mission ?>
                </div>
            </div>

            <!-- Vizija -->
            <div class="bg-surface border border-secondary/20 rounded-2xl p-10 transition">
                <header class="border-b border-secondary/30 pb-4 mb-6">
                    <h2 class="text-3xl font-heading font-semibold text-accent mb-2">Naša Vizija</h2>
                    <p class="text-secondary_text/70 text-sm uppercase tracking-widest font-medium">
                        Pogled ka budućnosti
                    </p>
                </header>
                <div class="text-secondary_text leading-relaxed prose prose-neutral max-w-none text-justify text-[1.05rem]">
                    <?= $vision ?>
                </div>
            </div>

        </div>
    </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'

        $dataAboutUS = new AboutUs();
        $mission = $dataAboutUS->list($locale)['mission'];
        $vision  = $dataAboutUS->list($locale)['goal'];
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
