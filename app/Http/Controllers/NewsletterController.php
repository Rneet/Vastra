<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe to the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // In a real application, you would store the email in a database
        // For now, we'll just redirect back with a success message
        
        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
