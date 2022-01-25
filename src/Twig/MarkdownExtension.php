<?php

class MarkdownExtension extends \Twig\Extension\AbstractExtension
{
    private  $markdownConverter;
    public function __construct(\App\MarkdownConverter $markdownConverter){
        $this->markdownConverter = $markdownConverter;
    }
    public function getFilters(){
        return [     new \Twig\TwigFilter('markdown_to_html',[$this,'toHtml']),];
    }

    public function toHtml(string $content): string {
        $this->markdownConverter->toHtml($content);
    }
}