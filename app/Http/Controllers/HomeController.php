<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $data = [
            'products' => Product::get(),
            'trendings' => DB::table('product')
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->join('gender', 'product.gender_id', '=', 'gender.id')
                ->join('category', 'product.category_id', '=', 'category.id')
                ->select('product.*', 'brand.brand_name', 'gender.gender_name', 'category.category_name')
                ->orderby('id', 'asc')->get()->take(6),

            'bests' => DB::table('product')
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->join('gender', 'product.gender_id', '=', 'gender.id')
                ->join('category', 'product.category_id', '=', 'category.id')
                ->select('product.*', 'brand.brand_name', 'gender.gender_name', 'category.category_name')
                ->orderby('price', 'desc')->get()->take(6),

            'brands' => Brand::get(),
            'title' => 'Paaress Perfumes'

        ];

        return view('home/index')->with($data);
    }
}
