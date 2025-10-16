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

<script>
// When the auction form is submitted
document.querySelector('#auctionForm').onsubmit = async e => {
    e.preventDefault(); // Stop the page from reloading

    // Send the form data to the server using fetch method in AJAX
    let res = await fetch("{{ route('auctions.store') }}", {
        method: 'POST', // Send data using POST method
        headers: {
            'X-CSRF-TOKEN': document.querySelector('[name=_token]').value // Include CSRF token for security
        },
        body: new FormData(e.target) //Send all input values (important!)
    });

    // Check if the server responded successfully
    if(res.ok)
        location.href = "{{ route('auctions.index') }}"; // Redirect to auctions list page
    else
        alert('Error!'); // Show an error if saving failed
};
</script>
@endsection
