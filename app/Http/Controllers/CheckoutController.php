<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get cart items from session
        $cartItems = session('cart', []);
        
        // If cart is empty, redirect to cart page
        if (count($cartItems) === 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shipping = 99;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;
        
        return view('pages.checkout', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }
    
    /**
     * Process the checkout and create an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request)
    {
        // Validate the request
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'payment_method' => 'required|string|in:cod,online',
            'notes' => 'nullable|string|max:500',
        ]);
        
        // Get cart items from session
        $cartItems = session('cart', []);
        
        // If cart is empty, redirect to cart page
        if (count($cartItems) === 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shipping = 99;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;
        
        // Create the order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->order_number = 'ORD-' . strtoupper(Str::random(8));
        $order->total_amount = $subtotal;
        $order->tax_amount = $tax;
        $order->shipping_amount = $shipping;
        $order->grand_total = $total;
        $order->status = 'pending';
        $order->payment_status = $request->payment_method === 'cod' ? 'pending' : 'processing';
        $order->payment_method = $request->payment_method;
        $order->shipping_name = $request->shipping_name;
        $order->shipping_email = $request->shipping_email;
        $order->shipping_phone = $request->shipping_phone;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_state = $request->shipping_state;
        $order->shipping_zipcode = $request->shipping_zipcode;
        $order->shipping_country = $request->shipping_country;
        $order->notes = $request->notes;
        $order->save();
        
        // Create order items
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->product_name = $item['name'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->subtotal = $item['price'] * $item['quantity'];
            $orderItem->image = $item['image'];
            $orderItem->save();
        }
        
        // Clear the cart
        session()->forget('cart');
        
        // Redirect to thank you page
        return redirect()->route('checkout.success', ['order' => $order->id])->with('success', 'Your order has been placed successfully!');
    }
    
    /**
     * Show the order success page.
     *
     * @param  int  $order
     * @return \Illuminate\View\View
     */
    public function success($order)
    {
        $order = Order::with('items')->findOrFail($order);
        
        // Make sure the order belongs to the current user
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
        
        return view('pages.checkout-success', compact('order'));
    }
}
