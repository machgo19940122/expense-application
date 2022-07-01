@extends('common/header_side')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <div>Login</div>
                <div>
                    <form method="POST">
                        <div>
                            <label class="col-md-4 col-form-label text-md-end">Email Adress</label>
                            <div class="col-md-6">
                                <input id="email" name="email" type="email" class="form-control" required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="input_color" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="textPassword"  value="" type="password" class="form-control">
                                <span id="buttonEye" class="fa fa-eye"></span>

                            </div>
                        </div>
                        <div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary col-md-3">Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/user.js') }}"></script>

@endsection
