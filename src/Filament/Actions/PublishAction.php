<?php

namespace ClarityTech\Cms\Filament\Actions;

use ClarityTech\Cms\Cms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

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

        $this->action(function (Model $record) 
        {
            $contentModel = Cms::contentModel();

            if (!$record instanceof $contentModel) 
            {
                throw new InvalidArgumentException("Invalid Content model instance.");
            }
            
            $record->published_at = now();
            $record->save();
        });

        $this->visible(function (Model $record) 
        {
            $contentModel = Cms::contentModel();

            if (!$record instanceof $contentModel) 
            {
                throw new InvalidArgumentException("Invalid Content model instance.");
            }

            return !$record->isPublished() && !$record->trashed();
        });
    }
}
