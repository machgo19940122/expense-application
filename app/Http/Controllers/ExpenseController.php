<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\User;
use App\Models\Expense;

class ExpenseController extends Controller
{
           // チーム開発の開発
    // public function list_expense(){
    //     if(){
    //         // カレンダーから遷移してきたら日別のリスト表示
    //     }else{
    //         // サイドバーから遷移してきた時は月別のリスト表示
    //     }
        

    // }

    // 申請登録画面を表示
    public function apply_expense(){

        // 申請登録画面の項目のドロップダウンにclassificationテーブルからデータを取得し表示する
        $classification = Classification::all();
        return view('expense/apply_expense')->with(['classification' => $classification]);
    }



    // 申請一覧画面に入力した情報を処理
    public function apply_expense_form(Request $request){
        if($request -> has('cancel')){
             // キャンセルボタンを押した場合 -> 入力内容を無視してtop画面に遷移
            redirect('index');
        }elseif($request -> has('application')){
            // 申請ボタンを押した場合 -> 入力者の名前と紐づき、申請一覧画面にデータを送りトップ画面に遷移
            $user = User :: where('id', '=', $request->id)->first();

            // 申請された経費をレコードに追加
            $expense = new Expense();
            $expense->name = $user->name;
            $expense->target_date = $request->target_date;
            $expense->expense = $request->expense;
            $expense->classification = $request->classification;
            $expense->expelnation = $request->expelnation;
            $expense->remarks = $request->remarks;
            $expense->save();

            // 申請された金額が1万円以上なら『未承認』のstatusを付与する
            if($request->expense >= 10000){
                $expense->atatus = '0';
            }

            redirect('index');  
        }
    }

    // // 経費承認画面を表示
    public function approve_expense(){
        // Expenseテーブルからstutasが『未承認』のものを取得する
        $approve = Expense::where('status', '=', '0')->get();

        // classification_idから項目の取得
        // $approve -> classification_id = Classification::get('classification');
        // dd($approve);
        return view('expense.approve_expense')->with([
            'approve' => $approve,
        ]);
    }
}
