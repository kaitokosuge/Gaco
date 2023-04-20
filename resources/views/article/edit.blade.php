@extends('common/common')
@section('content')
<form action="{{ route('update.article',['article' => $article->id]) }}"method="POST">
    @method('PUT')
    @csrf
    <div>
        <div>
            <p>プロジェクト名</p>
            <input type="text" name="article[title]"value="{{ $article->title }}">
            @error('name')
            <p style="color:red">プロジェクト名は30字以内でお願いします</p>
            @enderror
        </div>
        <div>
            <p>アイキャッチ画像</p>
            画像は編集不可
        </div>
        <div>
            <p>参考リンク</p>
            <input type="text" name="article[link]" value="{{ $article->link }}">
        </div>
        <div>
            <p>コード</p>
            <textarea name="article[html]">{{ $article->html }}</textarea>
            <textarea name="article[css]">{{ $article->css }}</textarea>
            <textarea name="article[js]">{{ $article->js }}</textarea>     
        </div>
        <div>
            <p>説明</p>
            <input type="text" name="article[explanation]" value="{{ $article->explanation }}">
        </div>
        <div>
            <button type="submit">投稿</button>
        </div>
    </div>
</form>
@endsection