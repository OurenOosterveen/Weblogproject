<x-layout>
    @foreach ($posts as $post)
    <div class="post">
            <h4> {{ $post->title }} || By: {{ $post->user->username }}</h4>
            <h5> Posted {{ $post->created_at->diffForHumans() }}</h5>
            <p>
                {{ $post->body }}
            </p>
    </div>
    @endforeach
</x-layout>