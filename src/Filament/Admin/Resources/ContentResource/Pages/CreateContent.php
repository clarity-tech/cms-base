<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages;

use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

        /* 
            FIXME: $data is not containing the slug (null) cause slug is setup to generate by spatie sluggable.
            So, using the Str::slug() helper function temporarily
            Suggestion: We need to make sure that sluggable generate the slug before it reaches the ContentData 
        */
        $data['slug'] = Str::slug($data['title']);

        // Use CreatesContents contract to create content
        return $creates_contents->create(new ContentData($data));
    }
}
