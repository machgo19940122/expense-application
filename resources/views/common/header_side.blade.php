<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>経費管理APP</title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  <!-- フラッシュメッセージCSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">経費管理app(仮）</a>
      <div class="my-navbar-control">
        @if(!Session::has('id'))
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        @else
        <span class="my-navbar-item">社員番号:{{session('id')}}/名前:{{session('name')}}</span>
        @endif
      </div>
    </nav>
  </header>

  <main>  
    <div class="side" id="side_bar">  
        <ul class="nav nav-stacked">
                <li><a href="/tops">TOP</a></li>
                <li ><a href="/apply_expense">経費登録</a></li>
                <li><a href="/list_expense">申請一覧</a></li>
                @if(session('role')===1)
                  <li><a href="/approve_expense">経費承認 <span class="badge rounded-pill bg-primary">{{$count_approval}}件</span></a></button></li>
                @endif
                <li><a href="/edit_member/{{session('id')}}">会員情報変更</a></li>
                <li><a href="/logout"><form  action="{{ route('logout') }}"method="GET">ログアウト</form></a></li>
        </ul>
    </div>
  
    <div class="main_content">
      @yield('content')
      @yield('apply_expense')
      @yield('approve_expense')
      @yield('list_expense')
    </div>
  </main>


</body>

</html>