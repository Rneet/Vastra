<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = session('wishlist', []);
        return view('pages.wishlist', compact('wishlistItems'));
    }
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
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
        $wishlist = session()->get('wishlist', []);
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
            session()->put('wishlist', $wishlist);
            $message = 'Product added to wishlist successfully!';
        } else {
            $message = 'Product is already in your wishlist.';
        }
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'added' => !$alreadyInWishlist,
                'message' => $message,
                'product_name' => $product['name'],
                'wishlist_count' => count($wishlist)
            ]);
        }
        if (!$alreadyInWishlist) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('info', $message);
        }
    }
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $wishlist = session()->get('wishlist', []);
        $productName = isset($wishlist[$productId]) ? $wishlist[$productId]['name'] : '';
        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            session()->put('wishlist', $wishlist);
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
        if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist.'
            ]);
        }
        return redirect()->route('wishlist')->with('error', 'Product not found in wishlist.');
    }
    public function moveToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $wishlist = session()->get('wishlist', []);
        $cart = session()->get('cart', []);
        if (!isset($wishlist[$productId])) {
            return redirect()->route('wishlist')->with('error', 'Product not found in wishlist.');
        }
        $product = $wishlist[$productId];
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
        unset($wishlist[$productId]);
        session()->put('wishlist', $wishlist);
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Product moved to cart successfully!');
    }
}
