@extends('common/header_side')

@section('content')

<div class="container">
    <div>
      
        <nav>
          <div>申請内容編集</div>
            <form method="POST">

              <div class="form-group">
                <label for="title" >項目</label>
                <select name="category" id="category" class="form-control">
                  <option value="option1">交際費</option>
                  <option value="option2">旅費</option>
                  <option value="option3">その他</option>
                </select>
              </div>

              <div class="form-group">
                <label for="explanation">説明</label>
                <input type="text" class="form-control" name="explanation" id="explanation">
              </div>


              <div class="form-group">
                <label for="title">金額</label>
                <input type="text" class="form-control" name="amount" id="amount">
              </div>

              <div class="form-group">
                <label for="date">使用日</label>
                <input type="date" class="form-control" name="target_date" id="target_date">
              </div>

              <div class="form-group">
                <label for="date">備考欄</label>
                <input type="text" class="form-control" name="remarks" id="remarks">
              </div>



              <div class="btn-toolbar">
                <div class="btn-group">
                            <button class="btn btn-primary">キャンセル</button>
                            <button type="submit" class="btn btn-primary">取りやめ</button>
                            <button type="submit" class="btn btn-primary">更新</button>
                </div>   
            </div>
              
            </form>
          </div>
        </nav>
    
    </div>
  </div>
@endsection

