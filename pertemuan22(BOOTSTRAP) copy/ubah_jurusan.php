<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// pastikan id ada
if (!isset($_GET["id"])) {
    echo "ID jurusan tidak ditemukan!";
    exit;
}

$id = intval($_GET["id"]);

// ambil data jurusan
$jurusan = query("SELECT * FROM jurusan WHERE id = $id");
if (!$jurusan) {
    echo "Jurusan tidak ditemukan!";
    exit;
}

$jurusan = $jurusan[0]; // ambil array pertama

// jika submit ditekan
if (isset($_POST["submit"])) {

    if (ubahjurusan($_POST) > 0) {
        echo "<script>
                alert('Jurusan berhasil diubah!');
                document.location.href='jurusan.php';
              </script>";
    } else {
        echo "<script>
                alert('Jurusan gagal diubah!');
              </script>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Ubah Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ubah Data Jurusan</h5>
                </div>

                <div class="card-body">
                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?= $jurusan['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Jurusan</label>
                            <input
                                type="text"
                                name="nama_jurusan"
                                class="form-control"
                                required
                                value="<?= $jurusan['nama_jurusan']; ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="jurusan.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</body>

</html>