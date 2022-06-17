<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm;

use RuntimeException;

class NodeMapper
{
    private array $nodesMap = [
        'blockquote' => Nodes\Blockquote::class,
        'doc' => Nodes\Doc::class,
        'hardBreak' => Nodes\HardBreak::class,
        'heading' => Nodes\Heading::class,
        'paragraph' => Nodes\Paragraph::class,
        'rule' => Nodes\Rule::class,
        'text' => Nodes\Text::class,
    ];

    private array $hydratorsMap = [
        Hydrators\DocHydrator::class => Nodes\Doc::class,
        Hydrators\HeadingHydrator::class => Nodes\Heading::class,
        Hydrators\TextHydrator::class => Nodes\Text::class,
    ];

    public function createNodeFromSchema(object $schema): Node
    {
        $type = $schema->type ?? throw new RuntimeException('Property [type] is required');

        if (! array_key_exists($schema->type, $this->nodesMap)) {
            throw new RuntimeException(sprintf('Unsupported node type [%s]', $type));
        }

        $node = new $this->nodesMap[$type]($type);

        foreach ($this->hydratorsMap as $hydrator => $target) {
            if ($node::class === $target) {
                (new $hydrator())->hydrate($node, $schema);
            }
        }

        if ($node instanceof BlockNode && isset($schema->content)) {
            $node->withContent($this->createContentNodesFromSchemas($node, $schema->content));
        }

        return $node;
    }

    protected function createContentNodesFromSchemas(BlockNode $parent, array $schemas): array
    {
        $content = [];

        foreach ($schemas as $schema) {
            $node = $this->createNodeFromSchema($schema);

            if (! $parent->canContain($node::class)) {
                throw new RuntimeException(
                    sprintf('Node [%s] can not contain [%s]', $parent::class, $node::class)
                );
            }

            $content[] = $node;
        }

        return $content;
    }
}
