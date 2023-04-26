<x-app-layout>
    <div class="text-gray-600">
        <h1>{{ $user->name }}</h1>
        @auth
            {{--{{ dd($user->isFollowing($user->id)); }}--}}
            @if($login_user->isFollowing($user->id))
                <form action="{{ route('unfollow',['user'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">follow解除</button>
                </form>
            @else
                <form action="{{ route('follow',['user'=>$user->id]) }}" method="POST">
                    @csrf
                    <button type="submit">follow</button>
                </form>
            @endif
            <!--ユーザーがリンクアクセス-->
            <p>フォローしてる人数：{{ $user->followees->count() }}</p>
            <p>フォローされている人数：{{ $user->followers->count() }}</p>
        @endauth
        @foreach($user->articles as $article)
            <article class="text-black"style="background-color: rgb(236, 236, 236)">
                <a class="p-5 block"href="{{ route('show.article',$article->id) }}">
                    <a href="{{ route('show.profile',['user'=>$article->user->id]) }}"><p>{{ $article->user->name }}</p></a>
                    <h2>{{ $article->title }}<h2>
                    <img src="{{ $article->image }}">
                    <ul>
                        @foreach($article->categories as $category)
                        <li>{{ $category->category }}</li>
                        @endforeach
                    </ul>
                    <p>comment:{{ $article->comments->count() }}</p>
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
                </a>
            </article>
            @endforeach
    </div>
</x-app-layout>
@extends('common/footer')