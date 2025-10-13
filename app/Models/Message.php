<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message'];
    
      // Get the User who received the message
    public function receiver()
    {
        return $this->belongsTo(\App\Models\User::class, 'receiver_id');
    }

    // Get the User who sent the message
    public function sender()
    {
        // A message belongs to a sender (a User)
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }
}
