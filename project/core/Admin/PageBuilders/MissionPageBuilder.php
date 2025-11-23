<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class MissionPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-body text-secondary_text">

    <!-- Dugme za povećanje fonta -->
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-semibold py-2.5 px-4 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-accent transition"
            aria-label="Povećaj font">
            A+
        </button>
    </div>

    <!-- Naslovna sekcija -->
    <section
        class="relative border-b border-secondary/30 text-center bg-cover bg-center bg-no-repeat min-h-[560px] flex items-center"
        style="background-image: url('/assets/img/header.jpg');"
    >
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-primary_text mb-3 tracking-tight">
                Misija i Vizija
            </h1>
            <p class="text-lg md:text-xl text-primary_text/80 max-w-2xl mx-auto">
                Načela koja nas vode i ciljevi kojima težimo.
            </p>
        </div>
    </section>



    <!-- Glavni sadržaj -->
    <section class="py-20 lg:py-28 container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 lg:gap-16">

            <!-- Misija -->
            <div class="bg-surface border border-secondary/20 rounded-2xl p-10 transition">
                <header class="border-b border-secondary/30 pb-4 mb-6">
                    <h2 class="text-3xl font-heading font-semibold text-primary mb-2">Naša Misija</h2>
                    <p class="text-secondary_text/70 text-sm uppercase tracking-widest font-medium">
                        Svrha i posvećenost
                    </p>
                </header>
                <div class="text-secondary_text leading-relaxed prose prose-neutral max-w-none text-justify text-[1.05rem]">
                    <?= $mission ?>
                </div>
            </div>

            <!-- Vizija -->
            <div class="bg-surface border border-secondary/20 rounded-2xl p-10 transition">
                <header class="border-b border-secondary/30 pb-4 mb-6">
                    <h2 class="text-3xl font-heading font-semibold text-accent mb-2">Naša Vizija</h2>
                    <p class="text-secondary_text/70 text-sm uppercase tracking-widest font-medium">
                        Pogled ka budućnosti
                    </p>
                </header>
                <div class="text-secondary_text leading-relaxed prose prose-neutral max-w-none text-justify text-[1.05rem]">
                    <?= $vision ?>
                </div>
            </div>

        </div>
    </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'

        $dataAboutUS = new AboutUs();
        $mission = $dataAboutUS->list($locale)['mission'];
        $vision = $dataAboutUS->list($locale)['goal'];
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
