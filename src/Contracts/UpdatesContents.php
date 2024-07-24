<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\Models\Content;

interface UpdatesContents
{
    public function update(Content $content, array $data): Content;
}
