<?php

namespace ClarityTech\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use ClarityTech\Cms\Http\Resources\ContentResource;
use ClarityTech\Cms\Models\Content;
use Exception;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::with(['createdBy', 'updatedBy'])->get();
        return ContentResource::collection($contents);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        $content->load(['createdBy', 'updatedBy']);
        return new ContentResource($content);
    }
}
