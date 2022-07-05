@extends('common/header_side')

@section('apply_expense')

    <div class="main">
        <form action="/apply_expense_form" method="POST" class="mb-3" id="form_item">
            @csrf
            <div class="flex">
                <label for="Input1" class="form-label">年月日</label>
                <input type="date" class="form-control" id="Input1" name="target_date" required>
                <label for="Input" class="form-label">項目</label>
                <select>
                @foreach($classification as $value)
                    <option value="{{ $value['id'] }}" name='classification'>{{$value['classification']}}</option>
                @endforeach
                </select>

                <label for="Input2" class="form-label">金額</label>
                <input type="number" class="form-control" id="Input2" name="expense" required>  
            </div>  
            <label for="Input3" class="form-label">支払い先</label>
            <input type="text" class="form-control" id="Input3" placeholder="30文字まで(◯◯タクシーなど)" maxlength='30' name="expelnation" required> 
            <label for="Input4" class="form-label">備考</label>
            <input type="text" class="form-control" id="Input4" placeholder="30文字まで(交通費としてなど)" maxlength='30' name="remarks" required>   
            <div class="flex">
            <button type="submit" name="cancel">キャンセル</button>
            <button type="submit" name="application">申請</button> 
        </form>
    </div>

@endsection