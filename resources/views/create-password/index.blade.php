@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Create Password</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Login create password =================-->
<section class="login_box_area section-margin mt-0">
    <div class="container">
        <div class="row form-group">
            <div class="col-md-12 col-centered">
                <form class="login_form" action="{{asset('create-password/post-create')}}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group text-center">
                            <h2>Create Password</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group">
                            @if($message = Session::get('error'))
                            <h4 class="alert alert-danger">{{$message}}</h4>
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{old('phone')}}">
                            @error ('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                            @error ('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group">
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password" value="{{old('confirmPassword')}}">
                            @error ('confirmPassword')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group">
                            <button type="submit" value="submit" class="button button-login w-100" id="btn-login">Create Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================End create password =================-->
@endsection