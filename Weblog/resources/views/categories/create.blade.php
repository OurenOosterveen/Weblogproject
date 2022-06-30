<x-layout>
    <div>
        @if (session('succes'))
            {{ session('succes') }}
        @endif
        <form action={{route('category.store')}} method="post">
            @csrf

            <label for="name"> Category name </label>
            <input type="text" name="name" id="name"> <br>

            <input type="submit" value="Create category">
        </form>
    </div>
</x-layout>