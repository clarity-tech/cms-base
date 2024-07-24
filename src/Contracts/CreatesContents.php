<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\Models\Content;

interface CreatesContents
{
    public function create(array $data): Content;
}