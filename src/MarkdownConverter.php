<?php

namespace App;

use League\CommonMark\CommonMarkConverter;

class MarkdownConverter
{
    public function toHtml(string $content): string
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links'=> false,
        ]);
        /** @var RenderedContentInterface $renderContent */
        $renderContent = $converter->convert($content);
        return $renderContent->getContent();
    }
}