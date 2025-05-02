@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Sign In</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input id="email" type="email" class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input id="password" type="password" class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent" name="password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-secondary" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 text-sm">Remember me</span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        Sign In
                    </button>
                </div>
                
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        Don't have an account? <a href="{{ route('register') }}" class="text-secondary hover:text-secondary-dark font-medium">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
