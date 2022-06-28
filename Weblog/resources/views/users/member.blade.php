<x-layout>
    @auth
        @if (auth()->user()->is_premium)
            <h4>You are already member, return to the <a href={{route('posts.index')}}>homepage</a>. </h4>
        @else
            <form action={{route('user.setMember')}} method="post">
                @csrf
                <label for="confirm">Are you sure?</label>
                <input type="checkbox" name="confirm" id="confirm"> Yes
                @error('confirm')
                    <p class="error">You need to click the confirm button before you can become a member.</p>
                @enderror
                <br>

                <input type="submit" value="become member">
            </form>
        @endif
    @else
        <h4>You are not logged in. Please <a href={{route('user.login')}}>log in</a> or return to the <a href={{route('posts.index')}}>homepage</a>.</h4>
    @endauth
</x-layout>