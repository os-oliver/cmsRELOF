<?php

namespace App\Admin\PageBuilders;

class UvodPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-body">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-primary to-accent text-surface py-32">
        <div class="container mx-auto text-center px-6">
            <h1 class="text-6xl font-display font-bold mb-6 drop-shadow-lg text-primary_text">
                Dobrodošli u naš svet
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto leading-relaxed drop-shadow text-secondary_text">
                Otkrivamo znanje, kulturu i inovacije. Pridružite nam se na ovom putovanju.
            </p>
            <a href="/projekti" class="mt-10 inline-block bg-accent hover:bg-accent_hover text-surface font-bold py-4 px-10 rounded-full shadow-xl transition transform hover:scale-105">
                Pogledajte projekte
            </a>
        </div>
    </section>

    <!-- O nama Section -->
    <section class="py-24 bg-background">
        <div class="container mx-auto px-6 max-w-5xl grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1">
                <h2 class="text-4xl font-crimson font-bold mb-6 text-primary_text">
                    O nama
                </h2>
                <p class="text-secondary_text leading-relaxed text-lg mb-4">
                    Naša institucija neguje obrazovanje, kulturu i inovativne projekte.
                    Kroz razne inicijative doprinosimo zajednici i inspirišemo kreativnost.
                </p>
                <p class="text-secondary_text leading-relaxed text-lg">
                    Fokusirani smo na održivi razvoj i stvaranje vrednosti za sve generacije.
                </p>
            </div>
            <div class="order-1 md:order-2">
                <div class="bg-surface rounded-xl shadow-lg overflow-hidden">
                    <img src="" alt="O nama" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Naše vrednosti -->
    <section class="py-24 bg-secondary_background">
        <div class="container mx-auto px-6 max-w-5xl text-center">
            <h2 class="text-4xl font-display font-bold mb-12 text-primary_text">
                Naše vrednosti
            </h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-surface p-8 rounded-xl shadow hover:shadow-2xl transition">
                    <h3 class="text-2xl font-crimson font-bold mb-4 text-accent">Inovacija</h3>
                    <p class="text-secondary_text">Stalno unapređujemo procese i podstičemo kreativna rešenja.</p>
                </div>
                <div class="bg-surface p-8 rounded-xl shadow hover:shadow-2xl transition">
                    <h3 class="text-2xl font-crimson font-bold mb-4 text-accent">Zajednica</h3>
                    <p class="text-secondary_text">Podržavamo projekte koji jačaju društvenu povezanost.</p>
                </div>
                <div class="bg-surface p-8 rounded-xl shadow hover:shadow-2xl transition">
                    <h3 class="text-2xl font-crimson font-bold mb-4 text-accent">Održivost</h3>
                    <p class="text-secondary_text">Brinemo o prirodi i budućim generacijama kroz svaku inicijativu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action -->
    <section class="py-20 bg-primary text-surface text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6">Spremni za saradnju?</h2>
            <a href="/kontakt" class="inline-block bg-accent hover:bg-accent_hover text-surface font-bold py-4 px-10 rounded-full shadow-lg transition transform hover:scale-105">
                Kontaktirajte nas
            </a>
        </div>
    </section>

</main>
HTML;

    public function buildPage(): string
    {
        $content = $this->getHeader();
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
