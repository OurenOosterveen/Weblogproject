<div class="banner">

        <div class="banner-left">
            <span>   |   </span>
            <a href={{ route('posts.index')}}>Home</a>
            <span>   |   </span>
    @auth
            <a href={{ route('posts.create') }}>Write post</a>
            <span>   |   </span>
            <a href={{ route('category.create') }}>Create new category</a>
            <span>   |   </span>
        </div>

        <div class="banner-right">
            <span>   |   </span>
            <span>Welcome back {{auth()->user()->username }}</span>
            <span>   |   </span>
            <a href={{ route('user.overview') }}>Personal overview</a>
            <span>   |   </span>
            @if (!auth()->user()->is_premium)
            <a href={{ route('user.member') }}>Become premium member</a>
            <span>   |   </span>
            @endif
            <a href={{ route('user.logout') }}> Log out </a>
            <span>   |   </span>
        </div>
    @else
        </div>
        <div class="banner-right">
            <span>   |   </span>
            <a href={{ route('user.create') }}> Register </a>
            <span>   |   </span>
            <a href={{ route('user.signin') }}> Log in </a>
            <span>   |   </span>
        </div>
    @endauth
    
</div>