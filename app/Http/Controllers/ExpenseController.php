<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Classification;
use App\Models\User;
use DB;
use Session;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    // 申請一覧画面

    // 申請一覧画面の表示(サイドバーから遷移してきた時)
    public function list_expense1(Request $request){
        $carbon = new Carbon();

        $role = $request->session()->get('role');
        if($role == 1){
            // 画面を表示しようとする人が管理者ならばExpenseテーブルのレコードを全て取得する
            $list = Expense::whereYear('target_date',$carbon->year)
                ->whereMonth('target_date',$carbon->month)
                ->orderBy('target_date', 'asc')
                ->get();
        }else{
            // 画面を表示しようとする人が一般従業員なら自分だけのテーブルを取得
            $list = Expense::where('user_id','=',$request->session()->get('id'))
                ->whereYear('target_date', $carbon->year)
                ->wheremonth('target_date', $carbon->month)
                ->orderBy('target_date', 'asc')
                ->get();
        }

        //　下部の件数、合計金額取得
        $count = $list->count();
        $total = $list->sum('expense');

        return view('expense.list_expense')->with([
            'list' => $list,
            'count' => $count,
            'total' => $total,
            'carbon_month' => $carbon->month,
        ]);
    }

    // 申請一覧画面の表示(top画面の日付から遷移してきた時)
    public function list_expense2(Request $request ,$target_date){
        $carbon = new Carbon();

        $role = $request->session()->get('role');
        if($role == 1){
            // 画面を表示しようとする人が管理者ならばExpenseテーブルのレコードを全て取得する
            $list = Expense::whereYear('target_date', $carbon->year)
                ->whereMonth('target_date',$carbon->month)
                ->whereday('target_date', $target_date)
                ->orderBy('target_date', 'asc')
                ->get();
        }else{
            // 画面を表示しようとする人が一般従業員なら自分だけのテーブルを取得
            $list = Expense::where('user_id','=',$user_id)
                ->whereYear('target_date', $carbon->year)
                ->whereMonth('target_date',$carbon->month)
                ->whereday('target_date', $target_date)
                ->orderBy('target_date', 'asc')
                ->get();     
        }

        //　下部の件数、合計金額取得
        $count = $list->count();
        $total = $list->sum('expense');

        return view('expense.list_expense')->with([
            'list' => $list,
            'count' => $count,
            'total' => $total,
        ]);
    }



    // 経費登録画面

    // 経費登録画面を表示
    public function apply_expense(){
        // 申請登録画面の項目のドロップダウンにclassificationテーブルからデータを取得し表示する
        $classification = Classification::all();
        return view('expense/apply_expense')->with([
            'classification' => $classification,
        ]);
    }

    // 経費申請画面の入力フォームに入力した情報を処理
    public function apply_expense_form(Request $request){
        if($request -> has('cancel')){
             // キャンセルボタンを押した場合 -> 入力内容を無視してtop画面に遷移
            redirect('tops.index');
        }elseif($request -> has('application')){
            // 申請ボタンを押した場合 -> 入力者の名前と紐づき、申請一覧画面にデータを送りトップ画面に遷移
            $user = User :: where('id', '=', session()->get("id"))->first();

            // 申請された経費をレコードに追加
            $expense = new Expense();
            $expense->user_id = $user -> id;
            $expense->name = $user->name;
            $expense->target_date = $request->target_date;
            $expense->expense = $request->expense;
            $expense->classification_id = $request->classification;
            $expense->expelnation = $request->expelnation;
            $expense->remarks = $request->remarks;

            if($request->expense >= config('const.expense_border.border')){
                // 申請された金額が1万円以上なら『未承認』のstatusを付与する
                $expense->status = config('const.expense_status.misyonin');
            }else{
                // 申請された金額が9999円以下なら『承認』のstatusを付与する
                $expense->status = config('const.expense_status2.syonin');
            }

            $expense->save();

            return redirect('/tops');  
        }
    }

    // 経費承認画面（管理者の画面）

    // 経費承認画面を表示
    public function approve_expense(){
        // Expenseテーブルからstutasが『未承認』のものを取得する
        $approve = Expense::where('status', '=', config('const.expense_status.misyonin'))
            -> orderBy('target_date', 'asc')->get();

        return view('expense.approve_expense')->with([
            'approve' => $approve,
        ]);
    }

    // 経費承認画面にて管理者が承認ボタンを押した時の処理
    public function approval(Request $request){
        $approval = Expense::where('id', '=', $request->id)->first();
        // statusを0（未承認）から2（承認）に変更する
        $approval->status = config('const.expense_status2.syonin');
        $approval->save();
        return redirect('/approve_expense'); 
    }

    // 経費承認画面にて管理者が差戻しボタンを押した時の処理
    public function remand(Request $request){
        $approval = Expense::where('id', '=', $request->id)->first();
        // statusを0（未承認）から1（差戻し）に変更する
        $approval->status = config('const.expense_status3.remand');
        $approval->save();
        return redirect('/approve_expense'); 
    }




    //編集画面の表示 
    public function getedit (int $id){
      $classifications = Classification::all();
      $expense = expense::find($id);
      $status = [
                "0"=>"未承認",
                "1"=>"差し戻し",
                "2"=>"承認済み", 
      ];

      return view('expense/edit_expense', [
        'classifications' => $classifications,
        'expense'=>$expense,
        'status'=>$status,
      ]);

      $expense = expense::find($expense_id);
    }





    //申請内容編集
    public function edit(int $expense_id, request $request)
    {
        // urlから受け取ったidをパラメーターとしてDBから一件取得
        $expense = expense::find($expense_id);

        if($expense->status === 2){
            Session::flash('flash_message2', '承認済みの申請は編集できません');
            return redirect()->route('edit',$expense_id);
        }
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


