@extends('layouts.admin')

@section( 'content')
<!-- Order -->
<div class="container-fluid">
    <!-- filter -->
    <div class="form-group">
        <div class="row ">
            <div class="col-sm-2">
                <button id="btn-add-order" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                    &nbsp;
                    Create Order</button>
            </div>

            <div class="col-sm-3">
                <input id="inp-filter-full-name" class="form-control" type="text" placeholder="Customer Name">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-phone" class="form-control" type="number" placeholder="Phone">
            </div>
            <div class="col-sm-2">
                <select id="select-filter-status" class="form-control select2bs4" style="width: 100%;">
                </select>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input id="inp-order-date" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Created">
                </div>
            </div>
            <div class="col-sm-1">
                <button id="btn-search-order" class="btn btn-block btn-secondary">Search</button>
            </div>
        </div>
    </div>

    <!-- table list order -->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover" id="table-order">
                    <thead class="bg-dark ">
                        <tr>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Feeship</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Note</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td></td>
                            <td>{{$order->id}}</td>
                            <th>{{$order->full_name}}</th>
                            <th>{{$order->address}}</th>
                            <th>{{$order->feeship}}</th>
                            <th>{{$order->discount}}</th>
                            <th>${{$order->total}}</th>
                            <th>{{$order->note}}</th>
                            <th>{{$order->created}}</th>
                            <th>{{$order->status_name}}</th>
                            <th>{{$order->payment_name}}</th>
                            <th class="text-center"><a href="{{asset('admin/order/update?orderid=' .$order->id)}}"><i class="fas fa-edit text-primary edit-order" style="cursor: pointer;" data-toggle="tooltip" title="Confirm"></a></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /. Order -->

<!-- Modal create - update order -->
<div id="modal-order" class="modal fade">
    <div id="modal-dialog-xl" class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="h5-modal-title-order"></h5>&nbsp;
                <h5 class="modal-title">ORDER</h5>
                <h5 id="h5-status-name" class="modal-title w-100 text-center text-success">
                    <h5 id="h5-order-date" class="modal-title text-danger"></h5>
                </h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-group">
                        <!-- show profuct -->
                        <div id="div-list-product" class="col-md-4">
                            <!-- filter product -->
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <select id="select-color-modal" class="form-control select2bs4" style="width: 100%;">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id="select-category-modal" class="form-control select2bs4" style="width: 100%;">
                                    </select>
                                </div>
                            </div>

                            <!-- show product -->
                            <div class="row form-group">
                                <div class="col-md-12 modal-scroll">
                                    <ul id="ul-product-list" class="list-group list-group-flush cursor-pointer">
                                        <!-- load product database -->
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
                                    <input id="inp-phone" type="number" class="form-control rounded-0" placeholder="Phone">
                                </div>
                                <div class="col-md-6">
                                    <input id="inp-full-name" type="text" class="form-control rounded-0" placeholder="Fullname">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input id="inp-email" type="email" class="form-control rounded-0" placeholder="Email">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input id="inp-address" type="text" class="form-control rounded-0" placeholder="Address">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input id="inp-note" type="text" class="form-control rounded-0" placeholder="Note">
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
                                    <input id="inp-discount" type="number" value="0" class="form-control rounded-0" placeholder="Discount" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Shipping</label>
                                <div class="col-md-4">
                                    <input id="inp-price-shipped" value="50" type="number" class="form-control rounded-0" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label">Subtotal</label>
                                <div class="col-md-4">
                                    <input id="inp-provisional" type="number" value="0" class="form-control rounded-0" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-6 col-form-label">Total</label>
                                <label id="lbl-total" class="col-sm-6 col-form-label text-right text-danger "></label>
                            </div>

                            <!-- Phần chi tiết đơn hàng -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-danger h5">Order Detail</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered table-hover" id="table-cart">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <input class="btn btn-info" id="btn-order" value="Order" type="button">
                <input class="btn btn-success" id="btn-confirm" value="Confirm" type="button">
                <input class="btn btn-danger" id="btn-cancel" value="Cancel" type="button">
            </div>
        </div>
    </div>
</div>
<!-- Modal thêm - sửa order -->

<!-- Modal xóa -->
<div class="modal fade" tabindex="-1" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CANCEL ORDER</label>
                    <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label>Bạn có chắc chắn muốn hủy đơn hàng số <label class="text-danger" id="lbl-order-id"></label>
                    không?</label>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="btn-delete">Delete</button>
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal xóa -->
@endsection

@section('js')
<script>
    index = 1;
    var table = $('#table-order').DataTable({
        columnDefs: [{ // map column index
            targets: 0,
            render: function() {
                return index++;
            }
        }, ],
    });

    $(document).ready(function() {
        table;
        // click icon edit order open form UPDATE ORDER
        // $('#table-order').on('click', '.edit-order', function() {
        //     $('#modal-order').modal("show");
        //     var tableRow = $(this).parents('tr');
        //     var dataCell = table.row(tableRow).data();
        //     console.log(dataCell[1]);
        // });
    });
</script>
@endsection