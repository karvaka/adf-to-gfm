<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;

class MediaGroup extends BlockNode
{
    public function toMarkdown(): string
    {
        throw new \Exception(); // todo
    }

    public function contains(): array
    {
        return [];
    }
}
