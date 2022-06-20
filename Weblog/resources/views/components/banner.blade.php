<div class="banner">
    @auth
        <span>Welcome back {{auth()->user()->username }}</span>
        <span>   |   </span>
        <a href={{ route('posts.create') }}>Write post</a>
        <span>   |   </span>
        <a href={{ route('user.overview') }}>Personal overview</a>
        <span>   |   </span>
        <a href={{ route('user.logout') }}> Log out </a>
    @else
        <a href={{ route('user.create') }}> Register </a>
        <a href={{ route('user.signin') }}> Log in </a>
    @endauth
    
</div>