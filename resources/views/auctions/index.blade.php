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
                <button class="btn btn-danger btn-sm deleteAuction" data-id="{{ $auction->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No auctions found.</p>
@endif

<script>
$(function(){

  // When the delete button is clicked
  $('.deleteAuction').click(function(e){
    e.preventDefault();

    // Confirm before deleting
    if(!confirm('Delete this auction?')) return;

    let id = $(this).data('id'); // Get auction ID

    // Send delete request
    $.post('/auctions/' + id, {
      _token: $('meta[name="csrf-token"]').attr('content'),
      _method: 'DELETE'
    })
    .done(function(){
      alert('Auction deleted!');
      $('#auction-' + id).remove(); // Remove it from page
    })
    .fail(function(){
      alert('Delete failed!');
    });
  });

});
</script>

@endsection
