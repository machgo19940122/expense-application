@extends('common/header_side')

@section('list_expense')
    <table class="approve_table">
        <thead>
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
        </thead>
        <tbody>
            @foreach ($list as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->target_date}}</td>
                <!-- 1つ目のclassificationでExpenseテーブルのidを取得、2つ目のclassificationでidと紐付くClassificationテーブルのclassificationを取得する -->
                <td>{{$value->classification->classification}}</td>
                <td>{{ number_format($value->expense) }}円</td>
                <td>{{$value->expelnation}}</td>
                <td>{{$value->remarks}}</td>
                <td><a href="/edit_expense/{{$value->id}}" class="approval_button"><button type="button">編集</button></a></td>
                <td>@if($value->status == 0)
                        未
                    @elseif($value->status == 1)
                        戻
                    @else($value->status == 2)
                        済
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>




@endsection