@extends('layouts.page')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8" id="content">

            <h2>{{ $article->title }}</h2>
            <span>{{ __('default.created_at') }} {{ $article->created_at->diffForHumans() }}</span>
            <div>
               {{ __('default.created_by') }}  <a href="{{ route('profile-user', ['id' => $article->user->id]) }}">{{ $article->user->name }}</a>
            </div>
            <div>
                @foreach ($article->article_categories as $ac)
                    {{ $ac->category->name }}
                @endforeach
            </div>
            <p>
                {!! $article->content !!}
            </p>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8" id="content">
            <div id="disqus_thread" ></div>
        </div>
    </div>
</div>

<script>
let content = document.getElementById('content');
content.querySelectorAll('img').forEach((v) => {
    let contentReal = document.getElementsByClassName('simage')[0];
    v.src = v.src.replace('article/', '');
    v.style.width = contentReal.clientWidth + 'px';
    v.style.height = '250px';
})

</script>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://tataransunda.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<script id="dsq-count-scr" src="//tataransunda.disqus.com/count.js" async></script>
@endsection
