<?php
include "../config.php";

if (isset($_POST['simpan'])) {

    $jenis = $_POST['jenis'];

    mysqli_query($con, "INSERT INTO jenis_pelanggan (jenis)
                        VALUES ('$jenis')");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jenis Pelanggan</title>
</head>
<body>

<h2>Tambah Jenis Pelanggan</h2>

<form method="post">

    <label>Jenis Pelanggan</label><br>
    <input type="text" name="jenis" required>

    <br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="index.php">Kembali</a>

</form>

</body>
</html>