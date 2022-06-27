<x-layout>
    @if ((auth()->user()->is_premium ?? false) || !$post->is_premium)
        <div class="post">
            <h4> {{ $post->title }}</h4>
            <small>
                Posted {{ $post->created_at->diffForHumans() }}
                by {{ $post->user->username }}
            </small>
            <p>
                {{ $post->body }}
            </p>
        </div>

        <div class="comments">
            <form action={{ route('comment.post', ['post' => $post->id]) }} method="post">
                @csrf
                <label for="comment">Write a comment</label> <br>
                <textarea name="comment" id="comment" cols="30" rows="5"></textarea> <br>
                <input type="submit" value="Post comment">
            </form>

            @foreach ($comments as $comment)
                <div class="comment-card">
                    <small>
                        Posted {{ $comment->created_at->diffForHumans() }}
                        by {{ $comment->user->username }}
                    </small> <br>
                    {{$comment->body}}
                </div>
            @endforeach
        </div>
    @else
        <p>
            You are not authorised to view this content.
            Please go back to our <a href={{ route('posts.index') }}>homepage</a> or become a <a href={{ route('posts.index') }}>premium member</a>.</p>
    @endif
</x-layout>