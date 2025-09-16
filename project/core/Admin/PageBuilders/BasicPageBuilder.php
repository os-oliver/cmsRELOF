<?php

namespace App\Admin\PageBuilders;

class BasicPageBuilder extends BasePageBuilder
{
    public function buildPage(): string
    {
        $content = $this->getHeader();
        $content .= $this->getCommonIncludes();

        $content .= <<<'HTML'
<main class="flex-grow">
    <div>
        <button id="increaseFontBtn" class="fixed right-4 top-24 z-50 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-font"></i>
        </button>
    </div>
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-8">Welcome</h1>
                <p class="text-xl text-gray-600 mb-8">This is a basic page template that can be customized further.</p>
            </div>
        </div>
    </section>
</main>
HTML;

        $content .= $this->getFooter();
        return $content;
    }
}