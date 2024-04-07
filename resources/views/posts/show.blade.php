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
        <h2 class='category'>カテゴリー：{{ $post->category->name }}</h2>
        
        <!--レシピ投稿内容-->
        <div class='content'>
            <br>
                    
            <!--写真投稿-->
            
                    
            <!--材料一覧-->
            <div class='content_post'>
                        
                <!--材料表示機能　途中-->
                <h3>＜材料名＞</h3>
                    @foreach($ingredients as $ingredient) 
                        @if($ingredient->post_id === $post->id)
                            <h2>{{ $ingredient->name }}</h2>
                        @endif
                    @endforeach
                <!--以上-->
                        
                <!--<h3>{{ $post->amount}}</h3>-->
                        
                <h3>＜価格＞</h3>
                
                        
                <h3>＜合計金額＞</h3>
                
                <h2>＜URL＞</h2>        
                <h3>{{ $post->reference }}</h3>
            </div>
            <br>
            
            <!--作り方-->        
            <div class='cook'>
                <h2>＜作り方＞</h2>
                <p　class='body'>『{{ $post->make}}』</p></p>
                <br>
                <br>
            </div>
        </div>
        <div class='edit'>
            <a href="/posts/{{ $post->id }}/edit">変更する️</a>
        </div>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class='delete'>
                <button type="button" onclick="deletePost({{ $post->id }})">削除する</button>
            </div>
        </form>
        <div class='footer'>
            <a href="/">◀戻る️</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict';
        
                if (confirm('削除すると復元できません。\n本当に削除しますか。')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
    </x-app-layout>
</html>