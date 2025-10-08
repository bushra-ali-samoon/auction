<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    // Show all auctions
    public function index()
    {
        $auctions = Auction::all();
        return view('auctions.index', compact('auctions'));
    }

    // Show create form
    public function create()
    {
        return view('auctions.create');
    }

    // Store new auction
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'starting_price' => 'required|numeric',
        ]);

        Auction::create($request->only(['title', 'starting_price']));

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    // Show single auction
    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        return view('auctions.show', compact('auction'));
    }

    // Show edit form
    public function edit($id)
    {
        $auction = Auction::findOrFail($id);
        return view('auctions.edit', compact('auction'));
    }

    // Update auction
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'starting_price' => 'required|numeric',
        ]);

        $auction = Auction::findOrFail($id);
        $auction->update($request->only(['title', 'starting_price']));

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully!');
    }

    // Delete auction
    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
}
