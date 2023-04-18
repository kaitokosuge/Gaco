@extends('common/common');
@section('content');
<article>
    <h1>{{ $article->title }}</h1>
    <img src="{{ $article->image }}">
    <a href="{{ $article->link }}">{{ $article->link }}</a>
    <div>
        <pre>
            {{ $article->html }}
        </pre>
        <pre>
            {{ $article->css }}
        </pre>
        <pre>
            {{ $article->js }}
        </pre>
    </div>
    <p>{{ $article->explanation }}</p>
</article>
@endsection