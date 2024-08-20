<?php

namespace ClarityTech\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use ClarityTech\Cms\Http\Resources\CommentResource;
use ClarityTech\Cms\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return CommentResource::collection(Comment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'content_id' => 'required|exists:contents,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string',
        ]);

        $comment = Comment::create($request->all());

        return response($comment, Response::HTTP_CREATED);
    }

    // TODO: Use route model binding in show, update and destroy method; it's replaced with $id as not working
    /**
     * Display the specified resource.
     */
    public function show($id): CommentResource
    {
        $comment = Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): Response
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return response($comment, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
