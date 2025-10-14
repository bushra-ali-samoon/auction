@extends('layouts.app')
@section('title', 'Edit Auction')

<h2>Edit Auction</h2>
<form id="editForm">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $auction->title }}" class="form-control mb-2" required>
    <input type="number" name="starting_price" value="{{ $auction->starting_price }}" class="form-control mb-2" step="0.01" required>
    <input type="datetime-local" name="auction_start" class="form-control mb-2" value="{{ \Carbon\Carbon::parse($auction->auction_start)->format('Y-m-d\TH:i') }}">
    <input type="datetime-local" name="auction_end" class="form-control mb-2" value="{{ \Carbon\Carbon::parse($auction->auction_end)->format('Y-m-d\TH:i') }}">
    <button class="btn btn-success">Update</button>
    <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
</form>
 
