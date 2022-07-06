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

//登録画面表示
Route::get('/register',function(){return view('user/member_register');})->name('register');
//登録内容を登録処理
Route::post('/register', [App\Http\Controllers\UserController::class, 'postSignup'])->name('postsignup');
//ログイン画面表示
Route::get('/login',function(){return view('user/login');})->name('login');
//ログイン処理
Route::post('/login', [App\Http\Controllers\UserController::class, 'postSignin'])->name('signin');
//申請内容編集。セッションに保存されたid情報ががなければログイン画面に遷移。
Route::get('/edit_expense/{expense_id}', [App\Http\Controllers\ExpenseController::class,'getedit'])->name('getedit')->middleware('login');
//申請内容編集画面表示
Route::post('/edit_expense/{expense_id}', [App\Http\Controllers\ExpenseController::class,'edit'])->name('edit');
// //ログアウト
Route::get('/logout', [App\Http\Controllers\UserController::class,'logout'])->name('logout');
// //経費申請内容取り消し処理（delete)
Route::delete('/edit_expense/{expense_id}}',[App\Http\Controllers\ExpenseController::class,'delete'])->name('delete');