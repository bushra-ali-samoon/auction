<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    
    // Store a new bid
    public function store(Request $request, $auctionId)
    {
          $auction = Auction::findOrFail($auctionId);

    //   this thing is prevent to not to place bid in its own auction
    if ($auction->user_id === auth()->id()) {
        return back()->withErrors('You cannot bid on your own auction.');
    }
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Bid::create([
            'auction_id' => $auctionId,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Bid placed successfully!');
    }
}
