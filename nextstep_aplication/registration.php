<?php
session_start();
require 'config.php';

if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  // Periksa apakah password dan konfirmasi password cocok
  if ($password !== $confirmpassword) {
    echo "<script> alert('Password and Confirm Password do not match'); </script>";
  } else {
    // Periksa apakah username atau email sudah terdaftar
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    if (mysqli_num_rows($result) > 0) {
      echo "<script> alert('Username or Email already exists'); </script>";
    } else {
      // Enkripsi password sebelum disimpan ke database
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Simpan data pengguna ke tabel tb_user
      $query = "INSERT INTO tb_user (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
      if (mysqli_query($conn, $query)) {
        echo "<script> alert('Registration Successful!'); </script>";
        header("Location: login.php");
        exit();
      } else {
        echo "<script> alert('Error: " . mysqli_error($conn) . "'); </script>";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="reglog.css">
  </head>
  <body>
    <div class="registration-container">
      <h2>Registration</h2>
      <form action="" method="post" autocomplete="off">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" name="confirmpassword" id="confirmpassword" required><br>
        <button type="submit" name="submit">Register</button>
      </form>
      <a href="login.php">already have account? login</a>
    </div>
  </body>
</html>
