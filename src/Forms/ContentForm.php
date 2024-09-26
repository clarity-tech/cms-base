<?php

namespace ClarityTech\Cms\Forms;

use ClarityTech\Cms\Enums\ContentType;
use ClarityTech\Cms\Enums\LayoutType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ContentForm
{
    public static function make() : array {
        return [
            // Select::make('author_id') // FIXME: disabled author_id in content table temporarily
            //     ->relationship('author', 'name')
            //     ->required(),

            Section::make('Content Details')->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->maxLength(255)
                    ->disabled(),

                SpatieMediaLibraryFileUpload::make('featured')
                    ->collection('featured')
                    ->label('Featured Image'),

                Textarea::make('excerpt')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('content')
                    ->required(),
            ])->columnSpan(3),


            Group::make()->schema([
                Section::make('Metadata')->schema([
                    KeyValue::make('meta_tags'),

                    // KeyValue::make('custom_properties'), // FIXME: uncomment when necessary

                    DateTimePicker::make('published_at')
                        ->disabled(),

                    Select::make('publish_status')
                        ->label('Publish Status')
                        ->options([
                            'publish' => 'Publish',
                            'unpublish' => 'Unpublish',
                        ])
                        ->reactive()
                        ->required(),

                    Select::make('taxonomies')
                        ->relationship('taxonomy', 'name')
                        ->required()
                        ->preload(true),

                    SpatieTagsInput::make('tags')
                        ->placeholder('Write tag name and hit enter')
                        ->reorderable(),
                ]),


                Section::make('Other Options')->schema([
                    Select::make('type')
                        ->options(ContentType::class)
                        ->required(),

                    Select::make('layout')
                        ->options(LayoutType::class)
                        ->default(LayoutType::Default->value)
                        ->required(),

                    TextInput::make('order_column')
                        ->required()
                        ->numeric(),
                ]),
            ])->columnSpan(2)
        ];
    }
}