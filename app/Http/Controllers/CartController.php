<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    

    public function index()
    {

        $cartItems = session('cart', []);
        
        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('pages.cart', compact('cartItems', 'total'));
    }
    
    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        
        // In a real app, you would fetch product details from database
        // For demo purposes, we'll use sample data
        $products = [
            1 => [
                'id' => 1,
                'name' => 'Banarasi Silk Saree',
                'price' => 2499,
                'image' => 'product-1.jpeg'
            ],
            2 => [
                'id' => 2,
                'name' => 'Kanjivaram Silk Saree',
                'price' => 3999,
                'image' => 'product-2.jpeg'
            ],
            3 => [
                'id' => 3,
                'name' => 'Chanderi Cotton Saree',
                'price' => 1299,
                'image' => 'product-3.jpeg'
            ],
            4 => [
                'id' => 4,
                'name' => 'Designer Lehenga Choli',
                'price' => 4999,
                'image' => 'product-4.jpeg'
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
        
        // Get current cart items from session
        $cart = session()->get('cart', []);
        
        // Check if product already exists in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'image' => $product['image']
            ];
        }
        
        // Update cart in session
        session()->put('cart', $cart);
        
        // Calculate total items in cart
        $cartCount = array_sum(array_column($cart, 'quantity'));
        
        // If it's an AJAX request, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'product_name' => $product['name'],
                'cart_count' => $cartCount,
                'cart_items' => count($cart)
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    /**
     * Update the quantity of an item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity'));
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            
            // Calculate new totals
            $subtotal = $cart[$productId]['price'] * $quantity;
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'subtotal' => '₹' . number_format($subtotal, 0),
                'total' => '₹' . number_format($total, 0),
                'grand_total' => '₹' . number_format($total + 99 + ($total * 0.05), 0),
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart'
        ]);
    }
    
    /**
     * Remove an item from the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            // Always remove the item completely for better UX
            unset($cart[$productId]);
            
            session()->put('cart', $cart);
            
            // Calculate new total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            // If it's an AJAX request, return JSON response
            if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed successfully',
                    'total' => '₹' . number_format($total, 0),
                    'grand_total' => '₹' . number_format($total + 99 + ($total * 0.05), 0),
                    'cart_count' => array_sum(array_column($cart, 'quantity'))
                ]);
            }
            
            return redirect()->route('cart')->with('success', 'Item removed successfully');
        }
        
        // If it's an AJAX request, return JSON response
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ]);
        }
        
        return redirect()->route('cart')->with('error', 'Product not found in cart');
    }
    
    /**
     * Clear the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart')->with('success', 'Cart cleared successfully!');
    }
}
