<?php

namespace ClarityTech\Cms;

use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages\CreateContent;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages\EditContent;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages\ListContents;
use ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource;
use ClarityTech\Cms\Filament\Admin\Resources\CommentResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class CmsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'clarity-tech-cms';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                ContentResource::class,
                TaxonomyResource::class,
                CommentResource::class,
            ])
            ->pages([
                CreateContent::class,
                EditContent::class,
                ListContents::class
            ]);
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
