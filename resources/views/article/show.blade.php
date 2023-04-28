<x-app-layout>
{{--<p><a href="/">戻る</a></p>--}}
<article class="text-black bg-white w-11/12 sm:w-9/12 m-auto mt-10 rounded-lg sm:p-20 p-5">
    <h1 class="font-bold sm:text-4xl text-3xl">{{ $article->title }}</h1>
    <img class="mt-5 sm:mt-10 rounded-lg"src="{{ $article->image }}">
    <a class="text-blue-300"href="{{ $article->link }}">{{ $article->link }}</a>
    <ul>
        @foreach($article->categories as $category)
        <li>{{ $category->category }}</li>
        @endforeach
    </ul>
    <div>
        <p class="mt-10 font-bold">HTML</p>
        <pre>
            {{ $article->html }}
        </pre>
        <p class="mt-5 font-bold">CSS</p>
        <pre>
            {{ $article->css }}
        </pre>
        <p class="mt-5 font-bold">JavaScript</p>
        <pre>
            {{ $article->js }}
        </pre>
    </div>
    <p class="font-bold">説明</p>
    <p>{{ $article->explanation }}</p>
    <div class="mt-10">
        @auth
            @if($article->is_liked_by_auth_user())
                <i class="text-4xl like-toggle fas fa-heart liked" data-id="{{ $article->id }}"></i>
                <p class="like-counter">{{ $article->likes->count() }}</p>
            @else
                <i class="text-4xl like-toggle fas fa-heart" data-id="{{ $article->id }}"></i>
                <span class="text-4xl like-counter">{{ $article->likes->count() }}</span>
            @endif
        @endauth
        @guest
            @if($article->is_liked_by_auth_user())
                <a class="w-11 block"href="/login"><i class="w-full block like-toggle fas fa-heart liked" data-id="{{ $article->id }}"></i></a>
                <span class="like-counter">{{ $article->likes->count() }}</span>
            @else
                <a class="w-11"href="/login"><i class="w-full like-toggle fas fa-heart" data-id="{{ $article->id }}"></i></a>
                <span class="like-counter">{{ $article->likes->count() }}</span>
            @endif
        @endguest
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
        <div class="flex mt-10">
        <textarea placeholder="コメント"class="block rounded-md bg-gray-200 w-10/12"name="comment"></textarea>
        <button class="block p-5 font-bold ml-3 rounded-md bg-gray-200"type="submit">送信</button>
        </div>
    </form>
    <div class="flex mt-10">
        <div>
            @if(auth()->check() && $article->user_id == auth()->user()->id)
            <a class="block rounded-md bg-gray-300 p-5"href="{{ route('edit.article',['article' => $article->id]) }}">
                編集する
            </a>
            @endif
        </div>
        <div>
            @if(auth()->check() && $article->user_id == auth()->user()->id)
            <form action="{{ route('destroy.article',['article' => $article->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="ml-5 block bg-red-300 rounded-md p-5"onclick="return confirm('削除しますか？')">削除する</button>
            </form>
            @endif
        </div>
    </div>
</article>
@extends('common/footer')
<script>
    $(function(){
        let like = $('.like-toggle');
        let likeArticleId;
        like.on('click',function(){
            let $this = $(this);
            likeArticleId = $this.data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url:'/like',
                method: 'POST',
                data: {
                    'article_id':likeArticleId
                }
        })
            
            .done(function (data) {
                $this.toggleClass('liked');
                $this.next('.like-counter').html(data.likes_count);
            })
            .fail(function(){
                console.log('failaaaaaaa');
            });
        });
    });
</script>
</x-app-layout>