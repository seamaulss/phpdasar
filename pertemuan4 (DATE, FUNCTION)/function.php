<!-- Default parameter (jika tidak diisi tetap ada nilai)
Return value
Cara memanggil function menggunakan short tag php -->

<?php

    function salam ($waktu = "Datang", $nama = "Arkan") {
        return "Selamat $waktu, $nama!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latihan Function</title>
</head>
<body>
    <h1><?=  salam("Pagi", "Maul"); ?></h1>
</body>
</html>