<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Jackiedo\Cart\Facades\Cart;


class CheckoutController extends Controller
{
    //
    public function show()
    {
        $shoppingCart = Cart::name('shopping');
        $items = $shoppingCart->getItems();
        $total = $shoppingCart->getTotal();
        $subtotal = $shoppingCart->getSubTotal();
        return view('checkout', [
            'items' => $items,
            'total' => $total,
            'subtotal' => $subtotal
        ]);
    }
}