<x-layout>
    <div>
        <form action={{ route("user.register") }} method="post">
            @csrf

            <label for="username"> Username </label>
            <input type="text" name="username" id="username" required>

            <label for="email"> Email </label>
            <input type="email" name="email" id="email" required>

            <label for="password"> Password </label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation" required> Repeat password </label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            <input type="submit" value="Register">
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