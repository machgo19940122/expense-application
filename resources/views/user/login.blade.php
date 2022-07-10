@extends('common/header_side')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <div>Login</div>

                    @if(isset($login_error))
                    <div class="alert alert-warning text-sm" role="alert">
                            ログインに失敗しました。メールアドレス、パスワードが正しいかご確認ください。
                    </div>
                    @endif
                    
                <div>
                    <form method="POST" action="{{ route('signin') }}" >
                        <div>
                            <label class="col-md-4 col-form-label text-md-end">社員番号</label>
                            <div class="col-md-6">
                                <input id="id" name="id" type="text" name="id" class="form-control" required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="input_color" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="textPassword"  value="" type="password" class="form-control" name="password">
                                <span id="buttonEye" class="fa fa-eye"></span>

                            </div>
                        </div>
                        <div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary col-md-3">Login
                                </button>
                            </div>
                            {{ csrf_field() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/user.js') }}"></script>

@endsection
