<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // TODO check :: validatie afhandelen in Request
    protected $postValidationRules = [
        'title' => 'required|min:5|max:255',
        'body' => 'required|min:5|max:65535',
        'is_premium' => '',
        'category' => 'required|array',
        'category.*' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048'
    ];

    public function index()
    {
        return view('posts/index', [
            'posts' => Post::latest()->get(),
            'categories' => Category::all()
        ]);
    }

    public function filteredIndex()
    {
        return view('posts/index', [
            'posts' => Post::latest()->filter(request(['category']))->get(),
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('posts/create', [
            'categories' => Category::all()
        ]);
    }

    public function store(StorePostRequest $request)
    {
        // TODO check :: validatie afhandelen in Request
        $validated = $request->validated();
        $post = new Post([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'is_premium' => $validated['is_premium'] ?? false ? true : false, // check if exsists, if so true, else false
            'user_id' => Auth::id()
        ]);

        $post->save();

        // TODO check :: volgens mij kun je attach() een array van ids geven, dit zou de foreach overbodig maken
        $post->categories()->attach($validated['category']);
        $this->insertImage($post);

        return redirect(route('posts.index'));
    }

    public function view(Post $post)
    {
        return view('posts/view', [
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        // TODO check :: onderstaande authenticatie kan je mooier oplossen door policie te gebruiken
        if ($this->authorize('update', $post)) {
            return view('posts/edit', [
                'post' => $post,
                'categories' => Category::all()
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // TODO check :: validatie afhandelen in Request
        $validated = $request->validated();

        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'is_premium' => $validated['is_premium'] ?? false ? true : false
        ]);

        // Attach only new categories
        // TODO check :: kijk is naar $post->categories()->sync() 
        $post->categories()->sync($validated['category']);

        // Add image
        $this->insertImage($post);

        return redirect(route('user.overview'));
    }

    public function delete(Post $post)
    {
        $post->comments()->delete();
        $post->categories()->detach();
        $post->image()->delete();
        $post->delete();

        return redirect(route('user.overview'));
    }


    protected function insertImage(Post $post)
    {
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
