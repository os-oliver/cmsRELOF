<?php

namespace App\Admin\PageBuilders;

class BasicPageBuilder extends BasePageBuilder
{
    protected string $css = '';
    protected string $script = '';
    protected string $html = <<<'HTML'
<main class="min-h-screen pt-24 flex-grow">

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