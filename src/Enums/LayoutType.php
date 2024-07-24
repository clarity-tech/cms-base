<?php

namespace ClarityTech\Cms\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LayoutType: string implements HasColor, HasLabel
{
    case Default = 'default';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Default => 'success',
        };
    }
}
