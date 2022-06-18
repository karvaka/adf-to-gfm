<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\InlineNode;

/**
 * todo make spec tests
 */
class InlineCard extends InlineNode
{
    private string $url = '#';

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function toMarkdown(): string
    {
        return $this->url;
    }
}