<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>一週間の献立</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    
</head>
<x-app-layout>
    <x-slot name="header">
        <div class="header">
        　<p>一週間の献立</p>
        </div>
    </x-slot>
    <body class="antialiased">
        <div class="pattern">
            
            <button></button>
            <!--曜日の配列を保存-->
            <?php $days = array("日", "月", "火", "水", "木", "金", "土"); ?>
            <?php $week_count = isset($week_count) ? $week_count : 0; ?>
            
            <div class="move_week">
                <form class="button move_week_button" action="{{ route('down_week_count') }}" method="post">
                    @csrf
                    <button type="submit">前の週</button>
                </form>
                <a class="button move_week_button" href="/week">今週に戻る</a>
                <form class="button move_week_button" action="{{ route('up_week_count') }}" method="post">
                    @csrf
                    <button type="submit">次の週</button>
                </form>
            </div>
            <!--7日目までループ処理する-->
            
            
            @for ($i = 0; $i < 7; $i++)
                @if(date("Y-m-d", strtotime("+$i day".$week_count ." day")) == date("Y-m-d"))
                <h2 class="date line today">
                    <?php
                        $day_of_week = date("w", strtotime("+$i day".$week_count ." day"));
                        echo date("m月d日", strtotime("+$i day".$week_count ." day")) . "（" . $days[$day_of_week] . "）";
                    ?>
                </h2>
                @endif
                @if(date("Y-m-d", strtotime("+$i day".$week_count ." day")) != date("Y-m-d"))
                <h2 class="date line not_today">
                    <?php
                        $day_of_week = date("w", strtotime("+$i day".$week_count ." day"));
                        echo date("m月d日", strtotime("+$i day".$week_count ." day")) . "（" . $days[$day_of_week] . "）";
                    ?>
                </h2>
                @endif
                
                @foreach($weeks as $day)
                    @if($day->date === date("Y-m-d", strtotime("+$i day".$week_count ." day")))
                        @if($day->user_id == Auth::user()->id && $day->post && $day->post->id)
                            <div class="center">
                                <a href="/posts/{{ $day->post->id }}" class="center">
                                    <h1 class="title">{{ $day->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day->post->id }}">
                                <div class="image">
                                    @if($day->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ $day->post->image }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            <form action="{{ route('weeks.delete', ['id' => $day->id]) }}" id="form_{{ $day->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button delete_button" type="submit" onclick="deleteWeek({{ $day->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                @endforeach
                <br>
            @endfor
        </div>
    </body>
</x-app-layout>
</html>