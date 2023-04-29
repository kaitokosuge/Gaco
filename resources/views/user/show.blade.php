<x-app-layout>
    <div class="text-gray-600">
        <section class="bg-white sm:p-10 p-5 rounded-md  text-black w-11/12 sm:w-10/12 m-auto mt-10">
        <h1 class="text-4xl font-bold">{{ $user->name }}</h1>
        @auth
        <div class="flex mt-5">
            <div>
            <p>フォロー中：{{ $user->followees->count() }}</p>
            <ul class="rounded-md bg-gray-200 p-2 h-12 overflow-scroll">
                @foreach($user->followees as $followee)
                <li>{{ $followee->name }}</li>
                @endforeach
            </ul>
            </div>
            <div class="ml-5">
            <p>フォロワー：{{ $user->followers->count() }}</p>
            <ul class="rounded-md bg-gray-200 p-2 h-12 overflow-scroll">
                @foreach($user->followers as $follower)
                <li>{{ $follower->name }}</li>
                @endforeach
            </ul>
            </div>
        </div>
            {{--{{ dd($user->isFollowing($user->id)); }}--}}
            @if($login_user->isFollowing($user->id))
                <form action="{{ route('unfollow',['user'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="mt-5 bg-black text-white p-2 rounded-md"type="submit">フォロー中</button>
                </form>
            @else
                <form action="{{ route('follow',['user'=>$user->id]) }}" method="POST">
                    @csrf
                    <button type="submit">フォローする</button>
                </form>
            @endif
            <!--ユーザーがリンクアクセス-->
        @endauth
        </section>
        <section class="w-11/12 sm:w-10/12 m-auto mt-10">
        <p class="mt-5 text-green-500">あなたの投稿</p>
        <div class="sm:grid sm:grid-cols-3 gap-6 mt-5 flex-wrap block">
        @foreach($user->articles as $article)
            <article class="bg-gray-100 rounded-xl p-5 mt-5">
                    <a href="{{ route('show.profile',['user'=>$article->user->id]) }}"><p>{{ $article->user->name }}</p></a>
                    <a class="block"href="{{ route('show.article',$article->id) }}"><h2 class="overflow-x-scroll w-full text-lg font-bold">{{ $article->title }}<h2></a>
                        <div class="mt-2 h-40 sm:h-52 hover:opacity-50 transition-all">
                            <a class="block"href="{{ route('show.article',$article->id) }}"><img class="rounded-md block h-full w-full object-cover" src="{{ $article->image }}"></a>
                        </div>
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
        </section>  
    </div>
</x-app-layout>
@extends('common/footer')