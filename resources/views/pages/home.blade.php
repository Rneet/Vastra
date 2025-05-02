@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center bg-cover bg-center" style="background-image: url('{{ asset('images/bridal-attire.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container mx-auto px-4 relative z-10 text-white">
            <div class="max-w-xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Celebrate the Rich Heritage of Indian Textiles</h1>
                <p class="text-xl mb-8">Discover authentic traditional clothing handcrafted by artisans across India. From elegant sarees to regal sherwanis.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products') }}" class="bg-yellow-500 text-black px-6 py-3 rounded-md font-medium hover:bg-yellow-400 transition-colors duration-300">
                        Explore Collection
                    </a>
                    <a href="{{ route('contact') }}" class="border-2 border-white text-white px-6 py-3 rounded-md font-medium hover:bg-white hover:text-black transition-colors duration-300">
                        Our Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore by Region -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">Explore by Region</h2>
            <p class="text-gray-600 text-center mb-12">India's diverse cultural heritage is reflected in its traditional clothing. Discover distinct styles from various regions.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- North Indian -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/north.jpeg') }}" alt="North Indian" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">North Indian</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Elegant phulkari embroidery, vibrant lehengas, intricate kashmir needlework</p>
                        <a href="{{ route('collection', ['region' => 'north-indian']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- South Indian -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/south.jpeg') }}" alt="South Indian" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">South Indian</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Rich silk sarees, temple-inspired motifs, Kanjivaram and Pochampally weaves</p>
                        <a href="{{ route('collection', ['region' => 'south-indian']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- East Indian -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/east-indian.jpg') }}" alt="East Indian" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">East Indian</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Exquisite Jamdani weaves, delicate Baluchari silk, bold Sambalpuri patterns</p>
                        <a href="{{ route('collection', ['region' => 'east-indian']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- West Indian -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/download.jpeg') }}" alt="West Indian" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">West Indian</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Vibrant bandhani tie-dye, mirror work embellishments, earthy Ajrakh prints</p>
                        <a href="{{ route('collection', ['region' => 'west-indian']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Northeast Indian -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/northeast.jpeg') }}" alt="Northeast Indian" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">Northeast Indian</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Bold geometric patterns, tribal motifs, colorful Mekhela-Chador ensembles</p>
                        <a href="{{ route('collection', ['region' => 'northeast-indian']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Fusion Wear -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/modern.jpeg') }}" alt="Fusion Wear" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-xl font-bold text-white">Fusion Wear</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Contemporary Indian clothing, traditional crafts with modern aesthetics</p>
                        <a href="{{ route('collection', ['region' => 'fusion-wear']) }}" class="text-secondary font-medium flex items-center">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Collection -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold">Featured Collection</h2>
                    <p class="text-gray-600 mt-2">Handpicked traditional garments that celebrate Indian craftsmanship</p>
                </div>
                <a href="{{ route('products') }}" class="text-primary font-medium flex items-center">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Banarasi Silk Saree -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <div class="absolute top-2 left-2 bg-yellow-500 text-xs font-bold px-2 py-1 rounded z-10">20% Off</div>
                        <div class="aspect-w-1">
                            <img src="{{ asset('images/product-1.jpeg') }}" alt="Banarasi Silk Saree" class="transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Saree</p>
                        <h3 class="text-lg font-medium mb-2">Banarasi Silk Saree</h3>
                        <div class="flex items-center">
                            <span class="text-lg font-bold">₹2,499</span>
                            <span class="text-gray-400 line-through text-sm ml-2">₹2,999</span>
                        </div>
                    </div>
                </div>
                
                <!-- Kutch Embroidered Sherwani -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <div class="absolute top-2 left-2 bg-yellow-500 text-xs font-bold px-2 py-1 rounded z-10">15% Off</div>
                        <div class="aspect-w-1">
                            <img src="{{ asset('images/product-2.jpeg') }}" alt="Designer Lehenga Choli" class="transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Lehenga</p>
                        <h3 class="text-lg font-medium mb-2">Designer Lehenga Choli</h3>
                        <div class="flex items-center">
                            <span class="text-lg font-bold">₹4,999</span>
                            <span class="text-gray-400 line-through text-sm ml-2">₹5,999</span>
                        </div>
                    </div>
                </div>
                
                <!-- Kanjeevaram Silk Saree -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <div class="absolute top-2 left-2 bg-yellow-500 text-xs font-bold px-2 py-1 rounded z-10">25% Off</div>
                        <img src="{{ asset('images/product-5.jpeg') }}" alt="Kanjeevaram Silk Saree" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Saree</p>
                        <h3 class="text-lg font-medium mb-2">Kanjeevaram Silk Saree</h3>
                        <div class="flex items-center">
                            <span class="text-lg font-bold">₹3,999</span>
                            <span class="text-gray-400 line-through text-sm ml-2">₹4,499</span>
                        </div>
                    </div>
                </div>
                
                <!-- Muga Silk Mekhela Chador -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <div class="absolute top-2 left-2 bg-yellow-500 text-xs font-bold px-2 py-1 rounded z-10">15% Off</div>
                        <img src="{{ asset('images/product-10.jpg') }}" alt="Muga Silk Mekhela Chador" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Saree</p>
                        <h3 class="text-lg font-medium mb-2">Muga Silk Mekhela Chador</h3>
                        <div class="flex items-center">
                            <span class="text-lg font-bold">₹4,500</span>
                            <span class="text-gray-400 line-through text-sm ml-2">₹4,999</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotion Banner -->
    <section class="py-16 bg-primary-dark text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Festive Collection 2025</h2>
                    <p class="text-gray-300 mb-8">Discover our exquisite festive collection of traditional sarees and lehengas with up to 40% off on selected items. Limited time wholesale offer.</p>
                    <a href="{{ route('products') }}" class="bg-secondary text-primary px-6 py-3 rounded-md font-medium hover:bg-secondary-dark transition-colors duration-300 inline-block">
                        Shop the Collection
                    </a>
                </div>
                <div class="relative">
                    <div class="absolute top-4 right-4 bg-secondary text-primary text-lg font-bold px-4 py-2 rounded-full">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Newsletter -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h2>
                <p class="text-gray-600 mb-8">Stay updated with our latest collections, exclusive offers, and fashion tips.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required class="flex-grow px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-secondary">
                    <button type="submit" class="bg-secondary text-primary px-6 py-3 rounded-md font-medium hover:bg-secondary-dark transition-colors duration-300 whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
