<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;

    // seederの設定
    public $timestamps = false; //timesatampを利用しない
    protected $fillable = ['id','user_id','target_date','status','name','expense','classification_id','expelnation','remarks'];
}
