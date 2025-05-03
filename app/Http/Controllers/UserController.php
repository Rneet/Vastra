<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        $address = Session::get('user_address', [
            'street' => '',
            'city' => '',
            'state' => '',
            'postal_code' => '',
            'country' => ''
        ]);
        
        $user->address = $address;
        
        return view('pages.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
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
        

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->save();
        

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
