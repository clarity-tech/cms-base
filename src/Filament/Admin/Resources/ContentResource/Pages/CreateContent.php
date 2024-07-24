<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages;

use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateContent extends CreateRecord
{
    protected static string $resource = ContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        if($data['publish_status'] === 'publish'){
            $data['published_at'] = now();
        }
        else {
            $data['published_at'] = null;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $creates_contents = app(CreatesContents::class);

        // Use CreatesContents contract to create content
        return $creates_contents->create($data);
    }
}
