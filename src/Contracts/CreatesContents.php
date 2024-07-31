<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Models\Content;

interface CreatesContents
{
    public function create(ContentData $data): Content;
}