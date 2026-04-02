@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Reviews</label>
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
                                <a class="list-group-item list-group-item-action" href="{{asset('user/account-info')}}">
                                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp; Account Infor</a>
                                <a class="list-group-item list-group-item-action" href="{{asset('user/order-history')}}">
                                    <i class="fas fa-clipboard"></i>&nbsp;&nbsp;&nbsp; Order History</a>
                                <a class="list-group-item list-group-item-action active" href="{{asset('user/reviews')}}">
                                    <i class="fas fa-comment-dots"></i>&nbsp;&nbsp;&nbsp; Reviews</a>
                                <a href="{{asset('login/getLogout')}}" id="a-logout" class="list-group-item list-group-item-action cursor-pointer">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp; Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Category left end -->

                <!-- list reviews begin -->
                <div class="col-xs-12 col-sm-12 col-lg-9">
                    <div class="row form-group">
                        <div class="col-sm-12 h4 text-primary">
                            <label class="font-weight-bold h5">Reviews (<label class="text-danger" id="lbl-count-orders">{{count($reviews)}}</label> reviews)</label>
                        </div>
                    </div>

                    <div class="pt-2">
                        <!-- load database -->
                        <div>
                            <div class="card-body bg-light">
                                @foreach($reviews as $review)
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <a href="{{asset('details')}}?id={{$review->product_id}}"><img class="img-thumbnail" src="{{asset('user/img/product/' . $review->image)}}"></a>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-12 font-weight-bold text-primary">
                                                <a href="{{asset('details')}}?id={{$review->product_id}}">
                                                    <label>{{$review->product_name}}</label>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>{{$review->content}}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- <label>{{$review->rate}}</label> -->
                                                @for($i = 1; $i <= $review->rate; $i++)
                                                    <a href=""><i class="fa fa-star"></i></a>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <!--/ list reviews end -->

            </div>
        </div>
    </div>
</section>

@endsection