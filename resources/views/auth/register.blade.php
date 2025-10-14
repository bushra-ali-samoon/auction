<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Register</h2>

    {{-- Success & Error messages --}}
    <div id="successMsg" style="color:green;"></div>
    <div id="errorMsg" style="color:red;"></div>

    <form id="registerForm">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required><br><br>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>

 
</body>
</html>
