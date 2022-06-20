<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function index() {
        return view('posts/index', [
            'posts' => Post::all()->sortByDesc('created_at')
        ]);
    }

    public function create() {
        return view('posts/create');
    }

    public function store() {
        request()->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:65535',
            'is_premium' => ''
        ]);

        $post = new Post();
        $post->title = request('title');
        $post->body = request('body');
        $post->is_premium = request()->has('is_premium');
        $post->user_id = Auth::id();
        $post->save();

        return redirect(route('posts.index'));
    }

    public function view(Post $post) {
        return view('posts/view', [
            'post' => $post,
            'comments' => 
                Comment::where('post_id', $post->id)
                ->orderByDesc('created_at')
                ->get()
        ]);
    }

    public function edit(Post $post) {
        if (auth()->id() == $post->user_id){
            return view('posts/edit', [
                'post' => $post
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function update(Post $post) {
        request()->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:65535',
            'is_premium' => ''
        ]);

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'is_premium' => request()->has('is_premium')
        ]);

        return redirect(route('user.overview'));
    }

    public function delete(Post $post) {
        $post->comments()->delete();
        $post->delete();

        return redirect(route('user.overview'));
    }
}
