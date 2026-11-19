<?php
include "koneksi.php";
// Edit kategori
if (isset($_POST['edit_kategori'])) {
    $id = $_POST['id_kategori'];
    $nama = $_POST['nama_kategori'];

    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama'
    WHERE id_kategori='$id'");

    $pesan = "Kategori berhasil diubah";
}

// Edit produk
if (isset($_POST['edit_produk'])) {
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "UPDATE produk SET
    nama_produk='$nama',
    id_kategori='$kategori',
    harga='$harga',
    stok='$stok'
    WHERE id_produk='$id'");

    $pesan = "Produk berhasil diubah";
}

$pesan = "";

// Tambah kategori
if (isset($_POST['tambah_kategori'])) {
    $nama = $_POST['nama_kategori'];

    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    $pesan = "Kategori berhasil ditambahkan";
}

// Hapus kategori
if (isset($_GET['hapus_kategori'])) {
    $id = $_GET['hapus_kategori'];

    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$id'");
    $pesan = "Kategori berhasil dihapus";
}

// Tambah produk
if (isset($_POST['tambah_produk'])) {
    $nama = $_POST['nama_produk'];
    $kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO produk
    (id_kategori, nama_produk, harga, stok)
    VALUES ('$kategori', '$nama', '$harga', '$stok')");

    $pesan = "Produk berhasil ditambahkan";
}

// Hapus produk
if (isset($_GET['hapus_produk'])) {
    $id = $_GET['hapus_produk'];

    mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
    $pesan = "Produk berhasil dihapus";
}

// Ambil data kategori
$data_kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Ambil data produk
$data_produk = mysqli_query($conn, "
    SELECT produk.*, kategori.nama_kategori
    FROM produk
    JOIN kategori ON produk.id_kategori = kategori.id_kategori
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori dan Produk</title>

    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f2f2f2;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 25px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #ddd;
        }

        input, select {
            padding: 8px;
            margin: 5px 0;
        }

        button {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            color: red;
        }
    </style>
</head>

<body>

<h2>Data Kategori</h2>

<p><?php echo $pesan; ?></p>

<form method="POST">
    <input type="text" name="nama_kategori" placeholder="Nama Kategori" required>
    <button type="submit" name="tambah_kategori">Simpan</button>
</form>
<?php
if (isset($_GET['edit_kategori'])) {
    $id = $_GET['edit_kategori'];

    $hasil = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id'");
    $edit = mysqli_fetch_assoc($hasil);
?>

<h3>Edit Kategori</h3>

<form method="POST">
    <input type="hidden" name="id_kategori"
    value="<?php echo $edit['id_kategori']; ?>">

    <input type="text" name="nama_kategori"
    value="<?php echo $edit['nama_kategori']; ?>" required>

    <button type="submit" name="edit_kategori">Update Kategori</button>
</form>

<?php } ?>

<br>

<table>
    <tr>
        <th>ID Kategori</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php while ($kategori = mysqli_fetch_assoc($data_kategori)) { ?>
    <tr>
        <td><?php echo $kategori['id_kategori']; ?></td>
        <td><?php echo $kategori['nama_kategori']; ?></td>
        <td>
    <a href="?edit_kategori=<?php echo $kategori['id_kategori']; ?>">Edit</a> |

    <a href="?hapus_kategori=<?php echo $kategori['id_kategori']; ?>"
    onclick="return confirm('Hapus kategori?')">Hapus</a>
</td>
    </tr>
    <?php } ?>
</table>

<h2>Data Produk</h2>

<form method="POST">
    <input type="text" name="nama_produk" placeholder="Nama Produk" required>
    <br>

    <select name="id_kategori" required>
        <option value="">Pilih Kategori</option>

        <?php
        $pilihan = mysqli_query($conn, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($pilihan)) {
        ?>
            <option value="<?php echo $k['id_kategori']; ?>">
                <?php echo $k['nama_kategori']; ?>
            </option>
        <?php } ?>
    </select>
    <br>

    <input type="number" name="harga" placeholder="Harga" required>
    <br>

    <input type="number" name="stok" placeholder="Stok" required>
    <br>

    <button type="submit" name="tambah_produk">Simpan Produk</button>
</form>
<?php
if (isset($_GET['edit_produk'])) {
    $id = $_GET['edit_produk'];

    $hasil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
    $edit = mysqli_fetch_assoc($hasil);
?>

<h3>Edit Produk</h3>

<form method="POST">

    <input type="hidden" name="id_produk"
    value="<?php echo $edit['id_produk']; ?>">

    <input type="text" name="nama_produk"
    value="<?php echo $edit['nama_produk']; ?>" required>

    <select name="id_kategori" required>
        <?php
        $pilihan = mysqli_query($conn, "SELECT * FROM kategori");

        while ($k = mysqli_fetch_assoc($pilihan)) {
        ?>
            <option value="<?php echo $k['id_kategori']; ?>"
            <?php if ($k['id_kategori'] == $edit['id_kategori']) echo "selected"; ?>>
                <?php echo $k['nama_kategori']; ?>
            </option>
        <?php } ?>
    </select>

    <input type="number" name="harga"
    value="<?php echo $edit['harga']; ?>" required>

    <input type="number" name="stok"
    value="<?php echo $edit['stok']; ?>" required>

    <button type="submit" name="edit_produk">Update Produk</button>

</form>

<?php } ?>
<br>

<table>
    <tr>
        <th>ID Produk</th>
        <th>ID Kategori</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($produk = mysqli_fetch_assoc($data_produk)) { ?>
    <tr>
        <td><?php echo $produk['id_produk']; ?></td>
        <td><?php echo $produk['id_kategori']; ?></td>
        <td><?php echo $produk['nama_produk']; ?></td>
        <td><?php echo $produk['harga']; ?></td>
        <td><?php echo $produk['stok']; ?></td>
        <td>
    <a href="?edit_produk=<?php echo $produk['id_produk']; ?>">Edit</a> |

    <a href="?hapus_produk=<?php echo $produk['id_produk']; ?>"
    onclick="return confirm('Hapus produk?')">Hapus</a>
</td>
    </tr>
    <?php } ?>
</table>

</body>
</html>