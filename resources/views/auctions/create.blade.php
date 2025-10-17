@extends('layouts.app')
@section('title', 'Create Auction')

@section('content')
<div class="container mt-4">
    <h2>Create New Auction</h2>

    {{-- Auction create form --}}
    <form id="auctionForm">
        @csrf
        <input type="text" name="title" placeholder="Auction Title" required class="form-control mb-2">
        <input type="number" name="starting_price" placeholder="Starting Price" step="0.01" required class="form-control mb-2">
        <input type="datetime-local" name="auction_start" class="form-control mb-2">
        <input type="datetime-local" name="auction_end" class="form-control mb-2">

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
    </form>

    {{-- Message area --}}
    <div id="message" class="mt-3"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // When form is submitted
    $('#auctionForm').submit(function(e){
        e.preventDefault(); // Stop page refresh

        // Send form data using AJAX
        $.ajax({
            url: "{{ route('auctions.store') }}",   // Route to store auction
            type: "POST",                           // POST method
            data: new FormData(this),               // Collect all form fields
            contentType: false,                     // Don’t set content type automatically
            processData: false,                     // Don’t process data automatically
            headers: {'X-CSRF-TOKEN': $('[name=_token]').val()}, // CSRF token for security

            success: function(res){
                // Show success message
                $('#message').html(
                    '<div class="alert alert-success">' + res.message + '</div>'
                );

                // Redirect to auctions list after short delay
                setTimeout(function(){
                    window.location.href = "{{ route('auctions.index') }}";
                }, 1500);
            },

            error: function(err){
                // If there’s an error
                $('#message').html(
                    '<div class="alert alert-danger">Error creating auction!</div>'
                );
            }
        });
    });
});
</script>
@endsection
