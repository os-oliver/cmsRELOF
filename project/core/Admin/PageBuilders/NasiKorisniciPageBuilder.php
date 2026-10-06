<?php

namespace App\Admin\PageBuilders;

class NasiKorisniciPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-24 flex-grow bg-background">
    <div class="max-w-6xl mx-auto py-12 px-6">
        <div class="bg-primary/70 text-white py-16 px-8 text-center rounded-2xl mb-12 shadow-lg">
            <h1 class="text-4xl font-bold font-heading mb-4">Naši korisnici</h1>
            <p class="text-xl opacity-90 font-body">Podrška i briga za našu zajednicu</p>
        </div>

        <div class="bg-primary/10 p-8 rounded-2xl shadow-md mb-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 font-heading2">Ko su naši korisnici?</h2>
            <div class="leading-relaxed text-lg text-gray-700 font-body">
                <p class="mb-4">
                    Centar za socijalni rad pruža podršku širokom spektru korisnika iz naše zajednice.
                    Naši korisnici su pojedinci, porodice i grupe koje se suočavaju sa različitim životnim
                    izazovima i potrebama za socijalnom podrškom.
                </p>
                <p class="mb-4">
                    Radimo sa decom, mladima, odraslima i starijim osobama, pružajući im stručnu pomoć
                    i podršku prilagođenu njihovim specifičnim potrebama.
                </p>
            </div>
        </div>

        <div class="content-card">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 font-heading2">Kategorije korisnika</h2>
            <div class="editable-content">
                <ul class="list-disc list-inside space-y-2 ml-4 font-body">
                    <li>Deca i mladi bez adekvatne roditeljske brige</li>
                    <li>Osobe sa invaliditetom</li>
                    <li>Starija lica koja zahtevaju pomoć i negu</li>
                    <li>Žrtve porodičnog nasilja</li>
                    <li>Socijalno ugrožene porodice</li>
                    <li>Osobe sa mentalnim teškoćama</li>
                </ul>
            </div>
        </div>

        <div class="content-card">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 font-heading2">Kako možete postati korisnik?</h2>
            <div class="editable-content font-body">
                <p class="mb-4">
                    Ukoliko vam je potrebna pomoć ili podrška, možete se obratiti našem centru:
                </p>
                <ul class="list-disc list-inside space-y-2 ml-4">
                    <li>Lično u našoj kancelariji tokom radnog vremena</li>
                    <li>Telefonskim putem na broj: +381 XX XXX XXXX</li>
                    <li>Putem email-a: info@centar.rs</li>
                    <li>Kroz našu online prijavu</li>
                </ul>
                <p class="mt-4">
                    Svi podaci korisnika tretiraju se poverljivo u skladu sa zakonskim propisima.
                </p>
            </div>
        </div>
    </div>
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
