<?php

namespace ClarityTech\Cms\Forms;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TaxonomyForm
{
    public static function make(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('type_of')
                ->label('Type')
                ->required()
                ->options(config('cms.taxonomy_types')),

            KeyValue::make('custom_properties')
                ->columnSpanFull(),
        ];
    }
}
