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
<script>
document.querySelector('#auctionForm').onsubmit = async e => {
    e.preventDefault();
    let res = await fetch("{{ route('auctions.store') }}", {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': e.target._token.value},
        body: new FormData(e.target)
    });
    let msg = document.getElementById('msg');
    if(res.ok){
        msg.style.color='green';
        msg.textContent='Auction created!';
        e.target.reset();
        setTimeout(()=>location.href="{{ route('auctions.index') }}",1000);
    } else {
        msg.style.color='red';
        msg.textContent='Error! Try again.';
    }
};
</script>
