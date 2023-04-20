{{-- @extends('common/common')
@section('content')
<main> --}}
<x-app-layout>
<body>
    
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
                <a href="{{ route('show.article',$article->id) }}">
                    <p>{{ $article->user->name }}</p>
                    <h2>{{ $article->title }}<h2>
                    <img src="{{ $article->image }}">
                    
                    <ul>
                        @foreach($article->categories as $category)
                        <li>{{ $category->category }}</li>
                        @endforeach
                    </ul>
                
                </a>
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
        </section>
    </div>
</body>
</x-app-layout>
{{-- </main>
@endsection --}}