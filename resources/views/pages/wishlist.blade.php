@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12 pt-24">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">My Wishlist <span class="text-gray-500 font-normal">{{ count($wishlistItems) }} {{ count($wishlistItems) == 1 ? 'item' : 'items' }}</span></h1>
        
        @if(count($wishlistItems) > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                @foreach($wishlistItems as $item)
                    <div class="border-b border-gray-100 last:border-b-0 py-6 first:pt-0 last:pb-0">
                        <div class="flex flex-col sm:flex-row items-start gap-4">
                            <!-- Product Image with Remove Button -->
                            <div class="relative">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-md">
                                <button type="button" onclick="removeFromWishlist({{ $item['id'] }})" class="absolute -top-2 -right-2 w-6 h-6 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-gray-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-500"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="font-medium text-lg mb-1">{{ $item['name'] }}</h3>
                                <p class="text-gray-500 text-sm mb-4">{{ $item['brand'] ?? 'Brand Name' }}</p>
                                <div class="flex items-center">
                                    <span class="font-bold text-lg">₹{{ number_format($item['price'], 0) }}</span>
                                    @if(isset($item['original_price']) && $item['original_price'] > 0)
                                        <span class="text-gray-400 text-sm line-through ml-2">₹{{ number_format($item['original_price'], 0) }}</span>
                                        <span class="text-green-500 text-xs ml-2">({{ round((($item['original_price'] - $item['price']) / $item['original_price']) * 100) }}% OFF)</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Move to Bag Button -->
                            <div class="w-full sm:w-auto mt-4 sm:mt-0">
                                <form action="{{ route('wishlist.move-to-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <button type="submit" class="w-full sm:w-auto border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-colors px-6 py-2 rounded-md uppercase text-sm font-medium">
                                        MOVE TO BAG
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <h2 class="text-xl font-medium mb-4">YOUR WISHLIST IS EMPTY</h2>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Add items that you like to your wishlist. Review them anytime and easily move them to the bag.</p>
                
                <div class="w-24 h-24 mx-auto mb-8 relative">
                    <div class="absolute inset-0 border-2 border-teal-200 rounded-md rotate-3"></div>
                    <div class="absolute inset-0 border-2 border-teal-200 rounded-md -rotate-3"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="text-amber-400"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                </div>
                
                <a href="{{ route('products') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-600 transition-colors">
                    CONTINUE SHOPPING
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function removeFromWishlist(productId) {
        // In a real application, this would make an AJAX call to remove the item
        if (confirm('Are you sure you want to remove this item from your wishlist?')) {
            window.location.href = '{{ route("wishlist.remove") }}?product_id=' + productId;
        }
    }
</script>
@endsection
