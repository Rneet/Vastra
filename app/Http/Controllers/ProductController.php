<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // In a real application, you would fetch products from a database
        $products = collect([
            [
                'id' => 1, 
                'name' => 'Banarasi Silk Saree', 
                'price' => 2499, 
                'original_price' => 2999,
                'discount' => 17,
                'rating' => 4.5,
                'is_new' => true,
                'image' => 'product-1.jpeg',
                'category' => 'Sarees',
                'color' => 'Red',
                'size' => 'Free Size'
            ],
            [
                'id' => 2, 
                'name' => 'Kanjivaram Silk Saree', 
                'price' => 3999, 
                'original_price' => 4599,
                'discount' => 13,
                'rating' => 5,
                'image' => 'product-5.jpeg',
                'category' => 'Sarees',
                'color' => 'Blue',
                'size' => 'Free Size'
            ],
            [
                'id' => 3, 
                'name' => 'Chanderi Cotton Saree', 
                'price' => 1299, 
                'original_price' => 1599,
                'discount' => 19,
                'rating' => 4,
                'image' => 'product-6.jpeg',
                'category' => 'Sarees',
                'color' => 'Green',
                'size' => 'Free Size'
            ],
            [
                'id' => 4, 
                'name' => 'Designer Lehenga Choli', 
                'price' => 4999, 
                'original_price' => 5999,
                'discount' => 17,
                'is_new' => true,
                'rating' => 4.5,
                'image' => 'product-4.jpeg',
                'category' => 'Lehengas',
                'color' => 'Red',
                'size' => 'M'
            ],
            [
                'id' => 5, 
                'name' => 'Mysore Silk Saree', 
                'price' => 2799, 
                'rating' => 4,
                'image' => 'product-7.jpeg',
                'category' => 'Sarees',
                'color' => 'Yellow',
                'size' => 'Free Size'
            ],
            [
                'id' => 6, 
                'name' => 'Patola Silk Saree', 
                'price' => 3499, 
                'rating' => 4.5,
                'is_new' => true,
                'image' => 'product-6.jpeg',
                'category' => 'Sarees',
                'color' => 'Purple',
                'size' => 'Free Size'
            ],
            [
                'id' => 7, 
                'name' => 'Anarkali Suit', 
                'price' => 2199, 
                'original_price' => 2599,
                'discount' => 15,
                'rating' => 4,
                'image' => 'product-8.jpeg',
                'category' => 'Suits',
                'color' => 'Pink',
                'size' => 'L'
            ],
            [
                'id' => 8, 
                'name' => 'Banarasi Dupatta', 
                'price' => 999, 
                'rating' => 4.5,
                'image' => 'product-9.jpeg',
                'category' => 'Accessories',
                'color' => 'Black',
                'size' => 'Free Size'
            ],
            [
                'id' => 9, 
                'name' => 'Embroidered Kurti', 
                'price' => 1499, 
                'original_price' => 1799,
                'discount' => 17,
                'rating' => 4,
                'is_new' => true,
                'image' => 'product-4.jpeg',
                'category' => 'Kurtis',
                'color' => 'White',
                'size' => 'S'
            ],
        ]);
        
        // Get filter parameters
        $category = $request->input('category');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 5000);
        $color = $request->input('color');
        $size = $request->input('size');
        $sort = $request->input('sort', 'newest');
        
        // Apply category filter
        if ($category && $category != 'All Categories') {
            $products = $products->filter(function ($product) use ($category) {
                return $product['category'] == $category;
            });
        }
        
        // Apply price range filter
        $products = $products->filter(function ($product) use ($minPrice, $maxPrice) {
            return $product['price'] >= $minPrice && $product['price'] <= $maxPrice;
        });
        
        // Apply color filter
        if ($color) {
            $products = $products->filter(function ($product) use ($color) {
                return $product['color'] == $color;
            });
        }
        
        // Apply size filter
        if ($size) {
            $products = $products->filter(function ($product) use ($size) {
                return $product['size'] == $size;
            });
        }
        
        // Apply sorting
        switch ($sort) {
            case 'price_low_high':
                $products = $products->sortBy('price');
                break;
            case 'price_high_low':
                $products = $products->sortByDesc('price');
                break;
            case 'most_popular':
                $products = $products->sortByDesc('rating');
                break;
            case 'newest':
            default:
                // Assuming newest products have is_new flag
                $products = $products->sortByDesc(function ($product) {
                    return isset($product['is_new']) && $product['is_new'] ? 1 : 0;
                });
                break;
        }
        
        // Get all available categories for the filter dropdown
        $categories = $products->pluck('category')->unique()->values()->all();
        
        // Get all available colors for the filter
        $colors = [
            'Black' => 'bg-black',
            'White' => 'bg-white border-2 border-gray-300',
            'Red' => 'bg-red-500',
            'Blue' => 'bg-blue-500',
            'Green' => 'bg-green-500',
            'Yellow' => 'bg-yellow-500',
            'Purple' => 'bg-purple-500',
            'Pink' => 'bg-pink-500'
        ];
        
        // Get all available sizes
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'Free Size'];
        
        // Convert collection to paginator
        $perPage = 8;
        $page = $request->get('page', 1);
        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        // Pass filter parameters to the view
        return view('pages.products', compact(
            'products', 
            'categories', 
            'colors', 
            'sizes', 
            'category', 
            'minPrice', 
            'maxPrice', 
            'color', 
            'size', 
            'sort'
        ));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $product
     * @return \Illuminate\View\View
     */
    public function show($product)
    {
        // Product data for Indian traditional clothing
        $products = [
            1 => [
                'id' => 1, 
                'name' => 'Banarasi Silk Saree', 
                'price' => 2499, 
                'original_price' => 2999,
                'discount' => 17,
                'description' => 'Exquisite Banarasi Silk Saree with intricate zari work and rich pallu. Perfect for weddings and special occasions. Comes with matching blouse piece.',
                'rating' => 4.5,
                'is_new' => true,
                'image' => 'product-1.jpeg'
            ],
            2 => [
                'id' => 2, 
                'name' => 'Kanjivaram Silk Saree', 
                'price' => 3999, 
                'original_price' => 4599,
                'discount' => 13,
                'description' => 'Authentic Kanjivaram silk saree with traditional temple border and rich pallu. Handcrafted by skilled artisans from Tamil Nadu.',
                'rating' => 5,
                'image' => 'product-2.jpeg'
            ],
            3 => [
                'id' => 3, 
                'name' => 'Chanderi Cotton Saree', 
                'price' => 1299, 
                'original_price' => 1599,
                'discount' => 19,
                'description' => 'Lightweight Chanderi Cotton Saree with golden zari border. Perfect for daily wear and casual occasions.',
                'rating' => 4,
                'image' => 'product-3.jpeg'
            ],
            4 => [
                'id' => 4, 
                'name' => 'Designer Lehenga Choli', 
                'price' => 4999, 
                'original_price' => 5999,
                'discount' => 17,
                'description' => 'Stunning designer lehenga choli with heavy embroidery work. Includes choli, lehenga and dupatta. Perfect for weddings and festive occasions.',
                'is_new' => true,
                'rating' => 4.5,
                'image' => 'product-4.jpeg'
            ],
        ];
        
        if (!isset($products[$product])) {
            abort(404);
        }
        
        return view('pages.product-detail', ['product' => $products[$product]]);
    }
}
