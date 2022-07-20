<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Top;
use App\Models\User;

 
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
        
        $m = (isset($_GET['m']))? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
        $y = (isset($_GET['y']))? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
        $d = (isset($_GET['d']))? htmlspecialchars($_GET['d'], ENT_QUOTES, 'utf-8') : '';

        if($m!=''||$y!=''||$d!=''){
            $dt = Carbon::createFromDate($y,$m,01);
        }else{
            $dt = Carbon::createFromDate();
        }

        //今月は何日まであるか
        $daysInMonth = $dt->daysInMonth;
        
        //セッションを取得（id、権限）
        //$user_id = セッションから取得
        $user_id = $request->session()->get('id');
        $user = User::find($user_id);

        //権限チェック
        if($user->role == 1 ){
            //管理者の場合、全データ取得
            $tops = Top::orderBy('created_at', 'asc')->get();
            
            //月の金額を取得
            
            $monthAmount = DB::table('expenses')
            ->selectRaw('SUM(expense) as sum_expense')
            ->whereYear('target_date', $dt->format('Y'))
            ->whereMonth('target_date', $dt->format('m'))
            ->where('status', 2)
            ->get();

            if(empty($monthAmount[0]->sum_expense)){
                $monthAmount[0]->sum_expense = 0;
            }
            //月の件数を取得

            $monthTotal = DB::table('expenses')
            ->selectRaw('COUNT(expense) as sum_expense')
            ->whereYear('target_date', $dt->format('Y'))
            ->whereMonth('target_date', $dt->format('m'))
            ->where('status', 2)
            ->get();

            //日別の合計金額を取得
            for($i=1; $i <= $daysInMonth; $i++){
                $dayAmounts[$i] = DB::table('expenses')
                ->select('target_date')
                ->selectRaw('SUM(expense) as sum_expense')
                ->groupBy('target_date')
                ->whereYear('target_date', $dt->format('Y'))
                ->whereMonth('target_date', $dt->format('m'))
                ->whereDay('target_date', $i)
                ->where('status', 2)
                ->first();
                if($dayAmounts[$i] == null){
                    $sc = new \stdClass();
                    $sc->sum_expense = 0;
                    $sc->target_date = $dt->format('Y-m-').$i;
                    $dayAmounts[$i] = $sc;
                }
            }

            //日別の件数を取得
            for($i=1; $i <= $daysInMonth; $i++){
                $dayTotals[$i] = DB::table('expenses')
                ->select('target_date')
                ->selectRaw('COUNT(expense) as sum_expense')
                ->groupBy('target_date')
                ->whereYear('target_date', $dt->format('Y'))
                ->whereMonth('target_date', $dt->format('m'))
                ->whereDay('target_date', $i)
                ->where('status', 2)
                ->first();
                if($dayTotals[$i] == null){
                    $sc = new \stdClass();
                    $sc->sum_expense = 0;
                    $sc->target_date = $dt->format('Y-m-').$i;
                    $dayTotals[$i] = $sc;
                }
            }
            


        }else{
            if($user->role == 0 )
            //一般の場合、ログイン者のデータのみ取得
            $tops = Top::Where("id","=",$user_id )->orderBy('created_at', 'asc')->get();

            // //金額を日付ごとに取得
            for($i=1; $i <= $daysInMonth; $i++){
                $dayAmounts[$i] = DB::table('expenses')
                ->select('target_date')
                ->selectRaw('SUM(expense) as sum_expense')
                ->groupBy('target_date')
                ->whereYear('target_date', $dt->format('Y'))
                ->whereMonth('target_date', $dt->format('m'))
                ->whereDay('target_date', $i)
                ->first();
                if($dayAmounts[$i] == null){
                    $sc = new \stdClass();
                    $sc->sum_expense = 0;
                    $sc->target_date = $dt->format('Y-m-').$i;
                    $dayAmounts[$i] = $sc;
                }
            }
            // //件数を取得
            for($i=1; $i <= $daysInMonth; $i++){
                $dayTotals[$i] = DB::table('expenses')
                ->select('target_date')
                ->selectRaw('COUNT(expense) as sum_expense')
                ->groupBy('target_date')
                ->whereYear('target_date', $dt->format('Y'))
                ->whereMonth('target_date', $dt->format('m'))
                ->whereDay('target_date', $i)
                ->first();
                if($dayTotals[$i] == null){
                    $sc = new \stdClass();
                    $sc->sum_expense = 0;
                    $sc->target_date = $dt->format('Y-m-').$i;
                    $dayTotals[$i] = $sc;
                }
            }
            

        }    

        $dt->startOfMonth(); //今月の最初の日
        $dt->timezone = 'Asia/Tokyo'; //日本時刻で表示
    
        //１ヶ月前
        $sub = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
        $subMonth = $sub->subMonth();
        $subY = $subMonth->year;
        $subM = $subMonth->month;
    
        //1ヶ月後
        $add = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
        $addMonth = $add->addMonth();
        $addY = $addMonth->year;
        $addM = $addMonth->month; 
    
        //今月
        $today = Carbon::createFromDate();
        $todayY = $today->year;
        $todayM = $today->month;
    
        //リンク
        
        $title = '<h4>'.$dt->format('Y年m月').'</h4>';//月と年を表示
        $title .= '<div class="month"><caption><a class="left" href="tops?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
        $title .= '<a class="center" href="tops?y='.$todayY.'&&m='.$todayM.'">今月  </a>';
        $title .= '<a class="right" href="tops?y='.$addY.'&&m='.$addM.'"> 来月>></a></caption></div>';//来月リンク
        
        //曜日の配列作成
        $headings = ['日','月','火','水','木','金','土'];
    
        $calendar = '<table class="calendar-table">';
        $calendar .= '<thead >';
        foreach($headings as $heading){
            $calendar .= '<th class="header">'.$heading.'</th>';
        }
        $calendar .= '</thead>';
        $calendar .= '<tbody><tr>';

        //今月は何日まであるか
        $daysInMonth = $dt->daysInMonth;

        // dd($dayAmounts);


        for ($i = 1; $i <= $daysInMonth; $i++) {
            // dd($dayAmounts);
            if($i==1){
                if ($dt->format('N')!= 7) {
                    $calendar .= '<td colspan="'.($dt->format('N')).'"></td>'; //1日が日曜じゃない場合はcolspanでその分あける        
                }
            }
    
            if($dt->format('N') == 7){
                $calendar .= '</tr><tr>'; //日曜日だったら改行
            }
            
            $comp = new Carbon($dt->year."-".$dt->month."-".$dt->day); //ループで表示している日
            $comp_now = Carbon::today(); //今日    
           //ループの日と今日を比較
            if ($comp->eq($comp_now)) {
               //同じなので緑色の背景にする
                if ($dayTotals[$i]->sum_expense == 0) {
                    $calendar .= '<td class="day" style="background-color:#008b8b;">'.$dt->day.'</td>';
                }else{
                    $calendar .= '<td class="day" style="background-color:#008b8b;">'.$dt->day.'<br><a href="/list_expense"><span>'.$dayTotals[$i]->sum_expense.'件<br>'.$dayAmounts[$i]->sum_expense.'円</span></a></td>';
                }
            }else{
                switch ($dt->format('N')) {
                    case 6:
                        if ($dayTotals[$i]->sum_expense == 0){
                            $calendar .= '<td class="day" style="background-color:#b0e0e6">'.$dt->day.'</td>';
                        }else{
                            $calendar .= '<td class="day" style="background-color:#b0e0e6">'.$dt->day.'<br><a href="/list_expense"><span>'.$dayTotals[$i]->sum_expense.'件<br>'.$dayAmounts[$i]->sum_expense.'円</span></a></td>';
                        }
                        break;
                    case 7:
                        if ($dayTotals[$i]->sum_expense == 0){
                            $calendar .= '<td class="day" style="background-color:#f08080">'.$dt->day.'</td>';
                        }else{
                            $calendar .= '<td class="day" style="background-color:#f08080">'.$dt->day.'<br><a href="/list_expense"><span>'.$dayTotals[$i]->sum_expense.'件<br>'.$dayAmounts[$i]->sum_expense.'円</span></a></td>';
                        }
                        break;
                    default:
                        if ($dayTotals[$i]->sum_expense == 0){
                            $calendar .= '<td class="day" >'.$dt->day.'</td>';
                        }else{
                            $calendar .= '<td class="day" >'.$dt->day.'<br><a href="/list_expense"><span>'.$dayTotals[$i]->sum_expense.'件<br>'.$dayAmounts[$i]->sum_expense.'円</span></a></td>';
                        }
                        break;
                }
            }    
            $dt->addDay();
        }

    
        $calendar .= '</tr></tbody>';
        $calendar .= '</table>';
    

        $tops = Top::orderBy('created_at', 'asc')->get();
        return view('tops.index', [
            'tops' => $tops,
            'calendar' => $title.$calendar,
            'monthAmount' => $monthAmount,
            'monthTotal' => $monthTotal,
            'dayAmounts' => $dayAmounts,
            'dayTotals' => $dayTotals,
            'i' => $i,
        ]);

    
    }
}

