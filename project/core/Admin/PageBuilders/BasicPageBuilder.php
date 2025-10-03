<?php

namespace App\Admin\PageBuilders;

class BasicPageBuilder extends BasePageBuilder
{
    protected string $css = '';
    protected string $script = '';
    protected string $html = '';

    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    public function buildPage(): string
    {
        $content = (string) $this->getHeader($this->css);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        $content .= $this->script;
        return $content;
    }
}