<footer class="bg-primary-dark text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Column -->
            <div class="col-span-1">
                <a href="{{ route('home') }}" class="block mb-4">
                    <span class="font-display text-2xl font-bold">Vastra</span>
                </a>
                <p class="text-gray-300 mb-4">
                    Premium clothing for the modern lifestyle.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                </div>
            </div>
            
            <!-- Shop Column -->
            <div class="col-span-1">
                <h3 class="text-lg font-semibold mb-4">Shop</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('products') }}" class="text-gray-300 hover:text-white transition-colors">All Products</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Featured</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Sale</a></li>
                </ul>
            </div>
            
            <!-- Company Column -->
            <div class="col-span-1">
                <h3 class="text-lg font-semibold mb-4">Company</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Blog</a></li>
                </ul>
            </div>
            
            <!-- Support Column -->
            <div class="col-span-1">
                <h3 class="text-lg font-semibold mb-4">Support</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Shipping</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Returns</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} Vastra. All rights reserved.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Terms of Service</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
