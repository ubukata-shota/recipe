<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>レシピを投稿</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/post.css') }}">
        <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
        

    </head>
    
    <x-app-layout>
    <x-slot name="header">
        　<p>レシピを投稿</p>
    </x-slot>
    
    <body class="antialiased">
        <div class="pattern"> 
            <div class="input_content">
                <form action="/posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!--以下入力項目-->
                    <h2 class="input">写真を投稿する</h2>
                    <input class="input_image" type="file" name="image">
                    
                    <h2 class="input"><span class="must">*</span>料理名</h2>
                    <div class="title cp_iptxt">
                        <label class="ef">
                            <input type="text" name=post[title] placeholder="料理名を入力" value="{{ old('post.title') }}"/>
                        </label>
                        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                    </div>
                    
                    <div>
                        <h2 class="input"><span class="must">*</span>カテゴリー</h2>
                        @foreach($categories as $category)
                            <label>
                                <input class="view_categories" type="radio" value="{{ $category->id }}" name="category" {{ old('category') == $category->id ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        @endforeach
                        <p class="category__error" style="color:red">{{ $errors->first('category') }}</p>
                    </div>
                    
                    <h2 class="input">必要な材料 <span class="alert">※色がついている部分は半角数字で入力してください</span></h2>
                    <div class="ingredient_content" id="ingredient">
                        <div id="ingredient1" class="ingredient_container cp_iptxt">
                            <label class="ef">
                                <input class="ingredient_text" type="text" name="ingredient[1][name]" placeholder="材料名を入力">
                                <input class="ingredient_text" type="text" name="ingredient_3[1][front_unit]" placeholder="例）大さじ">
                                <input class="ingredient_text" type="number" name="ingredient_1[1][unit_amount]" placeholder="量を入力">
                                <input class="ingredient_text" type="text" name="ingredient_4[1][back_unit]" placeholder="例）杯">
                                <input class="ingredient_text" type="number" name="ingredient_2[1][unit_price]" placeholder="金額を入力">
                            </label>
                            <button class="button delete" type="button" onclick="removeIngredient('ingredient1')">削除</buttion>
                        </div>
                    </div>
                    <div class="add_button">
                        <button class="button common ingredient_content" type="button" onclick="addIngredient()">追加</button>
                    </div>
                    
                    <h2 class="input"><span class="must">*</span>作り方</h2>
                    <div class="make">
                        <textarea class="make_content" name="post[make]" placeholder="作り方を入力">
                            <?php
                                echo "\nstep1\n\nstep2\n\nstep3\n\nstep4\n\nstep5";
                            ?>
                        </textarea>
                        <p class="make__error" style="color:red">{{ $errors->first('post.make') }}</p>
                    </div>
                    
                    <h2 class="input">参考リンク</h2>
                    <div class="reference input cp_iptxt">
                        <label class="ef">
                            <input class="reference" type="text" name="post[reference]" placeholder="URLを入力">
                        </label>
                    </div>
                    <input class="button post_button" type="submit" value="投稿する">
                </form>
                
                <div class='footer'>
                    <br>
                    <a class="button return_button" href="/">◀️戻る️</a>
                </div>
            </div>
        </div>
            <script>
                var ingredientCount = 1;
                
                function addIngredient() {
                    ingredientCount ++;
                    var inputFields = document.getElementById("ingredient");
                    var newInput = document.createElement("div");
                    newInput.id = "ingredient" + ingredientCount;
                    newInput.innerHTML = 
                    '<div id="ingredient1" class="ingredient_container cp_iptxt"><label class="ef"><input class="ingredient_text" type="text" name="ingredient[' + ingredientCount + '][name]" placeholder="材料名を入力"><input class="ingredient_text" type="text" name="ingredient_3[' + ingredientCount + '][front_unit]" placeholder="例）大さじ"><input class="ingredient_text" type="number" name="ingredient_1[' + ingredientCount + '][unit_amount]" placeholder="量を入力"><input class="ingredient_text" type="text" name="ingredient_4[' + ingredientCount + '][back_unit]" placeholder="例）杯"><input class="ingredient_text" type="number" name="ingredient_2[' + ingredientCount + '][unit_price]" placeholder="金額を入力"></label><button class="button delete" type="button" onclick="removeIngredient(\'ingredient' + ingredientCount + '\')">削除</button></div>';
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