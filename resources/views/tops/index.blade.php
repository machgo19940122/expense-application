<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

</head>
<body>
    {!! $calendar !!}
    <div class="total-data">合計 {{ $monthTotal[0]->sum_expense }} 件 {{ $monthAmount[0]->sum_expense }} 円</div>
    <div>合計 {{ $dayAmount[0]->sum_expense }}</div>

    </tbody>
</table>
</body>
</html>