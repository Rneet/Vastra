<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'recentOrders'));
    }

    /**
     * Show the orders list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show a specific order.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showOrder($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.order-detail', compact('order'));
    }

    /**
     * Update order status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    /**
     * Show the products list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products', compact('products'));
    }

    /**
     * Show the users list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }
}
