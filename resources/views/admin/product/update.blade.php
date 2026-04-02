@extends('layouts.admin')

@section( 'content')

<h3>Update Product</h3>
<a href="{{url('/admin/product')}}">Back</a>
<form method="post" action="{{url('/admin/product/processupdateproduct')}}">
    @csrf
    <div class="form-group m-5">
        <div class="row">
            <div class="col-md-8 ml-auto">
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Product ID</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" name="id" value="{{$product->id}}" readonly>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Product Name</label>
                    <div class="col-sm-7">
                        <input name="product_name" class="form-control" type="text" value="{{$product->product_name}}" autocomplete="off" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Price $</label>
                    <div class="col-sm-7">
                        <input type="number" name="price" value="{{$product->price}}" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Discount %</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="number" value="{{$product->discount}}" name="discount" autocomplete="off" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label"> Short Description</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="description_short" rows="3" cols="50" autocomplete="off" required>{{$product->description_short}}</textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Description</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="description" rows="10" cols="50" autocomplete="off" required>{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Origin</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" value="{{$product->origin}}" autocomplete="off" name="origin" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Quantity</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="number" name="quantity" value="{{$product->quantity}}" autocomplete="off" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Date of Creation</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="date" name="created" value="{{$product->created}}" readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Brand</label>
                    <div class="col-sm-7">
                        <select class="form-control select2bs4" style="width: 100%;" name="brand_id">
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Gender</label>
                    <div class="col-sm-7">
                        <select class="form-control select2bs4" style="width: 100%;" name="gender_id">
                            @foreach($genders as $gender)
                            <option value="{{$gender->id}}" {{$product->gender_id == $gender->id ? 'selected' : ''}}>{{$gender->gender_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Category</label>
                    <div class="col-sm-7">
                        <select class="form-control select2bs4" style="width: 100%;" name="category_id">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label">Image</label>
                    <div class="col-sm-7">
                        <input name="image" id="inp-image-url" value="{{$product->image}}" class="form-control" type="text" readonly>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-5 col-form-label"></label>
                    <div class="col-sm-7">
                        <button class="btn btn-success form-control" type="submit">Update</button>
                    </div>
                </div>

            </div>

            <div class="col-md-4 ml-auto">
                <div class="row form-group">
                    <div class="col-sm-12">
                        <input id="btn-upload-image" type="file">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <img id="img-image-product" class="img-thumbnail" src="{{url('admin/dist/img/no-image.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#btn-upload-image').on('change', function() {
            // read file
            var vFile = $(this).prop('files')[0];
            // get URL
            var vFileUrl = URL.createObjectURL(vFile);
            // load img
            $('#img-image-product').prop('src', vFileUrl);
            $('#inp-image-url').val(vFile.name);
        });
    });
</script>
@endsection