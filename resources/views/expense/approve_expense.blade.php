@extends('common/header_side')

@section('approve_expense')
<div class="main">
    <table class="approve_table">
        <tr>
            <th>名前</th>
            <th>日付</th>
            <th>項目</th>
            <th>金額</th>
            <th>支払い先</th>
            <th>備考</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($approve as $value)
        <tr>
            <td>{{$value->name}}</td>
            <td>{{$value->target_date}}</td>
            <td>{{$value->classification_id}}</td>
            <td>{{$value->expense}}</td>
            <td>{{$value->expelnation}}</td>
            <td>{{$value->remarks}}</td>
            <td><a href="/approval" class="approval_button"><button type="button">承認</button></a></td>
            <td><a href="/remand" class="approval_button"><button type="button">差戻し</button></a></td>
        </tr>
    @endforeach
    </table>
</div>


@endsection