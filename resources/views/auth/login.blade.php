<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <h2>Login</h2>

  <div id="msg" style="color:green;"></div>

  <form id="loginForm">
      @csrf
      <label>Email</label><br>
      <input type="email" name="email" required><br><br>

      <label>Password</label><br>
      <input type="password" name="password" required><br><br>

      <button type="submit">Login</button>
  </form>

<script>
// When the login form is submitted
document.getElementById('loginForm').addEventListener('submit', async (e) => {

    // Prevent the default form submission (which reloads the page)
    e.preventDefault();

    // Collect all the form data (like email, password, CSRF token)
    let formData = new FormData(e.target);

    // Send an AJAX request to the Laravel login route
    let res = await fetch("{{ route('login.submit') }}", {
        method: 'POST', //   sending data to the server
        headers: { 
            //  CSRF token for security verification
            'X-CSRF-TOKEN': formData.get('_token') 
        },
        body: formData // Attach all form fields to the request
    });

    // If the login is successful  
    if (res.ok) {
        // Show a green success message
        document.getElementById('msg').style.color = 'green';
        document.getElementById('msg').textContent = 'Login successful!';

        // After 1 second, redirect the user to the home page
        setTimeout(() => window.location.href = "{{ route('home') }}", 1000);
    } 
    // If the login fails (wrong email or password)
    else {
        // Show a red error message
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').textContent = 'Invalid email or password!';
    }
});
</script>


</body>
</html>
