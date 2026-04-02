@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Account Infor</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<section class="checkout_area section-margin--small mt-0">
    <div class="container">
        <!-- content -->
        <div class="container-fluid">
            <div class="row">
                <!-- Category left begin -->
                <div class="col-xs-12 col-sm-12 col-lg-3">
                    <div class="row form-group">
                        <div class="col-sm-12 text-success text-center">
                            <label class="font-weight-bold h5"> Member</label>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action active" href="{{asset('user/account-info')}}">
                                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp; Account Infor</a>
                                <a class="list-group-item list-group-item-action" href="{{asset('user/order-history')}}">
                                    <i class="fas fa-clipboard"></i>&nbsp;&nbsp;&nbsp; Order History</a>
                                <a class="list-group-item list-group-item-action" href="{{asset('user/reviews')}}">
                                    <i class="fas fa-comment-dots"></i>&nbsp;&nbsp;&nbsp; Reviews</a>
                                <a href="{{asset('login/getLogout')}}" id="a-logout" class="list-group-item list-group-item-action cursor-pointer">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp; Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Category left end -->

                <!-- list order begin -->
                <div class="col-xs-12 col-sm-12 col-lg-9">
                    <div class="row form-group">
                        <div class="col-sm-12 h4 text-primary">
                            <label class="font-weight-bold h5">Account Information</label>
                        </div>
                    </div>
                    <form action="{{asset('user/account-info/update')}}" method="POST">
                        @csrf
                        <div class="card bg-primary bg-light pt-3">
                            <!--  begin -->
                            <div class="col-xs-12 col-sm-12 col-lg-9">
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Full Name</label>
                                    <div class="col-md-8">
                                        <input id="inp-full-name" name="full_name" type="text" class="form-control height-form-control rounded-0" placeholder="Full Name" value="{{$user->full_name}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Phone</label>
                                    <div class="col-md-8">
                                        <input id="inp-phone" name="phone" type="text" class="form-control height-form-control rounded-0" placeholder="Phone" value="{{$user->phone}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Date of Birth</label>
                                    <div class="col-md-8">
                                        <input id="inp-phone" name="date_of_birth" type="text" class="form-control height-form-control rounded-0" placeholder="Phone" value="{{DateTime::createFromFormat('Y-m-d', $user->date_of_birth)->format('m/d/Y')}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input id="inp-email" name="email" type="email" class="form-control height-form-control rounded-0" placeholder="Email" value="{{$user->email}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Home Address</label>
                                    <div class="col-md-8">
                                        <input id="inp-address" name="home_address" type="text" class="form-control height-form-control rounded-0" placeholder="Home Address" value="{{$user->home_address}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label">Company Address</label>
                                    <div class="col-md-8">
                                        <input id="inp-company-address" name="company_address" type="text" class="form-control height-form-control rounded-0" placeholder="Company Address" value="{{$user->company_address}}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Gender</label>

                                    <div class="col-sm-8 form-group">
                                        <select name="gender" class="form-select height-form-control rounded-0">
                                            @foreach($genders as $gender)
                                            <option value="{{$gender->id}}" @if($gender->id == $user->gender_id) selected="selected" @endif>
                                                {{$gender->gender_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label id="lbl-change-password" class="link-hover">Change password</label>
                                    </div>
                                </div>

                                <div id="div-change-password">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label">Password old</label>
                                        <div class="col-md-8">
                                            <input name="pwd-password-old" type="password" class="form-control height-form-control rounded-0" placeholder="Password old">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label">Password new</label>
                                        <div class="col-md-8">
                                            <input name="pwd-password-new" type="password" class="form-control height-form-control rounded-0" placeholder="Password new">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label">Confirrm password new</label>
                                        <div class="col-md-8">
                                            <input name="pwd-re-password-new" type="password" class="form-control height-form-control rounded-0" placeholder="Confirrm password new">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input id="btn-update-user" type="submit" class="btn btn-danger height-form-control rounded-0" value="Update Account">
                                    </div>
                                </div>

                            </div>
                            <!--/  end -->
                        </div>
                    </form>
                </div>
                <!--/ list order end -->
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    const gCLOSE_FORM = 'CLOSE_FORM';
    const gOPEN_FORM = 'OPEN_FORM';
    var gFormMode = gCLOSE_FORM;

    $(document).ready(function() {

        // event click show or hide form change password
        $('#lbl-change-password').on('click', onLblChangePasswordClick);

        // defaul close form change password
        hideFormChangePassword();

    });

    function onLblChangePasswordClick() {
        "use strict";
        if (gFormMode === gCLOSE_FORM) {
            showFormChangePassword();
        } else {
            hideFormChangePassword();
        }
    }

    function hideFormChangePassword() {
        "use strict";
        gFormMode = gCLOSE_FORM;
        console.log(gFormMode);
        $('#div-change-password').hide();
    }

    function showFormChangePassword() {
        "use strict";
        gFormMode = gOPEN_FORM;
        console.log(gFormMode);
        $('#div-change-password').show();
    }
</script>
@endsection