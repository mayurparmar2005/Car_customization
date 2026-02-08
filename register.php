<?php
include('db.php');
if(isset($_POST['register'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    // simple check
    $check = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $r = mysqli_query($conn, $check);
    if(mysqli_num_rows($r) > 0){
        $msg = "Email already registered. Please login.";
    } else {
        $ins = "INSERT INTO users (email,password) VALUES ('$email','$password')";
        if(mysqli_query($conn, $ins)){
            $msg = "Registration successful. You may login now.";
        } else {
            $msg = "Registration failed.";
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register - Car Customization</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page-center">
  <div class="card small">
    <h2>Create account</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="register">Register</button>
    </form>
    <p class="muted">Already have an account? <a href="index.php">Login</a></p>
    <?php if(isset($msg)) echo '<p class="info">'.htmlspecialchars($msg).'</p>'; ?>
  </div>
</div>
</body>
</html>