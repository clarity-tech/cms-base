<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Contracts\DeletesContents;

class DeleteContent implements DeletesContents
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = Cms::contentModel();
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