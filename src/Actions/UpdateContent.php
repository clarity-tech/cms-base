<?php

namespace ClarityTech\Cms\Actions;

use ClarityTech\Cms\Models\Content;
use ClarityTech\Cms\Contracts\UpdatesContents;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateContent implements UpdatesContents
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
    public function update($id, array $data): Content
    {
        // retrieve the content model instance by id
        $content = $this->contentModel::findOrFail($id);

        // validate data
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:contents,slug,' . $content->id,
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_tags' => 'nullable|array',
            'custom_properties' => 'nullable|array',
            'order_column' => 'required|integer',
            'type' => 'required|string',
            'layout' => 'required|string',
            'updated_by' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) 
        {
            throw new ValidationException($validator);
        }

        // Update the content
        $content->update($validator->validated());

        return $content;
    }
}