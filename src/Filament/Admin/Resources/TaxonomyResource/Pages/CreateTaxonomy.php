<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource\Pages;

use ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxonomy extends CreateRecord
{
    protected static string $resource = TaxonomyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
