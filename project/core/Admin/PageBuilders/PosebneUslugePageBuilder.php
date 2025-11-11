<?php

namespace App\Admin\PageBuilders;

class PosebneUslugePageBuilder extends BasePageBuilder
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

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center font-body text-secondary_text">
      <h1 class="text-primary_text text-4xl font-bold font-heading mb-4 mt-4">Posebne usluge naših predškolskih ustanova</h1>

        <div class="text-left mb-6 space-y-3">
            <p class="text-xl"><strong>Organizovani prevoz dece</strong> - Bezbedan i pouzdan dnevni transport do ustanove i nazad</p>
            <p class="text-xl"><strong>Dodatna ishrana</strong> - Prilagođeni obroci za decu sa posebnim dijetetskim potrebama</p>
            <p class="text-xl"><strong>Individualni rad sa decom</strong> - Personalizovani programi za decu sa posebnim potrebama</p>
            <p class="text-xl"><strong>Logopedske usluge</strong> - Redovne terapije za razvoj govora i jezika</p>
            <p class="text-xl"><strong>Psihološko savetovanje</strong> - Podrška deci u emocionalnom i socijalnom razvoju</p>
            <p class="text-xl"><strong>Roditeljski klub</strong> - Redovni susreti i radionice za roditelje</p>
            <p class="text-xl"><strong>Zdravstveni nadzor</strong> - Redovni pregledi i preventivne zdravstvene mere</p>
            <p class="text-xl"><strong>Prirodoslovne radionice</strong> - Edukativne aktivnosti u prirodi i van učionice</p>
            <p class="text-xl"><strong>Kreativne radionice</strong> - Dodatni programi muzičkog, likovnog i dramskog obrazovanja</p>
            <p class="text-xl"><strong>Vodene aktivnosti</strong> - Kursevi plivanja i vodene terapije za decu</p>
            <p class="text-xl"><strong>Rano učenje stranih jezika</strong> - Igrom vođeni kursevi engleskog i drugih jezika</p>
            <p class="text-xl"><strong>Uvod u digitalnu pismenost</strong> - Obrazovne aktivnosti uz upotrebu savremenih tehnologija</p>
            <p class="text-xl"><strong>Produženi boravak</strong> - Fleksibilni radni časovi za roditelje koji kasnije dolaze</p>
            <p class="text-xl"><strong>Talenti radionice</strong> - Programi za negovanje i razvoj posebnih talenata kod dece</p>
            <p class="text-xl"><strong>Inkluzivni programi</strong> - Integrisana edukacija za decu sa različitim sposobnostima</p>
        </div>

      <p class="text-sm mt-4 text-gray-600">
        Za dodatne informacije ili zakazivanje konsultacije, molimo kontaktirajte našu upravu.
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
        container.style.transition = 'transform 200ms ease';
      });
    })();
  </script>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
$description = "Savetovalište za roditelje, staratelje i zaposlene radi kao timsko savetovanje uz učešće psihologa, pedagoga i socijalnog radnika.";
PHP;

        $content = $this->getHeader(additionalPhp: $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
