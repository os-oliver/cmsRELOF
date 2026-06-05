<?php

namespace App\Admin\PageBuilders;

class ResursiPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-background">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-5xl mx-auto text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-14 mb-4">Resurs centar</h1>
      <p class="text-left">
        Regionalni centar Niš Vam kroz Resurs centar nudi dodatne usluge za podizanje kvaliteta organizovanja i realizacije nastavnog procesa, kao i ličnog napredovanja i usavršavanja.

        Resurs centar raspolaže sa preko 1.500 naslova savremene stručne literature i didaktičkim sredstvima koja su izabrana u skladu sa potrebama i željama ciljnih grupa u obrazovanju.

        Sva sredstva možete iznajmiti uz lična dokumenta na period od 15 dana.
      </p>
      <a href="/uploads/documents/knjige_po_oblastima.pdf" target="_blank" class="my-4 inline-block bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition">
        Spisak knjiga - preuzmite
      </a>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <img src="/uploads/8fe3141b-cb2f-4a6b-f456-773f788e9e00.jpg" alt="Resurs centar - glavna slika" class="rounded-2xl shadow-lg w-full h-full object-cover md:row-span-2 min-h-[320px]">
        <img src="/uploads/7bad434b-a44f-40c9-d37e-255108a29964.jpg" alt="Resurs centar - druga slika" class="rounded-2xl shadow-lg w-full h-full object-fit min-h-[150px]">
        <img src="/uploads/8fad9d77-b4b4-4a52-80e0-1f785383ee86.jpg" alt="Resurs centar - treća slika" class="rounded-2xl shadow-lg w-full h-full object-fit min-h-[150px]">
        </div>
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
