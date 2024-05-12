<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>献立表に追加</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/post.css') }}">

    </head>
    
    <x-app-layout>
    <x-slot name="header">
        　<p>献立表に追加</p>
    </x-slot>
    
    <body class="antialiased">
        <div class="pattern"> 
            <div class="input_content">
                <form action="/posts/{{ $post->id }}/menu" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="date input">
                        <h2>作る日</h2>
                        <input type="date" name="week[date]">
                    </div>
                    
                    <input class="button common" type="submit" value="投稿">
                </form>
                
                <div class='footer'>
                    <br>
                    <a class="button" href="/">◀️戻る️</a>
                </div>
            </div>
        </div>
    </body>
    
    
    </x-app-layout>
</html>