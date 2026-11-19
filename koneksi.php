<?php
$conn = mysqli_connect("localhost", "root", "", "web1_pertemuan09");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>