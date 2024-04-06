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
                <input type="text" name=post[title] placeholder="料理名を入力" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div>
                <h2>カテゴリー</h2>
                @foreach($categories as $category)
                    <label>
                        <input type="radio" value="{{ $category->id }}" name="category" {{ old('category') == $category->id ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                @endforeach
                <p class="category__error" style="color:red">{{ $errors->first('category') }}</p>
            </div>
            
            <div class="make">
                <h2>作り方</h2>
                <textarea class="make_content" name="post[make]" placeholder="作り方を入力">
                    <?php
                        echo "\nstep1\n\nstep2\n\nstep3\n\nstep4\n\nstep5";
                    ?></textarea>
                <p class="make__error" style="color:red">{{ $errors->first('post.make') }}</p>
            </div>
            
            <div class="reference">
                <h2>参考URL</h2>
                <input type="text" name="post[reference]" placeholder="URLを入力">
            </div>
            
            <div class="date">
                <h2>作る日</h2>
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