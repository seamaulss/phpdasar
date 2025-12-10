<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $halamanAktif - 1 ) * $jumlahDataPerHalaman;

// tombol cari ditekan & tidak menggunakan pagination
if( isset($_POST["cari"]) && $_POST["keyword"] !== "" ) {
    $keyword = $_POST["keyword"];
    $mahasiswa = cari($keyword, $awalData, $jumlahDataPerHalaman);
} else {
    // pagination dengan halaman aktif
    $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");
}
 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
</head>
<body>
    
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br></br>

    <a href="logout.php">Logout</a> 
    <br></br>

    <form action="?halaman=<?= $halamanAktif ?>" method="post">

        <input type="text" name="keyword" size="44" autofocus placeholder="Masukkan keyword..." autocomplete="off">
        <button type="submit" name="cari">Cari</button>

    </form>
    <br></br>

    <?php if( $halamanAktif > 1 ) : ?>
        <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>
    
    <!-- navigasi -->
     <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>

        <?php if( $i == $halamanAktif ) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold"><?= $i; ?></a>
        <?php else : ?>

            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>

        <?php endif; ?>

    <?php endfor; ?>

    <?php if( $halamanAktif < $jumlahHalaman ) : ?>

        <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>

    <?php endif; ?>

    <br></br>
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

    <?php $i = $awalData + 1; ?>
    <?php foreach( $mahasiswa as $row ) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> | 
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" >hapus</a>
        </td>
        <td><img src="img/<?php echo $row["gambar"]; ?>"
        width="50"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

    </table>
</body>
</html>