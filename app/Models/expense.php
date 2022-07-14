<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;

    // seederの設定
    public $timestamps = false; //timesatampを利用しない
    protected $fillable = ['id','user_id','target_date','status','name','expense','classification_id','expelnation','remarks'];

    // Expenseテーブルのclassification_idとClassificationテーブルのidをリレーションする
    // Expenseテーブルが多でClassificationテーブルが1の関係
    public function classification(){
        return $this->belongsTo('App\Models\Classification');
    }
}
