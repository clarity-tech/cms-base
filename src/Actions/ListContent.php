<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Contracts\ListsContents;
use ClarityTech\Cms\Models\Content;
use Illuminate\Pagination\LengthAwarePaginator;

class ListContent implements ListsContents
{
    /**
     * Get a list of contents
     *
     * @return LengthAwarePaginator
     */
    public function list(int $per_page = 10): LengthAwarePaginator
    {
        return Content::paginate($per_page);
    }
}