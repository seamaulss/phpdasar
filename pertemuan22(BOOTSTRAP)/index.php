<!-- Halaman ini hanya bisa diakses admin yang login.

Menampilkan data mahasiswa beserta jurusan.

Bisa mencari mahasiswa berdasarkan nama, NRP, email, atau jurusan.

Ada tabel interaktif dengan tombol ubah dan hapus.

Sidebar untuk navigasi admin: tambah mahasiswa, kelola jurusan, cetak data, logout. -->

<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// AMBIL DATA MAHASISWA + NAMA JURUSAN
$mahasiswa = query("
    SELECT mahasiswa.*, jurusan.nama_jurusan 
    FROM mahasiswa
    LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
");

// tombol cari ditekan  
$keyword = $_POST["keyword"] ?? "";  // aman, tidak muncul warning

if (isset($_POST["cari"])) {
    $mahasiswa = query("
        SELECT mahasiswa.*, jurusan.nama_jurusan 
        FROM mahasiswa
        LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
        WHERE 
            mahasiswa.nama LIKE '%$keyword%' OR
            mahasiswa.nrp LIKE '%$keyword%' OR
            mahasiswa.email LIKE '%$keyword%' OR
            jurusan.nama_jurusan LIKE '%$keyword%'
    ");
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Admin</title>

    <style>
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            background: #0d6efd;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
            font-size: 16px;
            padding: 10px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .load {
            width: 100px;
            display: none;
        }

        @media print {

            .sidebar,
            .aksi,
            .search {
                display: none;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>

    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/script.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h3 class="mb-4">Dashboard Admin</h3>

        <a href="tambah.php" class="bg-warning">Tambah Mahasiswa</a>
        <a href="jurusan.php" class="bg-info">Kelola Jurusan</a>
        <a href="cetak.php" target="_blank" class="bg-success mt-3">Cetak Data</a>
        <a href="logout.php" class="bg-danger mt-3">Logout</a>
    </div>

    <!-- KONTEN -->
    <div class="content">

        <div class="position-relative" style="max-width: 400px;">

            <!-- FORM -->
            <form action="" method="POST"
                class="d-flex mt-2 search flex-grow-0">

                <input class="form-control me-2 w-100"
                    type="text"
                    name="keyword"
                    autofocus
                    placeholder="Masukkan keyword..."
                    autocomplete="off"
                    id="keyword">

                <button class="btn btn-secondary ms-2 flex-shrink-0"
                    type="submit"
                    name="cari">Cari</button>
            </form>

            <!-- LOADER DI LUAR FORM -->
            <img src="img/load.gif"
                class="load position-absolute"
                id="load"
                style="width:35px; top:8px; right:-45px; display:none;">

        </div>

        <br>

        <div class="table-responsive" id="cont">
            <table class="table table-bordered table-striped">

                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th class="aksi">Aksi</th>
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
                            <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-warning">ubah</a> |
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" class="btn btn-sm btn-danger">hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>

    </div>


</body>

</html>