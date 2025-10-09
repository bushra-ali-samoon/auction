<!DOCTYPE html>
<html>
<head>
    <title>All Auctions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Auctions</h2>
        <a href="{{ route('auctions.create') }}" class="btn btn-primary">+ Create Auction</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($auctions->count() > 0)
      <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Starting Price</th>
            <th>Status</th>
            <th width="200">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auctions as $auction)
            <tr>
                <td>{{ $auction->title }}</td>
                <td>${{ $auction->starting_price }}</td>
                <td>{{ $auction->currentStatus() }}</td>
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
        <p class="text-muted text-center">No auctions found.</p>
    @endif
</div>

</body>
</html>
