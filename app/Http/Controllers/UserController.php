<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;



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
        { //ログインエラー変数定義
            $login_error=null;
        //idが同じレコードをuser tableからgetする
            $user = User::where('id', $request->id)->get();
        //１件もなければエラー
        if (count($user) === 0){
            $login_error=false;
            return view('user/login', ['login_error' => $login_error]);
        }
        // 一致したら
        if (Hash::check($request->password, $user[0]->password)) {  
            Session::put("id",$user[0]->id);
            Session::put("name",$user[0]->name);
            Session::put("role",$user[0]->role);
            //トップ画面に遷移
            return redirect()->route('tops');
        // 不一致だったらエラー   
        }else{
            $login_error=false;
            return view('user/login', ['login_error' => $login_error]);
        } 
        }

 //ログアウト機能
    public function logout(Request $request)
    {
        $request->session()->flush();
        Session::flash('flash_message', 'ログアウトしました');
        return redirect()->route('login');
    }  
        }
