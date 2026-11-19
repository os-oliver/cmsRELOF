<?php

namespace App\Admin\PageBuilders;

class InformatorORaduPageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-5xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading text-primary_text mb-4 mt-5">Informator o radu</h1>

      <div class="text-center text-lg md:text-2xl leading-relaxed space-y-4">
        <p>
          Informator o radu Predškolske ustanove „Pčelica“ Sremska Mitrovica izrađuje se i ažurira u Jedinstvenom informacionom sistemu informatora o radu, koji vodi Poverenik za informacije od javnog značaja i zaštitu podataka o ličnosti.
        </p>

        <p>
          Informator o radu ustanove dostupan je putem sledećeg linka:
        </p>
      </div>

      <a href="https://informator.poverenik.rs/informator?org=WCkzLKf578HLCbLCW"
         target="_blank"
         rel="noopener noreferrer"
         class="inline-block bg-primary hover:bg-primary_hover text-background py-3 px-6 rounded-lg shadow-md mb-4 mt-10 transition"
         aria-label="Директан линк ка Информатору о раду (отвара се у новом табу)">
        Direktan link ka informatoru
      </a>
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
