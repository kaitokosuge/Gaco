<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

        <style>
            .liked{
                color:red;
            }
            .text-muted{
                display:none;
            }
        </style>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js',])
    </head>
    <body class="font-sans antialiased overflow-x-hidden">
        <div class="min-h-screen bg-gray-300 pb-20 ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{-- <x-app-layout>の中は＄slotの部分に入る --}}
                {{ $slot }}
            </main>
        </div>
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
    </body>
</html>
