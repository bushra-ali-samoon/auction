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
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    let formData = new FormData(e.target);

    let res = await fetch("{{ route('login.submit') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': formData.get('_token') },
        body: formData
    });

    if (res.ok) {
        document.getElementById('msg').style.color = 'green';
        document.getElementById('msg').textContent = 'Login successful!';
        setTimeout(() => window.location.href = "{{ route('home') }}", 1000);
    } else {
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').textContent = 'Invalid email or password!';
    }
});
</script>

</body>
</html>
