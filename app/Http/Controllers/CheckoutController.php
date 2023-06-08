<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Payment;
use App\Models\Paymentgateways;
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
    public function store(Request $request)
    {
        $shoppingCart = Cart::name('shopping');
        $items = $shoppingCart->getItems();
        $total = $shoppingCart->getTotal();
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'province' => 'required',
            'district' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'payment_gateway' => 'required',

        ]);
        $address = Address::create([
            'country' => $data['country'],
            'province' => $data['province'],
            'district' => $data['district'],
            'street_address' => $data['address'],
            'zip_code' => $data['postcode']


        ]);
        $paymentGateway = Paymentgateways::where('code', $data['payment_gateway'])->first();
        $payment = Payment::create([
            'payment_gateway' => $paymentGateway->id,
            'status' => 'NOT_PAID',
            'price_paid' => 0
        ]);

        $order = Orders::create([
            'tracking_id' => "ORG-" . uniqid(),
            'total' => $total,
            'name' => $data['firstname'] . " " . $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'billing_id' => $address->id,
            'shipping_id' => $address->id,
            'payment_id' => $payment->id

        ]);
        foreach ($items as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->getId(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice() * 100,
                'name' => $item->getTitle(),
            ]);
        }
        $shoppingCart->destroy();
        return redirect()->route('payment.show', ['paymentgateway' => $data['payment_gateway']]);
    }
}