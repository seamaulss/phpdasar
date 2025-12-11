<!-- Halaman ini hanya bisa diakses jika user login.
Menampilkan daftar mahasiswa dari database.
Ada fitur tambah, ubah, hapus, dan cari mahasiswa.
Pencarian bisa dilakukan live dengan bantuan Ajax.
Data ditampilkan dalam tabel lengkap dengan foto dan informasi mahasiswa. -->

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
    </style>

    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/script.js"></script>

</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br></br>

    <a href="logout.php">Logout</a>
    <br></br>

    <form action="" method="POST">

        <input type="text" name="keyword" size="44" autofocus placeholder="Masukkan keyword..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="search">Cari</button>

        <img src="img/load.gif" class="load" id="load">

    </form>

    <br>

    <div class="container" id="cont">
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
                    <td><?= $i; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                    </td>
                    <td><img src="img/<?php echo $row["gambar"]; ?>"
                            width="50"></td>
                    <td><?= $row["nrp"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["jurusan_id"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>

        </table>
    </div>

</body>

</html>