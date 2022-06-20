<x-layout>
    @foreach ($posts as $post)
        <div class="post">
            <a href= {{ route('post.edit', ['post' => $post->id])}}>
                <h4> {{ $post->title }}</h4>
            </a>
            <small>
                Posted {{ $post->created_at->diffForHumans() }}
                by {{ $post->user->username }}
            </small>
            <p>
                {{ $post->body }}
            </p>
        </div>
    @endforeach
</x-layout>