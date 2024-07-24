<?php

namespace ClarityTech\Cms\Filament\Actions;

use ClarityTech\Cms\Models\Content;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class UnpublishAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'unpublish';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Unpublish');

        $this->icon('heroicon-o-x-circle');

        $this->action(function (Content|Model $record) {
            $record->published_at = null;
            $record->save();
        });

        $this->visible(fn (Content $record) => $record->isPublished() && !$record->trashed());
    }
}
