<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{

    // Store a new bid that is just buyer can do 
    public function store(Request $request, $auctionId)
    {
        $auction = Auction::findOrFail($auctionId);

        //   Allow only buyers to place bids on active auctions
        if (Auth::user()->role !== 'buyer') {
            return back()->withErrors('Only buyers can place bids.');
        }

        // Prevent user from bidding on their own auction
        if ($auction->user_id === Auth::id()) {
            return back()->withErrors('You cannot bid on your own auction.');
        }

        //   Validate input
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        //   Save bid with auction id and user id and amount
        Bid::create([
            'auction_id' => $auctionId,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Bid placed successfully!');
    }
}
