<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class RasporedAktivnostiPageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading mb-6">Raspored aktivnosti u vrtiću</h1>

      <p class="leading-relaxed mb-4 text-justify">
        Naš dnevni raspored osmišljen je tako da deci pruži balans između igre, učenja, odmora i kreativnog izražavanja. 
        Svaki dan u našem vrtiću donosi nove mogućnosti za istraživanje i druženje u bezbednom i podsticajnom okruženju.
      </p>

      <ul class="text-left list-disc list-inside max-w-3xl mx-auto mb-6">
        <li class="mb-2"><strong>07:00 – 08:30: </strong> Dolazak dece i slobodne aktivnosti.</li>
        <li class="mb-2"><strong>08:30 – 09:00: </strong> Doručak.</li>
        <li class="mb-2"><strong>09:00 – 11:00: </strong> Organizovane edukativne i kreativne radionice.</li>
        <li class="mb-2"><strong>11:00 – 12:00: </strong> Boravak na otvorenom / sportske aktivnosti.</li>
        <li class="mb-2"><strong>12:00 – 12:30: </strong> Ručak.</li>
        <li class="mb-2"><strong>12:30 – 14:30: </strong> Odmor i mirne igre.</li>
        <li class="mb-2"><strong>14:30 – 17:00: </strong> Popodnevne radionice i slobodne aktivnosti.</li>
      </ul>

      <p class="text-xs mt-4 text-gray-600">
        Napomena: Raspored aktivnosti može varirati u zavisnosti od vremenskih uslova i posebnih događaja u vrtiću.
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
$downloadUrl = '/files/raspored.pdf';
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
