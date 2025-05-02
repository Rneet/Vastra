<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PhoneAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/collection/{region}', [HomeController::class, 'collection'])->name('collection');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth');

// Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
});

// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add')->middleware('auth');
Route::get('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove')->middleware('auth');
Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move-to-cart')->middleware('auth');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/orders', [UserController::class, 'orders'])->name('profile.orders');

// Phone Authentication Routes (legacy)
// Route::get('/login', [PhoneAuthController::class, 'showLoginForm'])->name('login');
Route::post('/phone/send-otp', [PhoneAuthController::class, 'sendOtp'])->name('phone.sendOtp');
Route::post('/phone/verify-otp', [PhoneAuthController::class, 'verifyOtp'])->name('phone.verifyOtp');
// Route::post('/logout', [PhoneAuthController::class, 'logout'])->name('logout');

// Make current user admin (temporary route for setup)
Route::get('/make-me-admin', function() {
    if (Auth::check()) {
        $user = Auth::user();
        $user->is_admin = true;
        $user->save();
        return redirect('/admin')->with('success', 'You are now an admin!');
    }
    return redirect('/login');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});
