@extends('layouts.admin')

@section( 'content')
<!-- Order -->
<div class="container-fluid">
    <!-- filter -->
    <div class="form-group">
        <div class="row ">
            <div class="col-sm-6">
                <h3>Update Order</h3>
            </div>
            <div class="col-sm-6 text-right">
                <h3>{{$order->status_name}} - #
                    <input style="border: none;" class="h3 bg-info" type="text" value="{{$order->id}}" readonly>
                </h3>
            </div>

        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">

                <div class="row form-group">
                    <!-- show profuct -->
                    <div id="div-list-product" class="col-md-4 overflow-auto" style="height: 600px;">
                        <!-- show product -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <ul id="ul-product-list" class="list-group list-group-flush cursor-pointer">
                                    @foreach($products as $product)
                                    <li class="list-group-item">
                                        <div class="row form-group btn-select-product" data-product-id="${product.id}" data-price-discount="${product.priceDiscount}" data-price="${product.price}">
                                            <div class="col-md-4">
                                                <img class="img-thumbnail" src="{{asset('user/img/product/' . $product->image)}}">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="item-box-blog-body ">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <h5 class="text-primary">{{$product->product_name}}</h5>
                                                            <label class="font-weight-bold">${{$product->price}}</label>
                                                        </div>
                                                        <div class="col-md-2">#{{$product->id}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div id="div-order-detail" class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-info h5">Shipping Information</label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input id="inp-phone" type="number" class="form-control rounded-0" placeholder="Phone" value="{{$order->phone}}">
                            </div>
                            <div class="col-md-6">
                                <input id="inp-full-name" type="text" class="form-control rounded-0" placeholder="Fullname" value="{{$order->full_name}}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="inp-email" type="email" class="form-control rounded-0" placeholder="Email" value="{{$order->email}}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="inp-address" type="text" class="form-control rounded-0" placeholder="Address" value="{{$order->address}}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="inp-note" type="text" class="form-control rounded-0" placeholder="Note" value="{{$order->note}}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="input-group ">
                                    <input id="inp-voucher-code" type="text" class="form-control rounded-0" placeholder="Coupon code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button id="btn-ap-dung" class="btn btn-secondary rounded-0" type="button">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input id="inp-discount" type="number" value="{{$order->discount}}" class="form-control rounded-0" placeholder="Discount" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 col-form-label">Shipping</label>
                            <div class="col-md-4">
                                <input id="inp-price-shipped" value="{{$order->feeship}}" type="number" class="form-control rounded-0" readonly>
                            </div>
                            <label class="col-sm-2 col-form-label">Subtotal $</label>
                            <div class="col-md-4">
                                <input id="inp-provisional" type="number" value="{{$order->total}}" class="form-control rounded-0" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-6 col-form-label">Total</label>
                            <label id="lbl-total" class="col-sm-6 col-form-label text-right text-danger ">${{$order->total}}</label>
                        </div>

                        <!-- Phần chi tiết đơn hàng -->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-danger h5">Order Detail</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover text-center" id="table-cart">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_details as $detail)
                                        <tr>
                                            <td>{{$detail->product_name}}</td>
                                            <td>{{$detail->quantity}}</td>
                                            <td>{{$detail->price}}</td>
                                            <td>
                                                <i class="far fa-minus-square text-primary minus-quantity-order" style="cursor: pointer;" data-toggle="tooltip" title="Giảm số lượng">&nbsp;</i>
                                                <i class="far fa-plus-square text-success plus-quantity-order" style="cursor: pointer;" data-toggle="tooltip" title="Tăng số lượng">&nbsp;</i>
                                                <i class="fas fa-trash-alt text-danger delete-product" style="cursor: pointer;" data-toggle="tooltip" title="Xóa sản phẩm"></i></i>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{asset('admin/order/confirm')}}" method="post">
                                    @csrf
                                    <input name="order-id" style="border: none;" class="h3 bg-info" type="text" value="{{$order->id}}" hidden>
                                    <button style="width: 100%;" class="btn btn-success" type="submit">Confirm</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{asset('admin/order/cancel')}}" method="post">
                                    @csrf
                                    <input name="order-id" style="border: none;" class="h3 bg-info" type="text" value="{{$order->id}}" hidden>
                                    <input style="width: 100%;" class="btn btn-danger" id="btn-cancel" value="Cancel" type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /. Order -->
@endsection