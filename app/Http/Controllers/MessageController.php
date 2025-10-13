<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class MessageController extends Controller
{
     
    //   Show the chat between the logged-in user and the user $targetId.
     
    public function show($targetId)
    {
        $currentId = Auth::id();
        
        // Find the person we are chatting with, or fail if they don't exist
        $recipient = User::findOrFail($targetId); 

        
        // We look for messages where BOTH the sender_id and receiver_id 
        // are one of the two IDs involved in the chat.
        $messages = Message::whereIn('sender_id', [$currentId, $targetId])
            ->whereIn('receiver_id', [$currentId, $targetId])
            ->with('sender') 
            ->orderBy('created_at', 'asc')
            ->get();

        // Pass the list of messages and the recipient's info to the view
        return view('messages.show', compact('messages', 'recipient'));
    }

    /**
     * Save the new message.
     */
    public function store(Request $request)
    {
        // Always validate what comes from the user!
        $request->validate([
            'message' => 'required|string|max:1000', 
            'receiver_id' => 'required|numeric|exists:users,id'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return back(); // Go back to the chat.
    }
}
