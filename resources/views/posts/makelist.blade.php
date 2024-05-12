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
        <p>買い物リストを作る</p>
    </div>
</x-slot>

<body class="antialiased">
    <div class="pattern">
        <div class="list_content">
        <form action="{{ route('makelist') }}" method="POST">
            @csrf <!-- CSRFトークンを追加 -->
            
            <?php 
                $weekly = [];
                for ($i = 0; $i < 7; $i++) {
                    $weekly[] = date("Y-m-d", strtotime("+$i day"));
                }
            ?>
            @foreach($weekly as $day)
                
                
                <br>
                @foreach($weeks as $dish)
                    @if($dish->user_id == Auth::user()->id)
                        @if($dish->post && $dish->post->id && $day == $dish->date)
                            <input type="checkbox" value="{{ $dish->post->id }}" name="buy_list[]">
                            {{ $day }}
                            <br>
                            <h2 class="post_title">{{ $dish->post->title }}</h2>
                            @if($dish->post->image != null)
                                <img class="image" src="{{ asset( $dish->post->image) }}" alt="Post Image">
                            @endif
                        @endif
                    @endif
                @endforeach
                <br>
            @endforeach
            <div class="add_list">
                <input class="button" type="submit" value="投稿">
                <a class="button" href="buy">戻る</a>
            </div>
        </form>
        </div>
    </div>
</body>
</x-app-layout>
</html>