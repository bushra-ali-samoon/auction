@extends('layouts.app')

@section('title', 'All Auctions')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>All Auctions</h2>
    <a href="{{ route('auctions.create') }}" class="btn btn-primary">+ Create Auction</a>
</div>

@if($auctions->count())
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Status</th>
            <th>Bids</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="auctionList">
        @foreach($auctions as $auction)
        <tr id="auction-{{ $auction->id }}">
            <td>{{ $auction->title }}</td>
            <td>${{ $auction->starting_price }}</td>
            <td>{{ ucfirst($auction->status) }}</td>
            <td>
                @forelse($auction->bids as $bid)
                    User #{{ $bid->user_id }} (${{ $bid->amount }})<br>
                @empty
                    No bids yet
                @endforelse
            </td>
            <td>
                <a href="{{ route('auctions.show', $auction->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-warning btn-sm">Edit</a>
<button class="btn btn-danger btn-sm deleteAuction" data-id="{{ $auction->id }}">
    Delete
</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No auctions found.</p>
@endif
<script>
$(document).on('click', '.deleteAuction', function(e) {
    e.preventDefault();

    if (!confirm('Are you sure you want to delete this auction?')) return;

    let id = $(this).data('id');

    $.ajax({
        url: '/auctions/' + id,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert('Auction deleted successfully!');
                $('#auction-' + id).fadeOut(400, function() { $(this).remove(); });
            } else {
                alert('Failed to delete auction!');
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Error deleting auction! Check console.');
        }
    });
});
</script>



@endsection
