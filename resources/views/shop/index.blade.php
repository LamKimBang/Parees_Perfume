@extends('layouts.user')

@section( 'content')

<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Shop</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->

<!-- ================ category section start ================= -->
<section class="section-margin--small mb-5 mt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-filter mt-0">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form method="get" action="{{url('/shop/index/filter#mid')}}">
                            <ul>
                                <li class="filter-list">
                                    <input class="pixel-radio search-brand" type="radio" id="brand-no-filter" name="brand_id" value="" checked>
                                    <label for="brand-no-filter">No Filter</label>
                                </li>
                                @foreach($brands as $brand)
                                <li class="filter-list">
                                    <input class="pixel-radio search-brand" type="radio" id="{{$brand->brand_name}}" name="brand_id" value="{{$brand->id}}">
                                    <label for="{{$brand->brand_name}}">{{$brand->brand_name}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Gender</div>
                        <form method="get" action="{{url('/shop/index/filter#mid')}}">
                            <ul>
                                <li class="filter-list">
                                    <input class="pixel-radio search-gender" type="radio" id="gender-no-filter" name="gender_id" value="" checked>
                                    <label for="gender-no-filter">No Filter</label>
                                </li>
                                @foreach($genders as $gender)
                                <li class="filter-list">
                                    <input class="pixel-radio search-gender" type="radio" id="{{$gender->gender_name}}" name="gender_id" value="{{$gender->id}}">
                                    <label for="{{$gender->gender_name}}">{{$gender->gender_name}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Category</div>
                        <form method="get" action="{{url('/shop/index/filter#mid')}}">
                            <ul>
                                <li class="filter-list">
                                    <input class="pixel-radio search-category" type="radio" id="category-no-filter" name="category_id" value="" checked>
                                    <label for="category-no-filter">No Filter</label>
                                </li>
                                @foreach($categories as $category)
                                <li class="filter-list">
                                    <input class="pixel-radio search-category" type="radio" id="{{$category->category_name}}" name="category_id" value="{{$category->id}}">
                                    <label for="{{$category->category_name}}">{{$category->category_name}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select class="price-order">
                            <option value="def">Price Default</option>
                            <option value="asc">Price Ascending</option>
                            <option value="desc">Price Descending</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <!-- <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select> -->
                    </div>
                    <div>
                        <div class="input-group filter-bar-search">
                            <input class="search-name" type="text" placeholder="Search">
                            <div class="input-group-append">
                                <button class="reset-name-button" type="button"><i class="ti-trash"></i></button>
                                <button class="search-name-button" type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div id="products" class="row">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{asset('user/img/product/' . $product->image)}}" alt="" width="280" height="280">
                                    <ul class="card-product__imgOverlay">
                                        <li><a href="{{asset('details')}}?id={{$product->id}}"><button><i class="ti-search"></i></button></a></li>
                                        @if($product->quantity == 0)
                                        <li><a href="{{asset('cart/add')}}/{{$product->id}}/1"><button hidden><i class="ti-shopping-cart"></i></button></a></li>
                                        <span>Out of stock</span>
                                        @else
                                        <li><a href="{{asset('cart/add')}}/{{$product->id}}/1"><button><i class="ti-shopping-cart"></i></button></a></li>
                                        @endif

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{$product->description_short}}</p>
                                    <h4 class="card-product__title"><a href="{{asset('details')}}?id={{$product->id}}">{{$product->product_name}}</a></h4>
                                    <!-- <p class="card-product__price">${{$product->price}}</p> -->
                                    @if($product->discount == 0)
                                    <p class="card-product__price">${{$product->price}}</p>
                                    @else
                                    <p class="card-product__price">${{$product->price-($product->price*$product->discount/100)}} &nbsp;<label class="original-price">${{$product->price}}</label>&nbsp;<label class="discount">-{{$product->discount}}%</label></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Paging -->
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </section>
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
</section>
<!-- ================ category section end ================= -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        if (document.getElementById("price-range")) {

            var RangeSlider = document.getElementById('price-range');

            noUiSlider.create(RangeSlider, {
                connect: true,
                behaviour: 'tap',
                start: [0, 1000],
                range: {
                    'min': [0],
                    'max': [1000]
                }
            });


            var nodes = [
                document.getElementById('lower-value'), // 0
                document.getElementById('upper-value') // 1
            ];

            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            RangeSlider.noUiSlider.on('update', function(values, handle, unencoded, isTap, positions) {
                nodes[handle].innerHTML = values[handle];
            });

        }

        $(".search-brand, .search-gender, .search-category, .search-name-button").on("click", function() {

            $product_name = $(".search-name").val();
            $brand_id = $("input[name=brand_id]:checked").val();
            $gender_id = $("input[name=gender_id]:checked").val();
            $category_id = $("input[name=category_id]:checked").val();
            $price_order = $(".price-order").val();
            $price_range = RangeSlider.noUiSlider.get();

            $.ajax({
                type: "GET",
                url: "{{url('/shop/index/search')}}",
                data: {
                    'product_name': $product_name,
                    'brand_id': $brand_id,
                    'gender_id': $gender_id,
                    'category_id': $category_id,
                    'price_order': $price_order,
                    'price_range': $price_range
                },
                success: function(data) {
                    $("#products").html(data);
                }
            })
        });

        $(".price-order").on("change", function() {

            $product_name = $(".search-name").val();
            $brand_id = $("input[name=brand_id]:checked").val();
            $gender_id = $("input[name=gender_id]:checked").val();
            $category_id = $("input[name=category_id]:checked").val();
            $price_order = $(".price-order").val();
            $price_range = RangeSlider.noUiSlider.get();

            $.ajax({
                type: "GET",
                url: "{{url('/shop/index/search')}}",
                data: {
                    'product_name': $product_name,
                    'brand_id': $brand_id,
                    'gender_id': $gender_id,
                    'category_id': $category_id,
                    'price_order': $price_order,
                    'price_range': $price_range
                },
                success: function(data) {
                    $("#products").html(data);
                }
            })
        });

        $(".reset-name-button").on("click", function() {

            $brand_id = $("input[name=brand_id]:checked").val();
            $gender_id = $("input[name=gender_id]:checked").val();
            $category_id = $("input[name=category_id]:checked").val();
            $price_order = $(".price-order").val();
            $price_range = RangeSlider.noUiSlider.get();

            $(".search-name").val('');

            $.ajax({
                type: "GET",
                url: "{{url('/shop/index/search')}}",
                data: {
                    'brand_id': $brand_id,
                    'gender_id': $gender_id,
                    'category_id': $category_id,
                    'price_order': $price_order,
                    'price_range': $price_range
                },
                success: function(data) {
                    $("#products").html(data);
                }
            })
        });

        RangeSlider.noUiSlider.on("change", function() {

            console.log(RangeSlider.noUiSlider.get()[0]);

            $product_name = $(".search-name").val();
            $brand_id = $("input[name=brand_id]:checked").val();
            $gender_id = $("input[name=gender_id]:checked").val();
            $category_id = $("input[name=category_id]:checked").val();
            $price_order = $(".price-order").val();
            $price_range = RangeSlider.noUiSlider.get();

            $.ajax({
                type: "GET",
                url: "{{url('/shop/index/search')}}",
                data: {
                    'product_name': $product_name,
                    'brand_id': $brand_id,
                    'gender_id': $gender_id,
                    'category_id': $category_id,
                    'price_order': $price_order,
                    'price_range': $price_range
                },
                success: function(data) {
                    $("#products").html(data);
                }
            })
        });

        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    });
</script>
@endsection