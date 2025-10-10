<!DOCTYPE html>
<html>
<head>
    <title>All Auctions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>All Auctions</h2>
        <a href="{{ route('auctions.create') }}" class="btn btn-primary">+ Create Auction</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($auctions->count() > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Starting Price</th>
                    <th>Status</th>
                    <th>Bids</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auctions as $auction)
                    <tr>
                        <td>{{ $auction->title }}</td>
                        <td>${{ $auction->starting_price }}</td>
                        <td>{{ ucfirst($auction->status) }}</td> <!-- Simple DB status -->
                        <td>
                            @if($auction->bids->count() > 0)
                                {{ $auction->bids->count() }} bids<br>
                                @foreach($auction->bids as $bid)
                                    User #{{ $bid->user_id }} (${{ $bid->amount }})<br>
                                @endforeach
                            @else
                                No bids yet
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('auctions.show', $auction->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No auctions found.</p>
    @endif
</div>

</body>
</html>
