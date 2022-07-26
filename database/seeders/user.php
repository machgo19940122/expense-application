<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1レコード
        $user = new \App\Models\user([
            'id' => '1',
            'role' => '0',
            'name' => '一般従業員',
            'password' => Hash::make('00000')
        ]);
        $user -> save();

        // 2レコード
        $user = new \App\Models\user([
            'id' => '2',
            'role' => '1',
            'name' => '管理者',
            'password' => Hash::make('11111')
        ]);
        $user -> save();
    }
    
}
