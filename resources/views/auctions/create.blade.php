@extends('layouts.app')
@section('title', 'Create Auction')

@section('content')
<h2>Create New Auction</h2>

<form id="auctionForm">
    @csrf
    <input type="text" name="title" placeholder="Title" required class="form-control mb-2">
    <input type="number" name="starting_price" placeholder="Starting Price" step="0.01" required class="form-control mb-2">
    <input type="datetime-local" name="auction_start" class="form-control mb-2">
    <input type="datetime-local" name="auction_end" class="form-control mb-2">
    <button class="btn btn-primary">Create</button>
    <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
