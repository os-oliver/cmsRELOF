<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class RasporedAktivnostiPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <div class="absolute inset-0 z-0"></div>

    <div class="relative z-10 w-full max-w-6xl mx-auto px-6 font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading mb-6 text-center md:text-left">
        Raspored rada ustanove
      </h1>

      <p class="leading-relaxed mb-6 text-justify md:text-left">
        Organizacija rada u ustanovi prilagođena je potrebama dece, roditelja i zaposlenih.
        U nastavku je prikazan smenski raspored za celodnevni i poludnevni boravak,
        kao i radno vreme vaspitača, kuhinjskog osoblja, upravne zgrade i bolničkih grupa,
        uz detaljan dnevni raspored aktivnosti po smenama.
      </p>

      <div class="grid md:grid-cols-2 gap-10 items-start mt-6">

        <!-- LEVA KOLONA: organizacija rada ustanove -->
        <div class="text-left space-y-6">

          <!-- Ustanova – celodnevni i poludnevni boravak -->
          <div>
            <h2 class="font-heading text-xl text-primary_text mb-2">
              Ustanova – celodnevni i poludnevni boravak
            </h2>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Celodnevni boravak – prva smena:</strong> 05:30 – 16:30</li>
              <li><strong>Celodnevni boravak – druga smena:</strong> 12:00 – 22:30</li>
              <li>
                <strong>Poludnevni boravak (predškolska grupa u Sevojnu):</strong>
                07:30 – 11:30
              </li>
            </ul>
          </div>

          <hr class="border-black-300/40" />

          <!-- Vaspitno osoblje -->
          <div>
            <h2 class="font-heading text-xl text-primary_text mb-2">
              Vaspitno osoblje
            </h2>

            <h3 class="font-semibold mt-2 mb-1">Prepodnevna smena</h3>
            <ul class="list-disc list-inside space-y-1">
              <li>
                <strong>Prva smena:</strong>
                05:30 (07:00) – 11:30 (13:00)
              </li>
              <li>
                <strong>Druga smena:</strong>
                09:30 (10:00) – 15:30 (16:00 i 16:30)
              </li>
            </ul>

            <h3 class="font-semibold mt-3 mb-1">Popodnevna smena</h3>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Prva smena:</strong> 12:00 – 18:00</li>
              <li><strong>Druga smena:</strong> 16:30 – 22:30</li>
            </ul>
          </div>

          <hr class="border-black-300/40" />

          <!-- Kuhinjsko osoblje -->
          <div>
            <h2 class="font-heading text-xl text-primary_text mb-2">
              Kuhinjsko osoblje
            </h2>

            <h3 class="font-semibold mt-2 mb-1">Prepodnevna smena</h3>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Kuvarice:</strong> 05:30 – 13:30</li>
              <li><strong>Servirke:</strong> 07:00 – 15:00</li>
            </ul>

            <h3 class="font-semibold mt-3 mb-1">Popodnevna smena</h3>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Servirke:</strong> 11:00 – 19:00</li>
            </ul>
          </div>

          <hr class="border-black-300/40" />

          <!-- Upravna zgrada -->
          <div>
            <h2 class="font-heading text-xl text-primary_text mb-2">
              Upravna zgrada
            </h2>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Radno vreme:</strong> 07:00 – 15:00</li>
            </ul>
          </div>

          <hr class="border-black-300/40" />

          <!-- Bolničke grupe -->
          <div>
            <h2 class="font-heading text-xl text-primary_text mb-2">
              Bolničke grupe
            </h2>
            <ul class="list-disc list-inside space-y-1">
              <li><strong>Dečja pedijatrija:</strong> 11:00 – 17:00</li>
              <li><strong>Dečja hirurgija:</strong> 09:00 – 15:00</li>
            </ul>
          </div>
        </div>

        <!-- DESNA KOLONA: detaljan dnevni raspored aktivnosti -->
        <div class="text-left space-y-6">

          <!-- I smena – prepodnevni celodnevni boravak -->
          <div class="bg-white/60 rounded-2xl shadow-md p-6 backdrop-blur-sm">
            <h2 class="font-heading text-xl text-primary_text mb-2">
              I smena – prepodnevni celodnevni boravak
            </h2>
            <ul class="list-disc list-inside space-y-1">
              <li>
                <strong>05:30 – 08:00:</strong>
                Prijem dece, životno-praktične aktivnosti, igra
              </li>
              <li>
                <strong>08:00 – 09:00:</strong>
                Pripreme za doručak i doručak
              </li>
              <li>
                <strong>09:00 – 11:00:</strong>
                Realizacija projektnih aktivnosti, boravak na vazduhu
              </li>
              <li>
                <strong>11:00 – 11:30:</strong>
                Užina
              </li>
              <li>
                <strong>11:30 – 13:30:</strong>
                Odmor i spavanje
              </li>
              <li>
                <strong>13:30 – 14:00:</strong>
                Priprema za ručak i ručak
              </li>
              <li>
                <strong>14:00 – 16:30:</strong>
                Popodnevne aktivnosti i odlazak kući
              </li>
            </ul>
          </div>

          <!-- II smena – popodnevni boravak -->
          <div class="bg-white/60 rounded-2xl shadow-md p-6 backdrop-blur-sm">
            <h2 class="font-heading text-xl text-primary_text mb-2">
              II smena – popodnevni boravak
            </h2>
            <ul class="list-disc list-inside space-y-1">
              <li>
                <strong>12:00 – 14:00:</strong>
                Prijem dece, životno-praktične aktivnosti, igra
              </li>
              <li>
                <strong>14:00 – 15:00:</strong>
                Realizacija projektnih aktivnosti
              </li>
              <li>
                <strong>15:00 – 15:30:</strong>
                Pripreme za ručak i ručak
              </li>
              <li>
                <strong>15:30 – 17:00:</strong>
                Popodnevni odmor i spavanje
              </li>
              <li>
                <strong>17:00 – 18:00:</strong>
                Projektne aktivnosti, boravak u dvorištu
              </li>
              <li>
                <strong>18:00 – 18:30:</strong>
                Priprema za večeru i večera
              </li>
              <li>
                <strong>18:30 – 20:30:</strong>
                Projektne aktivnosti, igra
              </li>
              <li>
                <strong>20:00 – 20:30:</strong>
                Užina
              </li>
              <li>
                <strong>20:30 – 22:30:</strong>
                Igra, odlazak kući
              </li>
            </ul>
          </div>
        </div>
      </div>

      <p class="text-xs mt-6 text-gray-600 text-center md:text-left">
        Napomena: Raspored rada može biti usklađen sa potrebama korisnika i organizacijom rada ustanove.
      </p>
    </div>
  </section>

  <script>
    (function () {
      const btn = document.getElementById('increaseFontBtn');
      const container = document.querySelector('section .relative.z-10');
      let scale = 1;
      btn?.addEventListener('click', () => {
        scale = Math.min(1.3, scale + 0.1);
        if (scale > 1.29) scale = 1;
        container.style.transform = `scale(${scale})`;
        container.style.transition = 'transform 200ms ease`;
      });
    })();
  </script>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
$downloadUrl = '/files/raspored.pdf';
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
