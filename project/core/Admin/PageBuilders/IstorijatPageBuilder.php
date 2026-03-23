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
      <h1 class="text-primary_text text-5xl font-heading mt-10 mb-4">Istorijat naše ustanove</h1>
      <h2 class="text-3xl mx-5 italic mb-4 text-justify">
        Predškolska ustanova „Pčelica“ u Sremskoj Mitrovici ima bogatu tradiciju koja svoje korene vuče još iz 1944. godine. Tada su u različitim krajevima grada formirana tri vrtića sa ciljem da se zbrinu deca koja su tokom rata ostala bez oba roditelja. Oko stotinu dece je dobilo siguran i topao dom, uz organizovanu ishranu, vaspitni i lekarski nadzor, a sve zahvaljujući zalaganju majki i podršci AFŽ-a. Godine 1945. svi vrtići su se udružili u jednu celinu pod nazivom „Prvo dečje gradsko obdanište“, što je predstavljalo temelj za dalji razvoj ustanove. Od tada, „Pčelica“ je prolazila kroz brojne promene i usavršavanja, a njena zvanična godina osnivanja kao javne predškolske ustanove je 1966.
        Tokom godina, „Pčelica“ se razvijala sa jasnom vizijom: stvoriti okruženje u kojem deca rastu uz igru, istraživanje i ljubav. Prvi objekat nastavio je da služi kao temeljni prostor za gradsku decu, a vremenom su se otvarali dopunski objekti u prigradskim naseljima, uključujući i područne grupe u malim sredinama, kako bi svakom detetu obezbedili pristup vaspitanju bez obzira na mesto prebivališta.
        <br><br>
        Danas, sa sedištem na adresi Marko Peričin Kamenjar br. 16, i uz potvrdu Pokrajinskog sekretarijata za obrazovanje iz 2010. godine, „Pčelica“ raspolaže sa devet modernih građevinskih objekata — sedam u urbanom delu grada, dva u prigradskim naseljima, kao i sa devetnaest radnih prostora u seoskim sredinama.
        <br><br>
        Objekat „Zvezdica“ je 2008. godine svečano otvoren objekat. Ovaj prostor postao je simbol napretka i posvećenosti, jer je omogućio da deca iz Sremske Mitrovice i okolnih sela dobiju kvalitetnu predškolsku pripremu u toplom i podsticajnom okruženju. „Pčelica“ je podrška i oslonac za sve porodice – bez obzira da li žive u centru grada ili u udaljenijim seoskim područjima.
        U aprilu 2021. godine svečano je otvoren savremeni objekat „Čuperak“ u Laćarku. Nova zgrada, osluškujući potrebe savremenog predškolstva, je prostorno i funkcionalno prilagođena, sa savremenim radnim sobama, bezbednim igralištima i zelenim površinama koje omogućavaju da deca borave u stimulativnom i prijatnom okruženju. Ovaj objekat je značajan korak u širenju kapaciteta i unapređenju infrastrukture „Pčelice“ i pokazatelj dobrog odgovora lokalne samouprave na sve veću potrebu za predškolskim servisom.
        Objekat „Maslačak“ u sastavu PU „Pčelica“ godinama predstavlja više od vaspitno-obrazovnog prostora. Simbol je inkluzije, podrške i razumevanja, mesto gde se svako dete prihvata i razvija u skladu sa svojim potencijalima. Rad i pristup u „Maslačku“ prepoznati su i van lokalne zajednice – od strane UNICEF-a i drugih relevantnih organizacija kao primer dobre prakse u inkluzivnom obrazovanju.
        <br><br>
        U ustanovi se neguju vrednosti koje idu daleko van zidova vrtića. Svake godine, kroz brojne humanitarne i društveno odgovorne akcije, deca se podstiču da rastu u empatične, društveno osetljive i odgovorne ličnosti. Humanitarni bazari, prikupljanje pomoći za one u teškim životnim situacijama, ekološke akcije, inicijative za pomoć vršnjacima, kao i saradnja sa lokalnom zajednicom, sve su to prilike u kojima deca aktivno učestvuju.
        <br><br>
        Svake godine, kao deo lepe tradicije, u PSC „Pinki“ održava se Završna priredba predškolaca – svečanost koja obeležava završetak vrtićkih dana i prelazak u novo, školsko razdoblje. Suštinske vrednosti – timski rad, emotivna povezanost i javno predstavljanje dečjih ostvarenja – pojačavaju lokalni duh i predstavljaju snažan motiv za sve uključene.
        <br><br>
        Od 2019. godine, vaspitno-obrazovni rad u ustanovi se sprovodi po „Novim osnovama programa predškolskog vaspitanja i obrazovanja“. Ova inovacija podrazumeva da je dete u središtu vaspitno-obrazovnog procesa, uz aktivno učešće, istraživački pristup i timski rad. Vaspitači postaju fasilitatori razvoja, stvaraju podsticajnu sredinu, koriste tematsko planiranje i projektno učenje prilagođeno interesovanjima dece. Program podstiče razvoj kritičkog razmišljanja, samopouzdanja i socijalnih kompetencija, kao i ravnotežu između slobode i međusobnog poštovanja.
        <br><br>
        Iako je „Pčelica“ prepoznatljiv simbol kvaliteta, brige i zajedništva, njen rad se stalno produbljuje. Svaka godina donosi nove izazove, ideje i korake ka boljoj budućnosti. Planovi za proširenje kapaciteta, unapređenje prostora, digitalizaciju i jačanje stručnog kadra već su u toku, uz poseban akcenat na ravnomernu dostupnost usluga – kako u centru grada, tako i u seoskim sredinama. Sa idejom da svako dete zaslužuje jednake šanse za razvoj, učenje i srećno detinjstvo, „Pčelica“ nastavlja da gradi svoju budućnost sa ljubavlju, znanjem i posvećenošću, jer svaki korak napred znači korak bliže svetu u kojem je briga o deci najvažniji zadatak svih nas.   
      </h2>
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
