<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function index()
    {
        $userId = 0;
        $member = session()->get('member');
        foreach ($member as $item) {
            $userId = $item['id'];
        }
        $reviews = DB::table('comment')
            ->join('product', 'comment.product_id', '=', 'product.id')
            ->select('comment.*', 'product.image', 'product.product_name')
            ->where('user_id', $userId)
            ->get();

        $data = [
            'title' => 'Reviews',
            'reviews' => $reviews
        ];
        return view('user/reviews/index')->with($data);
    }
}
