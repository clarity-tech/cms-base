<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Contracts\ListsContents;
use Illuminate\Pagination\LengthAwarePaginator;

class ListContent implements ListsContents
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = Cms::contentModel();
    }

    /**
     * Get a list of contents
     *
     * @return LengthAwarePaginator
     */
    public function list(int $per_page = 10): LengthAwarePaginator
    {
        return $this->contentModel::paginate($per_page);
    }
}