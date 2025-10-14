<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Login</h2>

    {{-- Success & Error messages --}}
    <div id="successMsg" style="color:green;"></div>
    <div id="errorMsg" style="color:red;"></div>

    <form id="loginForm">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

 
</body>
</html>
