<?php

namespace ClarityTech\Cms\Contracts;

interface DeletesContents
{
    public function delete($id): void;
}
