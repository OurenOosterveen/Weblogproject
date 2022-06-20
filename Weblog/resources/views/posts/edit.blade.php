<x-layout>
    <form action={{ route('post.update',['post' => $post->id])}} method="post">
        @csrf
        @method('patch')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value={{$post->title}}>
        <br>

        <label for="body">Post body</label>
        <textarea name="body" id="body" cols="50" rows="10">{{$post->body}}</textarea>
        <br>

        <label for="is_premium">Premium members only?</label>
        <input type="checkbox" name="is_premium" id="is_premium" {{$post->is_premium ? "checked" : ''}}>
        <br>

        <input type="submit" value="Update post">
    </form>

    <form action={{route('post.delete', ['post' => $post->id])}} method="post">
        @csrf
        @method('delete')

        <input type="submit" value="Delete post">
        
    </form>
</x-layout>