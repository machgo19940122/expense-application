<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\Top;
 
class TopController extends Controller
{
    /**
        * 
        *
        * @param Request $request
        * @return Response
        */
    public function index(Request $request)
    {
        //セッションを取得（id、権限）
        //$user_id = セッションから取得

        //権限チェック
        //if(){
            //管理者の場合、全データ取得
            //$tops = Top::orderBy('created_at', 'asc')->get();

            //sqlで件数と金額の集計を行う。件数はselect( sum(*) )　みたいな感じ、金額はSUM(expense)

        //}else{
            //一般の場合、ログイン者のデータのみ取得
            //$tops = Top::Where("id","=",$user_id )->orderBy('created_at', 'asc')->get();

            //sqlで件数と金額の集計を行う。件数はselect( sum(*) )　みたいな感じ、金額はSUM(expense)
            
        //}
        $tops = Top::orderBy('created_at', 'asc')->get();
        return view('tops.index', [
            'tops' => $tops,
        ]);
    }
}

