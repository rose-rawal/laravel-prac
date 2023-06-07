<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        // dd($request->all());
        $product = product::find($request->product_id);
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->addItem([
            'id' => $product->id,
            'title' => $product->name,
            'quantity' => $request->quantity,
            'price' => $product->price / 100
        ]);
        return back();

    }
    public function show()
    {
        $shoppingCart = Cart::name('shopping');
        $items = $shoppingCart->getItems();
        $total = $shoppingCart->getTotal();
        $subtotal = $shoppingCart->getSubTotal();
        return view('cart', [
            'items' => $items,
            'total' => $total,
            'subtotal' => $subtotal

        ]);
    }
    public function delete(Request $request)
    {
        $hash = $request->itemHash;
        // dd($hash);
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->removeItem($hash);
        return back();
    }
}