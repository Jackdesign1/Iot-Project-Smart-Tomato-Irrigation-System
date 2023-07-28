<?php
$conn = mysqli_connect("localhost", "root", "", "reglog");

// Check connection
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
