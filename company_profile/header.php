<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Header</title>
</head>
<body>

<style>
  .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #ffff;
  color: #ffff;
  padding: 10px;
  border-bottom: 2px solid #DDDDDD;
}

.navbar-left {
  display: flex;
  align-items: center;
}

.logo {
  width: 120px;
}

.navbar-center {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar-center a {
  margin: 0 10px;
  text-decoration: none;
  color: #333;
}

.navbar-right a {
  margin: 0 10px;
  text-decoration: none;
  color: #333;
}

button {
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 18px;
}

button.register {
  /* CSS properties seperti yang telah Anda definisikan sebelumnya */
  background-color: white;
  color: #fff;
  border: 1px solid #e0e1dd;
  border-radius: 25px;
  font-size: 18px;

  /* Animasi untuk perubahan border */
  transition: border-color 1s ease;
}

/* Hover effect untuk tombol */
button.register:hover {
  /* Perubahan border color saat tombol dihover */
  border-color: seagreen;
  border : 2px solid seagreen;
}

/* Animasi ketika tombol ditekan */
button.register:active {
  animation: waterFlow 1s ease;
}


/* Styling khusus untuk tombol login */
.login {
  background-color: seagreen; /* Warna latar belakang */
  color: #fff; /* Warna teks */
  border: 1px solid black;
  border-radius: 25px;
}

/* Style untuk link di dalam tombol */
button a {
  color: inherit; /* Pewarisan warna teks dari tombol */
  text-decoration: none;
}

/* Hover effect untuk tombol */
button:hover {
  opacity: 0.8;
}


</style>


<header class="navbar">
    <div class="navbar-left">
      <img src="../image_nextstep/logo_nextstep.png" alt="NextStep Logo" class="logo">
    </div>
    <div class="navbar-center">
      <a href="index.php">Home</a>
      <a href="blog.php">Blog</a>
      <a href="aboutus.php">About Us</a>
    </div>
    <div class="navbar-right">
      <button class="register"><a href="#register">Register</a></button>
      <button class="login"><a href="#login">Login</a></button>
    </div>
  </header>
</body>
</html>