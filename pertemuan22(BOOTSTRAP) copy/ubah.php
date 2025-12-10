<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'function.php';

// ambil data di url
$id = $_GET["id"];
if (!isset($id)) {
    header("Location: index.php");
    exit;
}

// query data mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan
if( isset($_POST["submit"]) ) {

    // cek apakah data berhasil diubah
    if( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
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
    <title>Ubah Data</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow">
                <div class="card-body">

                    <h3 class="text-center mb-4">Ubah Data Mahasiswa</h3>

                    <form action="" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $m['id']; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $m['gambar']; ?>">

                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" 
                                   class="form-control" required 
                                   value="<?= $m['nama']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="nrp">NRP</label>
                            <input type="text" name="nrp" id="nrp" 
                                   class="form-control" required 
                                   value="<?= $m['nrp']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" id="email" 
                                   class="form-control" required 
                                   value="<?= $m['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <input type="text" name="jurusan" id="jurusan" 
                                   class="form-control" required 
                                   value="<?= $m['jurusan']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label> <br>
                            <img src="img/<?= $m['gambar']; ?>" 
                                 alt="Gambar" width="80" class="rounded border mb-2">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="gambar">Ganti Gambar</label>
                            <input type="file" name="gambar" id="gambar" 
                                   class="form-control">
                        </div>

                        <button type="submit" name="submit" 
                                class="btn btn-primary w-100">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
