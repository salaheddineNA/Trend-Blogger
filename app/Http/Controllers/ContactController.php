<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000'
        ]);

        // Save message to database for admin to view
        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false
        ]);
        
        Session::flash('success', 'Your message has been sent successfully! We\'ll get back to you soon.');
        
        return redirect()->route('contact.create')->with('success', 'Message sent successfully!');
    }
}
