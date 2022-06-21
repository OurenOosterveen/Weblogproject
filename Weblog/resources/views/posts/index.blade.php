<x-layout>
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