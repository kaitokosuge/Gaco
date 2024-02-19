<x-app-layout>
    <section class="text-black bg-white w-11/12 sm:w-9/12 m-auto mt-10 rounded-lg sm:p-20 p-5">
    <p class="text-xl font-bold">新規作成</p>
    <form class="mt-10"action="{{ route('store.article') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <div>
                <p class="text-sm mt-5">プロジェクト名：必須</p>
                <input class="mt-2 w-full rounded-md bg-gray-200"type="text" name="article[title]">
                @error('name')
                <p style="color:red">プロジェクト名は30字以内でお願いします</p>
                @enderror
            </div>
            <div>
                <p class="text-sm mt-5">アイキャッチ画像</p>
                <input multiple="multiple" class="mt-2 w-full rounded-md bg-gray-200" type="file" onchange="loadImage(this);" name="image">
                <p id="preview"></p>
                @error('image')
                <p style="color:red">アップロードに失敗しました。もう一度アップするか別の画像をアップしてください</p>
                @enderror
            </div>
            <div>
                <p class="text-sm mt-5">参考リンク</p>
                <input class="mt-2 w-full rounded-md bg-gray-200"type="text" name="article[link]">
            </div>
            <div>
                <p class="text-sm mt-5 mb-5">カテゴリー</p>
                @foreach($categories as $category)
                    <input type="checkbox"name="categories_array[]"value="{{ $category->id }}">
                    <span class="mr-3">{{ $category->category }}</span>
                @endforeach
            </div>
            <div>
                <p class="text-sm mt-5">コード</p>
                <p class="mt-5">HTML</p>
                <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[html]"></textarea>
                <p class="mt-5">CSS</p>
                <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[css]"></textarea>
                <p class="mt-5">JavaScript</p>
                <textarea class="block w-full text-white rounded-md bg-gray-800"name="article[js]"></textarea>     
            </div>
            <div>
                <p class="text-sm mt-5">説明</p>
                <input class="mt-2 h-20 w-full rounded-md bg-gray-200"type="text" name="article[explanation]">
            </div>
            <div>
                <button class="mt-10 bg-black rounded-md text-white p-2 block m-auto"type="submit">投稿する</button>
            </div>
        </div>
    </form>
    </section>
    @extends('common/footer')
    <script>
        function loadImage(obj)
        {
            document.getElementById('preview').innerHTML = '<p>プレビュー</p>';
            for (i = 0; i < obj.files.length; i++) {
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    document.getElementById('preview').innerHTML += '<img src="' + e.target.result + '">';
                });
                fileReader.readAsDataURL(obj.files[i]);
            }
        }
    </script>
</x-app-layout>