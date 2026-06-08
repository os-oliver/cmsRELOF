<?php

namespace App\Admin\PageBuilders;

class ObjekatPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
  <main class="bg-background min-h-screen font-sans antialiased pt-10">
    <h2 class="text-center py-20 text-4xl font-bold font-heading text-primary_text mb-2">Naš prostor</h2>
    <section class="py-18 bg-background max-w-[90%]">
        <div class="container mx-5 max-w-full">

            <div class="flex flex-col md:flex-row md:gap-16 mt-5 items-start justify-between">

                <div class="flex flex-col items-center md:items-start md:w-1/2 relative w-full">
                    <img src="/uploads/Klub.jpg" alt="Fotografija objekta" class="w-full h-auto rounded-lg shadow-md object-cover">

                    <div class="hidden md:block absolute top-0 -right-8 h-full w-1 bg-primary rounded-full"></div>
                </div>

                <div class="flex flex-col md:w-1/2 w-full min-w-0">
                    <h2 class="text-2xl font-bold text-primary_text mb-6">
                        GKC KLUB "ŠTAB"
                    </h2>
                    <div class="w-full flex flex-col justify-start break-words whitespace-normal">
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Multifunkcionalni prostor koji se nalazi u prizemlju Gradskog kulturnog centra, zauzima centralni deo zgrade i mesto je gde se održava najveći broj aktivnosti i koji okuplja najveći broj posetilaca i gostiju.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Osnovna delatnost kluba je ugostiteljstvo, pa gostima nudimo mogućnost osveženja nekim od mnogobrojnih napitaka iz naše karte pića. Ceo prostor kluba je pokriven besplatnim bežičnim internet signalom.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Kapacitet kluba je 120 sedećih mesta, međutim moguće je organizovati i događaje na kojima može da prisustvuje i do 250 ljudi. Klub poseduje dve bine kao i kompletnu produkcijsku opremu za tehničku pripremu i organizaciju događaja.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Zbog svog karaktera, klub nudi mogućnosti organizovanja različitih vrsta događaja, tako da je moguće organizovati koncerte, predstave manjeg obima, projekcije filmova, tribine i predavanja, promocije knjiga, izložbe.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            U prethodnom periodu imali smo zadovoljstvo da ugostimo veliki broj imena, između ostalih gostovali su: S vremena na vreme, DJ Purgatorijum (Srđan Žika Todorović I Uroš Đurić), Gile & Medžik Buš, Frano Lasić, Kiki Lesendrić i Piloti, Regina, Vampiri, Elvis J.Kurtović, Nikola Pejaković Kolja, Ničim izazvan, Jarboli, Bluz mašina, Čovek bez sluha, Šinobusi, Artan Lili, Ateist Rep, Kanda Kodža I Nebojša, Sara Renar, Kralj Čačka, Garavi sokak,
                            <span data-translate="off" class="text-secondary_text text-base leading-relaxed">
                                „Norman Beaker Trio“, „Gwyn Ashton“, „Blues company“, Disciplina kičme
                            </span>
                            i mnogi drugi.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Takođe, saradnici smo u organizaciji i realizaciji mnogih festivala pa su tako kod nas u klubu svoje aktivnosti imali i: Međunarodni festival dečijeg folklora "Licidersko srce", Međunarodni studentski filmski kamp "Interakcija", Međunarodni bluz i rok festival <span data-translate="off" class="text-secondary_text text-base leading-relaxed"> "In Wires", </span> Književni festival "Na pola puta", Muzički festivali <span data-translate="off" class="text-secondary_text text-base leading-relaxed"> "Hills Up"</span>, "Park fest" i <span data-translate="off" class="text-secondary_text text-base leading-relaxed"> “Next”.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-18 mt-16 bg-background max-w-[90%]">
        <div class="container mx-5 max-w-full">

            <div class="flex flex-col md:flex-row md:gap-16 mt-5 items-start justify-between">

                <div class="flex flex-col items-center md:items-start md:w-1/2 relative w-full">
                    <img src="/uploads/velika_sala.jpg" alt="Fotografija objekta" class="w-full h-auto rounded-lg shadow-md object-cover">

                    <div class="hidden md:block absolute top-0 -right-8 h-full w-1 bg-primary rounded-full"></div>
                </div>

                <div class="flex flex-col md:w-1/2 w-full min-w-0">
                    <h2 class="text-2xl font-bold text-primary_text mb-6">
                        GKC VELIKA SALA
                    </h2>
                    <div class="w-full flex flex-col justify-start break-words whitespace-normal">
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Velika sala se nalazi na prvom spratu GKC-a, takođe multifunkcionalnog karaktera kao i klub, mada najveću upotrebu ima u organizaciji koncerata sa većim brojem posetilaca. Maksimalni kapacitet sale je 600 posetilaca.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Poseban značaj sale je što ima svoj istorijski karakter, pa su tako u njoj bili održavani mnogi veliki javni, naučni i politički skupovi dok je celokupan objekat funkcionisao kao Dom JNA. Ugostila je najznačajnija imena tadašnje države, pa su između ostalih posetili je i tadašnji predsednik SFRJ Josip Broz Tito sa saradnicima.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Danas, ovaj prostor ugošćava najveća imena muzičke scene zemlje i regiona, pa su tako gostovali: Darko Rundek, Massimo Savić, Dado Topić,<span data-translate="off" class="text-secondary_text text-base leading-relaxed"> „Orthodox Celts“, „The BestBeat (The Beatles tribute band)“</span>, Rambo Amadeus, Vasil Hadžimanov, Vlatko Stefanovski, Divanhana, Mostar Sevdah Reunion, Dejan Petrović i Big band, Tito i Tarantula,<span data-translate="off" class="text-secondary_text text-base leading-relaxed"> „Barcelona Gipsy Balkan Orchestra“</span> i drugi.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Svoje programe u prostoru Velike sale su organizovali muzički festival<span data-translate="off" class="text-secondary_text text-base leading-relaxed"> "NEXT"</span> kao i Međunarodni festival bluza i roka<span data-translate="off" class="text-secondary_text text-base leading-relaxed"> "In Wires".</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-18 mt-16 bg-background max-w-[90%]">
        <div class="container mx-5 max-w-full">

            <div class="flex flex-col md:flex-row md:gap-16 mt-5 items-start justify-between">

                <div class="flex flex-col items-center md:items-start md:w-1/2 relative w-full">
                    <img src="/uploads/basta.jpg" alt="Fotografija objekta" class="w-full h-auto rounded-lg shadow-md object-cover">

                    <div class="hidden md:block absolute top-0 -right-8 h-full w-1 bg-primary rounded-full"></div>
                </div>

                <div class="flex flex-col md:w-1/2 w-full min-w-0">
                    <h2 class="text-2xl font-bold text-primary_text mb-6">
                        GKC BAŠTA
                    </h2>
                    <div class="w-full flex flex-col justify-start break-words whitespace-normal">
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Bašta GKC-a je otvoreni prostor koji se nalazi na preko 1000 m2 u najlepšem delu grada, sakriven između zgrada GKC-a i Gradske galerije predstavlja savršeno mesto za odmor i uživanje u miru i tišini izdvojen od gradske gužve.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Među sugrađanima i danas živi sećanje na nekadašnju baštu Doma JNA koja je imala kultni status u gradu i predstavljala najlepše mesto sa najboljim igrankama i zabavama.
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Danas, vrednim radom, dobrom uslugom i kvalitetnim programima trudimo se da povratimo status koji nam zasluženo pripada i da bašta GKC-a opet postane kultno mesto u Užicu.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            U sklopu bašte se nalazi velika otvorena pozornica sa opremljenim<span data-translate="off" class="text-secondary_text text-base leading-relaxed"> „backstage-om“,</span> pa tako imamo mogućnost organizovanja zahtevnijih događaja sa najvećim brojem posetilaca, do njih 1000. Tako su naši gosti bili: Rade Šerbedžija i Miroslav Tadić, Masimo Savić, Neno Belan, Drugi način, Slobodan Trkulja, Disciplina kičhme, Divna Ljubojević, Sergej Trifunović i Užička republika, Đorđe Vasić, Etnotrip i mnogi drugi.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Poslednjih godina ambijent bašte je posebno popularan među užičkim srednjoškolcima koji svoje završne priredbe organizuju baš u ovom prostoru. Takođe, dodele Vukovih diploma najboljim đacima užičkih škola redovno se dešavaju kod nas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-18 mt-16 bg-background max-w-[90%]">
        <div class="container mx-5 max-w-full">

            <div class="flex flex-col md:flex-row md:gap-16 mt-5 items-start justify-between">

                <div class="flex flex-col items-center md:items-start md:w-1/2 relative w-full">
                    <img src="/uploads/hol.jpg" alt="Fotografija objekta" class="w-full h-auto rounded-lg shadow-md object-cover">

                    <div class="hidden md:block absolute top-0 -right-8 h-full w-1 bg-primary rounded-full"></div>
                </div>

                <div class="flex flex-col md:w-1/2 w-full min-w-0">
                    <h2 class="text-2xl font-bold text-primary_text mb-6">
                        GKC HOL
                    </h2>
                    <div class="w-full flex flex-col justify-start break-words whitespace-normal">
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Hol Gradskog kulturnog centra je mesto na kom posetioci imaju prvi kontakt sa našom ustanovom. Nalazi se u prizemlju objekta kao predprostor kluba i poslednjih godina koristi se za održavanje izložbi.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Do sada u ovom prostoru smo imali postavke Austrijskog kulturnog foruma iz Beograda, učenika Umetničke škole iz Užica, izložbu fotografija Valerija Bliznjuka, izložbu Radovana Marinkovića Šjora, izložbu u okviru Međunarodnog dečijeg festivala folklora ’’Licidersko srce’’, izložbu pop-arta Igora Jašića, izložbu fotografija posvećenu manastiru Hilandar i druge.
                        </p>
                        <p class="text-secondary_text text-base leading-relaxed mb-4">
                            Inače, poseban detalj u prostoru hola predstavlja originalna tabla koja se nalazila na ulazu u nekadašnji Dom JNA, ispisana na 4 jezika naroda i narodnosti SFRJ.
                        </p>
                    </div>
                </div>
            </div>
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
