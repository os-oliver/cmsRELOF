<?php

namespace App\Admin\PageBuilders;

class UvodPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen pt-10">

  <section class="py-20 bg-background">
  <div class="container mx-auto px-6 max-w-4xl">
    
    <!-- Naslov -->
    <h2 class="text-5xl font-heading font-bold text-primary text-center mb-6 relative inline-block">
      O biblioteci
    </h2>

    <!-- Tekst -->
    <p class="text-lg md:text-xl text-text_secondary font-body">
      Narodna biblioteka Pirot smeštena je na dve lokacije u samom centru grada. Većina službi i pozajmno odeljenje za decu preseljeni su početkom 2006. godine u zgradu Doma vojske, dok je pozajmno odeljenje za odrasle korisnike sa čitaonicom ostalo na staroj adresi, u ulici Branka Radičevića. Prostor u kojem se nalazi Biblioteka (820 m²) je nenamenski i nedovoljan za jednu ovakvu ustanovu. Biblioteka raspolaže sa preko 60.000 knjiga, sa fondom periodike od blizu 200 naslova, raznovrsnom neknjižnom građom. Pristup knjigama na pozajmnim odeljenjima je slobodan. Od informacionih instrumenata Biblioteka poseduje autorski, naslovni, stručni, predmetni i elektronski katalog. Stručna obrada knjižne građe je automatizovana, najpre po programskom paketu BIBLIO u periodu od 2000. do 2006. godine, da bi od februara 2007. godine Biblioteka započela automatizaciju na&nbsp;<a data-translate="off" class="underline text-blue-600" href="https://plus.cobiss.net/cobiss/sr/sr?lib=nbpi">COBISS</a>&nbsp;platformi.<br><br>

Narodna biblioteka Pirot je od 1994. godine matična za područje Pirotskog okruga. Svoje matične funkcije ostvaruje u opštinama Pirot, Babušnica, Bela Palanka i Dimitrovgrad.<br><br>

Pored obavljanja osnovne bibliotečko-informacione delatnosti, Biblioteka je organizator mnogih književnih susreta, promocija, izložbi, tribina, okruglih stolova, seminara posvećenih temama vezanim za bibliotekarstvo i kulturni identitet. Gosti pirotske Biblioteke bila su najznačajnija imena srpske književnosti: Borislav Pekić, Dobrica Ćosić, Svetlana Velmar-Janković, Goran Petrović, Dragan Velikić, Zoran Ćirić, Radoslav Petković i mnogi drugi. Biblioteka tradicionalno organizuje propratne programe Salona knjige i grafike i Pirotskog kulturnog leta, kao i Smotru recitatora, izdavač je i promoter mnogih zavičajnih publikacija među kojima je svakako najznačajniji Pirotski zbornik, godišnjak radova o Pirotu i Piroćancima. Dečje odeljenje je 2006. godine oformilo Radionicu koja okuplja talentovane đake pirotskih osnovnih škola.<br><br>

Za svoje zasluge u afirmaciji i razvijanju bibliotečke delatnosti Narodna biblioteka Pirot je dobila Sedmojulsku povelju 1963. godine i nagradu „Milorad Panić Surep“ 1971. godine.<br><br>

Danas Narodna biblioteka Pirot nastoji da tradiciju poveže sa zahtevima savremenog informatičkog društva. Ključni korak učinjen je decembra 2006. godine kada se Biblioteka uključila u jedinstveni sistem <span data-translate="off">&nbsp;COBISS.SR&nbsp;</span>, koji omogućava centralizovanu obradu bibliotečke građe, kao i pristup bibliografskim zapisima o građi svih biblioteka učesnica u sistemu.<br><br>

Narodna biblioteka Pirot je 2009. godine obeležila značajan jubilej – 130 godina od osnivanja Čitaonice u Pirotu. Optimisti smo da ćemo uz podršku osnivača – Skupštine opštine Pirot u nastupajućem periodu trajno rešiti prostorni problem Biblioteke, definitivnim opredeljenjem prostora na spratu Doma Vojske za potrebe Narodne biblioteke.<br><br>
    </p>

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
