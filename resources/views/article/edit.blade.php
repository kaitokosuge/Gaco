<x-app-layout>
    <section class="text-black bg-white w-11/12 sm:w-9/12 m-auto mt-10 rounded-lg sm:p-20 p-5">
        <p class="text-xl font-bold">編集</p>
<form class="mt-10"action="{{ route('update.article',['article' => $article->id]) }}"method="POST">
    @method('PUT')
    @csrf
    <div>
        <div>
            <p class="text-sm mt-5">プロジェクト名</p>
            <input class="mt-2 w-full rounded-md bg-gray-200"type="text" name="article[title]"value="{{ $article->title }}">
            @error('name')
            <p style="color:red">プロジェクト名は30字以内でお願いします</p>
            @enderror
        </div>
        <div>
            <p class="text-sm mt-5">参考リンク</p>
            <input class="mt-2 w-full rounded-md bg-gray-200"type="text" name="article[link]" value="{{ $article->link }}">
        </div>
        <div>
            <p class="text-sm mt-5">カテゴリー</p>
            @foreach($categories as $category)
                <input type="checkbox"name="categories_array[]"value="{{ $category->id }}"@if($category->id==$article->category) selected @endif>
                <span class="mr-3">{{ $category->category }}</span>
            @endforeach
        </div>
        <div>
            <p class="text-sm mt-5">コード</p>
            <p class="mt-5">HTML</p>
            <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[html]">{{ $article->html }}</textarea>
            <p class="mt-5">CSS</p>
            <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[css]">{{ $article->css }}</textarea>
            <p class="mt-5">JavaScript</p>
            <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[js]">{{ $article->js }}</textarea>     
        </div>
        <div>
            <p class="text-sm mt-5">説明</p>
            <input class="mt-2 w-full rounded-md bg-gray-200"type="text" name="article[explanation]" value="{{ $article->explanation }}">
        </div>
        <div>
            <button class="mt-10 bg-black rounded-md text-white p-2 block m-auto"type="submit">投稿</button>
        </div>
    </div>
</form>
    </section>
@extends('common/footer')
</x-app-layout>