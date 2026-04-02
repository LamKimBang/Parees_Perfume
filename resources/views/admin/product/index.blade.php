@extends('layouts.admin')

@section( 'content')
<div class="container-fluid">

    <!-- filter product -->
    <div class="row form-group">
        <div class="col-sm-12">
            <a href="{{url('/admin/product/addproduct')}}">
                <button id="btn-add-order" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                    &nbsp;
                    Create Product</button>
            </a>
        </div>
    </div>
    <form method="get" action="{{url('/admin/product/search')}}">
        <!-- @csrf -->
        <div class="row form-group">
            <div class="col-sm-2">
                <input id="inp-filter-product-name" class="form-control" type="text" placeholder="Product Name" name="product_name" autocomplete="off">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-price-min" class="form-control" type="number" placeholder="Price min $" name="from_price">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-price-max" class="form-control" type="number" placeholder="Price max $" name="to_price">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-discount-min" class="form-control" type="number" placeholder="Discount min $" name="from_discount">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-discount-max" class="form-control" type="number" placeholder="Discount max $" name="to_discount">
            </div>
            <div class="col-sm-2">
                <input id="inp-filter-origin" class="form-control" type="text" placeholder="Origin" name="origin" autocomplete="off">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-2">
                <input class="form-control" type="date" placeholder="Created date from" name="from_date">
            </div>
            <div class="col-sm-2">
                <input class="form-control" type="date" placeholder="Created date to" name="to_date">
            </div>
            <div class="col-sm-2">
                <select class="form-control select2bs4" name="brand_id">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control select2bs4" name="gender_id">
                    <option value="">Select Gender</option>
                    @foreach($genders as $gender)
                    <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control select2bs4" name="category_id">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block btn-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Phần table list order -->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover text-center" id="table-product">
                    <thead class="bg-dark">
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Id</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Image</th>
                            <th>Short Description</th>
                            <!-- <th>Description</th> -->
                            <th>Origin</th>
                            <th>Quantity</th>
                            <th>Create Date</th>
                            <!-- <th>Brand Id</th>
                            <th>Gender Id</th>
                            <th>Category Id</th>
                            <th>Delete Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="nowrap">
                        @foreach ($products as $product)
                        <tr>
                            <!-- <td></td> -->
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->discount}}%</td>
                            <td>
                                <img src="{{asset('user/img/product/' . $product->image)}}" width="150px" height="100px">
                            </td>
                            <td>{{$product->description_short}}</td>
                            <!-- <td>{{$product->description}}</td> -->
                            <td>{{$product->origin}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{DateTime::createFromFormat('Y-m-d', $product->created)->format('d/m/y')}}</td>
                            <!-- <td>{{$product->brand_id}}</td>
                            <td>{{$product->gender_id}}</td>
                            <td>{{$product->category_id}}</td>
                            <td>{{$product->deleted}}</td> -->
                            <td>
                                <a href="{{url('/admin/product/update?id=' . $product->id)}}"> <i class="fas fa-edit text-primary edit-product" style="cursor: pointer;" data-toggle="tooltip" title="Edit product">&nbsp;</i></a>
                                <a href="{{url('/admin/product/processdeleteproduct?id=' . $product->id)}}" onclick="return confirm('Are you certain you want to delete this product?')"> <i class="fas fa-trash-alt text-danger " style="cursor: pointer;" data-toggle="tooltip" title="Delete product"></i>&nbsp;</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Phần paging-->
    <div class="row form-group pt-3">
        <div class="col-sm-12 ">
            <ul id="ul-paging" class="pagination justify-content-center">

            </ul>
        </div>
    </div>

</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#table-product').DataTable({
            searching: false,
            lengthChange: false,
        });
    });
</script>
@endsection