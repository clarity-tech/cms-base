<?php

namespace ClarityTech\Cms\Filament\Admin\Resources\ContentResource\Pages;

use ClarityTech\Cms\Contracts\UpdatesContents;
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

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

        // update the content using UpdatesContents contract
        return $updates_contents->update($model, $data);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
