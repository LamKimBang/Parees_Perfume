@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Shopping Cart</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!--================Cart Area =================-->
<section class="checkout_area section-margin--small mt-0">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-7">
                    <div class="check_title" @if(Session::has('member')) hidden @else '' @endif>
                        <h3>Returning Customer? <a href="{{asset('login')}}">Click here to login</a></h3>
                    </div>
                    <h3>Shipping Information</h3>
                    <ul id="error_list"></ul>
                    <form class="row contact_form" action="{{asset('cart/addOrder')}}" method="post">
                        @csrf
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="full_name" name="full_name" @if(Session::has('member')) value="{{$user->full_name}}" @else value="{{old('full_name')}}" @endif placeholder="Full Name">
                            @error ('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="phone" name="phone" @if(Session::has('member')) value="{{$user->phone}}" @else value="{{old('phone')}}" @endif placeholder="Phone">
                            @error ('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="email" name="email" @if(Session::has('member')) value="{{$user->email}}" @else value="{{old('email')}}" @endif placeholder="Email">
                            @error ('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="home_address" name="home_address" @if(Session::has('member')) value="{{$user->home_address}}" @else value="{{old('home_address')}}" @endif placeholder="Home address">
                            @error ('home_address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                        </div>
                        @foreach($payments as $payment)
                        <div class="col-md-6 form-group payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="{{$payment->id}}" name="selector_payment" value="{{$payment->id}}" checked>
                                <label for="{{$payment->id}}">{{$payment->payment_name}}</label>
                                <div class="check"></div>
                                @error ('selector_payment')
                                <span style="color: red;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12 form-group text-center">
                            <button class="button button-paypal add_order" type="submit">Proceed to checkout</button>
                        </div>
                    </form>

                </div>
                <div class="col-lg-5">
                    @if($message = Session::get('error'))
                    <h4 class="alert alert-danger">{{$message}}</h4>
                    @endif
                    <div class="order_box">
                        <h2>Your Cart</h2>
                        @if(Session::has('cart'))
                        <a href="{{asset('cart/clear')}}" class="btn-delete-cart"><span>Clear all</span></a>
                        @endif
                        <ul class="list">
                            @if(Session::has('cart'))
                            @foreach($data['cart']['products'] as $item)
                            <li>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{asset('details')}}?id={{$item['id']}}"><img class="thumbnail-cart" src="{{asset('user')}}/img/product/{{$item['image']}}"></a>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label id="lbl-product-name" class="font-weight-bold">{{$item['product_name']}}</label>
                                                </div>
                                                <div class="col-md-4 text-right link-hover">
                                                    <a class="btn-delete-cart" href="{{asset('cart/delete')}}/{{$item['id']}}"><small data-product-id="{{$item['id']}}">delete</small></a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <a href="{{asset('cart/minus')}}/{{$item['id']}}"><button data-product-id="{{$item['id']}}" class="btn btn-outline-secondary size-input-cart rounded-0 btn-minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button></a>
                                                        <input id="inp-quantity" class="form-control text-center rounded-0 size-input-cart mt-2" min="1" name="quantity" value="{{$item['quantity']}}" type="number" readonly>
                                                        <a href="{{asset('cart/add')}}/{{$item['id']}}/1"><button data-product-id="{{$item['id']}}" class="btn btn-outline-secondary size-input-cart rounded-0 btn-plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <label id="lbl-price">${{($item['price']-($item['price']*$item['discount']/100))*$item['quantity']}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <ul class="list list_2">
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <div class="input-group ">
                                        <input id="inp-voucher-code" type="text" class="form-control height-form-control rounded-0" placeholder="Coupon Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button id="btn-ap-dung" class="btn btn-secondary rounded-0" type="button">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <li><a>Subtotal <span>
                                        @if(Session::has('cart'))
                                        @foreach(session('cart') as $cart)
                                        ${{$cart['subTotal']}}
                                        @endforeach
                                        @endif
                                    </span></a></li>
                            <li><a href="#">Discount <span>${{$discount}}</span></a></li>
                            <li><a href="#">Shipping<span>${{$shipping}}</span></a></li>
                            <li><a href="#">Total <span>${{$total}}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

@endsection

@section('js')
<!-- <script>
    $(document).ready(function() {
        $(document).on('click', '.add_order', function(e) {
            e.preventDefault();
            var data = {
                'full_name': $('#full_name').val(),
                'phone': $('#phone').val(),
                'email': $('#email').val(),
                'home_address': $('#home_address').val(),
                'note': $('#note').val(),
            }
            // console.log(d    ata);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'cart/addOrder',
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#error_list').html('');
                        $('#error_list').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#error_list').append('<li>' + err_values + '</li>');
                        });
                    } else {
                        $('#error_list').hide();
                        console.log(response.message);
                    }
                }
            });

        });
    });
</script> -->

@endsection