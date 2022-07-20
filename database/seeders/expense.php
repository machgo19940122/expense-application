<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class expense extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1レコード
        $expense = new \App\Models\expense([
            'id' => '1',
            'user_id' => '1',
            'target_date' => '2022/07/04',
            'status' => '0',
            'name' => 'テック太郎',
            'expense' => '15000',
            'classification_id' => '2',
            'expelnation' => '◯◯ゴルフ場に支払い',
            'remarks' => '接待として使用',
        ]);
        $expense->save();

         // 2レコード
         $expense = new \App\Models\expense([
            'id' => '2',
            'user_id' => '2',
            'target_date' => '2022/07/04',
            'status' => '1',
            'name' => 'テック次郎',
            'expense' => '50000',
            'classification_id' => '3',
            'expelnation' => '◯◯プリンスホテルに支払い',
            'remarks' => '出張時の宿泊代として使用',
        ]);
        $expense->save();

         // 3レコード
         $expense = new \App\Models\expense([
            'id' => '3',
            'user_id' => '2',
            'target_date' => '2022/07/04',
            'status' => '2',
            'name' => 'テック花子',
            'expense' => '3000',
            'classification_id' => '5',
            'expelnation' => 'シャトレーゼに支払い',
            'remarks' => '取引先訪問時のお土産として使用',
        ]);
        $expense->save();

        // 4レコード
        $expense = new \App\Models\expense([
            'id' => '4',
            'user_id' => '1',
            'target_date' => '2022/08/04',
            'status' => '2',
            'name' => 'テック花子',
            'expense' => '3500',
            'classification_id' => '5',
            'expelnation' => 'シャトレーゼに支払い',
            'remarks' => '取引先訪問時のお土産として使用',
        ]);
        $expense->save();

        // 5レコード
         $expense = new \App\Models\expense([
            'id' => '5',
            'user_id' => '2',
            'target_date' => '2022/08/04',
            'status' => '2',
            'name' => 'テック花子',
            'expense' => '4000',
            'classification_id' => '5',
            'expelnation' => 'シャトレーゼに支払い',
            'remarks' => '取引先訪問時のお土産として使用',
        ]);
        $expense->save();

        // 6レコード
        $expense = new \App\Models\expense([
            'id' => '6',
            'user_id' => '2',
            'target_date' => '2022/06/04',
            'status' => '2',
            'name' => 'テック花子',
            'expense' => '5000',
            'classification_id' => '5',
            'expelnation' => 'シャトレーゼに支払い',
            'remarks' => '取引先訪問時のお土産として使用',
        ]);
        $expense->save();
    }
}
