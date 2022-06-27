@component('mail::message')
# The weekly digest of SuperAwesomeWebblog

@foreach ($posts as $post)
@component('mail::panel')
<div class="post">
<h4> {{ $post->title }}</h4>
@if ($post->categories)
@foreach ($post->categories as $category)
<small class="category"> {{ $category->name }} </small>
@endforeach <br>
@endif
<small>
Posted {{ $post->created_at->diffForHumans() }}
by {{ $post->user->username }}
</small> <br>
<p>
{{ $post->body }}
</p>
{{-- Images cant be loaded on local --}}
{{-- @if ($post->image)
<img src="{{ asset('public/image/'.$post->image->url) }}" style="height: 100px; width: 150px;">
@endif --}}
</div>
@endcomponent
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
