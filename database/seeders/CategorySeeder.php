<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuisines')->insert([
            [
                'name' => '中華',
                'created_at' => '2024-04-03 12:01:38',
                'updated_at' => '2024-04-03 12:01:38',
            ],
            [
                'name' => '和食',
                'created_at' => '2024-04-03 12:02:28',
                'updated_at' => '2024-04-03 12:02:28',
            ],
            [
                'name' => '洋食',
                'created_at' => '2024-04-03 12:04:39',
                'updated_at' => '2024-04-03 12:04:39',
            ],
            [
                'name' => 'イタリアン',
                'created_at' => '2024-04-05 10:37:32',
                'updated_at' => '2024-04-05 10:37:32',
            ],
            [
                'name' => 'アジア・エスニック',
                'created_at' => '2024-04-06 13:38:40',
                'updated_at' => '2024-04-06 13:38:40',
            ],
            [
                'name' => 'その他',
                'created_at' => '2024-04-06 13:43:00',
                'updated_at' => '2024-04-06 13:43:00',
            ],
        ]);
    }
}
