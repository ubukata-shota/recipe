<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レシピ投稿アプリ（仮名）</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    </head>
    
    <x-app-layout>
    <x-slot name="header">
        <div class="header">
        　<p>レシピ一覧</p>
        </div>
    </x-slot>
    
    <body class="antialiased">
        
        <div class="pattern">
            
        <br>
        <div class="some_input">
            <form class="search_title" action="{{ route('search') }}" method="GET">
                <input type="text" name="post[title]" placeholder="レシピを検索">
                <button class="search_button" type="submit">検索</button>
            </form>
        </div>
        
        
        <!--レシピ投稿一覧-->
        
        <div class='container'>
            @foreach($posts as $post)
                <!--タイトル表示-->
                <div class="title">
                    <a href="/posts/{{ $post->id }}">
                        <h1 class='title post_title'>『{{ $post->title }}』</h1>
                    </a>
                    @if($post->user)
                        <p class="user">作成者：{{ $post->user->name }}</p>
                    @endif
                </div>
                <!--写真表示-->
                <div class="image">
                    <a href="/posts/{{ $post->id }}">
                        @if($post->image == null)
                            <img src="{{ "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" }}" alt="Post Image">
                        @else
                            <img src="{{ $post->image }}" alt="Post Image">
                        @endif
                    </a>
                </div>
                <div class="index_line"></div>
            @endforeach
        </div>
        <!--<div class="footer">-->
            
        <!--</div>-->
        <div class='pagination'>{{ $posts->links() }}</div>
    </body>
    </x-app-layout>
</html>