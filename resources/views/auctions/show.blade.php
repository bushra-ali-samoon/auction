<!DOCTYPE html>
<html>
<head>
    <title>{{ $auction->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>{{ $auction->title }}</h2>
    <p><strong>Starting Price:</strong> ${{ $auction->starting_price }}</p>

    <hr>

    <h4>Place a Bid</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Only show form if user is NOT the auction owner --}}
    @if(Auth::id() !== $auction->user_id)
        <form method="POST" action="{{ route('bids.store', $auction->id) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Your Bid Amount</label>
                <input type="number" name="amount" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Bid</button>
        </form>
    @else
        <p class="text-warning">You cannot bid on your own auction.</p>
    @endif

    <hr>

    <h4>All Bids</h4>
    <ul class="list-group">
        @forelse($auction->bids as $bid)
            <li class="list-group-item">
                ${{ $bid->amount }} by User #{{ $bid->user_id }}
            </li>
        @empty
            <li class="list-group-item text-muted">No bids yet.</li>
        @endforelse
    </ul>

    <a href="{{ route('auctions.index') }}" class="btn btn-secondary mt-3">Back</a>
    <hr>

<h4>All Bids</h4>
<ul class="list-group">
    @forelse($auction->bids as $bid)
        <li class="list-group-item">
            ${{ $bid->amount }} by User #{{ $bid->user_id }} 

            @if($bid->winner)
                <strong>(Winner)</strong>
            @elseif(Auth::id() === $auction->user_id && $auction->status != 'sold')
                <!-- Show Accept button only if current user is seller -->
                <a href="{{ route('bids.accept', $bid->id) }}" class="btn btn-sm btn-success ms-2">
                    Accept
                </a>
            @endif
        </li>
    @empty
        <li class="list-group-item text-muted">No bids yet.</li>
    @endforelse
</ul>

</div>

</body>
</html>
