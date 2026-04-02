<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Comment',
            'comments' => DB::table('comment')
                ->join('product', 'comment.product_id', '=', 'product.id')
                ->join('user', 'comment.user_id', '=', 'user.id')
                ->select('comment.*', 'product.product_name', 'user.full_name', 'product.image', 'product.id as product_id')
                ->get()
        ];
        return view('admin/comment/index')->with($data);
    }

    public function reply(Request $request)
    {
        $userId = 0;
        $member = session()->get('admin');
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
        // dd($data);
        Comment::create($data);
        return  redirect()->back();
    }
}
