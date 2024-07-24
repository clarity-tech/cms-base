<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages;

use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListContents extends ListRecords
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Contents'),
            'archived' => Tab::make('Archived')
                ->modifyQueryUsing(fn (Builder $query) => $query->onlyTrashed())
        ];
    }
}
