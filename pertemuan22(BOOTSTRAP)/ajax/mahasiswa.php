<!-- Kode ini menampilkan tabel mahasiswa secara dinamis.

Bisa mencari data berdasarkan keyword (nama, NRP, email, jurusan).

Biasanya dipakai untuk AJAX live search, karena data diambil lewat $_GET.

Ada tombol aksi untuk ubah/hapus data mahasiswa.

Tabel menggunakan Bootstrap agar responsive dan rapi. -->

<?php

usleep(500000); // delay 0.5 detik

require '../function.php';
$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";

// query menggunakan JOIN agar nama jurusan muncul
$query = "
    SELECT mahasiswa.*, jurusan.nama_jurusan
    FROM mahasiswa
    LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
    WHERE 
        mahasiswa.nama LIKE '%$keyword%' OR
        mahasiswa.nrp LIKE '%$keyword%' OR
        mahasiswa.email LIKE '%$keyword%' OR
        jurusan.nama_jurusan LIKE '%$keyword%'
";
$mahasiswa = query($query);

?>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">

        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>

                    <td>
                        <img
                            src="/phpdasar/pertemuan22(BOOTSTRAP)/img/<?= $row['gambar']; ?>"
                            width="100"
                            class="img-thumbnail">
                    </td>

                    <td><?= $row["nrp"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["nama_jurusan"]; ?></td>

                    <td>
                        <a href="ubah.php?id=<?= $row['id']; ?>"
                            class="btn btn-warning btn-sm me-1">
                            Ubah
                        </a>

                        <a href="hapus.php?id=<?= $row['id']; ?>"
                            onclick="return confirm('yakin?');"
                            class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>