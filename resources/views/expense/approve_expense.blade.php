@extends('common/header_side')

@section('approve_expense')
    @if(count($approve) === 0)
        <h3 class="approve_null">現在、承認待ちはありません。</h3> 
    @elseif(count($approve) >= 1)
        <table class="approve_table">
            <thead>
                <tr>
                <th class="name">名前</th>
                <th class="list_expense-date">日付</th>
                <th class="item">項目</th>
                <th class="amount">金額</th>
                <th class="payment-destination">支払い先</th>
                <th class="remarks">備考</th>
                <th class="edit"></th>
                <th class="status"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approve as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->target_date}}</td>
                        <!-- 1つ目のclassificationでExpenseテーブルのidを取得、2つ目のclassificationでidと紐付くClassificationテーブルのclassificationを取得する -->
                        <td>{{$value->classification->classification}}</td>
                        <td>{{ number_format($value->expense) }}円</td>
                        <td>{{$value->expelnation}}</td>
                        <td>{{$value->remarks}}</td>
                        <td><a href="/approval/{{$value->id}}" class="approval_button" onclick="return confirm('承認しますか？')"><button type="button">承認</button></a></td>
                        <td><a href="/remand/{{$value->id}}" class="approval_button" onclick="return confirm('差戻ししますか？')"><button type="button">差戻し</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection