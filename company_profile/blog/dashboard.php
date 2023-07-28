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
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextstep - Home</title>
    <style>
        /* Tampilan umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Form posting berita */
        form {
            margin: 10px;
            max-width: 1000px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        textarea, input[type="file"], button {
            margin: 5px;
            display: block;
            width: 900px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            color: white;
            background: green;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        /* Container postingan */
        .container-post {
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .container-post img {
            width: 50px;
            height: 50px;
            border-radius: 50px;
            margin-right: 10px;
        }

        .container-isi-h img {
            width: 100px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <form action="upload-post.php" method="post" enctype="multipart/form-data">
        <textarea name="judul_berita" placeholder="Judul berita"></textarea>
        <textarea name="isi_berita" placeholder="Isi berita"></textarea>
        <input type="file" name="gambar_berita">
        <button type="submit" name="submit">Post</button>
    </form>
    <a href="logout.php">Logout</a>

    <?php while ($post = mysqli_fetch_array($post_result)) : ?>
        <div class="container-post">
            <img src="<?= $post['profile_picture'] ?? 'user-default.jpg'; ?>" alt="Profile Picture">
            <div>
                <p><?= $post['name']; ?></p>
                <p><?= $post['judul_berita']; ?></p>
                <?php if (!empty($post['gambar_berita'])) : ?>
                    <img src="<?= $post['gambar_berita']; ?>" alt="">
                <?php endif; ?>
                <p><?= $post['isi_berita']; ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</body>
</html>

      
       