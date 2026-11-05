<?php

namespace App\Admin\PageBuilders;

class CitaonicaPageBuilder extends BasePageBuilder
{
    protected string $css = <<<'CSS'
.reading-room-hero {
    position: relative;
    overflow: hidden;
    padding: 5rem 1.5rem 7rem;
    background: linear-gradient(135deg, #1e3a8a, #1e40af 58%, #d97706);
    color: #fff;
}

.reading-room-hero::before,
.reading-room-hero::after {
    position: absolute;
    color: rgb(255 255 255 / 5%);
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    pointer-events: none;
}

.reading-room-hero::before {
    top: 2rem;
    left: 7%;
    content: "\f02d";
    font-size: 9rem;
    transform: rotate(-12deg);
}

.reading-room-hero::after {
    top: 4rem;
    right: 9%;
    content: "\f15c";
    font-size: 7rem;
    transform: rotate(12deg);
}

.reading-room-hero-inner {
    position: relative;
    z-index: 1;
    max-width: 64rem;
    margin: 0 auto;
    text-align: center;
}

.reading-room-hero-icon {
    display: inline-flex;
    width: 7rem;
    height: 7rem;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    border: 2px solid rgb(255 255 255 / 30%);
    border-radius: 9999px;
    background: rgb(255 255 255 / 10%);
    box-shadow: 0 0 2.5rem rgb(255 255 255 / 15%);
    backdrop-filter: blur(8px);
}

.reading-room-hero-icon i {
    font-size: 3.5rem;
}

.reading-room-hero h1 {
    margin-bottom: 1.25rem;
    font-size: clamp(2.75rem, 7vw, 4.5rem);
    font-weight: 800;
    line-height: 1.15;
    text-shadow: 0 4px 12px rgb(0 0 0 / 20%);
}

.reading-room-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: rgb(255 255 255 / 60%);
}

.reading-room-divider span {
    width: 4rem;
    height: 2px;
    border-radius: 9999px;
    background: rgb(255 255 255 / 60%);
}

.reading-room-hero p {
    max-width: 50rem;
    margin: 0 auto;
    color: rgb(255 255 255 / 95%);
    font-size: clamp(1.15rem, 2.8vw, 1.5rem);
    line-height: 1.7;
}

.reading-room-content {
    max-width: 80rem;
    margin: 0 auto;
    padding: 4rem 1.5rem;
}

.reading-room-section {
    margin-bottom: 5rem;
}

.reading-room-section-heading {
    margin-bottom: 2.5rem;
    text-align: center;
}

.reading-room-section-heading h2 {
    margin-bottom: 1rem;
    color: #1e293b;
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    line-height: 1.2;
}

.reading-room-heading-rule {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    color: #f59e0b;
}

.reading-room-heading-rule span {
    width: 3rem;
    height: 4px;
    border-radius: 9999px;
    background: #1e40af;
}

.reading-room-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 2rem;
}

.reading-room-card {
    position: relative;
    overflow: hidden;
    border: 1px solid rgb(30 64 175 / 10%);
    border-radius: 1.5rem;
    background: #fff;
    box-shadow: 0 12px 30px rgb(15 23 42 / 9%);
}

.reading-room-card-inner {
    height: 100%;
    padding: clamp(1.5rem, 4vw, 2.5rem);
}

.reading-room-card-title {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}

.reading-room-icon {
    display: flex;
    width: 4rem;
    height: 4rem;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    border-radius: 1rem;
    background: #eff6ff;
    color: #1e40af;
    font-size: 1.75rem;
}

.reading-room-icon-secondary {
    background: #fff7ed;
    color: #d97706;
}

.reading-room-card-title h3 {
    margin: 0.15rem 0 0.5rem;
    color: #1e293b;
    font-size: clamp(1.4rem, 3vw, 1.9rem);
    font-weight: 800;
    line-height: 1.2;
}

