<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Issue;

class CommentController extends Controller
{
    public function storeReply(CommentRequest $request, Comment $comment)
    {
        $reply = $comment->comment()->create($request->all());
        return new CommentResource($reply);
    }

    public function store(CommentRequest $request, Issue $issue)
    {
        $comment = $issue->comments()->create($request->all());
        return new CommentResource($comment);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }
}
