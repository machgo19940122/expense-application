<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    // seederの設定
    public $timestamps = false; //timesatampを利用しない
    protected $fillable = ['id', 'classification'];
}
