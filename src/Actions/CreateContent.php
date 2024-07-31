<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateContent implements CreatesContents
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = app(config('cms.models.content'));
    }

    /**
     * @param array $data
     * @return Content
     * @throws ValidationException
     */
    public function create(array $data): Content
    {
        // validate data
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:contents,slug',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_tags' => 'nullable|array',
            'custom_properties' => 'nullable|array',
            'order_column' => 'required|integer',
            'type' => 'required|string',
            'layout' => 'required|string',
            'created_by' => 'required|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
            'deleted_by' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if($validator->fails())
        {
            throw new ValidationException($validator);
        }
        
        return $this->contentModel::create($validator->validated());
    }
}