<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// cek apakah tombol tambah sudah ditekan
if( isset($_POST["submit"]) ) {

    // cek apakah data berhasil ditambahkan
    if( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Tambah Data Mahasiswa</h3>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP :</label>
                    <input type="text" class="form-control" name="nrp" id="nrp" autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan :</label>
                    <input type="text" class="form-control" name="jurusan" id="jurusan" autocomplete="off" required>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar :</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">
                    Tambah
                </button>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
