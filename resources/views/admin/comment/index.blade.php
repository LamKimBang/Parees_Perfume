@extends('layouts.admin')

@section( 'content')

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
                        <div class="media-body">
                            <img width="100px" height="100px" class="img-thumbnail" src="{{asset('user/img/product/'. $comment->image)}}" alt="">
                            <label>{{$comment->product_name}}</label>
                        </div>
                        <a data-toggle="modal" data-target="#modal-rate-admin" data-comment-id="{{$comment->id}}" data-product-id="{{$comment->product_id}}" class="reply_btn reply-comment-admin">Reply</a>
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

<!-- modal rate begin -->
<div class="modal fade" id="modal-rate-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="modal-rate-admin-lable">Reply to a comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{asset('admin/comment/reply')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <label>Your reply</label>
                            <input name="comment-id" id="comment-id" type="text" hidden>
                            <input name="product-id" id="product-id" type="text" hidden>
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

@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('.reply-comment-admin').on('click', function() {
            onBtnReplyCommentClick(this);
        });
    });

    function onBtnReplyCommentClick(pThis) {
        "use strict";
        // $('#modal-rate-admin').modal('show');
        $('#comment-id').val($(pThis).data('comment-id'));
        $('#product-id').val($(pThis).data('product-id'));
        console.log('pro' + $(pThis).data('product-id'));
        console.log('cmt' + $(pThis).data('comment-id'));
    }
</script>
@endsection