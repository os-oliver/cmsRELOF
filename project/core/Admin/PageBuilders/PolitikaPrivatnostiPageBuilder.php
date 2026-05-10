<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class PolitikaPrivatnostiPageBuilder extends BasePageBuilder
{
    protected string $html = <<<'HTML'
<main>
  <div>
    <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Povećaj veličinu fonta">A+
    </button>
  </div>

  <section class="relative min-h-screen flex overflow-hidden pt-16 bg-gradient-to-br from-green-50 to-teal-50 text-center">
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-7xl mx-auto font-body text-secondary_text">
      <h1 class="text-primary_text text-5xl font-heading font-bold mt-16 mb-4 text-center">Politika privatnosti</h1>
      <section class="mx-5 space-y-6 text-gray-700 leading-relaxed text-xl text-left max-w-5xl mx-auto pb-16">

        <p>
            Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most veoma
            ozbiljno shvata privatnost Vaših podataka. Naša Politika zaštite
            privatnosti je osmišljena kako biste bili obavešteni o našoj praksi u vezi
            sa prikupljanjem, korišćenjem i otkrivanjem podataka koje nam dostavite
            direktno u Centru za pružanje usluga socijalne zaštite Grada Zrenjanina
            Most, prilikom pristupanja &nbsp;<strong>internet sajtu</strong>&nbsp;
            <a href="http://csr-zrenjanin.org.rs/" data-translate="off" class="text-blue-600">http://csr-zrenjanin.org.rs/</a>, kao i prilikom
            korišćenja ostalih usluga Centra Most. Molimo Vas da je pažljivo pročitate
            i upoznate se sa pravilima iste, jer bilo kakvo korišćenje ove internet
            stranice podrazumeva Vaše prihvatanje uslova navedenih u ovom tekstu.
        </p>



        <p>
            Politika privatnosti ima za cilj da Vas informiše koje lične
            podatke prikupljamo putem ove internet stranice, kako koristimo te podatke
            kao i da vam pruži ostale bitne informacije za ostvarenje vaših prava u vezi
            sa zaštitom podataka o ličnosti. Naša Politika privatnosti definiše
            odnos prema podacima o ličnosti koje posedujemo u cilju poštovanja prava
            na privatnost koje je zagarantovano međunarodnim i domaćim propisima.
        </p>

        <p>
            U cilju poštovanja načela obrade podataka definisanih u Zakonu o
            zaštiti podataka o ličnosti (ZZPL), naša Politika privatnosti obezbeđuje
            zakonito i transparentno prikupljanje podataka, precizno određenu svrhu
            obrade uz korišćenje najmanjeg mogućeg obima podataka za ispunjenje iste,
            tačnost podataka, ograničenost čuvanja i bezbednost podataka.
        </p>

        <p>
            Ovom Politikom privatnosti vas obaveštavamo o vrstama podataka o
            ličnosti koju obrađujemo, svrsi obrade, pravnom osnovu obrade, primaocima
            kojima se podaci o ličnosti otkrivaju, roku čuvanja podataka, vašim pravima,
            postojanju automatizovanog donošenja odluka i bezbednosti obrade.
        </p>

        <p>
            Ova Politika privatnosti se ne odnosi na način obrade podataka o
            ličnosti lica koja su u evidencijama Centra za pružanje usluga socijalne
            zaštite Grada Zrenjanina Most. Obaveštenje o načinu obrade podataka o
            ličnosti ovih lica sastavni je deo zahteva, obrazaca ili drugih akata Centra
            za pružanje usluga socijalne zaštite Grada Zrenjanina Most.
        </p>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Informacije koje možemo da prikupljamo i obrađujemo
        </h2>
        <p>Informacije koje možemo da prikupljamo i obrađujemo su sledeće:</p>

        <ul class="list-disc pl-8 space-y-3">
            <li>
                informacije na osnovu kojih možete biti lično identifikovani,
                kao što su ime, prezime, poštanska adresa,&nbsp;
                <span data-translate="off">e-mail</span>&nbsp; adresa i telefonski broj
            </li>

            <li>
                informacije koje se odnose na Vas, ali Vas ne identifikuju kao pojedinca
                (npr.  internet adresa – &nbsp;<span data-translate="off">IP</span>&nbsp; adresa),
            </li>

            <li>
                informacije o Vašoj internet konekciji, opremi koju koristite da pristupite
                našem sajtu i detaljima o upotrebi.
            </li>
        </ul>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Lični podaci
        </h2>

        <p>Lični podaci koje prikupljamo na našem sajtu mogu da obuhvate informacije
           koje navedete:</p>

           <ul class="list-disc pl-8 space-y-3">
            <li>
                popunjavanjem ili korišćenjem bilo kojeg formulara na sajtu
            </li>

            <li>
                Lični podaci koje prikupljamo na našem sajtu ili putem sajta mogu da
                obuhvate i evidenciju i kopije naše međusobne prepiske (uključujući &nbsp;<span data-translate="off">e-mail</span>&nbsp;
                adrese), ukoliko nas kontaktirate, kao i Vaše pretrage na našem sajtu.
            </li>
        </ul>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Način prikupljanja informacija
        </h2>

        <p>
            Mi prikupljamo podatke o Vama na nekoliko načina:
        </p>

        <ul class="list-disc pl-8 space-y-3">
            <li>direktno kada nam iste Vi dostavite i</li>
            <li>automatski dok koristite sajt.</li>
        </ul>

        <p>
            Prikupljamo samo one lične podatke koje Vi želite da nam dostavite ili
            one koji su neophodni u pružanju usluga. Direktne lične informacije kao što
            su ime, prezime, adresa, &nbsp;<span data-translate="off">e-mail</span>&nbsp; adresa, telefonski broj i slično prikupljamo
            samo ukoliko nam ih Vi dostavite.
        </p>


        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Automatsko prikupljanje podataka
        </h2>

        <p>
            Možemo da prikupljamo podatke dok koristite sajt automatski, koji
            uključuju detalje o korišćenju i IP adresi. Pristupanjem našem sajtu Vi se
            saglašavate da možemo da automatski prikupljamo i obrađujemo navedene
            podatke. Informacije koje možemo prikupljati automatski prilikom Vašeg
            pristupanja sajtu, dok pretražujete sajt i aktivni ste na njemu, su određene
            informacije o Vašoj opremi, aktivnostima i obrascima pretraživanja,
            uključujući i:
        </p>

        <ul class="list-disc pl-8 space-y-3">
            <li>detalje o Vašim posetama našem sajtu, uključujući i podatke o saobraćaju,
                podatke o lokaciji, evidencije i druge podatke o komunikaciji i izvorima
                kojima pristupate i koristite na sajtu,</li>
            <li>
                informacije o računaru i internet konekciji, uključujući i Vašu &nbsp;<span data-translate="off">IP</span>&nbsp; adresu,
                operativni sistem i tip pretraživača.
                Informacije koje automatski prikupljamo predstavljaju statističke podatke.
            </li>
        </ul>

        <p>
            Oni nam pomažu da poboljšamo sajt i pružimo bolju i personalizovanu
            uslugu jer nam omogućavaju da procenimo broj naših posetilaca i njihove
            obrasce korišćenja sajta, da sačuvamo informacije o Vašim preferencijama,
            što nam omogućava da sajt prilagodimo Vašem interesovanju, da ubrzamo Vašu
            pretragu, da Vas prepoznamo kada ponovo posetite sajt, kao i da analiziramo
            kako korisnici koriste sajt za interne potrebe u oblasti marketinga
            i istraživanja.
        </p>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Kako koristimo Vaše informacije
        </h2>

        <p>
            Mi koristimo informacije koje prikupimo o Vama ili koje nam Vi dostavite,
            uključujući i sve lične podatke:
        </p>

        <ul class="list-disc pl-8 space-y-3">
            <li>da bismo Vam predstavili naš sajt i njegov sadržaj,
            <li>da bismo Vam obezbedili informacije o našim uslugama,</li>
            <li>da bismo ispunili druge svrhe zbog kojih su informacije obezbeđene.</li>

        </ul>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Obezbeđenje bezbednosti Vaših ličnih informacija i drugih podataka
        </h2>

        <p>
            Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most,
            preduzima sve potrebne mere zaštite kako bi Vaše lične informacije bile
            bezbedne. U tom cilju, samo ovlašćeni zaposleni Centra za pružanje usluga
            socijalne zaštite Grada Zrenjanina Most i institucija koje učestvuju u
            pružanju usluga Centra Most, a koji su svi obavezni da čuvaju poverljive
            informacije, imaju pristup Vašim ličnim podacima. Pored toga,
            primenjujemo mere koje treba da zaštite Vaše lične podatke od slučajnog
            gubitka i neovlašćenog pristupa, korišćenja, promene i otkrivanja. Sve
            informacije koje nam dostavite čuvaju se na našim bezbednim serverima. Za
            adekvatan nivo bezbednosti primenjujemo različite tehnologije, kao što
            su upotreba lozinke, šifrovanje, ograničavanje i evidentiranje
            pristupa ličnim podacima, upotreba zaštitnog zida &nbsp;<span data-translate="off">(firewall)</span>,&nbsp; zaštita od
            prestanka servisa &nbsp;<span data-translate="off">(DDoS)</span>,&nbsp; kreiranje rezervne kopije podataka, zaštita od
            virusa i spam-a, kontinuirani nadzor sistema i servisa, kao i ostale
            tehnologije za bezbedno korišćenje servisa.
        </p>



        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Otkrivanje Vaših informacija
        </h2>

        <p>
            Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most, nikada
            neće deliti Vaše lične podatke sa trećim licima koja nameravaju da ih
            iskoriste u direktne marketinške svrhe.
        </p>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Ispravka, dopuna i brisanje podataka
        </h2>

        <p>
            Možete zatražiti da ažurirate svoje lične podatke koje mi posedujemo
            tako što ćete kontaktirati Centar Most na &nbsp;<span data-translate="off">e-mail</span>&nbsp; adresu:
            &nbsp;<span data-translate="off" class="text-blue-600">kontakt@centarmostzr.com</span>&nbsp; ili &nbsp;<span data-translate="off" class="text-blue-600">zastita.podataka@centarmostzr.com.</span>
            Možete zatražiti brisanje Vaših podataka tako što ćete kontaktirati
            Centar Most na &nbsp;<span data-translate="off">e-mail</span>&nbsp; adresu: &nbsp;<span data-translate="off" class="text-blue-600">kontakt@centarmostzr.com</span>&nbsp; ili &nbsp;<span data-translate="off" class="text-blue-600">zastita.podataka@centarmostzr.com.</span>&nbsp;
            Ukoliko imate bilo kakvih dodatnih pitanja
            ili komentar u vezi sa ovom Politikom zaštite privatnosti ili da postavite
            pitanje u vezi svojih ličnih podataka, to možete učiniti slanjem  &nbsp;<span data-translate="off">e-mail</span>-a Licu
            zaduženom za zaštitu podataka na adresu: &nbsp;<span data-translate="off" class="text-blue-600">zastita.podataka@centarmostzr.com.</span>
        </p>



        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Drugi internet sajtovi
        </h2>

        <p>
            Naš internet sajt može sadržati linkove za druge internet sajtove koji
            nisu pod našom kontrolom i koji ne podležu ovoj Politici zaštite
            privatnosti, što znači da ova Politika zaštite privatnosti ne važi za te
            sajtove, te Vam stoga preporučujemo da pažljivo pročitate Politiku zaštite
            privatnosti svakog sajta koji posetite. Ukoliko pristupite drugim internet
            sajtovima koristeći date linkove, operateri ovih internet sajtova mogu
            tražiti informacije od Vas koje će koristiti u skladu sa svojim politikama
            zaštite privatnosti, koje se mogu razlikovati od naše.
        </p>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Maloletni korisnici
        </h2>

        <p>
            Ukoliko ste maloletni, neophodno je da dobijete dozvolu svojih roditelja
            ili staratelja pre nego što nam date informacije o sebi.
            Maloletnim korisnicima koji nemaju ovakvo odobrenje nije dozvoljeno da nam
            daju lične informacije.
        </p>

        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Izmene politike privatnosti
        </h2>

        <p>
            Centar za pružanje usluga socijalne zaštite Grada Zrenjanina Most zadržava
            pravo da vrši izmene ove Politike zaštite informacija, bez prethodne
            najave. Stoga, molimo Vas da sledeći put kada posetite naš sajt, ponovo
            proverite uslove kako biste bili upoznati sa eventualnim promenama do kojih
            je došlo. Sve informacije o izmenama u našoj Politici zaštite privatnosti
            ćemo objaviti na ovoj stranici.
        </p>


        <h2 class="text-3xl font-bold text-primary_text pt-6">
            Kontakt informacije
        </h2>

        <div class="bg-white/70 rounded-2xl p-6 shadow-md border border-white/50 space-y-2">
            <p>
                <strong>
                    Centar za pružanje usluga socijalne zaštite
                    Grada Zrenjanina Most
                </strong>
            </p>

            <p>
                Gimnazijska 25/2G, 23000 Zrenjanin
            </p>

            <p>
                <span data-translate="off">Website:</span>
                <a href="http://csr-zrenjanin.org.rs/" data-translate="off">http://csr-zrenjanin.org.rs/</a>
            </p>

            <p>
                <span data-translate="off">E-mail:</span>
                <span data-translate="off" class="text-blue-600">kontakt@centarmostzr.com</span>
            </p>

            <p>
                <span data-translate="off">E-mail:</span>&nbsp; za zaštitu podataka:&nbsp;
                <span data-translate="off" class="text-blue-600">zastita.podataka@centarmostzr.com</span>
            </p>
        </div>

        </section>
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
