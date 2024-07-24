<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Contracts\DeletesContents;
use ClarityTech\Cms\Models\Content;

class DeleteContent implements DeletesContents
{
    /**
     * Delete the given content record
     *
     * @param Content $content
     * @return void
     */
    public function delete(Content $content): void
    {
        $content->delete();
    }
}