<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::where('deleted', 0)->get(),
            'brands' => Brand::where('deleted', 0)->get(),
            'genders' => Gender::where('deleted', 0)->get(),
            'categories' => Category::where('deleted', 0)->get(),
            'title' => 'Product'
        ];
        return view('admin/product/index')->with($data);
    }

    public function search(Request $request)
    {
        $product = Product::query();

        if ($request->product_name) {
            $product->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->from_price) {
            $product->where('price', '>=', $request->from_price);
        }

        if ($request->to_price) {
            $product->where('price', '<=', $request->to_price);
        }

        if ($request->from_discount) {
            $product->where('discount', '>=', $request->from_discount);
        }

        if ($request->to_discount) {
            $product->where('discount', '<=', $request->to_discount);
        }

        if ($request->origin) {
            $product->where('origin', 'like', '%' . $request->origin . '%');
        }

        if ($request->from_date) {
            $product->whereDate('created', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $product->whereDate('created', '<=', $request->to_date);
        }

        if ($request->brand_id) {
            $product->where('brand_id', $request->brand_id);
        }

        if ($request->gender_id) {
            $product->where('gender_id', $request->gender_id);
        }

        if ($request->category_id) {
            $product->where('category_id', $request->category_id);
        }

        $data = [
            'products' => $product->where('product.deleted', 0)->get(), 'brands' => Brand::get(),
            'genders' => Gender::get(),
            'categories' => Category::get(),
            'title' => 'Product'
        ];
        return view('admin/product/index')->with($data);
    }

    public function updateproduct(Request $request)
    {
        $data = [
            'product' => Product::find($request->get('id')),
            'brands' => Brand::get(),
            'genders' => Gender::get(),
            'categories' => Category::get(),
            'title' => 'Product'
        ];
        return view('admin/product/update')->with($data);
    }

    public function processupdateproduct(Request $request)
    {
        $data = [
            'product_name' => $request->post('product_name'),
            'price' => $request->post('price'),
            'discount' => $request->post('discount'),
            'image' => $request->post('image'),
            'description_short' => $request->post('description_short'),
            'description' => $request->post('description'),
            'origin' => $request->post('origin'),
            'quantity' => $request->post('quantity'),
            'created' => $request->post('created'),
            'brand_id' => $request->post('brand_id'),
            'gender_id' => $request->post('gender_id'),
            'category_id' => $request->post('category_id'),
        ];

        Product::where('id', $request->post('id'))->update($data);
        return redirect('admin/product');
    }

    public function addproduct()
    {
        $data = [
            'brands' => Brand::get(),
            'genders' => Gender::get(),
            'categories' => Category::get(),
            'title' => 'Product'
        ];
        return view('admin/product/addproduct')->with($data);
    }

    public function processaddproduct(Request $request)
    {
        $product = [
            'product_name' => $request->post('product_name'),
            'price' => $request->post('price'),
            'discount' => $request->post('discount'),
            'image' => $request->post('image'),
            'description_short' => $request->post('description_short'),
            'description' => $request->post('description'),
            'origin' => $request->post('origin'),
            'quantity' => $request->post('quantity'),
            'created' => Carbon::now()->format('Y-m-d'),
            'brand_id' => $request->post('brand_id'),
            'gender_id' => $request->post('gender_id'),
            'category_id' => $request->post('category_id'),
            'deleted' => 0
        ];

        Product::create($product);
        return redirect('admin/product');
    }

    public function processdeleteproduct(Request $request)
    {
        $data = [
            'deleted' => 1
        ];

        Product::where('id', $request->get('id'))->update($data);
        return redirect('admin/product');
    }
}
