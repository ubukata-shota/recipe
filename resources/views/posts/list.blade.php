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
                <div class="some_button">
                    <div calss="make_list">
                        <a class="make_list_button button" href="/makelist">買い物リストを作る▶️</a>
                    </div>
                    
                    <form action="{{ route('makelist') }}" method="POST">
                        @csrf <!-- CSRFトークンを追加 -->
                        <div class="add_list">
                            <input class="button delete" type="submit" value="リストを削除">
                        </div>
                    </form>
                </div>
                
                <div class="list box25">
                    <h2 class="ribbon1">買い物リスト</h2>
                    
                    <div class=>
                    @if($buy_lists)
                        <?php $total_price = 0; ?>
                        @foreach($buy_lists as $buy_list)
                            @if($buy_list->user_id == Auth::user()->id)
                            
                                @foreach($ingredients as $ingredient)
                                    @if($ingredient->post == $buy_list->post)
                                        <li class="content">
                                            @if($ingredient->name)
                                                <h2 class="ingredient_name">{{ $ingredient->name }}</h2>
                                            @endif
                                            、
                                            @if($ingredient->front_unit)
                                                <h2>{{ $ingredient->front_unit }}</h2>
                                            @endif
                                            @if($ingredient->unit_amount)
                                                <h2>{{ $ingredient->unit_amount }}</h2>
                                            @endif
                                            @if($ingredient->back_unit)
                                                <h2>{{ $ingredient->back_unit }}</h2>
                                            @endif
                                            @if($ingredient->unit_price)
                                                <h2 class="price">{{ $ingredient->unit_price }}円</h2>
                                                <?php $total_price += $ingredient->unit_price; ?>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                
                            @endif
                        @endforeach
                        <h2 class="price sum_price">合計金額: {{ $total_price }}円</h2>
                    @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
    </x-app-layout>
</html>