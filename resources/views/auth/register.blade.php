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
$('#registerForm').submit(function(e){
    e.preventDefault(); // Stop the page from reloading

    var form = this;               // Reference to the form
    var data = new FormData(form); // Collect all form inputs

    // Send form data to the server using AJAX
    $.ajax({
        url: "{{ route('register.submit') }}", // Laravel route
        method: "POST",                        // HTTP POST request
        data: data,                             // Form data
        contentType: false,                     // Needed for FormData
        processData: false,                     // Prevent jQuery from processing data
        headers: {'X-CSRF-TOKEN': data.get('_token')}, // CSRF token for security

        success: function(){
            // If registration is successful
            $('#msg').css('color','green').text('Registered successfully!');
            form.reset(); // Clear the form inputs
        },

        error: function(){
            // If there is an error
            $('#msg').css('color','red').text('Something went wrong!');
        }
    });
});
</script>



</body>
</html>
