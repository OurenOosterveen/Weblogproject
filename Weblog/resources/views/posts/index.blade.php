<x-layout>

    <div class="sendmail">
        <form action={{ route('mail.send') }} method="post">
            @csrf
            <h1>Send all posts from the past week to your email</h1>
            <input type="email" name="email" id="email" placeholder="Your emailadress">
            <input type="submit" value="Send email">
        </form>
    </div>

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
        @if ((auth()->user()->is_premium ?? false) || !$post->is_premium)
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

                @if ($post->image)
                    <img src="{{ url('public/image/'.$post->image->url) }}" style="height: 100px; width: 150px;">
                @endif
            </div>
        @endif
    @endforeach
</x-layout>