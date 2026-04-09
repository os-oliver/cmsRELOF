<?php

namespace App\Admin\PageBuilders;

class SavetRoditeljaPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 font-body text-secondary_text">
        <h1 class="text-5xl font-heading text-primary_text mb-6 mt-10 text-center">Savet roditelja</h1>

        <div class="text-xl leading-relaxed space-y-4 text-center">
        <p>Članovi Saveta roditelja PU „Dečja radost“ Babušnica su:</p>

        <p class="text-xl font-bold text-center">
            Jelena Miladinović, predsednik<br>
            Emilija Ilić<br>
            Marija Filipović<br>
            Marija Smiljić<br>
            Valentina Jović<br>
            Julijana Petrov
        </p>

        <p class="font-semibold mt-4">Savet roditelja:</p>

        <ol class="list-decimal list-inside text-left inline-block">
            <li>predlaže predstavnike roditelja dece, odnosno učenika u organ upravljanja;</li>
            <li>predlaže svog predstavnika u stručni aktiv za razvojno planiranje i u druge timove ustanove;</li>
            <li>predlaže mere za osiguranje kvaliteta i unapređivanje obrazovno-vaspitnog rada;</li>
            <li>učestvuje u postupku predlaganja izbornih predmeta i u postupku izbora udžbenika;</li>
            <li>razmatra predlog programa obrazovanja i vaspitanja, razvojnog plana, godišnjeg plana rada, izveštaje o njihovom ostvarivanju, vrednovanju i o samovrednovanju;</li>
            <li>razmatra namenu korišćenja sredstava od donacija i od proširene delatnosti ustanove;</li>
            <li>predlaže organu upravljanja namenu korišćenja sredstava ostvarenih radom učeničke zadruge i prikupljenih od roditelja;</li>
            <li>razmatra i prati uslove za rad ustanove, uslove za odrastanje i učenje, bezbednost i zaštitu dece i učenika;</li>
            <li>učestvuje u postupku propisivanja mera iz člana 42. ovog zakona;</li>
            <li>daje saglasnost na program i organizovanje ekskurzije, odnosno programe nastave u prirodi i razmatra izveštaj o njihovom ostvarivanju;</li>
            <li>razmatra i druga pitanja utvrđena statutom.</li>
        </ol>

        <p class="mt-4 mb-10">
            Savet roditelja svoje predloge, pitanja i stavove upućuje organu upravljanja,
            direktoru i stručnim organima ustanove. Način izbora saveta roditelja ustanove uređuje se statutom ustanove.
        </p>
        </div>
    </div>
    </section>

  <script>
    (function () {
      const btn = document.getElementById('increaseFontBtn');
      const container = document.querySelector('section .relative.z-10');
      let scale = 1;
      btn?.addEventListener('click', () => {
        scale = Math.min(1.3, scale + 0.1);
        if (scale > 1.29) scale = 1;
        container.style.transform = `scale(${scale})`;
        container.style.transition = 'transform 200ms ease';
      });
    })();
  </script>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
        $docUrl = '/files/upis-dokumentacija.pdf'; 
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
