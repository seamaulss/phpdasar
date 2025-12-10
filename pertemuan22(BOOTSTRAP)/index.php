<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari ditekan  
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Halaman Admin</title>

    <style>
        .load {
            width: 100px;
            position: absolute;
            top: 110px;
            left: 350px;
            z-index: -1;
            display: none;
        }

        @media print {

            .logout,
            .tambah,
            .aksi,
            .search {
                display: none;
            }
        }
    </style>

    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/script.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body class="container mt-4">

    <h1 class="mb-4">Daftar Mahasiswa</h1>

    <a href="tambah.php" class="btn btn-primary tambah">Tambah data mahasiswa</a>
    <br></br>

    <a href="logout.php" class="btn btn-danger logout ">Logout</a> | <a href="cetak.php" class="btn btn-success ms-2 cetak" target="_blank">Cetak!</a>
    <br></br>

    <form action="" method="POST" class="d-flex mt-4 search" style="max-width: 400px;">

        <input class="form-control me-2" type="text" name="keyword" size="44" autofocus placeholder="Masukkan keyword..." autocomplete="off" id="keyword">
        <button class="btn btn-secondary ms-2" type="submit" name="cari" id="search">Cari</button>

        <img src="img/load.gif" class="load" id="load">

    </form>

    <br>

    <div class="table-responsive container mt-4" id="cont">
        <table border="1" cellpadding="10"  class="table table-bordered table-striped" cellspacing="0">

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
                    
                    <td><?= $i; ?></td>

                    
                    <td><img src="/phpdasar/pertemuan22(BOOTSTRAP)/img/<?= $row["gambar"]; ?>" width="50" class="img-thumbnail"></td>
                    <td><?= $row["nrp"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["jurusan"]; ?></td>
                    <td class="aksi">
                        <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-warning">ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" class="btn btn-sm btn-danger">hapus</a>
                    </td>

                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>

        </table>
    </div>

</body>

</html>