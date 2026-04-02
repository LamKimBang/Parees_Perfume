<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Order',
            'orders' => DB::table('orders')
                ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
                ->join('payment', 'orders.payment_id', '=', 'payment.id')
                ->join('user', 'orders.user_id', '=', 'user.id')
                ->select('orders.*', 'order_status.status_name', 'payment.payment_name', 'user.full_name')
                ->get()
        ];
        return view('admin/order/index')->with($data);
    }

    public function update(Request $request)
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
            'title' => 'Update Order',
            'order' => DB::table('orders')
                ->join('user', 'orders.user_id', '=', 'user.id')
                ->join('payment', 'orders.payment_id', '=', 'payment.id')
                ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
                ->select('orders.*', 'user.phone', 'user.email', 'user.full_name', 'payment.payment_name', 'order_status.status_name')
                ->where(array('orders.id' => $request->query('orderid')))
                ->first(),
            'order_details' =>  $order_details,
            'subTotal' => $subTotal,
            'products' => Product::get()

        ];
        return view('admin/order/update')->with($data);
    }

    public function confirm(Request $request)
    {
        $order = [
            'order_status_id' => 2
        ];
        Orders::where('id', $request->input('order-id'))->update($order);
        return redirect()->back();
    }

    public function cancel(Request $request)
    {
        $order = [
            'order_status_id' => 5
        ];
        Orders::where('id', $request->input('order-id'))->update($order);
        return redirect()->back();
    }
}
