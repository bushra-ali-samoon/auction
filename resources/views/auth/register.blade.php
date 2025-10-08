<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password</label><br>
        <input type="password" name="password_confirmation" required><br><br>

 

        <button type="submit">Register</button>
    </form>
</body>
</html>
