<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // No constructor needed
    
    /**
     * Display the wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get wishlist items from session or initialize empty array
        $wishlistItems = session('wishlist', []);
        
        return view('pages.wishlist', compact('wishlistItems'));
    }
    
    /**
     * Add a product to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        
        // In a real app, you would fetch product details from database
        // For demo purposes, we'll use sample data
        $products = [
            1 => [
                'id' => 1,
                'name' => 'Banarasi Silk Saree',
                'price' => 2499,
                'original_price' => 3299,
                'image' => 'product-1.jpeg',
                'brand' => 'Ethnic Elegance'
            ],
            2 => [
                'id' => 2,
                'name' => 'Kanjivaram Silk Saree',
                'price' => 3999,
                'original_price' => 5299,
                'image' => 'product-2.jpeg',
                'brand' => 'Heritage Weaves'
            ],
            3 => [
                'id' => 3,
                'name' => 'Chanderi Cotton Saree',
                'price' => 1299,
                'original_price' => 1799,
                'image' => 'product-3.jpeg',
                'brand' => 'Cotton Crafts'
            ],
            4 => [
                'id' => 4,
                'name' => 'Designer Lehenga Choli',
                'price' => 4999,
                'original_price' => 7299,
                'image' => 'product-4.jpeg',
                'brand' => 'Bridal Couture'
            ]
        ];
        
        if (!isset($products[$productId])) {
            if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ]);
            }
            return redirect()->back()->with('error', 'Product not found');
        }
        
        $product = $products[$productId];
        
        // Get current wishlist items from session
        $wishlist = session()->get('wishlist', []);
        
        // Check if product already exists in wishlist
        $alreadyInWishlist = isset($wishlist[$productId]);
        
        if (!$alreadyInWishlist) {
            $wishlist[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'original_price' => $product['original_price'],
                'image' => $product['image'],
                'brand' => $product['brand']
            ];
            
            // Update wishlist in session
            session()->put('wishlist', $wishlist);
            
            $message = 'Product added to wishlist successfully!';
        } else {
            $message = 'Product is already in your wishlist.';
        }
        
        // If it's an AJAX request, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'added' => !$alreadyInWishlist,
                'message' => $message,
                'product_name' => $product['name'],
                'wishlist_count' => count($wishlist)
            ]);
        }
        
        // For regular requests, redirect back with appropriate message
        if (!$alreadyInWishlist) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('info', $message);
        }
    }
    
    /**
     * Remove a product from the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Get current wishlist items from session
        $wishlist = session()->get('wishlist', []);
        
        // Get product name before removing it (for the response message)
        $productName = isset($wishlist[$productId]) ? $wishlist[$productId]['name'] : '';
        
        // Remove product from wishlist if it exists
        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            
            // Update wishlist in session
            session()->put('wishlist', $wishlist);
            
            // If it's an AJAX request, return JSON response
            if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist successfully!',
                    'product_name' => $productName,
                    'wishlist_count' => count($wishlist)
                ]);
            }
            
            return redirect()->route('wishlist')->with('success', 'Product removed from wishlist successfully!');
        }
        
        // If it's an AJAX request, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist.'
            ]);
        }
        
        return redirect()->route('wishlist')->with('error', 'Product not found in wishlist.');
    }
    
    /**
     * Move a product from wishlist to cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToCart(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Get current wishlist and cart items from session
        $wishlist = session()->get('wishlist', []);
        $cart = session()->get('cart', []);
        
        // Check if product exists in wishlist
        if (!isset($wishlist[$productId])) {
            return redirect()->route('wishlist')->with('error', 'Product not found in wishlist.');
        }
        
        $product = $wishlist[$productId];
        
        // Add product to cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image']
            ];
        }
        
        // Remove product from wishlist
        unset($wishlist[$productId]);
        
        // Update session
        session()->put('wishlist', $wishlist);
        session()->put('cart', $cart);
        
        return redirect()->route('cart')->with('success', 'Product moved to cart successfully!');
    }
}
