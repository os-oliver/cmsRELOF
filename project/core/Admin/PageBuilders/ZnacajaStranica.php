<?php

namespace App\Admin\PageBuilders;

class ZnacajaStranica extends BasePageBuilder
{
    protected string $css = <<<'CSS'
        :root{
        --bg:#F7F2EA; --text:#5D4E4E; --text-strong:#1F1A1A;
        --accent:#8B1E3F; --accent-2:#2D3047; --accent-2-80:#2D3047CC;
        --card:#8B1E3F1A; --border:#e6e0d8; --white:#fff;
        }
        html,body{margin:0;padding:0;background:var(--bg);color:var(--text);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;line-height:1.6}
        a{color:var(--accent-2);text-decoration:none}
        a:hover{text-decoration:underline}
        .container{max-width:1150px;margin:0 auto;padding:0 16px}
        /* Header / Nav */
        header{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.85);backdrop-filter:saturate(120%) blur(6px);border-bottom:1px solid var(--border)}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:10px 0}
        .brand{display:flex;align-items:center;gap:10px;color:var(--text-strong)}
        .brand .logo{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:grid;place-items:center;color:#fff;font-weight:700}
        .nav-links{display:flex;gap:18px;align-items:center;flex-wrap:wrap}
        .nav-links a{color:var(--text);font-weight:500}
        .nav-links a:hover{color:var(--text-strong)}
        .lang{position:relative}
        .lang button{background:transparent;border:1px solid var(--border);padding:6px 10px;border-radius:999px;cursor:pointer;color:var(--text)}
        .lang-menu{position:absolute;right:0;top:110%;background:var(--white);border:1px solid var(--border);border-radius:10px;min-width:160px;box-shadow:0 10px 25px rgba(0,0,0,.08);display:none}
        .lang-menu a{display:block;padding:10px 12px;color:var(--text)}
        .lang.open .lang-menu{display:block}
        /* Layout */
        .page{padding:32px 0 56px}
        .grid{display:grid;grid-template-columns:1fr;gap:24px}
        @media (min-width: 980px){.grid{grid-template-columns: 2fr 1fr}}
        h1{font-family:"Bodoni Moda",serif;font-weight:700;color:var(--text-strong);margin:0 0 6px;font-size:clamp(28px,4vw,42px)}
        h2{font-family:"Bodoni Moda",serif;color:var(--text-strong);margin:24px 0 8px;font-size:clamp(20px,3vw,28px)}
        h3{font-family:"Bodoni Moda",serif;color:var(--text-strong);margin:18px 0 6px;font-size:20px}
        .lead{font-size:18px;max-width:70ch}
        .card{background:var(--card);border:1px solid var(--border);border-radius:14px}
        .card.pad{padding:18px}
        .btn{display:inline-flex;align-items:center;gap:10px;border-radius:999px;border:0;background:var(--accent);color:#fff;padding:12px 18px;font-weight:600;cursor:pointer}
        .btn:hover{background:#701932}
        .btn-secondary{background:var(--accent-2)}
        .btn-secondary:hover{background:var(--accent-2-80)}
        .muted{color:#7a6f6f}
        ol{padding-left:20px}
        .sticky{position:sticky;top:90px}
        .row{display:flex;gap:10px;align-items:center}
        .email-box{display:flex;justify-content:space-between;gap:10px;align-items:center;background:#fff;border:1px solid var(--border);padding:8px 10px;border-radius:10px}
        footer{border-top:1px solid var(--border);margin-top:40px;padding:20px 0;color:#7a6f6f}
        /* Mobile menu (simple) */
        .mobile-toggle{display:none}
        @media (max-width: 820px){
        .nav-links{display:none}
        .mobile-toggle{display:inline-flex;border:1px solid var(--border);border-radius:8px;padding:6px 10px;background:#fff;cursor:pointer;color:var(--text)}
        .nav.open .nav-links{display:flex;flex-direction:column;align-items:flex-start;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px;position:absolute;left:16px;right:16px;top:62px;z-index:60}
        }

        CSS;

    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen pt-24 flex-grow font-body text-secondary_text">
  <div class="container mx-auto px-4">

    <div class="grid md:grid-cols-2 gap-6 lg:gap-10">
      <!-- MAIN -->
      <article>
        <section class="mb-4">
          <h1 class="font-heading text-4xl md:text-5xl font-extrabold text-primary_text tracking-tight">
            Informacije od javnog značaja
          </h1>
          <p class="lead text-secondary_text/90 mt-2">
            Pravo na pristup informacijama od javnog značaja ostvaruje se podnošenjem zahteva nadležnom organu.
            Ovde se nalazi kratko uputstvo i obrazac <strong>(PDF)</strong> za preuzimanje.
          </p>
        </section>

        <section>
          <h2 class="font-heading2 text-2xl md:text-3xl text-primary_text mb-2">Postupak podnošenja zahteva</h2>
          <ol class="list-decimal pl-6 space-y-2">
            <li><strong>Preuzmite formular</strong>&nbsp;klikom na dugme „Preuzmi formular (PDF)”.</li>
            <li><strong>Popunite formular</strong>&nbsp;na vašem računaru (elektronski ili odštampan), navedite
              koje informacije ili dokumente tražite, kao i period na koji se zahtev odnosi.</li>
            <li><strong>Pošaljite popunjen zahtev</strong>&nbsp;na adresu elektronske pošte:&nbsp;
              <a data-translate="off" class="text-orange-600 hover:text-accent_hover underline-offset-2 hover:underline"
                 href="mailto:pisarnica@vas-domen.rs?subject=Zahtev%20za%20pristup%20informacijama%20od%20javnog%20zna%C4%8Daja">
                 pisarnica@vas-domen.rs
              </a>. Možete poslati i poštom ili lično, u pisarnici.</li>
            <li><strong>Odgovor</strong>: nakon obrade, dobićete e-poruku sa adresom ili linkom,
              sa koje možete preuzeti tražene informacije, ili obrazloženje ako zahtev nije moguće u celosti uvažiti.</li>
          </ol>
        </section>

        <section class="bg-surface border border-secondary/20 rounded-2xl p-6 mt-4">
          <h3 class="font-heading text-xl text-primary_text mb-3">Napomene</h3>
          <ul class="list-disc pl-6 space-y-2">
            <li>Pristup može biti ograničen u zakonom propisanim slučajevima (zaštita privatnosti, poverljivost, zloupotreba prava i sl.).</li>
            <li>Ukoliko odgovor ne dobijete u zakonskom roku, možete izjaviti žalbu u skladu sa propisima.</li>
          </ul>
        </section>

        <!-- (Optional) Ovlašćena lica – edit or remove -->
        <section class="mt-4">
          <h2 class="font-heading2 text-2xl md:text-3xl text-primary_text mb-2">Ovlašćena lica / Kontakt</h2>
          <div class="bg-surface border border-secondary/20 rounded-2xl p-6">
            <p><strong>Za upravu i nacionalne zajednice</strong><br>Ime Prezime — 021/000-00-00 — <a class="text-orange-600 hover:text-accent_hover" data-translate="off" href="mailto:primer1@vas-domen.rs">primer1@vas-domen.rs</a></p>
            <hr class="border-t border-secondary/30 my-3">
            <p><strong>Za oblast obrazovanja</strong><br>Ime Prezime — 021/000-00-01 — <a class="text-orange-600 hover:text-accent_hover" data-translate="off" href="mailto:primer2@vas-domen.rs">primer2@vas-domen.rs</a></p>
            <hr class="border-t border-secondary/30 my-3">
            <p><strong>Za oblast finansija</strong><br>Ime Prezime — 021/000-00-02 — <a class="text-orange-600 hover:text-accent_hover" data-translate="off" href="mailto:primer3@vas-domen.rs">primer3@vas-domen.rs</a></p>
          </div>
        </section>
      </article>

      <!-- SIDEBAR -->
      <aside>
        <div class="sticky top-24">
          <div class="bg-surface border border-secondary/20 rounded-2xl p-6">
            <h3 class="font-heading text-xl text-primary_text">Dokumenta</h3>
            <p class="text-secondary_text/80 mt-1">Preuzmite i popunite obrazac, a zatim ga pošaljite e-poštom.</p>
            <p class="mt-3">
              <a class="inline-flex items-center gap-2 bg-primary hover:bg-primary_hover text-white font-semibold rounded-full px-4 py-2"
                 href="/docs/sablon-zahtev.pdf" download="">
                <svg class="logocolor1" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path d="M14 2H6a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h10a2 2 0 0 0 2-2V8z"></path>
                  <path d="M14 2v6h6"></path>
                </svg>
                Preuzmi formular (PDF)
              </a>
            </p>

            <div class="mt-3">
              <div class="flex items-center justify-between gap-2 bg-white border border-secondary/30 rounded-xl px-3 py-2">
                <span class="truncate text-primary_text" data-translate="off">pisarnica@vas-domen.rs</span>
                <button class="inline-flex items-center gap-2 rounded-full px-3 py-2 bg-secondary hover:bg-secondary_hover text-white font-semibold"
                        onclick="navigator.clipboard.writeText('pisarnica@vas-domen.rs')">
                  Kopiraj
                </button>
              </div>
              <p class="mt-2">
                <a class="inline-flex items-center gap-2 rounded-full px-4 py-2 bg-secondary hover:bg-secondary_hover text-white font-semibold"
                   href="mailto:pisarnica@vas-domen.rs?subject=Zahtev%20za%20pristup%20informacijama%20od%20javnog%20zna%C4%8Daja">
                  Otvori e-poštu
                </a>
              </p>
            </div>

            <p class="text-secondary_text/70 mt-3 text-sm">
              Ako nemate mogućnost slanja e-poštom, zahtev možete poslati poštom ili predati lično u pisarnici.
            </p>
          </div>
        </div>
      </aside>
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
