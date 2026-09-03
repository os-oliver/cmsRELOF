<?php

namespace App\Admin\PageBuilders;

class UpisPageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-bold font-heading text-primary_text mb-4 mt-5">Upis</h1>

      <p class="leading-relaxed mb-6 text-center text-xl">
        Obaveštavamo roditelje/staratelje, da se prijave za upis dece u <strong class="mx-1">Predškolsku ustanovu „Dečja radost“ Babušnica</strong> mogu podneti elektronskim putem, korišćenjem usluge <strong class="mx-1">eVrtić</strong> na Portalu eUprava. <br>
Elektronska prijava omogućava jednostavno i brzo podnošenje zahteva bez dolaska u Predškolsku ustanovu. Prilikom podnošenja zahteva, nadležni organ po službenoj dužnosti pribavlja podatke iz službenih evidencija, osim u slučajevima kada je potrebno dostaviti dodatnu dokumentaciju (npr. dokaze za ostvarivanje prava na prioritet pri upisu ili drugu dokumentaciju propisanu konkursom).
Roditelji koji nisu u mogućnosti da podnesu prijavu elektronskim putem mogu se obratiti Predškolskoj ustanovi, gde će im biti pružena pomoć prilikom podnošenja zahteva. <br>
Nakon isteka roka za podnošenje prijava, Komisija za upis razmatra blagovremene i potpune zahteve i vrši rangiranje u skladu sa važećim propisima i Pravilnikom o uslovima za upis, prijem i ispis dece u Predškolsku ustanovu „Dečja radost“ Babušnica.
O rezultatima konkursa roditelji će biti blagovremeno obavešteni putem oglasne table i internet stranice Predškolske ustanove.<br>
Za sve dodatne informacije zainteresovani se mogu obratiti Predškolskoj ustanovi „Dečja radost“ Babušnica tokom radnog vremena od 7 do 15 časova ili na telefon broj 010/385202. <br><br>

<strong class="mx-1">Izveštaj konkursne komisije za upis dece za radnu 2026/2027 godinu</strong><br><br>

	Konkursna komisiija za upis dece održala je sastanak na kome su razmotrene sve prijave pristigle u predviđenom roku za upis dece u Predškolsku ustanovu za radnu 2026/2027 godinu. 
	Tokom trajanja konkursa pristiglo je ukupno <strong class="mx-1">40 prijava</strong>. <br><br>
  Nakon pregleda dokumentacije utvrđeno je da su <strong class="mx-1">tri prijave podnete za decu koja su već upisana u ustanovu</strong>, te nisu razmatrane u postupku upisa. Preostalih <strong class="mx-1">37 prijava ispunjava uslove za upis</strong>, a deca će biti raspoređena u vaspitne grupe u skladu sa uzrastom i organizacionim mogućnostima ustanove. <br>
	Komisija je takođe utvrdila da pojedini roditelji nisu dostavili kompletnu dokumentaciju, odnosno potvrdu izabranog pedijatra o vakcinalnom statusu deteta i lekarsko uverenje za boravak deteta u kolektivu, te će biti u obavezi da je dostave prilikom upisa.
	Na osnovu evidencije nadležnog Doma zdravlja, utvrđeno je da postoji još dece uzrasta za pohađanje pripremnog predškolskog programa koja nisu prijavljena tokom trajanja konkursa. Ustanova će preduzeti aktivnosti u cilju njihovog uključivanja u pripremni predškolski program, u skladu sa zakonskim propisima. <br>

      </p>
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
