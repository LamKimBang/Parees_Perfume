@extends('layouts.user')

@section( 'content')
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#dob").datepicker();
    });
</script>
<tr>
            <td>Birthday</td>
            <td>
                <input type="text" name="birthday" class="dob" autocomplete="off">
            </td>
        </tr> -->

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Register</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Login Box Area =================-->
<!-- Quang -->
<section class="login_box_area section-margin mt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Already have an account?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="button button-account" href="{{asset('login')}}">Login Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner register_form_inner">
                    <h3>Create an account</h3>
                    <form class="row login_form" action="{{asset('register/insertUser')}}" id="register_form" method='post'>
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Fullname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fullname'" value="{{old('full_name')}}">
                        </div>
                        @error ('full_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <select name="gender" class="form-select">
                                @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error ('gender')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'" value="{{old('phone')}}">
                        </div>
                        @error ('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth (mm/dd/yyyy)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of Birth'" value="{{old('date_of_birth')}}">
                        </div>
                        @error ('date_of_birth')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" value="{{old('email')}}">
                        </div>
                        @error ('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="home_address" name="home_address" placeholder="Home Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Home Address'" value="{{old('home_address')}}">
                        </div>
                        @error ('home_address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Address'" value="{{old('company_address')}}">
                        </div>
                        @error ('company_address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" value="{{old('password')}}  ">
                        </div>
                        @error ('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" value="{{old('confirmPassword')}}">
                        </div>
                        @error ('confirmPassword')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-register w-100" name="btnInsert">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->

@endsection