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
            　<p>一週間の献立</p>
        </x-slot>
        
        <body class="antialiased">
            
            
            <!--以下一週間の献立-->
            <!--1日目-->
            <h2><?php
                echo date("m月d日");
            ?></h2>
            @foreach($weeks as $day1)
                @if($day1->date === date("Y-m-d"))
                    <a href="/posts/{{ $day1->post->id }}"><h2>{{ $day1->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            <!--2日目-->
            <h2><?php
                echo date("m月d日", strtotime("+1 day"));
            ?></h2>
            @foreach($weeks as $day2)
                @if($day2->date === date("Y-m-d", strtotime("+1 day")))
                    <a href="/posts/{{ $day2->post->id }}"><h2>{{ $day2->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            <!--3日目-->
            <h2><?php
                echo date("m月d日", strtotime("+2 day"));
            ?></h2>
            @foreach($weeks as $day3)
                @if($day3->date === date("Y-m-d", strtotime("+2 day")))
                    <a href="/posts/{{ $day3->post->id }}"><h2>{{ $day3->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            <!--4日目-->
            <h2><?php
                echo date("m月d日", strtotime("+3 day"));
            ?></h2>
            @foreach($weeks as $day4)
                @if($day4->date === date("Y-m-d", strtotime("+3 day")))
                    <a href="/posts/{{ $day4->post->id }}"><h2>{{ $day4->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            
            <!--5日目-->
            <h2><?php
                echo date("m月d日", strtotime("+4 day"));
            ?></h2>
            @foreach($weeks as $day5)
                @if($day5->date === date("Y-m-d", strtotime("+4 day")))
                    <a href="/posts/{{ $day5->post->id }}"><h2>{{ $day5->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            <!--6日目-->
            <h2><?php
                echo date("m月d日", strtotime("+5 day"));
            ?></h2>
            @foreach($weeks as $day6)
                @if($day6->date === date("Y-m-d", strtotime("+5 day")))
                    <a href="/posts/{{ $day6->post->id }}"><h2>{{ $day6->post->title }}</h2></a>
                @endif
            @endforeach
            <br>
            
            <!--7日目-->
            <h2><?php
                echo date("m月d日", strtotime("+6 day"));
            ?></h2>
            @foreach($weeks as $day7)
                @if($day7->date === date("Y-m-d", strtotime("+6 day")))
                    <a href="/posts/{{ $day7->post->id }}"><h2>{{ $day7->post->title }}</h2></a>
                @endif
            @endforeach
            
        </body>
    </x-app-layout>
</html>