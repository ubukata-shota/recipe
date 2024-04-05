<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'ナポリタン',
            'image' => '',
            'reference' => 'https://www.kurashiru.com/recipes/82b3201b-29f4-4db9-9fbb-82a1ce16d247',
            'amount' => '100',
            'make' => '1.スパゲッティは塩を入れた熱湯で表示時間通りにゆで、ザルに上げて水気をきる。
                        2.玉ねぎはタテ薄切りにし、ソーセージは５ｍｍ幅の斜め薄切りにする。ピーマンはヘタと種を取り、５ｍｍ幅に切る。
                        3.フライパンに油を熱し、（２）の玉ねぎ・ピーマンを弱火で炒める。しんなりしてきたら（２）のソーセージを加え、弱火で焼く。ソーセージに焼き色がついたら「コンソメ」、ケチャップを加えてひと炒めする。
                        4.（１）のスパゲッティを加えて炒め、Ａで味を調える。好みで粉チーズをふる。',
            'created_at' => new Datetime(),
            'updated_at' => new Datetime(),
            'category_id' => 6
            
            
            
        ]);
    }
}
