<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [];
        for ($i = 0; $i < 20; $i++) {
            array_push($dataArray, [
                'title' => Str::random(10),
                'content' => Str::random(10),
                'due_date' => date("Y-m-d", mt_rand(1, time())),
                'image' => Str::random(10) . '.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        DB::table('tasks')->insert($dataArray);
    }
}
