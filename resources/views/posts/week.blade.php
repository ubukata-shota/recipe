<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>レシピ投稿アプリ（仮名）</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    
    <x-app-layout>
        <x-slot name="header">
            　<p>～一週間の献立～</p>
        </x-slot>
        
        <body class="antialiased">
            <div class="pattern">
            
            <!--以下一週間の献立-->
            <?php 
                $days = array("日", "月", "火", "水", "木", "金", "土");
            ?>
            <!--1日目-->
            <h2 class="date"><?php
                $day_of_week = date("w");
                echo date("m月d日") . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day1)
                @if($day1->date === date("Y-m-d"))
                
                    @if($day1->user_id == Auth::user()->id)
                        @if($day1->post && $day1->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day1->post->id }}" class="center">
                                    <h1 class="title">{{ $day1->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day1->post->id }}">
                                <div class="image_week">
                                    @if($day1->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day1->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day1->id]) }}" id="form_{{ $day1->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day1->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            <!--2日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+1 day"));
                echo date("m月d日", strtotime("+1 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day2)
                @if($day2->date === date("Y-m-d", strtotime("+1 day")))
                
                    @if($day2->user_id == Auth::user()->id)
                        @if($day2->post && $day2->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day2->post->id }}" class="center">
                                    <h1 class="title">{{ $day2->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day2->post->id }}">
                                <div class="image">
                                    @if($day2->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day2->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day2->id]) }}" id="form_{{ $day2->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day2->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            <!--3日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+2 day"));
                echo date("m月d日", strtotime("+2 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day3)
                @if($day3->date === date("Y-m-d", strtotime("+2 day")))
                
                    @if($day3->user_id == Auth::user()->id)
                        @if($day3->post && $day3->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day3->post->id }}">
                                    <h1 class="title">{{ $day3->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day3->post->id }}">
                                <div class="image">
                                    @if($day3->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day3->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day3->id]) }}" id="form_{{ $day3->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day3->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            <!--4日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+3 day"));
                echo date("m月d日", strtotime("+3 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day4)
                @if($day4->date === date("Y-m-d", strtotime("+3 day")))
                
                    @if($day4->user_id == Auth::user()->id)
                        @if($day4->post && $day4->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day4->post->id }}" class="center">
                                    <h1 class="title">{{ $day4->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day4->post->id }}">
                                <div class="image">
                                    @if($day4->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day4->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day4->id]) }}" id="form_{{ $day4->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day4->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            
            <!--5日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+4 day"));
                echo date("m月d日", strtotime("+4 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day5)
                @if($day5->date === date("Y-m-d", strtotime("+4 day")))
                    
                    @if($day5->user_id == Auth::user()->id)
                        @if($day5->post && $day5->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day5->post->id }}" class="center">
                                    <h1 class="title">{{ $day5->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day5->post->id }}">
                                <div class="image">
                                    @if($day5->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day5->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day5->id]) }}" id="form_{{ $day5->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day5->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            <!--6日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+5 day"));
                echo date("m月d日", strtotime("+5 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day6)
                @if($day6->date === date("Y-m-d", strtotime("+5 day")))
                
                    @if($day6->user_id == Auth::user()->id)
                        @if($day6->post && $day6->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day6->post->id }}" class="center">
                                    <h1 class="title">{{ $day6->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day6->post->id }}">
                                <div class="image">
                                    @if($day6->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day6->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day6->id]) }}" id="form_{{ $day6->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button button_delete" type="submit" onclick="deleteWeek({{ $day6->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            <br>
            
            <!--7日目-->
            <h2 class="date line"><?php
                $day_of_week = date("w", strtotime("+6 day"));
                echo date("m月d日", strtotime("+6 day")) . "（" . $days[$day_of_week] . "）";
            ?></h2>
            @foreach($weeks as $day7)
                @if($day7->date === date("Y-m-d", strtotime("+6 day")))
                
                    @if($day7->user_id == Auth::user()->id)
                        @if($day7->post && $day7->post->id)
                            <div  class="center">
                                <a href="/posts/{{ $day7->post->id }}" class="center">
                                    <h1 class="title">{{ $day7->post->title }}</h1>
                                </a>
                            </div>
                            <a href="/posts/{{ $day7->post->id }}">
                                <div class="image">
                                    @if($day7->post->image == null)
                                        <img src="{{ asset( "/jsI3pr0bNdUS1HypyALxx1uM7hHi2Sj6I6NltBUs.jpg" ) }}" alt="Post Image">
                                    @else
                                        <img src="{{ asset( $day7->post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                            </a>
                            
                            <form action="{{ route('weeks.delete', ['id' => $day7->id]) }}" id="form_{{ $day7->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class='delete'>
                                    <button class="button delete" type="submit" onclick="deleteWeek({{ $day7->id }})">削除する</button>
                                </div>
                            </form>
                        @endif
                    @endif
                    
                @endif
            @endforeach
            </div>
        </body>
    </x-app-layout>
</html>