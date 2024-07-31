<?php

namespace ClarityTech\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use ClarityTech\Cms\Http\Resources\ContentResource;

class ContentController extends Controller
{
    protected $contentModel;

    public function __construct() {
        $this->contentModel = app(config('cms.models.content'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = $this->contentModel::with(['createdBy', 'updatedBy'])->get();
        return ContentResource::collection($contents);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $content = $this->contentModel::where('slug', $slug)->with(['createdBy', 'updatedBy'])->firstOrFail();
        return new ContentResource($content);
    }
}
