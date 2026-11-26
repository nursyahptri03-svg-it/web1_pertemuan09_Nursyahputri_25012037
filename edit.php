<?php
include "../config.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'")
);

$jenis = mysqli_query($con, "SELECT * FROM jenis_pelanggan");

if (isset($_POST['update'])) {

    $id_jenis = $_POST['id_jenis'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_handphone'];

    mysqli_query($con, "
        UPDATE pelanggan SET
        id_jenis='$id_jenis',
        nama_pelanggan='$nama',
        alamat='$alamat',
        no_handphone='$no_hp'
        WHERE id_pelanggan='$id'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
</head>
<body>

<h2>Edit Pelanggan</h2>

<form method="POST">

    <label>Jenis Pelanggan</label><br>

    <select name="id_jenis" required>

        <?php while ($j = mysqli_fetch_assoc($jenis)) { ?>

            <option value="<?= $j['id_jenis']; ?>"
                <?= $j['id_jenis'] == $data['id_jenis'] ? 'selected' : ''; ?>>
                <?= $j['jenis']; ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Nama Pelanggan</label><br>
    <input type="text"
           name="nama_pelanggan"
           value="<?= $data['nama_pelanggan']; ?>"
           required>

    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= $data['alamat']; ?></textarea>

    <br><br>

    <label>No Handphone</label><br>
    <input type="text"
           name="no_handphone"
           value="<?= $data['no_handphone']; ?>"
           required>

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

    <a href="index.php">Kembali</a>

</form>

</body>
</html>