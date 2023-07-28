<?php
session_start();
require 'config.php';

if (!empty($_SESSION["id"])) {
  header("Location: dashboard.php");
  exit();
}

if (isset($_POST["submit"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Menggunakan prepared statement untuk mencegah SQL injection
  $stmt = $conn->prepare("SELECT * FROM tb_user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($result->num_rows > 0) {
    if (password_verify($password, $row['password'])) {
      $_SESSION["id"] = $row["id"];
      header("Location: dashboard.php");
      exit();
    } else {
      echo "<script> alert('Wrong Password'); </script>";
    }
  } else {
    echo "<script> alert('User Not Registered'); </script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <div class="login-container">
      <h2>Login</h2>
      <form action="" method="post" autocomplete="off">
        <label for="username">Email:</label>
        <input type="text" name="email" id="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit" name="submit">Login</button>
      </form>
      <a class="register-link" href="registration.php">Don't have an account? Register</a>
    </div>
  </div>
</body>
</html>
