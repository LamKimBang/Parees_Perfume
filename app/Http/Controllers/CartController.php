<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrdersDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $user = new User();
        if ($request->session()->has('member')) {
            $member = $request->session()->get('member');
            foreach ($member as $item) {
                $userId = $item['id'];
            }
            $user = User::find($userId);
        }

        // get cart in session
        $data = getCart($request, $user);
        return view('cart/index')->with($data);
    }

    public function addToCart(Request $request, Product $product, $quantity)
    {
        $carts = [
            'cart' => [
                'products' => [],
                'totalQty' => 0,
                'subTotal' => 0
            ]
        ];
        $data = [
            'product' => Product::find($product->id),
        ];
        $index = -1;
        $id = $product->id;
        if (!$request->session()->has('cart')) {
            array_push(
                $carts['cart']['products'],
                [
                    'id' => $id,
                    'quantity' => $quantity,
                    'product_name' => $data['product']->product_name,
                    'price' => $data['product']->price,
                    'discount' => $data['product']->discount,
                    'image' => $data['product']->image,
                ]
            );
            $carts['cart']['totalQty'] += $quantity;
            $carts['cart']['subTotal'] +=
                ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
            $request->session()->put('cart', $carts);
        } else {
            $cart = $request->session()->get('cart');

            foreach ($cart['cart']['products'] as $item) {
                if ($item['id'] == $id) {
                    $index = array_search($item, $cart['cart']['products']);
                }
            }
            if ($index == -1) {
                array_push(
                    $cart['cart']['products'],
                    [
                        'id' => $id,
                        'quantity' => $quantity,
                        'product_name' => $data['product']->product_name,
                        'price' => $data['product']->price,
                        'discount' => $data['product']->discount,
                        'image' => $data['product']->image,
                    ]
                );
            } else {
                $cart['cart']['products'][$index]['quantity'] +=  $quantity;
            }
            $cart['cart']['totalQty'] += $quantity;
            $cart['cart']['subTotal'] +=
                ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
            $request->session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function postAddToCart(Request $request, Product $product)
    {
        $carts = [
            'cart' => [
                'products' => [],
                'totalQty' => 0,
                'subTotal' => 0
            ]
        ];
        $data = [
            'product' => Product::find($product->id),
        ];
        $index = -1;
        $id = $product->id;
        $quantity = $request->input('quantity');
        if (!$request->session()->has('cart')) {
            array_push(
                $carts['cart']['products'],
                [
                    'id' => $id,
                    'quantity' => $quantity,
                    'product_name' => $data['product']->product_name,
                    'price' => $data['product']->price,
                    'discount' => $data['product']->discount,
                    'image' => $data['product']->image,
                ]
            );
            $carts['cart']['totalQty'] += $quantity;
            $carts['cart']['subTotal'] +=
                ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
            $request->session()->put('cart', $carts);
        } else {
            $cart = $request->session()->get('cart');

            foreach ($cart['cart']['products'] as $item) {
                if ($item['id'] == $id) {
                    $index = array_search($item, $cart['cart']['products']);
                }
            }
            if ($index == -1) {
                array_push(
                    $cart['cart']['products'],
                    [
                        'id' => $id,
                        'quantity' => $quantity,
                        'product_name' => $data['product']->product_name,
                        'price' => $data['product']->price,
                        'discount' => $data['product']->discount,
                        'image' => $data['product']->image,
                    ]
                );
            } else {
                $cart['cart']['products'][$index]['quantity'] +=  $quantity;
            }
            $cart['cart']['totalQty'] += $quantity;
            $cart['cart']['subTotal'] +=
                ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
            $request->session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function minusToCart(Request $request, Product $product)
    {
        $data = [
            'product' => Product::find($product->id),
        ];
        $index = -1;
        $id = $product->id;
        $cart = $request->session()->get('cart');

        foreach ($cart['cart']['products'] as $item) {
            if ($item['id'] == $id) {
                $index = array_search($item, $cart['cart']['products']);
            }
        }

        $quantity = $cart['cart']['products'][$index]['quantity'];
        if ($quantity > 1) {
            $quantity--;
            $cart['cart']['products'][$index]['quantity']--;
            $cart['cart']['totalQty']--;
            $cart['cart']['subTotal'] +=
                ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
            $request->session()->put('cart', $cart);
        } else {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function deleteToCart(Request $request, Product $product)
    {
        $data = [
            'product' => Product::find($product->id),
        ];
        $index = -1;
        $id = $product->id;

        $cart = $request->session()->get('cart');

        foreach ($cart['cart']['products'] as $item) {
            if ($item['id'] == $id) {
                $index = array_search($item, $cart['cart']['products']);
            }
        }
        $quantity = $cart['cart']['products'][$index]['quantity'];
        $subTotal =  ($data['product']->price - ($data['product']->price * $data['product']->discount / 100)) * $quantity;
        unset($cart['cart']['products'][$index]);

        $cart['cart']['totalQty'] -= $quantity;
        $cart['cart']['subTotal'] -= $subTotal;
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->back();
    }

    public function addOrder(Request $request)
    {
        $userId = 0;
        $orderId = 0;
        $user = new User();
        $data = getCart($request, $user);

        // add user - role customer
        $user = [
            'date_of_birth' => Carbon::now()->format('Y-m-d'),
            'full_name' => $request->input('full_name'),
            'gender_id' => 3,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'home_address' => $request->input('home_address'),
            'user_status_id' => 1,
            'role_id' => 1,
            'deleted' => 0
        ];

        $order = [
            'address' => $request->input('home_address'),
            'feeship' => $data['shipping'],
            'discount' => $data['discount'],
            'total' => $data['total'],
            'note' => $request->input('note'),
            'created' => Carbon::now()->format('Y-m-d'),
            'order_status_id' => 1,
            'payment_id' => $request->input('selector_payment'),
            'user_id' => 0,
            'deleted' => 0
        ];

        $order_detail = [
            'price' => 0,
            'quantity' => 0,
            'product_id' => 0,
            'order_id' => 0,
            'deleted' => 0
        ];

        $productObj = [
            'quantity' => 0
        ];

        // validate
        $request->validate(
            [
                'full_name' => 'required',
                'phone' => 'required|min:10',
                'email' => 'required|email',
                'home_address' => 'required',
            ],
        );

        // if customer login
        if ($request->session()->has('member')) {
            $member = $request->session()->get('member');
            foreach ($member as $item) {
                $userId = $item['id'];
                echo "get userId from session: " . $userId . "<br>";
            }
            // update info user by id
            User::where('id', $userId)->update($user);
        } else {
            // get userId by phone
            $userId = User::where('phone', $request->input('phone'))->get()->first();
           
            // if userId != null (exists)
            if ($userId != null) {
                // update info user by id
                User::where('id', $userId->id)->update($user);
                $userId = $userId['id'];
            } else {
                // create user return userId
                $userId = DB::table('user')->insertGetId($user);
            }
        }

        // get userId
        $order['user_id'] = $userId;

        $flag = 1;
        foreach ($data['data']['cart']['products'] as $item) {
            // Inventory Storage
            $product = Product::find($item['id']);
            if ($item['quantity'] > $product->quantity) {
                $flag = 0;
                return redirect()->back()->with('error', $product->product_name . ' does not have enough stock');
            }
        }
        if ($flag == 1) {
            // create order detail
            if ($data['data'] != '') {
                // create order return orderId
                $orderId = DB::table('orders')->insertGetId($order);
                foreach ($data['data']['cart']['products'] as $item) {
                    $order_detail = [
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'product_id' => $item['id'],
                        'order_id' => $orderId,
                        'deleted' => 0
                    ];

                    OrdersDetail::create($order_detail);

                    // Inventory Storage
                    $product = Product::find($item['id']);
                    $productObj['quantity'] = $product->quantity - $item['quantity'];
                    $product->update($productObj);
                }
            } else {
                $error = [
                    'error' => 'Your shopping cart is empty !'
                ];
                return redirect()->back()->with($error);
            }
            // clear cart
            $request->session()->forget('cart');
            return redirect('order-confirmation/index?orderid=' . $orderId);
        }
    }
}

function getCart(Request $request, User $user)
{
    // get cart in session
    $cart =  $request->session()->get('cart');
    $discount = 0;
    $request->session()->has('cart') ? $subTotal = $cart['cart']['subTotal'] - $discount : $subTotal = 0;
    $subTotal >= 50 ? $shipping = 0 : $shipping = 50;
    $data = [
        'user' => $user,
        'data' => $cart,
        'title' => 'Shopping Cart',
        'payments' => Payment::get(),
        'discount' => $discount,
        'shipping' => $shipping,
        'total' =>  $subTotal + $shipping
    ];
    return $data;
}
