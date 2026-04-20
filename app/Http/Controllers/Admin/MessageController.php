<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read
        $message->update(['is_read' => true]);
        
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
        
        return redirect()->back()
            ->with('success', 'Message marked as read!');
    }

    public function markAsUnread($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => false]);
        
        return redirect()->back()
            ->with('success', 'Message marked as unread!');
    }
}
