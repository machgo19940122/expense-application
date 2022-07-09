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
        $request->session()->put('id', 1);
        $request->session()->put('role', 1);

        $m = (isset($_GET['m']))? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
        $y = (isset($_GET['y']))? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
        $d = (isset($_GET['d']))? htmlspecialchars($_GET['d'], ENT_QUOTES, 'utf-8') : '';

        if($m!=''||$y!=''||$d!=''){
            $dt = Carbon::createFromDate($y,$m,01);
        }else{
            $dt = Carbon::createFromDate();
        }


        
        //セッションを取得（id、権限）
        //$user_id = セッションから取得
        $user_id = $request->session()->get('id');
        $user = User::find($user_id);
        //権限チェック
        if($user->role == 1){
            //管理者の場合、全データ取得
            $tops = Top::orderBy('created_at', 'asc')->get();

            //金額を月ごとに取得
            
            $monthAmount = DB::table('expenses')
            ->selectRaw('SUM(expense) as sum_expense')
            ->whereMonth('target_date', $dt->format('m'))
            ->get();

            if(empty($monthAmount[0]->sum_expense)){
                $monthAmount[0]->sum_expense = 0;
            }



            //件数を取得

            $monthTotal = DB::table('expenses')
            ->selectRaw('COUNT(expense) as sum_expense')
            ->whereMonth('target_date', $dt->format('m'))
            ->get();

        }else{
            //一般の場合、ログイン者のデータのみ取得
            $tops = Top::Where("id","=",$user_id )->orderBy('created_at', 'asc')->get();

            // //金額を日付ごとに取得
            // $this->posts = new Top();
            // $expenses = $this->posts->getExpense();

            // //件数を取得
            // $this->posts = new Top();
            // $totalCounts = $this->posts->getCountExpense();
            

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
        $title .= '<a class="center" href="tops?y='.$todayY.'&&m='.$todayM.'">今月　</a>';
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
        
        for ($i = 1; $i <= $daysInMonth; $i++) {
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
           //if(データがない){
            if ($comp->eq($comp_now)) {
               //同じなので緑色の背景にする
                $calendar .= '<td class="day" style="background-color:#008b8b;">'.$dt->day.'</td>';
            }else{
                switch ($dt->format('N')) {
                    case 6:
                        $calendar .= '<td class="day" style="background-color:#b0e0e6">'.$dt->day.'</td>';
                        break;
                    case 7:
                        $calendar .= '<td class="day" style="background-color:#f08080">'.$dt->day.'</td>';
                        break;
                    default:
                        $calendar .= '<td class="day" >'.$dt->day.'</td>';
                        break;
                }
            }
        // }else{
        //     if ($comp->eq($comp_now)) {
        //         //同じなので緑色の背景にする
        //         $calendar .= '<td class="day" style="background-color:#008b8b;">'.$dt->day.'<br><a href="#">test</a></td>';
        //      }else{
        //          switch ($dt->format('N')) {
        //              case 6:
        //                  $calendar .= '<td class="day" style="background-color:#b0e0e6">'.$dt->day.'<br><a href="#">test</a></td>';
        //                  break;
        //              case 7:
        //                  $calendar .= '<td class="day" style="background-color:#f08080">'.$dt->day.'<br><a href="#">test</a></td>';
        //                  break;
        //              default:
        //                  $calendar .= '<td class="day" >'.$dt->day.'<br><a href="#">test</a></td>';
        //                  break;
        //          }
        //      }
        //}
    
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
        ]);

    
    }
}

