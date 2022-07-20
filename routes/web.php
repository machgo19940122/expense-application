<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

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




// 申請一覧画面
// サイドバーからの遷移
Route::get('/list_expense/{user_id}', [ExpenseController::class, 'list_expense1']);
// top画面からの遷移
// Route::get('/list_expense/{user_id}/{target_date}', [ExpenseController::class, 'list_expense2']);


// 経費登録画面
// 経費登録画面を表示（今回はsessionを使用するからurlの後ろに/{user_id}などは必要ない）
Route::get('/apply_expense', [ExpenseController::class, 'apply_expense']);
// 経費登録画面にて経費情報を入力しキャンセルまたは申請ボタンが押された時の処理
Route::post('/apply_expense_form', [ExpenseController::class, 'apply_expense_form']);


// 経費承認画面
// 経費承認画面を表示
Route::get('/approve_expense', [ExpenseController::class, 'approve_expense']);
// 承認ボタンを押した時の処理
Route::get('/approval/{id}', [ExpenseController::class, 'approval']);
// 差戻しボタンを押した時の処理
Route::get('/remand/{id}', [ExpenseController::class, 'remand']);
//TOP画面
Route::get('/tops', [App\Http\Controllers\TopController::class, 'index'])->name('tops');

//会員情報変更画面を表示
Route::get('/edit_member/{id}', [App\Http\Controllers\UserController::class, 'get_edit_member'])->middleware('login');
//会員情報変更画面を表示
Route::post('/edit_member/{id}', [App\Http\Controllers\UserController::class, 'edit_member'])->name('edit_member');