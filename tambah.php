<?php
include "../config.php";

if (isset($_POST['simpan'])) {

    $id_jenis = $_POST['id_jenis'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_handphone'];

    mysqli_query($con, "
        INSERT INTO pelanggan
        (id_jenis, nama_pelanggan, alamat, no_handphone)
        VALUES
        ('$id_jenis', '$nama', '$alamat', '$no_hp')
    ");

    header("Location: index.php");
    exit;
}

$jenis = mysqli_query($con, "SELECT * FROM jenis_pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>
</head>
<body>

<h2>Tambah Pelanggan</h2>

<form method="POST">

    <label>Jenis Pelanggan</label><br>

    <select name="id_jenis" required>
        <option value="">-- Pilih Jenis --</option>

        <?php while ($data = mysqli_fetch_assoc($jenis)) { ?>

            <option value="<?= $data['id_jenis']; ?>">
                <?= $data['jenis']; ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Nama Pelanggan</label><br>
    <input type="text" name="nama_pelanggan" required>

    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required></textarea>

    <br><br>

    <label>No Handphone</label><br>
    <input type="text" name="no_handphone" required>

    <br><br>

    <button type="submit" name="simpan">
        Simpan
    </button>

    <a href="index.php">Kembali</a>

</form>

</body>
</html>