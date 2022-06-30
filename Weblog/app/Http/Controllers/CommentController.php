<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function post(CreateCommentRequest $request, Post $post)
    {
        // TODO :: validatie afhandelen in een Request
        $validated = $request->validated();
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => $validated['comment']
        ]);

        return redirect()->back();
    }
}
