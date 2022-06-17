<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;
use Karvaka\AdfToGfm\Node;

/**
 * @link https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_cell/
 */
class TableCell extends BlockNode
{
    public function toMarkdown(): string
    {
        return implode(self::BREAK,
            array_map(fn (Node $node) => $node->toMarkdown(), $this->content())
        );
    }

    public function contains(): array
    {
        return [
            Blockquote::class,
            Heading::class,
            Paragraph::class,
            Rule::class,
        ];
    }
}
