<?php
session_start();
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $post_result = mysqli_query($conn, "SELECT tb_post.*, tb_user.* FROM tb_post JOIN tb_user ON tb_post.id_user = tb_user.id ORDER BY tb_post.id_post DESC");

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
  <?php
    include 'navbar.php';
    ?>
    
  <div class="container">
    <div class="container-1">
      <!-- Isi kontainer 1 di sini -->
    </div>
    <div class="container-2">
      <div class="column-center">
      <div class="column-center-left" style="border: none;">
 <?php if (!empty($row['profile_picture'])) : ?>
  <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
<?php else : ?>
  <img src="../image_nextstep/profile.jpg" alt="Default Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
<?php endif; ?>

        </div>
      <div class="column-center-right">
      <form action="../proses/upload-post.php" method="post" enctype="multipart/form-data">
        <textarea class="custom-textarea" name="deskripsi" placeholder="share your ideas into words........"></textarea>
        <label for="fileInput" class="custom-file-upload">
          <input type="file" id="fileInput" name="foto">
          <img src="../image_nextstep/document.png" alt="Document Icon">
        </label>
        <label for="fileInput" class="custom-file-upload">
          <input type="file" id="fileInput" name="foto">
          <img src="../image_nextstep/galery.png" alt="Document Icon">
        </label>

        <button type="submit" name="submit" style="float: right; margin-right: 10px; padding:5px; padding-left:15px; padding-right:15px; rect-align:center; color:white; background: green; border-radius:25px;">Post</button>
      </form>
    </div>
</div>

<div class="follow-touggle">
  <button>For You</button>
  <button>Followed</button>
</div>

    <?php
while ($post = mysqli_fetch_array($post_result)) {
?>
  <div class="container-post-h">
    <div class="container-profil-h">
      <div class="container-profil-left">
        <?php if (!empty($post['profile_picture'])) : ?>
          <img src="<?php echo $post['profile_picture']; ?>" alt="Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
        <?php else : ?>
          <img src="../image_nextstep/profile.jpg" alt="Profile Picture" alt="Default Profile Picture" style="width :50px; height: 50px; border-radius: 50px; margin-top: 15px; margin-right: 10px;">
        <?php endif; ?>
      </div>
      <div class="container-profil-right">
        <p><?= $post['name'] ?></p>
        <p><?= $post['title'] ?></p>
      </div>
    </div>
    <div class="container-isi-h">
      <p><?= $post['deskripsi'] ?></p>
      <?php if (!empty($post['foto'])) : ?>
        <img src="<?php echo $post['foto']; ?>" alt="" style="width: 100px;">
      <?php endif; ?>
    </div>
    <div class="container-isi-btn">
      <button><img src="../image_nextstep/like.png"></button>
      <button><img src="../image_nextstep/comment.png"></button>
      <button><img src="../image_nextstep/retweet.png"></button>
      <button><img src="../image_nextstep/send.png"></button>
    </div>
  </div>
<?php
}
?>


    </div>
    <div class="container-3">
      <!-- Isi kontainer 3 di sini -->
    </div>
  </div>
</body>

