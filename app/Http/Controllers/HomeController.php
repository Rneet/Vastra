<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
class HomeController extends Controller
{
    public function index()
    {
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
    public function collection($region)
    {
        $validRegions = ['north-indian', 'south-indian', 'east-indian', 'west-indian', 'northeast-indian', 'fusion-wear'];
        if (!in_array($region, $validRegions)) {
            abort(404);
        }
        $products = [];
        return view('pages.collection', compact('region', 'products'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
        ]);
        try {
            Mail::to('ravneetsingh11a@gmail.com')->send(new ContactFormMail($validated));
            return redirect()->route('contact')->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Sorry, there was an issue sending your message. Please try again later.');
        }
    }
}
