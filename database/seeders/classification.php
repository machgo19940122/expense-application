<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class classification extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('classification')->insert([
        //     [
        //         'id' => '1',
        //         'classification' => '交通費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '2',
        //         'classification' => '交際費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '3',
        //         'classification' => '宿泊費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '4',
        //         'classification' => '通信費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '5',
        //         'classification' => '雑費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '6',
        //         'classification' => '修繕費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '7',
        //         'classification' => '消耗品費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '8',
        //         'classification' => '宣伝広告費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '9',
        //         'classification' => '損害保険料',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'id' => '10',
        //         'classification' => '福利厚生費',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]
        // ]);     
        
        
        // 1レコード
        $Classification = new \App\Models\Classification([
            'id' => '1',
            'classification' => '交通費',
        ]);
        $Classification -> save();

        // 2レコード
        $Classification = new \App\Models\Classification([
            'id' => '2',
            'classification' => '交際費',
        ]);
        $Classification -> save();

        // 3レコード
         $Classification = new \App\Models\Classification([
            'id' => '3',
            'classification' => '宿泊費',
        ]);
        $Classification -> save();

        // 4レコード
         $Classification = new \App\Models\Classification([
            'id' => '4',
            'classification' => '通信費',
        ]);
        $Classification -> save();

        // 5レコード
         $Classification = new \App\Models\Classification([
            'id' => '5',
            'classification' => '雑費',
        ]);
        $Classification -> save();

        // 6レコード
         $Classification = new \App\Models\Classification([
            'id' => '6',
            'classification' => '修繕費',
        ]);
        $Classification -> save();

        // 7レコード
         $Classification = new \App\Models\Classification([
            'id' => '7',
            'classification' => '消耗品費',
        ]);
        $Classification -> save();

        // 8レコード
         $Classification = new \App\Models\Classification([
            'id' => '8',
            'classification' => '宣伝広告費',
        ]);
        $Classification -> save();

        // 9レコード
         $Classification = new \App\Models\Classification([
            'id' => '9',
            'classification' => '損害保険料',
        ]);
        $Classification -> save();

        // 10レコード
         $Classification = new \App\Models\Classification([
            'id' => '10',
            'classification' => '福利厚生費',
        ]);
        $Classification -> save();
        
    }
}
