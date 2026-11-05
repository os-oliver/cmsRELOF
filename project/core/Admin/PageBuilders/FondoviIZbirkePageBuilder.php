<?php

namespace App\Admin\PageBuilders;

class FondoviIZbirkePageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-12 bg-background flex-grow">
  <section class="relative mb-12 overflow-hidden bg-gradient-to-r from-primary via-secondary to-accent py-16 text-white md:py-20">
    <div class="mx-auto max-w-7xl px-6 text-center">
      <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-white/80">Istorijski arhiv Zrenjanin</p>
      <h1 class="mb-5 text-4xl font-bold md:text-5xl">Vodič kroz arhivske fondove</h1>
      <p class="mx-auto max-w-3xl text-lg leading-relaxed text-white/90 md:text-xl">
        Kompletan pregled arhivskih fondova Istorijskog arhiva Zrenjanin – od prvog izdanja 1979. do najnovijeg dopunjenog izdanja.
      </p>
    </div>
  </section>

  <section class="mx-auto mb-16 grid max-w-7xl gap-8 px-6 lg:grid-cols-3" aria-label="O vodiču kroz arhivske fondove">
    <article class="rounded-2xl bg-surface p-7 shadow-lg lg:col-span-2 md:p-9">
      <div class="mb-6 flex items-center gap-4">
        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-primary/10">
          <i class="fas fa-book-open text-2xl text-primary" aria-hidden="true"></i>
        </div>
        <div>
          <h2 class="text-2xl font-bold text-primary_text">O vodiču</h2>
          <p class="text-secondary_text">Naučno-informativno sredstvo</p>
        </div>
      </div>
      <p class="mb-5 leading-relaxed text-secondary_text">
        Prvo izdanje Vodiča kroz arhivske fondove objavljeno je &nbsp;<strong class="font-bold text-primary_text">1979. godine</strong>&nbsp;,
        obuhvatajući sve arhivske fondove koje je Arhiv tada imao – ukupno &nbsp;<strong class="font-bold text-primary_text">420 fondova</strong>&nbsp;.
      </p>
      <h3 class="mb-3 text-xl font-bold text-primary_text">Razvoj fondova</h3>
      <p class="mb-5 leading-relaxed text-secondary_text">
        U međuvremenu je došlo do značajnih promena u mnogim fondovima koje smo sređivali, a mnoge već sređene fondove
        dopunjavali smo naknadno pronađenom arhivskom građom. Novoprimljene arhivske fondove takođe je trebalo obuhvatiti
        kako bi i oni bili opisani. Zato se javila potreba za objavljivanjem novog Vodiča koji bi sadržao sve nastale promene.
      </p>
      <div class="rounded-xl border-l-4 border-accent bg-secondary_background p-5">
        <p class="font-semibold text-primary_text">Važno</p>
        <p class="mt-1 leading-relaxed text-secondary_text">
          Za značajnije fondove izrađena su naučno-informativna sredstva – analitički inventari, imenski i geografski registri.
        </p>
      </div>
    </article>

    <aside class="grid gap-5 sm:grid-cols-2 lg:grid-cols-1" aria-label="Podaci o vodiču">
      <article class="flex items-center gap-5 rounded-2xl bg-surface p-6 shadow-lg">
        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-primary/10">
          <i class="fas fa-calendar-alt text-2xl text-primary" aria-hidden="true"></i>
        </div>
        <div>
          <p class="text-3xl font-bold text-primary_text">1979.</p>
          <p class="text-secondary_text">Prvo izdanje Vodiča</p>
        </div>
      </article>
      <article class="flex items-center gap-5 rounded-2xl bg-surface p-6 shadow-lg">
        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-accent/10">
          <i class="fas fa-boxes-stacked text-2xl text-accent" aria-hidden="true"></i>
        </div>
        <div>
          <p class="text-3xl font-bold text-primary_text">420</p>
          <p class="text-secondary_text">Fondova u prvom izdanju</p>
        </div>
      </article>
      <article class="rounded-2xl bg-surface p-6 shadow-lg sm:col-span-2 lg:col-span-1">
        <div class="mb-3 flex items-center gap-3">
          <i class="fas fa-landmark text-2xl text-secondary" aria-hidden="true"></i>
          <h3 class="text-lg font-bold text-primary_text">Istorija</h3>
        </div>
        <p class="leading-relaxed text-secondary_text">Od XVIII veka do danas.</p>
      </article>
    </aside>
  </section>

  <section class="mx-auto mb-16 max-w-7xl px-6" aria-labelledby="guides-heading">
    <div class="mb-8 text-center">
      <h2 id="guides-heading" class="mb-2 text-3xl font-bold text-primary_text">Dostupni vodiči</h2>
      <p class="text-secondary_text">Preuzmite publikacije u PDF formatu</p>
    </div>
    <div class="grid gap-6 md:grid-cols-2">
      <a href="/uploads/documents/Vodic-kroz-arhivske-fondove-Zrenjanin_1.pdf" class="group rounded-2xl bg-surface p-7 shadow-lg transition-shadow hover:shadow-xl" target="_blank" rel="noopener noreferrer">
        <div class="mb-5 flex items-start justify-between gap-4">
          <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-primary/10">
            <i class="fas fa-file-pdf text-2xl text-primary" aria-hidden="true"></i>
          </div>
          <span class="rounded-full bg-secondary_background px-3 py-1 text-sm font-semibold text-primary_text">1979.</span>
        </div>
        <h3 class="mb-2 text-xl font-bold text-primary_text group-hover:text-primary">Vodič XIV/1</h3>
        <p class="mb-5 leading-relaxed text-secondary_text">Prvo izdanje – Arhivski fondovi 1765–1956</p>
        <span class="inline-flex items-center gap-2 font-semibold text-primary">
          <i class="fas fa-download" aria-hidden="true"></i> Preuzmi PDF
        </span>
      </a>
      <a href="/uploads/documents/VODIC-druga-sveska-B5-3_1.pdf" class="group rounded-2xl bg-surface p-7 shadow-lg transition-shadow hover:shadow-xl" target="_blank" rel="noopener noreferrer">
        <div class="mb-5 flex items-start justify-between gap-4">
          <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-accent/10">
            <i class="fas fa-file-pdf text-2xl text-accent" aria-hidden="true"></i>
          </div>
          <span class="rounded-full bg-secondary_background px-3 py-1 text-sm font-semibold text-primary_text">Dopunjeno izdanje</span>
        </div>
        <h3 class="mb-2 text-xl font-bold text-primary_text group-hover:text-primary">Vodič XIV/2</h3>
        <p class="mb-5 leading-relaxed text-secondary_text">Nove nabavke i izmene</p>
        <span class="inline-flex items-center gap-2 font-semibold text-primary">
          <i class="fas fa-download" aria-hidden="true"></i> Preuzmi PDF
        </span>
      </a>
    </div>
  </section>

  <section class="mx-auto max-w-7xl px-6 pb-16" aria-labelledby="how-to-use-heading">
    <div class="mb-8 text-center">
      <h2 id="how-to-use-heading" class="mb-2 text-3xl font-bold text-primary_text">Kako koristiti Vodič?</h2>
      <p class="text-secondary_text">Nekoliko koraka do potrebnih informacija</p>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
      <article class="rounded-2xl bg-surface p-6 text-center shadow-lg">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
          <i class="fas fa-download text-2xl text-primary" aria-hidden="true"></i>
        </div>
        <h3 class="mb-2 text-lg font-bold text-primary_text">Preuzmite vodič</h3>
        <p class="leading-relaxed text-secondary_text">Preuzmite PDF dokument sa jednog od linkova iznad.</p>
      </article>
      <article class="rounded-2xl bg-surface p-6 text-center shadow-lg">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-accent/10">
          <i class="fas fa-magnifying-glass text-2xl text-accent" aria-hidden="true"></i>
        </div>
        <h3 class="mb-2 text-lg font-bold text-primary_text">Pretražite fondove</h3>
        <p class="leading-relaxed text-secondary_text">Pronađite fondove prema vremenskom periodu ili nazivu.</p>
      </article>
      <article class="rounded-2xl bg-surface p-6 text-center shadow-lg">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-secondary/10">
          <i class="fas fa-building-columns text-2xl text-secondary" aria-hidden="true"></i>
        </div>
        <h3 class="mb-2 text-lg font-bold text-primary_text">Zakažite posetu</h3>
        <p class="leading-relaxed text-secondary_text">Zakažite posetu Arhivu radi uvida u arhivsku građu.</p>
      </article>
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
