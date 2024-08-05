<?php

namespace ClarityTech\Cms\Filament\Actions;

use ClarityTech\Cms\Cms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

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

        $this->action(function (Model $record) 
        {
            $contentModel = Cms::contentModel();

            if (!$record instanceof $contentModel) 
            {
                throw new InvalidArgumentException("Invalid Content model instance.");
            }
            
            $record->published_at = null;
            $record->save();
        });

        $this->visible(function (Model $record) 
        {
            $contentModel = Cms::contentModel();

            if (!$record instanceof $contentModel) 
            {
                throw new InvalidArgumentException("Invalid Content model instance.");
            }

            return $record->isPublished() && !$record->trashed();
        });
    }
}
