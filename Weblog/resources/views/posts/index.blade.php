<x-layout>
    <div class="searchbar">
        <form action={{route('posts.index.filtered')}} method="post">
            @csrf
            
            <label>
                <h4>Search category</h4>
            </label>
            <select class="category-select2" multiple="multiple" name="category[]">
                @foreach ($categories as $category)
                    <option value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select><br>
            <input type="submit" value="Search">
        </form>
    </div>


    @foreach ($posts as $post)
        <div class="post">
            <a href= {{ route('post.view', ['post' => $post->id])}}>
                <h4> {{ $post->title }}</h4>
            </a>
            @foreach ($post->categories as $category)
                <small class="category"> {{ $category->name }} </small>
            @endforeach <br>
            <small>
                Posted {{ $post->created_at->diffForHumans() }}
                by {{ $post->user->username }}
            </small> <br>
            <p>
                {{ $post->body }}
            </p>
        </div>
    @endforeach
</x-layout>