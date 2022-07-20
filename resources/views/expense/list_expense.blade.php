@extends('common/header_side')

@section('list_expense')
    <select name="year_drop" id="">
        @for($y=2010; $y<=2030; $y++)
            @if($y == 2022)
                <option value="{{ $y }}" selected>{{$y}}年</option>
            @else
                <option value="{{ $y }}">{{$y}}年</option>
            @endif
        @endfor
    </select>

    <select name="month_drop" id="">
        @for($m=1; $m<=12; $m++)
            @if($m == 7)
                <option value="{{ $m }}" selected>{{$m}}月</option>
            @else
                <option value="{{ $m }}" >{{$m}}月</option>
            @endif
        @endfor
    </select>

    <select name="day_drop" id="">
        @for($d=1; $d<=31; $d++)
            @if($d == 20)
                <option value="{{ $d }}" selected>{{$d}}月</option>
            @else
                <option value="{{ $d }}" >{{$d}}月</option>
            @endif
        @endfor
    </select>

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
            <tr @if($value->status == 1) class="recode" @endif>
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
                    @elseif($value->status == 2)
                        済
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="list_total">{{$count}} 件  合計 {{ number_format($total) }}円</div>




@endsection