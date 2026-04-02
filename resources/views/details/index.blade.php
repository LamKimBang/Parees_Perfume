@extends('layouts.user')

@section( 'content')
<!-- Trekking -->
<div class="container p-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="trekking">
                <a href="{{asset('')}}">Home</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <a href="{{asset('shop')}}">Shop</a> &nbsp;
                <i class="fas fa-caret-right"></i> &nbsp;
                <label>Details</label>
            </div>
        </div>
    </div>
</div>
<!-- Trekking -->
<!--================Single Product Area =================-->
<section class="section-margin--small mb-5 mt-0">
    <!-- <div class="product_image_area"> -->
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="owl-carousel owl-theme s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset(url('user'))}}/img/product/{{$product->image}}" alt="">
                    </div>
                    <!-- <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset(url('user'))}}/img/category/s-p1.jpg" alt="">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{asset(url('user'))}}/img/category/s-p1.jpg" alt="">
                    </div> -->
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <form method="post" action="{{asset('cart/add')}}/{{$product->id}}">
                        @csrf
                        <h3>{{$product->product_name}}</h3>
                        @if($product->discount == 0)
                        <h2>${{$product->price}}</h2>
                        @else
                        <h2>${{$product->price-($product->price*$product->discount/100)}} &nbsp;<label class="original-price">${{$product->price}}</label>&nbsp;<label class="discount">-{{$product->discount}}%</label></h2>
                        @endif
                        <ul class="list">
                            <li class="mb-2"><a class="active"><span>Category</span> : {{$product->category_name}}</a></li>
                            <li class="mb-2"><a class="active"><span>Origin</span> : {{$product->origin}}</a></li>
                            <li class="mb-2"><a class="active"><span>Brand</span> : {{$product->brand_name}}</a></li>
                            <li class="mb-2"><a class="active"><span>Gender</span> : {{$product->gender_name}}</a></li>
                            <li class="mb-4"><a><span>Availibility</span> : @if($product->quantity != 0) In Stock @else <span style="color: red;">Out of stock</span> @endif</a></li>
                            <li class="mb-4">
                                <a class="active">
                                    <span>Quantity</span> :
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary size-input-cart rounded-0" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                                        <input id="inp-quantity" class="form-control text-center rounded-0 size-input-cart" min="1" name="quantity" type="number" value="1">
                                        <button type="button" class="btn btn-outline-secondary size-input-cart rounded-0" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                                    </div>
                                </a>
                            </li>
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <button id="btn-add-cart" class="btn btn-block btn-danger text-light height-form-control" type="submit" @if($product->quantity == 0) class="button btn-secondary btn-lg" disabled @else class="button primary-btn" @endif >Add to Cart
                                        &nbsp;
                                        <i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </ul>
                        <!-- 
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                        </div> -->

                        <!-- <button type="submit" @if($product->quantity == 0) class="button btn-secondary btn-lg" disabled @else class="button primary-btn" @endif > Add to Cart</button> -->


                    </form>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <label class="font-weight-bold"></label>
                <p class="text-justify">{{$product->description}}</p>
            </div>
        </div>
    </div>
    <!-- </div> -->
</section>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <div class="tab-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row total_rate">
                        <div class="col-6">
                            <div class="box_total">
                                <h5>Overall</h5>
                                <h4>{{round($avg_rate, 1)}}</h4>
                                <h6>({{$count_comment}} Reviews)</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rating_list">
                                <h3>Based on {{$count_comment}} Reviews</h3>
                                <ul class="list">
                                    <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> {{$count_rate_5}}</a></li>
                                    <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> {{$count_rate_4}}</a></li>
                                    <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> {{$count_rate_3}}</a></li>
                                    <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i> {{$count_rate_2}}</a></li>
                                    <li><a href="#">1 Star <i class="fa fa-star"></i> {{$count_rate_1}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="comment_list">
                        @foreach($comments as $comment)
                        @if(!$comment->comment_id)
                        <hr>
                        <div class="review_item">
                            <div class="media">
                                <div class="d-flex">
                                    <img src="{{asset(url('user'))}}/img/product/user-icon.png" alt="" width="70px" height="71px">
                                </div>
                                <div class="media-body">
                                    <div class="media-body">
                                        <h4>{{$comment->full_name}}</h4>
                                        <h5>{{DateTime::createFromFormat('Y-m-d', $comment->created)->format('d/m/y')}}</h5>
                                        @for($i = 1; $i <= $comment->rate; $i++)
                                            <i class="fa fa-star"></i>
                                            @endfor
                                    </div>
                                    <a data-toggle="modal" data-target="#modal-rate" data-comment-id="{{$comment->id}}" class="reply_btn reply-comment">Reply</a>
                                    <p>{{$comment->content}}</p>
                                </div>
                            </div>
                        </div>
                        @foreach($comments as $reply_comment)
                        @if($comment->id == $reply_comment->comment_id)
                        <div class="review_item reply ml-5">
                            <hr>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="{{asset(url('user'))}}/img/product/user-icon.png" alt="" width="70px" height="71px">
                                </div>
                                <div class="media-body">
                                    <h4>{{$reply_comment->full_name}}</h4>
                                    <h5>{{DateTime::createFromFormat('Y-m-d', $reply_comment->created)->format('d/m/y')}}</h5>
                                    <p>{{$reply_comment->content}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- modal rate begin -->
        <div class="modal fade" id="modal-rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="modal-rate-lable">Reply to a comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{asset('details/reply')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label>Your reply</label>
                                    <input name="comment-id" id="comment-id" type="text" hidden>
                                    <input name="product-id" id="product-id" type="text" value="{{$product->id}}" hidden>
                                    <textarea id="txt-comment" name="comment" class="form-control" placeholder="Enter your reply"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-send-rate" type="submit" class="btn btn-block btn-outline-warning">Send reply
                                &nbsp; <i class="fas fa-long-arrow-alt-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal rate end -->

    </div>
</section>
<!--================End Product Description Area =================-->
@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('.reply-comment').on('click', function() {
            onBtnReplyCommentClick(this);
        });
    });

    function onBtnReplyCommentClick(pThis) {
        "use strict";
        $('#modal-rate').modal('show');
        $('#comment-id').val($(pThis).data('comment-id'));
    }
</script>
@endsection