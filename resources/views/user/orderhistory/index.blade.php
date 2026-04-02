@extends('layouts.user')

@section( 'content')
<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Order History</label>
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
                                <a class="list-group-item list-group-item-action " href="{{asset('user/account-info')}}">
                                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp; Account Infor</a>
                                <a class="list-group-item list-group-item-action active" href="{{asset('user/order-history')}}">
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
                            <label class="font-weight-bold h5">Order history (<label class="text-danger" id="lbl-count-orders">{{count($orders)}}</label> order)</label>
                        </div>
                    </div>

                    @foreach($orders as $item)
                    <div>
                        <!-- load database -->
                        <div class="card bg-dark text-white font-weight-bold" id="heading${order.orderCode}">
                            <div class="row form-group pt-2 pl-2 pb-0 cursor-pointer order-detail" data-order-code="${order.orderCode}" data-toggle="collapse" data-target="#collapse${order.orderCode}" aria-expanded="false" aria-controls="collapse${order.orderCode}">
                                <div class="col-sm-3 pt-1">
                                    <button class="btn btn-primary btn-sm">{{$item['order']->status_name}} #{{$item['order']->id}}</button>
                                </div>
                                <div class="col-sm-3 pt-1">
                                    <lable>{{$item['order']->created}}</lable>
                                </div>
                                <div class="col-sm-3 text-center text-warning font-weight-bold pt-1">
                                    <lable>${{$item['order']->total}}</lable>
                                </div>
                                <div class="col-sm-3 text-right pt-1 pr-4">
                                    <a href="{{asset('user/order-history/cancel')}}?orderid={{$item['order']->id}}"><button class="btn btn-danger btn-sm" @if($item['order']->order_status_id == 1 || $item['order']->order_status_id == 2)
                                            @else disabled @endif >Cancel</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($item[0]['order_detail'] as $detail)
                    <div>
                        <div class="card-body bg-light">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <a href="{{asset('details')}}?id={{$detail->product_id}}">
                                        <img class="img-thumbnail" src="{{asset('user/img/product/' . $detail->image)}}">
                                    </a>
                                </div>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-sm-12 font-weight-bold text-primary">
                                            <a href="{{asset('details')}}?id={{$detail->product_id}}">
                                                <label>{{$detail->product_name}}</label>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <small>Quantity :</small>
                                            <small class="font-weight-bold">{{$detail->quantity}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <small>Price :</small>
                                            <small class="font-weight-bold">${{$detail->price}}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <small>Total :</small>
                                            <small class="font-weight-bold">${{$detail->price * $detail->quantity}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right">
                                    <input data-toggle="modal" data-target="#modal-rate" data-product-id="{{$detail->product_id}}" class="btn btn-outline-warning rate-product" value="Review" type="button">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
                <!--/ list order end -->

                <!-- modal rate begin -->
                <div class="modal fade" id="modal-rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="modal-rate-lable">Please rate the product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{asset('user/order-history/review')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label>Your review of the product</label>
                                            <input name="product-id" id="product-id" type="text" hidden>
                                            <textarea id="txt-comment" name="comment" class="form-control" placeholder="Enter your review"></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-2">
                                            <label>Rating</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="pixel-radio" type="radio" id="star1" name="rating" value="1" />
                                            <p class="full" for="star1" title="Sucks big time - 1 star">1</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="pixel-radio" type="radio" id="star2" name="rating" value="2" />
                                            <p class="full" for="star2" title="Kinda bad - 2 stars">2</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="pixel-radio" type="radio" id="star3" name="rating" value="3" />
                                            <p class="full" for="star3" title="Meh - 3 stars">3</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="pixel-radio" type="radio" id="star4" name="rating" value="4" />
                                            <p class="full" for="star4" title="Pretty good - 4 stars">4</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="pixel-radio" type="radio" id="star5" name="rating" value="5" />
                                            <p class="full" for="star5" title="Awesome - 5 stars">5</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button id="btn-send-rate" type="submit" class="btn btn-block btn-outline-warning">Send review
                                        &nbsp; <i class="fas fa-long-arrow-alt-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- modal rate end -->

            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    // gProductId = 0
    $(document).ready(function() {

        // event click button rate on list order
        $('.rate-product').on('click', function() {
            onBtnRateProductClick(this);
        });

        // close modal
        // $('#modal-rate').on('hidden.bs.modal', resetFormToStart);
    });

    function onBtnRateProductClick(pThis) {
        "use strict";
        $('#modal-rate').modal('show');
        // gProductId = $(pThis).data('product-id');
        // console.log(gProductId);
        $('#product-id').val($(pThis).data('product-id'));
    }
</script>
@endsection