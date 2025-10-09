<!-- resources/views/auctions/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Auction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Create New Auction</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auctions.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter auction title" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Starting Price</label>
                <input type="number" name="starting_price" class="form-control" value="{{ old('starting_price') }}" placeholder="Enter starting price" required>
            </div>
            <div class="mb-3">

            <label>Auction Start</label><br>
            <input type="datetime-local" name="auction_start" value="{{ old('auction_start') }}" required><br><br>
</div>
<div class="mb-3">
            <label>Auction End</label><br>
            <input type="datetime-local" name="auction_end" value="{{ old('auction_end') }}" required><br><br>
</div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Create Auction</button>
                <a href="{{ route('auctions.index') }}" class="btn btn-secondary px-4">Back</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
