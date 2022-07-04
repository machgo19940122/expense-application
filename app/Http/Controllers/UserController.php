<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

//会員登録
    public function postSignup(Request $request){
        // バリデーション
        $this->validate($request,[
            'role' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);

        // DBインサート
        $user = new User([
            'role' => $request->input('role'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ]);

        // 保存
        $user->save();
        // リダイレクト
        return redirect()->route('login');
    }

//ログイン機能
        public function postSignin(Request $request)
        {
            $user = User::where('id', $request->id)->get();
        if (count($user) === 0){
            return view('login', ['login_error' => '1']);
        }
        
        // 一致
        if (Hash::check($request->password, $user[0]->password)) {
            
            // セッション
            session(['name'  => $user[0]->name]);
            session(['email' => $user[0]->email]);
            session(['id' => $user[0]->id]);
            session(['role' => $user[0]->role]);
            
            // フラッシュ
            session()->flash('flash_flg', 1);
            session()->flash('flash_msg', 'ログインしました。');
                  
            return redirect(url('/edit_expense'));
        // 不一致    
        }else{
            return view('login', ['login_error' => '1']);
        }
    } 
    

    //ログアウト
    // public function logout(Request $request)
    // {
    //     session()->forget('name');
    //     session()->forget('email');
    //     return redirect(url('/'));
    // }  

        }
