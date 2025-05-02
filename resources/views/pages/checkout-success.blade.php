@extends('layouts.app')

@section('content')
    <!-- Order Success Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-sm p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Thank You for Your Order!</h1>
                    <p class="text-lg text-gray-600">Your order has been placed successfully.</p>
                </div>
                
                <div class="border-t border-b py-4 mb-6">
                    <div class="flex flex-col md:flex-row justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold mb-1">Order Details</h2>
                            <p class="text-gray-600">Order Number: <span class="font-medium">{{ $order->order_number }}</span></p>
                            <p class="text-gray-600">Date: <span class="font-medium">{{ $order->created_at->format('M d, Y') }}</span></p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <h2 class="text-lg font-semibold mb-1">Shipping Address</h2>
                            <p class="text-gray-600">{{ $order->shipping_name }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address }}</p>
                            <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zipcode }}</p>
                            <p class="text-gray-600">{{ $order->shipping_country }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between py-2 border-b">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 mr-3">
                                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover object-center">
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h3>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 0) }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-gray-900">₹{{ number_format($item->subtotal, 0) }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="space-y-2 border-b pb-4 mt-4 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">₹{{ number_format($order->total_amount, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">₹{{ number_format($order->shipping_amount, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (5%)</span>
                            <span class="font-medium">₹{{ number_format($order->tax_amount, 0) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span>₹{{ number_format($order->grand_total, 0) }}</span>
                    </div>
                </div>
                
                <div class="text-center">
                    <p class="text-gray-600 mb-4">We've sent a confirmation email to <span class="font-medium">{{ $order->shipping_email }}</span></p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('profile.orders') }}" class="inline-block bg-secondary text-white px-6 py-3 rounded-md hover:bg-secondary-dark transition-colors duration-300">
                            View My Orders
                        </a>
                        <a href="{{ route('products') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-md hover:bg-primary-dark transition-colors duration-300">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
