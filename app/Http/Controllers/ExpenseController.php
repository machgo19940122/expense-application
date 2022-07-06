<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\expense;
use App\Models\Classification;
use DB;
class ExpenseController extends Controller
{

//編集画面の表示 
    public function getedit (int $id)
{
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
