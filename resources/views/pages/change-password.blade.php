@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold mb-4 md:mb-0 md:mr-6">
                        J
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">John Doe</h1>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Profile Navigation -->
            <div class="flex flex-wrap mb-6 gap-2">
                <a href="{{ route('profile') }}" class="px-4 py-2 bg-white text-gray-700 rounded-md hover:bg-gray-100 transition-colors">My Profile</a>
                <a href="{{ route('profile.orders') }}" class="px-4 py-2 bg-white text-gray-700 rounded-md hover:bg-gray-100 transition-colors">Order History</a>
                <a href="{{ route('profile.change-password') }}" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">Change Password</a>
            </div>

            <!-- Change Password Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold mb-6 pb-2 border-b">Change Password</h2>
                
                <form action="{{ route('profile.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-secondary text-primary font-medium rounded-md hover:bg-secondary-dark transition-colors">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
