<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class ResursiPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-12 bg-background flex-grow">
  <div>
    <button id="increaseFontBtn"
        class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
        aria-label="Povećaj veličinu fonta">Uvećaj
    </button>
  </div>

    <section class="bg-background flex flex-col justify-center items-center py-20 text-center">
        <h1 class="text-5xl font-bold mb-6 font-heading">
            Resursi
        </h1>
        <p class="text-gray-700 text-xl max-w-2xl mb-8">
            Centar pruža optimalne uslove za obuku zaposlenih u obrazovanju. Raspolaže sa oko 170 kvadratnih metara korisnih prostora.
        </p>
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
