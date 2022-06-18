<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\InlineNode;

class Emoji extends InlineNode
{
    public function toMarkdown(): string
    {
        throw new \Exception(); // todo
    }
}
