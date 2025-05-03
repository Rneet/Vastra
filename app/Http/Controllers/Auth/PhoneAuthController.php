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
    public function showLoginForm()
    {
        return view('auth.phone-login');
    }
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
        $verification = PhoneVerification::createOrUpdateVerification($phone);
        Log::info("OTP for {$phone}: {$verification->otp}");
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => $verification->otp,
        ]);
    }
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
        $verification->update(['verified' => true]);
        $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name' => 'User ' . substr($phone, -4),
                'email' => $phone . '@example.com',
                'password' => bcrypt(Str::random(16)),
            ]
        );
        Auth::login($user);
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => session('url.intended', route('home')),
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
