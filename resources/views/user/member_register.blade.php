@extends('common/header_side')

@section('content')


<div class="container">
    <div>
        <div class="col-md-8">
            <div>
                <div>Register</div>

                <div>
                    <form method="POST" action="{{ route('postsignup') }}" >


                         <div>
                            <label for="text" class="col-md-4">名前</label>
                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                        </div>
                      
                        <div>
                            <label for="text" class="col-md-4">社員区分</label>
                            <div class="col-md-6">
                                <select id="role" type="text" class="form-control" name="role">
                                    <option value="0">一般社員</option>
                                    <option value="1">管理者</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-md-4">Password</label>

                            <div class="col-md-6">
                                <input id="textPassword" type="password" class="form-control" name="password">
                                <span id="buttonEye" class="fa fa-eye"></span>
                            </div>
                        </div>



                        <div>
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                {{ csrf_field() }}
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
