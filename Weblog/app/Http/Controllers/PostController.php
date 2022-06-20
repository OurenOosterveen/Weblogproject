<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function index() {
        return view('posts/index', [
            'posts' => Post::with('user')->get()->sortByDesc('created_at')
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
}
