<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>gaco|gathering code</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
</head>
<body>
    <header>
        <h1>Gaco🐸|gathering code</h1>
        <nav>
            <ul>
                <li><a href="#">ログイン</a></li>
                <li><a href="#">このサイトについて</a></li>
                <li><a href="#">プロフィール</a></li>
                <li><a href="#">ギャラリー</a></li>
            </ul>    
        </nav>
    </header> 
    @yield('content')
    <footer>
        <a href="#">Gaco</a>
        <ul>
            <li><a href="#">利用規約</a></li>
            <li><a href="#">プライバシーポリシー</a></li>
        </ul>
    </footer>   
</body>
</html>