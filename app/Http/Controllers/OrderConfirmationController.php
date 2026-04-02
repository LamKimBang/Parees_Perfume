<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderConfirmationController extends Controller
{
    public function index(Request $request)
    {
        $order_details = DB::table('order_detail')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->select('order_detail.*', 'product.product_name', 'product.image')
            ->where('order_id', $request->query('orderid'))
            ->get();
        $subTotal = 0;
        foreach ($order_details as $detail) {
            $subTotal += $detail->price * $detail->quantity;
        }
        $data = [
            'title' => 'Order Confirmation',
            'order' => DB::table('orders')
                ->join('user', 'orders.user_id', '=', 'user.id')
                ->join('payment', 'orders.payment_id', '=', 'payment.id')
                ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
                ->select('orders.*', 'user.phone', 'user.full_name', 'payment.payment_name', 'order_status.status_name')
                ->where(array('orders.id' => $request->query('orderid')))
                ->first(),
            'order_details' =>  $order_details,
            'subTotal' => $subTotal

        ];
        return view('order-confirmation/index')->with($data);
    }
}
