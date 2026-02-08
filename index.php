<?php
session_start();
include('db.php');
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 1){
        $_SESSION['email'] = $email;
        header('Location: home.php');
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login - Car Customization</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page-center">
  <div class="card small">
    <h2>Car Customization</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>
    <p class="muted">Don't have an account? <a href="register.php">Register</a></p>
    <?php if(isset($error)) echo '<p class="error">'.htmlspecialchars($error).'</p>'; ?>
  </div>
</div>
</body>
</html>