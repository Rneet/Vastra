@extends('layouts.app')
@section('content')
<!-- Collection Page -->
<div class="container mx-auto px-4 pt-24 pb-8"> 
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary">Home</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('products') }}" class="text-gray-500 hover:text-primary">Shop</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li><span class="text-primary">{{ $region }}</span></li>
        </ol>
    </nav>
    <h1 class="text-3xl font-bold mb-8">{{ $region }} Collection</h1>
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="mb-2 flex justify-between items-center">
                <a href="{{ route('collection', ['region' => $region]) }}" class="text-primary text-sm hover:underline">Clear All filters</a>
            </div>
            <!-- Region Filter -->
            <div class="mb-6">
                <div class="flex justify-between items-center cursor-pointer mb-2" onclick="toggleFilter('region')">
                    <h3 class="font-semibold">Region</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="region-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div id="region-filter" class="space-y-2">
                    <div class="flex items-center">
                        <input type="radio" id="north-indian" name="region" value="north-indian" {{ $region == 'north-indian' ? 'checked' : '' }} class="mr-2">
                        <label for="north-indian">North Indian</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="south-indian" name="region" value="south-indian" {{ $region == 'south-indian' ? 'checked' : '' }} class="mr-2">
                        <label for="south-indian">South Indian</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="east-indian" name="region" value="east-indian" {{ $region == 'east-indian' ? 'checked' : '' }} class="mr-2">
                        <label for="east-indian">East Indian</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="west-indian" name="region" value="west-indian" {{ $region == 'west-indian' ? 'checked' : '' }} class="mr-2">
                        <label for="west-indian">West Indian</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="northeast-indian" name="region" value="northeast-indian" {{ $region == 'northeast-indian' ? 'checked' : '' }} class="mr-2">
                        <label for="northeast-indian">Northeast Indian</label>
                    </div>
                </div>
            </div>
            <!-- Category Filter -->
            <div class="mb-6">
                <div class="flex justify-between items-center cursor-pointer mb-2" onclick="toggleFilter('category')">
                    <h3 class="font-semibold">Category</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="category-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div id="category-filter" class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="saree" name="category[]" value="saree" class="mr-2">
                        <label for="saree">Saree</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="lehenga" name="category[]" value="lehenga" class="mr-2">
                        <label for="lehenga">Lehenga</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="kurta" name="category[]" value="kurta" class="mr-2">
                        <label for="kurta">Kurta</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="sherwani" name="category[]" value="sherwani" class="mr-2">
                        <label for="sherwani">Sherwani</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="dhoti" name="category[]" value="dhoti" class="mr-2">
                        <label for="dhoti">Dhoti</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="salwar-kameez" name="category[]" value="salwar-kameez" class="mr-2">
                        <label for="salwar-kameez">Salwar Kameez</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="anarkali" name="category[]" value="anarkali" class="mr-2">
                        <label for="anarkali">Anarkali</label>
                    </div>
                </div>
            </div>
            <!-- Price Range Filter -->
            <div class="mb-6">
                <div class="flex justify-between items-center cursor-pointer mb-2" onclick="toggleFilter('price')">
                    <h3 class="font-semibold">Price Range</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="price-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div id="price-filter" class="space-y-2">
                    <div class="flex items-center">
                        <input type="radio" id="price-under-1000" name="price_range" value="under-1000" class="mr-2">
                        <label for="price-under-1000">Under ₹1,000</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price-1000-5000" name="price_range" value="1000-5000" class="mr-2">
                        <label for="price-1000-5000">₹1,000 - ₹5,000</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price-5000-10000" name="price_range" value="5000-10000" class="mr-2">
                        <label for="price-5000-10000">₹5,000 - ₹10,000</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price-10000-15000" name="price_range" value="10000-15000" class="mr-2">
                        <label for="price-10000-15000">₹10,000 - ₹15,000</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price-above-15000" name="price_range" value="above-15000" class="mr-2">
                        <label for="price-above-15000">Above ₹15,000</label>
                    </div>
                </div>
            </div>
            <!-- Occasion Filter -->
            <div class="mb-6">
                <div class="flex justify-between items-center cursor-pointer mb-2" onclick="toggleFilter('occasion')">
                    <h3 class="font-semibold">Occasion</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="occasion-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div id="occasion-filter" class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="wedding" name="occasion[]" value="wedding" class="mr-2">
                        <label for="wedding">Wedding</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="festival" name="occasion[]" value="festival" class="mr-2">
                        <label for="festival">Festival</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="casual" name="occasion[]" value="casual" class="mr-2">
                        <label for="casual">Casual</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products Grid -->
        <div class="lg:w-3/4">
            <!-- Products Header -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">{{ count($products) }} products</p>
                <div class="flex items-center">
                    <span class="mr-2">Sort by:</span>
                    <select class="border rounded-md px-2 py-1">
                        <option value="featured">Featured</option>
                        <option value="price-low-high">Price: Low to High</option>
                        <option value="price-high-low">Price: High to Low</option>
                        <option value="newest">Newest</option>
                    </select>
                </div>
            </div>
            @if(count($products) > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="group border rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <a href="{{ route('product.show', $product->id) }}" class="block">
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @if($product->discount_percentage > 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                {{ $product->discount_percentage }}% OFF
                            </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-medium mb-1">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm mb-2">{{ $product->category }}</p>
                        <div class="flex items-center mb-2">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < floor($product->rating))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-yellow-400"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                @endif
                            @endfor
                            <span class="text-gray-500 text-xs ml-1">({{ $product->review_count }})</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                @if($product->original_price > $product->price)
                                <span class="text-gray-400 line-through text-sm mr-2">₹{{ number_format($product->original_price, 0) }}</span>
                                @endif
                                <span class="text-lg font-bold">₹{{ number_format($product->price, 0) }}</span>
                            </div>
                            <button class="bg-primary text-white p-2 rounded-full hover:bg-primary-dark transition-colors duration-300" title="Add to Cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- No Products Found -->
            <div class="text-center py-12 border rounded-lg">
                <p class="text-gray-600 mb-4">No products match your selected filters</p>
                <a href="{{ route('collection', ['region' => $region]) }}" class="text-primary hover:underline">Clear all filters</a>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    function toggleFilter(type) {
        const filter = document.getElementById(`${type}-filter`);
        const icon = document.getElementById(`${type}-icon`);
        if (filter.classList.contains('hidden')) {
            filter.classList.remove('hidden');
            icon.classList.remove('rotate-180');
        } else {
            filter.classList.add('hidden');
            icon.classList.add('rotate-180');
        }
    }
    document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
@endsection
