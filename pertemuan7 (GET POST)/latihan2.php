<!-- Membuat form input untuk nama. -->
<!-- Mengirim data menggunakan method POST. -->
<!-- Data yang dikirim tidak muncul di URL, tapi bisa diakses dengan $_POST. -->


<?php

    if  (!isset ($_GET["nama"]) ||
         !isset ($_GET["nrp"]) ||
         !isset ($_GET["jurusan"]) ||
         !isset ($_GET["gmail"]) ||
         !isset ($_GET["gambar"])) {
        header("Location: latihan1.php");
        exit;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>
<body>
    
    <ul>
        <li><img src="img/cat2.jpg" ></li>
        <li><?= $_GET["nama"]; ?></li>
        <li><?= $_GET["nrp"]; ?></li>
        <li><?= $_GET["jurusan"]; ?></li>
        <li><?= $_GET["gmail"]; ?></li>
    </ul>

    <a href="latihan1.php">Kembali ke daftar mahasiswa </a>


</body>
</html>