<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function index() {
        return view('posts/index', [
            'posts' => Post::all()->sortByDesc('created_at'),
            'categories' => Category::all()
        ]);
    }

    public function create() {
        return view('posts/create', [
            'categories' => Category::all()
        ]);
    }

    public function store() {
        request()->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:65535',
            'is_premium' => '',
            'category' => 'required|array',
            'category.*' => 'required|exists:categories,id'
        ]);

        $post = new Post();
        $post->title = request('title');
        $post->body = request('body');
        $post->is_premium = request()->has('is_premium');
        $post->user_id = Auth::id();

        $post->save();

        foreach (request('category') as $category) {
            $post->categories()->attach($category);
        }

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
                'post' => $post,
                'categories' => Category::all()
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function update(Post $post) {
        request()->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:65535',
            'is_premium' => '',
            'category' => 'required|array',
            'category.*' => 'required|exists:categories,id'
        ]);

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'is_premium' => request()->has('is_premium')
        ]);

        foreach (request('category') as $category){
            $post->categories()->attach($category);
        }
        
        return redirect(route('user.overview'));
    }

    public function delete(Post $post) {
        $post->comments()->delete();
        $post->delete();

        return redirect(route('user.overview'));
    }
}
