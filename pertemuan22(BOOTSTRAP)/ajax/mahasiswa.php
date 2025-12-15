<!-- Kode ini menampilkan tabel mahasiswa secara dinamis.

Bisa mencari data berdasarkan keyword (nama, NRP, email, jurusan).

Biasanya dipakai untuk AJAX live search, karena data diambil lewat $_GET.

Ada tombol aksi untuk ubah/hapus data mahasiswa.

Tabel menggunakan Bootstrap agar responsive dan rapi. -->

<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../function.php';

// TOMBOL CARI DAN KEYWORD
$keyword = $_GET["keyword"] ?? ""; // ambil dari GET agar pagination bisa ikut keyword

// PAGINATION CONFIG
$jumlahDataPerHalaman = 5;

// HITUNG TOTAL DATA SESUAI KEYWORD
if ($keyword) {
    $jumlahData = count(query("
        SELECT mahasiswa.*, jurusan.nama_jurusan 
        FROM mahasiswa
        LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
        WHERE 
            mahasiswa.nama LIKE '%$keyword%' OR
            mahasiswa.nrp LIKE '%$keyword%' OR
            mahasiswa.email LIKE '%$keyword%' OR
            jurusan.nama_jurusan LIKE '%$keyword%'
    "));
} else {
    $jumlahData = count(query("SELECT * FROM mahasiswa"));
}

$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = isset($_GET["halaman"]) ? intval($_GET["halaman"]) : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// AMBIL DATA SESUAI HALAMAN DAN KEYWORD
if ($keyword) {
    $mahasiswa = query("
        SELECT mahasiswa.*, jurusan.nama_jurusan 
        FROM mahasiswa
        LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
        WHERE 
            mahasiswa.nama LIKE '%$keyword%' OR
            mahasiswa.nrp LIKE '%$keyword%' OR
            mahasiswa.email LIKE '%$keyword%' OR
            jurusan.nama_jurusan LIKE '%$keyword%'
        LIMIT $awalData, $jumlahDataPerHalaman
    ");
} else {
    $mahasiswa = query("
        SELECT mahasiswa.*, jurusan.nama_jurusan 
        FROM mahasiswa
        LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
        LIMIT $awalData, $jumlahDataPerHalaman
    ");
}
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

    <div class="pagination mt-2">
        <?php if ($halamanAktif > 1): ?>
            <a href="?halaman=<?= $halamanAktif - 1 ?>&keyword=<?= urlencode($keyword) ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($h = 1; $h <= $jumlahHalaman; $h++): ?>
            <a href="?halaman=<?= $h ?>&keyword=<?= urlencode($keyword) ?>" class="<?= ($h == $halamanAktif) ? 'active' : '' ?>"><?= $h ?></a>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman): ?>
            <a href="?halaman=<?= $halamanAktif + 1 ?>&keyword=<?= urlencode($keyword) ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>

</div>