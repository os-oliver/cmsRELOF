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
      <h1 class="text-primary_text text-5xl font-heading mt-10 mb-8">Istorijat naše ustanove</h1>

      <div class="mx-5 text-justify text-xl space-y-6 pb-16">
        <p>
          Odlukom Ministarstva prosvete od 26. marta 1926. godine u Pirotu je otvoreno „odeljenje" zabavišta u sastavu Osnovne škole na Pazaru. Odeljenje Zabavišta u Tijabari počinje sa radom 1927. godine. Prva stručna zabaviljа Katica, Kajka Preda radila je sa decom od 1929. Od početka rada postojalo je veliko interesovanje roditelja za slanje dece u zabavište.
        </p>
        <img src="/assets/img/istorijat_slika.png" alt="Istorijat ustanove" class="w-full rounded-xl object-cover my-4" />
        <p>
          1947. godine u Pirotu je otvoreno prvo obdanište.
        </p>
        <p>
          1948. godine pet vaspitnih grupa Zabavišta u Tijabari i na Pazaru se izdvojilo u jedinstvenu samostalnu predškolsku ustanovu – Dečji vrtić „Čika Jova Zmaj".
        </p>
        <p>
          1949–1967. godine u Tijabari, na Trgu Karađorđa počinje sa radom prvi objekat namenski građen za decu predškolskog uzrasta – „Crvenkapа". Od 1973. godine u Pirotu radi novi objekat Vrtića na Pazaru u Ulici Vojvode Stepe – „Lane". Objekat za dnevni boravak dece „Prvomajski cvet" u krugu Industrije odeće „Prvi maj" počinje sa radom 1975. godine. U Tigrovom naselju otvoren je novi objekat vrtića namenski građen za decu starijeg predškolskog uzrasta „Neven".
        </p>
        <p>
          Putujući vrtić „Poletarac" u prilagođenom autobusu za rad sa decom iz seoskih sredina radio je u periodu od 1979. do 1999. godine. Od 1980. godine otvaraju se stalne vaspitne grupe šestogodišnjaka u seoskim naseljima: Gnilan, Krupac i Poljska Ržana. Neko vreme radile su vaspitne grupe u selima: Temska, Izvor, Sukovo i Crnoklište, ali zbog sve manjeg broja dece ovog uzrasta grupe su prestale sa radom. Sve češće se u selima organizuje rad u okviru punktova. Zbog sve manjeg broja dece poslednjih nekoliko godina u pojedinim selima u kojima imamo samo jedno ili dva deteta, sa njima radi učitelj i jednom do dva puta nedeljno patronažni vaspitač.
        </p>
        <p>
          Minimalni program počinje sa radom 1983. godine u objektu „Lane", a kasnije je ovaj program zaživeo i u objektima „Crvenkapа" i „Prvomajski cvet". Danas radi u vrtićima Lane i Crvenkapа sa pet vaspitnih grupa. Od 1996. godine u sklopu PU „Čika Jova Zmaj" radi i jedna vaspitna grupa za decu na bolničkom lečenju.
        </p>
        <p>
          2006. godina je za nas značajna jer je posle dužeg vremena u sklopu PU „Čika Jova Zmaj" otvoren novi vrtić „Bambi" za celodnevni boravak dece.
        </p>
        <p>
          Od prvog Zabavišta u Pirotu sa desetak mališana, do savremene Predškolske ustanove sa blizu 1200 dece i 6 objekata, prošlo je 93 godina. Tradicija duga skoro ceo vek i važnost brige o deci između porodičnog i školskog vaspitanja, kao i briga o telesnom i umnom razvoju deteta u predškolskom uzrastu, karakterišu organizovanu brigu o deci u Pirotu. Sa jedne strane istorija, obavezujuća i afirmativna, sa druge praćenje savremenih tokova i naučnih dostignuća, dve su glavne smernice koje oblikuju rast i razvoj Predškolske ustanove „Čika Jova Zmaj" u Pirotu.
        </p>
        <p>
          Savremena predškolska ustanova ima zadatak da deci obezbedi povoljnu društvenu i materijalnu sredinu u kojoj će ona ispoljiti sve svoje potencijale, zadovoljiti svoja interesovanja i naučiti mnogo toga.
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
