@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Login</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin mt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="button button-account" href="{{asset('register')}}">Create an Account</a>
                        <br>
                        <br>
                        <p class="font-italic mt-2">If you have ever purchased goods on the Website before, you can use the
                            <a href="{{asset('create-password')}}" class="link-hover">"Change password"</a> feature to be able to access your account with your phone.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Quang -->
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>

                    <form class="row login_form" action="{{asset('login/postLogin')}}" id="contactForm" method="post">
                        @csrf
                        <div class="col-md-12 form-group">
                            @if($message = Session::get('error'))
                            <h4 class="alert alert-danger">{{$message}}</h4>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-login w-100" id="btn-login">Log In</button>
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection

@section('js')
<!-- <script>
    $('#btn-login').click(function(e) {
        e.preventDefault();
        var _csrf = '{{csrf_token()}}';
        var _loginUrl = '{{asset("ajax/login")}}';
        var username = $('#username').val();
        var password = $('#password').val();
        $.ajax({
            url: _loginUrl,
            type: 'POST',
            data: {
                username: username,
                password: password,
                _token: _csrf
            },
            success: function(res) {
                console.log(res);
            }
        });

    });
</script> -->
@stop()