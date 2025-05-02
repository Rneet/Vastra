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
        // Get the authenticated user
        $user = Auth::user();
        
        // If user is not authenticated, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Get user address from session if it exists, otherwise use default values
        $address = Session::get('user_address', [
            'street' => '',
            'city' => '',
            'state' => '',
            'postal_code' => '',
            'country' => ''
        ]);
        
        // Add address to user object
        $user->address = $address;
        
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
        // Get the authenticated user
        $user = Auth::user();
        
        // If user is not authenticated, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20'],
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:255'],
        ]);
        
        // Update user data in the database
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->save();
        
        // Store address in user's session for now
        // In a real application, you would store this in a separate addresses table
        $address = [
            'street' => $validated['street'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country']
        ];
        
        Session::put('user_address', $address);
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the user's order history.
     *
     * @return \Illuminate\View\View
     */
    public function orders()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // If user is not authenticated, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Get user's orders from the database
        $orders = $user->orders()->with('items')->latest()->get();
        
        return view('pages.orders', compact('user', 'orders'));
    }
}
