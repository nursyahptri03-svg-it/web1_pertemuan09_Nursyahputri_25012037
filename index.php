<?php
include "../config.php";

$data = mysqli_query($con, "SELECT * FROM jenis_pelanggan ORDER BY id_jenis DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Jenis Pelanggan</title>
</head>
<body>

<h2>Data Jenis Pelanggan</h2>

<a href="tambah.php">+ Tambah Jenis Pelanggan</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Jenis</th>
        <th>Jenis</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['id_jenis']; ?></td>
        <td><?= htmlspecialchars($row['jenis']); ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_jenis']; ?>">Edit</a>
            |
            <a href="hapus.php?id=<?= $row['id_jenis']; ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

<br>

<a href="../index.php">Kembali</a>

</body>
</html>