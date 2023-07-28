<?php
require 'blog/config.php';

// Hapus bagian session_start() dan pengecekan $_SESSION

$result = mysqli_query($conn, "SELECT tb_blog.*, tb_user.name FROM tb_blog JOIN tb_user ON tb_blog.id_user = tb_user.id ORDER BY tb_blog.id_berita DESC");

if (!$result) {
  die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tampil Data</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
</head>
<body>

    <?php
    include 'header.php';
    ?>

    <?php
    while ($post = mysqli_fetch_array($result)) {
    ?>
    <div class="container_blog">
        <div class="judul-blog">
            <h2><?php echo $post["judul_berita"]; ?></h2>
        </div>
        <div class="gambar">
            <?php if (!empty($post['gambar_berita'])) : ?>
                <img src="<?php echo $post['gambar_berita']; ?>" alt="" style="width: 100px;">
            <?php endif; ?>
        </div>
        <div class="penulis-blog">
            <p><?= $post['name'] ?></p>
        </div>
        <div class="isi-berita">
            <p><?php echo $post["isi_berita"]; ?></p>
        </div>
    </div>
    <?php
    }
    ?>

    <?php
    include 'footer.php';
    ?>

</body>
</html>
