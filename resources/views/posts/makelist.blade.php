<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>買い物リストを作る</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
</head>

<x-app-layout>
    
    <x-slot name="header">
        <div class="header">
        　<p>買い物リストを作る</p>
        </div>
    </x-slot>

<body class="antialiased">
    <div class="pattern">
        
        <h2 class="announcement">リストに入れたいレシピに<span class="focus">チェック</span>を入れてください</h2>
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
                            
                            
                            
                            
                            
                            
                            
                            <label class="ECM_CheckboxInput">
                                @if($day != date("Y-m-d"))
                                    <input class="date ECM_CheckboxInput-Input" type="checkbox" value="{{ $dish->post->id }}" name="buy_list[]"><span class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">{{ $dish->post->title }} ({{ \Carbon\Carbon::parse($day)->format('n月j日') }})</span>
                                @endif
                                @if($day == date("Y-m-d"))
                                    <input class="date ECM_CheckboxInput-Input" type="checkbox" value="{{ $dish->post->id }}" name="buy_list[]"><span class="ECM_CheckboxInput-DummyInput"></span><span class="ECM_CheckboxInput-LabelText">{{ $dish->post->title }} (今日)</span>
                                @endif
                            </label>
                        
                            @if($dish->post->image != null)
                                <div class="image">
                                    <img src="{{ asset( $dish->post->image) }}" alt="Post Image">
                                </div>
                                <div class="buy_list_image">
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            @endforeach
            <div class="add_list">
                <input class="button post_button" type="submit" value="リストを作成">
                <a class="button return_button" href="buy">戻る</a>
            </div>
        </form>
        </div>
    </div>
</body>
</x-app-layout>
</html>