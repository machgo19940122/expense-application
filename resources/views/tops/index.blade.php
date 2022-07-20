
<!DOCTYPE html>
<html>
<head>
    @extends('common/header_side') 
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

</head>
<body>
    {!! $calendar !!}
    <div class="total-data">合計 {{ $monthTotal[0]->sum_expense }} 件 {{ $monthAmount[0]->sum_expense }} 円</div>


    </tbody>
</table>
</body>
</html>