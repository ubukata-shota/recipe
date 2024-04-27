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
        <div class="header">
        　<p>～レシピ一覧～</p>
        </div>
    </x-slot>
    
    <body class="antialiased">
        
        <div class="pattern">
            
        <br>
        <div class="some_input">
            <form class="search_title" action="{{ route('search') }}" method="GET">
                <input type="text" name="post[title]" placeholder="タイトルで検索">
                <button class="search_button" type="submit">検索</button>
            </form>
        </div>
        
        
        <!--レシピ投稿一覧-->
        <div class='container'>
            @foreach($posts as $post)
                <!--タイトル表示-->
                <div class="title">
                    <a href="/posts/{{ $post->id }}">
                        <h1 class='title'>『{{ $post->title }}』</h2>
                    </a>
                    @if($post->user)
                        <p class="user">作った人：{{ $post->user->name }}</p>
                    @endif
                </div>
                <!--写真表示-->
                <div class="image">
                    <a href="/posts/{{ $post->id }}">
                        @if($post->image == null)
                            <img src="{{ asset( "storage//jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                        @else
                            <img src="{{ asset( $post->image) }}" alt="Post Image">
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
        <!--<div class="footer">-->
            
        <!--</div>-->
        <div class='paginate'>{{ $posts->links() }}</div>
        </div>
    </body>
    </x-app-layout>
</html>