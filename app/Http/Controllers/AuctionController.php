<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    // Show all auctions with their bids
    public function index()
    {
        $auctions = Auction::with('bids')->get(); // Load bids with auctions
        return view('auctions.index', compact('auctions'));
    }

    // Show the auction creation form (only sellers can see this)
    public function create()
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Only sellers can create auctions.');
        }

        return view('auctions.create');
    }

    // Save a new auction (only sellers can store )
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'seller') {
            abort(403, 'Only sellers can create auctions.');
        }

        $request->validate([
            'title' => 'required|string',
            'starting_price' => 'required|numeric|min:1',
            'auction_start' => 'nullable|date',
            'auction_end' => 'nullable|date|after_or_equal:auction_start',
        ]);

      
        Auction::create([
            'title' => $request->title,
            'starting_price' => $request->starting_price,
            'user_id' => Auth::id(),
            'auction_start' => now(),            // start now
            'auction_end' => now()->addHours(1), // end 1 hour later 
            'status' => 'started',               // immediately active
        ]);


        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    // Show details of a single auction
    public function show($id)
    {
        $auction = Auction::with('bids')->findOrFail($id);
        return view('auctions.show', compact('auction'));
    }

    // Show edit form (only the seller who created it can edit)
    public function edit($id)
    {
        $auction = Auction::findOrFail($id);

        if (Auth::id() !== $auction->user_id) {
            abort(403, 'You are not allowed to edit this auction.');
        }

        return view('auctions.edit', compact('auction'));
    }

    // Update an auction (only the owner can update)
    public function update(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);

        if (Auth::id() !== $auction->user_id) {
            abort(403, 'You are not allowed to update this auction.');
        }

        $request->validate([
            'title' => 'required|string',
            'starting_price' => 'required|numeric|min:1',
            'auction_start' => 'nullable|date',
            'auction_end' => 'nullable|date|after_or_equal:auction_start',
        ]);

        $auction->update([
            'title' => $request->title,
            'starting_price' => $request->starting_price,
            'auction_start' => $request->auction_start,
            'auction_end' => $request->auction_end,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully!');
    }

    // Delete an auction (only the owner can delete)
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);

        if (Auth::id() !== $auction->user_id) {
            abort(403, 'You are not allowed to delete this auction.');
        }

        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
    public function acceptBid($bidId)
{
    $bid = \App\Models\Bid::findOrFail($bidId);
    $auction = $bid->auction;

    // Only seller can accept
    if (auth()->id() !== $auction->user_id) {
        abort(403, 'You are not allowed to accept this bid.');
    }

    // Reset all bids to winner = 0 (one line)
    $auction->bids()->update(['winner' => 0]);

    // Set this bid as winner
    $bid->update(['winner' => 1]);

    // Mark auction as sold
    $auction->update(['status' => 'sold']);

    return redirect()->back()->with('success', 'Bid accepted successfully!');
}

}
