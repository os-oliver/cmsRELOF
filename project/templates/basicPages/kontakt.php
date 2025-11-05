<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-500 to-indigo-600 py-16 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Kontaktirajte Nas</h1>
        <p class="text-lg max-w-2xl mx-auto">Imate pitanje, sugestiju ili žalbu? Na pravom ste mestu. Koristite
            odgovarajući obrazac za brz i efikasan odgovor.</p>
        <div class="mt-8 flex justify-center space-x-4">
            <a href="#contact-form"
                class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-50 transition">Opšti
                Upit</a>
            <a href="#complaint-form"
                class="bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-900 transition">Podnesite
                Žalbu</a>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section id="info" class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4">Naši Kontakti</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Stojimo vam na raspolaganju za sve vrste upita. Kontaktirajte nas
            putem telefona, emaila ili lično u našoj poslovnici.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Address Card -->
        <div class="p-6 bg-white rounded-2xl shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                    <i class="fas fa-map-marker-alt text-blue-500 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold">Adresa</h2>
            </div>
            <p class="text-gray-700 mb-2">Ulica Primer 123</p>
            <p class="text-gray-700">Žabalj, Srbija</p>
            <div class="mt-4">
                <a href="#" class="text-blue-500 hover:underline flex items-center">
                    <i class="fas fa-directions mr-2"></i> Pronađite nas na mapi
                </a>
            </div>
        </div>

        <!-- Phone Card -->
        <div class="p-6 bg-white rounded-2xl shadow-lg border-l-4 border-green-500">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                    <i class="fas fa-phone-alt text-green-500 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold">Telefon</h2>
            </div>
            <p class="text-gray-700 mb-2">+381 63 486 384</p>
            <p class="text-gray-700">Radno vreme: 09:00 - 17:00</p>
            <div class="mt-4">
                <a href="tel:+38163486384" class="text-green-500 hover:underline flex items-center">
                    <i class="fas fa-phone-volume mr-2"></i> Pozovite nas odmah
                </a>
            </div>
        </div>

        <!-- Email Card -->
        <div class="p-6 bg-white rounded-2xl shadow-lg border-l-4 border-purple-500">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                    <i class="fas fa-envelope text-purple-500 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold">Email</h2>
            </div>
            <p class="text-gray-700 mb-4" data-translate="off">info@primer.com</p>
            <div class="mt-4">
                <a href="mailto:info@primer.com" class="text-purple-500 hover:underline flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Pošaljite email
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Forms Section -->
<section id="forms" class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- General Inquiry Form -->
        <div id="contact-form" class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-blue-500">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                    <i class="fas fa-question-circle text-blue-500 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold">Opšti Upit</h3>
            </div>
            <p class="text-gray-600 mb-6">Imate pitanje ili vam je potrebna dodatna informacija? Popunite obrazac
                ispod i naš tim će vam odgovoriti u najkraćem mogućem roku.</p>

            <form action="/send-inquiry.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Ime i Prezime</label>
                    <input type="text" name="name" required placeholder="Unesite vaše ime i prezime"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Email adresa</label>
                    <input type="email" name="email" required placeholder="primer@email.com"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Vaša poruka</label>
                    <textarea name="message" rows="5" required placeholder="Opišite vaš upit..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i> Pošaljite Poruku
                </button>
            </form>
        </div>

        <!-- Complaint Form -->
        <div id="complaint-form" class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-red-500">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold">Podnošenje Žalbe</h3>
            </div>
            <p class="text-gray-600 mb-6">Ukoliko niste zadovoljni našim uslugama, ovde možete podneti žalbu.
                Obećavamo da ćemo ozbiljno razmotriti svaku prijavu i reagovati u najkraćem roku.</p>

            <form action="/send-complaint.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Ime i Prezime</label>
                    <input type="text" name="name" required placeholder="Unesite vaše ime i prezime"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Email adresa</label>
                    <input type="email" name="email" required placeholder="primer@email.com"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Detalji žalbe</label>
                    <textarea name="complaint" rows="5" required
                        placeholder="Opišite problem sa kojim ste se susreli..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Datum incidenta</label>
                    <input type="date" name="date"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent" />
                </div>
                <button type="submit"
                    class="w-full py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition flex items-center justify-center">
                    <i class="fas fa-file-alt mr-2"></i> Podnesite Žalbu
                </button>
            </form>
        </div>
    </div>
</section>