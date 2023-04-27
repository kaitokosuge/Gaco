{{-- @extends('common/common')
@section('content')
<main> --}}
<x-app-layout>
<body class=>
    <div class="">
        
        <section class="text-white text-sm w-10/12 m-auto">
            {{--@auth
            <div>
                <p class="mt-10 font-bold text-green-600">your field</p>
                <a class="block text-xs text-center mr-5 mt-5 p-2 rounded-md bg-gray-400"href="{{route('create.article')}}">新規作成</a>
                <a class="block text-xs text-center mr-5 mt-5 p-2 rounded-md bg-gray-400"href="{{route('create.article')}}">プロフィール</a>
            </div>
            @endauth--}}
            <form action="/" method="GET">
                @csrf
                <div class="input-group">
                    <input type="search" placeholder="質問を検索" name="search" class="search-form form-control" value="@if (isset($search)) {{ $search }} @endif">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>検索</button>
                </div>
            </form>
            <div>
                <p class="mt-10 font-bold text-green-600">category</p>
                <form action="{{ route("index.article") }}" method="GET">
                <ul class="flex overflow-x-scroll mt-2">
                    @foreach($categories as $category)
                    <li class="whitespace-nowrap w-full text-black text-xs text-center mr-2 p-2 rounded-md bg-gray-200"><button name="category_id"value={{ $category->id }}>{{ $category->category }}</button></li>
                    @endforeach
                </ul>
                </form>
            </div>
        </section>
        <section class="w-10/12 m-auto">
            <p class="mt-10 font-bold text-green-600">gallery</p>
            <div class="sm:grid sm:grid-cols-3 gap-6 mt-5 flex-wrap block">
            @foreach($articles as $article)
            <article class="bg-gray-100 rounded-xl p-5 mt-5">
                <a class="block"href="{{ route('show.article',$article->id) }}">
                    <h2 class="overflow-x-scroll w-full text-lg font-bold"><span class="whitespace-nowrap">{{ $article->title }}</span><h2>
                    <div class="mt-2 h-40 sm:h-52 hover:opacity-50 transition-all"><img class="rounded-md block h-full w-full object-cover" src="{{ $article->image }}"></div>
                </a>
                <ul class='flex overflow-x-scroll mt-2'>
                    @foreach($article->categories as $category)
                    <li class="whitespace-nowrap bg-gray-300 p-1 rounded-sm text-xs mr-2">{{ $category->category }}</li>
                    @endforeach
                </ul>
                <p class="text-sm mt-2">day:<span class="text-black font-bold"> {{$article->updated_at}}</span></p>
                <p class="text-sm mt-1">likes:<span class=" text-black font-bold"> {{ $article->likes->count() }}</span></p>
                <p class="text-sm mt-1">comment:<span class="text-black font-bold"> {{ $article->comments->count() }}</span></p>
                <a href="{{ route('show.profile',['user'=>$article->user->id]) }}"><p class="text-md font-bold mt-1"><span class="text-xs"></span>{{ $article->user->name }}</p></a>
                {{--<div>
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
                </div>--}}
            </article>
            @endforeach
            </div>
        </section>
        {!! $articles->links('pagination::bootstrap-5')!!}
    </div>
    @extends('common/footer')
</body>
</x-app-layout>

