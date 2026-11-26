<?php
include "../config.php";

$query = mysqli_query($con, "
    SELECT 
        p.id_pelanggan,
        p.nama_pelanggan,
        jp.jenis,
        p.alamat,
        p.no_handphone
    FROM pelanggan p
    JOIN jenis_pelanggan jp
    ON p.id_jenis = jp.id_jenis
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
</head>
<body>

<h2>Data Pelanggan</h2>

<a href="tambah.php">+ Tambah Pelanggan</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Jenis</th>
        <th>Alamat</th>
        <th>No Handphone</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama_pelanggan']; ?></td>
        <td><?= $data['jenis']; ?></td>
        <td><?= $data['alamat']; ?></td>
        <td><?= $data['no_handphone']; ?></td>
        <td>
            <a href="edit.php?id=<?= $data['id_pelanggan']; ?>">
                Edit
            </a>
            |
            <a href="hapus.php?id=<?= $data['id_pelanggan']; ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
                Hapus
            </a>
        </td>
    </tr>

    <?php } ?>

</table>

</body>
</html>