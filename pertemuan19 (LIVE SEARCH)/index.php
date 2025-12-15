<!-- Hanya user yang login bisa mengakses halaman ini.
Menampilkan daftar mahasiswa dari database.
Bisa mencari, menambah, mengubah, dan menghapus data mahasiswa.
Tampilan data menggunakan tabel HTML.
Ada dukungan pencarian keyword dan logout. -->

<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$mahasiswa = query("
    SELECT mahasiswa.*, jurusan.nama_jurusan 
    FROM mahasiswa
    LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
");

// tombol cari ditekan  
if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
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

    <form action="" method="POST">

        <input type="text" name="keyword" size="44" autofocus placeholder="Masukkan keyword..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="search">Cari</button>

    </form>

    <br></br>
    
    <div class="container">
    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach( $mahasiswa as $row ) : ?>
    <tr>
        <td><?= $i; ?></td>
        
        <td><img src="img/<?php echo $row["gambar"]; ?>"
        width="50"></td>
        <td><?= $row["nrp"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["nama_jurusan"]; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> | 
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" >hapus</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

    </table>
    </div>

    <script src="js/script.js"></script>
</body>
</html>