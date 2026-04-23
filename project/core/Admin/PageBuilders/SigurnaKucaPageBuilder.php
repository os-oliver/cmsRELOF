<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class SigurnaKucaPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex overflow-hidden pt-16 bg-gradient-to-br from-green-50 to-teal-50 text-center">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-7xl mx-auto font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-16 mb-4 text-center">Sigurna kuća</h1>
      <section class="mx-5 space-y-6 text-gray-700 leading-relaxed text-xl">

        <p class="text-2xl font-bold">
            064 64 88 104
        </p>

        <p>
            Kontaktirajte nas putem mejl forme na 
        </p>

        <p data-translate="off" class="font-semibold text-gray-900">
            sigurna.kuca@centarmostzr.com
        </p>

        <a href="mailto:sigurna.kuca@centarmostzr.com?subject=Prijava"
        class="inline-block mt-4 bg-primary hover:bg-primary_hover text-white font-semibold py-3 px-6 rounded-lg shadow-md transition">
            Prijavi
        </a>
    </section>
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
