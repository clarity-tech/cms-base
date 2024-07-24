<?php

namespace ClarityTech\Cms\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ListsContents
{
    public function list(int $per_page): LengthAwarePaginator;
}
