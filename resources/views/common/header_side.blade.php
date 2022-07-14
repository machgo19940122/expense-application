<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>経費管理APP</title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
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
        <span class="my-navbar-item">こんにちは---さん!</span>
       
        
       @endif
    </div>
  </nav>
  </header>

  <main>  
    <div class="side" id="side_bar">  
        <ul class="nav nav-stacked">
        <li><a href="/">TOP</a></li>
          <li ><a href="#">経費登録</a></li>
          <li><a href="#">申請一覧</a></li>
          <li><a href="#">経費承認</a></li>
          <li><form  action="{{ route('logout') }}"method="GET">
            <a href="/logout" id="logout">ログアウト</a></form></li>
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