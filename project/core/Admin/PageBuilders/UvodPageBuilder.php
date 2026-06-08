<?php

namespace App\Admin\PageBuilders;

class UvodPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-sans antialiased pt-10">

  <section class="py-20 bg-background text-center">
  <div class="container mx-auto px-6 max-w-4xl">
    
    <!-- Naslov -->
    <h2 class="text-5xl font-extrabold text-primary_text tracking-tight mb-6 relative inline-block">
      Održivost
      <span class="block w-24 h-1 bg-primary mx-auto mt-3 rounded-full"></span>
    </h2>

    <!-- Tekst -->
    <p class="text-lg text-left md:text-xl text-secondary_text leading-relaxed font-light italic">
        Gradski kulturni centar u Užicu je osnovan Odlukom Skupštine grada Užica
        broj I-022-23/2010 od 8.6.2010. godine („Službeni list grada Užica“ broj 14/2010) radi
        ostvarivanja prava, odnosno zadovoljavanja potreba građana u oblasti kulture, a
        naročito radi organizacije i promocije afirmativnih obrazovnih, kulturnih i
        sportskih sadržaja.
        <br><br>
        Ustanova je osnovana radi postizanja sledećih ciljeva:
    </p>
    <br><br>
    <ul class="text-lg text-left md:text-xl text-secondary_text leading-relaxed font-light italic">
        <li class="mb-4">
        -kreiranje, razvijanje i unapređenje kvalitetnih kulturnih, obrazovnih,
        zabavnih i drugih sadržaja za decu, omladinu i sve ostale građane bez obzira na to kojoj
        generaciji pripadaju,
        </li>
        
        <li class="mb-4">
        -promocija i podrška neafirmisanih amaterskih i drugih neformalnih grupa
        i pojedinaca koji se bave kulturom, umetnošću, neformalnim obrazovanjem i sportom,
        -afirmacija i podrška alternativnih programa i sadržaja iz oblasti kulture i
        umetnosti,
        </li>
        
        <li class="mb-4">
        -unapređenje položaja dece i mladih kroz obezbeđenje pristupa kvalitetnim
        kulturnim, obrazovnim i drugim sadržajima,
        </li>

        <li class="mb-4">
        -promocija podsticajnih programa u okviru politike lokalne zajednice
        namenjenih deci i mladima i afirmacija aktivizma i kreativnosti dece i mladih,
        tolerancije i nediskriminacije
        </li>

        <li class="mb-4">
        -razvijanje i unapređenje saradnje vladinih i nevladinih institucija i
        organizacija i biznis sektora na polju obrazovanja, kulture, umetnosti i sporta,
        </li>

        <li class="mb-4">
        -promocija, razvoj i unapređenje saradnje sa drugim kulturnim centrima u
        regionu, zemlji i inostranstvu
        </li>
        
        <li class="mb-4">
        -podsticanje kulturnog i umetničkog stvaralaštva osoba sa invaliditetom i
        dostupnosti svih sadržaja osobama sa invaliditetom.
        </li>
    </ul>
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
