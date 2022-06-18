<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\BlockNode;
use Karvaka\AdfToGfm\Node;

/**
 * @link https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/
 *
 * todo nested lists
 */
class OrderedList extends BlockNode
{
    private int $order = 1;

    public function setOrder(int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function toMarkdown(): string
    {
        return implode(
            self::BREAK,
            array_map(
                fn (Node $node, int $order) => sprintf('%s. %s', $order, $node->toMarkdown()),
                $this->content(),
                range($this->order, count($this->content()))
            )
        );
    }

    public function contains(): array
    {
        return [
            ListItem::class,
        ];
    }
}
