<!-- Halaman ini untuk menambah jurusan baru di database.

Admin harus login untuk mengaksesnya.

Data dikirim ke fungsi tambahjurusan() yang akan memasukkan ke tabel jurusan.

Setelah berhasil → alert & redirect ke daftar jurusan.

Tampilan sederhana menggunakan Bootstrap. -->

<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

if (isset($_POST["submit"])) {
    if (tambahjurusan($_POST) > 0) {
        echo "<script>
                alert('Jurusan berhasil ditambahkan!');
                document.location.href = 'jurusan.php';
              </script>";
    } else {
        echo "<script>
                alert('Jurusan gagal ditambahkan!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="text-primary mb-4">Tambah Jurusan</h3>

            <form action="" method="post">

                <div class="mb-3">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                <a href="jurusan.php" class="btn btn-secondary ms-2">Kembali</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
