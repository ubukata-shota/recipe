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
        　<p>レシピを編集</p>
    </x-slot>
    
    <body class="antialiased">
        <h1>レシピの編集</h1>
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            
            <!--以下入力項目-->
            <input type="file" name="image" value="{{ old('post.image', $post->image) }}">
            
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
            
            <div class="ingredient_content" id="ingredient">
            @foreach($ingredients as $index => $ingredient)
                @if($ingredient->post_id == $post->id)
                    <div id="ingredient{{ $index }}" class="ingredient_container">
                        <input type="text" name="ingredient[{{ $index }}][name]" value="{{ $ingredient->name }}" placeholder="材料名を入力">
                        <input class="ingredient_text" type="number" name="ingredient_1[{{ $index }}][unit_amount]" value="{{ $ingredient->unit_amount }}" placeholder="量を入力">
                        <input class="ingredient_text" type="number" name="ingredient_2[{{ $index }}][unit_price]" value="{{ $ingredient->unit_price }}" placeholder="金額を入力">
                        <button class="button delete" type="button" onclick="removeIngredient('ingredient{{ $index }}')">削除</button>
                    </div>
                @endif
            @endforeach
            </div>
            <button class="button common ingredient_content" type="button" onclick="addIngredient()">追加</button>
            
            <h2>作り方</h2>
            <div class="make">
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
            
            <input class="button common" type="submit" value="更新する">
        </form>
        
        <div class='footer'>
            <br>
            <a href="/posts/{{ $post->id }}">◀️戻る️</a>
        </div>
            <script>
                var ingredientCount = 1;
                
                function addIngredient() {
                ingredientCount ++;
                var inputFields = document.querySelector(".ingredient_content");
                var newInput = document.createElement("div");
                newInput.id = "ingredient" + ingredientCount;
                newInput.innerHTML = '<div id="ingredient{{ $index }}" class="ingredient_container"><input class="ingredient_text" type="text" name="ingredient[' + ingredientCount + '][name]" placeholder="材料名を入力">  <input class="ingredient_text" type="number" name="ingredient_1[' + ingredientCount + '][unit_amount]" placeholder="量を入力"><input class="ingredient_text" type="number" name="ingredient_2[' + ingredientCount + '][unit_price]" placeholder="金額を入力"><button class="button delete" type="button" onclick="removeIngredient(\'ingredient' + ingredientCount + '\')">削除</button></div>';
                inputFields.appendChild(newInput);
            }
                
                function removeIngredient(id) {
                    var element = document.getElementById(id);
                    element.parentNode.removeChild(element);
                }
            </script>
    </body>
    </x-app-layout>
</html>