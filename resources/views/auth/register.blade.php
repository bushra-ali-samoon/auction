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
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    let formData = new FormData(e.target);

    let res = await fetch("{{ route('register.submit') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': formData.get('_token') },
        body: formData
    });

    if (res.ok) {
        document.getElementById('msg').style.color = 'green';
        document.getElementById('msg').textContent = 'Registered successfully!';
        e.target.reset();
    } else {
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').textContent = 'Something went wrong!';
    }
});
</script>

</body>
</html>
