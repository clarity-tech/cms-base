<?php

namespace ClarityTech\Cms\Filament\Actions;

use ClarityTech\Cms\Models\Content;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PublishAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'publish';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Publish');

        $this->icon('heroicon-o-check-circle');

        $this->action(function (Content|Model $record) {
            $record->published_at = now();
            $record->save();
        });

        $this->visible(fn (Content $record) => !$record->isPublished() && !$record->trashed());
    }
}
