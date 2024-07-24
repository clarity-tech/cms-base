<?php

namespace ClarityTech\Cms\Contracts;

use ClarityTech\Cms\Models\Content;

interface DeletesContents
{
    public function delete(Content $content): void;
}
