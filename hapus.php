<?php

include "../config.php";

$id = $_GET['id'];

mysqli_query(
    $con,
    "DELETE FROM pelanggan WHERE id_pelanggan='$id'"
);

header("Location: index.php");
exit;

?>