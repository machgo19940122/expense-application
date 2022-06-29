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
        <!-- //TODO:if文でsession情報を取得し、名前、社員番号を表示。 else ログインと会員登録ボタンを表示-->
        <span class="my-navbar-item">名前</span>
        <span class="my-navbar-item">社員番号</span>
        <a class="my-navbar-item" href="/login">ログイン</a></span>
        <a class="my-navbar-item" href="/register">新規登録</a></span>
  
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
          <li><a href="/login">ログアウト</a></li>
        </ul>
  </div>
  
    <div class="main_content">
    @yield('content')
    </div>
</main>


</body>
</html>