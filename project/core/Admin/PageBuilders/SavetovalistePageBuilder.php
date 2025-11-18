<?php

namespace App\Admin\PageBuilders;

class SavetovalistePageBuilder extends BasePageBuilder
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
        Vodič kroz adaptaciju (privikavanje) deteta na boravak u vrtiću
      </h1>

      <!-- SCROLLABLE CONTENT WRAPPER -->
      <div class="text-lg leading-relaxed text-justify space-y-6 max-h-[75vh] overflow-y-auto pr-3">

        <p>
          Polazak u vrtić je veoma značajan događaj u životu deteta, jer on predstavlja prvu pravu obavezu za dete, sličnu obavezi koju imaju mama i tata da svakog dana odlaze na posao. Iako je ovo događaj sastavni deo života skoro svakog mališana, on često može biti stresan, jer podrazumeva prilagođavanje na nove okolnosti – kako deteta, tako i roditelja. Adaptacija je period tokom kog se dete privikava na novu sredinu, drugare, osoblje i uslove života u vrtiću.
        </p>

        <p>
          Do polaska u vrtić i susreta sa kolektivom dete je najčešće boravilo u bezbednoj i sigurnoj sredini čije su uslove roditelji mogli da kontrolišu. Boravak u vrtiću podrazumeva nova pravila, nove rasporede aktivnosti i učenje novih načina rešavanja svakodnevnih situacija. Istraživanja pokazuju da je proces adaptacije ponekad stresniji za roditelje (pogotovo mame) nego za samo dete.
        </p>

        <p>
          Pravilno prilagođavanje deteta na boravak u vrtić izuzetno je važno za njegov dalji psihički razvoj i razvoj ličnosti, a ujedno predstavlja prvi korak ka uspešnom realizovanju svih aktivnosti koje vrtić nudi.
        </p>

        <h2 class="font-heading text-xl font-bold text-primary_text">Trajanje i način adaptacije zavisi od sledećih faktora:</h2>

        <ul class="list-disc list-inside space-y-2">
          <li>prethodnog iskustva odvajanja</li>
          <li>pripremljenosti deteta za polazak u vrtić</li>
          <li>uzrasta</li>
          <li>stavova roditelja prema vrtiću</li>
          <li>redovnosti dolaženja</li>
          <li>načina funkcionisanja deteta unutar porodice</li>
        </ul>

        <h2 class="font-heading text-xl font-bold text-primary_text">Šta možemo da očekujemo od adaptacije?</h2>

        <p>
          Ne razvijaju se sva deca jednako niti reaguju na promene na isti način, pa je teško unapred predvideti kako će se odvijati prilagođavanje konkretnog deteta. Postoje, međutim, reakcije koje se često javljaju:
        </p>

        <ul class="list-disc list-inside space-y-2">
          <li>nesigurnost</li>
          <li>strah od odvajanja</li>
          <li>strah da roditelj neće doći</li>
          <li>strah od uklapanja u grupu i drugu decu</li>
        </ul>

        <p>Mogu se javiti:</p>

        <ul class="list-disc list-inside space-y-2">
          <li>plač</li>
          <li>povlačenje u sebe</li>
          <li>agresivnost</li>
          <li>otpor prema vrtiću</li>
          <li>poremećaj sna</li>
          <li>odbijanje hrane</li>
          <li>regresija (umokravanje, velika nužda u gaćice)</li>
        </ul>

        <p>
          Ove reakcije su privremene, normalne i povlače se kada dete savlada adaptaciju.
        </p>

        <h2 class="font-heading text-xl font-bold text-primary_text">Stručnjaci navode tri tipa adaptacije:</h2>

        <p><strong>1. Laka adaptacija</strong></p>
        <p>Traje oko dve nedelje. Dete prihvata ritam, prostor, osoblje i drugare bez većih poteškoća.</p>

        <p><strong>2. Srednje teška adaptacija</strong></p>
        <p>Traje duže — mesec dana ili više. Detetu treba više vremena da se opusti i prihvati promene.</p>

        <p><strong>3. Teška adaptacija</strong></p>
        <p>Najređa. Dete odbija boravak, teško prihvata pravila i ritam. Najčešće je posledica drugih životnih stresora (razvod, rođenje brata/sestre, selidba…).</p>

        <h2 class="font-heading text-xl font-bold text-primary_text">Saveti za roditelje koji žele da pripreme svoje dete i sebe za vrtić</h2>

        <p>Najvažnije preporuke:</p>

        <ul class="list-disc list-inside space-y-2">
          <li>upoznajte vaspitače i prostor vrtića</li>
          <li>razgovarajte o vrtiću pozitivno</li>
          <li>dozvolite detetu da ponese omiljenu igračku</li>
          <li>uskladite dnevni ritam kod kuće sa ritmom vrtića</li>
          <li>odvojite vreme za prve nedelje adaptacije</li>
          <li>budite tačni kada dolazite po dete</li>
          <li>budite redovni u dolascima</li>
          <li>pokažite detetu razumevanje i podršku</li>
          <li>i roditelji su takođe na adaptaciji — njihov stav utiče na dete</li>
        </ul>

        <h2 class="font-heading text-xl font-bold text-primary_text">Zato još jednom podsećamo — obratite pažnju na sledeće:</h2>

        <ul class="list-disc list-inside space-y-2">
          <li>pokažite ljubav svom detetu</li>
          <li>prihvatajte dete bezuslovno</li>
          <li>budite dosledni, ali ne kruti</li>
          <li>poštujte osećanja deteta</li>
          <li>imajte razumevanja za greške</li>
          <li>budite dobar primer detetu</li>
        </ul>

        <p>
          Svi ovi postupci utiču na samopoštovanje deteta i na to kako će prihvatiti vrtić.
        </p>

        <h2 class="font-heading text-xl font-bold text-primary_text">Pre polaska u jaslice:</h2>

        <ul class="list-disc list-inside space-y-2">
          <li>uskladite porodični ritam sa ritmom jaslica</li>
          <li>izbegnite druge velike promene u tom periodu</li>
          <li>upoznajte dete sa prostorom i osobljem</li>
          <li>ne zastrašujte dete vrtićem</li>
          <li>vežbajte kratka odvajanja</li>
          <li>negujte kontakte sa drugom decom</li>
        </ul>

        <h2 class="font-heading text-xl font-bold text-primary_text">Prvi dani u jaslicama</h2>

        <ul class="list-disc list-inside space-y-2">
          <li>budite „most“ između deteta i nove sredine</li>
          <li>dozvolite detetu da izrazi osećanja</li>
          <li>posvetite mu kvalitetno vreme nakon vrtića</li>
        </ul>

        <p>
          Ako adaptacija traje duže od mesec dana uz snažne reakcije — potražite savet stručnjaka.
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
$description = "Savetovalište za roditelje, staratelje i zaposlene radi kao timsko savetovanje uz učešće psihologa, pedagoga i socijalnog radnika.";
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
