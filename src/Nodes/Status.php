<?php

declare(strict_types=1);

namespace Karvaka\AdfToGfm\Nodes;

use Karvaka\AdfToGfm\InlineNode;

/**
 * todo make spec tests
 */
class Status extends InlineNode
{
    private string $text = '';
    private string $color = '';

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    private function pickColorEmoji(string $color): ?string
    {
        return match ($color) {
            'neutral' => '⚪',
            'purple' => '🟣',
            'blue' => '🔵',
            'red' => '🔴',
            'yellow' => '🟡',
            'green' => '🟢',
            default => null,
        };
    }

    public function toMarkdown(): string
    {
        if ($emoji = $this->pickColorEmoji($this->color)) {
            return (new Emoji())->setShortName($emoji)->toMarkdown() . ' ' . $this->text;
        }

        return $this->text;
    }
}
