<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;
use Karvaka\AdfToGfm\Node;

class ListItem extends BlockNode
{
    public function toMarkdown(): string
    {
        return implode(
            self::BREAK,
            array_map(fn (Node $node) => $node->toMarkdown(), $this->content())
        );
    }

    public function contains(): array
    {
        return [
            BulletList::class,
            CodeBlock::class,
            MediaSingle::class,
            OrderedList::class,
            Paragraph::class,
        ];
    }
}
