<x-layout>
    @foreach ($posts as $post)
    <div class="post">
        <a href= {{ route('post.edit', ['post' => $post->id])}}>
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
    @endforeach
</x-layout>