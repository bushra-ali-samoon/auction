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
$('#loginForm').submit(function(e){
    e.preventDefault(); // Stop page reload

    var form = this;
    var data = new FormData(form); // Collect all form inputs

    $.ajax({
        url: "{{ route('login.submit') }}",
        method: "POST",
        data: data,
        contentType: false,  // Needed for FormData
        processData: false,  // Prevent jQuery from processing the data
        headers: {'X-CSRF-TOKEN': data.get('_token')}, // CSRF token for security

        success: function(){
            // Show success message in green
            $('#msg').css('color','green').text('Login successful!');
            // Redirect to home page after 1 second
            setTimeout(function(){ window.location.href = "{{ route('home') }}"; }, 1000);
        },

        error: function(){
            // Show error message in red
            $('#msg').css('color','red').text('Invalid email or password!');
        }
    });
});
</script>


</body>
</html>
