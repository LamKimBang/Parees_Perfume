@extends('layouts.user')

@section( 'content')
<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Tracking</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Tracking Box Area =================-->
<section class="tracking_box_area section-margin--small mt-0">
    <div class="container">
        <div class="tracking_box_inner">
            <p>To track your order please enter your Order ID in the box below and press the "Track" button. This
                was given to you on your receipt and in the confirmation email you should have received.</p>
            <form class="row tracking_form" action="{{asset('tracking/search')}}" method="get" novalidate="novalidate">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="order" placeholder="Order ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Order ID'">
                </div>
                <div class="col-md-12 form-group">
                    <input type="email" class="form-control" name="email" placeholder="Billing Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Billing Email Address'">
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="button button-tracking">Track Order</button>
                </div>
            </form>
        </div>

        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    @if(isset($order))
                    <table class="table table-striped table-bordered table-hover text-center" id="table-order">
                        <thead class="bg-dark ">
                            <tr>
                                <th>Order Id</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Feeship</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{asset('order-confirmation/index?orderid=')}}{{$order->id}}">{{$order->id}}</a></td>
                                <th>{{$order->full_name}}</th>
                                <td>{{$order->email}}</td>
                                <th>{{$order->address}}</th>
                                <th>{{$order->feeship}}</th>
                                <th>{{$order->discount}}</th>
                                <th>${{$order->total}}</th>
                                <th>{{$order->status_name}}</th>
                                <th>{{$order->payment_name}}</th>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Tracking Box Area =================-->
@endsection