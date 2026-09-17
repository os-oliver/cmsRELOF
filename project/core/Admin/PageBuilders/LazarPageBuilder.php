<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class LazarPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative overflow-hidden pt-24 pb-20 bg-background">
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-background via-background to-surface/30"></div>
    <div class="relative z-10 w-full max-w-6xl mx-auto px-6 lg:px-8">
      <div class="grid gap-10 lg:grid-cols-[340px_minmax(0,1fr)] lg:items-start">
        <aside class="rounded-3xl bg-secondary_background/80 border border-surface shadow-2xl overflow-hidden backdrop-blur-sm">
          <div class="p-4 sm:p-5">
            <div class="relative overflow-hidden rounded-2xl bg-surface aspect-[4/5]">
              <img
                src="/uploads/scan0010_0.jpg"
                alt="Lazar Vozarević"
                class="h-full w-full object-cover object-top"
                loading="lazy"
              >
            </div>
            <p class="mt-4 text-sm uppercase tracking-[0.2em] text-primary font-semibold">Lazar Vozarević</p>
            <p class="mt-1 text-secondary_text leading-relaxed text-sm">
              Srpski slikar i likovni pedagog iz Sremske Mitrovice
            </p>
          </div>
        </aside>

        <article class="rounded-3xl bg-secondary_background/70 border border-surface shadow-xl p-6 sm:p-8 lg:p-10 text-secondary_text">
          <h1 class="text-primary_text text-4xl sm:text-5xl font-heading font-bold mb-6">Lazar Vozarević</h1>
          <div class="space-y-4 text-base sm:text-lg leading-8 text-justify font-body">
            <p>Lazar Vozarević je rođen 15. juna 1925.godine u Sremskoj Mitrovici. Prva saznanja iz oblasti slikarstva je primio u Školi za primenjene umetnosti u Beogradu koju je upisao 1941. godine.</p>
            <p>Završio je Akademiju likovnih umetnosti u Beogradu 1948. Godine kod profesora Mila Milunivića. Bio je član grupe „Jedanaestorica“ i „Decembarske grupe“.</p>
            <p>Bavio se pored uljanog slikarstva, mozaikom i ilustracijom.</p>
            <p>Preminuo je 29.marta 1968.g. u Beogradu kao decent ALU u Beogradu.</p>
            <p>Njegova dela se nalaze u Muzeju savremene umetnosti u Beogradu, Umjetničkoj galeriji na Cetinju, Umjetničkoj galeriji u Sarajevu, Galeriji Matice Srpske u Novom Sadu, u Galeriji poklon – zbirke Rajka Mamuzića u Novom Sadu.</p>
            <p>Posle umetnikove smrti u njegovom rodnom gradu osnovana je Galerija Lazara Vozarevića, gde je sada izložen najveći broj njegovih radova.</p>
            <p>Dela Vozarevića nalaze se u inostranstvu: u Pinakoteci u Bariju i privatnim kolekcijama – David Rockfeller (SAD), Guido Trevisan (Italija), Libero Bigiartti (Italija), Vila Lobos (Brazil), De Silva (Brazil), Flockeemann (SAD), Gene Sklar (SAD), Philipe Baudet (Francuska) i dr.</p>
            <p>Monumentalno – dekorativni Vozarevićevi mozaici izvedeni su u hotelu „Metropol“ u Beogradu (1956 – 1957), u Vojnotehničkom institutu u Beogradu (1958) i u Domu omladine u Beogradu (1964).</p>
            <p>Lazar Vozarević je nagrađen Oktobarskom nagradom Beograda (1959) i nagradom za slikarstvo na I jugoslovenskom trijenalu likovnih umetnosti u Beogradu (1961).</p>
            <div class="pt-2">
              <p class="font-semibold text-primary_text mb-2">Samostalne izložbe</p>
              1952. Beograd, Galerija ULUS ( slike, tempere i crteži)<br>
              1953. Pariz, Galerie Saint Placide (slike, tempere i lavirani crteži)<br>
              1954. Beograd, Klub književnika (lavirani crteži)<br>
              1955. Novi Sad, Galerija Matice Srpske (slike i lavirani crteži)<br>
              1955. Zagreb, Salon Likum ( lavirani crteži)<br>
              1955. Beograd, Grafički kolktiv (lavirani crteži)<br>
              1956. Pariz, Galerija Rive Gauche (slike i crteži)<br>
              1957. Beograd, Galerija ULUS (slike i crteži)<br>
              1959. Beograd, Umetnički paviljon (slike i crteži)<br>
              1960. Njujork, Picasso Club (crteži)<br>
              1961. Sr. Mitrovica, Galerija Srema (slike i crteži)<br>
              1963. Venecija, Galeria d’Arte (slike i crteži)<br>
              1964. Beograd, Salon Moderne umetnosti (slike)<br>
              1965. Bari, Galleria la Panchetta (slike i crteži)<br>
              1966. Rim, Galleria Scipione (slike i crteži)<br>
              1968. Rim, Galleria II Cerchio (slike)<br>
              1968. Brisel, Palais de Beaux – Arts (slike)<br>
              1969 – 70. Beograd, Muzej savremene umetnosti, Retrospektivna izložba slika i crteža<br>
              1970. Priština, Pokrajinski kulturni centar (crteži), izložba je kasniije preneta u K. Mitrovicu, Obilić, Prizren i Gnjilane.<br><br>

              1975. Niš, Galerija savremene umetnosti (slike i crteži)<br>
              1983. Novi Sad, Galerija poklon – zbirke Rajka Mamuzića (slike i crteži)<br><br>

              <p>Lazar Vozarević je izlagao na vodećim i reprezentativnim izložbama srpske i jugoslovenske umetnosti u zemlji (Oktobarski salon, Jugoslovenski trijenale, Riječki salon itd) i u inostranstvu (Prag, Rim, Pariz, london, Montevideo, Nju Delhi, Štokholm).</p>
              <p>Izlagao je u okviru jugoslvenskih selekcija na I Bijenalu mladih u Parizu (1959), na VI Međunarodnoj izložbi u Tokiju (1961), na IV mediteranskom bijenalu u Aleksandriji (1961/62) i na XI Bijenalu u Sao Paolu (1967).</p>
            </div>
          </div>
        </article>
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
