<x-layout>
    <form action={{ route('posts.store') }} method="post" enctype="multipart/form-data">
        @csrf
    
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>

        <label for="body">Post body</label>
        <textarea name="body" id="body" cols="50" rows="10"></textarea>
        <br>

        <label for="category">Select Category :</label>
        <select class="category-select2" multiple="multiple" name="category[]">
            @foreach ($categories as $category)
                <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
        </select><br>

        <label><strong>Add image: </strong></label>
        <input type="file" class="form-control" name="image">  <br>

        <label for="is_premium">Premium members only?</label>
        <input type="checkbox" name="is_premium" id="is_premium">
        <br>

        <input type="submit" value="Create post">
    
    </form>
</x-layout>