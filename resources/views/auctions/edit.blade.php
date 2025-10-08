<!-- resources/views/auctions/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Auction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Edit Auction</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('auctions.update', $auction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $auction->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Starting Price</label>
            <input type="number" name="starting_price" class="form-control" value="{{ old('starting_price', $auction->starting_price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Auction</button>
        <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>
