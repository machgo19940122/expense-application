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

Route::get('/', function () {
    return view('welcome');


    
});


 Route::get('/edit_expense',function(){
     return view('expense/edit_expense');
 });
 Route::get('/register',function(){
     return view('user/member_register');
 });

 Route::get('/login',function(){
    return view('user/login');
});


// 申請一覧画面
Route::get('/list_expense', [ExpenseController::class, 'list_expense']);





// 経費登録画面
// 経費登録画面を表示
Route::get('/apply_expense', [ExpenseController::class, 'apply_expense']);
// 経費登録画面にて経費情報を入力しキャンセルまたは申請ボタンが押された時の処理
Route::post('/apply_expense_form/{id}', [ExpenseController::class, 'apply_expense_form']);




// 経費承認画面
Route::get('/approve_expense', [ExpenseController::class, 'approve_expense']);

Route::get('/tops', [App\Http\Controllers\TopController::class, 'index'])->name('tops');

