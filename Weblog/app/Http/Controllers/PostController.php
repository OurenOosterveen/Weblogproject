<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postValidationRules = [
        'title' => 'required|min:5|max:255',
        'body' => 'required|min:5|max:65535',
        'is_premium' => '',
        'category' => 'required|array',
        'category.*' => 'required|exists:categories,id', 
        'image' => 'nullable|image|max:2048'
    ];

    public function index() {
        return view('posts/index', [
            'posts' => Post::latest()->get(),
            'categories' => Category::all()
        ]);
    }

    public function filteredIndex() {
        return view('posts/index', [
            'posts' => Post::latest()->filter(request(['category']))->get(),
            'categories' => Category::all()
        ]);
    }

    public function create() {
        return view('posts/create', [
            'categories' => Category::all()
        ]);
    }

    public function store() {
        request()->validate($this->postValidationRules);

        $post = new Post();
        $post->title = request('title');
        $post->body = request('body');
        $post->is_premium = request()->has('is_premium');
        $post->user_id = Auth::id();

        $post->save();

        foreach (request('category') as $category) {
            $post->categories()->attach($category);
        }

        $this->insertImage($post);

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
        request()->validate($this->postValidationRules);

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'is_premium' => request()->has('is_premium')
        ]);

        // Attach only new categories
        foreach (request('category') as $category){
            if (!$post->categories->contains($category)) {
                $post->categories()->attach($category);
            }
        }

        // Delete any categories not selected (form autoselects the categories attached to a Post)
        foreach ($post->categories as $category){
            if (!in_array($category->id, request('category'))) {
                $post->categories()->detach($category->id);
            }
        }

        // Add image
        $this->insertImage($post);
        
        return redirect(route('user.overview'));
    }

    public function delete(Post $post) {
        $post->comments()->delete();
        $post->categories()->detach();
        $post->image()->delete();
        $post->delete();

        return redirect(route('user.overview'));
    }


    protected function insertImage(Post $post) {
        if (request()->file('image')) {
            // Delete any previous image, before attaching new one
            if ($post->image) {
                $post->image()->delete();
            }

            $file = request()->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/image'), $filename);

            $image = new Image([
                'url' => $filename, 
                'post_id' => $post->id
            ]);

            $image->save();
        }
    }
}
