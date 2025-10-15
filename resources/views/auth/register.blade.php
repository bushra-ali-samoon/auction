<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <h2>Register</h2>

  <div id="msg" style="color:green;"></div>

  <form id="registerForm">
      @csrf
      <input type="text" name="name" placeholder="Name" required><br><br>
      <input type="email" name="email" placeholder="Email" required><br><br>
      <input type="password" name="password" placeholder="Password" required><br><br>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

      <select name="role" required>
          <option value="">Select Role</option>
          <option value="buyer">Buyer</option>
          <option value="seller">Seller</option>
      </select><br><br>

      <button type="submit">Register</button>
  </form>

 <script>
// When the register form is submitted
document.getElementById('registerForm').addEventListener('submit', async (e) => {

    // Stop the form from reloading the page (default browser behavior)
    e.preventDefault();

    // Collect all form data including inputs, files, and CSRF token
    let formData = new FormData(e.target);

    // Send the form data to the server using AJAX (without page reload)
    let res = await fetch("{{ route('register.submit') }}", {
        method: 'POST', // we’re sending data, so we use POST
        headers: { 
            // CSRF token for  security check
            'X-CSRF-TOKEN': formData.get('_token') 
        },
        body: formData // attach the form data
    });

    // If the server responds successfully  
    if (res.ok) {
        // Show a success message in green
        document.getElementById('msg').style.color = 'green';
        document.getElementById('msg').textContent = 'Registered successfully!';

        // Clear the form after successful registration
        e.target.reset();
    } 
    // If something goes wrong  
    else {
        // Show an error message in red
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').textContent = 'Something went wrong!';
    }
});
</script>

</body>
</html>
