<?php
session_start();
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
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Nextstep - Profile</title>
  <link rel="stylesheet" type="text/css" href="checkprofile.css?<?php echo time(); ?>">

</head>

<body>
   <?php
    include 'navbar.php';
    ?>
</nav>
  <div class="profile-container">
    <div class="profile-picture">
      <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture">
    </div>
    <div class="profile-info">
      <h1 class="profile-name"><?php echo $row['name']; ?></h1>
      <p class="profile-title"><?php echo $row['title']; ?></p>
      <p class="profile-bio"><?php echo $row['bio']; ?></p>
    </div>
  </div>

  <div class="container-2">
    <button>Post</button>
    <button>Background</button>
  </div>

  <?php
  while ($post = mysqli_fetch_array($post_result)) {
  ?>
    <div class="container-post">
      <div class="container-profil">
        <div class="container-profil-left">
          <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
        </div>
        <div class="container-profil-right">
          <p><?= $post['name'] ?></p>
          <p><?= $post['title'] ?></p>
        </div>
      </div>
       <div class="container-isi">
      <p><?= $post['deskripsi'] ?></p>
      <?php if (!empty($post['foto'])) : ?>
        <img src="<?php echo $post['foto']; ?>" alt="" style="width: 100px;">
      <?php endif; ?>
    </div>
    <div class="container-isi">
      <button>like</button>
      <button>comment</button>
      <button>share</button>
    </div>
    </div>
  <?php
  }
  ?>

</body>

</html>



