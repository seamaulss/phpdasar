<!-- Belajar menghubungkan PHP dengan database.
Belajar menampilkan data dinamis di tabel HTML.
Memahami looping dengan PHP (foreach).
Persiapan untuk latihan CRUD lengkap (nanti tambah, ubah, hapus data). -->

<!-- NOTE: kolom jurusan tampil angka karena udah saya ubah yang sebelumnya
varchar menjadi INT dengan length 11 supaya bisa di relasikan ke tabel mahasiswa -->

<?php
require 'function.php';
$mahasiswa = query("
    SELECT mahasiswa.*, jurusan.nama_jurusan 
    FROM mahasiswa
    LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
");

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
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="50" class="img-thumbnail"></td>
                <td><?= $row["nrp"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["nama_jurusan"]; ?></td>
                <td class="aksi">
                    <a href="">ubah</a> |
                    <a href="">hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>