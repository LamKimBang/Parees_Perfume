<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class TrackingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tracking',
        ];
        return view('tracking/index')->with($data);
    }

    public function search(Request $request)
    {
        // $email = $request->input('email');
        $data = [
            'title' => 'Tracking',
            "order" => DB::table('orders')
                ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
                ->join('payment', 'orders.payment_id', '=', 'payment.id')
                ->join('user', 'orders.user_id', '=', 'user.id')
                ->select('orders.*', 'order_status.status_name', 'payment.payment_name', 'user.full_name', 'user.email')
                ->where('orders.id', $request->input('order'))
                ->where('user.email', $request->input('email'))
                ->first(),
        ];
        return view('tracking/index')->with($data);
    }
}
