<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function post(Post $post)
    {
        // TODO :: validatie afhandelen in een Request
        request()->validate([
            'comment' => 'required|min:5|max:65535'
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        // TODO :: gevalideerde data gebruiken
        $comment->body = request('comment');

        $comment->save();

        return redirect()->back();
    }
}
