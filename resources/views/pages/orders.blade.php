@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-6">
                        {{ substr($user->name ?? 'User', 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $user->name ?? 'User' }}</h1>
                        <p class="text-gray-500">Member since {{ \Carbon\Carbon::parse($user->created_at ?? now())->format('F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile Navigation -->
            <div class="flex flex-wrap mb-6 gap-2">
                <a href="{{ route('profile') }}" class="px-4 py-2 bg-white text-gray-700 rounded-md hover:bg-gray-100 transition-colors">My Profile</a>
                <a href="{{ route('profile.orders') }}" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">Order History</a>
            </div>

            <!-- Orders List -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold mb-6 pb-2 border-b">Order History</h2>
                
                @if(count($orders) > 0)
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="border rounded-lg overflow-hidden">
                                <!-- Order Header -->
                                <div class="bg-gray-50 p-4 border-b flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Order #{{ $order->order_number }}</h3>
                                        <p class="text-sm text-gray-500">Placed on {{ $order->formatted_date }}</p>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
                                        <div class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($order->status == 'completed') bg-green-100 text-green-800
                                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $order->formatted_status }}
                                        </div>
                                        <div class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($order->payment_status == 'paid') bg-green-100 text-green-800
                                            @elseif($order->payment_status == 'refunded') bg-purple-100 text-purple-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            Payment: {{ $order->formatted_payment_status }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Order Items -->
                                <div class="p-4 border-b">
                                    <div class="space-y-3">
                                        @foreach($order->items as $item)
                                            <div class="flex items-start py-2 @if(!$loop->last) border-b @endif">
                                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 mr-4">
                                                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover object-center">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                                    <p class="mt-1 text-sm text-gray-500">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 0) }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-900">₹{{ number_format($item->subtotal, 0) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Order Summary -->
                                <div class="p-4 bg-gray-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div class="text-sm">
                                        <p class="text-gray-500">Payment Method: <span class="font-medium text-gray-900">{{ ucfirst($order->payment_method) }}</span></p>
                                        <p class="text-gray-500">Shipping Address: <span class="font-medium text-gray-900">{{ $order->shipping_address }}, {{ $order->shipping_city }}</span></p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500">Total</div>
                                        <div class="text-lg font-medium text-gray-900">₹{{ number_format($order->grand_total, 0) }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="mx-auto text-gray-400 mb-4"><path d="M22 12h-6l-2 3h-4l-2-3H2"></path><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                        <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
                        <a href="{{ route('products') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-secondary hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
