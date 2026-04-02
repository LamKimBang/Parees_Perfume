<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$title}}</title>

    <link rel="icon" href="img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/nice-select/nice-select.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/linericon/style.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/vendors/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="{{asset(url('user'))}}/css/style.css">

</head>

<body>
    <section class="login_box_area section-margin mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <img src="{{asset('user/img/logo-admin.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <form class="row login_form" action="{{asset('login/postLoginAdmin')}}" id="contactForm" method="post">
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
                                <button type="submit" value="submit" class="button button-login w-100" id="btn-login">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset(url('user'))}}/vendors/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/skrollr.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/nice-select/jquery.nice-select.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/nouislider/nouislider.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/jquery.ajaxchimp.min.js"></script>
    <script src="{{asset(url('user'))}}/vendors/mail-script.js"></script>
    <script src="{{asset(url('user'))}}/js/main.js"></script>

</body>

</html>