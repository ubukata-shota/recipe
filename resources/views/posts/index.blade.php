<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レシピ投稿アプリ（仮名）</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    
    <x-app-layout>
    <x-slot name="header">
        　<p>レシピ一覧</p>
    </x-slot>
    
    <body class="antialiased">
        
        <h1>レシピ一覧</h1>
        <br>
        <a href="/posts/create">レシピを投稿▶️</a>
        
        <!--レシピ投稿一覧-->
        <div class='container'>
            @foreach($posts as $post)
                <!--タイトル表示-->
                <div class="title">
                    <a href="/posts/{{ $post->id }}">
                        <h2 class='title'>『{{ $post->title }}』</h2>
                    </a>
                </div>
                <!--写真表示-->
                <div class="image">
                    <a href="/posts/{{ $post->id }}">
                        <img src="{{ asset($post->image) }}" >
                    </a>
                </div>
                <!--材料一覧-->
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links() }}</div>
    </body>
    </x-app-layout>
</html>