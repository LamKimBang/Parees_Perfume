<?php

namespace App\Models;

class Cart
{

    public $items = [];
    public $totalQty = 0;
    public $subTotal = 0;

    public function __construct()
    {
        $data = session()->get('cart');
        $this->items = session()->get('cart') ? $data['cart']['products'] : [];
        $this->subTotal = $this->getSubTotal();
        $this->totalQty = $this->getTotalQuantity();
    }

    public function  add($product)
    {
        if (isset($this->items[$product['id']])) {
            $this->items[$product['id']]['quantity'] += 1;
        } else {
            $cart_item = [
                'id' => $product->id,
                'quantity' => 1,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'discount' => $product->discount,
                'image' => $product->image,
            ];
            $this->items[$product['id']] = $cart_item;
        }
        // session(['cart' => $this->items]);
        $cart = [
            'cart' => [
                'products' => $this->items,
                'totalQty' => $this->getTotalQuantity(),
                'subTotal' => $this->getSubTotal()
            ]
        ];
        session()->put('cart', $cart);
    }

    public function  update()
    {
    }

    public function  delete()
    {
    }

    public function  clear()
    {
    }

    private function getSubTotal()
    {
        $data = session()->get('cart');
        $subTotal = session()->get('cart') ? $data['cart']['subTotal'] : 0;
        foreach ($this->items as $item) {
            $subTotal += ($item['price'] - ($item['price'] * $item['discount'] / 100)) * $item['quantity'];
        }
        return $subTotal;
    }

    private function getTotalQuantity()
    {
        $data = session()->get('cart');
        $totalQty = session()->get('cart') ? $data['cart']['totalQty'] : 0;
        foreach ($this->items as $item) {
            $totalQty += $item['quantity'];
        }
        return $totalQty;
    }
}
