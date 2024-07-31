<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages;

use ClarityTech\Cms\Contracts\UpdatesContents;
use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditContent extends EditRecord
{
    protected static string $resource = ContentResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();

        if(is_null($this->record->published_at)) {
            if ($data['publish_status'] === 'publish') $data['published_at'] = now();
            else $data['published_at'] = null;
        } else {
            if ($data['publish_status'] === 'unpublish') $data['published_at'] = null;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $model, array $data): Model
    {
        $updates_contents = app(UpdatesContents::class);

        /* 
            FIXME: $data is not containing the slug (null) cause slug is setup to generate by spatie sluggable.
            So, using the Str::slug() helper function temporarily
            Suggestion: We need to make sure that sluggable generate the slug before it reaches the ContentData 
        */
        $data['slug'] = Str::slug($data['title']);

        // update the content using UpdatesContents contract
        return $updates_contents->update($model->id, new ContentData($data));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
