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
            <ul>
                @foreach($user->followees as $followee)
                <li>{{ $followee->name }}</li>
                @endforeach
            </ul>
            <p>フォローされている人数：{{ $user->followers->count() }}</p>
            <ul>
                @foreach($user->followers as $follower)
                <li>{{ $follower->name }}</li>
                @endforeach
            </ul>
        @endauth
        <div class="sm:grid sm:grid-cols-3 gap-6 mt-5 flex-wrap block">
        @foreach($user->articles as $article)
            <article class="bg-gray-100 rounded-xl p-5 mt-5">
                <a class="block"href="{{ route('show.article',$article->id) }}">
                    <a href="{{ route('show.profile',['user'=>$article->user->id]) }}"><p>{{ $article->user->name }}</p></a>
                        <h2 class="overflow-x-scroll w-full text-lg font-bold">{{ $article->title }}<h2>
                        <div class="mt-2 h-40 sm:h-52 hover:opacity-50 transition-all"><img class="rounded-md block h-full w-full object-cover" src="{{ $article->image }}"></div>
                    </a>
                    <ul class='flex overflow-x-scroll mt-3'>
                        @foreach($article->categories as $category)
                        <li class="whitespace-nowrap bg-gray-300 p-1 rounded-sm text-xs mr-2">{{ $category->category }}</li>
                        @endforeach
                    </ul>
                    <p class="text-sm mt-2">day:<span class="text-black font-bold"> {{$article->updated_at}}</span></p>
                    <p class="text-sm mt-1">likes:<span class=" text-black font-bold"> {{ $article->likes->count() }}</span></p>
                    <p class="text-sm mt-1">comment:<span class="text-black font-bold"> {{ $article->comments->count() }}</span></p>
                    <a href="{{ route('show.profile',['user'=>$article->user->id]) }}"><p class="text-md font-bold mt-1"><span class="text-xs"></span>{{ $article->user->name }}</p></a>
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
            @endforeach
        </div>    
    </div>
</x-app-layout>
@extends('common/footer')