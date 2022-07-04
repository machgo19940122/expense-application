<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


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

//ログイン
        public function postSignin(Request $request)
        {
        $this->validate($request,[
        'id' => 'required',
        'password' => 'required'
        ]);
       
        if(Auth::attempt(['id' => $request->input('id'), 'password' => $request->input('password')])){
        return redirect()->route('editexpense');
        }
        return redirect()->back();
        }

}
