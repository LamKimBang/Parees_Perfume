<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Details',
            'product' => DB::table('product')
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->join('gender', 'product.gender_id', '=', 'gender.id')
                ->join('category', 'product.category_id', '=', 'category.id')
                ->select('product.*', 'brand.brand_name', 'gender.gender_name', 'category.category_name')
                ->where(array('product.id' => $request->query('id')))
                ->first(),
            'comments' => Comment::join('user', 'comment.user_id', '=', 'user.id')
                ->where('comment.deleted', 0)
                ->where('comment.product_id', $request->get('id'))
                ->select('comment.*', 'user.full_name')
                ->get(),
            'avg_rate' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->avg('rate'),
            'count_comment' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->count(),
            'count_rate_5' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->where('rate', 5)->count(),
            'count_rate_4' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->where('rate', 4)->count(),
            'count_rate_3' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->where('rate', 3)->count(),
            'count_rate_2' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->where('rate', 2)->count(),
            'count_rate_1' => Comment::whereNull('comment_id')->where('product_id', $request->get('id'))->where('rate', 1)->count(),

        ];
        return view('details/index')->with($data);
    }

    public function reply(Request $request)
    {
        $userId = 0;
        $member = session()->get('member');
        foreach ($member as $item) {
            $userId = $item['id'];
        }
        $data = [
            'content' => $request->input('comment'),
            'rate' => 0,
            'created' => Carbon::now()->format('Y-m-d'),
            'comment_id' => $request->input('comment-id'),
            'product_id' => $request->input('product-id'),
            'user_id' => $userId,
            'deleted' => 0
        ];
        Comment::create($data);
        return  redirect()->back();
    }
}
