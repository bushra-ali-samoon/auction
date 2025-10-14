<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    // Show all auctions with their bids
    public function index()
    {
        $auctions = Auction::with('bids')->get();
        return view('auctions.index', compact('auctions'));
    }

    // Show auction form (only for sellers)
    public function create()
    {
        abort_if(Auth::user()->role !== 'seller', 403);
        return view('auctions.create');
    }

    // Save new auction
    public function store(Request $r)
    {
        abort_if(Auth::user()->role !== 'seller', 403);

        $r->validate([
            'title' => 'required',
            'starting_price' => 'required|numeric|min:1',

        ]);

        Auction::create([
            'title' => $r->title,
            'starting_price' => $r->starting_price,
            'user_id' => Auth::id(),
            'auction_start' => now(),
            'auction_end' => now()->addHour(),
            'status' => 'started',
        ]);


        return back()->with('success', 'Auction created!');
    }

    // Show single auction
    public function show($id)
    {
        $auction = Auction::with('bids')->findOrFail($id);
        return view('auctions.show', compact('auction'));
    }

    // Edit auction (only owner)
    public function edit($id)
    {
        $auction = Auction::findOrFail($id);
        abort_if(Auth::id() !== $auction->user_id, 403);
        return view('auctions.edit', compact('auction'));
    }

    // Update auction
    public function update(Request $r, $id)
    {
        $auction = Auction::findOrFail($id);
        abort_if(Auth::id() !== $auction->user_id, 403);

        $r->validate([
            'title' => 'required',
            'starting_price' => 'required|numeric|min:1',
            
        ]);

        $auction->update($r->only('title', 'starting_price', 'auction_start', 'auction_end'));

        return back()->with('success', 'Auction updated!');
    }

    // Delete auction
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);
        abort_if(Auth::id() !== $auction->user_id, 403);
        $auction->delete();
        return back()->with('success', 'Auction deleted!');
    }

    // Accept a bid (only seller)
    public function acceptBid($bidId)
    {
        $bid = Bid::findOrFail($bidId);
        $auction = $bid->auction;

        abort_if(Auth::id() !== $auction->user_id, 403);

        $auction->bids()->update(['winner' => 0]); // reset all
        $bid->update(['winner' => 1]); // set this one as winner
        $auction->update(['status' => 'sold']); // mark as sold

        return back()->with('success', 'Bid accepted!');
    }
}
