<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::take(11)->get();
        $product = product::all();
        return view('products.list', [
            "categories" => $categories,
            "products" => $product
        ]);
    }
    public function show($slog)
    {
        $product = product::where('slog', $slog)->first();
        dd($product->categories->toArray());
        return view('products.show', [
            "product" => $product
        ]);
    }
}