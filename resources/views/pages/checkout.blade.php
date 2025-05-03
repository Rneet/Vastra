@extends('layouts.app')
@section('content')
    <!-- Checkout Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8">Checkout</h1>
            <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
                @csrf
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Shipping Information -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                            <div class="p-6 border-b">
                                <h2 class="text-xl font-semibold">Shipping Information</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="shipping_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" id="shipping_name" name="shipping_name" value="{{ old('shipping_name', Auth::user()->name ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="shipping_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" id="shipping_email" name="shipping_email" value="{{ old('shipping_email', Auth::user()->email ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone', Auth::user()->phone ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                    @error('shipping_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address', session('user_address.street') ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                    @error('shipping_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city', session('user_address.city') ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_city')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" id="shipping_state" name="shipping_state" value="{{ old('shipping_state', session('user_address.state') ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_state')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="shipping_zipcode" class="block text-sm font-medium text-gray-700 mb-1">Postal/Zip Code</label>
                                        <input type="text" id="shipping_zipcode" name="shipping_zipcode" value="{{ old('shipping_zipcode', session('user_address.postal_code') ?? '') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_zipcode')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <input type="text" id="shipping_country" name="shipping_country" value="{{ old('shipping_country', session('user_address.country') ?? 'India') }}" required class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                        @error('shipping_country')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                                    <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6 border-b">
                                <h2 class="text-xl font-semibold">Payment Method</h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center mb-4">
                                    <input id="payment_method_cod" name="payment_method" type="radio" value="cod" checked class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300">
                                    <label for="payment_method_cod" class="ml-2 block text-sm font-medium text-gray-700">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="payment_method_online" name="payment_method" type="radio" value="online" class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300">
                                    <label for="payment_method_online" class="ml-2 block text-sm font-medium text-gray-700">
                                        Online Payment (Credit/Debit Card, UPI, etc.)
                                    </label>
                                </div>
                                @error('payment_method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                            <div class="space-y-3 mb-4">
                                @foreach($cartItems as $item)
                                    <div class="flex items-center justify-between py-2 border-b">
                                        <div class="flex items-center">
                                            <div class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 mr-3">
                                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover object-center">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                                                <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="space-y-2 border-b pb-4 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">₹{{ number_format($subtotal, 0) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">₹{{ number_format($shipping, 0) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax (5%)</span>
                                    <span class="font-medium">₹{{ number_format($tax, 0) }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between text-lg font-bold mb-6">
                                <span>Total</span>
                                <span>₹{{ number_format($total, 0) }}</span>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white text-center py-3 rounded-md hover:bg-primary-dark transition-colors duration-300">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
