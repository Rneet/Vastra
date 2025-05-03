@extends('layouts.app')
@section('content')
<div class="bg-gray-50 py-32 mt-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Login with Phone</h1>
                <p class="text-gray-600 mt-2">Enter your phone number to receive an OTP</p>
            </div>
            <!-- Phone Number Form -->
            <form id="phone-form" class="block" method="POST" action="{{ route('phone.sendOtp') }}">
                @csrf
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                            +91
                        </span>
                        <input type="text" id="phone" name="phone" class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-primary focus:ring-primary" placeholder="Enter 10 digit number" maxlength="10">
                    </div>
                    <p id="phone-error" class="mt-1 text-sm text-red-600 @if(!$errors->has('phone')) hidden @endif">
                        {{ $errors->first('phone') }}
                    </p>
                </div>
                <button type="submit" id="send-otp-btn" class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-primary-dark transition-colors duration-300">
                    Send OTP
                </button>
            </form>
            <!-- OTP Verification Form -->
            <div id="otp-form" class="hidden">
                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-4">We've sent a 6-digit OTP to <span id="display-phone" class="font-medium"></span></p>
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Enter OTP</label>
                    <div class="flex gap-2 justify-between">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                        <input type="text" maxlength="1" class="otp-input w-12 h-12 text-center text-xl border-gray-300 rounded-md focus:border-primary focus:ring-primary">
                    </div>
                    <input type="hidden" id="full-otp">
                    <p id="otp-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm">
                        <span id="timer" class="font-medium">00:59</span> seconds remaining
                    </p>
                    <button id="resend-otp-btn" class="text-sm text-primary hover:text-primary-dark disabled:text-gray-400" disabled>Resend OTP</button>
                </div>
                <button id="verify-otp-btn" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary-dark transition-colors duration-300">
                    Verify & Login
                </button>
                <button id="change-phone-btn" class="w-full mt-3 border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-50 transition-colors duration-300">
                    Change Phone Number
                </button>
            </div>
            <!-- Loading State -->
            <div id="loading" class="hidden">
                <div class="flex justify-center items-center py-8">
                    <svg class="animate-spin h-8 w-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneForm = document.getElementById('phone-form');
        const otpForm = document.getElementById('otp-form');
        const loadingDiv = document.getElementById('loading');
        const phoneInput = document.getElementById('phone');
        const sendOtpBtn = document.getElementById('send-otp-btn');
        const verifyOtpBtn = document.getElementById('verify-otp-btn');
        const resendOtpBtn = document.getElementById('resend-otp-btn');
        const changePhoneBtn = document.getElementById('change-phone-btn');
        const displayPhone = document.getElementById('display-phone');
        const phoneError = document.getElementById('phone-error');
        const otpError = document.getElementById('otp-error');
        const otpInputs = document.querySelectorAll('.otp-input');
        const fullOtpInput = document.getElementById('full-otp');
        const timerElement = document.getElementById('timer');
        let timerInterval;
        let secondsLeft = 59;
        function validatePhone(phone) {
            const phoneRegex = /^[0-9]{10}$/;
            return phoneRegex.test(phone);
        }
        function showError(element, message) {
            element.textContent = message;
            element.classList.remove('hidden');
        }
        function hideError(element) {
            element.textContent = '';
            element.classList.add('hidden');
        }
        function showLoading() {
            phoneForm.classList.add('hidden');
            otpForm.classList.add('hidden');
            loadingDiv.classList.remove('hidden');
        }
        function hideLoading() {
            loadingDiv.classList.add('hidden');
        }
        function startTimer() {
            clearInterval(timerInterval);
            secondsLeft = 59;
            updateTimerDisplay();
            resendOtpBtn.disabled = true;
            timerInterval = setInterval(function() {
                secondsLeft--;
                updateTimerDisplay();
                if (secondsLeft <= 0) {
                    clearInterval(timerInterval);
                    resendOtpBtn.disabled = false;
                }
            }, 1000);
        }
        function updateTimerDisplay() {
            const minutes = Math.floor(secondsLeft / 60);
            const seconds = secondsLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        otpInputs.forEach((input, index) => {
            input.addEventListener('keyup', (e) => {
                if (input.value.length === 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
                if (e.key === 'Backspace' && index > 0 && input.value.length === 0) {
                    otpInputs[index - 1].focus();
                }
                updateFullOtp();
            });
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text');
                if (pastedData.length === 6 && /^\d+$/.test(pastedData)) {
                    for (let i = 0; i < otpInputs.length; i++) {
                        otpInputs[i].value = pastedData[i] || '';
                    }
                    updateFullOtp();
                }
            });
        });
        function updateFullOtp() {
            fullOtpInput.value = Array.from(otpInputs).map(input => input.value).join('');
        }
        phoneForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const phone = phoneInput.value.trim();
            if (!validatePhone(phone)) {
                showError(phoneError, 'Please enter a valid 10-digit phone number');
                return;
            }
            hideError(phoneError);
            showLoading();
            const formData = new FormData();
            formData.append('phone', phone);
            formData.append('_token', '{{ csrf_token() }}');
            fetch('{{ route("phone.sendOtp") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    phoneForm.classList.add('hidden');
                    otpForm.classList.remove('hidden');
                    displayPhone.textContent = '+91 ' + phone;
                    startTimer();
                    if (data.otp) {
                        const otpString = data.otp.toString();
                        for (let i = 0; i < otpInputs.length; i++) {
                            otpInputs[i].value = otpString[i] || '';
                        }
                        updateFullOtp();
                    }
                } else {
                    phoneForm.classList.remove('hidden');
                    showError(phoneError, data.message || 'Failed to send OTP. Please try again.');
                }
            })
            .catch(error => {
                hideLoading();
                phoneForm.classList.remove('hidden');
                showError(phoneError, 'An error occurred. Please try again later.');
                console.error('Error:', error);
            });
        });
        verifyOtpBtn.addEventListener('click', function() {
            const phone = phoneInput.value.trim();
            const otp = fullOtpInput.value;
            if (otp.length !== 6) {
                showError(otpError, 'Please enter a valid 6-digit OTP');
                return;
            }
            hideError(otpError);
            showLoading();
            fetch('{{ route("phone.verifyOtp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone, otp: otp })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect || '{{ route("home") }}';
                } else {
                    hideLoading();
                    otpForm.classList.remove('hidden');
                    showError(otpError, data.message || 'Invalid OTP. Please try again.');
                }
            })
            .catch(error => {
                hideLoading();
                otpForm.classList.remove('hidden');
                showError(otpError, 'An error occurred. Please try again later.');
                console.error('Error:', error);
            });
        });
        resendOtpBtn.addEventListener('click', function() {
            const phone = phoneInput.value.trim();
            hideError(otpError);
            showLoading();
            fetch('{{ route("phone.sendOtp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                otpForm.classList.remove('hidden');
                if (data.success) {
                    startTimer();
                    otpInputs.forEach(input => {
                        input.value = '';
                    });
                    fullOtpInput.value = '';
                    if (data.otp) {
                        const otpString = data.otp.toString();
                        for (let i = 0; i < otpInputs.length; i++) {
                            otpInputs[i].value = otpString[i] || '';
                        }
                        updateFullOtp();
                    }
                } else {
                    showError(otpError, data.message || 'Failed to resend OTP. Please try again.');
                }
            })
            .catch(error => {
                hideLoading();
                otpForm.classList.remove('hidden');
                showError(otpError, 'An error occurred. Please try again later.');
                console.error('Error:', error);
            });
        });
        changePhoneBtn.addEventListener('click', function() {
            otpForm.classList.add('hidden');
            phoneForm.classList.remove('hidden');
            hideError(phoneError);
            hideError(otpError);
            clearInterval(timerInterval);
            otpInputs.forEach(input => {
                input.value = '';
            });
            fullOtpInput.value = '';
        });
    });
</script>
@endpush
