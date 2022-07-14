<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\expense;
use App\Models\Classification;
use App\Models\User;
use DB;

class ExpenseController extends Controller
{

    // 経費登録画面

    // 経費登録画面を表示
    public function apply_expense(){

        // 申請登録画面の項目のドロップダウンにclassificationテーブルからデータを取得し表示する
        $classification = Classification::all();
        return view('expense/apply_expense')->with([
            'classification' => $classification
        ]);
    }

    // 経費申請画面の入力フォームに入力した情報を処理
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
                $expense->status = '0';
                //$expense->status = config('const.expense_status.misyonin');
            }

            redirect('index');  
        }
    }

    // 経費承認画面（管理者の画面）

    // 経費承認画面を表示
    public function approve_expense(){
        // Expenseテーブルからstutasが『未承認』のものを取得する
        $approve = Expense::where('status', '=', '0')->get();

        // classification_idから項目の取得
        // $approve -> classification_id = Classification::get('classification');


        return view('expense/approve_expense')->with([
            'approve' => $approve,
        ]);
    }

    //編集画面の表示 
    public function getedit (int $id){
      $classifications = Classification::all();
      $expense = expense::find($id);

      return view('expense/edit_expense', [
        'classifications' => $classifications,
        'expense'=>$expense,
      ]);

      $expense = expense::find($expense_id);
    }

    //申請内容編集
    public function edit(int $expense_id, request $request)
    {
        // urlから受け取ったidをパラメーターとしてDBから一件取得
        $expense = expense::find($expense_id);
        // postされたものを入れる
        $expense->target_date = $request->target_date;
        $expense->expense = $request->expense;
        $expense->classification_id = $request->classification_id;
        $expense->expelnation = $request->expelnation;
        $expense->remarks = $request->remarks;
        //保存したら遷移
        $expense->save();
        return redirect()->route('tops');
    }

//申請取り下げ
    public function delete(Request $request,int $expense_id){
        // urlから受け取ったidをパラメーターとしてDBから一件取得し、消去
            expense::where('id',$expense_id)->delete();
            return redirect()->route('tops');
    }
}
