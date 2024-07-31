<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Models\Content;

interface UpdatesContents
{
    public function update($id, ContentData $data): Content;
}
