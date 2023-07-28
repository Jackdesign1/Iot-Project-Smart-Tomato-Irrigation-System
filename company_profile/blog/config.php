<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "reglog";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}

function escape_input($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

function insertDataToTbBlog($judul_berita, $isi_berita, $gambar_berita, $nama_akun, $password_akun, $img_akun, $id_tanggal) {
    global $conn;
    $judul_berita = escape_input($conn, $judul_berita);
    $isi_berita = escape_input($conn, $isi_berita);
    $gambar_berita = escape_input($conn, $gambar_berita);
    $nama_akun = escape_input($conn, $nama_akun);
    $password_akun = escape_input($conn, $password_akun);
    $img_akun = escape_input($conn, $img_akun);
    $id_tanggal = escape_input($conn, $id_tanggal);

    $query = "INSERT INTO tb_blog (judul_berita, isi_berita, gambar_berita, nama_akun, password_akun, img_akun, id_tanggal)
              VALUES ('$judul_berita', '$isi_berita', '$gambar_berita', '$nama_akun', '$password_akun', '$img_akun', '$id_tanggal')";

    if (mysqli_query($conn, $query)) {
        return true; // Jika berhasil memasukkan data
    } else {
        return false; // Jika terjadi kesalahan
    }
}
?>
