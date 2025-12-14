<?php

namespace App\Admin\PageBuilders;

class CasopisPageBuilder extends BasePageBuilder
{
  protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-background">
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-5xl font-heading mb-4 text-primary_text">Časopis „Savetovalište”</h1>

      <p class="leading-relaxed mb-4 text-justify">
        Preuzmite naše časopise ili ih čitajte direktno sa stranice.
      </p>

      <ul class="text-left list-disc list-inside max-w-3xl mx-auto mb-6">
        <li class="mb-2"><a href="#" target="_blank"><strong>„Savetovalište”</strong>&nbsp;- časopis broj &nbsp;<strong>10</strong>.</a></li>
        <li class="mb-2"><a href="#" target="_blank"><strong>„Savetovalište”</strong>&nbsp;- časopis broj &nbsp;<strong>11</strong>.</a></li>
        <li class="mb-2"><a href="#" target="_blank"><strong>„Savetovalište”</strong>&nbsp;- časopis broj &nbsp;<strong>12</strong>.</a></li>
        <li class="mb-2"><a href="#" target="_blank"><strong>„Savetovalište”</strong>&nbsp;- časopis broj &nbsp;<strong>22</strong>.</a></li>
        <li class="mb-2"><a href="#" target="_blank"><strong>„Savetovalište”</strong>&nbsp;- časopis broj &nbsp;<strong>23</strong>.</a></li>
      </ul>
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

      const dl = document.getElementById('downloadMenuBtn');
      dl?.addEventListener('click', (e) => {
        const href = dl.getAttribute('href');
        if (!href) return;
      });
    })();
  </script>
</main>
HTML;

  public function buildPage(): string
  {
    $additionalPHP = <<<'PHP'
PHP;

    $content = $this->getHeader(additionalPhp: $additionalPHP);
    $content .= $this->getCommonIncludes();
    $content .= $this->html;
    $content .= $this->getFooter();
    return $content;
  }
}
