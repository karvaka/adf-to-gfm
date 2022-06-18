<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\InlineNode;

class InlineCard extends InlineNode
{
    public function toMarkdown(): string
    {
        throw new \Exception(); // todo
    }
}
