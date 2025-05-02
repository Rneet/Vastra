@extends('layouts.app')

@section('content')
    <!-- Hero Section with Creative Background -->
    <section class="pt-24 relative overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-secondary/5 z-0"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-secondary/10 rounded-full blur-3xl z-0"></div>
        
        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">Indian Traditional Collection</h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">Explore our exquisite range of traditional Indian ethnic wear, including sarees, lehengas, and more at wholesale prices.</p>
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    <a href="#products" class="px-6 py-3 bg-primary text-white rounded-full hover:shadow-lg transition-all transform hover:-translate-y-1">
                        Shop Now
                    </a>
                    <a href="#filters" class="px-6 py-3 border border-primary text-primary rounded-full hover:bg-primary hover:text-white hover:shadow-lg transition-all transform hover:-translate-y-1">
                        Browse Categories
                    </a>
                </div>
                
                <!-- Featured categories quick access -->
                <div class="flex flex-wrap justify-center gap-4 mt-8">
                    @foreach(['Sarees', 'Lehengas', 'Kurtis', 'Suits', 'Accessories'] as $cat)
                    <a href="{{ route('products', ['category' => $cat]) }}" 
                       class="px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full text-gray-700 hover:bg-secondary hover:text-white transition-all shadow-sm">
                        {{ $cat }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section with Enhanced Design -->
    <section class="py-12" id="products">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar with Improved Design -->
                <div class="lg:w-1/4" id="filters">
                    <form action="{{ route('products') }}" method="GET" id="filter-form">
                        <div class="bg-white p-6 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow border border-gray-100">
                            <h3 class="font-bold text-lg mb-4 pb-2 border-b flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2 text-primary"><path d="M4 21v-13a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H8l-4 4"></path><line x1="12" y1="11" x2="12" y2="11"></line><line x1="12" y1="7" x2="12" y2="7"></line></svg>
                                Categories
                            </h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('products') }}" class="flex items-center justify-between text-gray-700 hover:text-secondary {{ !request('category') ? 'text-secondary font-semibold' : '' }} hover:pl-1 transition-all">
                                        <span>All Products</span>
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ count($categories ?? []) }}</span>
                                    </a>
                                </li>
                                @foreach($categories ?? [] as $cat)
                                <li>
                                    <a href="{{ route('products', array_merge(request()->except('page', 'category'), ['category' => $cat])) }}" 
                                       class="flex items-center justify-between text-gray-700 hover:text-secondary {{ request('category') == $cat ? 'text-secondary font-semibold' : '' }} hover:pl-1 transition-all">
                                        <span>{{ $cat }}</span>
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                                            {{ $products->total() }}
                                        </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow border border-gray-100">
                            <h3 class="font-bold text-lg mb-4 pb-2 border-b flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2 text-primary"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                Price Range
                            </h3>
                            <div class="mb-4">
                                <div class="flex justify-between mb-2">
                                    <span id="min-price-display" class="text-primary font-medium">₹{{ $minPrice ?? 0 }}</span>
                                    <span id="max-price-display" class="text-primary font-medium">₹{{ $maxPrice ?? 5000 }}</span>
                                </div>
                                <div class="relative mt-4">
                                    <div class="h-1 bg-gray-200 rounded-full w-full absolute top-1/2 -translate-y-1/2"></div>
                                    <input type="range" min="0" max="5000" value="{{ $minPrice ?? 0 }}" class="w-full appearance-none bg-transparent pointer-events-none absolute top-0 h-2" id="min-price" name="min_price">
                                    <input type="range" min="0" max="5000" value="{{ $maxPrice ?? 5000 }}" class="w-full appearance-none bg-transparent pointer-events-none absolute top-0 h-2" id="max-price" name="max_price">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-secondary text-primary px-4 py-2 rounded-md font-medium hover:bg-secondary-dark transition-colors duration-300 mt-4 hover:shadow-md">
                                Apply Filter
                            </button>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow border border-gray-100">
                            <h3 class="font-bold text-lg mb-4 pb-2 border-b flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2 text-primary"><path d="M12 15v2m0 4h5m-6 0a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path></svg>
                                Colors
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($colors ?? [] as $colorName => $colorClass)
                                <button type="button" onclick="selectColor('{{ $colorName }}')" 
                                    class="w-8 h-8 rounded-full {{ $colorClass }} {{ $color == $colorName ? 'ring-2 ring-offset-2 ring-secondary' : 'border-2 border-transparent' }} focus:border-secondary">
                                </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="color" id="selected-color" value="{{ $color ?? '' }}">
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow border border-gray-100">
                            <h3 class="font-bold text-lg mb-4 pb-2 border-b flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2 text-primary"><path d="M12 15v2m0 4h5m-6 0a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"></path></svg>
                                Size
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($sizes ?? [] as $sizeOption)
                                <button type="button" onclick="selectSize('{{ $sizeOption }}')"
                                    class="w-10 h-10 flex items-center justify-center border {{ $size == $sizeOption ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }} rounded hover:bg-secondary hover:text-white hover:border-secondary transition-colors">
                                    {{ $sizeOption == 'Free Size' ? 'FS' : $sizeOption }}
                                </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="size" id="selected-size" value="{{ $size ?? '' }}">
                        </div>
                    </form>
                </div>

                <!-- Products Grid with Enhanced Design -->
                <div class="lg:w-3/4">
                    <div class="bg-white p-6 rounded-lg shadow-sm mb-8 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex flex-wrap justify-between items-center">
                            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                                <button class="flex items-center text-sm font-medium px-3 py-2 bg-gray-100 rounded-md hover:bg-primary hover:text-white transition-all" onclick="toggleFilters()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M3 6h18"></path><path d="M7 12h10"></path><path d="M10 18h4"></path></svg>
                                    Filter
                                </button>
                                <div class="h-5 border-r border-gray-300"></div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">Category:</span>
                                    <select class="text-sm border-none focus:ring-0 bg-gray-100 rounded-md py-2 px-3" onchange="window.location.href = this.value">
                                        <option value="{{ route('products', request()->except('category', 'page')) }}" {{ !request('category') ? 'selected' : '' }}>All Categories</option>
                                        @foreach($categories ?? [] as $cat)
                                        <option value="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => $cat])) }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-500 mr-2">Sort by:</span>
                                <select class="text-sm border-none focus:ring-0 bg-gray-100 rounded-md py-2 px-3" id="sort-select" onchange="updateSort(this.value)">
                                    <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_low_high" {{ $sort == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high_low" {{ $sort == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="most_popular" {{ $sort == 'most_popular' ? 'selected' : '' }}>Most Popular</option>
                                </select>
                                <input type="hidden" name="sort" form="filter-form" id="sort-input" value="{{ $sort ?? 'newest' }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Products with Enhanced Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-1">
                            <div class="relative overflow-hidden">
                                <!-- Product image with zoom effect -->
                                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" 
                                     class="w-full h-64 object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                
                                <!-- Wishlist heart button (always visible) -->
                                <div class="absolute top-2 right-2 z-10">
                                    <button type="button" class="toggle-wishlist-btn w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center hover:bg-secondary hover:text-white transition-colors" data-product-id="{{ $product['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ in_array($product['id'], array_keys(session('wishlist', []))) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" class="heart-icon {{ in_array($product['id'], array_keys(session('wishlist', []))) ? 'text-red-500' : 'text-gray-600' }}"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    </button>
                                </div>
                                
                                <!-- Quick actions overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('products.show', ['product' => $product['id']]) }}" class="w-10 h-10 rounded-full bg-white flex items-center justify-center hover:bg-secondary hover:text-white transition-colors duration-300 transform hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Product badges with improved design -->
                                @if(isset($product['is_new']) && $product['is_new'])
                                <div class="absolute top-2 left-2">
                                    <span class="bg-secondary text-white text-xs px-3 py-1.5 rounded-full font-medium shadow-md">New</span>
                                </div>
                                @endif
                                
                                @if(isset($product['discount']) && $product['discount'] > 0)
                                <div class="absolute top-2 right-2">
                                    <span class="bg-red-500 text-white text-xs px-3 py-1.5 rounded-full font-medium shadow-md">-{{ $product['discount'] }}%</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="p-4">
                                <!-- Category tag -->
                                <div class="mb-2">
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $product['category'] ?? 'Traditional' }}</span>
                                </div>
                                
                                <!-- Product name with hover effect -->
                                <h3 class="text-lg font-medium mb-1 group-hover:text-primary transition-colors">{{ $product['name'] }}</h3>
                                
                                <!-- Rating with animated stars -->
                                <div class="flex items-center mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product['rating'])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400 group-hover:animate-pulse"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                        @endif
                                    @endfor
                                    <span class="text-gray-500 text-xs ml-1">({{ $product['rating'] }})</span>
                                </div>
                                
                                <!-- Price with animated discount -->
                                <div class="flex items-center mb-4">
                                    <span class="text-lg font-bold mr-2 text-primary">₹{{ number_format($product['price'], 0) }}</span>
                                    @if(isset($product['original_price']) && $product['original_price'] > 0)
                                        <span class="text-gray-400 text-sm line-through">₹{{ number_format($product['original_price'], 0) }}</span>
                                        <span class="ml-2 text-xs text-green-500 font-medium">Save ₹{{ number_format($product['original_price'] - $product['price'], 0) }}</span>
                                    @endif
                                </div>
                                
                                <!-- Add to cart button with animation -->
                                <div class="relative z-10">
                                    <button type="button" class="add-to-cart-btn w-full bg-primary text-white py-2.5 rounded-md hover:bg-primary-dark transition-colors duration-300 flex items-center justify-center group-hover:shadow-md" data-product-id="{{ $product['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Enhanced Empty State -->
                    @if($products->isEmpty())
                    <div class="text-center py-16 bg-white rounded-lg shadow-sm border border-gray-100">
                        <div class="relative mx-auto w-24 h-24 mb-6">
                            <div class="absolute inset-0 bg-secondary/10 rounded-full animate-ping"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No products found</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">We couldn't find any products matching your current filters. Try adjusting your search criteria or browse our collections.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('products') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-secondary hover:bg-secondary-dark focus:outline-none transition-all transform hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg>
                                Clear all filters
                            </a>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-secondary text-sm font-medium rounded-full shadow-sm text-secondary hover:bg-secondary hover:text-white focus:outline-none transition-all transform hover:-translate-y-1">
                                Explore Collections
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Pagination -->
    <section class="pb-16">
        <div class="container mx-auto px-4">
            @if(isset($products) && $products->hasPages())
            <div class="flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed rounded-l-md">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-l-md transition-colors">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-secondary bg-secondary text-sm font-medium text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-r-md transition-colors">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed rounded-r-md">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
            @endif
        </div>
    </section>

    <!-- Add JavaScript for interactive elements -->
    <script>
        // Function to toggle filters on mobile
        function toggleFilters() {
            const filterForm = document.getElementById('filter-form');
            filterForm.classList.toggle('hidden');
        }
        
        // Function to update sort
        function updateSort(value) {
            document.getElementById('sort-input').value = value;
            document.getElementById('filter-form').submit();
        }
        
        // Function to select color
        function selectColor(color) {
            document.getElementById('selected-color').value = color;
            document.getElementById('filter-form').submit();
        }
        
        // Function to select size
        function selectSize(size) {
            document.getElementById('selected-size').value = size;
            document.getElementById('filter-form').submit();
        }
        
        // Price range slider functionality
        document.addEventListener('DOMContentLoaded', function() {
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');
            const minPriceDisplay = document.getElementById('min-price-display');
            const maxPriceDisplay = document.getElementById('max-price-display');
            
            if(minPriceInput && maxPriceInput) {
                minPriceInput.addEventListener('input', function() {
                    minPriceDisplay.textContent = '₹' + this.value;
                    if(parseInt(minPriceInput.value) > parseInt(maxPriceInput.value)) {
                        maxPriceInput.value = minPriceInput.value;
                        maxPriceDisplay.textContent = '₹' + maxPriceInput.value;
                    }
                });
                
                maxPriceInput.addEventListener('input', function() {
                    maxPriceDisplay.textContent = '₹' + this.value;
                    if(parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
                        minPriceInput.value = maxPriceInput.value;
                        minPriceDisplay.textContent = '₹' + minPriceInput.value;
                    }
                });
            }
        });
    </script>
    <!-- Shop Page Scripts (Cart and Wishlist) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Add to Cart button clicks
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const originalText = this.innerHTML;
                    const button = this;
                    
                    // Show loading state
                    button.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...';
                    button.disabled = true;
                    
                    // Send AJAX request to add item to cart
                    fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success state
                            button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M20 6L9 17l-5-5"></path></svg> Added!';
                            
                            // Update cart count in navbar
                            updateCartCount(data.cart_count);
                            
                            // Show toast notification
                            showToast(data.product_name + ' added to cart!', 'success');
                            
                            // Reset button after 2 seconds
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }, 2000);
                        } else {
                            // Show error state
                            button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M18 6L6 18M6 6l12 12"></path></svg> Error';
                            
                            // Reset button after 2 seconds
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        
                        // Show error state
                        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M18 6L6 18M6 6l12 12"></path></svg> Error';
                        
                        // Reset button after 2 seconds
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }, 2000);
                    });
                });
            });
            
            // Handle Wishlist toggle button clicks
            const wishlistButtons = document.querySelectorAll('.toggle-wishlist-btn');
            
            wishlistButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const heartIcon = this.querySelector('.heart-icon');
                    const isInWishlist = heartIcon.getAttribute('fill') === 'currentColor';
                    
                    // Disable button during request
                    button.disabled = true;
                    
                    // Optimistic UI update - toggle heart fill immediately
                    if (isInWishlist) {
                        heartIcon.setAttribute('fill', 'none');
                        heartIcon.classList.remove('text-red-500');
                        heartIcon.classList.add('text-gray-600');
                    } else {
                        heartIcon.setAttribute('fill', 'currentColor');
                        heartIcon.classList.remove('text-gray-600');
                        heartIcon.classList.add('text-red-500');
                        
                        // Add heart animation
                        button.classList.add('animate-pulse');
                        setTimeout(() => {
                            button.classList.remove('animate-pulse');
                        }, 500);
                    }
                    
                    // Send AJAX request to toggle wishlist status
                    const endpoint = isInWishlist ? '{{ route('wishlist.remove') }}' : '{{ route('wishlist.add') }}';
                    
                    fetch(endpoint, {
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
                            // Show toast notification
                            const message = isInWishlist 
                                ? data.product_name + ' removed from wishlist!' 
                                : data.product_name + ' added to wishlist!';
                            
                            showToast(message, isInWishlist ? 'info' : 'success');
                            
                            // If server response doesn't match our optimistic update, revert the UI
                            if (isInWishlist && data.added) {
                                heartIcon.setAttribute('fill', 'currentColor');
                                heartIcon.classList.remove('text-gray-600');
                                heartIcon.classList.add('text-red-500');
                            } else if (!isInWishlist && !data.added && data.message.includes('already')) {
                                // Product was already in wishlist, keep it filled
                                heartIcon.setAttribute('fill', 'currentColor');
                                heartIcon.classList.remove('text-gray-600');
                                heartIcon.classList.add('text-red-500');
                            }
                        } else {
                            // Revert UI on error
                            if (isInWishlist) {
                                heartIcon.setAttribute('fill', 'currentColor');
                                heartIcon.classList.remove('text-gray-600');
                                heartIcon.classList.add('text-red-500');
                            } else {
                                heartIcon.setAttribute('fill', 'none');
                                heartIcon.classList.remove('text-red-500');
                                heartIcon.classList.add('text-gray-600');
                            }
                            
                            showToast('Error updating wishlist', 'error');
                        }
                        
                        // Re-enable button
                        button.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error updating wishlist:', error);
                        
                        // Revert UI on error
                        if (isInWishlist) {
                            heartIcon.setAttribute('fill', 'currentColor');
                            heartIcon.classList.remove('text-gray-600');
                            heartIcon.classList.add('text-red-500');
                        } else {
                            heartIcon.setAttribute('fill', 'none');
                            heartIcon.classList.remove('text-red-500');
                            heartIcon.classList.add('text-gray-600');
                        }
                        
                        showToast('Error updating wishlist', 'error');
                        button.disabled = false;
                    });
                });
            });
            
            // Function to update cart count in navbar
            function updateCartCount(count) {
                const cartCountElements = document.querySelectorAll('.cart-count');
                if (cartCountElements.length > 0) {
                    cartCountElements.forEach(el => {
                        el.textContent = count;
                        // Show badge if it was hidden
                        if (count > 0) {
                            el.style.display = 'flex';
                        }
                    });
                }
            }
            
            // Function to show toast notification
            function showToast(message, type = 'success') {
                // Create toast element if it doesn't exist
                let toast = document.getElementById('shop-toast');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'shop-toast';
                    document.body.appendChild(toast);
                }
                
                // Set toast style based on type
                let bgColor, icon;
                switch(type) {
                    case 'success':
                        bgColor = 'bg-green-500';
                        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M20 6L9 17l-5-5"></path></svg>';
                        break;
                    case 'error':
                        bgColor = 'bg-red-500';
                        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M18 6L6 18M6 6l12 12"></path></svg>';
                        break;
                    case 'info':
                        bgColor = 'bg-blue-500';
                        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>';
                        break;
                    default:
                        bgColor = 'bg-green-500';
                        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-2"><path d="M20 6L9 17l-5-5"></path></svg>';
                }
                
                toast.className = `fixed top-20 right-4 ${bgColor} text-white px-4 py-2 rounded-lg shadow-lg transform transition-all duration-500 translate-x-full opacity-0 z-50 flex items-center`;
                
                // Set message and show toast
                toast.innerHTML = `${icon} ${message}`;
                
                // Animate toast in
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                }, 10);
                
                // Animate toast out after 3 seconds
                setTimeout(() => {
                    toast.classList.add('translate-x-full', 'opacity-0');
                }, 3000);
            }
        });
    </script>
@endsection
