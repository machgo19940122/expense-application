@extends('common/header_side')

@section('content')
<script src="{{ asset('/js/user.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <div>Login</div>
                <div>
                    <form method="POST">
                        <div>
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Adress</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"name="email" required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary col-md-3">
                                  Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
