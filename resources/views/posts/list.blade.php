<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レシピ投稿アプリ（仮名）</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    </head>
    
    <x-app-layout>
    <x-slot name="header">
        <div class="header">
        　<p>～買い物リスト～</p>
        </div>
    </x-slot>
    
    <body class="antialiased">
        <div class="pattern">
            <div class="list_content">
            <div calss="make_list">
                <a class="make_list_button button" href="/makelist">買い物リストを作る▶️</a>
            </div>
            
            
            <div class="list box25">
                <h2 class="ribbon1">買い物リスト</h2>
                @if($buy_lists)
                    @foreach($buy_lists as $buy_list)
                        @foreach($ingredients as $ingredient)
                            @if($ingredient->post == $buy_list->post)
                            <li class="content">
                                @if($ingredient->name)
                                    <h2 class="ingredient_name">{{ $ingredient->name }}</h2>
                                @endif
                                、
                                @if($ingredient->front_unit)
                                    {{ $ingredient->front_unit }}
                                @endif
                                @if($ingredient->unit_amount)
                                    {{ $ingredient->unit_amount }}
                                @endif
                                @if($ingredient->back_unit)
                                    {{ $ingredient->back_unit }}
                                @endif
                                、
                                @if($ingredient->unit_price)
                                    {{ $ingredient->unit_price }}円
                                @endif
                            </li>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
            </div>
        </div>
    </body>
    </x-app-layout>
</html>