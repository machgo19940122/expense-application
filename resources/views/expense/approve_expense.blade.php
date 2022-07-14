@extends('common/header_side')

@section('approve_expense')
    @if(count($approve) === 0)
        <h3 class="approve_null">現在、承認待ちはありません。</h3> 
    @elseif(count($approve) >= 1)
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
                @foreach ($approve as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->target_date}}</td>
                        <!-- 1つ目のclassificationでExpenseテーブルのidを取得、2つ目のclassificationでidと紐付くClassificationテーブルのclassificationを取得する -->
                        <td>{{$value->classification->classification}}</td>
                        <td>{{ number_format($value->expense) }}円</td>
                        <td>{{$value->expelnation}}</td>
                        <td>{{$value->remarks}}</td>
                        <td><a href="/approval/{{$value->id}}" class="approval_button"><button type="button">承認</button></a></td>
                        <td><a href="/remand/{{$value->id}}" class="approval_button"><button type="button">差戻し</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection