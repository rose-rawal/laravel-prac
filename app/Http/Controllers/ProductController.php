<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filterCategorySlog = $request->get('category');

        $categories = Category::take(11)->get();
        $category = Category::where('slog', $filterCategorySlog)->first();
        // dd($category);
        // $product = $category->products()->get() || product::all();
        if ($category) {
            $product = $category->products()->get();
        } else {
            $product = product::all();
        }
        return view('products.list', [
            "categories" => $categories,
            "products" => $product
        ]);
    }
    public function show($slog)
    {
        $product = product::where('slog', $slog)->first();
        // dd($product->categories->toArray());
        return view('products.show', [
            "product" => $product
        ]);
    }
}