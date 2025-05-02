<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PhoneVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhoneAuthController extends Controller
{
    /**
     * Show the phone login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.phone-login');
    }

    /**
     * Send OTP to the provided phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid 10-digit phone number',
                'errors' => $validator->errors(),
            ]);
        }

        $phone = $request->phone;
        
        // Create or update verification record with new OTP
        $verification = PhoneVerification::createOrUpdateVerification($phone);
        
        // In a real application, you would send the OTP via SMS here
        // For demonstration, we'll just log it
        Log::info("OTP for {$phone}: {$verification->otp}");
        
        // For development purposes, we'll return the OTP in the response
        // In production, you would remove this and only send it via SMS
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => $verification->otp, // Remove this in production
        ]);
    }

    /**
     * Verify the OTP and login the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $validator->errors(),
            ]);
        }

        $phone = $request->phone;
        $otp = $request->otp;
        
        $verification = PhoneVerification::where('phone', $phone)
            ->where('otp', $otp)
            ->first();
        
        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP',
            ]);
        }
        
        if ($verification->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ]);
        }
        
        // Mark verification as verified
        $verification->update(['verified' => true]);
        
        // Find or create user
        $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name' => 'User ' . substr($phone, -4),
                'email' => $phone . '@example.com', // Placeholder email
                'password' => bcrypt(Str::random(16)),
            ]
        );
        
        // Login the user
        Auth::login($user);
        
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => session('url.intended', route('home')),
        ]);
    }

    /**
     * Logout the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
