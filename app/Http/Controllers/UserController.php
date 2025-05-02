<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // Get the user data from session or use default values
        $user = Session::get('user', (object) [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+91 9876543210',
            'address' => [
                'street' => '123 Main Street',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'postal_code' => '400001',
                'country' => 'India'
            ],
            'created_at' => '2023-01-15'
        ]);
        
        return view('pages.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:255'],
        ]);
        
        // Get the current user data
        $user = Session::get('user', (object) [
            'id' => 1,
            'created_at' => '2023-01-15'
        ]);
        
        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = [
            'street' => $validated['street'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country']
        ];
        
        // Store updated user in session
        Session::put('user', $user);
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the user's order history.
     *
     * @return \Illuminate\View\View
     */
    public function orders()
    {
        // Get the user from session
        $user = Session::get('user', (object) [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'created_at' => '2023-01-15'
        ]);
        
        // For demo purposes, we'll create an empty orders array
        $orders = [];
        
        return view('pages.orders', compact('user', 'orders'));
    }
}
