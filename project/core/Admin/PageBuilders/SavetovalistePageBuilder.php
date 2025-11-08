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

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading mb-4">Savetovalište za roditelje</h1>

      <p class="text-lg leading-relaxed mb-6 text-justify">
        Savetovalište za roditelje, staratelje i zaposlene radi kao timsko savetovanje uz učešće psihologa, pedagoga i socijalnog radnika. 
        Sastanci se održavaju jednom mesečno na dve lokacije, kako bi svima bili dostupni.
      </p>

      <ul class="text-left list-disc list-inside max-w-3xl mx-auto mb-6">
        <li class="mb-2"><strong>Vrtić „Šećerko“: </strong> ulica Vladimira Tomanovića 25, od 8:00 do 14:00 časova.</li>
        <li class="mb-2"><strong>Vrtić „Čika Jova Zmaj 1“ (zgrada uprave): </strong> ulica Save Šumanovića 1, od 12:00 do 18:00 časova.</li>
      </ul>

      <p class="text-sm mt-4 text-gray-600">
        Za dodatne informacije ili zakazivanje konsultacije, molimo kontaktirajte našu upravu.
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
$description = "Savetovalište za roditelje, staratelje i zaposlene radi kao timsko savetovanje uz učešće psihologa, pedagoga i socijalnog radnika.";
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
