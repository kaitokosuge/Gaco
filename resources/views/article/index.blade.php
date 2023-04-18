@extends('common/common')
@section('content')
<main>
    <div class="flex">
        <section class="text-gray-400">
            <a href="{{ route('create.article') }}">作成</a>
            <div>
                <p>カテゴリで絞る</p>
                <ul>
                    <li><a href="#!">css設計</a></li>
                    <li><a href="#!">animation</a></li>
                    <li><a href="#!">template</a></li>
                    <li><a href="#!">JavaScript</a></li>
                </ul>
            </div>
        </section>
        <section>
            @foreach($articles as $article)
            <article style="background-color: rgb(236, 236, 236)">
                <a href="{{ route('show.article',['article_id' => $article->id]) }}">
                    <span>editer</span>
                    <p>{{ $article->user->name }}</p>
                    <h2>{{ $article->title }}<h2>
                    <img src="{{ $article->image }}">
                </a>
            </article>
            @endforeach
        </section>
    </div>
</main>
@endsection