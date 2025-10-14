<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    // Show chat between current user and selected user
    public function show($id)
    {
        $user = Auth::id();
        $partner = User::findOrFail($id);

        // Get all messages between both users
        $messages = Message::whereIn('sender_id', [$user, $id])
            ->whereIn('receiver_id', [$user, $id])
            ->orderBy('created_at', 'asc')
            ->get();

        //   Pass both $partner and $id to the view
        return view('messages.show', compact('messages', 'partner', 'id'));
    }

    // Send message using AJAX
    public function store(Request $r)
    {
  
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $r->receiver_id,
            'message' => $r->message
        ]);

        return response()->json(['success' => true]);
    }
}
