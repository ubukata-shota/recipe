<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>レシピ投稿アプリ（仮名）</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
    <x-app-layout>
    <x-slot name="header">
        　<p>レシピ一覧</p>
    </x-slot>
    
    <body class="antialiased">
        
        <h1 class='title'>『{{ $post->title }}』</h1>
        <br>
        <h2 class='category'>{{ $post->category->name }}</h2>
        
        <!--レシピ投稿内容-->
        <div class='content'>
            <br>
                    
            <!--写真投稿-->
                    
            <!--材料一覧-->
            <div class='content_post'>
                        
                <h3>材料名</h3>
                        
                <h3>{{ $post->amount}}</h3>
                        
                <h3>価格</h3>
                        
                <h3>合計金額</h3>
                        
                <h3>{{ $post->reference }}</h3>
            </div>
            <br>
                    
            <div class='cook'>
                <p　class='body'>{{ $post->make}}</p></p>
            </div>
        </div>
        <div class='footer'>
            <a href="/">◀戻る️</a>
        </div>
    </body>
    </x-app-layout>
</html>