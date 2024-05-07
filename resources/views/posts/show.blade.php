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
        　<p>～レシピ詳細～</p>
    </x-slot>
    
    <body class="antialiased">
        <div class="pattern">    
        <div class='content'>
            
            <!--タイトル、写真、カテゴリー-->
            <div class="title">
                <h1>『{{ $post->title }}』</h1>
                <h3 class="category">カテゴリー：{{ $post->category->name }}</h2>
            </div>
            
            <div class="user">
                @if($post->user)
                    <p class="user">作った人：{{ $post->user->name }}</p>
                @endif
            </div>
            
            <div class="image">
                @if($post->image == null)
                    <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                @else
                    <img src="{{ asset( $post->image) }}" alt="Post Image">
                @endif
            </div>
            
            <!--レシピ投稿内容-->
            <!--材料関連-->
            <div class='content_post box25'>
                <div class="ingredient">
                    <h3 class="ribbon1">材料</h3>
                        @foreach($ingredients as $ingredient) 
                            @if($ingredient->post_id === $post->id)
                                <li class="content">
                                    @if($ingredient->name)
                                        {{ $ingredient->name }}
                                    @endif
                                    @if($ingredient->front_unit)
                                        {{ $ingredient->front_unit }}
                                    @endif
                                    @if($ingredient->unit_amount)
                                        {{ $ingredient->unit_amount }}
                                    @endif
                                    @if($ingredient->back_unit)
                                        {{ $ingredient->back_unit }}
                                    @endif
                                    @if($ingredient->unit_price)
                                        {{ $ingredient->unit_price }}円
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        
                    <div class="sum_price"> 
                            <?php 
                                $total_price = 0;
                                foreach($ingredients as $ingredient)
                                    if($ingredient->post_id === $post->id && $ingredient->unit_price)
                                        $total_price += $ingredient->unit_price;
                            ?>
                            <h2 class="sum">合計金額</h2>
                            <p class="sum">{{ $total_price }}円</p>
                    </div>
                </div>
                
                
            </div>
            
            <!--作り方-->        
            <div class='cook box25'>
                <h2 class="ribbon1">作り方</h2>
                <p class='body'>{!! nl2br(e($post->make)) !!}</p>
            </div>
            
            <div class="reference box25">   
                <h2 class="ribbon1">参考リンク</h2>        
                <a href="{{ $post->reference }}"><h3 class="url">{{ $post->reference }}</h3></a>
            </div>
            
            <div class="button-container">
                <div class='post_week'>
                    <a class="button return_button" href="/posts/{{ $post->id }}/menu">献立に追加️</a>
                </div>
                
                @if( $post->user->id == Auth::user()->id)
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
                @endif
                
            </div>
            
            <div class='return'>
                <a class="button return_button" href="/">◀戻る️</a>
            </div>
            
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