.reading-room-title-rule {
    width: 4rem;
    height: 4px;
    border-radius: 9999px;
    background: #1e40af;
}

.reading-room-title-rule-secondary {
    background: #d97706;
}

.reading-room-note {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: 1rem;
    background: #f1f5f9;
    color: #475569;
    font-size: 1.05rem;
    line-height: 1.75;
}

.reading-room-note i {
    flex: 0 0 auto;
    margin-top: 0.25rem;
    color: #1e40af;
    font-size: 1.35rem;
}

.reading-room-note strong {
    color: #1e293b;
    font-weight: 700;
}

.reading-room-unavailable-list,
.reading-room-feature-list {
    display: grid;
    gap: 1rem;
    margin: 0;
    padding: 0;
    list-style: none;
}

.reading-room-unavailable-list li,
.reading-room-feature-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #475569;
    line-height: 1.7;
}

.reading-room-unavailable-list i {
    flex: 0 0 auto;
    margin-top: 0.25rem;
    color: #d97706;
}

.reading-room-feature-list i {
    flex: 0 0 auto;
    margin-top: 0.25rem;
    color: #1e40af;
}

.reading-room-audience {
    padding: clamp(1.5rem, 4vw, 3rem);
    border: 1px solid rgb(245 158 11 / 25%);
    border-radius: 2rem;
    background: linear-gradient(135deg, rgb(245 158 11 / 10%), #f1f5f9, rgb(30 64 175 / 5%));
}

.reading-room-audience-intro {
    max-width: 48rem;
    margin: 0 auto 2.5rem;
    color: #475569;
    font-size: 1.15rem;
    line-height: 1.7;
    text-align: center;
}

.reading-room-audience .reading-room-card {
    border: 0;
}

.reading-room-highlight {
    margin-bottom: 1rem;
    padding: 1.25rem;
    border-left: 4px solid #1e40af;
    border-radius: 0 1rem 1rem 0;
    background: #f1f5f9;
    color: #475569;
    font-size: 1.1rem;
    line-height: 1.75;
}

.reading-room-highlight-secondary {
    border-left-color: #d97706;
}

.reading-room-subnote {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-top: 1rem;
    padding: 1rem;
    border-radius: 0.75rem;
    background: rgb(30 64 175 / 5%);
    color: #475569;
    line-height: 1.65;
}

.reading-room-subnote i {
    flex: 0 0 auto;
    margin-top: 0.2rem;
    color: #1e40af;
}

.reading-room-steps {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 2rem;
}

.reading-room-registration {
    margin-bottom: 3rem;
}

.reading-room-registration .reading-room-rule-header {
    padding: 1rem 1.25rem;
}

.reading-room-registration .reading-room-rule-header i {
    margin-bottom: 0.35rem;
    font-size: 1.75rem;
}

.reading-room-registration > .reading-room-card {
    height: auto;
    min-height: 0;
    align-self: start;
}

.reading-room-registration .reading-room-card-inner {
    height: auto;
    padding: 1.5rem;
}

.reading-room-registration .reading-room-steps {
    gap: 1.25rem 2rem;
}

.reading-room-registration .reading-room-procedure {
    margin-top: 1.25rem;
    padding: 1.25rem;
}

.reading-room-step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.reading-room-step-icon {
    display: flex;
    width: 3.5rem;
    height: 3.5rem;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    border-radius: 1rem;
    background: rgb(30 64 175 / 8%);
    color: #1e40af;
    font-size: 1.4rem;
}

.reading-room-step h3,
.reading-room-step h4 {
    margin-bottom: 0.4rem;
    color: #1e293b;
    font-size: 1.15rem;
    font-weight: 800;
}

.reading-room-step p {
    color: #475569;
    line-height: 1.7;
}

.reading-room-procedure {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-top: 2.5rem;
    padding: 1.5rem;
    border: 1px solid rgb(245 158 11 / 30%);
    border-radius: 1rem;
    background: linear-gradient(90deg, rgb(245 158 11 / 15%), #f1f5f9, rgb(245 158 11 / 15%));
    color: #475569;
    line-height: 1.75;
}

.reading-room-procedure > i {
    flex: 0 0 auto;
    margin-top: 0.2rem;
    color: #d97706;
    font-size: 1.5rem;
}

.reading-room-procedure h3 {
    margin-bottom: 0.5rem;
    color: #1e293b;
    font-size: 1.2rem;
    font-weight: 800;
}

.reading-room-rule-card {
    overflow: hidden;
    border-radius: 1.5rem;
    background: #fff;
    box-shadow: 0 12px 30px rgb(15 23 42 / 9%);
}

.reading-room-rule-header {
    padding: 1.75rem 1.25rem;
    background: linear-gradient(135deg, #1e40af, #d97706);
    color: #fff;
    text-align: center;
}

.reading-room-rule-header i {
    margin-bottom: 0.75rem;
    font-size: 2.5rem;
}

.reading-room-rule-header h3 {
    font-size: 1.5rem;
    font-weight: 800;
}

.reading-room-rule-body {
    padding: 1.5rem;
}

.reading-room-limit {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 1rem;
    padding: 1rem;
    border-radius: 1rem;
    background: #f1f5f9;
}

.reading-room-limit-number {
    display: flex;
    width: 3.5rem;
    height: 3.5rem;
    flex: 0 0 auto;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
    background: #1e40af;
    color: #fff;
    font-size: 1.75rem;
    font-weight: 800;
}

.reading-room-limit:nth-child(odd) .reading-room-limit-number {
    background: #d97706;
}

.reading-room-limit p {
    color: #475569;
    font-weight: 600;
}

.reading-room-rule-subheading {
    margin: 1.25rem 0 0.5rem;
    color: #1e293b;
    font-size: 1.1rem;
    font-weight: 800;
}

.reading-room-services {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1.25rem;
}

.reading-room-service {
    padding: 1.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 1.25rem;
    background: #fff;
    box-shadow: 0 8px 20px rgb(15 23 42 / 6%);
}

.reading-room-service i {
    margin-bottom: 1rem;
    color: #1e40af;
    font-size: 1.75rem;
}

.reading-room-service h3 {
    margin-bottom: 0.5rem;
    color: #1e293b;
    font-size: 1.15rem;
    font-weight: 800;
}

.reading-room-service p {
    color: #475569;
    line-height: 1.7;
}

.reading-room-duty-grid {
    display: grid;
    grid-template-columns: 1.25fr 1fr;
    gap: 1.5rem;
}

.reading-room-duty-panel {
    padding: 1.75rem;
    border-radius: 1.25rem;
    background: #fff;
    box-shadow: 0 8px 20px rgb(15 23 42 / 7%);
}

.reading-room-duty-panel h3 {
    margin-bottom: 1rem;
    color: #1e293b;
    font-size: 1.35rem;
    font-weight: 800;
}

.reading-room-duty-panel p {
    color: #475569;
    line-height: 1.75;
}

.reading-room-duty-callout {
    margin-top: 1rem;
    padding: 1.25rem;
    border-left: 4px solid #1e40af;
    border-radius: 0 1rem 1rem 0;
    background: #eff6ff;
}

.reading-room-duty-callout + .reading-room-duty-callout {
    border-left-color: #d97706;
    background: #fff7ed;
}

.reading-room-duty-callout h4 {
    margin-bottom: 0.4rem;
    color: #1e293b;
    font-weight: 800;
}

.reading-room-hours {
    position: relative;
    overflow: hidden;
    padding: clamp(2rem, 6vw, 4rem) 1.5rem;
    border-radius: 2.5rem;
    background: linear-gradient(135deg, #1e40af, #d97706, #1e3a8a);
    color: #fff;
    text-align: center;
    box-shadow: 0 24px 48px rgb(30 64 175 / 20%);
}

.reading-room-hours-icon {
    display: inline-flex;
    width: 6rem;
    height: 6rem;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    border: 3px solid rgb(255 255 255 / 35%);
    border-radius: 1.5rem;
    background: rgb(255 255 255 / 15%);
}

.reading-room-hours-icon i {
    font-size: 3rem;
}

.reading-room-hours h2 {
    margin-bottom: 1rem;
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 800;
}

.reading-room-hours-day {
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.reading-room-hours-time {
    display: inline-block;
    margin-bottom: 2rem;
    padding: 1rem clamp(1.5rem, 5vw, 3rem);
    border: 2px solid rgb(255 255 255 / 35%);
    border-radius: 1.25rem;
    background: rgb(255 255 255 / 15%);
    font-size: clamp(2.25rem, 7vw, 4rem);
    font-weight: 800;
    line-height: 1.2;
}

.reading-room-hours-features {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
}

.reading-room-hours-feature {
    min-width: 10rem;
    padding: 1rem 1.25rem;
    border: 1px solid rgb(255 255 255 / 25%);
    border-radius: 1rem;
    background: rgb(255 255 255 / 10%);
}

.reading-room-hours-feature i {
    margin-bottom: 0.5rem;
    font-size: 1.35rem;
}

.reading-room-hours-feature p {
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .reading-room-hero { padding: 4rem 1rem 5rem; }
    .reading-room-hero-icon { width: 5.5rem; height: 5.5rem; }
    .reading-room-hero-icon i { font-size: 2.75rem; }
    .reading-room-content { padding: 3rem 1rem; }
    .reading-room-section { margin-bottom: 3.5rem; }
    .reading-room-registration .reading-room-card-inner { padding: 1.25rem; }
    .reading-room-grid,
    .reading-room-steps,
    .reading-room-duty-grid { grid-template-columns: 1fr; }
    .reading-room-services { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 520px) {
    .reading-room-services { grid-template-columns: 1fr; }
    .reading-room-hours-feature { min-width: 8rem; }
}

@media (prefers-reduced-motion: reduce) {
    .reading-room-content *,
    .reading-room-content *::before,
    .reading-room-content *::after {
        scroll-behavior: auto !important;
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
CSS;

    protected string $html = <<<'HTML'
<main class="flex-grow bg-background">
  <section class="reading-room-hero" aria-labelledby="reading-room-title">
    <div class="reading-room-hero-inner">
      <div class="reading-room-hero-icon mt-10" aria-hidden="true">
        <i class="fas fa-book-reader"></i>
      </div>
      <h1 id="reading-room-title mt-10">Čitaonica</h1>
      <div class="reading-room-divider" aria-hidden="true"><span></span><i class="fas fa-square"></i><span></span></div>
      <p>Prostorija opremljena za korišćenje arhivske građe i bibliotečkog fonda Istorijskog arhiva Zrenjanin.</p>
    </div>
  </section>

  <div class="reading-room-content">
    <section class="reading-room-section" aria-labelledby="access-heading">
      <header class="reading-room-section-heading">
        <h2 id="access-heading">Pristup arhivskoj građi</h2>
        <div class="reading-room-heading-rule" aria-hidden="true"><span></span><i class="fas fa-circle"></i><span></span></div>
      </header>
      <div class="reading-room-grid">
        <article class="reading-room-card">
          <div class="reading-room-card-inner">
            <div class="reading-room-card-title">
              <div class="reading-room-icon"><i class="fas fa-check-circle" aria-hidden="true"></i></div>
              <div><h3>Dostupno za istraživanje</h3><div class="reading-room-title-rule"></div></div>
            </div>
            <div class="reading-room-note">
              <i class="fas fa-file-alt" aria-hidden="true"></i>
              <p>Sva arhivska građa za koju su urađena&nbsp;<strong>informativna sredstva</strong>.</p>
            </div>
          </div>
        </article>
        <article class="reading-room-card">
          <div class="reading-room-card-inner">
            <div class="reading-room-card-title">
              <div class="reading-room-icon reading-room-icon-secondary"><i class="fas fa-lock" aria-hidden="true"></i></div>
              <div><h3>Nije dostupno</h3><div class="reading-room-title-rule reading-room-title-rule-secondary"></div></div>
            </div>
            <ul class="reading-room-unavailable-list">
              <li><i class="fas fa-times-circle" aria-hidden="true"></i><span>Nesređena arhivska građa</span></li>
              <li><i class="fas fa-times-circle" aria-hidden="true"></i><span>Obolela građa bez kopije</span></li>
              <li><i class="fas fa-times-circle" aria-hidden="true"></i><span>Građa sa ograničenjem stvaraoca</span></li>
            </ul>
          </div>
        </article>
      </div>
    </section>

    <section class="reading-room-section reading-room-audience" aria-labelledby="audience-heading">
      <header class="reading-room-section-heading">
        <div class="reading-room-icon reading-room-icon-secondary" style="margin: 0 auto 1.25rem; width: 5rem; height: 5rem;">
          <i class="fas fa-users" aria-hidden="true"></i>
        </div>
        <h2 id="audience-heading">Ko može da koristi građu?</h2>
        <p class="reading-room-audience-intro">Arhivsku građu mogu koristiti različite kategorije korisnika pod specifičnim uslovima.</p>
      </header>
      <div class="reading-room-grid">
        <article class="reading-room-card">
          <div class="reading-room-card-inner">
            <div class="reading-room-card-title">
              <div class="reading-room-icon"><i class="fas fa-flag" aria-hidden="true"></i></div>
              <div><h3>Državljani Srbije</h3><div class="reading-room-title-rule"></div></div>
            </div>
            <p class="reading-room-highlight">Svaki državljanin Republike Srbije može koristiti arhivsku građu.</p>
            <p class="reading-room-subnote"><i class="fas fa-file-signature" aria-hidden="true"></i><span>Korisnik će biti upoznat sa&nbsp;<strong>Odlukom o korišćenju</strong> prilikom prijavljivanja.</span></p>
          </div>
        </article>
        <article class="reading-room-card">
          <div class="reading-room-card-inner">
            <div class="reading-room-card-title">
              <div class="reading-room-icon reading-room-icon-secondary"><i class="fas fa-globe-europe" aria-hidden="true"></i></div>
              <div><h3>Strani državljani</h3><div class="reading-room-title-rule reading-room-title-rule-secondary"></div></div>
            </div>
            <p class="reading-room-highlight reading-room-highlight-secondary">Moraju dobiti dozvolu od Pokrajinskog sekretarijata za kulturu i javno informisanje.</p>
            <ul class="reading-room-feature-list">
              <li><i class="fas fa-envelope" aria-hidden="true"></i><span>Slanje zahteva poštom ili e-mailom</span></li>
              <li><i class="fas fa-hourglass-half" aria-hidden="true"></i><span>Procedura traje&nbsp;<strong>do 30 dana</strong></span></li>
            </ul>
          </div>
        </article>
      </div>
    </section>

    <section class="reading-room-section reading-room-registration" aria-labelledby="registration-heading">
      <article class="reading-room-card">
        <header class="reading-room-rule-header">
          <i class="fas fa-user-check" aria-hidden="true"></i>
          <h2 id="registration-heading">Prijavljivanje</h2>
        </header>
        <div class="reading-room-card-inner">
          <div class="reading-room-steps">
            <div class="reading-room-step">
              <div class="reading-room-step-icon"><i class="fas fa-clock" aria-hidden="true"></i></div>
              <div><h3>Radno vreme</h3><p>Svakog dana od&nbsp;<strong>8 do 14 časova</strong>.</p></div>
            </div>
            <div class="reading-room-step">
              <div class="reading-room-step-icon"><i class="fas fa-phone" aria-hidden="true"></i></div>
              <div><h3>Kako se prijaviti</h3><p>Lično ili telefonom ovlašćenom radniku Arhiva.</p></div>
            </div>
            <div class="reading-room-step">
              <div class="reading-room-step-icon"><i class="fas fa-id-card" aria-hidden="true"></i></div>
              <div><h3>Potrebna dokumenta</h3><p>Ponesite ličnu kartu ili pasoš.</p></div>
            </div>
            <div class="reading-room-step">
              <div class="reading-room-step-icon"><i class="fas fa-edit" aria-hidden="true"></i></div>
              <div><h3>Matični list</h3><p>Popunjava se prilikom prijavljivanja.</p></div>
            </div>
          </div>
          <div class="reading-room-procedure">
            <i class="fas fa-info-circle" aria-hidden="true"></i>
            <div>
              <h3>Procedura nakon prijavljivanja</h3>
              <p>Nakon izbora građe nekog fonda ili zbirke za istraživanje, popunjava se&nbsp;<strong>zahtev za izdavanje arhivske građe</strong>. Jednim zahtevom može se izdati na korišćenje građa samo jednog fonda.</p>
            </div>
          </div>
        </div>
      </article>
    </section>

    <section class="reading-room-section" aria-labelledby="rules-heading">
      <header class="reading-room-section-heading">
        <h2 id="rules-heading">Pravila korišćenja</h2>
        <p class="reading-room-audience-intro">Dnevna ograničenja i posebni uslovi za različite vrste arhivske građe.</p>
        <div class="reading-room-heading-rule" aria-hidden="true"><span></span><i class="fas fa-square"></i><span></span></div>
      </header>
      <div class="reading-room-services">
        <article class="reading-room-rule-card">
          <header class="reading-room-rule-header"><i class="fas fa-layer-group" aria-hidden="true"></i><h3>Dnevno izdavanje</h3></header>
          <div class="reading-room-rule-body">
            <p>Maksimalan broj jedinica koje se mogu izdati u toku jednog dana:</p>
            <div class="reading-room-limit"><span class="reading-room-limit-number">5</span><p>Knjiga</p></div>
            <div class="reading-room-limit"><span class="reading-room-limit-number">10</span><p>Predmeta</p></div>
            <div class="reading-room-limit"><span class="reading-room-limit-number">3</span><p>Kutije spisa</p></div>
          </div>
        </article>
        <article class="reading-room-rule-card">
          <header class="reading-room-rule-header"><i class="fas fa-gem" aria-hidden="true"></i><h3>Raritetna dokumenta</h3></header>
          <div class="reading-room-rule-body">
            <p>Posebni uslovi za dragocena i raritetna dokumenta:</p>
            <h4 class="reading-room-rule-subheading">Radno vreme</h4>
            <p>Mogućnost korišćenja od 8 do 14 časova.</p>
            <h4 class="reading-room-rule-subheading">Dnevni zahtev</h4>
            <p>Zahtev se obnavlja svakog dana.</p>
            <h4 class="reading-room-rule-subheading">Po zahtevu</h4>
            <p>Samo jedan dokument po zahtevu.</p>
          </div>
        </article>
        <article class="reading-room-rule-card">
          <header class="reading-room-rule-header"><i class="fas fa-file-signature" aria-hidden="true"></i><h3>Zahtev za izdavanje</h3></header>
          <div class="reading-room-rule-body">
            <p>Važna pravila prilikom podnošenja zahteva:</p>
            <h4 class="reading-room-rule-subheading">Jedan fond</h4>
            <p>Jednim zahtevom izdaje se građa samo jednog fonda ili zbirke.</p>
            <h4 class="reading-room-rule-subheading">Izbor građe</h4>
            <p>Nakon izbora fonda popunjava se zahtev za izdavanje.</p>
            <h4 class="reading-room-rule-subheading">Popunjavanje</h4>
            <p>Zahtev se podnosi ovlašćenom radniku Arhiva.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="reading-room-section" aria-labelledby="services-heading">
      <header class="reading-room-section-heading">
        <h2 id="services-heading">Usluge čitaonice</h2>
        <p class="reading-room-audience-intro">Istorijski arhiv Zrenjanin nudi profesionalne usluge reprodukcije dokumenata.</p>
      </header>
      <div class="reading-room-services">
        <article class="reading-room-service"><i class="fas fa-copy" aria-hidden="true"></i><h3>Fotokopije</h3><p>Profesionalno kopiranje arhivskih dokumenata uz očuvanje kvaliteta originala.</p></article>
        <article class="reading-room-service"><i class="fas fa-camera" aria-hidden="true"></i><h3>Fotografije</h3><p>Visokokvalitetno fotografisanje dokumenata za istraživačke potrebe.</p></article>
        <article class="reading-room-service"><i class="fas fa-file-arrow-down" aria-hidden="true"></i><h3>Digitalne kopije</h3><p>Digitalizacija dokumenata u savremenim formatima za lakšu upotrebu.</p></article>
        <article class="reading-room-service"><i class="fas fa-box-open" aria-hidden="true"></i><h3>Preuzimanje kopija</h3><p>Zahtev se podnosi ovlašćenom licu koje će vas obavestiti kada možete da preuzmete kopije.</p></article>
      </div>
    </section>

    <section class="reading-room-section" aria-labelledby="duties-heading">
      <header class="reading-room-section-heading">
        <h2 id="duties-heading">Obaveze korisnika</h2>
        <p class="reading-room-audience-intro">Korisnici imaju određene obaveze prema Arhivu nakon korišćenja građe.</p>
      </header>
      <div class="reading-room-duty-grid">
        <article class="reading-room-duty-panel">
          <h3><i class="fas fa-book-open" aria-hidden="true"></i> Stručni radovi</h3>
          <p>Ukoliko se arhivska građa istražuje radi pisanja stručnog rada ili knjige, korisnik je u obavezi da Arhivu pošalje primerak objavljenog rada.</p>
          <ul class="reading-room-feature-list" style="margin-top: 1rem;">
            <li><i class="fas fa-book" aria-hidden="true"></i><span>Knjige</span></li>
            <li><i class="fas fa-file-lines" aria-hidden="true"></i><span>Naučni radovi</span></li>
          </ul>
        </article>
        <article class="reading-room-duty-panel">
          <div class="reading-room-duty-callout">
            <h4>Obavezan primerak</h4>
            <p>Jedan primerak objavljene knjige ili rada mora biti dostavljen Istorijskom arhivu Zrenjanin.</p>
          </div>
          <div class="reading-room-duty-callout">
            <h4>Doprinos zajednici</h4>
            <p>Vaš rad obogaćuje bibliotečki fond i pomaže budućim istraživačima.</p>
          </div>
        </article>
      </div>
    </section>

    <section class="reading-room-hours" aria-labelledby="hours-heading">
      <div class="reading-room-hours-icon"><i class="fas fa-calendar-week" aria-hidden="true"></i></div>
      <h2 id="hours-heading">Radno vreme</h2>
      <div class="reading-room-divider" aria-hidden="true"><span></span><i class="fas fa-circle"></i><span></span></div>
      <p class="reading-room-hours-day">Ponedeljak – petak</p>
      <p class="reading-room-hours-time">08:00 – 14:00</p>
      <div class="reading-room-hours-features">
        <div class="reading-room-hours-feature"><i class="fas fa-door-open" aria-hidden="true"></i><p>Svakog radnog dana</p></div>
        <div class="reading-room-hours-feature"><i class="fas fa-user-clock" aria-hidden="true"></i><p>Lično ili telefonski</p></div>
        <div class="reading-room-hours-feature"><i class="fas fa-id-card" aria-hidden="true"></i><p>Sa ličnom kartom</p></div>
      </div>
    </section>
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
