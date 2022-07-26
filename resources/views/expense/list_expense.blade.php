@extends('common/header_side')

@section('list_expense')

    <form action="{{url('list_date_form')}}" method="POST" class="mb-3" id="form_item">
        @csrf
        <select name="year_drop" id="year_drop">
            @for($y=2010; $y<=2030; $y++)
                @if($y == $carbon->year)
                    <option value="{{ $y }}" selected>{{$y}}年</option>
                @else
                    <option value="{{ $y }}">{{$y}}年</option>
                @endif
            @endfor
        </select>

        <select name="month_drop" id="month_drop">
            @for($m=1; $m<=12; $m++)
                @if($m == $carbon->month)
                    <option value="{{ $m }}" selected>{{$m}}月</option>
                @else
                    <option value="{{ $m }}" >{{$m}}月</option>
                @endif
            @endfor
        </select>

        <select name="day_drop" id="day_drop">
            @for($d=1; $d<=31; $d++)
                @if($d == $carbon->day)
                    <option value="{{ $d }}" selected>{{$d}}日</option>
                @else
                    <option value="{{ $d }}" >{{$d}}日</option>
                @endif
            @endfor
        </select>
        <button type="submit">検索</button>
    </form>

    <!-- 日付のドロップダウンで年月を指定したときに日付が変わるjavascript追加（year_drop,month_dropを取得するためにformの後に書いた） -->
    <script>
        /**
         * @brief 月の日数を返却します。
         *
         * @param [in] year 年
         * @param [in] month 月
         * @return 月の日数
         */
        function getLastDate(year, month) {
            return new Date(year, month, 0).getDate();
        }
        // トリガーになる要素を取得
        const year_date = document.getElementById('year_drop'); 
        const month_date = document.getElementById('month_drop'); 
        // getLastDate関数で取得した日数より大きい日付を見えなくする
        function changeDay(){
            const options = document.querySelectorAll('#day_drop > option')
            const lastdate = getLastDate (year_date.value, month_date.value)
            for(let i = 28; i <= lastdate; i++){
                options[i-1].style.display = 'block';
            }
            for(let i = lastdate+1; i <= 31; i++){
                options[i-1].style.display = 'none';
            }
        }
        // 年月をドロップダウンで変更すると日付が変更されるイベント実装
        year_date.addEventListener('change',changeDay);
        month_date.addEventListener('change',changeDay);
    </script>

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