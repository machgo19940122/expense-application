@extends('common/header_side')

@section('content')

 <!-- バリデーションエラーメッセージ-->
@if ($errors->any())
    <div class="alert alert-info">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <!-- フラッシュメッセージ 承認済みの申請は編集できません-->
 <script>
            @if (session('flash_message2'))
                $(function () {
                        toastr.warning('{{ session('flash_message2') }}');
                });
            @endif
</script>

<div class="container">
    <div>
      
        <nav>
          <div>申請内容編集</div>
            <form method="POST" action="{{ route('edit', ['expense_id' => $expense->id,]) }}">
          
              <div class="form-group">
                <label for="date">使用日</label>
                <input type="date" class="form-control" name="target_date" id="target_date" value="{{$expense->target_date}}">
              </div>

              <div class="form-group">
                <label for="title">金額</label>
                <input type="text" class="form-control" name="expense" id="expense" value="{{$expense->expense }}" maxlength="10">
              </div>

              <div class="form-group">
                <label for="title" >項目</label>
                <select name="classification_id" id="category" class="form-control">
                  @foreach($classifications as $classification)
                   <option value="{{$classification->id}}" 
                   @if($classification->id === (int)$expense->classification_id) selected @endif >
                    {{$classification->id." : ".$classification->classification}}</option>
                  @endforeach
                </select>
              </div>


              <div class="form-group">
                <label for="title" >ステータス</label>
                <select name="status" id="status" class="form-control" disabled>
                  @foreach($status as $key => $val)
                  <option value="{{$key}}" 
                  @if($key === (int)$expense->status) selected @endif>{{$val}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="explanation">説明</label>
                <input type="text" class="form-control" name="expelnation" id="explanation" value="{{$expense->expelnation}}" maxlength="30">
              </div>

              <div class="form-group">
                <label for="date">備考欄</label>
                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$expense->remarks }}" maxlength="30">
              </div>


              @csrf 
              <div class="btn-toolbar">
                <div class="btn-group">
                            <button type="submit" class="btn btn-primary">更新</button>
                </div>   
                          
            
      </form>
                          <form action="{{route('tops')}}">
                               <button class="btn btn-primary">編集キャンセル</button>
                          </form>
                         

                            <form action="{{ route('delete', ['expense_id' => $expense->id])}}" method="POST">
                            @csrf 
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-primary" onClick="delete_alert(event);return false;">申請取り下げ</button></form>
                 
             </div>
          </div>
        </nav>
    
    </div>
  </div>
  <script src="{{ asset('/js/expense.js') }}"></script>
@endsection

