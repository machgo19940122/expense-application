<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Support\Facades\DB;

class expensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'user_id' => 1,
            'target_date' => '2022-07-01',
            'expenses' => 500,
            'created_at' => '2022-07-01',
        ];
        DB::table('expenses')->insert($param);

        $param = [
            'id' => 2,
            'user_id' => 1,
            'target_date' => '2022-07-01',
            'expenses' => 300,
            'created_at' => '2022-07-01',
        ];
        DB::table('expenses')->insert($param);

        $param = [
            'id' => 3,
            'user_id' => 1,
            'target_date' => '2022-07-02',
            'expenses' => 400,
            'created_at' => '2022-07-02',
        ];
        DB::table('expenses')->insert($param);

        $param = [
            'id' => 4,
            'user_id' => 1,
            'target_date' => '2022-07-02',
            'expenses' => 600,
            'created_at' => '2022-07-02',
        ];
        DB::table('expenses')->insert($param);
    }
}
