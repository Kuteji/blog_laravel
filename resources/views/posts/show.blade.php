@extends('layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('content')
<article class="post image-w-text container">
        @if ($post->photos->count() === 1)
            <figure><img src="{{ url($post->photos->first()->url) }}" alt="" class="img-responsive"></figure>
        @elseif($post->photos->count() > 1)
            @include('posts.carousel')
        @elseif($post->iframe)
            <div class="video">
                {!! $post->iframe !!}
            </div>  
        @endif
    <div class="content-post">
        <header class="container-flex space-between">
            <div class="date">
                <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
            </div>
            <div class="post-category">
                <span class="category">{{ $post->category->name }}</span>
            </div>
        </header>
        <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links', ['description' => $post->title])
            <div class="tags container-flex">
                @foreach ($post->tags as $tag )
                    <span class="tag c-gris text-capitalize">#{{ $tag->name }}</span>
                @endforeach
            </div>
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <!--Aqui se renderiza la caja de comentarios-->
            <div id="disqus_thread">
                @include('partials.disqus-script')
            </div>

        </div><!-- .comments -->
    </div>
</article>
@stop

@push('styles')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@endpush

@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
{{-- <script src="/js/twitter-bootstrap.js"></script> --}}
<script>
    $('.carousel').carousel()
</script>
@endpush