<x-layout>
    <form action={{ route('post.update',['post' => $post->id])}} method="post">
        @csrf
        @method('patch')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value={{$post->title}}>
        <br>

        <label for="body">Post body</label>
        <textarea name="body" id="body" cols="50" rows="10">{{$post->body}}</textarea> <br>

        <label for="category"><strong>Select Category :</strong></label>
        <select class="category-select2" multiple="multiple" name="category[]">
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
        </select><br>

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





    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
         <form action="#" method="post">
            @csrf
            
         </form>
        </div>
    </div>
</x-layout>