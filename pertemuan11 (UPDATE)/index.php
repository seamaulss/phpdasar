<!-- Belajar menampilkan data dari database di PHP menggunakan POST/GET.
Mengenal looping foreach untuk tabel data.
Memahami konsep CRUD:
Create → tambah.php
Read → halaman ini
Update → ubah.php
Delete → hapus.php
Latihan ini juga mengajarkan menghubungkan database, menampilkan gambar, dan membuat aksi link. -->


<?php 
require 'function.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>

    </form>

    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach( $mahasiswa as $row ) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> | 
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" >hapus</a>
        </td>
        <td><img src="img/<?php echo $row["gambar"]; ?>"
        width="50"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan_id"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

    </table>
</body>
</html>