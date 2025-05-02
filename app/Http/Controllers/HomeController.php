<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Create sample featured products for the home page
        $featuredProducts = [
            (object) [
                'id' => 1,
                'name' => 'Banarasi Silk Saree',
                'price' => 2499,
                'original_price' => 2999,
                'discount_percentage' => 17,
                'image' => 'images/products/product-1.jpeg',
                'rating' => 4.5,
                'review_count' => 128,
                'category' => 'Saree'
            ],
            (object) [
                'id' => 2,
                'name' => 'Embroidered Lehenga Choli',
                'price' => 8999,
                'original_price' => 11999,
                'discount_percentage' => 25,
                'image' => 'images/products/product-2.jpeg',
                'rating' => 4.8,
                'review_count' => 96,
                'category' => 'Lehenga'
            ],
            (object) [
                'id' => 3,
                'name' => 'Kundan Necklace Set',
                'price' => 2499,
                'original_price' => 2999,
                'discount_percentage' => 17,
                'image' => 'images/products/product-3.jpeg',
                'rating' => 4.3,
                'review_count' => 74,
                'category' => 'Jewelry'
            ]
        ];
        
        return view('pages.home', compact('featuredProducts'));
    }

    /**
     * Display the collection page for a specific region.
     *
     * @param string $region
     * @return \Illuminate\View\View
     */
    public function collection($region)
    {
        // Validate region
        $validRegions = ['north-indian', 'south-indian', 'east-indian', 'west-indian', 'northeast-indian', 'fusion-wear'];
        
        if (!in_array($region, $validRegions)) {
            abort(404);
        }

        // In a real application, you would fetch products from the database
        // based on the region and any applied filters
        $products = [];
        
        // For demonstration purposes, we'll return an empty array
        // to show the collection page
        return view('pages.collection', compact('region', 'products'));
    }
    
    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }
    
    /**
     * Process the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactSubmit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
        ]);
        
        // Send email with form data
        try {
            Mail::to('ravneetsingh11a@gmail.com')->send(new ContactFormMail($validated));
            return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Sorry, there was an issue sending your message. Please try again later.');
        }
    }
}
