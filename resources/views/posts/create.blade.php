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
        <h1>新しいレシピの投稿</h1>
        <form action="/posts" method="POST">
            @csrf
            
            <!--以下入力項目-->
            <div class="title">
                <h2>料理名</h2>
                <input type="text" name=post[title] placeholder="料理名を入力">
            </div>
            
            <div>
                <h2>カテゴリー</h2>
                @foreach($categories as $category)
        
                    <label>
                        {{-- valueを'$subjectのid'に、nameを'配列名[]'に --}}
                        <input type="radio" value="{{ $category->id }}" name="category">
                            {{ $category->name }}
                    </label>
                    
                @endforeach         
            </div>
            
            <div class="make">
                <h2>作り方</h2>
                <textarea name="post[make]" placeholder="作り方を入力"></textarea>
            </div>
            
            <div class="reference">
                <h2>参考URL</h2>
                <input type="text" name="post[reference]" placeholder="URLを入力">
            </div>
            
            <div class="date">
                <h2>作成日付</h2>
                <input type="date" name="week[date]">
            </div>
            
            <input type="submit" value="投稿">
        </form>
        
        <div class='footer'>
            <br>
            <a href="/">◀️戻る️</a>
        </div>
    </body>
    </x-app-layout>
</html>