<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderHistoryController extends Controller
{
    public function index()
    {
        $userId = 0;
        $member = session()->get('member');
        foreach ($member as $item) {
            $userId = $item['id'];
        }
        $orders = DB::table('orders')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
            ->join('payment', 'orders.payment_id', '=', 'payment.id')
            ->join('user', 'orders.user_id', '=', 'user.id')
            ->select('orders.*', 'order_status.status_name', 'payment.payment_name', 'user.full_name')
            ->orderBy('id', 'desc')
            ->where('user_id', $userId)
            ->get();

        $data = [
            'title' => 'Order History',
            'orders' => []
        ];
        foreach ($orders as $item) {
            $order = ['order' => $item];
            $order_detail =  [
                'order_detail' => DB::table('order_detail')
                    ->join('product', 'order_detail.product_id', '=', 'product.id')
                    ->select('order_detail.*', 'product.product_name', 'product.image')
                    ->where('order_id', $item->id)
                    ->get()
            ];
            array_push($order, $order_detail);
            array_push($data['orders'], $order);
        };
        return view('user/orderhistory/index')->with($data);
    }

    public function cancelOrder(Request $request)
    {
        $order = Orders::find($request->query('orderid'));
        $order_status_id = [
            'order_status_id' => 0
        ];
        $order_status_id['order_status_id'] = 5;
        $order->update($order_status_id);
        return redirect()->back();
    }

    public function review(Request $request)
    {
        $userId = 0;
        $member = session()->get('member');
        foreach ($member as $item) {
            $userId = $item['id'];
        }
        $data = [
            'content' => $request->input('comment'),
            'rate' => $request->input('rating'),
            'created' => Carbon::now()->format('Y-m-d'),
            'product_id' => $request->input('product-id'),
            'user_id' => $userId,
            'deleted' => 0
        ];
        // dd($data);
        Comment::create($data);
        return  redirect()->back();
    }
}
