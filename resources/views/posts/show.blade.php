<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>レシピ投稿アプリ（仮名）</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/show.css') }}">

    </head>
    
    <x-app-layout>
    <x-slot name="header">
        　<p>レシピ一覧</p>
    </x-slot>
    
    <body class="antialiased">
            
        <div class='content'>
            
            <!--タイトル、写真、カテゴリー-->
            <div class="title">
                <h1>『{{ $post->title }}』</h1>
            </div>
            
            <div class="image">
                <img src="{{ asset( $post->image) }}" alt="Post Image">
            </div>
            
            <div class='category'>
                <h2>カテゴリー：{{ $post->category->name }}</h2>
            </div>
            
            <!--レシピ投稿内容-->
            <!--材料関連-->
            <div class='content_post'>
                <div class="ingredient">
                    <h3>＜材料名＞</h3>
                        @foreach($ingredients as $ingredient) 
                            @if($ingredient->post_id === $post->id)
                                <li class="content">
                                    @if($ingredient->name)
                                        {{ $ingredient->name }}
                                    @endif
                                    @if($ingredient->unit_amount)
                                        {{ $ingredient->unit_amount }}
                                    @endif
                                    @if($ingredient->unit_price)
                                        {{ $ingredient->unit_price }}円
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        
                    <div class="sum_price">        
                    <h3>＜合計金額＞</h3>
                        <?php 
                            $total_price = 0;
                            foreach($ingredients as $ingredient)
                                if($ingredient->post_id === $post->id && $ingredient->unit_price)
                                    $total_price += $ingredient->unit_price;
                        ?>
                        {{ $total_price }}円
                    </div>
                </div>
                
                
            </div>
            
            <!--作り方-->        
            <div class='cook'>
                <h2>＜作り方＞</h2>
                <p　class='body'>『{{ $post->make}}』</p>
            </div>
            
            <div class="reference">   
                <h2>＜URL＞</h2>        
                <h3>{{ $post->reference }}</h3>
            </div>
            
        
            <div class='edit'>
                <a class="button" href="/posts/{{ $post->id }}/edit">変更する️</a>
            </div>
            
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <div class='delete'>
                    <button class="button button_delete" type="button" onclick="deletePost({{ $post->id }})">削除する</button>
                </div>
            </form>
            <div class='footer'>
                <a href="/">◀戻る️</a>
            </div>
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