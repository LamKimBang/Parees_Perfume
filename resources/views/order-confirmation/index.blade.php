@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Order Confirmation</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Order Details Area =================-->
<section class="order_details section-margin--small mt-0 mb-5">
    <div class="container">
        <p class="text-center billing-alert">Thank you. Your order has been received.</p>
        <div class="row mb-5">
            <div class="col-md-6 col-xl-6 mb-6 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">{{$order->status_name}}</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Order number</td>
                            <td>: {{$order->id}}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>: {{$order->created}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>: USD {{$order->total}}</td>
                        </tr>
                        <tr>
                            <td>Payment method</td>
                            <td>: {{$order->payment_name}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 mb-6 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Shipping Address</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Fullname</td>
                            <td>: {{$order->full_name}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>: {{$order->phone}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{$order->address}}</td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>: {{$order->note}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="order_details_table">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_details as $detail)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img class="thumbnail-cart" src="{{asset('user')}}/img/product/{{$detail->image}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>{{$detail->product_name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>{{$detail->quantity}}</h5>
                            </td>
                            <td>
                                <p>${{$detail->quantity*$detail->price}}</p>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>Subtotal</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>${{$subTotal}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Shipping</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>${{$order->feeship}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Total</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <h4>${{$order->total}}</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@endsection