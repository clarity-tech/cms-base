<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\DataTransferObjects\ContentData;

interface CreatesContents
{
    public function create(ContentData $data);
}