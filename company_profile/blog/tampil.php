<?php
session_start();
require 'config.php';
if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $post_result = mysqli_query($conn, "SELECT tb_blog.*, tb_user.* FROM tb_blog JOIN tb_user ON tb_blog.id_user = tb_user.id ORDER BY tb_blog.id_berita DESC");

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
    <title>Tampil Data</title>
</head>
<body>
    <h2>Data Berita</h2>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <h3><?php echo $row["judul_berita"]; ?></h3>
        <p><?php echo $row["isi_berita"]; ?></p>
    <?php } ?>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>



    <?php
while ($post = mysqli_fetch_array($post_result)) {
?>
      <div class="container-profil-right">
        <img src="<?= $post['profile_picture'] ?? 'user-default.jpg'; ?>" alt="Profile Picture">
        <p><?= $post['name'] ?></p>
      </div>
    <div class="container-isi-h">
      <p><?= $post['judul_berita'] ?></p>
      <?php if (!empty($post['gambar_berita'])) : ?>
        <img src="<?php echo $post['gambar_berita']; ?>" alt="" style="width: 100px;">
      <?php endif; ?>
    </div>
<?php
}
?>
