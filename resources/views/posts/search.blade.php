<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>検索結果</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    
    <x-app-layout>
    <x-slot name="header">
        <div class="header">
        　<p>検索結果</p>
        </div>
    </x-slot>
    
    <body class="antialiased">
        <div class="pattern">
        <br>    
        <div class="some_input">
            <form class="search_container" action="{{ route('search') }}" method="GET">
                <input type="text" name="post[title]" placeholder="タイトルで検索">
                <button class="search_button" type="submit">検索</button>
            </form>
           
        </div>
        
        
        <!--レシピ投稿一覧-->
        @if($posts->count() > 0)
            
            <ul>
                @foreach($posts as $post)
                <!--タイトル表示-->
                <div class="title">
                    <a href="/posts/{{ $post->id }}">
                        <h1 class='title'>『{{ $post->title }}』</h2>
                    </a>
                    <p class="user">作成者：{{ $post->user->name }}</p>
                </div>
                
                
                <!--写真表示-->
                <div class="image">
                    <a href="/posts/{{ $post->id }}">
                        @if($post->image == null)
                            <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                        @else
                            <img src="{{ asset( $post->image) }}" alt="Post Image">
                        @endif
                    </a>
                </div>
                @endforeach
            </ul>
        @else
            <p class="result">検索結果はありません。</p>
            <img class="no_result" src="{{ "/WStqSD6FwTUe2xCssDUoiXUmdjA94mHUMGDP3LdR.png" }}" alt="Post Image">
        @endif

<!-- ページネーションリンク -->
        <!--<div class="footer">-->
            
        <!--</div>-->
        <div class='paginate'>{{ $posts->links() }}</div>
        </div>
    </body>
    </x-app-layout>
</html>