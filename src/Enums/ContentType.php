<?php

namespace ClarityTech\Cms\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContentType: string implements HasColor, HasLabel
{
    case Blog = 'blog';
    case Page = 'page';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Blog => 'success',
            self::Page => 'info',
        };
    }
}
