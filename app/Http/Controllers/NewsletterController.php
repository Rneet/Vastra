<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
