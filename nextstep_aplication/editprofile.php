<?php
session_start();
require 'config.php';

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "UPDATE tb_user SET name = '$name' WHERE id = $id";
      mysqli_query($conn, $query);
    }

     if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $query = "UPDATE tb_user SET email = '$email' WHERE id = $id";
      mysqli_query($conn, $query);
    }


    if (isset($_POST['title'])) {
      $title = $_POST['title'];
      $query = "UPDATE tb_user SET title = '$title' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    if (isset($_POST['bio'])) {
      $bio = $_POST['bio'];
      $query = "UPDATE tb_user SET bio = '$bio' WHERE id = $id";
      mysqli_query($conn, $query);
    }

    // Upload foto profil jika ada file yang dipilih
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
      $targetDir = "uploads/"; // Direktori penyimpanan foto profil
      $allowedExtensions = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan
      $filename = $_FILES['profile_picture']['name'];
      $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      // Memeriksa ekstensi file yang diunggah
      if (in_array($fileExtension, $allowedExtensions)) {
        $targetPath = $targetDir . $id . '.' . $fileExtension; // Path lengkap file yang akan disimpan
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath);

        // Memperbarui kolom profile_picture di tabel tb_user
        $query = "UPDATE tb_user SET profile_picture = '$targetPath' WHERE id = $id";
        mysqli_query($conn, $query);
      }
    }

    header("Location: editprofile.php");
    exit();
  }

  // Mendapatkan data profil pengguna
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Edit Profile</title>
  <link rel="stylesheet" type="text/css" href="checkprofile.css?<?php echo time(); ?>">
</head>

<body>
 <?php
    include 'navbar.php';
    ?>

  <div class="edit-profile-container">
    <h1>Edit Profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="profile_picture">Profile Picture</label>
      <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png">
      <?php if (!empty($row['profile_picture'])) : ?>
        <img id="preview_image" src="<?php echo $row['profile_picture']; ?>" alt="Preview Image" style="display: block;">
      <?php else : ?>
        <img id="preview_image" src="default-profile-picture.jpg" alt="Preview Image" style="display: block;">
      <?php endif; ?>
      <script>
        // Fungsi untuk menampilkan gambar yang diupload pada form
        function previewImage() {
          var fileInput = document.getElementById('profile_picture');
          var previewImage = document.getElementById('preview_image');

          // Mengatur event listener ketika gambar dipilih
          fileInput.addEventListener('change', function() {
            var file = fileInput.files[0];
            var reader = new FileReader();

            // Mengatur event listener ketika pembacaan file selesai
            reader.addEventListener('load', function() {
              previewImage.src = reader.result;
              previewImage.style.display = 'block'; // Tampilkan gambar
            });

            if (file) {
              reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
          });
        }

        // Panggil fungsi previewImage saat halaman selesai dimuat
        window.addEventListener('DOMContentLoaded', previewImage);
      </script>


      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">

      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>">

      <label for="bio">Bio</label>
      <textarea id="bio" name="bio"><?php echo $row['bio']; ?></textarea>


      <button type="submit">Save Changes</button>
    </form>
  </div>

</body>

</html>