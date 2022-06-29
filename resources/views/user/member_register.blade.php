@extends('common/header_side')

@section('content')
<script src="{{ asset('/js/user.js') }}"></script>


<div class="container">
    <div>
        <div class="col-md-8">
            <div>
                <div>Register</div>

                <div>
                    <form method="POST">


                         <div>
                            <label for="text" class="col-md-4">名前</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control">
                            </div>
                        </div>
                      
                        <div>
                            <label for="text" class="col-md-4">社員番号</label>
                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-md-4">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control">
                            </div>
                        </div>



                        <div>
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
