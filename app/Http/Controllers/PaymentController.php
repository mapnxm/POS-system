<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;

class PaymentController extends Controller
{
    private function calculateTotal($cart)
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    }
    
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'customer_phone' => 'required|numeric',
            'payment_type' => 'required|numeric'
        ]);
    
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('menu.index')->with('error', 'Keranjang kosong');
        }
    
        $total = $this->calculateTotal($cart);
    
        $customer = Customers::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('customer_phone'),
        ]);

        // All payment types are considered paid for dummy implementation
        $paymentType = $request->input('payment_type');
        $paymentStatus = 'paid';
    
        $order = Order::create([
            'id' => random_int(100000, 999999),
            'customer_id' => $customer->id,
            'total' => $total,
            'payment_type_id' => $paymentType,
            'payment_status' => $paymentStatus
        ]);
    
        foreach ($cart as $id => $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        session()->forget('cart');
        return redirect()->route('orders.finish', $order->id)->with('success', 'Pesanan berhasil dibuat!');
    }
}