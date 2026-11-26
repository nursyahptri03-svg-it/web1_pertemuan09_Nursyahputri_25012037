<?php
include "../config.php";

$id = $_GET['id'];

$data = mysqli_query(
    $con,
    "SELECT * FROM jenis_pelanggan WHERE id_jenis='$id'"
);

$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {

    $jenis = $_POST['jenis'];

    mysqli_query(
        $con,
        "UPDATE jenis_pelanggan
         SET jenis='$jenis'
         WHERE id_jenis='$id'"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jenis Pelanggan</title>
</head>
<body>

<h2>Edit Jenis Pelanggan</h2>

<form method="post">

    <label>Jenis Pelanggan</label><br>

    <input
        type="text"
        name="jenis"
        value="<?= htmlspecialchars($row['jenis']); ?>"
        required
    >

    <br><br>

    <button type="submit" name="update">Update</button>
    <a href="index.php">Kembali</a>

</form>

</body>
</html>