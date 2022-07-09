@extends('common/header_side')

@section('content')


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
                <input type="text" class="form-control" name="expense" id="expense" value="{{$expense->expense }}">
              </div>

              <div class="form-group">
                <label for="title" >項目</label>
                <select name="classification_id" id="category" class="form-control" selected="{{$expense->classification_id}}">
                  @foreach($classifications as $classification)
                  <option value="{{$classification->id}}">{{$classification->classification}}</option>
                  @endforeach
                 
                </select>
              </div>

              <div class="form-group">
                <label for="explanation">説明</label>
                <input type="text" class="form-control" name="expelnation" id="explanation" value="{{$expense->expelnation}}">
              </div>

              <div class="form-group">
                <label for="date">備考欄</label>
                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$expense->remarks }}">
              </div>


              @csrf 
              <div class="btn-toolbar">
                <div class="btn-group">
                            <button type="submit" class="btn btn-primary">更新</button>
                </div>   
            
      </form>
                  <button class="btn btn-primary">更新キャンセル</button>
                            
                            <form action="{{ route('delete', ['expense_id' => $expense->id])}}" method="POST">
                            @csrf 
                            {{ method_field('DELETE') }}
                   <button type="submit" class="btn btn-primary">申請取り下げ</button></form>
                 
             </div>
          </div>
        </nav>
    
    </div>
  </div>
@endsection

