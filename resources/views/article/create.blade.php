@extends('common/common')
@section('content')
<main>
    <form action="{{ route('store.article') }}"method="POST">
        @csrf
        <div>
            <div>
                <p>プロジェクト名</p>
                <input type="text" name="article[title]">
                @error('name')
                <p style="color:red">プロジェクト名は30字以内でお願いします</p>
                @enderror
            </div>
            <div>
                <p>アイキャッチ画像</p>
                <input type="file" name="article[image]">
                @error('image')
                <p style="color:red">アップロードに失敗しました。もう一度アップするか別の画像をアップしてください</p>
                @enderror
            </div>
            <div>
                <p>参考リンク</p>
                <input type="text" name="article[link]">
            </div>
            <div>
                <p>コード</p>
                <textarea name="article[html]"></textarea>
                <textarea name="article[css]"></textarea>
                <textarea name="article[js]"></textarea>     
            </div>
            <div>
                <p>説明</p>
                <input type="text" name="article[explanation]">
            </div>
            <div>
                <button type="submit">投稿</button>
            </div>
        </div>
    </form>
</main>
@endsection