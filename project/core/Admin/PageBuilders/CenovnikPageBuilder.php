<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class CenovnikPageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-bold font-heading mb-4 text-primary_text">Cenovnik predškolske ustanove</h1>

      <p class="leading-relaxed mb-4 text-justify">
        Naša predškolska ustanova teži da pruži najviši kvalitet vaspitno–obrazovnog rada, uz transparentne i pristupačne cene. 
        Svi programi su prilagođeni uzrastu dece i uključuju stručno vođenje, kvalitetne obroke, kao i svakodnevne kreativne i edukativne aktivnosti.
      </p>

      <p class="leading-relaxed mb-4 text-justify">
        Cena boravka obuhvata sve osnovne aktivnosti i materijal za rad, dok se dodatni programi (poput jezika, sportskih sekcija i muzičkih radionica) 
        naplaćuju po simboličnim iznosima. Naš cilj je da svako dete ima mogućnost da uči i raste u podsticajnom i bezbednom okruženju.
      </p>

      <ul class="text-left list-disc list-inside max-w-3xl mx-auto mb-6">
        <li class="mb-2"><strong>Celodnevni program:</strong> od 7:00 do 17:00 – uključuje tri obroka i sve aktivnosti u toku dana.</li>
        <li class="mb-2"><strong>Poludnevni program:</strong> od 7:00 do 12:00 – uključuje doručak i užinu, uz osnovni vaspitno–obrazovni rad.</li>
        <li class="mb-2"><strong>Jaslice:</strong> poseban program prilagođen deci od 1 do 3 godine, sa individualnim pristupom i stručnim osobljem.</li>
        <li class="mb-2"><strong>Dodatne aktivnosti:</strong> engleski jezik, ritmika, kreativne radionice, sportske sekcije i logoped.</li>
      </ul>

      <div class="flex items-center justify-center gap-4">
        <a href="/dokumenti?search=&sort=date_desc&categories%5B%5D=8"
           class="inline-flex items-center gap-2 bm-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-5 rounded-lg shadow-md focus:outline-none focus:ring-4 focus:ring-green-300">
          Pogledaj cenovnik
        </a>

        <a href="/kontakt" class="inline-block underline">Kontaktirajte nas za više informacija</a>
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
$menuDescription = "Naša predškolska ustanova teži da pruži najviši kvalitet vaspitno–obrazovnog rada, uz transparentne i pristupačne cene.";
PHP;

    $content = $this->getHeader(additionalPhp: $additionalPHP);
    $content .= $this->getCommonIncludes();
    $content .= $this->html;
    $content .= $this->getFooter();
    return $content;
  }
}
