<?php

namespace App\Admin\PageBuilders;

class ContactPageBuilder extends BasePageBuilder
{
    protected string $css = "
        .form-toggle input:checked + label {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .complaint-toggle input:checked + label {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .complaint-submit {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .complaint-submit:hover {
            box-shadow: 0 15px 35px rgba(239, 68, 68, 0.4);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-bg {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .icon-bg-blue {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .icon-bg-green {
            background: linear-gradient(135deg, #10b981, #059669);
        }
    ";

    protected string $script = <<<'HTML'
<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const fullName = document.querySelector('input[name="ime"]').value.trim();
    const parts = fullName.split(' ').filter(p => p.length > 0);

    if (parts.length < 2) {
        alert("Molimo unesite i ime i prezime.");
        return;
    }

    const ime = parts[0];
    const prezime = parts.slice(1).join(' ');

    const formData = {
        ime: ime || '',
        prezime: prezime || '',
        email: document.querySelector('input[name="email"]').value,
        phone: document.querySelector('input[name="telefon"]').value,
        naslov: document.querySelector('input[name="naslov"]').value,
        poruka: document.querySelector('textarea[name="poruka"]').value
    };

    try {
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            // Show success message
            const successMessage = document.getElementById('success-message');
            successMessage.classList.remove('hidden');

            // Reset form
            this.reset();

            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.classList.add('hidden');
            }, 5000);
        } else {
            throw new Error('Failed to send message');
        }
    } catch (error) {
        alert('Error sending message: ' + error.message);
    }
});
</script>
HTML;

    protected string $html = <<<'HTML'
<main class="pt-2 flex-grow bg-background">
<div class="py-12 mt-20 px-4 flex-1">
        <div>
            <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
                A+
            </button>
        </div>
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold font-heading text-primary mb-6">
                    Kontaktirajte nas
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Vaše mišljenje nam je važno. Kontaktirajte nas za sve informacije ili pošaljite žalbu kako bismo
                    mogli da poboljšamo naše usluge.
                </p>
            </div>

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover h-fit">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8">Kontakt informacije</h2>

                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="icon-bg p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Adresa</h3>
                                    <p class="text-gray-600 leading-relaxed">Regionalni centar za profesionalni razvoj zaposlenih u obrazovanju<br>
                                    Nemanjina 52<br>31000 Užice, Srbija</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-blue p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Telefon</h3>
                                    <p class="text-gray-600 text-lg">+031/ 514-624</p>
                                    <p class="text-gray-600 text-lg">062/8086-751</p>
                                    <p class="text-gray-500 text-sm">Ponedeljak - Petak: 8:00 - 16:00</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="icon-bg-green p-4 rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Email</h3>
                                    <p class="text-gray-600 text-lg" data-translate="off">direktor@rcu-uzice.rs</p>
                                    <p class="text-gray-500 text-sm">Odgovaramo u roku od 24h</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 p-6 bg-gradient-to-br from-orange-50 to-blue-50 rounded-2xl border border-orange-100">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Radno vreme</h3>
                            <div class="text-gray-700 space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">Ponedeljak - Petak:</span>
                                    <span>8:00 - 16:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Subota:</span>
                                    <span class="text-red-500">Zatvoreno</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Nedelja:</span>
                                    <span class="text-red-500">Zatvoreno</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 card-hover">


                        <!-- Success Message (hidden by default) -->
                        <div id="success-message" class="hidden mb-8 p-6 bg-green-50 border-2 border-green-200 rounded-2xl success-message">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-green-800 font-bold text-lg" id="success-title">Vaša poruka je
                                        uspešno poslata!</p>
                                    <p class="text-green-700">Odgovoriće vam u najkraćem mogućem roku.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <form id="contact-form" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Ime i prezime *
                                    </label>
                                    <input type="text" name="ime" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="Unesite vaše ime i prezime">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Email adresa *
                                    </label>
                                    <input type="email" name="email" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="vasa.email@primer.com">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Broj telefona
                                    </label>
                                    <input type="tel" name="telefon" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="+381 xx xxx xxxx">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        <span id="subject-label">Naslov poruke *</span>
                                    </label>
                                    <input type="text" name="naslov" required="" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg" placeholder="Kratko opišite razlog kontakta" id="subject-input">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3">
                                    <span id="message-label">Vaša poruka *</span>
                                </label>
                                <textarea name="poruka" required="" rows="6" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 input-focus text-lg resize-none" placeholder="Detaljno opišite vaš upit ili problem..." id="message-input"></textarea>
                            </div>

                            <div class="pt-6">
                                <button type="submit" class="w-full text-white font-bold py-5 px-8 rounded-2xl bg-primary hover:bg-primary_hover text-lg" id="submit-button">
                                    <span class="flex items-center justify-center space-x-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        <span id="submit-text">Pošaljite poruku</span>
                                    </span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
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
        $content .= $this->script;
        return $content;
    }
}