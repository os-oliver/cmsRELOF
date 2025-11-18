<?php

namespace App\Admin\PageBuilders;

class KutakZaRoditelje extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 font-body text-secondary_text">

      <h1 class="text-primary_text text-4xl font-bold font-heading mb-6 text-center">
        Kutak za roditelje
      </h1>

      <!-- Scrollable Wrapper -->
      <div class="text-lg leading-relaxed text-justify space-y-6 max-h-[75vh] overflow-y-auto pr-3">

        <p><strong>Poštovani roditelji</strong></p>

        <p>
          Doneli ste odluku da vaše dete upišete u kolektiv – jasle. Sigurno vam nije lako. Sigurno ste se pitali:
          Ko će preuzeti odgovornost i na najbolji mogući način negovati, brinuti, vaspitavati i štititi dete u vašem odsustvu?
        </p>

        <p>
          Sebi i drugima postavili ste mnoga pitanja: „Šta mogu da očekujem; Mogu li da imam poverenje u osobe koje rade sa decom;
          Koji su mogući rizici boravka deteta jaslenog uzrasta u kolektivu…“
        </p>

        <h2 class="font-heading text-xl font-bold text-primary_text">Želimo da vas najkraće informišemo o životu i radu ustanove kojoj ste poverili svoje dete:</h2>

        <p>
          Vaše dete postaće deo života naše Predškolske ustanove – postaće naša deca!
          Predškolska ustanova „Užice“ ima dugogodišnje iskustvo, koje se neprestano razvija i unapređuje.
          Briga o deci i njihovom pravilnom rastu i razvoju zasniva se na kvalitetnom programu rada, iskustvu naših praktičara,
          teorijskom znanju iz oblasti pedagogije, dečje psihologije i preventivno-zdravstvene zaštite.
          Ustanovu čini 9 vrtića. Jasle okupljaju decu najmlađeg uzrasta. Deca od 12 meseci do treće godine borave u jaslama,
          a od treće godine do polaska u školu u vrtićnim grupama.
        </p>

        <h3 class="font-heading text-lg font-bold text-primary_text">Naše jasle nude:</h3>
        <ul class="list-disc list-inside space-y-2">
          <li>kontinuiranu i kvalitetnu negu</li>
          <li>pravilnu ishranu – prilagođenu uzrastu</li>
          <li>preventivno-zdravstvenu zaštitu</li>
          <li>vaspitno-obrazovni rad u osmišljenim i podsticajnim prostorijama</li>
        </ul>

        <h3 class="font-heading text-lg font-bold text-primary_text">Ko radi sa decom u jaslama?</h3>

        <p>
          Rade medicinske sestre koje su, kroz svoje obrazovanje, iskustvo i stručno usavršavanje, edukovane i kompetentne
          za rad sa decom jaslenog uzrasta. Zajedno sa stručnim timom ustanove planira se, realizuje i unapređuje rad sa decom.
        </p>

        <h3 class="font-heading text-lg font-bold text-primary_text">Šta vam savetujemo?</h3>

        <p>
          Jedan od roditelja bi trebalo da isplanira slobodno vreme u periodu početka boravka deteta u jaslama. Da bi dete prihvatilo
          novonastalu situaciju, potrebno mu je vreme.
        </p>

        <p>
          Vrlo je važno da dete koje je tek upisano dolazi redovno. Sve važne informacije o detetu, njegovom ponašanju,
          navikama i specifičnostima, medicinska sestra u grupi treba da zna (npr. ako je dete vrlo motorično, ne voli da se mazi,
          voli muziku, teško zaspi, koristi flašicu za uspavljivanje itd.).
        </p>

        <p>
          U slučaju da je dete imalo ili ima ozbiljniji zdravstveni problem, roditelj je obavezan da o tome obavesti medicinsku sestru.
          Ako dete uzima lekove ili je sklono alergijama, to takođe mora biti poznato osoblju.
        </p>

        <p>
          Svaki izostanak zbog bolesti roditelj pravda potvrdom pedijatra. Na osnovu potvrde koriguje se cena boravka na kraju meseca.
        </p>

        <h3 class="font-heading text-lg font-bold text-primary_text">Šta je potrebno za boravak deteta u grupi:</h3>

        <ul class="list-disc list-inside space-y-2">
          <li>obuća za sobu (patofne ili patike)</li>
          <li>minimum 2 pelene dnevno, ako dete koristi pelene</li>
          <li>flašica, omiljena igračka ili drugi „prelazni objekat“</li>
          <li>jedna kompletna presvlaka u obeleženoj kesi ili rancu sa imenom deteta</li>
        </ul>

        <h3 class="font-heading text-lg font-bold text-primary_text">Saradnja sa porodicom</h3>

        <p>Saradnja se odvija kroz:</p>

        <ul class="list-disc list-inside space-y-2">
          <li>dnevnu komunikaciju prilikom dolaska i odlaska deteta</li>
          <li>roditeljske sastanke</li>
          <li>informacije preko panoa</li>
          <li>zakazane sastanke u dogovoreno vreme</li>
          <li>uključivanje roditelja u život i rad vrtića</li>
        </ul>

        <h3 class="font-heading text-lg font-bold text-primary_text">Svojim programima vrtić nudi:</h3>

        <ul class="list-disc list-inside space-y-2">
          <li>razvijanje duha kolektiva i socijalizacije</li>
          <li>sticanje pojmova, saznanja i veština</li>
          <li>razvijanje interesovanja</li>
          <li>razvijanje svesti o sopstvenoj ličnosti</li>
          <li>usvajanje kulturnih sadržaja</li>
          <li>razvijanje govora</li>
          <li>razvijanje čula</li>
          <li>aktivnosti usmerene na igru i stvaralaštvo</li>
          <li>stvaranje higijenskih navika</li>
          <li>boravak u prirodi</li>
          <li>dobre odnose vrtića i porodice</li>
        </ul>

        <h3 class="font-heading text-lg font-bold text-primary_text">Dragi roditelji, u našem vrtiću važe sledeća pravila:</h3>

        <ul class="list-disc list-inside space-y-2">
          <li>poštujete Kućni red vrtića i Kodeks ponašanja</li>
          <li>primereno komunicirate sa osobljem</li>
          <li>štitite svoje dete i brinete o zdravlju druge dece</li>
          <li>informišete vaspitača o važnim promenama u porodici</li>
          <li>redovno dovodite dete u vrtić</li>
          <li>dolazite na roditeljske sastanke</li>
          <li>odazivate se pozivima vaspitača</li>
          <li>uvažavate ličnost deteta</li>
          <li>poštujete dogovoreno vreme dolaska i odlaska</li>
          <li>razgovarate sa detetom o vrtiću, igračkama i drugarima</li>
          <li>prihvatate dete takvo kakvo jeste</li>
        </ul>

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
$description = "Kutak za roditelje – informacije, saveti i podrška za uspešan početak boravka deteta u jaslama.";
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
