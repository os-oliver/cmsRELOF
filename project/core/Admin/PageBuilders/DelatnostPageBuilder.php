<?php

namespace App\Admin\PageBuilders;

class DelatnostPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-12 bg-background flex-grow">
  <div class="mx-auto mb-16 mt-10 max-w-7xl px-6 pt-8">
    <section class="mb-16" aria-label="Osnovni podaci o arhivu">
      <div class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6">
        <article class="rounded-xl bg-surface p-5 text-center shadow-lg transition-shadow hover:shadow-xl md:p-6">
          <i class="fas fa-folder-open mb-3 text-3xl text-primary md:text-4xl" aria-hidden="true"></i>
          <p class="text-3xl font-bold text-primary_text">2000+</p>
          <p class="text-sm text-secondary_text">Registratura</p>
        </article>
        <article class="rounded-xl bg-surface p-5 text-center shadow-lg transition-shadow hover:shadow-xl md:p-6">
          <i class="fas fa-award mb-3 text-3xl text-accent md:text-4xl" aria-hidden="true"></i>
          <p class="text-3xl font-bold text-primary_text">133</p>
          <p class="text-sm text-secondary_text">Kulturna dobra</p>
        </article>
        <article class="rounded-xl bg-surface p-5 text-center shadow-lg transition-shadow hover:shadow-xl md:p-6">
          <i class="fas fa-gem mb-3 text-3xl text-secondary md:text-4xl" aria-hidden="true"></i>
          <p class="text-3xl font-bold text-primary_text">116</p>
          <p class="text-sm text-secondary_text">Rariteta</p>
        </article>
        <article class="rounded-xl bg-surface p-5 text-center shadow-lg transition-shadow hover:shadow-xl md:p-6">
          <i class="fas fa-book mb-3 text-3xl text-info md:text-4xl" aria-hidden="true"></i>
          <p class="text-3xl font-bold text-primary_text">20.000</p>
          <p class="text-sm text-secondary_text">Knjiga u biblioteci</p>
        </article>
      </div>
    </section>

    <section class="mb-16 grid gap-8 md:grid-cols-3" aria-label="Delatnost arhiva">
      <div class="space-y-8 md:col-span-2">
        <article class="overflow-hidden rounded-2xl bg-surface shadow-lg transition-shadow hover:shadow-2xl">
          <div class="bg-gradient-to-r from-primary to-secondary p-7 text-white md:p-8">
            <i class="fas fa-landmark mb-4 text-5xl" aria-hidden="true"></i>
            <h1 class="mb-3 text-3xl font-bold">O Istorijskom arhivu</h1>
          </div>
          <div class="space-y-4 p-6 md:p-8">
            <p class="leading-relaxed text-secondary_text">
              Istorijski arhiv Zrenjanin je ustanova kulture od regionalnog značaja koja se bavi zaštitom,
              prikupljanjem, sređivanjem, obradom i čuvanjem arhivske građe. Za proteklih sedam decenija postojanja,
              Arhiv je postao jedan od stubova kulturnog života u ovom delu Srbije.
            </p>
            <p class="leading-relaxed text-secondary_text">
              U depoima se čuva svojevrsno kulturno nasleđe Zrenjanina (Petrovgrada, Velikog Bečkereka) i srednjeg
              Banata koje je nastajalo u vremenskom intervalu od sredine XVIII veka do današnjih dana.
            </p>
          </div>
        </article>

        <article class="rounded-2xl bg-surface p-6 shadow-lg md:p-8">
          <div class="mb-6 flex items-center">
            <div class="mr-4 flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-accent/10">
              <i class="fas fa-box-archive text-3xl text-accent" aria-hidden="true"></i>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-primary_text">Fondovi i zbirke</h2>
              <p class="text-secondary_text">Kulturna dobra od izuzetnog značaja</p>
            </div>
          </div>
          <p class="mb-6 leading-relaxed text-secondary_text">
            Na osnovu kategorizacije iz 1998. godine, 67 fondova (1765–1956) proglašeno je kulturnim dobrom od
            izuzetnog značaja, a 66 fondova (1769–1970) od velikog značaja. Izdvojeno je 116 rariteta koji se čuvaju
            u posebnim uslovima.
          </p>
          <div class="grid grid-cols-2 gap-4">
            <div class="rounded-lg bg-secondary_background p-4">
              <i class="fas fa-certificate mb-2 text-2xl text-primary" aria-hidden="true"></i>
              <p class="text-2xl font-bold text-primary_text">67</p>
              <p class="text-sm text-secondary_text">Izuzetnog značaja</p>
            </div>
            <div class="rounded-lg bg-secondary_background p-4">
              <i class="fas fa-star mb-2 text-2xl text-accent" aria-hidden="true"></i>
              <p class="text-2xl font-bold text-primary_text">66</p>
              <p class="text-sm text-secondary_text">Velikog značaja</p>
            </div>
          </div>
        </article>
      </div>

      <aside class="space-y-8" aria-label="Najkorišćenija arhivska građa i usluge">
        <section class="rounded-2xl bg-surface p-6 shadow-lg" aria-labelledby="popular-records-heading">
          <h2 id="popular-records-heading" class="mb-4 flex items-center text-xl font-bold text-primary_text">
            <i class="fas fa-scroll mr-3 text-primary" aria-hidden="true"></i>
            Najkorišćenija građa
          </h2>
          <ul class="space-y-3">
            <li class="cursor-pointer border-l-4 border-primary py-2 pl-4 transition-colors hover:bg-secondary_background">
              <p class="text-sm font-semibold text-primary_text">Magistrat grada Velikog Bečkereka</p>
              <p class="text-xs text-secondary_text">1769–1918 (mađarski)</p>
            </li>
            <li class="cursor-pointer border-l-4 border-accent py-2 pl-4 transition-colors hover:bg-secondary_background">
              <p class="text-sm font-semibold text-primary_text">Gradsko poglavarstvo Petrovgrad</p>
              <p class="text-xs text-secondary_text">1918–1941 (srpski)</p>
            </li>
            <li class="cursor-pointer border-l-4 border-secondary py-2 pl-4 transition-colors hover:bg-secondary_background">
              <p class="text-sm font-semibold text-primary_text">Crkvene matične knjige</p>
              <p class="text-xs text-secondary_text">1746–1895</p>
            </li>
            <li class="cursor-pointer border-l-4 border-primary py-2 pl-4 transition-colors hover:bg-secondary_background">
              <p class="text-sm font-semibold text-primary_text">Karte i planovi</p>
              <p class="text-xs text-secondary_text">1752–1992</p>
            </li>
            <li class="cursor-pointer border-l-4 border-accent py-2 pl-4 transition-colors hover:bg-secondary_background">
              <p class="text-sm font-semibold text-primary_text">Povelje</p>
              <p class="text-xs text-secondary_text">1769–1847</p>
            </li>
          </ul>
        </section>

        <section class="rounded-2xl bg-surface p-6 shadow-lg" aria-labelledby="services-heading">
          <h2 id="services-heading" class="mb-5 text-xl font-bold text-primary_text">Naše usluge</h2>
          <ul class="space-y-3">
            <li class="flex items-center gap-3 text-secondary_text"><i class="fas fa-magnifying-glass w-5 text-center text-primary" aria-hidden="true"></i> Naučno-istraživački rad</li>
            <li class="flex items-center gap-3 text-secondary_text"><i class="fas fa-file-circle-check w-5 text-center text-accent" aria-hidden="true"></i> Izdavanje uverenja</li>
            <li class="flex items-center gap-3 text-secondary_text"><i class="fas fa-camera w-5 text-center text-secondary" aria-hidden="true"></i> Digitalizacija dokumenata</li>
            <li class="flex items-center gap-3 text-secondary_text"><i class="fas fa-images w-5 text-center text-primary" aria-hidden="true"></i> Izložbene postavke</li>
            <li class="flex items-center gap-3 text-secondary_text"><i class="fas fa-book-open w-5 text-center text-accent" aria-hidden="true"></i> Arhivska biblioteka</li>
          </ul>
        </section>
      </aside>
    </section>

    <section class="mb-16" aria-label="Posebne delatnosti arhiva">
      <div class="grid gap-6 md:grid-cols-3">
        <article class="rounded-2xl border border-primary/10 bg-surface p-6 shadow-lg">
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10">
            <i class="fas fa-digital-tachograph text-2xl text-primary" aria-hidden="true"></i>
          </div>
          <h2 class="mb-2 text-xl font-bold text-primary_text">Digitalizacija</h2>
          <p class="leading-relaxed text-secondary_text">
            Mikrofilmovanje i digitalizacija od 2003. godine omogućavaju lakšu dostupnost arhivske građe.
          </p>
        </article>
        <article class="rounded-2xl border border-accent/10 bg-surface p-6 shadow-lg">
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-accent/10">
            <i class="fas fa-images text-2xl text-accent" aria-hidden="true"></i>
          </div>
          <h2 class="mb-2 text-xl font-bold text-primary_text">Izložbeni salon</h2>
          <p class="leading-relaxed text-secondary_text">
            Prostor od 146 m² za autorske i gostujuće izložbe, otvoren 2007. godine.
          </p>
        </article>
        <article class="rounded-2xl border border-secondary/10 bg-surface p-6 shadow-lg">
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-secondary/10">
            <i class="fas fa-book-open text-2xl text-secondary" aria-hidden="true"></i>
          </div>
          <h2 class="mb-2 text-xl font-bold text-primary_text">Biblioteka</h2>
          <p class="leading-relaxed text-secondary_text">
            Skoro 20.000 inventarnih jedinica. Najstarija knjiga datira iz 1573. godine.
          </p>
        </article>
      </div>
    </section>
  </div>
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
