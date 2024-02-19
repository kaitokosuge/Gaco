document.addEventListener('DOMContentLoaded', function() {
    //いいねボタン要素取得（ここを押したらfetchへ行く）
    const like = document.querySelector('.like-toggle');
    //いいねを押したPostのidを格納する変数が必要なので宣言
    let likePostId;
    like.addEventListener('click', function(e) {
        let target = e.target;
        console.log(target);
        //いいねボタン要素に格納したデータ属性の記事idを取得
        likePostId = target.getAttribute('data-id');
        //fetchを使うことでURLにデータをアップロードすることができる。下記では
        fetch('/like', {
            //リクエスト形式
            method: 'POST',
            headers: {
                //Content-Typeでクライアントがサーバーに送ったデータの種類を伝える。今回はapplication/jsonでJSONファイルを指定 https://developer.mozilla.org/ja/docs/Web/HTTP/Headers/Content-Type
                'Content-Type': 'application/json',
                //正規のcsrfトークンであることを記載？？　https://takabus.com/tips/1115/#:~:text=%E3%81%BE%E3%81%A8%E3%82%81-,CSRF%E3%83%88%E3%83%BC%E3%82%AF%E3%83%B3%E3%80%81%E6%84%8F%E5%91%B3%E3%81%AA%E3%81%84%E3%82%93%E3%81%98%E3%82%83%E3%81%AA%E3%81%84%EF%BC%9F,%E3%81%AE%E5%80%A4%E3%81%AE%E3%81%93%E3%81%A8%E3%81%A7%E3%81%99%E3%80%82
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ post_id: likePostId })
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('失敗');
            }
        })
        .then(function(data) {
            target.classList.toggle('liked');
            target.nextElementSibling.innerHTML = data.likes_count;
        })
        .catch(function() {
            console.log('failaaaaaaa');
        });
    });
});
$(function(){
        let like = $('.like-toggle');
        let likePostId;
        like.on('click',function(){
            let $this = $(this);
            likePostId = $this.data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url:'/like',
                method: 'POST',
                data: {
                    'post_id':likePostId
                }
        })
            
            .done(function (data) {
                $this.toggleClass('liked');
                $this.next('.like-counter').html(data.likes_count);
            })
            .fail(function(){
                console.log('fail');
            });
        });
    });

    $(function(){
        let like = $('.like-toggle');
        let likePostId;
        like.on('click',function(){
            let $this = $(this);
            likePostId = $this.data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url:'/like',
                method: 'POST',
                data: {
                    'post_id':likePostId
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