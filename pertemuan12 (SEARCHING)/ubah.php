<?php
session_start();

require 'function.php';

// ambil ID dari URL
$id = $_GET["id"] ?? null;
if (!$id) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// ambil data mahasiswa
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
if (!$mhs) {
    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
$m = $mhs[0];

// ambil data jurusan untuk dropdown
$jurusanList = query("SELECT * FROM jurusan");

// cek apakah tombol submit ditekan
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-primary mb-4">Ubah Data Mahasiswa</h3>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $m["id"]; ?>">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required value="<?= htmlspecialchars($m["nama"]); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nrp" class="form-label">NRP</label>
                        <input type="text" name="nrp" id="nrp" class="form-control" required value="<?= htmlspecialchars($m["nrp"]); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($m["email"]); ?>">
                    </div>

                    <!-- GANTI SELURUH BAGIAN SELECT JURUSAN MENJADI INI -->
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select name="jurusan_id" id="jurusan" class="form-select" required>
                            <option value="">-- Pilih Jurusan --</option>
                            <?php
                            $jurusanList = query("SELECT * FROM jurusan");
                            foreach ($jurusanList as $j) :
                            ?>
                                <option value="<?= $j['id']; ?>"
                                    <?= $j['id'] == $m['jurusan_id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($j['nama_jurusan']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="<?= $m["id"]; ?>">

                    <!-- TAMBAHKAN 2 BARIS INI (WAJIB!) -->
                    <input type="hidden" name="jurusan_id_lama" value="<?= $m['jurusan_id']; ?>">
                    <input type="hidden" name="gambarLama" value="<?= htmlspecialchars($m['gambar']); ?>">

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                    <a href="index.php" class="btn btn-secondary ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>