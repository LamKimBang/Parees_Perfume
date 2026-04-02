@extends('layouts.user')

@section( 'content')
<!--================ Hero banner start =================-->
<section class="hero-banner">
    <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
            <div class="col-5 d-none d-sm-block">
                <div class="hero-banner__img">
                    <img class="img-fluid" src="{{asset(url('user'))}}/img/home/hero-banner.png" alt="">
                </div>
            </div>
            <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                <div class="hero-banner__content">
                    <h4>Shop is fun</h4>
                    <h1>Browse Our Premium Product</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Hero banner start =================-->

<!--================ Hero Carousel start =================-->
<section class="section-margin mt-0">
    <div class="owl-carousel owl-theme hero-carousel">
        @foreach($brands as $brand)

        <div class="hero-carousel__slide" method="get" action="{{url('/shop/index/filter#mid')}}">
            <img class="card-img" src="{{asset('user/img/product/Paarees Perfumes Images/Brand Logo/' . $brand->brand_image)}}" alt="" width="200" height="400">

            <a href="{{asset('shop')}}?id={{$brand->id}}" class="hero-carousel__slideOverlay" name="brand_id" value="{{$brand->id}}">
                <h3 for="{{$brand->brand_name}}">{{$brand->brand_name}}</h3>
            </a>
        </div>
        @endforeach

    </div>
</section>
<!--================ Hero Carousel end =================-->

<!-- ================ trending product section start ================= -->
<section class="section-margin calc-60px">
    <div class="container">
        <div class="section-intro pb-60px">
            <p>Popular Item in the market</p>
            <h2>Trending <span class="section-intro__style">Product</span></h2>
        </div>
        <div id="products" class="row">
            @foreach($trendings as $trending)
            <div class="col-md-6 col-lg-4">
                <div class="card text-center card-product">
                    <div class="card-product__img">
                        <img class="card-img" src="{{asset('user/img/product/' . $trending->image)}}" alt="" width="50" height="280">
                        <ul class="card-product__imgOverlay">
                            <li><a href="{{asset('details')}}?id={{$trending->id}}"><button><i class="ti-search"></i></button></a></li>

                            @if($trending->quantity == 0)
                            <li><a href="{{asset('cart/add')}}/{{$trending->id}}/1"><button hidden><i class="ti-shopping-cart"></i></button></a></li>
                            <span>Out of stock</span>
                            @else
                            <li><a href="{{asset('cart/add')}}/{{$trending->id}}/1"><button><i class="ti-shopping-cart"></i></button></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <p>{{$trending->brand_name}}</p>
                        <h4 class="card-product__title"><a href="{{asset('details')}}?id={{$trending->id}}">{{$trending->product_name}}</a></h4>
                        <!-- <p class="card-product__price">${{$trending->price}}</p> -->
                        @if($trending->discount == 0)
                        <p class="card-product__price">${{$trending->price}}</p>
                        @else
                        <p class="card-product__price">${{$trending->price-($trending->price*$trending->discount/100)}} &nbsp;<label class="original-price">${{$trending->price}}</label>&nbsp;<label class="discount">-{{$trending->discount}}%</label></p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</section>
<!-- ================ trending product section end ================= -->

<!-- ================ offer section start ================= -->
<section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="offer__content text-center">
                    <h3>Up To 50% Off</h3>
                    <h4>Winter Sale</h4>
                    <p>Him she'd let them sixth saw light</p>
                    <a class="button button--active mt-3 mt-xl-4" href="#">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ offer section end ================= -->

<!-- ================ Best Selling item  carousel ================= -->
<section class="section-margin calc-60px">
    <div class="container">
        <div class="section-intro pb-60px">
            <p>Popular Item in the market</p>
            <h2>Best <span class="section-intro__style">Sellers</span></h2>
        </div>
        <div class="owl-carousel owl-theme" id="bestSellerCarousel">

            @foreach ($bests as $best)
            <div class="card text-center card-product">
                <div class="card-product__img">
                    <img class="card-img" src="{{asset('user/img/product/' . $best->image)}}" alt="" width="50" height="280">
                    <ul class="card-product__imgOverlay">
                        <li><a href="{{asset('details')}}?id={{$best->id}}"><button><i class="ti-search"></i></button></a></li>
                        @if($best->quantity == 0)
                        <li><a href="{{asset('cart/add')}}/{{$best->id}}/1"><button hidden><i class="ti-shopping-cart"></i></button></a></li>
                        <span>Out of stock</span>
                        @else
                        <li><a href="{{asset('cart/add')}}/{{$best->id}}/1"><button><i class="ti-shopping-cart"></i></button></a></li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <p>{{$best->brand_name}}</p>
                    <h4 class="card-product__title"><a href="{{asset('details')}}?id={{$best->id}}">{{$best->product_name}}</a></h4>
                    <!-- <p class="card-product__price">${{$best->price}}</p> -->
                    @if($best->discount == 0)
                    <p class="card-product__price">${{$best->price}}</p>
                    @else
                    <p class="card-product__price">${{$best->price-($best->price*$best->discount/100)}} &nbsp;<label class="original-price">${{$best->price}}</label>&nbsp;<label class="discount">-{{$best->discount}}%</label></p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>


    </div>
</section>
<!-- ================ Best Selling item  carousel end ================= -->

<!-- ================ Subscribe section start ================= -->
<section class="subscribe-position">
    <div class="container">
        <div class="subscribe text-center">
            <h3 class="subscribe__title">Get Update From Anywhere</h3>
            <p>Bearing Void gathering light light his eavening unto dont afraid</p>
            <div id="mc_embed_signup">
                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
                    <div class="form-group ml-sm-auto">
                        <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                        <div class="info"></div>
                    </div>
                    <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                    <div style="position: absolute; left: -5000px;">
                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
<!-- ================ Subscribe section end ================= -->





@endsection