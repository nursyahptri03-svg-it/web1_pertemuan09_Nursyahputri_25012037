<?php
include "../config.php";

$id = $_GET['id'];

mysqli_query(
    $con,
    "DELETE FROM jenis_pelanggan
     WHERE id_jenis='$id'"
);

header("Location: index.php");
exit;
?>