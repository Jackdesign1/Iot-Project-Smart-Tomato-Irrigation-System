<?php
session_start();
require '../nextstep_aplication/config.php';
if (isset($_POST['submit'])) {
    $id = $_SESSION["id"];
    $description = $_POST['deskripsi'];
    
    if (!empty($_FILES['foto']['name'])) {
        $image = $_FILES['foto'];
        
        if ($image["error"] != 0) {
            die("Image upload failed: " . $image_file["error"]);
        }
        
        $target_dir = '../uploads/';
        $path = 'uploads/' . $image['name'];
        $target_file = $target_dir . basename($image["name"]);
        
        move_uploaded_file($image['tmp_name'], $target_file);
        
        $sql = "INSERT INTO tb_post (deskripsi, foto, id_user) VALUES ('$description', '$path', '$id')";
    } else {
        $sql = "INSERT INTO tb_post (deskripsi, id_user) VALUES ('$description', '$id')";
    }
    
    mysqli_query($conn, $sql);
    header("Location: ../nextstep_aplication/index.php");
}
?>
