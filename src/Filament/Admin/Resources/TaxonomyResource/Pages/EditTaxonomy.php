<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource\Pages;

use ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaxonomy extends EditRecord
{
    protected static string $resource = TaxonomyResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
