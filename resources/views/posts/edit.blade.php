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
        <h1>レシピの編集</h1>
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method("PUT")
            <!--以下入力項目-->
            <div class="title">
                <h2>料理名</h2>
                <input type="text" name=post[title] placeholder="料理名を入力" value="{{ old('post.title', $post->title) }}">
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div>
                <h2>カテゴリー</h2>
                @foreach($categories as $category)
                    <input type="radio" name="category" value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'checked' : '' }}>
                    {{ $category->name }}
                @endforeach
                <p class="category__error" style="color:red">{{ $errors->first('category') }}</p>
            </div>
            
            <div class="make">
                <h2>作り方</h2>
                <textarea name="post[make]" placeholder="作り方を入力">{{ old('post.make', $post->make) }}</textarea>
                <p class="make__error" style="color:red">{{ $errors->first('post.make') }}</p>
            </div>
            
            <div class="reference">
                <h2>参考URL</h2>
                <input type="text" name="post[reference]" placeholder="URLを入力" value={{ $post->reference }}>
            </div>
            
            <div class="date">
                <h2>作る日</h2>
                <?php 
                //$dateにweeksテーブルの$postのidと一致するpost_idを見つけ出し、そのレコードのdateを代入する
                $date = $week->where('post_id', $post->id)->value('date');
                ?>
                <input type="date" name="week[date]" value="{{ $date }}">
            </div>
            
            <input type="submit" value="更新する">
        </form>
        
        <div class='footer'>
            <br>
            <a href="/posts/{{ $post->id }}">◀️戻る️</a>
        </div>
    </body>
    </x-app-layout>
</html>