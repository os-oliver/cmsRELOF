<?php

namespace App\Admin\PageBuilders;

class NasiKorisniciPageBuilder extends BasePageBuilder
{
    protected string $css = <<<CSS
    main {
        padding-top: 50px;
    }

    .content-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
        border-radius: 1rem;
        margin-bottom: 3rem;
    }

    .content-card {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .editable-content {
        line-height: 1.8;
        font-size: 1.1rem;
        color: #374151;
    }
CSS;

    protected string $html = <<<'HTML'
<main class="min-h-screen pt-24 flex-grow bg-gradient-to-br from-purple-50 to-blue-50">
    <div class="content-section">
        <div class="hero-section">
            <h1 class="text-4xl font-bold mb-4">Naši korisnici</h1>
            <p class="text-xl opacity-90">Podrška i briga za našu zajednicu</p>
        </div>

        <div class="content-card">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ko su naši korisnici?</h2>
            <div class="editable-content">
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
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kategorije korisnika</h2>
            <div class="editable-content">
                <ul class="list-disc list-inside space-y-2 ml-4">
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
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kako možete postati korisnik?</h2>
            <div class="editable-content">
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
        $content = $this->getHeader($this->css);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }
}
