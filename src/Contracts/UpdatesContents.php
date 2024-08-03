<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\DataTransferObjects\ContentData;

interface UpdatesContents
{
    public function update($id, ContentData $data);
}
