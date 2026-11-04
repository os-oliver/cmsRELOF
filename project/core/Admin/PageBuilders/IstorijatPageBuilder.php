<?php

namespace App\Admin\PageBuilders;

class IstorijatPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-12 bg-background flex-grow">
  <button id="increaseFontBtn"
          class="fixed bottom-6 right-6 z-50 rounded-full bg-primary px-5 py-3 font-bold text-background shadow-lg transition hover:bg-primary_hover focus:outline-none focus:ring-4 focus:ring-primary/30"
          aria-label="Povećaj veličinu fonta">A+</button>

  <section class="relative overflow-hidden bg-gradient-to-br from-secondary via-accent/60 to-primary py-24 md:py-28">
    <div class="absolute inset-0 opacity-5" aria-hidden="true">
      <i class="fas fa-landmark absolute left-8 top-10 text-8xl text-background md:left-20 md:text-9xl"></i>
      <i class="fas fa-scroll absolute right-8 top-40 rotate-12 text-7xl text-background md:right-16 md:text-8xl"></i>
      <i class="fas fa-history absolute bottom-10 left-1/3 -rotate-12 text-8xl text-background"></i>
      <i class="fas fa-building absolute bottom-16 right-1/4 rotate-12 text-6xl text-background"></i>
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-secondary/20 to-background/30"></div>
    <div class="container relative z-10 mx-auto px-6 text-center">
      <div class="mx-auto max-w-5xl">
        <div class="relative mb-8 inline-flex items-center justify-center md:mb-10">
          <div class="absolute inset-0 rounded-full bg-background/30 blur-3xl"></div>
          <div class="relative rounded-full border-4 border-background/40 bg-background/15 p-7 shadow-2xl backdrop-blur-md md:p-8">
            <i class="fas fa-university text-6xl text-background md:text-8xl" aria-hidden="true"></i>
          </div>
        </div>
        <h1 class="mb-8 font-heading text-5xl font-bold text-background drop-shadow-2xl md:text-8xl">Istorijat</h1>
        <div class="mb-8 flex items-center justify-center gap-4 md:mb-10" aria-hidden="true">
          <div class="h-1 w-16 rounded-full bg-background/70 md:w-20"></div>
          <i class="fas fa-circle text-sm text-background/60"></i>
          <div class="h-1 w-16 rounded-full bg-background/70 md:w-20"></div>
        </div>
        <p class="mx-auto max-w-4xl font-body text-2xl leading-relaxed text-background/95 drop-shadow-lg md:text-3xl">
          Više od 75 godina čuvanja kulturnog nasleđa Banata
        </p>
      </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0" aria-hidden="true">
      <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="h-16 w-full fill-background md:h-20">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
      </svg>
    </div>
  </section>

  <div class="container mx-auto px-6 py-16 md:py-20">
    <section class="mx-auto mb-20 max-w-5xl md:mb-24" aria-labelledby="about-archive-heading">
      <div class="relative">
        <div class="absolute -inset-3 rounded-[3rem] bg-gradient-to-r from-primary via-accent to-secondary opacity-20 blur-xl"></div>
        <div class="relative rounded-[2rem] border border-accent/30 bg-surface p-7 shadow-2xl md:rounded-[3rem] md:p-12">
          <div class="mb-8 flex items-start gap-5 md:gap-6">
            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-accent shadow-lg md:h-20 md:w-20">
              <i class="fas fa-info-circle text-3xl text-background md:text-4xl" aria-hidden="true"></i>
            </div>
            <div>
              <h2 id="about-archive-heading" class="mb-3 font-heading text-3xl font-bold text-primary_text md:text-4xl">O institutu</h2>
              <div class="h-1 w-32 rounded-full bg-primary"></div>
            </div>
          </div>
          <p class="font-body text-lg leading-relaxed text-secondary_text">
            Istorijski arhiv Zrenjanin je&nbsp;<strong class="font-semibold text-primary_text">ustanova kulture od regionalnog značaja</strong>&nbsp;
            koja se bavi zaštitom, prikupljanjem, sređivanjem, obradom i čuvanjem arhivske građe. Arhiv omogućuje dostupnost
            arhivskih dokumenata u naučnoistraživačke, privatnopravne i javnopravne svrhe. Zbog vredne arhivske građe,
            knjiga, novina i časopisa, kao i kulturno-prosvetne, izložbene i izdavačke delatnosti, Arhiv ima značajno
            mesto u kulturnom životu naše sredine.
          </p>
        </div>
      </div>
    </section>

    <section class="mb-20 md:mb-24" aria-labelledby="history-timeline-heading">
      <div class="mb-14 text-center md:mb-16">
        <h2 id="history-timeline-heading" class="mb-4 font-heading text-4xl font-bold text-primary_text md:text-5xl">Istorijski razvoj</h2>
        <div class="flex items-center justify-center gap-3" aria-hidden="true">
          <div class="h-1 w-14 rounded-full bg-primary md:w-16"></div>
          <i class="fas fa-clock text-xl text-accent"></i>
          <div class="h-1 w-14 rounded-full bg-primary md:w-16"></div>
        </div>
      </div>

      <div class="mx-auto max-w-6xl">
        <article class="relative border-l-4 border-primary/30 pb-14 pl-6 md:pb-16 md:pl-8">
          <div class="absolute -left-[1.15rem] top-0 flex h-9 w-9 items-center justify-center rounded-full border-4 border-background bg-gradient-to-br from-primary to-accent shadow-lg md:-left-6 md:h-12 md:w-12">
            <i class="fas fa-star text-sm text-background md:text-lg" aria-hidden="true"></i>
          </div>
          <div class="ml-3 md:ml-8">
            <div class="mb-4 inline-block rounded-full bg-primary/10 px-6 py-2">
              <span class="font-heading text-2xl font-bold text-primary">1947</span>
            </div>
            <div class="rounded-3xl border-l-4 border-primary bg-surface p-6 shadow-xl md:p-8">
              <h3 class="mb-4 font-heading text-2xl font-bold text-primary_text md:text-3xl">Osnivanje arhiva</h3>
              <div class="space-y-4 font-body text-secondary_text">
                <p class="text-lg leading-relaxed">
                  <strong class="font-semibold text-primary_text">1. avgusta 1947. godine</strong>&nbsp;Zrenjaninski istorijski arhiv
                  počeo je sa radom po odluci Glavnog izvršnog odbora Narodne skupštine Autonomne Pokrajine Vojvodine.
                </p>
                <div class="rounded-2xl bg-secondary_background p-5 md:p-6">
                  <div class="flex items-start gap-4">
                    <i class="fas fa-building mt-1 text-2xl text-primary" aria-hidden="true"></i>
                    <div>
                      <h4 class="mb-2 font-semibold text-primary_text">Originalni naziv</h4>
                      <p>Arhivsko središte broj 4 u Zrenjaninu</p>
                    </div>
                  </div>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                  <div class="rounded-xl bg-accent/10 p-4 text-center"><i class="fas fa-map-marked-alt mb-2 text-2xl text-accent" aria-hidden="true"></i><p class="font-semibold text-primary_text">Begejski srez</p></div>
                  <div class="rounded-xl bg-accent/10 p-4 text-center"><i class="fas fa-map-marked-alt mb-2 text-2xl text-accent" aria-hidden="true"></i><p class="font-semibold text-primary_text">Tamiški srez</p></div>
                  <div class="rounded-xl bg-accent/10 p-4 text-center"><i class="fas fa-map-marked-alt mb-2 text-2xl text-accent" aria-hidden="true"></i><p class="font-semibold text-primary_text">Jašatomićki srez</p></div>
                </div>
              </div>
            </div>
          </div>
        </article>

        <article class="relative border-l-4 border-secondary/30 pb-14 pl-6 md:pb-16 md:pl-8">
          <div class="absolute -left-[1.15rem] top-0 flex h-9 w-9 items-center justify-center rounded-full border-4 border-background bg-gradient-to-br from-secondary to-accent shadow-lg md:-left-6 md:h-12 md:w-12">
            <i class="fas fa-user-tie text-sm text-background md:text-lg" aria-hidden="true"></i>
          </div>
          <div class="ml-3 md:ml-8">
            <div class="rounded-3xl border-l-4 border-secondary bg-surface p-6 shadow-xl md:p-8">
              <h3 class="mb-6 font-heading text-2xl font-bold text-primary_text md:text-3xl">Prvi upravnik</h3>
              <div class="flex flex-col gap-5 rounded-2xl bg-gradient-to-r from-secondary_background to-accent/10 p-5 md:flex-row md:items-start md:gap-6 md:p-6">
                <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-secondary shadow-lg md:h-20 md:w-20">
                  <i class="fas fa-graduation-cap text-2xl text-background md:text-3xl" aria-hidden="true"></i>
                </div>
                <div class="flex-1">
                  <h4 class="mb-3 font-heading text-xl font-bold text-primary_text md:text-2xl">Timotej Tima Rajić</h4>
                  <ul class="space-y-2 text-secondary_text">
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-secondary" aria-hidden="true"></i><span>Bogoslov i pravnik</span></li>
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-secondary" aria-hidden="true"></i><span>Petrovgradski veliki beležnik</span></li>
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-secondary" aria-hidden="true"></i><span>Član Istorijskog društva u Novom Sadu</span></li>
                    <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-secondary" aria-hidden="true"></i><span>Vodeći arhivski stručnjak svoga vremena u Vojvodini</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </article>

        <article class="relative border-l-4 border-accent/30 pb-14 pl-6 md:pb-16 md:pl-8">
          <div class="absolute -left-[1.15rem] top-0 flex h-9 w-9 items-center justify-center rounded-full border-4 border-background bg-gradient-to-br from-accent to-primary shadow-lg md:-left-6 md:h-12 md:w-12">
            <i class="fas fa-signature text-sm text-background md:text-lg" aria-hidden="true"></i>
          </div>
          <div class="ml-3 md:ml-8">
            <div class="mb-4 inline-block rounded-full bg-accent/10 px-6 py-2">
              <span class="font-heading text-2xl font-bold text-accent">1965</span>
            </div>
            <div class="rounded-3xl border-l-4 border-accent bg-surface p-6 shadow-xl md:p-8">
              <h3 class="mb-4 font-heading text-2xl font-bold text-primary_text md:text-3xl">Sadašnji naziv</h3>
              <p class="font-body text-lg leading-relaxed text-secondary_text">
                Od 1965. godine ustanova nosi naziv&nbsp;
                <strong class="font-semibold text-primary_text">Istorijski arhiv Zrenjanin</strong>.
              </p>
            </div>
          </div>
        </article>

        <article class="relative border-l-4 border-primary/30 pb-14 pl-6 md:pb-16 md:pl-8">
          <div class="absolute -left-[1.15rem] top-0 flex h-9 w-9 items-center justify-center rounded-full border-4 border-background bg-gradient-to-br from-primary to-accent shadow-lg md:-left-6 md:h-12 md:w-12">
            <i class="fas fa-trophy text-sm text-background md:text-lg" aria-hidden="true"></i>
          </div>
          <div class="ml-3 md:ml-8">
            <div class="mb-4 inline-block rounded-full bg-primary/10 px-6 py-2">
              <span class="font-heading text-2xl font-bold text-primary">2007</span>
            </div>
            <div class="rounded-3xl border-2 border-primary/30 bg-gradient-to-br from-primary/5 to-accent/10 p-6 shadow-xl md:p-8">
              <div class="mb-6 flex items-center gap-4">
                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-accent shadow-lg md:h-16 md:w-16">
                  <i class="fas fa-award text-2xl text-background md:text-3xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-heading text-2xl font-bold text-primary_text md:text-3xl">Prestižna nagrada</h3>
                  <div class="mt-2 h-1 w-24 rounded-full bg-primary/40"></div>
                </div>
              </div>
              <p class="mb-6 font-body text-lg leading-relaxed text-secondary_text">
                Za uspešan rad, Arhiv je 2007. godine nagrađen prestižnom nagradom&nbsp;
                <strong class="font-semibold text-primary_text">„Zlatni arhiv“</strong>,&nbsp;koja se dodeljuje najuspešnijim
                arhivima u Republici Srbiji.
              </p>
              <div class="rounded-2xl bg-surface p-5 text-center">
                <i class="fas fa-medal mr-2 text-xl text-primary" aria-hidden="true"></i>
                <span class="font-body text-secondary_text">Priznanje za izuzetan doprinos očuvanju kulturnog nasleđa</span>
              </div>
            </div>
          </div>
        </article>

        <article class="relative pl-6 md:pl-8">
          <div class="absolute -left-[1.15rem] top-0 flex h-9 w-9 items-center justify-center rounded-full border-4 border-background bg-gradient-to-br from-secondary to-primary shadow-lg md:-left-6 md:h-12 md:w-12">
            <i class="fas fa-images text-sm text-background md:text-lg" aria-hidden="true"></i>
          </div>
          <div class="ml-3 md:ml-8">
            <div class="mb-4 inline-block rounded-full bg-secondary/10 px-6 py-2">
              <span class="font-heading text-2xl font-bold text-secondary">2007</span>
            </div>
            <div class="rounded-3xl border-l-4 border-secondary bg-surface p-6 shadow-xl md:p-8">
              <h3 class="mb-4 font-heading text-2xl font-bold text-primary_text md:text-3xl">Izložbeni salon</h3>
              <p class="font-body text-lg leading-relaxed text-secondary_text">
                Arhiv je dobio reprezentativan izložbeni salon za postavljanje izložbi iz građe svojih bogatih fondova i
                zbirki, kao i za gostovanje izložbi drugih arhiva, institucija i pojedinaca.
              </p>
            </div>
          </div>
        </article>
      </div>
    </section>

    <section class="mb-20 grid gap-8 md:mb-24 lg:grid-cols-2" aria-label="Delatnost i nadležnost Arhiva">
      <article class="rounded-3xl border border-primary/20 bg-surface p-7 shadow-xl md:p-8">
        <div class="mb-6 flex items-center gap-4">
          <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-primary/10">
            <i class="fas fa-map-marked-alt text-2xl text-primary" aria-hidden="true"></i>
          </div>
          <h2 class="font-heading text-2xl font-bold text-primary_text md:text-3xl">Teritorijalna nadležnost</h2>
        </div>
        <p class="mb-5 leading-relaxed text-secondary_text">
          Delatnost zaštite arhivske građe i registraturskog materijala obavlja se u skladu sa&nbsp;
          <strong class="text-primary_text">Zakonom o kulturnim dobrima</strong>&nbsp;za sledeće opštine:
        </p>
        <ul class="grid grid-cols-2 gap-3">
          <li class="flex items-center gap-2 rounded-xl bg-primary/5 p-4 text-primary_text"><i class="fas fa-location-dot text-primary" aria-hidden="true"></i>Zrenjanin</li>
          <li class="flex items-center gap-2 rounded-xl bg-primary/5 p-4 text-primary_text"><i class="fas fa-location-dot text-primary" aria-hidden="true"></i>Novi Bečej</li>
          <li class="flex items-center gap-2 rounded-xl bg-primary/5 p-4 text-primary_text"><i class="fas fa-location-dot text-primary" aria-hidden="true"></i>Nova Crnja</li>
          <li class="flex items-center gap-2 rounded-xl bg-primary/5 p-4 text-primary_text"><i class="fas fa-location-dot text-primary" aria-hidden="true"></i>Žitište</li>
          <li class="col-span-2 flex items-center gap-2 rounded-xl bg-primary/5 p-4 text-primary_text"><i class="fas fa-location-dot text-primary" aria-hidden="true"></i>Sečanj</li>
        </ul>
        <div class="mt-5 rounded-2xl bg-secondary_background p-5">
          <h3 class="mb-2 font-semibold text-primary_text">Zaštita van Arhiva</h3>
          <p class="text-sm leading-relaxed text-secondary_text">
            Zaštita arhivske građe i registraturskog materijala vrši se u više od 2.000 registratura.
            Arhiv Vojvodine ima nadležnost kontrole rada Istorijskog arhiva Zrenjanin.
          </p>
        </div>
      </article>

      <article class="rounded-3xl border border-accent/20 bg-surface p-7 shadow-xl md:p-8">
        <div class="mb-6 flex items-center gap-4">
          <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-accent/10">
            <i class="fas fa-book-open text-2xl text-accent" aria-hidden="true"></i>
          </div>
          <h2 class="font-heading text-2xl font-bold text-primary_text md:text-3xl">Izdavačka delatnost</h2>
        </div>
        <div class="space-y-4">
          <div class="rounded-2xl bg-secondary_background p-5">
            <h3 class="font-heading2 text-lg font-bold text-primary_text">Časopis „Arhivska građa“</h3>
            <p class="mt-2 text-secondary_text">Objavljeno 12 svezaka stručnog časopisa.</p>
            <p class="mt-1 text-sm text-secondary_text">Planira se ponovno pokretanje časopisa.</p>
          </div>
          <div class="rounded-2xl bg-secondary_background p-5">
            <h3 class="font-heading2 text-lg font-bold text-primary_text">Monografske publikacije</h3>
            <p class="mt-2 text-secondary_text">Objavljene su 22 monografske publikacije raznovrsnih tematskih sadržaja.</p>
          </div>
        </div>
      </article>
    </section>

    <section class="mb-20 rounded-[2rem] border-2 border-accent/30 bg-gradient-to-br from-accent/5 via-secondary_background to-primary/5 p-7 md:mb-24 md:rounded-[4rem] md:p-14" aria-labelledby="cultural-work-heading">
      <div class="mb-10 text-center md:mb-12">
        <div class="mb-5 inline-flex rounded-full bg-accent/20 p-5">
          <i class="fas fa-users text-4xl text-accent md:text-6xl" aria-hidden="true"></i>
        </div>
        <h2 id="cultural-work-heading" class="mb-4 font-heading text-3xl font-bold text-primary_text md:text-5xl">Kulturno-prosvetna delatnost</h2>
        <p class="mx-auto max-w-3xl font-body text-lg text-secondary_text md:text-xl">
          Aktivnosti usmerene na edukaciju i promociju kulturnog nasleđa
        </p>
        <div class="mt-6 flex items-center justify-center gap-3" aria-hidden="true">
          <div class="h-1 w-16 rounded-full bg-accent md:w-20"></div>
          <i class="fas fa-circle text-xs text-accent"></i>
          <div class="h-1 w-16 rounded-full bg-accent md:w-20"></div>
        </div>
      </div>
      <div class="mb-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <article class="rounded-2xl bg-surface p-6 shadow-lg transition-shadow hover:shadow-xl">
          <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-primary/10"><i class="fas fa-chalkboard-teacher text-3xl text-primary" aria-hidden="true"></i></div>
          <h3 class="mb-2 text-center font-heading2 text-lg font-bold text-primary_text">Predavanja</h3>
          <p class="text-center text-sm text-secondary_text">Učenicima osnovnih i srednjih škola</p>
        </article>
        <article class="rounded-2xl bg-surface p-6 shadow-lg transition-shadow hover:shadow-xl">
          <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-accent/10"><i class="fas fa-palette text-3xl text-accent" aria-hidden="true"></i></div>
          <h3 class="mb-2 text-center font-heading2 text-lg font-bold text-primary_text">Izložbe</h3>
          <p class="text-center text-sm text-secondary_text">Tematske izložbe iz fondova</p>
        </article>
        <article class="rounded-2xl bg-surface p-6 shadow-lg transition-shadow hover:shadow-xl">
          <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-secondary/10"><i class="fas fa-book-reader text-3xl text-secondary" aria-hidden="true"></i></div>
          <h3 class="mb-2 text-center font-heading2 text-lg font-bold text-primary_text">Promocije</h3>
          <p class="text-center text-sm text-secondary_text">Predstavljanje knjiga</p>
        </article>
        <article class="rounded-2xl bg-surface p-6 shadow-lg transition-shadow hover:shadow-xl">
          <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-primary/10"><i class="fas fa-globe text-3xl text-primary" aria-hidden="true"></i></div>
          <h3 class="mb-2 text-center font-heading2 text-lg font-bold text-primary_text">Onlajn prisutnost</h3>
          <p class="text-center text-sm text-secondary_text">Sajt i društvene mreže</p>
        </article>
      </div>

      <div class="rounded-3xl bg-surface p-6 shadow-xl md:p-8">
        <h3 class="mb-6 text-center font-heading2 text-2xl font-bold text-primary_text">Lokacije kulturnih aktivnosti</h3>
        <div class="grid gap-5 md:grid-cols-3">
          <div class="rounded-2xl bg-primary/5 p-6 text-center">
            <i class="fas fa-building mb-4 text-4xl text-primary" aria-hidden="true"></i>
            <h4 class="mb-2 font-heading2 font-semibold text-primary_text">Arhiv</h4>
            <p class="text-sm text-secondary_text">Glavni prostor za aktivnosti</p>
          </div>
          <div class="rounded-2xl bg-accent/5 p-6 text-center">
            <i class="fas fa-images mb-4 text-4xl text-accent" aria-hidden="true"></i>
            <h4 class="mb-2 font-heading2 font-semibold text-primary_text">Izložbeni salon</h4>
            <p class="text-sm text-secondary_text">Stalne i povremene izložbe</p>
          </div>
          <div class="rounded-2xl bg-secondary/5 p-6 text-center">
            <i class="fas fa-monument mb-4 text-4xl text-secondary" aria-hidden="true"></i>
            <h4 class="mb-2 font-heading2 font-semibold text-primary_text">Trg slobode</h4>
            <p class="text-sm text-secondary_text">Izložbe na otvorenom</p>
          </div>
        </div>
        <div class="mt-8 rounded-2xl border-2 border-primary/30 bg-gradient-to-r from-primary/10 to-accent/10 p-6 text-center">
          <i class="fas fa-users mb-3 text-3xl text-primary" aria-hidden="true"></i>
          <p class="mb-2 font-body text-lg font-semibold text-primary_text">Godišnje posetilaca</p>
          <p class="mb-2 font-heading text-4xl font-bold text-primary">Više stotina</p>
          <p class="text-sm text-secondary_text">sa tendencijom rasta broja posetilaca</p>
        </div>
      </div>
    </section>

    <section class="mx-auto max-w-5xl" aria-labelledby="research-tools-heading">
      <div class="relative">
        <div class="absolute -inset-2 rounded-[3rem] bg-gradient-to-r from-secondary via-accent to-primary opacity-20 blur-xl"></div>
        <div class="relative rounded-[2rem] border-2 border-secondary/30 bg-surface p-7 shadow-2xl md:rounded-[3rem] md:p-12">
          <div class="mb-8 flex items-center gap-5 md:gap-6">
            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-secondary to-accent shadow-lg md:h-20 md:w-20">
              <i class="fas fa-search-plus text-3xl text-background md:text-4xl" aria-hidden="true"></i>
            </div>
            <div>
              <h2 id="research-tools-heading" class="mb-2 font-heading text-3xl font-bold text-primary_text md:text-4xl">Naučno-informativna sredstva</h2>
              <div class="h-1 w-32 rounded-full bg-secondary/40 md:w-40"></div>
            </div>
          </div>
          <p class="mb-8 font-body text-lg leading-relaxed text-secondary_text">
            Za značajnije fondove izrađena su profesionalna informativna sredstva koja olakšavaju istraživanje:
          </p>
          <div class="mb-8 grid gap-5 md:grid-cols-3">
            <article class="rounded-2xl border-2 border-secondary/20 bg-gradient-to-br from-secondary/10 to-accent/5 p-6 text-center">
              <i class="fas fa-list-ul mb-4 text-4xl text-secondary" aria-hidden="true"></i>
              <h3 class="mb-2 font-heading2 text-lg font-bold text-primary_text">Analitički inventari</h3>
              <p class="text-sm text-secondary_text">Detaljan pregled sadržaja fondova</p>
            </article>
            <article class="rounded-2xl border-2 border-accent/20 bg-gradient-to-br from-accent/10 to-primary/5 p-6 text-center">
              <i class="fas fa-user-tag mb-4 text-4xl text-accent" aria-hidden="true"></i>
              <h3 class="mb-2 font-heading2 text-lg font-bold text-primary_text">Imenski registri</h3>
              <p class="text-sm text-secondary_text">Pretraga po imenima osoba</p>
            </article>
            <article class="rounded-2xl border-2 border-primary/20 bg-gradient-to-br from-primary/10 to-secondary/5 p-6 text-center">
              <i class="fas fa-map-marked-alt mb-4 text-4xl text-primary" aria-hidden="true"></i>
              <h3 class="mb-2 font-heading2 text-lg font-bold text-primary_text">Geografski registri</h3>
              <p class="text-sm text-secondary_text">Pretraga po geografskim lokacijama</p>
            </article>
          </div>
          <div class="rounded-2xl bg-secondary_background p-6">
            <div class="flex items-start gap-4">
              <i class="fas fa-compass mt-1 text-2xl text-primary" aria-hidden="true"></i>
              <div>
                <h3 class="mb-2 font-heading2 text-lg font-bold text-primary_text">Vodič kroz arhivske fondove</h3>
                <p class="leading-relaxed text-secondary_text">
                  Kompletan vodič koji omogućava istraživačima lakše snalaženje i pronalaženje dokumenata u arhivskim
                  fondovima i zbirkama.
                </p>
              </div>
            </div>
          </div>
        </div>
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
