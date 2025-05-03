@extends('layouts.app')
@section('content')
<!-- Contact Us Hero Section -->
<div class="bg-primary text-white py-16 text-center pt-24">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
        <p class="text-lg max-w-2xl mx-auto">We'd love to hear from you. Reach out with any questions about our products or for collaboration opportunities.</p>
    </div>
</div>
<!-- Contact Form Section -->
<div class="container mx-auto px-4 py-16">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-8">Send Us a Message</h2>
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6" id="contactForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" name="last_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject <span class="text-red-500">*</span></label>
                <input type="text" id="subject" name="subject" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message <span class="text-red-500">*</span></label>
                <textarea id="message" name="message" rows="6" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"></textarea>
            </div>
            <div>
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-primary-dark transition-colors duration-300">Send Message</button>
            </div>
        </form>
    </div>
</div>
<!-- Features Section -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-block p-3 bg-primary/10 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Secure Payment</h3>
                <p class="text-gray-600">100% secure payment</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-block p-3 bg-primary/10 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Quality Guarantee</h3>
                <p class="text-gray-600">Authentic handcrafted products</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-block p-3 bg-primary/10 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Free Shipping</h3>
                <p class="text-gray-600">On orders above ₹1999</p>
            </div>
        </div>
    </div>
</div>
<!-- FAQ Section -->
<div class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button class="flex justify-between items-center w-full px-6 py-4 text-left font-medium" onclick="toggleFaq('faq1')">
                <span>Do you ship internationally?</span>
                <svg id="faq1-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="faq1" class="px-6 py-4 bg-gray-50 hidden">
                <p class="text-gray-600">Yes, we ship to most countries worldwide. International shipping typically takes 7-14 business days depending on your location. Shipping fees and potential customs duties vary by destination.</p>
            </div>
        </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button class="flex justify-between items-center w-full px-6 py-4 text-left font-medium" onclick="toggleFaq('faq2')">
                <span>What is your return policy?</span>
                <svg id="faq2-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="faq2" class="px-6 py-4 bg-gray-50 hidden">
                <p class="text-gray-600">We accept returns within 14 days of delivery for items in their original condition. Custom-made orders are non-returnable unless there's a manufacturing defect. Please contact our customer service team to initiate a return.</p>
            </div>
        </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button class="flex justify-between items-center w-full px-6 py-4 text-left font-medium" onclick="toggleFaq('faq3')">
                <span>How do I care for traditional Indian garments?</span>
                <svg id="faq3-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="faq3" class="px-6 py-4 bg-gray-50 hidden">
                <p class="text-gray-600">Each garment comes with specific care instructions. Generally, we recommend dry cleaning for heavily embroidered items and gentle hand washing for most cotton garments. Always store in a cool, dry place, and avoid direct sunlight.</p>
            </div>
        </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button class="flex justify-between items-center w-full px-6 py-4 text-left font-medium" onclick="toggleFaq('faq4')">
                <span>Do you offer customization options?</span>
                <svg id="faq4-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="faq4" class="px-6 py-4 bg-gray-50 hidden">
                <p class="text-gray-600">Yes, we provide customization for select products. This may include size adjustments, color preferences, or embroidery modifications. Customized orders typically require an additional 2-3 weeks for production. Please write to us for details.</p>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleFaq(id) {
        const content = document.getElementById(id);
        const icon = document.getElementById(`${id}-icon`);
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
            });
        }
    });
</script>
@endsection
