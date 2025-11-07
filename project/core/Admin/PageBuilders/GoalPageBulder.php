<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class GoalPageBulder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main >
<div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">

    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-3xl mx-auto text-center text-secondary_text font-body">
        <h1 class="text-5xl mb-4 text-primary_text font-heading">Misija naše institucije</h1>
        <h2 class="text-3xl mx-5 italic mb-4 text-justify"><?= $aboutUsData ?></h1>
    </div>
  </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'

    $dataAboutUS = new AboutUs();
    $aboutUsData = $dataAboutUS->list(lang:$locale)['goal'];

PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}