<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::get('/edit_expense',function(){ return view('expense/edit_expense'); })->name('editexpense');
Route::get('/register',function(){return view('user/member_register');});
Route::post('/register', [App\Http\Controllers\UserController::class, 'postSignup'])->name('postsignup');
Route::get('/login',function(){return view('user/login');})->name('login');
Route::post('/login', [App\Http\Controllers\UserController::class, 'postSignin'])->name('signin');