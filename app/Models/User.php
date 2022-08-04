<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;



class User extends Model
{
    use HasFactory;

    // seederの設定
    public $timestamps = false; //timesatampを利用しない
    protected $fillable = ['id', 'role', 'name', 'password'];
}