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


<section class="bg-background text-primary_text px-6 py-12 md:px-16 lg:px-24">

    <div class="max-w-5xl mx-auto">

        <!-- Glavni naslov -->
        <h1 class="font-heading text-primary text-4xl md:text-5xl lg:text-6xl font-bold mb-8 mt-10">
            Istorija Pozorišta „Dobrica Milutinović“
        </h1>

        <!-- Uvod -->
        <p class="font-body text-lg md:text-xl leading-relaxed text-secondary_text mb-10">
            Pozorište „Dobrica Milutinović“ u Sremskoj Mitrovici jedna je od
            najznačajnijih kulturnih ustanova u Sremu i predstavlja važan deo
            istorije i kulturnog identiteta grada. Iako je kao profesionalna
            pozorišna ustanova osnovano 1944. godine, pozorišna tradicija ovog
            kraja mnogo je starija i vezuje se za razvoj građanskog društva i
            kulturnog života Sremske Mitrovice tokom XIX veka.
        </p>

        <!-- Počeci -->
        <div class="mb-10">
            <h2 class="font-heading text-secondary text-2xl md:text-3xl font-semibold mb-4">
                Počeci pozorišnog života
            </h2>

            <p class="font-body text-base md:text-lg leading-8 text-primary_text">
                Pozorišni život u Sremskoj Mitrovici ima dugu tradiciju.
                Njegovi koreni sežu daleko u prošlost, a postoje pretpostavke
                da su se pozorišni sadržaji izvodili još u rimsko doba, kada
                je grad bio poznat kao Sirmium. Tokom XIX veka pozorište
                postaje sve značajniji deo kulturnog života građana, a
                izgradnja pozorišne zgrade 1894–1895. godine predstavlja
                važan trenutak u razvoju lokalne kulturne scene.
            </p>
        </div>

        <!-- Osnivanje -->
        <div class="mb-10">
            <h2 class="font-heading text-secondary text-2xl md:text-3xl font-semibold mb-4">
                Osnivanje i razvoj pozorišta
            </h2>

            <p class="font-body text-base md:text-lg leading-8 mb-5">
                Nakon Drugog svetskog rata, krajem 1944. godine, u Sremskoj
                Mitrovici počinje sa radom prva profesionalna pozorišna
                ustanova u Sremu. Umetnička ekipa Narodnooslobodilačkog
                odbora za Srem izvodila je predstave u sali Srpskog doma.
                Prva predstava bila je drama „Kralj Betajnove“
                u režiji Petra S. Petrovića Pecija.
            </p>

            <p class="font-body text-base md:text-lg leading-8 mb-5">
                Tokom narednih godina pozorište je više puta menjalo naziv
                i organizacioni oblik. Godine 1946. dobija naziv
                „Okružno narodno pozorište u Sremskoj Mitrovici“, a
                1948. godine postaje „Gradsko narodno pozorište u
                Sremskoj Mitrovici“.
            </p>

            <p class="font-body text-base md:text-lg leading-8">
                Zbog finansijskih i organizacionih poteškoća, krajem 1951.
                godine privremeno prestaje sa radom. Već 1952. godine
                obnavlja rad pod nazivom „Sremsko narodno pozorište“.
                Međutim, 1955. godine ponovo dolazi do prekida profesionalne
                pozorišne aktivnosti, nakon čega se okupljaju glumci amateri
                i osnivaju „Amatersko pozorište u Sremskoj Mitrovici“.
            </p>
        </div>

        <!-- Dobrica Milutinović -->
        <div class="mb-10">
            <h2 class="font-heading text-secondary text-2xl md:text-3xl font-semibold mb-4">
                Pozorište „Dobrica Milutinović“
            </h2>

            <p class="font-body text-base md:text-lg leading-8 mb-5">
                Godine 1974. pozorište dobija ime po jednom od
                najznačajnijih srpskih glumaca, Dobrici Milutinoviću,
                čime se odaje priznanje njegovom doprinosu srpskoj
                pozorišnoj umetnosti. Status profesionalnog pozorišta
                obnovljen je 1989. godine, čime je nastavljena njegova
                važna uloga u kulturnom životu Srema.
            </p>

            <p class="font-body text-base md:text-lg leading-8">
                Pozorište je tokom svog rada bilo domaćin Susreta
                profesionalnih pozorišta Vojvodine 1993. i 1998. godine.
                Posebnu pažnju posvećuje razvoju mladih talenata kroz
                Dramski i Omladinski studio, omogućavajući mladima da
                se upoznaju sa glumom, scenskim nastupom i pozorišnim
                stvaralaštvom.
            </p>
        </div>

        <!-- Obnova -->
        <div class="mb-10">
            <h2 class="font-heading text-secondary text-2xl md:text-3xl font-semibold mb-4">
                Obnova i značaj za savremeni kulturni život
            </h2>

            <p class="font-body text-base md:text-lg leading-8 mb-5">
                Zgrada pozorišta, koja predstavlja značajan deo
                arhitektonskog nasleđa Sremske Mitrovice, prošla je
                kroz veliku rekonstrukciju koja je započeta krajem
                2023. godine, a završena 2024. godine. Obnovom su
                unapređeni uslovi za izvođenje predstava, uz očuvanje
                autentičnog izgleda pozorišne sale iz XIX veka.
            </p>

            <p class="font-body text-base md:text-lg leading-8">
                Danas Pozorište „Dobrica Milutinović“ predstavlja važan
                centar kulturnog života Sremske Mitrovice. Svojim
                repertoarom namenjenim različitim generacijama, negovanjem
                pozorišne tradicije i podrškom mladim umetnicima, nastavlja
                da čuva i razvija kulturno nasleđe grada. Kao jedino
                profesionalno pozorište u Sremu, ono ima poseban značaj
                ne samo za Sremsku Mitrovicu već i za čitav region.
            </p>
        </div>

        <!-- Završni detalj -->
        <div class="border-l-4 border-primary bg-surface p-6 rounded-r-lg mt-12">
            <p class="font-heading text-secondary text-xl md:text-2xl italic">
                „Pozorište je mesto susreta umetnosti, istorije i ljudi.“
            </p>
        </div>

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
