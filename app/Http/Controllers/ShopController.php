<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::paginate(6), 
            'brands' => Brand::get(),
            'genders' => Gender::get(),
            'categories' => Category::get(),
            'title' => 'Shop'
        ];
        return view('shop/index')->with($data);
    }

    public function search(Request $request)
    {

        $data = '';

        $filter = Product::query();

        if ($request->brand_id) {
            $filter->where('brand_id', $request->brand_id);
        }

        if ($request->gender_id) {
            $filter->where('gender_id', $request->gender_id);
        }

        if ($request->category_id) {
            $filter->where('category_id', $request->category_id);
        }

        if ($request->product_name) {
            $filter->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->price_range) {
            $filter->where('price', '>=', $request->price_range[0])->where('price', '<=', $request->price_range[1]);
        }

        if ($request->price_order == 'asc') {
            $filter->orderBy('price', 'asc');
        } else if ($request->price_order == 'desc') {
            $filter->orderBy('price', 'desc');
        }

        $products = $filter->get();

        foreach ($products as $product) {
            $data .= "<div class='col-md-6 col-lg-4'>
                <div class='card text-center card-product'>
                    <div class='card-product__img'>
                        <img class='card-img' src='" . asset('user/img/product/' . $product->image) . "' alt='' width='280' height='280'>
                        <ul class='card-product__imgOverlay'>
                            <li><a href='" . asset('details') . "?id=" . $product->id . "'><button><i class='ti-search'></i></button></li>";
                            if($product->quantity == 0) {
                                $data .= "<li><a href='" . asset('cart/add') . "/" . $product->id . "/1'><button hidden><i class='ti-shopping-cart'></i></button></a></li>
                            <span>Out of stock</span>";
                            } else {
                                $data .= "<li><a href='" . asset('cart/add'). "/" . $product->id . "/1'><button><i class='ti-shopping-cart'></i></button></a></li>";
                            }
                        $data .= "</ul>
                    </div>
                    <div class='card-body'>
                        <p>" . $product->description_short . "</p>
                        <h4 class='card-product__title'><a href='" . url('details') . "'>" . $product->product_name . "</a></h4>
                        <p class='card-product__price'>$" . $product->price . "</p>
                    </div>
                </div>
            </div>";
        }

        return Response($data);
    }
}
