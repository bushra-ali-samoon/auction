@extends('layouts.app')

@section('title', $auction->title)

@section('content')
<h2>{{ $auction->title }}</h2>
<p><strong>Starting Price:</strong> ${{ $auction->starting_price }}</p>
<p><strong>Status:</strong> {{ ucfirst($auction->status) }}</p>

<hr>

{{-- Show bid form only for buyers --}}
@if(Auth::id() !== $auction->user_id)
    <h4>Place a Bid</h4>
    <form method="POST" action="{{ route('bids.store', $auction->id) }}">
        @csrf
        <div class="mb-3">
            <input type="number" name="amount" class="form-control" placeholder="Enter your bid" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Submit Bid</button>
    </form>
@else
    <p class="text-warning">You cannot bid on your own auction.</p>
@endif

<hr>

<h4>Bids for this Auction</h4>
@forelse($auction->bids as $bid)
    <p>
        User #{{ $bid->user_id }} — ${{ $bid->amount }}
        @if($bid->winner)
            <strong>(Winner)</strong>
        @elseif($auction->status != 'sold' && Auth::id() === $auction->user_id)
            <a href="{{ route('bids.accept', $bid->id) }}" class="btn btn-sm btn-primary">Accept</a>
        @endif
    </p>
@empty
    <p>No bids yet.</p>
@endforelse

<a href="{{ route('auctions.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
