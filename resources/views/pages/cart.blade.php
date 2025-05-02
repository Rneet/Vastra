@extends('layouts.app')

@section('content')
    <!-- Cart Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8">Your Shopping Cart</h1>
            
            @if(count($cartItems) > 0)
                <div class="flex flex-col lg:flex-row gap-8 cart-items-container">
                    <!-- Cart Items -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6 border-b">
                                <h2 class="text-xl font-semibold">Cart Items ({{ count($cartItems) }})</h2>
                            </div>
                            
                            <div class="divide-y">
                                @foreach($cartItems as $id => $item)
                                <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4" id="cart-item-{{ $id }}">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 flex-shrink-0">
                                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded">
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-grow">
                                        <h3 class="font-medium text-lg">{{ $item['name'] }}</h3>
                                        <p class="text-gray-500 text-sm mb-2">Product ID: {{ $id }}</p>
                                        <div class="flex items-center mt-2">
                                            <span class="text-primary-dark font-bold">₹{{ number_format($item['price'], 0) }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center border rounded-md">
                                        <button type="button" class="px-3 py-1 border-r update-quantity" data-product-id="{{ $id }}" data-action="decrease">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                        </button>
                                        <input type="number" min="1" value="{{ $item['quantity'] }}" class="w-12 text-center border-none focus:ring-0 quantity-input" data-product-id="{{ $id }}">
                                        <button type="button" class="px-3 py-1 border-l update-quantity" data-product-id="{{ $id }}" data-action="increase">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Subtotal and Remove -->
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="font-semibold subtotal" data-product-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                            ₹{{ number_format($item['price'] * $item['quantity'], 0) }}
                                        </span>
                                        <button type="button" class="remove-item-btn text-red-500 text-sm hover:text-red-700 flex items-center" data-product-id="{{ $id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Continue Shopping and Clear Cart -->
                        <div class="flex justify-between mt-6">
                            <a href="{{ route('products') }}" class="flex items-center text-primary hover:text-secondary transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="m15 18-6-6 6-6"/></svg>
                                Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24 order-summary">
                            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium subtotal-value">₹{{ number_format($total, 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium shipping-value">₹99</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tax (5%)</span>
                                    <span class="font-medium tax-value">₹{{ number_format($total * 0.05, 0) }}</span>
                                </div>
                                <div class="border-t pt-3 mt-3">
                                    <div class="flex justify-between font-bold">
                                        <span>Total</span>
                                        <span class="text-lg grand-total-value">₹{{ number_format($total + 99 + ($total * 0.05), 0) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Coupon Code -->
                            <div class="mb-6">
                                <label for="coupon" class="block text-sm font-medium text-gray-700 mb-1">Coupon Code</label>
                                <div class="flex">
                                    <input type="text" id="coupon" class="flex-grow rounded-l-md border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                                    <button type="button" class="bg-secondary text-white px-4 py-2 rounded-r-md hover:bg-secondary-dark transition-colors duration-300">Apply</button>
                                </div>
                            </div>
                            
                            <!-- Checkout Button -->
                            <a href="{{ route('checkout') }}" class="block w-full bg-primary text-white text-center py-3 rounded-md hover:bg-primary-dark transition-colors duration-300">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Your cart is empty</h2>
                    <p class="text-gray-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('products') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-md hover:bg-primary-dark transition-colors duration-300">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Update Cart Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update the order summary with new totals
            function updateOrderSummary(data) {
                // Update subtotal
                const subtotalElement = document.querySelector('.subtotal-value');
                if (subtotalElement) {
                    subtotalElement.textContent = data.total || '₹0';
                }
                
                // Update tax
                const taxElement = document.querySelector('.tax-value');
                if (taxElement) {
                    if (data.total) {
                        // Extract numeric value from total string
                        const totalValue = parseFloat(data.total.replace(/[^0-9]/g, ''));
                        const tax = totalValue * 0.05;
                        taxElement.textContent = '₹' + tax.toLocaleString('en-IN', { maximumFractionDigits: 0 });
                    } else {
                        taxElement.textContent = '₹0';
                    }
                }
                
                // Update grand total
                const grandTotalElement = document.querySelector('.grand-total-value');
                if (grandTotalElement) {
                    grandTotalElement.textContent = data.grand_total || '₹0';
                }
                
                // Update cart count in navbar
                const cartCountElements = document.querySelectorAll('.cart-count');
                if (cartCountElements.length > 0) {
                    const count = data.cart_count || 0;
                    cartCountElements.forEach(el => {
                        el.textContent = count;
                        // Hide badge if count is 0
                        if (count === 0) {
                            el.style.display = 'none';
                        }
                    });
                }
                
                // If cart is empty, reload to show empty cart template
                if (data.cart_count === 0) {
                    window.location.reload();
                }
            }
            
            // Handle quantity update buttons
            const updateButtons = document.querySelectorAll('.update-quantity');
            updateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const action = this.getAttribute('data-action');
                    const inputEl = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
                    let quantity = parseInt(inputEl.value);
                    
                    if (action === 'increase') {
                        quantity += 1;
                    } else if (action === 'decrease' && quantity > 1) {
                        quantity -= 1;
                    }
                    
                    inputEl.value = quantity;
                    
                    // Update subtotal display immediately for better UX
                    const subtotalEl = document.querySelector(`.subtotal[data-product-id="${productId}"]`);
                    if (subtotalEl) {
                        const price = parseFloat(subtotalEl.getAttribute('data-price'));
                        const subtotal = price * quantity;
                        subtotalEl.textContent = '₹' + subtotal.toLocaleString('en-IN', { maximumFractionDigits: 0 });
                    }
                    
                    // Send AJAX request to update cart
                    fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update order summary with new totals
                            updateOrderSummary(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating cart:', error);
                    });
                });
            });
            
            // Handle direct input changes
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-product-id');
                    const quantity = parseInt(this.value) || 1;
                    this.value = quantity < 1 ? 1 : quantity;
                    
                    // Update subtotal display immediately
                    const subtotalEl = document.querySelector(`.subtotal[data-product-id="${productId}"]`);
                    if (subtotalEl) {
                        const price = parseFloat(subtotalEl.getAttribute('data-price'));
                        const subtotal = price * quantity;
                        subtotalEl.textContent = '₹' + subtotal.toLocaleString('en-IN', { maximumFractionDigits: 0 });
                    }
                    
                    // Send AJAX request to update cart
                    fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update order summary with new totals
                            updateOrderSummary(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating cart:', error);
                    });
                });
            });
            
            // Handle remove item buttons - direct approach without forms
            const removeButtons = document.querySelectorAll('.remove-item-btn');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const cartItem = document.getElementById(`cart-item-${productId}`);
                    
                    // Remove the item from the DOM immediately for better UX
                    if (cartItem) {
                        cartItem.style.opacity = '0.5';
                        cartItem.style.pointerEvents = 'none';
                    }
                    
                    // Send AJAX request to remove item
                    fetch('{{ route('cart.remove') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the item from the DOM completely
                            if (cartItem) {
                                cartItem.remove();
                            }
                            
                            // Update order summary with new totals
                            updateOrderSummary(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error removing item:', error);
                        // Restore the item if there was an error
                        if (cartItem) {
                            cartItem.style.opacity = '1';
                            cartItem.style.pointerEvents = 'auto';
                        }
                    });
                });
            });
        });
    </script>
@endsection
