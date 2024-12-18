<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at' , 'desc')->get();
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', 
        ]);
    
        if ($request->hasFile('image')) {
            // Store the file in the 'uploads' directory
            $filePath = $request->file('image')->store('uploads', 'public');
    
            // Save the file path in the database
            $data['image'] = $filePath;
        }
    
        // Save the message (if any) and image path
        $message = Message::create($data);
    
        broadcast(new MessageEvent($message))->toOthers();
    
        return back()->with('success', 'Message sent!');
    }
    
}
