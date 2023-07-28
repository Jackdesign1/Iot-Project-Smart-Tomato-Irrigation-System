<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {
    $id = $_SESSION["id"];
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    
    if (!empty($_FILES['gambar_berita']['name'])) {
        $image = $_FILES['gambar_berita'];
        
        if ($image["error"] != 0) {
            die("Image upload failed: " . $image["error"]);
        }
        
        $target_dir = 'uploads/';
        $path = 'uploads/' . $image['name'];
        $target_file = $target_dir . basename($image["name"]);
        
        move_uploaded_file($image['tmp_name'], $target_file);
        
        $sql = "INSERT INTO tb_blog (judul_berita, isi_berita, gambar_berita, id_user) VALUES ('$judul_berita', '$isi_berita', '$path', '$id')";
    } else {
        $sql = "INSERT INTO tb_blog (judul_berita, isi_berita, id_user) VALUES ('$judul_berita', '$isi_berita', '$id')";
    }
    
    mysqli_query($conn, $sql);
    header("Location: ../blog.php");

}
?>
