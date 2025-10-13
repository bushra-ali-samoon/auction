@extends('layouts.app')

@section('title', 'Create Auction')

@section('content')
<h2>Create New Auction</h2>

<form method="POST" action="{{ route('auctions.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Starting Price</label>
        <input type="number" name="starting_price" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Auction Start Time</label>
        <input type="datetime-local" name="auction_start" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Auction End Time</label>
        <input type="datetime-local" name="auction_end" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Create Auction</button>
    <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
