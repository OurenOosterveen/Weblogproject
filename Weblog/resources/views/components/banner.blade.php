<div class="banner">
    @auth
        <span>Welcome back {{auth()->user()->username }}</span>
        <a href={{ route('user.logout') }}> Log out </a>
    @else
        <a href={{ route('user.create') }}> Register </a>
        <a href={{ route('user.signin') }}> Log in </a>
    @endauth
    
</div>