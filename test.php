<?php
use Carbon\Carbon;

$m = (isset($_GET['m']))? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
$y = (isset($_GET['y']))? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
if($m!=''||$y!=''){
    $dt = Carbon::createFromDate($y,$m,01);
}else{
    $dt = Carbon::createFromDate();
}

function renderCalendar($dt)
{   
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
    $title = '<h4>'.$dt->format('Y年m月d日').'</h4>';//月と年を表示
    $title .= '<div class="month"><caption><a class="left" href="tops?y='.$todayY.'&&m='.$todayM.'">今月　</a>';
    $title .= '<a class="left" href="tops?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
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
        $dt->addDay();
    }

    $calendar .= '</tr></tbody>';
    $calendar .= '</table>';

    return $title.$calendar;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php echo renderCalendar($dt); ?>
<link rel="stylesheet" href="team95\public\css\style.css">

</head>

</html>