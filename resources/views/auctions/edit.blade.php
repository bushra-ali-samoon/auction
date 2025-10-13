@extends('layouts.app')

@section('title', 'Edit Auction')

@section('content')
<h2>Edit Auction</h2>

<form method="POST" action="{{ route('auctions.update', $auction->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $auction->title }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Starting Price</label>
        <input type="number" name="starting_price" class="form-control" step="0.01" value="{{ $auction->starting_price }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Auction Start Time</label>
        <input type="datetime-local" name="auction_start" class="form-control"
            value="{{ \Carbon\Carbon::parse($auction->auction_start)->format('Y-m-d\TH:i') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Auction End Time</label>
        <input type="datetime-local" name="auction_end" class="form-control"
            value="{{ \Carbon\Carbon::parse($auction->auction_end)->format('Y-m-d\TH:i') }}">
    </div>

    <button type="submit" class="btn btn-success">Update Auction</button>
    <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
