<x-layout>
    <div>
        <form action={{ route("user.login") }} method="post">
            @csrf
            <label for="email"> Email </label>
            <input type="email" name="email" id="email" required>

            <label for="password"> Password </label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">
        </form>

        @if ($errors->count)
            <ul>
            @foreach ($errors->all() as $e)
                <li class="error"> {{ $e }}</li>
            @endforeach
            </ul>
        @endif
    </div>
</x-layout>