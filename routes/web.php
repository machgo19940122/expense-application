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

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
