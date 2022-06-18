<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;
use Karvaka\AdfToGfm\Node;

/**
 * @link https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/
 *
 * todo nested lists
 */
class BulletList extends BlockNode
{
    public function toMarkdown(): string
    {
        return implode(
            self::BREAK,
            array_map(fn (Node $node) => sprintf('- %s', $node->toMarkdown()), $this->content())
        );
    }

    public function contains(): array
    {
        return [
            ListItem::class,
        ];
    }
}
