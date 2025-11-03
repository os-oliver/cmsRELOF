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
<main class="min-h-screen pt-24 flex-grow">
    <div class="container">
      <header style="margin-bottom:18px">
        <h1>Информације од јавног значаја</h1>
        <p class="lead">
          Право на приступ информацијама од јавног значаја остварује се подношењем захтева надлежном органу.
          Овде се налази кратко упутство и образац <strong>(PDF)</strong> за преузимање.
        </p>
      </header>

      <div class="grid">
        <!-- MAIN -->
        <article>
          <section>
            <h2>Поступак подношења захтева</h2>
            <ol>
              <li><strong>Преузмите формулар</strong> кликом на дугме „Преузми формулар (PDF)”.</li>
              <li><strong>Попуните формулар</strong> на вашем рачунару (електронски или одштампан). Наведите
                  које информације/документе тражите и период на који се захтев односи.</li>
              <li><strong>Пошаљите попуњен захтев</strong> на адресу електронске поште:
                <a href="mailto:pisarnica@vas-domen.rs?subject=%D0%97%D0%B0%D1%85%D1%82%D0%B5%D0%B2%20%D0%B7%D0%B0%20%D0%BF%D1%80%D0%B8%D1%81%D1%82%D1%83%D0%BF%20%D0%B8%D0%BD%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%86%D0%B8%D1%98%D0%B0%D0%BC%D0%B0%20%D0%BE%D0%B4%20%D1%98%D0%B0%D0%B2%D0%BD%D0%BE%D0%B3%20%D0%B7%D0%BD%D0%B0%D1%87%D0%B0%D1%98%D0%B0">
                  pisarnica@vas-domen.rs                </a>. Можете послати и поштом/лично у писарници.</li>
              <li><strong>Одговор</strong>: након обраде добићете е-поруку са адресом/линком
                  одакле можете преузети тражене информације, или образложење ако захтев није могуће у целости уважити.</li>
            </ol>
          </section>

          <section class="card pad" style="margin-top:18px">
            <h3>Напомене</h3>
            <ul>
              <li>Приступ може бити ограничен у законом прописаним случајевима (заштита приватности, поверљивост, злоупотреба права и сл.).</li>
              <li>Уколико одговор не добијете у законском року, можете изјавити жалбу у складу са прописима.</li>
            </ul>
          </section>

          <!-- (Optional) Ovlašćena lica – edit or remove -->
          <section style="margin-top:18px">
            <h2>Овлашћена лица / Контакт</h2>
            <div class="card pad">
              <p><strong>За управу и националне заједнице</strong><br>Име Презиме — 021/000-00-00 — <a href="mailto:primer1@vas-domen.rs">primer1@vas-domen.rs</a></p>
              <hr style="border:none;border-top:1px solid var(--border);margin:12px 0">
              <p><strong>За област образовања</strong><br>Име Презиме — 021/000-00-01 — <a href="mailto:primer2@vas-domen.rs">primer2@vas-domen.rs</a></p>
              <hr style="border:none;border-top:1px solid var(--border);margin:12px 0">
              <p><strong>За област финансија</strong><br>Име Презиме — 021/000-00-02 — <a href="mailto:primer3@vas-domen.rs">primer3@vas-domen.rs</a></p>
            </div>
          </section>
        </article>

        <!-- SIDEBAR -->
        <aside>
          <div class="sticky">
            <div class="card pad">
              <h3>Документа</h3>
              <p class="muted" style="margin-top:-4px">Преузмите и попуните образац, затим пошаљите е-поштом.</p>
              <p style="margin:14px 0 0">
                <a class="btn" href="project/public/docs/sablon-zahtev.pdf" download="">
                  <!-- simple pdf icon -->
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h10a2 2 0 0 0 2-2V8z"></path><path d="M14 2v6h6"></path></svg>
                  Преузми формулар (PDF)
                </a>
              </p>

              <div style="margin-top:14px">
                <div class="email-box">
                  <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">pisarnica@vas-domen.rs</span>
                  <button class="btn btn-secondary" onclick="navigator.clipboard.writeText('pisarnica@vas-domen.rs')">Копирај</button>
                </div>
                <p style="margin:8px 0 0">
                  <a class="btn btn-secondary" href="mailto:pisarnica@vas-domen.rs?subject=%D0%97%D0%B0%D1%85%D1%82%D0%B5%D0%B2%20%D0%B7%D0%B0%20%D0%BF%D1%80%D0%B8%D1%81%D1%82%D1%83%D0%BF%20%D0%B8%D0%BD%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%86%D0%B8%D1%98%D0%B0%D0%BC%D0%B0%20%D0%BE%D0%B4%20%D1%98%D0%B0%D0%B2%D0%BD%D0%BE%D0%B3%20%D0%B7%D0%BD%D0%B0%D1%87%D0%B0%D1%98%D0%B0">Отвори е-пошту</a>
                </p>
              </div>

              <p class="muted" style="margin-top:12px;font-size:14px">
                Ако немате могућност слања е-поштом, захтев можете послати поштом или предати лично у писарници.
              </p>
            </div>
          </div>
        </aside>
      </div>
    </div>

    <footer>
      <div class="container">
        © 2025 — Lorem ipsum dolor • Информације од јавног значаја
      </div>
    </footer>
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
