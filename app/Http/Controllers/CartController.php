<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('pages.cart', compact('cartItems', 'total'));
    }
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
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
        $cart = session()->get('cart', []);
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
        session()->put('cart', $cart);
        $cartCount = array_sum(array_column($cart, 'quantity'));
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
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity'));
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
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
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
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
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ]);
        }
        return redirect()->route('cart')->with('error', 'Product not found in cart');
    }
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Cart cleared successfully!');
    }
}
