<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Contracts\DeletesContents;

class DeleteContent implements DeletesContents
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = app(config('cms.models.content'));
    }

    /**
     * Delete the given content record
     *
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $content = $this->contentModel::findOrFail($id);
        $content->delete();
    }
}