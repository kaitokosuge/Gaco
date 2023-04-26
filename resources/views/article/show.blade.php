<x-app-layout>
<p><a href="/">戻る</a></p>
<article class="text-gray-300">
    <h1>{{ $article->title }}</h1>
    <img src="{{ $article->image }}">
    <a class="text-blue-300"href="{{ $article->link }}">{{ $article->link }}</a>
    <ul>
        @foreach($article->categories as $category)
        <li>{{ $category->category }}</li>
        @endforeach
    </ul>
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
    <div>
        <div>
            @if(auth()->check() && $article->user_id == auth()->user()->id)
            <a href="{{ route('edit.article',['article' => $article->id]) }}">
                編集
            </a>
            @endif
        </div>
        <div>
            @if(auth()->check() && $article->user_id == auth()->user()->id)
            <form action="{{ route('destroy.article',['article' => $article->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('削除しますか？')">削除</button>
            </form>
            @endif
        </div>
    </div>
</article>
<div>
    <div>
        @if($article->is_liked_by_auth_user())
                <form action="{{ route('unlike', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    <button type="submit">いいね{{ $article->likes->count() }}</button>
                </form>
            @else
                <form action="{{ route('like', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    <button type="submit">いいね{{ $article->likes->count() }}</button>
                </form>
            @endif
    </div>
    <ul>
        @foreach($article->comments as $comment)
        <li class="text-gray-300">
            <span class="text-green-400">{{ $comment->user->name }}</span>
            {{ $comment->comment }}
        </li>
        @endforeach
    </ul>
    <form action="{{ route('comment.article',['id' => $article->id]) }}" method="POST">
        @csrf
        <textarea name="comment"></textarea>
        <button type="submit">送信</button>
    </form>
</div>
</x-app-layout>
@extends('common/footer')