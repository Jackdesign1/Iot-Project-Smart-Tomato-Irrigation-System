<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $post_result = mysqli_query($conn, "SELECT tb_post.*, tb_user.* FROM tb_post JOIN tb_user ON tb_post.id_user = tb_user.id WHERE tb_post.id_user = $id ORDER BY tb_post.id_post DESC");

  if (!$post_result) {
    die("Query error: " . mysqli_error($conn));
  }
} else {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nextstep - Home</title>
  <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
        <img src="../image_nextstep/logo_nextstep.png" class="logo_ns" href="home.php">
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Cari...">
            <button class="search-button">Cari</button>
        </div>
        <div class="nav-link-center">
        <a class="nav-link" href="index.php"><img src="../image_nextstep/home.png"></a>
        <a class="nav-link" href="friends.php"><img src="../image_nextstep/friends.png"></a>
        <a class="nav-link" href="work.php"><img src="../image_nextstep/link.png"></a>
        <a class="nav-link" href="#"><img src="../image_nextstep/notification.png"></a>
        <a class="nav-link" href="#"><img src="../image_nextstep/marketplace.png"></a>
      </div>
        <div class="dropdown">
            <input type="checkbox" id="group-toggle" class="toggle">
            <label for="group-toggle" class="group-link">
  <?php if (!empty($row['profile_picture'])) : ?>
    <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width: 35px;">
  <?php else : ?>
    <img src="../image_nextstep/profile.jpg" alt="Profile Picture" >
  <?php endif; ?>
</label>

            <div class="dropdown-content">
                <a href="editprofile.php">Edit Profile</a>
                <a href="checkprofile.php">Check Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
</body>
</html>

